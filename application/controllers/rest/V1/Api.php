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

  public function is_expire_password($last_pass_change)
	{
		$today = date('Y-m-d');

		$last_change = empty($last_pass_change) ? date('2021-01-01') : $last_pass_change;

		$expire_days = intval(getConfig('USER_PASSWORD_AGE'));

		if($expire_days != 0)
		{
			$expire_date = date('Y-m-d', strtotime("+{$expire_days} days", strtotime($last_change)));

			if($today > $expire_date)
			{
				return true;
			}
		}

		return FALSE;
	}

  public function validate_credentials_post()
	{
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $user = $this->user_model->get_by_uname($data->uname);

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
  						'team_id' => $user->team_id,
  						'teamName' => $user->team_name,
  						'team_group_id' => $user->team_group_id,
  						'team_group_name' => $user->team_group_name,
  						'can_get_meter' => $user->can_get_meter,
  						'fromWhsCode' => $user->fromWhsCode,
  						'toWhsCode' => $user->toWhsCode,
              'is_strong_pwd' => getConfig('USE_STRONG_PWD'),
              'is_expire_pwd' => $this->is_expire_password($user->last_pass_change)
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
			'status' => $sc === TRUE ? 'success' : 'failed',
			'message' => $sc === TRUE ? 'success' : $this->error,
			'userdata' => $sc === TRUE ? $ds : NULL
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
      $rs = $this->user_model->get_user_by_uid($data->uid);

      if( ! empty($rs))
      {
        $ds = array(
          'uid' => $rs->uid,
          'userId' => $rs->id,
          'uname' => $rs->uname,
          'displayName' => $rs->name,
          'ugroup' => $rs->ugroup,
          'team_id' => $rs->team_id,
          'teamName' => $rs->team_name,
          'team_group_id' => $rs->team_group_id,
          'team_group_name' => $rs->team_group_name,
          'can_get_meter' => $rs->can_get_meter,
          'fromWhsCode' => $rs->fromWhsCode,
          'from_warehouse_name' => $rs->from_warehouse_name,
          'toWhsCode' => $rs->toWhsCode,
          'to_warehouse_name' => $rs->to_warehouse_name,
          'is_strong_pwd' => getConfig('USE_STRONG_PWD'),
          'is_expire_pwd' => $this->is_expire_password($rs->last_pass_change),
          'scanType' => getConfig('SCANTYPE')
        );
      }
      else
      {
        $sc = FALSE;
        $this->error = "User Not Found !";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing Required parameter";
    }

    $arr = array(
			'status' => $sc === TRUE ? 'success' : 'failed',
			'message' => $sc === TRUE ? 'success' : $this->error,
			'userdata' => $sc === TRUE ? $ds : NULL
		);

    $this->response($arr, 200);
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

    $this->response($filter, 200);
  }


  public function view_detail_post()
  {
    $this->load->model('inventory/transfer_model');
    $this->load->model('admin/damaged_model');
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
          "damage_id" => $rs->damage_id,
          "damage_name" => $this->damaged_model->get_name($rs->damage_id),
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
      $damage_id = empty($data->damage_id) ? NULL : get_null($data->damage_id);
      $iImage = $data->iImage;
      $uImage = $data->uImage;
      $uOrientation = $data->uOrientation;
      $iOrientation = $data->iOrientation;
      $fromDoc = get_null($data->fromDoc);
      $remark = get_null(trim($data->remark));
      $usageAge = $data->usageAge;
      $pea_verify = empty($data->pea_verify) ? $this->verify_pea_no($peaNo) : $data->pea_verify;

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
        'damage_id' => $damage_id,
        'usageAge' => $usageAge,
        'status' => 0,
        'remark' => $remark,
        'team_id' => $this->_user->team_id,
        'create_at' => now(),
        'create_by' => $this->_user->id,
        'fromDoc' => $fromDoc,
        'orientation' => $iOrientation,
        'pea_verify' => $pea_verify
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
    $this->ms = $this->load->database('ms', TRUE);
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
            'team_id' => $this->_user->team_id,
            'team_group_id' => $this->_user->team_group_id,
            'pea_no' => $rs->PeaNo,
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




  public function delete_open_team_group_items_post()
  {
    $this->load->model('inventory/transfer_model');
    $sc = TRUE;
    $team_group_id = $this->_user->team_group_id;

    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data) && ! empty($user_id))
    {
      if( ! $this->transfer_model->delete_open_team_group_items($team_group_id, $data->docNum))
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



  public function sync_team_group_work_list_post()
  {
    $sc = TRUE;
    $this->load->model('inventory/work_list_model');
    $data = json_decode(file_get_contents('php://input'));
    $ds = array();

    if( ! empty($data))
    {
      $details = $this->work_list_model->get_open_work_list_by_team_group($data->team_group_id);

      if( ! empty($details))
      {
        foreach($details as $rs)
        {
          $arr = array(
            'id' => $rs->id,
            'pea_no' => $rs->pea_no,
            'cust_route' => $rs->cust_route,
            'cust_no' => $rs->cust_no,
            'ca_no' => $rs->ca_no,
            'cust_name' => $rs->cust_name,
            'cust_address' => $rs->cust_address,
            'cust_tel' => $rs->cust_tel,
            'age_meter' => $rs->age_meter
          );

          array_push($ds, $arr);
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
      'data' => $sc === TRUE ? $ds : NULL
    );

    $this->response($arr, 200);
  }



  public function get_open_work_list_by_pea_no_post()
  {
    $sc = TRUE;
    $this->load->model('inventory/work_list_model');

    $data = json_decode(file_get_contents('php://input'));
    $ds = array();

    if( ! empty($data) && ! empty($data->team_group_id) && ! empty($data->pea_no))
    {
      $rs = $this->work_list_model->get_work_list_by_pea_no($data->pea_no);

      if( ! empty($rs))
      {
        if($rs->team_group_id == $data->team_group_id)
        {
          if($rs->status == 'P' OR $rs->status == 'R' OR $rs->status== 'U')
          {
            $ds = array(
              'id' => $rs->id,
              'pea_no' => $rs->pea_no,
              'cust_route' => $rs->cust_route,
              'cust_no' => $rs->cust_no,
              'ca_no' => $rs->ca_no,
              'cust_name' => $rs->cust_name,
              'cust_address' => $rs->cust_address,
              'cust_tel' => $rs->cust_tel,
              'age_meter' => $rs->age_meter
            );
          }
          else
          {
            $sc = FALSE;
            $this->error = "ใบสั่งงานถูกดำเนินการไปแล้ว";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "ใบสั่งงานไม่ตรงกับทีมติดต้้ง";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Pea No ไม่ถูกต้อง";
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
      'data' => $sc === TRUE ? $ds : NULL
    );

    $this->response($arr, 200);
  }



  public function get_transfer_details_post()
  {
    $this->ms = $this->load->database('ms', TRUE);
    $this->load->model('inventory/transfer_model');
    $this->load->model('admin/warehouse_model');

    $sc = TRUE;
    $exists = FALSE;
    $data = json_decode(file_get_contents('php://input'));
    $ds = array();

    if( ! empty($data))
    {
      $doc = $this->transfer_model->getSapDoc($data->docNum);
      //$doc = array('docEntry' => 2066);

      if( ! empty($doc))
      {
        //if($data->docNum)
        if($doc->toWhsCode == $this->_user->fromWhsCode)
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
                  'PeaNo' => $rs->PeaNo,
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
              set_error(0, "ไม่พบรายการสินค้าในเอกสาร {$data->docNum}");
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


  public function sync_team_group_items_post()
  {
    $this->load->model('inventory/user_item_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents('php://input'));
    $ds = array();

    if( ! empty($data))
    {
      $details = $this->user_item_model->get_open_team_group_items($data->team_group_id);

      if( ! empty($details))
      {
        $no = 1;

        foreach($details as $rs)
        {
          $arr = array(
            'no' => $no,
            'DocNum' => $rs->DocNum,
            'PeaNo' => $rs->pea_no,
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


  // public function sync_user_items_post()
  // {
  //   $this->load->model('inventory/user_item_model');
  //   $sc = TRUE;
  //   $data = json_decode(file_get_contents('php://input'));
  //   $ds = array();
  //
  //   if( ! empty($data))
  //   {
  //     $details = $this->user_item_model->get_open_user_items($data->user_id);
  //
  //     if( ! empty($details))
  //     {
  //       $no = 1;
  //
  //       foreach($details as $rs)
  //       {
  //         $arr = array(
  //           'no' => $no,
  //           'DocNum' => $rs->DocNum,
  //           'Serial' => $rs->serial,
  //           'ItemCode' => $rs->ItemCode,
  //           'ItemName' => $rs->ItemName,
  //           'WhsCode' => $rs->WhsCode
  //         );
  //
  //         array_push($ds, $arr);
  //         $no++;
  //       }
  //     }
  //   }
  //   else
  //   {
  //     $sc = FALSE;
  //     set_error('required');
  //   }
  //
  //   $arr = array(
  //     'status' => $sc === TRUE ? 'success' : 'failed',
  //     'message' => $sc === TRUE ? 'success' : $this->error,
  //     'data' => $sc === TRUE ? $ds : ""
  //   );
  //
  //   $this->response($arr, 200);
  // }


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


  public function verify_pea_no($pea_no)
  {
    $this->load->model('inventory/transfer_model');

    $pea = $this->transfer_model->get_pea_data($pea_no);

    if( ! empty($pea))
    {
      return 1;
    }

    return 0;
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
      $image_rotate = ($orientation == 3 ? 180 : ($orientation == 6 ? -90 : ($orientation == 8 ? 90 : NULL)));
      $image_width = imagesx($image);
      $image_height = imagesy($image);
      $ratio = $image_height / $image_width;
      $new_width = 800;
      $new_height = intval($ratio * $new_width);
      $thumb = imagecreatetruecolor($new_width, $new_height);
      imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
      $source = $image_rotate != NULL ? imagerotate($thumb, $image_rotate, 0) : $thumb;
      imagejpeg($source, $path, 100);
      imagedestroy($image);
      return TRUE;
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



  public function get_return_list_post()
  {
    $this->load->model('inventory/return_product_model');
    $this->load->helper('return_product');
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
          'statusLabel' => return_status_label($rs->status, $rs->is_approve),
          'remark' => $rs->remark,
          'uname' => $rs->uname
        );

        array_push($dataset, $arr);
      }
    }

    $filter['data'] = $dataset;
    $filter['rows'] = $rows;

    $this->response($filter, 200);
  }



  public function new_return_post()
  {
    $this->load->model('inventory/return_product_model');
    $sc = TRUE;

    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $id = NULL;
      $doc = $this->return_product_model->get_return_draft_by_user_id($this->_user->id);

      if( ! empty($doc))
      {
        $id = $doc->id;
      }
      else
      {
        $date_add = now();
        $code = $this->get_new_return_code($date_add);

        $arr = array(
          'code' => $code,
          'date_add' => $date_add,
          'whsCode' => $data->whsCode,
          'create_at' => now(),
          'create_by' => $this->_user->id,
          'team_id' => $this->_user->team_id
        );

        $id = $this->return_product_model->add($arr);

        if( ! $id)
        {
          $sc = FALSE;
          set_error('insert');
        }
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
    $this->load->helper('return_product');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $doc = $this->return_product_model->get($data->id);

      if( ! empty($doc))
      {
        $doc->date_add = thai_date($doc->date_add);
        $doc->active = $doc->status < 0 ? 1 : 0; //-- ใช้เปิด/ปิด ปุ่ม delete
        $doc->is_cancle = $doc->status == 2 ? 1 : 0;
        $doc->statusText = return_status_text($doc->status, $doc->is_approve);

        $details = $this->return_product_model->get_details($data->id);

        if( ! empty($details))
        {
          foreach($details as $rs)
          {
            $rs->valid = $doc->active == 1 ? 0 : 1;
          }
        }

        $ds = array(
          'header' => $doc,
          'details' => $details
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
              'Serial' => $data->serial,
              'user_id' => $this->_user->id
            );

            if( ! $this->return_product_model->add_detail($arr))
            {
              $sc = FALSE;
              $this->error = "Insert return row failed";
            }
            else
            {
              $this->return_product_model->update_user_item($this->_user->id, $data->serial, $data->docNum, 2);

              $details = $this->return_product_model->get_details($data->return_id);

              $active = $doc->status < 0 ? 1 : 0; //-- ใช้เปิด/ปิด ปุ่ม delete

              $details = $this->return_product_model->get_details($data->return_id);

              if( ! empty($details))
              {
                foreach($details as $rs)
                {
                  $rs->valid = $active == 1 ? 0 : intval($rs->valid);
                }
              }
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


  public function remove_return_row_post()
  {
    $this->load->model('inventory/return_product_model');
    $this->load->model('inventory/user_item_model');

    $sc = TRUE;

    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {

      $row = $this->return_product_model->get_detail($data->id);

      if( ! empty($row))
      {
        $this->db->trans_begin();

        if($this->return_product_model->delete_detail($data->id))
        {
          //--- set status to 0
          if( ! $this->return_product_model->update_user_item($row->user_id, $row->Serial, $row->fromDoc, 0))
          {
            $sc = FALSE;
            $this->error = "Update user item status failed";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "Delete failed";
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
        $this->error = "Item not found";
      }

    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing Required Parameter : user_id";
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'Success' : $this->error
    );

    $this->response($arr, 200);
  }


  public function save_return_post()
  {
    $this->load->model('inventory/return_product_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $doc = $this->return_product_model->get($data->id);

      if( ! empty($doc))
      {
        if($doc->status == -1)
        {
          $arr = array(
            'status' => 0,
            'remark' => get_null(trim($data->remark)),
            'update_by' => $this->_user->id,
            'update_at' => now()
          );

          if( ! $this->return_product_model->update($data->id, $arr))
          {
            $sc = FALSE;
            $this->error = "บันทึกไม่สำเร็จ";
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
      $this->error = "Missing Required Parameter";
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'Success' : $this->error
    );

    $this->response($arr, 200);
  }


  public function unsave_return_post()
  {
    $this->load->model('inventory/return_product_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $doc = $this->return_product_model->get($data->id);

      if( ! empty($doc))
      {
        if($doc->status == 0)
        {
          $arr = array(
            'status' => -1,
            'update_by' => $this->_user->id,
            'update_at' => now()
          );

          if( ! $this->return_product_model->update($data->id, $arr))
          {
            $sc = FALSE;
            $this->error = "เปลี่ยนสถานะไม่สำเร็จ";
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
      $this->error = "Missing Required Parameter";
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'Success' : $this->error
    );

    $this->response($arr, 200);
  }


  public function cancle_return_post()
  {
    $this->load->model('inventory/return_product_model');
    $sc = TRUE;
    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $doc = $this->return_product_model->get($data->id);

      if( ! empty($doc))
      {
        if($doc->status != 2 && $doc->status !=1)
        {
          $arr = array(
            'status' => 2,
            'is_cancle' => 1,
            'cancle_by' => $this->_user->id,
            'cancle_at' => now(),
            'update_by' => $this->_user->id,
            'update_at' => now()
          );

          if( ! $this->return_product_model->update($data->id, $arr))
          {
            $sc = FALSE;
            $this->error = "เปลี่ยนสถานะไม่สำเร็จ";
          }
          else
          {
            $details = $this->return_product_model->get_details($data->id);

            if( ! empty($details))
            {
              $arr = array('valid' => 2);

              $this->return_product_model->update_details($data->id, $arr);

              foreach($details as $rs)
              {
                $this->return_product_model->update_user_item($rs->user_id, $rs->Serial, $rs->fromDoc, 0);
              }
            }
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
      $this->error = "Missing Required Parameter";
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'Success' : $this->error
    );

    $this->response($arr, 200);
  }


  public function get_damaged_list_post()
  {
    $this->load->model('admin/dispose_reason_model');
    $sc = TRUE;

    $arr = array(
      'status' => 'success',
      'data' => $this->dispose_reason_model->get_all()
    );

    $this->response($arr, 200);
  }


  public function verify_pea_no_post()
  {
    $this->load->model('inventory/transfer_model');

    $sc = TRUE;
    $exists = 0;

    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      $peaData = $this->transfer_model->get_pea_data($data->pea_no);

      if( ! empty($peaData))
      {
        $exists = 1;
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing Required Parameter";
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'isVerify' => $exists
    );

    $this->response($arr, 200);
  }
} //--- end class
?>
