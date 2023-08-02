<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pack extends PS_Controller
{
  public $menu_code = 'OPISPK';
	public $menu_group_code = 'OP';
	public $title = 'แพ็คมิเตอร์เก่า';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/pack';
    $this->load->model('inventory/pack_model');
    $this->load->model('inventory/install_list_model');
    $this->load->helper('dispose_reason');
    $this->load->helper('warehouse');
    $this->load->helper('area');
    $this->load->helper('pack');
  }



  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'pack_code', ''),
      'area' => get_filter('area', 'pack_area', 'all'),
      'warehouse' => get_filter('warehouse', 'pack_warehouse', 'all'),
      'status' => get_filter('status', 'pack_status', 'all'),
      'phase' => get_filter('phase', 'pack_phase', 'all'),
      'reference' => get_filter('reference', 'pack_reference', ''),
      'user' => get_filter('user', 'pack_user', 'all'),
      'from_date' => get_filter('from_date', 'pack_from_date', ''),
      'to_date' => get_filter('to_date', 'pack_to_date', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->pack_model->count_rows($filter);

		$filter['data'] = $this->pack_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('inventory/pack/pack_list', $filter);
  }


  public function add_new($phase = 1)
  {
    $ds = array('phase' => $phase);
    $this->load->view('inventory/pack/pack_add', $ds);
  }


  public function add()
  {
    $sc = TRUE;

    if($this->pm->can_add)
    {
      $date_add = db_date($this->input->post('date_add'));
      $phase = $this->input->post('phase') == 3 ? 3 : 1;
      $remark = get_null($this->input->post('remark'));

      $ds = array(
        'code' => $this->get_new_code($date_add),
        'team_id' => $this->_user->team_id,
        'WhsCode' => $this->_user->fromWhsCode,
        'date_add' => $date_add,
        'user' => $this->_user->id,
        'remark' => $remark,
        'phase' => $phase
      );

      $id = $this->pack_model->add($ds);

      if( ! $id)
      {
        $sc = FALSE;
        set_error('insert');
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


  public function edit($id)
  {
    if($this->pm->can_add OR $this->pm->can_edit)
    {
      $doc = $this->pack_model->get($id);

      if( ! empty($doc))
      {
        if($doc->status == 'O')
        {
          $ds = array(
            'doc' => $doc,
            'details' => $this->pack_model->get_details($id)
          );

          $this->load->view('inventory/pack/pack_edit',$ds);
        }
        else
        {
          redirect($this->home.'/view_detail/'.$doc->id);
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



  function finish_pack($id)
  {
    $sc = TRUE;

    $this->db->trans_begin();
    $tb = $this->pack_model->update($id, array('status' => 'F'));
    $td = $this->pack_model->update_details($id, array('status' => 'F'));

    if($tb && $td)
    {
      $this->db->trans_commit();
    }
    else
    {
      $this->db->trans_rollback();
      $sc = FALSE;
      $this->error = "เปลี่ยนสถานะเอกสารไม่สำเร็จ";
    }

    $this->_response($sc);
  }


  public function view_detail($id)
  {
    $doc = $this->pack_model->get($id);

    if( ! empty($doc))
    {
      $ds = array(
        'doc' => $doc,
        'details' => $this->pack_model->get_details($id)
      );

      $this->load->view('inventory/pack/pack_view_detail',$ds);
    }
    else
    {
      $this->page_error();
    }
  }


  public function do_packing()
  {
    $sc = TRUE;
    $op = $this->input->post('op');
    $pack_id = $this->input->post('pack_id');
    $pea_no = trim($this->input->post('pea_no'));
    $phase = $this->input->post('phase') == 3 ? 3 : 1;

    if( ! empty($pea_no) && ! empty($pack_id))
    {
      $doc = $this->pack_model->get($pack_id);
      $rs = $this->install_list_model->get($pea_no, $op);

      if( ! empty($rs))
      {
        if($rs->pack_status == 0)
        {
          if($rs->phase == $doc->phase)
          {
            $arr = array(
              'pack_id' => $pack_id,
              'u_pea_no' => $rs->u_pea_no,
              'i_pea_no' => $rs->i_pea_no,
              'work_date' => $rs->work_date,
              'meter_age' => $rs->meter_age,
              'phase' => $rs->phase,
              'meter_size' => $rs->meter_size_name,
              'meter_read_end' => number($rs->meter_read_end),
              'dispose_reason_id' => $rs->dispose_reason,
              'user' => $this->_user->id,
              'dispose_reason_name' => empty($rs->dispose_reason) ? NULL : dispose_reason_name($rs->dispose_reason)
            );

            $id = $this->pack_model->add_detail($arr);

            if($id)
            {
              $arr['id'] = $id;
              $this->install_list_model->update($rs->id, array('pack_status' => 1, 'pack_code' => $doc->code));
            }
            else
            {
              $sc = FALSE;
              $this->error = "เพิ่มรายการไม่สำเร็จ";
            }
          }
          else
          {
            $sc = FALSE;
            $this->error = "กรุณาแพ็คมิเตอร์ {$doc->phase} เฟสเท่านั้น";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "มิเตอร์นี้เคยถูกแพ็คไปแล้ว";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "มิเตอร์นี้ยังไม่ถูกนำเข้าระบบ กรุณาตรวจสอบ";
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    echo $sc === TRUE ? json_encode($arr) : $this->error;
  }


  public function update_dispose()
  {
    $sc = TRUE;
    $id = $this->input->post('id');
    $dispose_reason = get_null(trim($this->input->post('dispose_reason')));

    $arr = array(
      'dispose_reason_name' => $dispose_reason
    );

    if( ! $this->pack_model->update_detail($id, $arr))
    {
      $sc = FALSE;
      $this->error = "บันทึกอาการชำรุดไม่สำเร็จ";
    }

    $this->_response($sc);
  }


  public function delete_rows()
  {
    $sc = TRUE;
    $data = json_decode($this->input->post('rows'));

    if( ! empty($data))
    {
      foreach($data as $rs)
      {
        if($this->pack_model->delete_detail($rs->id))
        {
          $this->install_list_model->unpack($rs->u_pea_no, 'u');
        }
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการที่ต้องการลบ";
    }

    $this->_response($sc);
  }


  public function un_finish($id)
  {
    $sc = TRUE;
    $doc = $this->pack_model->get($id);

    if( ! empty($doc))
    {
      if($doc->status == 'F')
      {
        $this->db->trans_begin();
        //--- change doc status
        $arr = array(
          'status' => 'O'
        );

        if( ! $this->pack_model->update($doc->id, $arr))
        {
          $sc = FALSE;
          $this->error = "ย้อนสถานะเอกสารไม่สำเร็จ";
        }

        if( $sc === TRUE)
        {
          $arr = array(
            'status' => 'O'
          );

          if( ! $this->pack_model->update_details($doc->id, $arr))
          {
            $sc = FALSE;
            $this->error = "ย้อนสถานะรายการแพ็คไม่สำเร็จ";
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
        $this->error = "สถานะเอกสารไม่ถูกต้อง";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบเลขที่เอกสาร";
    }

    $this->_response($sc);
  }


  public function update_remark()
  {
    $sc = TRUE;
    $id = $this->input->post('id');
    $remark = get_null(trim($this->input->post('remark')));

    $arr = array('remark' => $remark);

    if( ! $this->pack_model->update($id, $arr))
    {
      $sc = FALSE;
      $this->error = "บันทึกหมายเหตุไม่สำเร็จ";
    }

    $this->_response($sc);
  }


  public function cancel_pack()
  {
    $sc = TRUE;
    $id = $this->input->post('id');

    $doc = $this->pack_model->get($id);

    if( ! empty($doc))
    {
      if($doc->status == 'O')
      {
        $this->db->trans_begin();

        if( ! $this->pack_model->delete_details($id))
        {
          $sc = FALSE;
          $this->error = "ลบรายการแพ็คไม่สำเร็จ";
        }

        if($sc === TRUE)
        {
          if( ! $this->pack_model->update($id, array('status' => 'D')))
          {
            $sc = FALSE;
            $this->error = "เปลี่ยนสถานะเอกสารไม่สำเร็จ";
          }
        }

        if($sc === TRUE)
        {
          if( ! $this->install_list_model->unpack_by_pack_code($doc->code))
          {
            $sc = FALSE;
            $this->error = "เปลี่ยนสถานะรายการติดตั้งไม่สำเร็จ";
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
        $this->error = "สถานะเอกสารไม่ถูกต้อง เอกสารไม่อยู่ในสถานะที่สามารถยกเลิกได้";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบเลขที่เอกสาร";
    }

    $this->_response($sc);
  }


  public function print_pack_list($id)
	{
		$this->load->library('printer');
		$doc = $this->pack_model->get($id);
    $details = $this->pack_model->get_details($id);

    if( ! empty($doc))
    {
      $doc->user_name = display_name($doc->user);
    }
		$ds = array(
			'doc' => $doc,
			'details' => $details
		);

		$this->load->view('print/print_pack_list', $ds);
	}


  public function print_split_pack_list($id)
	{
		$this->load->library('printer');
		$doc = $this->pack_model->get($id);
    $details = $this->pack_model->get_details($id);

    if( ! empty($doc))
    {
      $doc->user_name = display_name($doc->user);
    }
		$ds = array(
			'doc' => $doc,
			'details' => $details,
      'split' => getConfig('PRINT_SPLIT_ROWS')
		);

		$this->load->view('print/print_split_pack_list', $ds);
	}



  public function get_new_code($date = NULL)
  {
    $date = empty($date) ? date('Y-m-d') : $date;
    $Y = date('y', strtotime($date));
    $M = date('m', strtotime($date));
    $prefix = getConfig('PREFIX_PACK');
    $run_digit = getConfig('RUN_DIGIT_PACK');
    $pre = $prefix .'-'.$Y.$M;
    $code = $this->pack_model->get_max_code($pre);

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
      'pack_code',
      'pack_user',
      'pack_warehouse',
      'pack_area',
      'pack_from_date',
      'pack_to_date',
      'pack_reference',
      'pack_phase',
      'pack_status'
    );

    return clear_filter($filter);
  }


} //-- end class

?>
