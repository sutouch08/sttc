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

    $this->load->view('inventory/transfer/transfer_list', $filter);
  }



  public function get_list()
  {
		$filter = array(
			'code' => $this->input->post('code'),
      'from_date' => $this->input->post('fromDate'),
      'to_date' => $this->input->post('toDate'),
      'status' => $this->input->post('status')
		);

    //$filter['create_by'] = $this->_user->id;

		//--- แสดงผลกี่รายการต่อหน้า
		// $perpage = $this->input->post('perpage');
    // $offset = $this->input->post('offset');
    //
    $perpage = $this->input->post('perpage');
    $offset = $this->input->post('offset');
    $rows = $this->transfer_model->count_rows($filter);

		// $rows = $this->transfer_model->count_doc_rows($filter);
    $init	= pagination_config("#", $rows, $perpage, $offset);
    $this->pagination->initialize($init);

    $ds = $this->transfer_model->get_list($filter, $perpage, $offset);
    $data = array();

    if( ! empty($ds))
    {
      foreach($ds as $rs)
      {
        $arr = array(
          'id' => $rs->id,
          'date_add' => thai_date($rs->date_add),
          'code' => $rs->code,
          'teamName' => $rs->team_name,
          'statusLabel' => transfer_status_label($rs->status),
          'remark' => $rs->remark,
          'uname' => $rs->uname
        );

        array_push($data, $arr);
      }
    }

		$filter['data'] = $data;


    $filter['pagination'] = $this->pagination->create_links();

    echo json_encode($filter);
  }



  public function checkin()
  {
    $this->load->view('inventory/transfer/check_in');
  }


  public function getTransferDetail()
  {
    $sc = TRUE;
    $ds = array();
    $docNum = $this->input->get('docNum');

    if( ! empty($docNum))
    {
      $warehouse = $this->warehouse_model->get_user_from_warehouse($this->_user->id);
      $uWh = array();

      if(! empty($warehouse))
      {
        foreach($warehouse as $wh)
        {
          $uWh[] = $wh->code;
        }

        //$doc = $this->transfer_model->getSapDoc($docNum, $uWh);
        $doc = array('docEntry' => 2066);

        if( ! empty($doc))
        {
          $details = $this->transfer_model->getSapTransferSerialDetails($docNum);

          if( ! empty($details))
          {
            $no = 1;
            foreach($details as $rs)
            {
              $arr = array(
                'no' => $no,
                'DocNum' => $docNum,
                'Serial' => $rs->Serial,
                'ItemCode' => $rs->ItemCode,
                'ItemName' => $rs->ItemName,
                'WhsCode' => $rs->WhsCode
              );

              array_push($ds, $arr);
              $no++;
            }
          }
          else
          {
            $sc = FALSE;
            set_error(0, "ไม่พบรายการสินค้าในเอกสาร {$docNum}");
          }
        }
        else
        {
          $sc = FALSE;
          set_error(0, "ไม่พบเอกสาร {$docNum}");
        }
      }
      else
      {
        $sc = FALSE;
        set_error(0, "คุณยังไม่ได้ผูกคลังสินค้า");
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $this->_json_response($sc, $ds);
  }



  public function add_new()
  {
    $ds = array(
      'fromWhList' => $this->warehouse_model->get_user_from_warehouse($this->_user->id),
      'toWhList' => $this->warehouse_model->get_user_to_warehouse($this->_user->id)
    );

    $this->load->view('inventory/transfer/transfer_add', $ds);
  }



  public function add()
  {
    $sc = TRUE;

    if($this->input->post())
    {
      $fromWhsCode = $this->input->post('fromWhsCode');
      $toWhsCode = $this->input->post('toWhsCode');
      $itemCode = $this->input->post('itemCode');
      $itemName = $this->input->post('itemName');
      $iSerial = $this->input->post('iSerial');
      $uSerial = $this->input->post('uSerial');
      $peaNo = $this->input->post('peaNo');
      $powerNo = $this->input->post('runNo');
      $mYear = $this->input->post('mYear');
      $cond = $this->input->post('cond');
      $iImage = $this->input->post('iImage');
      $uImage = $this->input->post('uImage');
      $fromDoc = get_null($this->input->post('fromDoc'));
      $remark = get_null(trim($this->input->post('remark')));
      $usageAge = $this->input->post('usageAge');

      $i_path = $this->config->item('image_path')."installed/{$iSerial}.jpg";
      $u_path = $this->config->item('image_path')."returnned/{$uSerial}.jpg";

      $code = $this->get_new_code();

      $arr = array(
        'date_add' => date('Y-m-d'),
        'code' => $code,
        'ItemCode' => $itemCode,
        'ItemName' => $itemName,
        'InstallSerialNum' => $iSerial,
        'ReturnnedSerialNum' => $uSerial,
        'Qty' => 1,
        'fromWhsCode' => $fromWhsCode,
        'toWhsCode' => $toWhsCode,
        'install_image' => $i_path,
        'returnned_image' => $u_path,
        'peaNo' => $peaNo,
        'powerNo' => $powerNo,
        'mYear' => $mYear,
        'cond' => $cond,
        'usageAge' => $usageAge,
        'status' => 0,
        'remark' => $remark,
        'team_id' => $this->_user->team_id,
        'create_at' => now(),
        'create_by' => $this->_user->id,
        'fromDoc' => $fromDoc
      );

      if( ! $this->transfer_model->add($arr))
      {
        $sc = FALSE;
        set_error(0, "Create Document Failed");
      }
      else
      {
        if($this->createImage($uImage, $u_path ) === FALSE)
        {
          $sc = FALSE;
          set_error(0, "Create Returnned Image Failed");
        }

        if($this->createImage($iImage, $i_path ) === FALSE)
        {
          $sc = FALSE;
          set_error(0, "Create Installed Image Failed");
        }
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $this->_response($sc);
  }


  public function createImage($imageObject, $path)
  {
    if( ! empty($imageObject))
    {
      $img = explode(',', $imageObject);
      $count = count($img);
      if($count == 1)
      {
        $imageData = base64_decode($img[0]);
      }
      else
      {
        $imageData = base64_decode($img[1]);
      }

      $source = imagecreatefromstring($imageData);
      return imagejpeg($source, $path, 100);
    }

    return FALSE;
  }


  public function readImage($path)
  {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    return $base64;
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
      $iOrientation = $this->input->post('iOrientation');
      $uOrientation = $this->input->post('uOrientation');

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
            //$item = $this->transfer_model->getItemBySerial($iSerial);

            $item = array(
              "Serial" => $iSerial,
              "ItemCode" => "FG-7-01003",
              "ItemName" => "Optical probe for meter communication",
              "Quantity" => 1,
              "WhsCode" => "2-PD"
            );

            $item = (object) $item;

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
                  $rs = $this->do_upload($iImage, $i_path, $iSerial, $iOrientation);

                  if($rs !== TRUE)
                  {
                    $sc = FALSE;
                    set_error(0, $rs);
                  }
                }

                if($uImage !== FALSE)
                {
                  $rs = $this->do_upload($uImage, $u_path, $uSerial, $uOrientation);

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

  public function do_upload($file, $path, $name, $rotation = 1)
	{
    $sc = TRUE;

    $this->load->library('upload');

		$image_path = $path;
    $image 	= new Upload($file);

    if( $image->uploaded )
    {
      //$exif = exif_read_data($file->name);
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
      $image->image_rotate = ($rotation == 3 ? 180 : ($rotation == 6 ? 90 : ($rotation == 8 ? -90 : NULL)));

      $image->process($image_path);						//--- ดำเนินการตามที่ได้ตั้งค่าไว้ข้างบน

      if( ! $image->processed )	//--- ถ้าไม่สำเร็จ
      {
        $sc = $image->error;
      }
    } //--- end if

    $image->clean();	//--- เคลียร์รูปภาพออกจากหน่วยความจำ

		return $sc;
	}



  function approve()
  {
    $sc = TRUE;

    $id = $this->input->post('id');

    if($id)
    {
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status == 0 OR $doc->isApprove == 0)
        {
          $arr = array(
            'isApprove' => 1,
            'approver' => $this->_user->uname
          );

          if( ! $this->transfer_model->update($id, $arr))
          {
            $sc = FALSE;
            set_error(0, "อนุมัติเอกสารไม่สำเร็จ");
          }
          else
          {
            $this->load->library('api');

            if( ! $this->api->exportTransfer($id))
            {
              $sc = FALSE;
              set_error(0, "อนัมัติเอกสารสำเร็จแต่ส่งข้อมูลเข้า SAP ไม่สำเร็จ กรุณากดส่งข้อมูลอีกครั้งภายหลัง");
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



  public function get_row($id)
  {
    $sc = TRUE;
    $rs = $this->transfer_model->get($id);

    if( ! empty($rs))
    {
      $ds = array(
        "id" => $rs->id,
        "date_add" => thai_date($rs->date_add, FALSE),
        "code" => $rs->code,
        "i_serial" => $rs->InstallSerialNum,
        "fromWhs" => $rs->fromWhsCode." : ".$rs->from_warehouse_name,
        "toWhs" => $rs->toWhsCode." : ".$rs->to_warehouse_name,
        "uname" => $rs->uname,
        "teamName" => $rs->team_name,
        "docNum" => $rs->docNum,
        "status_label" => transfer_status_label($rs->status)
      );
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการ";
    }

    $this->_json_response($sc, $ds);
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


  public function view_detail($id)
  {
    $sc = TRUE;

    $rs = $this->transfer_model->get($id);

    if( ! empty($rs))
    {
      $arr = array(
        "id" => $rs->id,
        "date_add" => thai_date($rs->date_add, FALSE),
        "code" => $rs->code,
        "itemCode" => $rs->ItemCode,
        "itemName" => $rs->ItemName,
        "iSerial" => $rs->InstallSerialNum,
        "uSerial" => $rs->ReturnnedSerialNum,
        "fromWhsCode" => $rs->fromWhsCode,
        "toWhsCode" => $rs->toWhsCode,
        "i_image_path" => $rs->install_image,
        "u_image_path" => $rs->returnned_image,
        "i_image_data" => $this->readImage($rs->install_image),
        "u_image_data" => $this->readImage($rs->returnned_image),
        "peaNo" => $rs->peaNo,
        "powerNo" => $rs->powerNo,
        "mYear" => $rs->mYear,
        "cond" => $rs->cond,
        "usageAge" => $rs->usageAge,
        "status" => $rs->status,
        "fromDoc" => $rs->fromDoc
      );
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการ";
    }

    $this->_json_response($sc, $arr);
  }




  function get_item($id)
  {
    $sc = TRUE;
    $ds = array();
    $rs = $this->transfer_model->get($id);

    if( ! empty($rs))
    {
      $ds = array(
        "id" => $rs->id,
        "code" => $rs->code,
        "item_code" => $rs->ItemCode,
        "item_name" => $rs->ItemName,
        "i_serial" => $rs->InstallSerialNum,
        "fromWhsCode" => $rs->fromWhsCode,
        "fromWhsName" => $rs->from_warehouse_name,
        "toWhsCode" => $rs->toWhsCode,
        "toWhsName" => $rs->to_warehouse_name,
        "i_image_path" => base_url().$rs->install_image,
        "u_serial" => $rs->ReturnnedSerialNum,
        "pea_no" => $rs->peaNo,
        "power_no" => $rs->powerNo,
        "mYear" => $rs->mYear,
        "cond" => condLabel($rs->cond),
        "color" => condLabelColor($rs->usageAge, $rs->cond),
        "usageAge" => $rs->usageAge,
        "u_image_path" => base_url().$rs->returnned_image,
        "status" => $rs->status,
        "is_approve" => $rs->isApprove,
        "approver" => $rs->approver
      );
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการ";
    }

    echo $sc === TRUE ? json_encode($ds) : $this->error;
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
