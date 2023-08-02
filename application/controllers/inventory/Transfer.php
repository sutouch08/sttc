<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends PS_Controller
{
  public $menu_code = 'OPWHTR';
	public $menu_group_code = 'OP';
	public $title = 'โอนสินค้า';
	public $segment = 4;
  public $ms;
  public $error;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/transfer';
    $this->load->model('inventory/transfer_model');
    $this->load->model('inventory/install_list_model');
    $this->load->model('inventory/pack_model');
    $this->load->helper('transfer');
    $this->load->helper('warehouse');
    $this->load->helper('area');
  }


  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'tr_code', ''),
      'from_warehouse' => get_filter('from_warehouse', 'tr_from_warehouse', 'all'),
      'to_warehouse' => get_filter('to_warehouse', 'tr_to_warehouse', 'all'),
      'user' => get_filter('user', 'tr_user', ''),
      'export_status' => get_filter('export_status', 'sap_status', 'all'),
      'status' => get_filter('status', 'tr_status', 'all'),
      'from_date' => get_filter('from_date', 'tr_from_date', ''),
      'to_date' => get_filter('to_date', 'tr_to_date', '')
		);

    $filter['user_in'] = empty($filter['user']) ? NULL : $this->user_model->get_user_in($ds['user']);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->transfer_model->count_rows($filter);

		$filter['data'] = $this->transfer_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('inventory/transfer/transfer_list', $filter);
  }


  public function add_new()
  {
    $ds = array(
      'code' => $this->get_new_code()
    );

    $this->load->view('inventory/transfer/transfer_add', $ds);
  }


  public function add()
  {
    $sc = TRUE;

    if($this->pm->can_add)
    {
      $date_add = db_date($this->input->post('date_add'), TRUE);
      $fromWhsCode = $this->input->post('fromWhsCode');
      $toWhsCode = $this->input->post('toWhsCode');
      $remark = get_null(trim($this->input->post('remark')));

      $code = $this->get_new_code($date_add);

      $arr = array(
        'date_add' => $date_add,
        'code' => $code,
        'fromWhsCode' => $fromWhsCode,
        'toWhsCode' => $toWhsCode,
        'remark' => $remark,
        'user' => $this->_user->id,
        'input_type' => 'M'
      );

      $id = $this->transfer_model->add($arr);

      if( ! $id)
      {
        $sc = FALSE;
        $this->error = "Failed to create document";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('permission');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'id' => $sc === TRUE ? $id : NULL
    );

    echo json_encode($arr);
  }


  public function createFromPackList($pack_id)
  {
    $this->ms = $this->load->database('ms', TRUE);
    $this->load->model('inventory/pack_model');
    $sc = TRUE;

    if($this->pm->can_add)
    {
      if(! empty($this->_user->fromWhsCode) && ! empty($this->_user->toWhsCode))
      {
        $pack = $this->pack_model->get($pack_id);

        if( ! empty($pack))
        {
          if($pack->status == 'F')
          {
            $details = $this->pack_model->get_details($pack_id);

            if( ! empty($details))
            {
              $code = $this->get_new_code();

              $arr = array(
                'date_add' => now(),
                'code' => $code,
                'fromWhsCode' => $this->_user->fromWhsCode,
                'toWhsCode' => $this->_user->toWhsCode,
                'remark' => "Create from {$pack->code}",
                'user' => $this->_user->id,
                'pack_id' => $pack->id,
                'pack_code' => $pack->code,
                'input_type' => 'A'
              );

              $this->db->trans_begin();
              $id = $this->transfer_model->add($arr);

              if($id)
              {
                $lineNum = 0;

                foreach($details as $rs)
                {
                  if($sc === FALSE)
                  {
                    break;
                  }

                  if( ! $this->transfer_model->is_exists_row($rs->i_pea_no))
                  {
                    //--- get install list by id
                    $row = $this->install_list_model->get($rs->u_pea_no, 'u');

                    if( ! empty($row))
                    {
                      if( ! empty($row->ItemCode))
                      {
                        $arr = array(
                          'transfer_id' => $id,
                          'transfer_code' => $code,
                          'LineNum' => $lineNum,
                          'ItemCode' => $row->ItemCode,
                          'ItemName' => $row->ItemName,
                          'qty' => 1,
                          'fromWhsCode' => $this->transfer_model->get_warehouse_code_by_serial($row->i_pea_no),
                          'toWhsCode' => $this->_user->toWhsCode,
                          'i_pea_no' => $row->i_pea_no,
                          'u_pea_no' => $row->u_pea_no,
                          'reference' => $pack->code,
                          'pack_id' => $pack_id,
                          'pack_row_id' => $rs->id
                        );

                        //--- add transfer row
                        if( ! $this->transfer_model->add_detail($arr))
                        {
                          $sc = FALSE;
                          $this->error = "เพิ่มรายการไม่สำเร็จ : {$row->i_pea_no}";
                        }

                        //--- update install row to Loaded
                        if( $sc === TRUE)
                        {
                          $arr = array(
                            'status' => 'L',
                            'transfer_code' => $code
                          );

                          $this->install_list_model->update($row->id, $arr);

                          $arr = array(
                            'status' => 'C',
                            'is_transfer' => 1,
                            'transfer_code' => $code
                          );

                          $this->pack_model->update_detail($rs->id, $arr);
                        }

                        $lineNum++;
                      }
                    }
                    else
                    {
                      $sc = FALSE;
                      $this->error = "ไม่พบ {$rs->u_pea_no} ในรายการติดตั้งสำเร็จ";
                    }
                  }
                } //-- end foreach
              }
              else
              {
                $sc = FALSE;
                $this->error = "Failed to create document";
              }

              if($sc === TRUE)
              {
                //--- change pack status
                $arr = array(
                  'status' => 'C',
                  'is_transfer' => 1,
                  'transfer_code' => $code
                );

                if( ! $this->pack_model->update($pack_id, $arr))
                {
                  $sc = FALSE;
                  $this->error = "เปลี่ยนสถานะเอกสารแพ็คไม่สำเร็จ";
                }
              }

              if($sc === TRUE)
              {
                $this->db->trans_commit();
              }
              else
              {
                $this->db->trans_rollback();
              }
            }
            else
            {
              $sc = FALSE;
              $this->error = "ไม่พบรายการที่ต้องโอนย้าย";
            }
          }
          else
          {
            $sc = FALSE;

            $err = array(
            'O' => "เอกสารนี้ยังแพ็คไม่จบ",
            'C' => "เอกสารนี้ปิดไปแล้ว",
            'D' => "เอกสารนี้ถูกยกเลิกไปแล้ว"
            );

            $this->error = $err[$pack->status];
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "ไม่พบเลขที่เอกสารแพ็ค";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "User ไม่ได้ผูกคลังไว้อย่างถูกต้อง กรุณาตรวจสอบ";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('permission');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'id' => $sc === TRUE ? $id : NULL
    );

    echo json_encode($arr);
  }


  public function import_from_pack()
  {
    $sc = TRUE;

    $id = $this->input->get('transfer_id');
    $code = $this->input->get('pack_code');

    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      if($doc->status == 'P')  //-- P = Draft , S = Save , C = Cancelled
      {
        $pack = $this->pack_model->get_by_code($code);

        if( ! empty($pack))
        {
          if($pack->status == 'F')
          {
            $details = $this->pack_model->get_details($pack->id);

            if( ! empty($details))
            {
              $this->ms = $this->load->database('ms', TRUE);

              $this->db->trans_begin();

              $this->transfer_model->update($doc->id, array('pack_id' => $pack->id, 'pack_code' => $pack->code));

              $lineNum = 0;

              foreach($details as $rs)
              {
                if($sc === FALSE)
                {
                  break;
                }

                if($rs->status == 'F')
                {
                  $item = $this->install_list_model->get_item_data_by_pea_no($rs->i_pea_no);

                  if( ! empty($item))
                  {
                    $arr = array(
                      'transfer_id' => $doc->id,
                      'transfer_code' => $doc->code,
                      'LineNum' => $lineNum,
                      'ItemCode' => $item->ItemCode,
                      'ItemName' => $item->ItemName,
                      'fromWhsCode' => $this->transfer_model->get_warehouse_code_by_serial($rs->i_pea_no),
                      'toWhsCode' => $doc->toWhsCode,
                      'i_pea_no' => $rs->i_pea_no,
                      'u_pea_no' => $rs->u_pea_no,
                      'LineStatus' => 'O',
                      'reference' => $pack->code,
                      'pack_id' => $rs->pack_id,
                      'pack_row_id' => $rs->id
                    );

                    if( ! $this->transfer_model->add_detail($arr))
                    {
                      $sc = FALSE;
                      $this->error = "เพิ่มรายการโอนสินค้าไม่สำเร็จ";
                    }

                    if($sc === TRUE)
                    {
                      //---- update pack row
                      $arr = array(
                        'is_transfer' => 1,
                        'transfer_code' => $doc->code,
                        'status' => 'C'
                      );

                      if(! $this->pack_model->update_detail($rs->id, $arr))
                      {
                        $sc = FALSE;
                        $this->error = "เปลี่ยนสถานะรายการแพ็คไม่สำเร็จ";
                      }
                    }

                    if($sc === TRUE)
                    {
                      //--- update install list
                      $arr = array(
                        'status' => 'L',
                        'transfer_code' => $doc->code
                      );

                      if( ! $this->install_list_model->update_by_u_pea_no($rs->u_pea_no, $arr))
                      {
                        $sc = FALSE;
                        $this->error = "เปลี่ยนสถานะรายการติดตั้งไม่สำเร็จ";
                      }
                    }

                    $lineNum++;
                  }
                }
                else
                {
                  $sc = FALSE;
                  $this->error = "พบรายการแพ็คที่ยังไม่บันทึกหรือสถานะรายการไม่สามารถโอนได้";
                }
              } //-- end foreach details

              if($sc === TRUE)
              {
                //--- change pack status
                $arr = array(
                  'status' => 'C',
                  'is_transfer' => 1,
                  'transfer_code' => $doc->code
                );

                if( ! $this->pack_model->update($pack->id, $arr))
                {
                  $sc = FALSE;
                  $this->error = "เปลี่ยนสถานะเอกสารแพ็คไม่สำเร็จ";
                }
              }

              if($sc === TRUE)
              {
                $this->db->trans_commit();
              }
              else
              {
                $this->db->trans_rollback();
              }
            }
            else
            {
              $sc = FALSE;
              $this->error = "ไม่พบรายการในเอกสารแพ็ค";
            }
          }
          else
          {
            $sc = FALSE;
            $this->error = "สถานะเอกสารแพ็คไม่ถูกต้อง";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "ไม่พบเลขที่เอกสารแพ็ค";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "สถานะเอกสารโอนคลังไม่ถูกต้อง กรุณาตรวจสอบ";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "เลขที่เอกสารโอนคลังไม่ถูกต้อง";
    }


    $this->_response($sc);
  }


  public function remove_pack_items()
  {
    $sc = TRUE;

    $id = $this->input->get('transfer_id');
    $code = $this->input->get('pack_code');

    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      if($doc->status == 'P')  //-- P = Draft , S = Save , C = Cancelled
      {
        $pack = $this->pack_model->get_by_code($code);

        if( ! empty($pack))
        {
          if($pack->status == 'C')
          {
            $details = $this->transfer_model->get_details($doc->id);

            if( ! empty($details))
            {
              $this->db->trans_begin();

              $this->transfer_model->update($doc->id, array('pack_id' => NULL, 'pack_code' => NULL));

              $lineNum = 0;

              foreach($details as $rs)
              {
                if($sc === FALSE)
                {
                  break;
                }

                if( ! $this->transfer_model->delete_detail($rs->id))
                {
                  $sc = FALSE;
                  $this->error = "ลบรายการนำเข้าไม่สำเร็จ";
                }

                if($sc === TRUE)
                {
                  //---- update pack row
                  $arr = array(
                    'is_transfer' => 0,
                    'transfer_code' => NULL,
                    'status' => 'F'
                  );

                  if(! $this->pack_model->update_detail($rs->pack_row_id, $arr))
                  {
                    $sc = FALSE;
                    $this->error = "เปลี่ยนสถานะรายการแพ็คไม่สำเร็จ";
                  }
                }

                if($sc === TRUE)
                {
                  //--- update install list
                  $arr = array(
                    'status' => 'O',
                    'transfer_code' => NULL
                  );

                  if( ! $this->install_list_model->update_by_u_pea_no($rs->u_pea_no, $arr))
                  {
                    $sc = FALSE;
                    $this->error = "เปลี่ยนสถานะรายการติดตั้งไม่สำเร็จ";
                  }
                }
              } //-- end foreach details

              if($sc === TRUE)
              {
                //--- change pack status
                $arr = array(
                  'status' => 'F',
                  'is_transfer' => 0,
                  'transfer_code' => NULL
                );

                if( ! $this->pack_model->update($pack->id, $arr))
                {
                  $sc = FALSE;
                  $this->error = "เปลี่ยนสถานะเอกสารแพ็คไม่สำเร็จ";
                }
              }

              if($sc === TRUE)
              {
                $this->db->trans_commit();
              }
              else
              {
                $this->db->trans_rollback();
              }
            }
            else
            {
              $sc = FALSE;
              $this->error = "ไม่พบรายการในเอกสารแพ็ค";
            }
          }
          else
          {
            $sc = FALSE;
            $this->error = "สถานะเอกสารแพ็คไม่ถูกต้อง";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "ไม่พบเลขที่เอกสารแพ็ค";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "สถานะเอกสารโอนคลังไม่ถูกต้อง กรุณาตรวจสอบ";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "เลขที่เอกสารโอนคลังไม่ถูกต้อง";
    }


    $this->_response($sc);
  }


  public function edit($id)
  {
    if($this->pm->can_edit)
    {
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {
        $ds = array(
          'doc' => $doc,
          'details' => $this->transfer_model->get_details($id)
        );

        if($doc->status == 'P')
        {
          $this->load->view('inventory/transfer/transfer_edit', $ds);
        }
        else
        {
          $this->load->view('inventory/transfer/transfer_view_detail', $ds);
        }
      }
      else
      {
        $this->page_error();
      }
    }
    else
    {
      $this->permission_page();
    }
  }


  public function view_detail($id)
  {
    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      $ds = array(
        'doc' => $doc,
        'details' => $this->transfer_model->get_details($id)
      );

      $this->load->view('inventory/transfer/transfer_view_detail', $ds);
    }
    else
    {
      $this->page_error();
    }
  }



  public function update()
  {
    $sc = TRUE;
    $id = $this->input->post('id');
    $remark = get_null(trim($this->input->post('remark')));

    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      if( $doc->status == 'P')
      {
        $arr = array(
          'remark' => $remark,
          'update_user' => $this->_user->id
        );

        if( ! $this->transfer_model->update($id, $arr))
        {
          $sc = FALSE;
          $this->error = "Update failed";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Invalid document status";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Invalid document id";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  function save()
  {
    $sc = TRUE;
    $ex = 0;

    $id = $this->input->post('id');

    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      if($doc->status == 'P')
      {
        $this->db->trans_begin();

        $arr = array(
          'status' => 'S',
          'update_user' => $this->_user->id
        );

        $do = $this->transfer_model->update($id, $arr);
        $de = $this->transfer_model->update_details($id, array('LineStatus' => 'C'));

        if($do && $de)
        {
          $this->db->trans_commit();
        }
        else
        {
          $this->db->trans_rollback();
          $sc = FALSE;
          $this->error = "Failed to save document";
        }

        if($sc === TRUE)
        {
          $this->ms = $this->load->database('ms', TRUE);
          $this->load->library('api');

          if( ! $this->api->exportTransfer($id))
          {
            $sc = FALSE;
            $ex = 1;
            $this->error = "บันทึกเอกสารสำเร็จแต่สส่งข้อมูลเข้า SAP ไม่สำเร็จ กรุณากดส่งข้อมูลอีกครั้งภายหลัง : {$this->error}";
          }
          else
          {
            $this->install_list_model->change_status_by_transfer_code($doc->code, 'S');
          }
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Invalid document status";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Invalid document id";
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'ex' => $ex
    );

    echo json_encode($arr);
  }


  public function delete_details()
  {
    $sc = TRUE;
    $data = json_decode($this->input->post('data'));

    if( ! empty($data))
    {
      if( $this->transfer_model->is_all_open($data))
      {
        $this->db->trans_begin();

        foreach($data as $id)
        {
          if($sc === FALSE)
          {
            break;
          }

          $row = $this->transfer_model->get_detail($id);

          if( ! empty($row) && $row->LineStatus == 'O')
          {
            if($this->transfer_model->delete_detail($id))
            {
              if( ! $this->install_list_model->change_status_by_u_pea_no($row->u_pea_no, 'O'))
              {
                $sc = FALSE;
                $this->error = "เปลี่ยนสถานะรายการติดตั้งไม่สำเร็จ : {$row->i_pea_no}";
              }

              if($sc === TRUE)
              {
                $arr = array(
                  'transfer_code' => NULL,
                  'pack_id' => NULL,
                  'pack_row_id' => NULL
                );

                $this->pack_model->update_detail($row->pack_row_id, $arr);
              }
            }
            else
            {
              $sc = FALSE;
              $this->error = "ลบรายการโอนย้ายไม่สำเร็จ : {$row->i_pea_no}";
            }
          }
        } //-- end foreach

        if($sc === TRUE)
        {
          $this->db->trans_commit();
        }
        else
        {
          $this->db->trans_rollback();
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "ลบไม่สำเร็จ - พบรายการที่มีสถานะ Close หรือ Cancelled ไปแล้ว";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "No item selected";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }



  public function cancle_transfer()
  {
    $sc = TRUE;
    $id = $this->input->post('id');
    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      if($doc->status != 'C')
      {
        if($doc->status == 'P' OR $this->pm->can_delete)
        {
          $DocNum = $doc->status == 'P' ? NULL : $this->sapExists($doc->code);

          if(empty($DocNum))
          {
            //--
            $this->db->trans_begin();

            //--- change document status
            if( ! $this->transfer_model->update($doc->id, array('status' => 'C', 'update_user' => $this->_user->id)))
            {
              $sc = FALSE;
              $this->error = "ยกเลิกเอกสารไม่สำเร็จ : เปลี่ยนสถานะเอกสารไม่สำเร็จ";
            }

            //--- delete transfer details
            if($sc === TRUE)
            {
              $details = $this->transfer_model->get_details($doc->id);

              if( ! empty($details))
              {
                foreach($details as $rs)
                {
                  if($sc === FALSE)
                  {
                    break;
                  }

                  if( ! $this->transfer_model->update_detail($rs->id, array('LineStatus' => 'D')))
                  {
                    $sc = FALSE;
                    $this->error = "ยกเลิกเอกสารไม่สำเร็จ : เปลี่ยนสถานะรายการโอนย้ายไม่สำเร็จ";
                  }

                  //--- change status install list
                  if($sc === TRUE)
                  {
                    $arr = array(
                      'status' => 'O',
                      'transfer_code' => NULL
                    );

                    if( ! $this->install_list_model->update_by_u_pea_no($rs->u_pea_no, $arr))
                    {
                      $sc = FALSE;
                      $this->error = "ยกเลิกเอกสารไม่สำเร็จ : เปลี่ยนสถานะรายการติดตั้งแล้วไม่สำเร็จ";
                    }
                  }

                  if($sc === TRUE)
                  {
                    if( ! empty($rs->pack_row_id))
                    {
                      $arr = array(
                        'is_transfer' => 0,
                        'transfer_code' => NULL,
                        'status' => 'F'
                      );

                      if( ! $this->pack_model->update_detail($rs->pack_row_id, $arr))
                      {
                        $sc = FALSE;
                        $this->error = "Change pack row status failed";
                      }
                    }
                  }

                } //--- foreach details
              }
            }

            if($sc === TRUE)
            {
              if( ! empty($doc->pack_id))
              {
                $arr = array(
                  'status' => 'F',
                  'transfer_code' => NULL,
                  'is_transfer' => 0
                );

                if( ! $this->pack_model->update($doc->pack_id, $arr))
                {
                  $sc = FALSE;
                  $this->error = "Change pack status failed";
                }
              }
            }


            if($sc === TRUE)
            {
              $this->db->trans_commit();
            }
            else
            {
              $this->db->trans_rollback();
            }
          }
          else
          {
            $sc = FALSE;
            $this->error = "เอกสารนี้เข้า SAP แล้ว หากต้องการยกเลิก ต้องยกเลิกใบโอนสินค้าเลขที่ {$DocNum} ในระบบ SAP ก่อน";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "คุณไม่มีสิทธิ์ในการยกเลิกเอกสารที่บันทึกแล้ว";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Invalid document status";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Invalid document id";
    }

    $this->_response($sc);
  }


  public function reloadWarehouse($id)
  {
    $this->ms = $this->load->database('ms', TRUE);
    $sc = TRUE;

    $details = $this->transfer_model->get_details($id);

    if( ! empty($details))
    {
      foreach($details as $rs)
      {
        $fromWhsCode = $this->transfer_model->get_warehouse_code_by_serial($rs->i_pea_no);
        if($fromWhsCode != $rs->fromWhsCode)
        {
          $arr = array(
            'fromWhsCode' => $fromWhsCode
          );

          $this->transfer_model->update_detail($rs->id, $arr);
        }
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการโอนย้าย";
    }

    $this->_response($sc);
  }


  public function sapExists($code)
  {
    $this->ms = $this->load->database('ms', TRUE);

    //$rs = $this->ms->select('DocNum')->where('U_WEBCODE', $code)->where('CANCELED', 'N')->get('OWTR');
    $qr = "SELECT CONCAT(S.BeginStr, '-', O.DocNum) AS DocNum
            FROM OWTR AS O
            LEFT JOIN NNM1 AS S ON O.ObjType = 67
            AND S.ObjectCode = 67 AND O.Series = S.Series
            WHERE O.U_WEBCODE = '{$code}' AND O.CANCELED = 'N'";

    $rs = $this->ms->query($qr);

    if($rs->num_rows() > 0)
    {
      return $rs->row()->DocNum;
    }

    return FALSE;
  }


  public function send_to_sap()
  {
    $sc = TRUE;

    $id = $this->input->post('id');

    if($id)
    {
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status == 'A' && $doc->is_approve == 1)
        {
          $this->load->database('ms', TRUE);
          $this->load->library('api');

          if( ! $this->api->exportTransfer($id))
          {
            $sc = FALSE;
            set_error(0, "ส่งข้อมูลเข้า SAP ไม่สำเร็จ กรุณากดส่งข้อมูลอีกครั้งภายหลัง : {$this->error}");
          }
        }
        else
        {
          $sc = FALSE;
          set_error(0, "Invalid document status");
        }
      }
      else
      {
        $sc = FALSE;
        set_error(0, "Invalid document id");
      }
    }
    else
    {
      $sc = FALSE;
      set_error("required");
    }

    $this->_response($sc);
  }




  public function get_new_code($date = NULL)
  {
    $date = empty($date) ? date('Y-m-d') : $date;
    $Y = date('y', strtotime($date));
    $M = date('m', strtotime($date));
    $prefix = getConfig('PREFIX_TRANSFER');
    $run_digit = getConfig('RUN_DIGIT_TRANSFER');
    $pre = $prefix .'-'.$Y.$M;
    $code = $this->transfer_model->get_max_code($pre);

    if(! empty($code))
    {
      $run_no = mb_substr($code, ($run_digit*-1), NULL, 'UTF-8') + 1;
      $new_code = $prefix . '-' . $Y . $M . sprintf('%0'.$run_digit.'d', $run_no);
    }
    else
    {
      $new_code = $prefix . '-' . $Y . $M . sprintf('%0'.$run_digit.'d', '001');
    }

    return $new_code;
  }


  public function clear_filter()
  {
    $filter = array(
      'tr_code',
      'tr_from_warehouse',
      'tr_to_warehouse',
      'tr_user',
      'sap_status',
      'tr_status',
      'tr_from_date',
      'tr_to_date'
    );

    return clear_filter($filter);
  }


  public function test_json($id)
  {
    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      $currency = getConfig('CURRENCY');
      $vat_rate = getConfig('SALE_VAT_RATE');
      $vat_code = getConfig('SALE_VAT_CODE');

      $ds = array(
        'U_WEBCODE' => $doc->code,
        'DocType' => 'I',
        'CANCELED' => 'N',
        'DocDate' => sap_date($doc->date_add, TRUE),
        'DocDueDate' => sap_date($doc->date_add, TRUE),
        'CardCode' => NULL,
        'CardName' => NULL,
        'VatPercent' => 0.000000,
        'VatSum' => 0.000000,
        'VatSumFc' => 0.000000,
        'DiscPrcnt' => 0.000000,
        'DiscSum' => 0.000000,
        'DiscSumFC' => 0.000000,
        'DocCur' => $currency,
        'DocRate' => 1,
        'DocTotal' => 0.000000,
        'DocTotalFC' => 0.000000,
        'Filler' => $doc->fromWhsCode,
        'ToWhsCode' => $doc->toWhsCode,
        'Comments' => $doc->remark,
        'DocLine' => array(
            'U_WEBCODE' => $doc->code,
            'LineNum' => 0,
            'ItemCode' => $doc->ItemCode,
            'Dscription' => $doc->ItemName,
            'Quantity' => $doc->Qty,
            'unitMsr' => NULL,
            'PriceBefDi' => 0.000000,
            'LineTotal' => 0.000000,
            'ShipDate' => sap_date($doc->date_add, TRUE),
            'Currency' => $currency,
            'Rate' => 1,
            'DiscPrcnt' => 0.000000,
            'Price' => 0.000000,
            'TotalFrgn' => 0.000000,
            'FromWhsCod' => $doc->fromWhsCode,
            'WhsCode' => $doc->toWhsCode,
            'FisrtBin' => NULL,
            'F_FROM_BIN' => NULL,
            'F_TO_BIN' => NULL,
            'AllocBinC' => NULL,
            'TaxStatus' => 'Y',
            'VatPrcnt' => 0.000000,
            'VatGroup' => NULL,
            'PriceAfVAT' => 0.000000,
            'VatSum' => 0.000000,
            'TaxType' => 'Y',
            'SerialNum' => $doc->InstallSerialNum
        )
      );

      echo json_encode($ds);
    }
  }

} //--- end class

 ?>
