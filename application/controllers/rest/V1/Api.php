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


  public function get_transfer_history_post()
  {
    $this->load->model('inventory/transfer_model');
    $this->load->helper('transfer');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    $rows = $this->transfer_model->count_history_rows($data->search_text);
    $ds = $this->transfer_model->get_history_list($data->search_text, $data->perpage, $data->offset);
    $dataset = array();

    if( ! empty($ds))
    {
      foreach($ds as $rs)
      {
        $arr = array(
          'id' => $rs->id,
          'code' => $rs->code,
          'date_add' => thai_date($rs->date_add, FALSE),
          'u_pea_no' => $rs->u_pea_no,
          'route' => $rs->route,
          'statusLabel' => transfer_status_label($rs->status)
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
    $this->load->model('admin/dispose_reason_model');
    $this->load->helper('image');
    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {
      $rs = $this->transfer_model->get($data->id);

      if( ! empty($rs))
      {
        $i_path = $this->config->item('image_path')."installed/{$rs->i_pea_no}-{$rs->id}.jpg";
        $u_path = $this->config->item('image_path')."returnned/{$rs->u_pea_no}-{$rs->id}.jpg";
        $s_path = $this->config->item('image_path')."signature/{$rs->u_pea_no}-{$rs->id}_sign.jpg";

        $rs->i_image = readImage($i_path);
        $rs->u_image = readImage($u_path);
        $rs->signature_image = readImage($s_path);
        $rs->damage_name = $this->dispose_reason_model->get_title($rs->damage_id);

        $arr = (array) $rs;
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
    $this->load->model('inventory/user_item_model');
    $this->load->model('inventory/work_list_model');
    $this->load->helper('image');

    $sc = TRUE;
    $data = json_decode(file_get_contents("php://input"));

    if( ! empty($data))
    {

      $item = $this->user_item_model->get_item_by_pea_no($data->i_pea_no);

      $code = $this->get_new_transfer_code();

      if( ! empty($item) && ($item->status == 'P' OR $item->status == 'R' OR $item->status == 'U' ) )
      {
        $arr = array(
          'date_add' => date('Y-m-d'),
          'code' => $code,
          'ItemCode' => $item->ItemCode,
          'ItemName' => $item->ItemName,
          'i_serial' => $item->serial,
          'u_serial' => $item->serial.'-1',
          'qty' => 1,
          'fromWhsCode' => $item->WhsCode,
          'fromBinCode' => $item->BinCode,
          'toWhsCode' => $item->WhsCode,
          'toBinCode' => $item->WhsCode.'-SYSTEM-BIN-LOCATION',
          'u_pea_no' => $data->u_pea_no,
          'u_power_no' => $data->u_power_no,
          'route' => $data->route,
          'i_pea_no' => $item->pea_no,
          'i_power_no' => $data->i_power_no,
          'damage_id' => $data->damage_id,
          'use_age' => $data->use_age,
          'phase' => $data->phase,
          'latitude' => $data->i_lat,
          'longitude' => $data->i_lng,
          'sign_status' => $data->sign_status,
          'remark' => get_null(trim($data->remark)),
          'fromDoc' => $data->fromDoc,
          'team_id' => $this->_user->team_id,
          'team_group_id' => $this->_user->team_group_id,
          'create_by' => $this->_user->id
        );

        $this->db->trans_begin();
        $id = $this->transfer_model->add($arr);

        if( ! $id)
        {
          $sc = FALSE;
          $this->error = "บันทึกรายการไม่สำเร็จ";
        }

        if($sc === TRUE)
        {
          //-- Update user_item status
          if( ! $this->user_item_model->update_by_id($item->id, array('status' => 'I')))
          {
            $sc = FALSE;
            $this->error = "เปลี่ยนสถานะรายการมิเตอร์ไม่สำเร็จ";
          }

          //-- update work_list status
          if( ! $this->work_list_model->update_by_pea_no($data->u_pea_no, array('status' => 'I')))
          {
            $sc = FALSE;
            $this->error = "เปลี่ยนสถานะใบสั่งงานไม่สำเร็จ";
          }
        }


        //----- Save return images
        if($sc === TRUE)
        {
          $i_path = $this->config->item('image_path')."installed/{$data->i_pea_no}-{$id}.jpg";
          $u_path = $this->config->item('image_path')."returnned/{$data->u_pea_no}-{$id}.jpg";
          $s_path = $this->config->item('image_path')."signature/{$data->u_pea_no}-{$id}_sign.jpg";

          if(createImage($data->u_image, $u_path, $data->u_orientation) === FALSE)
          {
            $sc = FALSE;
            set_error(0, "Create Returnned Image Failed");
          }

          if(createImage($data->i_image, $i_path, $data->i_orientation) === FALSE)
          {
            $sc = FALSE;
            set_error(0, "Create Installed Image Failed");
          }

          if($data->sign_status == 0 && ! empty($data->signature_image))
          {
            if(createImage($data->signature_image, $s_path, 1) === FALSE)
            {
              $sc = FALSE;
              set_error(0, "Create Signature Image Failed");
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
        $this->error = empty($item) ? "ไม่พบ PEA NO ของมิเตอร์ใหม่ในรายการมิเตอร์" : "มิเตอร์ถูกติดตั้งไปแล้วกรุณาตรวจสอบ";
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



  public function delete_open_team_group_items_post()
  {
    $this->load->model('inventory/user_item_model');
    $sc = TRUE;
    $team_group_id = $this->_user->team_group_id;

    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data) && ! empty($team_group_id))
    {
      if( ! $this->user_item_model->delete_open_team_group_items($team_group_id, $data->docNum))
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
    $this->load->helper('work_list');
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
            'age_meter' => $rs->age_meter,
            'latitude' => $rs->latitude,
            'longitude' => $rs->longitude,
            'status' => $rs->status,
            'status_label' => status_text($rs->status),
            'status_color' => status_color($rs->status)
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
    $this->load->helper('work_list');
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
              'age_meter' => $rs->age_meter,
              'latitude' => $rs->latitude,
              'longitude' => $rs->longitude,
              'status' => $rs->status,
              'status_label' => status_text($rs->status),
              'status_color' => status_color($rs->status)
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
    $test = true;
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

      if( ! empty($doc))
      {
        if($test OR ($test == FALSE && $doc->toWhsCode == $this->_user->fromWhsCode))
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
                  'PeaNo' => $test ? (empty($rs->PeaNo) ? $rs->Serial : $rs->PeaNo) : $rs->PeaNo,
                  'ItemCode' => $rs->ItemCode,
                  'ItemName' => $rs->ItemName,
                  'WhsCode' => $rs->WhsCode,
                  'BinCode' => (empty($rs->BinCode) ? "{$rs->WhsCode}-SYSTEM-BIN-LOCATION" : $rs->BinCode)
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


  public function update_user_item_post()
  {
    $test = true;
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
        $team_group_id = $this->_user->team_group_id;

        $this->user_item_model->drop_open_item($data->docNum, $team_group_id);

        foreach($list as $rs)
        {
          if($sc === FALSE)
          {
            break;
          }

          $arr = array(
            'team_id' => $this->_user->team_id,
            'team_group_id' => $this->_user->team_group_id,
            'pea_no' => $test ? ((empty($rs->PeaNo) ? $rs->Serial : $rs->PeaNo)) : $rs->PeaNo,
            'serial' => $rs->Serial,
            'ItemCode' => $rs->ItemCode,
            'ItemName' => $rs->ItemName,
            'DocNum' => $data->docNum,
            'WhsCode' => $rs->WhsCode,
            'BinCode' => $rs->BinCode,
            'status' => 'P',
            'date_add' => now(),
            'date_upd' => NULL
          );

          if( ! $this->user_item_model->is_exists($data->docNum, $team_group_id, $rs->Serial))
          {
            if( ! $this->user_item_model->add_user_item($arr))
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



  public function sync_team_group_items_post()
  {
    $this->load->model('inventory/user_item_model');
    $this->load->helper('user_item');
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
            'WhsCode' => $rs->WhsCode,
            'BinCode' => $rs->BinCode,
            'date' => thai_date($rs->date_add, FALSE),
            'state' => $rs->status,
            'status_label' => meter_status_text($rs->status),
            'status_color' => meter_status_color($rs->status)
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


  public function add_inform_post()
  {
    $this->load->model('inventory/inform_model');
    $this->load->model('inventory/work_list_model');
    $this->load->helper('image');
    $this->load->library('scs');
    $sc = TRUE;
    $ex = 0;

    $data = json_decode(file_get_contents('php://input'));

    if( ! empty($data))
    {
      //--- check exists
      if( ! $this->inform_model->is_exists($data->pea_no))
      {

        $rs = $this->work_list_model->get($data->pea_no);

        if( ! empty($rs))
        {
          $f_path = $this->config->item('image_path')."inform/{$data->pea_no}-f.jpg";
          $s_path = $this->config->item('image_path')."inform/{$data->pea_no}-s.jpg";

          if(createImgae($data->u_image, $f_path, $data->u_orientation) === FALSE)
          {
            $sc = FALSE;
            set_error(0, "Create Returnned Image Failed");
          }

          if(createImgae($data->i_image, $s_path, $data->i_orientation) === FALSE)
          {
            $sc = FALSE;
            set_error(0, "Create Installed Image Failed");
          }

          if($sc === TRUE)
          {
            $this->db->trans_begin();

            $ds = array(
              'cust_no' => $rs->cust_no,
              'pea_no' => $rs->pea_no,
              'pea_no_full' => $rs->pea_no_full,
              'mat_code_full' => $rs->mat_code_full,
              'ca_no' => $rs->ca_no,
              'cust_name' => $rs->cust_name,
              'cust_address' => $rs->cust_address,
              'cust_tel' => $rs->cust_tel,
              'cust_route' => $rs->cust_route,
              'age_meter' => $rs->age_meter,
              'Plan_TableName' => $rs->Plan_TableName,
              'remark' => trim($data->remark),
              'user_id' => $this->_user->id,
              'team_id'=> $this->_user->team_id,
              'team_group_id' => $this->_user->team_group_id,
              'latitude' => $data->lat,
              'longitude' => $data->lng
            );

            $id = $this->inform_model->add($ds);
            if( ! $id)
            {
              $sc = FALSE;
              $this->error = "บันทึกรายการไม่สำเร็จ กรุณาลองใหม่อีกครั้ง";
            }
            else
            {
              if( ! $this->work_list_model->set_status($rs->pea_no, 'F'))
              {
                $sc = FALSE;
                $this->error = "เปลี่ยนสถานะใบสั่งงานไม่สำเร็จ";
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

            if($sc === TRUE && getConfig('PEA_API'))
            {
              //--- send data to pea
              $ds['f_path'] = $f_path;
              $ds['s_path'] = $s_path;
              $ds['image1'] = $data->u_image;
              $ds['image2'] = $data->i_image;

              $res = json_decode($this->scs->send_inform($ds));

              if( ! empty($res))
              {
                if($res->status == 0)
                {
                  $this->error = "บันทึกรายการสำเร็จ แต่ส่งข้อมูลไประบบ SCS ไม่สำเร็จ : {$res->friendly_msg_en}";
                  $ex = 1;

                  $arr = array(
                    'status' => 'F',
                    'message' => $res->friendly_msg_en
                  );
                }
                else
                {
                  $arr = array(
                    'status' => 'S',
                    'message' => NULL
                  );
                }

                $this->inform_model->update($id, $arr);
              }
              else
              {
                $this->error = "บันทึกรายการสำเร็จ แต่ส่งข้อมูลไประบบ SCS ไม่สำเร็จ";
                $ex = 1;

                $arr = array(
                  'status' => 'F',
                  'message' => "ไม่ได้รับการตอบกลับ"
                );

                $this->inform_model->update($id, $arr);
              }
            }
          }
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "{$data->pea_no} เคยถูกแจ้งไว้แล้ว ไม่สามารถแจ้งซ้ำได้";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $this->error,
      'ex' => $ex
    );

    $this->response($arr, 200);
  }


  public function test_api_post()
  {
    print_r($_FILES['image1']);
    print_r($this->input->post());
  }

} //--- end class
?>
