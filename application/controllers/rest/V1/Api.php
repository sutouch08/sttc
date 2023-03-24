<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{
  public $ms;
  public $error;
  public $_user;
  public $_SuperAdmin = FALSE;
	public $_Admin = FALSE;
  public $_Lead = FALSE;
  public $_Outsource = TRUE;

  public function __construct()
  {
    parent::__construct();
    $uid = get_cookie('uid');
		$this->_user = $this->user_model->get_user_by_uid($uid);
  }


  public function validate_credentials_post()
	{
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $user = $this->user_model->get_user_credentials($data->uname);

      if( ! empty($user))
      {
        if(password_verify($data->pwd, $user->pwd))
        {
          if($user->active == 1)
          {
            $ds = array(
  						'uid' => $user->uid,
              'userId' => $user->id,
  						'uname' => $user->uname,
  						'displayName' => $user->name,
  						'ugroup' => $user->ugroup,
  						'teamName' => $this->user_model->get_user_team_name($user->team_id),
  						'team_id' => $user->team_id,
  						'fromWhsCode' => $user->fromWhsCode,
  						'toWhsCode' => $user->toWhsCode
  					);

            $time = intval(86400); //-- 1 days

      			$times = $time * 3650 ; //--- 10 years

            foreach($ds as $key => $val)
            {
              $cookie = array(
                'name' => $key,
                'value' => $val,
                'expire' => $times,
                'path' => '/'
              );

              $this->input->set_cookie($cookie);
            }
          }
          else
          {
            $sc = FALSE;
            $this->error = "บัญชีของคุณถูกระงับ กรุณาติดต่อผู้ดูแลระบบ";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "ชื่อผู้ใช้งานไม่ถูกต้อง";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing required parameter";
    }

    $arr = array(
      'result' => $sc === TRUE ? 'success' : $this->error
    );

    $this->response($arr, 200);
	}



  public function check_current_password_post()
  {
    $sc = TRUE;
    $ms = 'invalid';
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $rs = $this->user_model->get_user_credentials($data->uname);

      if( ! empty($rs))
      {
        if(password_verify($data->pwd, $rs->pwd))
        {
          $ms = 'valid';
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Invalid Username";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $arr = array(
      'result' => $sc === TRUE ? $ms : $this->error
    );

    $this->response($arr, 200);
  }



  public function change_pwd_post()
  {
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));
    if( ! empty($data))
    {
      if($data->uname == $this->_user->uname)
      {
        if(password_verify($data->pwd, $this->_user->pwd))
        {
          $arr = array(
  					'pwd' => password_hash($data->new_pwd, PASSWORD_DEFAULT),
  					'last_pass_change' => date('Y-m-d'),
  					'force_reset' => 0
  				);

  				//--- update last pass change
  				if( ! $this->user_model->update($this->_user->id, $arr))
  				{
  					$sc = FALSE;
  					$this->error = "เปลี่ยนรหัสผ่านไม่สำเร็จ";
  				}
        }
        else
        {
          $sc = FALSE;
          $this->error = "Invalid Current Password";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Username Missmatch";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $arr = array(
      'result' => $sc === TRUE ? 'success' : $this->error
    );

    $this->response($arr, 200);
  }



  public function user_data_post()
  {
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $user = $this->user_model->get_by_uname($data->uname);

      if(empty($user))
      {
        $sc = FALSE;
        $this->error = "User Not Found !";
      }
      else
      {
        $user->use_strong_pwd = getConfig('USE_STRONG_PWD') == 1 ? 1 : 0;
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing Required parameter";
    }

    if($sc === TRUE)
    {
      $this->response($user, 200);
    }
    else
    {
      $this->response($this->error, 200);
    }
  }


  public function get_transfer_list_post()
  {
    $this->load->model('inventory/transfer_model');
    $this->load->helper('transfer');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    $filter = array(
      'code' => $data->code,
      'serial' => $data->serial,
      'from_date' => $data->fromDate,
      'to_date' => $data->toDate,
      'status' => $data->status
    );

    $perpage = $data->perpage;
    $offset = $data->offset;
    $rows = $this->transfer_model->count_rows($filter);

    //$init	= pagination_config("javascript:void(0)", $rows, $perpage, $offset);
    //$this->pagination->initialize($init);

    $ds = $this->transfer_model->get_list($filter, $perpage, $offset);
    $dataset = array();

    if( ! empty($ds))
    {
      foreach($ds as $rs)
      {
        $arr = array(
          'id' => $rs->id,
          'date_add' => thai_date($rs->date_add),
          'code' => $rs->code,
          'serial' => $rs->InstallSerialNum,
          'teamName' => $rs->team_name,
          'statusLabel' => transfer_status_label($rs->status),
          'remark' => $rs->remark,
          'uname' => $rs->uname
        );

        array_push($dataset, $arr);
      }
    }

    $filter['data'] = $dataset;
    $filter['rows'] = $rows;
    //$filter['pagination'] = $this->pagination->create_links();

    $this->response($filter, 200);
  }


  public function view_detail_post()
  {
    $this->load->model('inventory/transfer_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $rs = $this->transfer_model->get($data->id);
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
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing Required Parameter";
    }

    if($sc === TRUE)
    {
      $this->response($arr, 200);
    }
    else
    {
      $this->response($this->error, 200);
    }
  }


  public function add_transfer_post()
  {
    $this->load->model('inventory/transfer_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $fromWhsCode = $data->fromWhsCode;
      $toWhsCode = $data->toWhsCode;
      $itemCode = $data->itemCode;
      $itemName = $data->itemName;
      $iSerial = $data->iSerial;
      $uSerial = $data->uSerial;
      $peaNo = $data->peaNo;
      $powerNo = $data->runNo;
      $mYear = $data->mYear;
      $cond = $data->cond;
      $iImage = $data->iImage;
      $uImage = $data->uImage;
      $uOrientation = $data->uOrientation;
      $iOrientation = $data->iOrientation;
      $fromDoc = get_null($data->fromDoc);
      $remark = get_null(trim($data->remark));
      $usageAge = $data->usageAge;

      $i_path = $this->config->item('image_path')."installed/{$iSerial}.jpg";
      $u_path = $this->config->item('image_path')."returnned/{$uSerial}.jpg";

      $code = $this->get_new_transfer_code();

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
        $this->transfer_model->set_valid_item($this->_user->id, $iSerial);

        if($this->createImage($uImage, $u_path, $uOrientation ) === FALSE)
        {
          $sc = FALSE;
          set_error(0, "Create Returnned Image Failed");
        }

        if($this->createImage($iImage, $i_path, $iOrientation ) === FALSE)
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

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'error',
      'message' => $sc === TRUE ? 'success' : $this->error
    );

    $this->response($arr, 200);
  }



  public function cancle_transfer_post()
  {
    $this->load->model('inventory/transfer_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $id = $data->id;
      $user_id = $data->user_id;
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status != 1 && $doc->status != 2)
        {
          $this->db->trans_begin();

          if( ! $this->transfer_model->cancle_document($id))
          {
            $sc = FALSE;
            set_error(0, "Cancel document failed");
          }
          else
          {
            if( ! $this->transfer_model->unvalid_item($user_id, $doc->InstallSerialNum))
            {
              $sc = FALSE;
              $this->error = "Change Item status failed";
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
          set_error(0, "Cancel failed : Invalid document status");
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
      set_error('required');
    }

    $ds = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error
    );

    $this->response($ds, 200);
  }


  public function update_user_item_post()
  {
    $this->load->model('inventory/transfer_model');
    $this->load->model('inventory/user_item_model');
    $this->load->model('admin/warehouse_model');
    $sc = TRUE;
    $ds = array();
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $list = $this->transfer_model->getSapTransferSerialDetails($data->docNum);

      if( ! empty($list))
      {
        $this->db->trans_begin();

        $this->user_item_model->drop_open_item($data->docNum, $this->_user->id);

        foreach($list as $rs)
        {
          if($sc === FALSE)
          {
            break;
          }

          $arr = array(
            'user_id' => $this->_user->id,
            'serial' => $rs->Serial,
            'ItemCode' => $rs->ItemCode,
            'ItemName' => $rs->ItemName,
            'DocNum' => $data->docNum,
            'WhsCode' => $rs->WhsCode,
            'status' => 0,
            'date_add' => now(),
            'date_upd' => NULL
          );

          if( ! $this->user_item_model->is_exists($data->docNum, $this->_user->id, $rs->Serial))
          {
            if( ! $this->transfer_model->add_user_item($arr))
            {
              $sc = FALSE;
              $this->error = "บันทึกรายการเข้าส่วนกลางไม่สำเร็จ";
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
        $this->error = "ไม่พบรายการสินค้าในเอกสาร {$data->docNum}";
      }

    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $ds = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error
    );


    $this->response($ds, 200);
  }

  // public function update_user_item_post()
  // {
  //   $this->load->model('inventory/transfer_model');
  //   $this->load->model('admin/warehouse_model');
  //   $sc = TRUE;
  //   $ds = array();
  //   $data = json_decode(file_get_contents('php://input'));
  //
  //   if( ! empty($data))
  //   {
  //     //--- check item already loaded by someone ?
  //     if( ! $this->transfer_model->is_loaded($data->docNum))
  //     {
  //       $list = $this->transfer_model->getSapTransferSerialDetails($data->docNum);
  //
  //       if( ! empty($list))
  //       {
  //         $this->db->trans_begin();
  //
  //         foreach($list as $rs)
  //         {
  //           if($sc === FALSE)
  //           {
  //             break;
  //           }
  //
  //           $arr = array(
  //             'user_id' => get_cookie('userId'),
  //             'serial' => $rs->Serial,
  //             'ItemCode' => $rs->ItemCode,
  //             'ItemName' => $rs->ItemName,
  //             'DocNum' => $data->docNum,
  //             'WhsCode' => $rs->WhsCode,
  //             'status' => 0,
  //             'date_add' => now(),
  //             'date_upd' => NULL
  //           );
  //
  //           if( ! $this->transfer_model->add_user_item($arr))
  //           {
  //             $sc = FALSE;
  //             $this->error = "บันทึกรายการเข้าส่วนกลางไม่สำเร็จ";
  //           }
  //         }
  //
  //         if($sc === TRUE)
  //         {
  //           $this->db->trans_commit();
  //         }
  //         else
  //         {
  //           $this->db->trans_rollback();
  //         }
  //       }
  //       else
  //       {
  //         $sc = FALSE;
  //         $this->error = "ไม่พบรายการสินค้าในเอกสาร {$data->docNum}";
  //       }
  //     }
  //     else
  //     {
  //       $sc = FALSE;
  //       $this->error = "{$data->docNum} ถูกโหลดไปแล้ว";
  //     }
  //   }
  //   else
  //   {
  //     $sc = FALSE;
  //     set_error('required');
  //   }
  //
  //   $ds = array(
  //     'status' => $sc === TRUE ? 'success' : 'failed',
  //     'message' => $sc === TRUE ? 'success' : $this->error
  //   );
  //
  //
  //   $this->response($ds, 200);
  // }




  public function delete_open_user_items_post()
  {
    $this->load->model('inventory/transfer_model');
    $sc = TRUE;
    $user_id = get_cookie('userId');
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data) && ! empty($user_id))
    {
      if( ! $this->transfer_model->delete_open_user_items($user_id, $data->docNum))
      {
        $sc = FALSE;
        $this->error = "Delete failed";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error
    );

    $this->response($arr, 200);
  }



  public function get_transfer_details_post()
  {
    $this->load->model('inventory/transfer_model');
    $this->load->model('admin/warehouse_model');

    $sc = TRUE;
    $exists = FALSE;
    $data = json_decode(file_get_contents('php://input'));
    $ds = array();

    if( ! empty($data))
    {
      //$doc = $this->transfer_model->getSapDoc($data->docNum);
      $doc = array('docEntry' => 2066);

      if( ! empty($doc))
      {
        //if($doc->Filler == $this->_user->fromWhsCode)

        if($data->docNum)
        {
          //-- check exists data loaded
          if( ! $this->transfer_model->is_loaded($data->docNum) OR $data->reload == 'Y')
          {
            $details = $this->transfer_model->getSapTransferSerialDetails($data->docNum);

            if( ! empty($details))
            {
              $no = 1;

              foreach($details as $rs)
              {
                $arr = array(
                  'no' => $no,
                  'DocNum' => $data->docNum,
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
            $exists = TRUE;
            $this->error = "{$data->docNum} ถูกโหลดไปแล้ว";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "คลังของเอกสารไม่ตรงกับคลังของผู้ใช้งาน";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Invalid Document Number";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : ($exists == TRUE ? 'exists' : 'failed'),
      'message' => $sc === TRUE ? 'success' : $this->error,
      'data' => $sc === TRUE ? $ds : NULL
    );

    $this->response($arr, 200);
  }


  public function sync_user_items_post()
  {
    $this->load->model('inventory/transfer_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents('php://input'));
    $ds = array();

    if( ! empty($data))
    {
      $details = $this->transfer_model->get_open_user_items($data->user_id);

      if( ! empty($details))
      {
        $no = 1;

        foreach($details as $rs)
        {
          $arr = array(
            'no' => $no,
            'DocNum' => $rs->DocNum,
            'Serial' => $rs->serial,
            'ItemCode' => $rs->ItemCode,
            'ItemName' => $rs->ItemName,
            'WhsCode' => $rs->WhsCode
          );

          array_push($ds, $arr);
          $no++;
        }
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'data' => $sc === TRUE ? $ds : ""
    );

    $this->response($arr, 200);
  }


  public function get_return_list_post()
  {
    $this->load->model('inventory/return_product_model');
    $this->load->helper('transfer');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    $filter = array(
      'code' => $data->code,
      'from_date' => $data->fromDate,
      'to_date' => $data->toDate,
      'status' => $data->status
    );

    $perpage = $data->perpage;
    $offset = $data->offset;
    $rows = $this->return_product_model->count_rows($filter);

    $init	= pagination_config("#", $rows, $perpage, $offset);
    $this->pagination->initialize($init);

    $ds = $this->return_product_model->get_list($filter, $perpage, $offset);
    $dataset = array();

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

        array_push($dataset, $arr);
      }
    }

    $filter['data'] = $dataset;
    $filter['pagination'] = $this->pagination->create_links();

    $this->response($filter, 200);
  }


  public function getConfig_post()
  {
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $this->response(getConfig($data->config_code), 200);
    }
    else
    {
      $this->response(NULL, 200);
    }
  }


  public function get_new_transfer_code($date = NULL)
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


  public function get_new_return_code($date = NULL)
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


  public function createImage($imageObject, $path, $orientation = 1)
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

      $image = imagecreatefromstring($imageData);
      $image_rotate = ($orientation == 3 ? 180 : ($orientation == 6 ? 90 : ($orientation == 8 ? -90 : NULL)));
      $source = $image_rotate != NULL ? imagerotate($image, $image_rotate, 0) : $image;
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



  public function new_return_post()
  {
    $this->load->model('inventory/return_product_model');
    $sc = TRUE;

    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $remark = get_null(trim($data->remark));
      $date_add = db_date($data->date_add);
      $code = $this->get_new_return_code($date_add);

      $arr = array(
        'code' => $code,
        'date_add' => $date_add,
        'whsCode' => $data->whsCode,
        'create_at' => now(),
        'create_by' => $this->_user->id,
        'team_id' => $this->_user->team_id,
        'remark' => $remark
      );

      $id = $this->return_product_model->add($arr);

      if( ! $id)
      {
        $sc = FALSE;
        set_error('insert');
      }
    }
    else
    {
      $sc = FALSE;
      set_error("required");
    }

    $ds = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'id' => $sc === TRUE ? $id : NULL
    );

    $this->response($ds, 200);
  }



  public function get_return_detail_post()
  {
    $this->load->model('inventory/return_product_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $doc = $this->return_product_model->get($data->id);

      if( ! empty($doc))
      {
        $ds = array(
          'header' => $doc,
          'details' => $this->return_product_model->get_details($data->id)
        );

      }
      else
      {
        $sc = FALSE;
        $this->error = "ไม่พบรายการ";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing Required Parameter";
    }

    if($sc === TRUE)
    {
      $this->response($ds, 200);
    }
    else
    {
      $this->response($this->error, 200);
    }
  }


  public function add_return_row_post()
  {
    $this->load->model('inventory/return_product_model');

    $sc = TRUE;
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $doc = $this->return_product_model->get($data->return_id);

      if( ! empty($doc))
      {
        if($doc->status == -1 OR $doc->status == 0)
        {
          if( ! $this->return_product_model->is_exists_detail($data->return_id, $data->serial) )
          {
            $arr = array(
              'return_id' => $data->return_id,
              'return_code' => $data->return_code,
              'ItemCode' => $data->ItemCode,
              'ItemName' => $data->ItemName,
              'WhsCode' => $data->WhsCode,
              'Qty' => 1,
              'fromDoc' => $data->docNum,
              'Serial' => $data->serial
            );

            if( ! $this->return_product_model->add_detail($arr))
            {
              $sc = FALSE;
              $this->error = "Insert return row failed";
            }
            else
            {
              $this->return_product_model->update_user_item($this->_user->id, $data->serial);

              $details = $this->return_product_model->get_details($data->return_id);
            }
          }
          else
          {
            $sc = FALSE;
            $this->error = "{$data->serial} already exists";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "สถานะเอกสารไม่ถูกต้อง";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "เลขที่เอกสารไม่ถูกต้อง";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $ds = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'data' => $sc === TRUE ? $details : NULL
    );

    $this->response($ds, 200);
  }


} //--- end class
?>
