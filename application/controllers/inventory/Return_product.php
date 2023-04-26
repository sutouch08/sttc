<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_product extends PS_Controller
{
  public $menu_code = 'OPWHRT';
	public $menu_group_code = 'OP';
	public $title = 'Return';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/return_product';
    $this->load->model('inventory/return_product_model');
    $this->load->model('admin/warehouse_model');
    $this->load->helper('image');
    $this->load->helper('transfer');
    $this->load->helper('warehouse');
    $this->load->helper('team');
  }


  private function view($fileName)
  {
    return "inventory/return_product/{$fileName}";
  }

  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'rt_code', ''),
      'fromWhsCode' => get_filter('fromWhsCode', 'rt_fromWhsCode', 'all'),
      'toWhsCode' => get_filter('toWhsCode', 'rt_toWhsCode', 'all'),
      'status' => get_filter('status', 'rt_status', 'all'),
      'from_date' => get_filter('from_date', 'rt_from_date', ''),
      'to_date' => get_filter('to_date', 'rt_to_date', ''),
      'team_id' => get_filter('team_id', 'rt_team_id', 'all'),
      'user_id' => get_filter('user_id', 'rt_user_id', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->return_product_model->count_rows($filter);

		$filter['data'] = $this->return_product_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view($this->view('return_product_list'), $filter);
  }



  public function view_detail($id)
  {
    $doc = $this->return_product_model->get($id);

    if( ! empty($doc))
    {
      $ds = array(
        'doc' => $doc,
        'details' => $this->return_product_model->get_details($id)
      );

      $this->load->view($this->view('return_product_detail'), $ds);
    }
    else
    {
      $this->page_error();
    }
  }


  public function edit($id)
  {
    $doc = $this->return_product_model->get($id);

    if( ! empty($doc))
    {
      $ds = array(
        'doc' => $doc,
        'details' => $this->return_product_model->get_details($id)
      );

      if($doc->status == 0 OR ($doc->status == 1 && $doc->is_approve == 0))
      {
        $this->load->view($this->view('return_product_edit'), $ds);
      }
      else
      {
        $this->load->view($this->view('return_product_detail'), $ds);
      }
    }
    else
    {
      $this->page_error();
    }
  }


  public function save_return()
  {
    $sc = TRUE;
    $ex = 1;

    if($this->pm->can_edit OR $this->pm->can_add)
    {
      $return_id = $this->input->post('return_id');
      $doc = $this->return_product_model->get($return_id);

      if( ! empty($doc))
      {
        if($doc->status == 0 OR ($doc->status == 1 && $doc->is_approve == 0))
        {
          $date_add = $this->input->post('date_add');
          $toWhsCode = $this->input->post('toWhsCode');
          $remark = trim($this->input->post('remark'));

          if( ! empty($date_add) && ! empty($toWhsCode))
          {
            $arr = array(
              'date_add' => db_date($date_add, FALSE),
              'toWhsCode' => $toWhsCode,
              'status' => 1,
              'remark' => get_null($remark),
              'is_receive' => 1,
              'receive_by' => $this->_user->id,
              'receive_at' => now(),
              'update_by' => $this->_user->id,
              'update_at' => now()
            );

            $this->db->trans_begin();

            if($this->return_product_model->update($return_id, $arr))
            {
              $arr = array(
                'toWhsCode' => $toWhsCode,
                'valid' => 1
              );

              if( ! $this->return_product_model->update_details($return_id, $arr))
              {
                $sc = FALSE;
                set_error('x', "Update Rows Status Failed");
              }
            }
            else
            {
              $sc = FALSE;
              set_error('update');
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
            set_error('required');
          }
        }
        else
        {
          $sc = FALSE;
          set_error('x', "Invalid Document Status");
        }
      }
      else
      {
        $sc = FALSE;
        set_error('notfound');
      }
    }
    else
    {
      $sc = FALSE;
      set_error('permission');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : ($ex == 0 ? 'warning' : 'failed'),
      'message' => $sc === TRUE ? 'success' : $this->error
    );

    echo json_encode($arr);
  }



  public function approve()
  {
    $sc = TRUE;
    $ex = 1;
    $id = $this->input->post('id');

    if( ! empty($id))
    {
      if($this->pm->can_approve)
      {
        $doc = $this->return_product_model->get($id);

        if( ! empty($doc))
        {
          if($doc->status == 1)
          {
            $arr = array(
              'is_approve' => 1,
              'approve_by' => $this->_user->id,
              'approve_at' => now()
            );

            if($this->return_product_model->update($id, $arr))
            {
              $details = $this->return_product_model->get_details($id);

              if( ! empty($details))
              {
                foreach($details as $rs)
                {
                  $this->return_product_model->update_user_item($rs->user_id, $rs->Serial, $rs->fromDoc, 3);
                }
              }
            }
            else
            {
              $sc = FALSE;
              set_error('update', 'Status');
            }

            if($sc === TRUE)
            {
              if( ! $this->do_export($id))
              {
                $sc = FALSE;
                $ex = 0;
                $this->error = "อนุมัติสำเร็จ แต่ส่งข้อมูลเข้า SAP ไม่สำเร็จ : {$this->error}";
              }
            }
          }
          else
          {
            $sc = FALSE;
            set_error('x', 'Invalid Document Status');
          }
        }
        else
        {
          $sc = FALSE;
          set_error('notfound');
        }
      }
      else
      {
        $sc = FALSE;
        set_error('permission');
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : ($ex == 0 ? 'warning' : 'failed'),
      'message' => $sc === TRUE ? 'success' : $this->error
    );

    echo json_encode($arr);
  }


  public function cancle_return()
  {
    $this->ms = $this->load->database('ms', TRUE);
    $sc = TRUE;
    $id = $this->input->post('id');

    if( ! empty($id))
    {
      if($this->pm->can_delete)
      {
        $doc = $this->return_product_model->get($id);

        if( ! empty($doc))
        {
          if($doc->status != 2)
          {
            $docNum = NULL;
            if($doc->status == 1 && (! empty($doc->DocEntry) OR ! empty($doc->DocNum)))
            {
              $docNum = $this->return_product_model->getSapDocNum($doc->code);
            }

            if(empty($docNum))
            {
              $this->db->trans_begin();
              $arr = array(
                'status' => 2,
                'is_cancle' => 1,
                'cancle_by' => $this->_user->id,
                'cancle_at' => now()
              );

              if($this->return_product_model->update($id, $arr))
              {
                //--
                $arr = array(
                  'valid' => 2
                );

                if($this->return_product_model->update_details($id, $arr))
                {
                  $details = $this->return_product_model->get_details($id);

                  if( ! empty($details))
                  {
                    foreach($details AS $rs)
                    {
                      $this->return_product_model->update_user_item($rs->user_id, $rs->Serial, $rs->fromDoc, 0);
                    }
                  }
                }
                else
                {
                  $sc = FALSE;
                  $this->error = "เปลี่ยนสถานะรายการไม่สำเร็จ";
                }
              }
              else
              {
                $sc = FALSE;
                $this->error = "ยกเลิกเอกสารไม่สำเร็จ";
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
              $this->error = "กรุณายกเลิกเอกสารโอนคลังเลขที่ {$docNum} ในระบบ SAP ก่อนยกเลิกเอกสาร";
            }
          }
        }
        else
        {
          $sc = FALSE;
          set_eror('notfound');
        }
      }
      else
      {
        $sc = FALSE;
        set_error('permission');
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $this->_response($sc);
  }


  public function do_export($return_id)
  {
    $sc = TRUE;
    $this->load->library('api');

    if( ! $this->api->exportReturn($return_id))
    {
      $sc = FALSE;
    }

    return $sc;
  }


  public function send_to_sap()
  {
    $sc = TRUE;
    $id = $this->input->post('id');

    if( ! empty($id))
    {
      $doc = $this->return_product_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status == 3)
        {
          $this->load->library('api');

          if( ! $this->api->exportReturn($id))
          {
            $sc = FALSE;
            $this->error = "ส่งข้อมูลไป SAP ไม่สำเร็จ : {$this->error}";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "Invalid Document Status";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Invalid Document No";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing required parameter";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function get_new_code($date = NULL)
  {
    $date = empty($date) ? date('Y-m-d') : $date;
    $Y = date('y', strtotime($date));
    $M = date('m', strtotime($date));
    $prefix = getConfig('PREFIX_RETURN');
    $run_digit = getConfig('RUN_DIGIT_RETURN');
    $pre = $prefix .'-'.$Y.$M;
    $code = $this->return_product_model->get_max_code($pre);

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


  public function getNewCode()
  {
    $code = $this->get_new_code();

    if($code)
    {
      $arr = array(
        'status' => 'success',
        'code' => $code
      );

      echo json_encode($arr);
    }
    else
    {
      echo "Cannot generate new code at this time";
    }
  }


  function clear_filter()
  {
    $filter = array(
			'rt_code',
      'rt_serial',
      'rt_fromWhsCode',
      'rt_toWhsCode',
      'rt_status',
      'rt_from_date',
      'rt_to_date',
      'rt_team_id',
      'rt_user_id',
      'rt_is_receive',
      'rt_receive_by'
		);

    return clear_filter($filter);
  }


  public function test_json($id)
  {
    $doc = $this->return_product_model->get($id);
    $details = $this->return_product_model->get_details($id);

    if( ! empty($doc) && ! empty($details))
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
        'Filler' => $doc->whsCode,
        'ToWhsCode' => $doc->toWhsCode,
        'Comments' => $doc->remark,
        'DocLine' => array()
      );

      $lineNum = 0;

      foreach($details as $rs)
      {
        $arr =  array(
          'U_WEBCODE' => $rs->return_code,
          'LineNum' => $lineNum,
          'ItemCode' => $rs->ItemCode,
          'Dscription' => $rs->ItemName,
          'Quantity' => $rs->Qty,
          'unitMsr' => NULL,
          'PriceBefDi' => 0.000000,
          'LineTotal' => 0.000000,
          'ShipDate' => sap_date($doc->date_add, TRUE),
          'Currency' => $currency,
          'Rate' => 1,
          'DiscPrcnt' => 0.000000,
          'Price' => 0.000000,
          'TotalFrgn' => 0.000000,
          'FromWhsCod' => $rs->WhsCode,
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
          'SerialNum' => $rs->Serial
        );

        array_push($ds['DocLine'], $arr);

        $lineNum++;
      }

      echo json_encode($ds);
    }
  }

} //--- end class

 ?>
