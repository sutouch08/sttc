<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends PS_Controller
{
  public $menu_code = 'OPWHTR';
	public $menu_group_code = 'OP';
	public $title = 'Transfer';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/transfer';
    $this->load->model('inventory/transfer_model');
    $this->load->model('admin/warehouse_model');
    $this->load->helper('team');
    $this->load->helper('image');
    $this->load->helper('transfer');
  }


  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'tr_code', ''),
      'docNum' => get_filter('docNum', 'tr_docNum', ''),
      'fromWhCode' => get_filter('fromWhCode', 'tr_fromWhCode', ''),
      'toWhCode' => get_filter('toWhCode', 'tr_toWhCode', ''),
      'status' => get_filter('status', 'tr_status', 'all'),
      'from_date' => get_filter('from_date', 'tr_from_date', ''),
      'to_date' => get_filter('to_date', 'tr_to_date', ''),
      'team_id' => get_filter('team_id', 'tr_team_id', 'all'),
      'user' => get_filter('user', 'tr_user', ''),
      'order_by' => get_filter('order_by', 'tr_order_by', 'code'),
      'sort_by' => get_filter('sort_by', 'tr_sort_by', 'DESC')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->transfer_model->count_rows($filter);

		$filter['data'] = $this->transfer_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    if($this->_Outsource)
    {
      $this->load->view('inventory/transfer/transfer_list', $filter);
    }
    else
    {
      $this->load->view('inventory/transfer/transfer_list_admin', $filter);
    }
  }


  public function add_new() {
    $ds = array(
      'fromWhList' => $this->warehouse_model->get_user_from_warehouse($this->_user->id),
      'toWhList' => $this->warehouse_model->get_user_to_warehouse($this->_user->id)
    );

    $this->load->view('inventory/transfer/transfer_add', $ds);
  }


  public function add()
  {
    $sc = TRUE;
    $ds = array();

    if($this->input->post())
    {
      $fromWhsCode = $this->input->post('fromWhsCode');
      $toWhsCode = $this->input->post('toWhsCode');
      $code = $this->get_new_code();

      $arr = array(
        'code' => $code,
        'fromWhsCode' => $fromWhsCode,
        'toWhsCode' => $toWhsCode,
        'docDate' => date('Y-m-d'),
        'docDueDate' => date('Y-m-d'),
        'team_id' => $this->_user->team_id,
        'remark' => get_null($this->input->post('remark')),
        'create_at' => now(),
        'create_by' => $this->_user->id
      );

      $id = $this->transfer_model->add($arr);

      if($id)
      {
        $ds = array(
          'id' => $id,
          'status' => 'success'
        );
      }
      else
      {
        $sc = FALSE;
        set_error(0, "Create Document Failed");
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $this->_json_response($sc, $ds);
  }



  public function edit($id)
  {
    $doc = $this->transfer_model->get($id);

    if( ! empty($doc))
    {
      $ds = array(
        'doc' => $doc,
        'details' => $this->transfer_model->get_details($id),
        'totalQty' => 10,
        'fromWhList' => $this->warehouse_model->get_user_from_warehouse($this->_user->id),
        'toWhList' => $this->warehouse_model->get_user_to_warehouse($this->_user->id)
      );

      if($this->_Outsource)
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


  public function save_item()
  {
    $sc = TRUE;
    $ds = array();

    if($this->input->post())
    {
      $i_path = $this->config->item('image_path').'installed/';
      $u_path = $this->config->item('image_path').'returnned/';
      $iImage = isset( $_FILES['iImage'] ) ? $_FILES['iImage'] : FALSE;
      $uImage = isset( $_FILES['uImage'] ) ? $_FILES['uImage'] : FALSE;

      $transId = $this->input->post('trans_id');
      $transCode = $this->input->post('trans_code');
      $fromWhsCode = $this->input->post('fromWhsCode');
      $toWhsCode = $this->input->post('toWhsCode');
      $iSerial = $this->input->post('iSerial');
      $uSerial = $this->input->post('uSerial');
      $itemCode = $this->input->post('itemCode');
      $itemName = $this->input->post('itemName');

      if( ! empty($fromWhsCode) && ! empty($toWhsCode))
      {
        if( ! empty($iSerial) && ! empty($uSerial))
        {
          if(empty($itemCode) OR empty($itemName))
          {
            $item = $this->transfer_model->getItemBySerial($iSerial);

            if( ! empty($item))
            {
              $itemCode = $item->ItemCode;
              $itemName = $item->ItemName;
            }
          }

          $doc = $this->transfer_model->get($transId);

          if( ! empty($doc))
          {
            if($doc->status < 1)
            {
              $arr = array(
                'transfer_id' => $transId,
                'transfer_code' => $transCode,
                'ItemCode' => $itemCode,
                'ItemName' => $itemName,
                'InstallSerialNum' => $iSerial,
                'ReturnnedSerialNum' => $uSerial,
                'Qty' => 1,
                'fromWhsCode' => $fromWhsCode,
                'toWhsCode' => $toWhsCode,
                'LineStatus' => 'O',
                'create_at' => now(),
                'create_by' => $this->_user->id,
                'install_image' => $i_path . $iSerial . ".jpg",
                'returnned_image' => $u_path . $uSerial . ".jpg"
              );

              $id = $this->transfer_model->add_detail($arr);
              if( ! $id)
              {
                $sc = FALSE;
                set_error('insert');
              }
              else
              {
                if($iImage !== FALSE)
                {
                  $rs = $this->do_upload($iImage, $i_path, $iSerial);

                  if($rs !== TRUE)
                  {
                    $sc = FALSE;
                    set_error(0, $rs);
                  }
                }

                if($uImage !== FALSE)
                {
                  $rs = $this->do_upload($uImage, $u_path, $uSerial);

                  if($rs !== TRUE)
                  {
                    $sc = FALSE;
                    set_error(0, $rs);
                  }
                }

                $ds = array(
                  'id' => $id,
                  'serial' => $iSerial,
                  'itemCode' => $itemCode,
                  'itemName' => $itemName,
                  'image_path' => get_image_path($iSerial, 'installed')
                );
              }
            }
            else
            {
              $sc = FALSE;
              set_error(0, "Invalid Document Status");
            }
          }
          else
          {
            $sc = FALSE;
            set_error(0, "Invalid Document");
          }
        }
        else
        {
          $sc = FALSE;
          set_error(0, "Missing Serial number");
        }
      }
      else
      {
        $sc = FALSE;
        set_error(0, "Missing warehouse");
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }


    $this->_json_response($sc, $ds);
  }

  public function do_upload($file, $path, $name)
	{
    $sc = TRUE;

    $this->load->library('upload');

		$image_path = $path;
    $image 	= new Upload($file);

    if( $image->uploaded )
    {
      $image->file_new_name_body = $name; 		//--- เปลี่ยนชือ่ไฟล์ตาม serial
      $image->image_resize			 = TRUE;		//--- อนุญาติให้ปรับขนาด
      $image->image_retio_fill	 = TRUE;		//--- เติกสีให้เต็มขนาดหากรูปภาพไม่ได้สัดส่วน
      $image->file_overwrite		 = TRUE;		//--- เขียนทับไฟล์เดิมได้เลย
      $image->auto_create_dir		 = TRUE;		//--- สร้างโฟลเดอร์อัตโนมัติ กรณีที่ไม่มีโฟลเดอร์
      //$image->image_x					   = 800;		//--- ปรับขนาดแนวนอน
      $image->image_y					   = 800;		//--- ปรับขนาดแนวตั้ง
      $image->image_ratio_x      = TRUE;  //--- ให้คงสัดส่วนเดิมไว้
      //$image->image_ratio_y      = TRUE;  //--- ให้คงสัดส่วนเดิมไว้
      $image->image_background_color	= "#FFFFFF";		//---  เติมสีให้ตามี่กำหนดหากรูปภาพไม่ได้สัดส่วน
      $image->image_convert			= 'jpg';		//--- แปลงไฟล์

      $image->process($image_path);						//--- ดำเนินการตามที่ได้ตั้งค่าไว้ข้างบน

      if( ! $image->processed )	//--- ถ้าไม่สำเร็จ
      {
        $sc = $image->error;
      }
    } //--- end if

    $image->clean();	//--- เคลียร์รูปภาพออกจากหน่วยความจำ

		return $sc;
	}


  public function get_detail()
  {
    $sc = TRUE;
    $ds = array();
    $id = $this->input->get('id');

    if($id)
    {
      $rs = $this->transfer_model->get_detail($id);

      if( ! empty($rs))
      {
        $ds = array(
          'id' => $rs->id,
          'i_serial' => $rs->InstallSerialNum,
          'u_serial' => $rs->ReturnnedSerialNum,
          'i_item_code' => $rs->ItemCode,
          'i_item_name' => $rs->ItemName,
          'i_image_path' => get_image_path($rs->InstallSerialNum, 'installed'),
          'u_image_path' => get_image_path($rs->ReturnnedSerialNum, 'returnned'),
          'fromWhsCode' => $rs->fromWhsCode,
          'fromWhsName' => $rs->from_warehouse_name,
          'toWhsCode' => $rs->toWhsCode,
          'toWhsName' => $rs->to_warehouse_name,
          'status_label' => transfer_line_status_label($rs->LineStatus)
        );
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
      set_error("required");
    }

    $this->_json_response($sc , $ds);
  }


  public function delete_detail()
  {
    $sc = TRUE;
    $id = $this->input->post('id');

    $detail = $this->transfer_model->get_detail($id);

    if( ! empty($detail))
    {
      if($detail->LineStatus == 'O')
      {
        if( ! $this->transfer_model->delete_detail($id))
        {
          $sc = FALSE;
          set_error('delete');
        }
      }
      else
      {
        $sc = FALSE;
        set_error(0, "Invalid Line status");
      }
    }

    $this->_response($sc);
  }


  function save_document()
  {
    $sc = TRUE;

    $id = $this->input->post('id');

    if($id)
    {
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status == -1 OR $doc->status == 0 OR $doc->status == 3)
        {
          if( ! $this->transfer_model->save_document($id))
          {
            $sc = FALSE;
            set_error(0, "Save document failed");
          }
          else
          {
            $this->load->library('api');

            if( ! $this->api->exportTransfer($id))
            {
              $sc = FALSE;
              set_error(0, "Save Document success but Create Document on SAP Failed");
            }
          }
        }
        else
        {
          $sc = FALSE;

          if($doc->status == 1)
          {
            set_error(0, "Document already saved");
          }

          if($doc->status == 2)
          {
            set_error(0, "Document already cancelled");
          }
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



  public function cancle_document()
  {
    $sc = TRUE;

    $id = $this->input->post('id');

    if(! empty($id))
    {
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status != 1 && $doc->status != 2)
        {
          if( ! $this->transfer_model->cancle_document($id))
          {
            $sc = FALSE;
            set_error(0, "Cancel document failed");
          }
        }
        else
        {
          $sc = FALSE;
          set_error(0, "Cancel failed : Invalid document status");
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
      set_error('required');
    }

    $this->_response($sc);
  }


  public function view_document($id)
  {

  }

  function get_item()
  {
    $sc = TRUE;
    $ds = array();
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      if($data->type == 'i')
      {
        if( ! $this->transfer_model->is_exists_detail($data->serial, $data->type))
        {
          $item = $this->transfer_model->getInstallItemDataBySerial($data->serial, $data->whsCode);

          if( ! empty($item))
          {
            $ds = array(
              'status' => 'success',
              'Serial' => $item->Serial,
              'ItemCode' => $item->ItemCode,
              'ItemName' => $item->ItemName,
              'instock' => number($item->Quantity),
              'whsCode' => $item->WhsCode
            );
          }
          else
          {
            $sc = FALSE;
            $ds = array(
              'status' => 'error',
              'message' => "ไม่พบสินค้าในคลังที่กำหนด : {$data->whsCode}"
            );
          }
        }
        else
        {
          $sc = FALSE;
          $ds = array(
            'status' => 'error',
            'message' => "{$data->serial} ถูกติดตั้งไปแล้ว"
          );
        }
      }
      else
      {
        $item = $this->transfer_model->getReturnItemDataBySerial($data->serial);

        $ds = array(
          'status' => 'success',
          'Serial' => empty($item) ? $data->serial : $item->Serial,
          'ItemCode' => empty($item) ? "" : $item->ItemCode,
          'ItemName' => empty($item) ? "" : $item->ItemName,
          'instock' => 0,
          'whsCode' => 0
        );
      }
    }
    else
    {
      $sc = FALSE;
      $ds = array(
        'status' => 'error',
        'message' => "Invalid Request format"
      );
    }

    echo json_encode($ds);
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


  function clear_filter()
  {
    $filter = array(
			'tr_code',
      'tr_docNum',
      'tr_fromWhCode',
      'tr_toWhCode',
      'tr_status',
      'tr_from_date',
      'tr_to_date',
      'tr_team_id',
      'tr_user'
		);

    return clear_filter($filter);
  }
} //--- end class

 ?>
