<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends PS_Controller
{
  public $menu_code = 'OPWHTR';
	public $menu_group_code = 'OP';
	public $title = 'งานติดตั้ง';
	public $segment = 4;
  public $error;

  public function __construct()
  {
    parent::__construct();

    if($this->_Lead)
    {
      $this->pm->can_view = 1;
    }

    $this->home = base_url().'inventory/transfer';
    $this->load->model('inventory/transfer_model');
    $this->load->helper('team');
    $this->load->helper('team_group');
    $this->load->helper('image');
    $this->load->helper('transfer');
  }


  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'tr_code', ''),
      'u_pea_no' => get_filter('u_pea_no', 'tr_u_pea_no', ''),
      'i_pea_no' => get_filter('i_pea_no', 'tr_i_pea_no', ''),
      'serial' => get_filter('serial', 'tr_serial', ''),
      'user' => get_filter('user', 'tr_user', ''),
      'team_group_id' => get_filter('team_group_id', 'tr_team_group_id', 'all'),
      'team_id' => get_filter('team_id', 'tr_team_id', 'all'),
      'sap_status' => get_filter('sap_status', 'sap_status', 'all'),
      'pea_status' => get_filter('pea_status', 'pea_status', 'all'),
      'status' => get_filter('status', 'tr_status', 'all'),
      'from_date' => get_filter('from_date', 'tr_from_date', ''),
      'to_date' => get_filter('to_date', 'tr_to_date', '')
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


  public function update_item($id)
  {
    $sc = TRUE;
    $i_power_no = trim($this->input->post('i_power_no'));
    $u_power_no = trim($this->input->post('u_power_no'));
    $damage_id = get_null($this->input->post('damage_id'));
    $phase = $this->input->post('phase');

    if(strlen($i_power_no) == 5 OR strlen($u_power_no) == 5)
    {
      $doc = $this->transfer_model->get($id);

      if(! empty($doc))
      {
        if($doc->status == 'I' OR $doc->status == 'R' OR $doc->status == 'U')
        {

          $arr = array(
            'i_power_no' => $i_power_no,
            'u_power_no' => $u_power_no,
            'damage_id' => $damage_id,
            'phase' => $phase
          );

          if( ! $this->transfer_model->update($id, $arr))
          {
            $sc = FALSE;
            $this->error = "Update data failed";
          }
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "Invalid Document Id";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing required parameters";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function approve()
  {
    $this->load->model('inventory/work_list_model');
    $this->load->model('inventory/user_item_model');

    $sc = TRUE;
    $ex = 0; //--- export status 0 = สำเร็จ , 1 = ส่งเข้า SAP ไม่สำเร็จ, 2 = ส่งไป SCS ไม่สำเร็จ;
    $id = $this->input->post('id');

    if($id)
    {
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status == 'I' OR $doc->is_approve == 0)
        {
          $arr = array(
            'status' => 'A',
            'is_approve' => 1,
            'approver' => $this->_user->uname
          );

          $this->db->trans_begin();

          if( ! $this->transfer_model->update($id, $arr))
          {
            $sc = FALSE;
            set_error(0, "อนุมัติเอกสารไม่สำเร็จ");
          }

          if($sc === TRUE)
          {
            if( ! $this->user_item_model->set_status($doc->i_pea_no, 'A'))
            {
              $sc = FALSE;
              $this->error = "เปลี่ยนสถานะรายการมิเตอร์ไม่สำเร็จ";
            }
          }

          if($sc === TRUE)
          {
            if( ! $this->work_list_model->set_status($doc->u_pea_no, 'A'))
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

          if($sc === TRUE)
          {
            if(getConfig('PEA_API'))
            {
              $this->load->library('scs');
              $work_list = $this->work_list_model->get($doc->u_pea_no);

              $i_path = $this->config->item('image_path')."installed/{$doc->i_pea_no}-{$id}.jpg";
              $u_path = $this->config->item('image_path')."returnned/{$doc->u_pea_no}-{$id}.jpg";
              $s_path = $this->config->item('image_path')."signature/{$doc->u_pea_no}-{$id}_sign.jpg";

              $doc->i_path = $i_path;
              $doc->u_path = $u_path;
              $doc->image1 = readImage($i_path);
              $doc->image2 = readImage($u_path);
              $doc->image3 = NULL;

              if($doc->sign_status == 0)
              {
                $doc->s_path = $s_path;
                $doc->image3 = readImage($s_path);
              }

              $res = json_decode($this->scs->send_data($doc, $work_list));

              if( ! empty($res))
              {
                if($res->status == 1)
                {
                  $arr = array(
                    'stataus' => 'W',
                    'pea_status' => 'S',
                    'pea_message' => NULL
                  );

                  $this->transfer_model->update($id, $arr);

                  $this->work_list_model->set_status($doc->u_pea_no, 'W');
                }
                else
                {
                  $arr = array(
                    'pea_status' => 'F',
                    'pea_message' => $res->friendly_msg_en
                  );

                  $this->transfer_model->update($id, $arr);

                  $sc = FALSE;
                  $this->error = "อนุมัติเอกสารสำเร็จ ส่งข้อมูลเข้า SAP สำเร็จ แต่ส่งข้อมูลไประบบ SCS ไม่สำเร็จ : {$res->friendly_msg_en}";
                }
              }
              else
              {
                $arr = array(
                  'pea_status' => 'F',
                  'pea_message' => 'ไม่ได้รับการตอบกลับจากระบบ SCS'
                );

                $this->transfer_model->update($id, $arr);

                $sc = FALSE;
                $this->error = "อนุมัติเอกสารสำเร็จ ส่งข้อมูลเข้า SAP สำเร็จ แต่ส่งข้อมูลไประบบ SCS ไม่สำเร็จ : ไม่ได้รับการตอบกลับจากระบบ SCS";
              }
            }

            $this->ms = $this->load->database('ms', TRUE);
            $this->load->library('api');

            if( ! $this->api->exportTransfer($id))
            {
              $sc = FALSE;
              $this->error = "อนัมัติเอกสารสำเร็จแต่ส่งข้อมูลเข้า SAP ไม่สำเร็จ กรุณากดส่งข้อมูลอีกครั้งภายหลัง : {$this->error}";
            }
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


  /*
  Status
  P = Pending
  I = Installed
  A = Sttc Approve
  R = Sttc Rejected
  W = Sent to Pea
  S = PEA Accept
  U = PEA Rejected
  */

  public function reject()
  {
    $this->load->model('inventory/work_list_model');
    $this->load->model('inventory/user_item_model');
    $sc = TRUE;

    $id = $this->input->post('id');

    if( ! empty($id))
    {
      $doc = $this->transfer_model->get($id);

      if( ! empty($doc))
      {

        if($doc->status == 'I')
        {
          $this->db->trans_begin();
          //--- set work_list status
          if( ! $this->work_list_model->set_status($doc->u_pea_no, 'R'))
          {
            $sc = FALSE;
            $this->error = "เปลี่ยนสถานะใบสั่งงานไม่สำเร็จ";
          }

          //--- set user_item status
          if($sc === TRUE)
          {
            if( ! $this->user_item_model->set_status($doc->i_pea_no, 'R'))
            {
              $sc = FALSE;
              $this->error = "เปลี่ยนสถานะรายการมิเตอร์ไม่สำเร็จ";
            }
          }

          //--- set transfer status
          if($sc === TRUE)
          {
            $arr = array(
              'status' => 'R',
              'is_approve' => 0,
              'approver' => $this->_user->uname,
              'update_at' => now(),
              'update_by' => $this->_user->id
            );

            if( ! $this->transfer_model->update($doc->id, $arr))
            {
              $sc = FALSE;
              $this->error = "Update data failed";
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


  public function send_to_scs()
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
          if(getConfig('PEA_API'))
          {
            $this->load->model('inventory/work_list_model');
            $this->load->library('scs');
            $work_list = $this->work_list_model->get($doc->u_pea_no);

            $i_path = $this->config->item('image_path')."installed/{$doc->i_pea_no}-{$id}.jpg";
            $u_path = $this->config->item('image_path')."returnned/{$doc->u_pea_no}-{$id}.jpg";
            $s_path = $this->config->item('image_path')."signature/{$doc->u_pea_no}-{$id}_sign.jpg";

            $doc->i_path = $i_path;
            $doc->u_path = $u_path;
            $doc->image1 = readImage($i_path);
            $doc->image2 = readImage($u_path);
            $doc->image3 = NULL;

            if($doc->sign_status == 0)
            {
              $doc->s_path = $s_path;
              $doc->image3 = readImage($s_path);
            }

            $res = json_decode($this->scs->send_data($doc, $work_list));

            if( ! empty($res))
            {
              if($res->status == 1)
              {
                $arr = array(
                  'stataus' => 'W',
                  'pea_status' => 'S',
                  'pea_message' => NULL
                );

                $this->transfer_model->update($id, $arr);
              }
              else
              {
                $arr = array(
                  'pea_status' => 'F',
                  'pea_message' => $res->friendly_msg_en
                );

                $this->transfer_model->update($id, $arr);

                $sc = FALSE;
                $this->error = "ส่งข้อมูลไประบบ SCS ไม่สำเร็จ : {$res->friendly_msg_en}";
              }
            }
            else
            {
              $arr = array(
                'pea_status' => 'F',
                'pea_message' => 'ไม่ได้รับการตอบกลับจากระบบ SCS'
              );

              $this->transfer_model->update($id, $arr);

              $sc = FALSE;
              $this->error = "ส่งข้อมูลไประบบ SCS ไม่สำเร็จ : ไม่ได้รับการตอบกลับจากระบบ SCS";
            }
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


  public function get_item($id)
  {
    $this->load->model('admin/damaged_model');
    $sc = TRUE;
    $ds = array();
    $rs = $this->transfer_model->get($id);

    if( ! empty($rs))
    {
      $i_path = base_url().$this->config->item('image_path')."installed/{$rs->i_pea_no}-{$id}.jpg";
      $u_path = base_url().$this->config->item('image_path')."returnned/{$rs->u_pea_no}-{$id}.jpg";
      $s_path = base_url().$this->config->item('image_path')."signature/{$rs->u_pea_no}-{$id}_sign.jpg";

      $ds = array(
        "id" => $rs->id,
        "code" => $rs->code,
        "item_code" => $rs->ItemCode,
        "item_name" => $rs->ItemName,
        "i_serial" => $rs->i_serial,
        "fromWhsCode" => $rs->fromWhsCode,
        "fromWhsName" => $rs->from_warehouse_name,
        "toWhsCode" => $rs->toWhsCode,
        "toWhsName" => $rs->to_warehouse_name,
        "i_image_path" => $i_path,
        "u_image_path" => $u_path,
        "s_image_path" => $rs->sign_status == '0' ? $s_path : NULL,
        "i_pea_no" => $rs->i_pea_no,
        "u_pea_no" => $rs->u_pea_no,
        "u_power_no" => $rs->u_power_no,
        "i_power_no" => $rs->i_power_no,
        "phase" => $rs->phase,
        "damage_id" => $rs->damage_id,
        "damage_name" => damage_name($rs->damage_id),
        "color" => sticker_color($rs->damage_id, $rs->use_age),
        "use_age" => $rs->use_age,
        "status" => $rs->status,
        "sap_status" => $rs->sap_status,
        "pea_status" => $rs->pea_status,
        "is_approve" => $rs->is_approve,
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


  public function clear_filter()
  {
    $filter = array(
      'tr_code',
      'tr_u_pea_no',
      'tr_i_pea_no',
      'tr_serial',
      'tr_user',
      'tr_team_group_id',
      'tr_team_id',
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
