<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends PS_Controller {
	public $menu_code = 'SCTEAM'; //--- Add/Edit Users
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'เพิ่ม/แก้ไข เขต';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/team';
    $this->load->model('admin/team_model');
  }



  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'team_code', ''),
			'name' => get_filter('name', 'team_name', ''),
			'contract_no' => get_filter('contract_no', 'contract_no', ''),
      'status' => get_filter('status', 'team_status', 'all')
		);

		if($this->input->post('search'))
		{
			redirect($this->home);
		}
		else
		{
			//--- แสดงผลกี่รายการต่อหน้า
			$perpage = get_rows();

			$rows = $this->team_model->count_rows($filter);

			$filter['data'] = $this->team_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

			//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
			$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

			$this->pagination->initialize($init);

			$this->load->view('admin/team/team_list', $filter);
		}
  }


  public function get($id)
  {
    $sc = TRUE;
    $rs = $this->team_model->get($id);

    if( ! empty($rs))
    {
      $rs->create_at = thai_date($rs->create_at, FALSE);
      $rs->update_at = thai_date($rs->update_at, FALSE);
      $rs->create_by = uname($rs->create_by);
      $rs->update_by = uname($rs->update_by);
    }
    else
    {
      $sc = FALSE;
      set_error('notfound');
    }

    echo $sc === TRUE ? json_encode((array) $rs) : $this->error;
  }


  public function add()
  {
    $sc = TRUE;
		$ds = array();

		if($this->pm->can_add)
		{
			if($this->input->post('code') && $this->input->post('name'))
      {
				$code = trim($this->input->post('code'));
        $name = trim($this->input->post('name'));
				$full_name = trim($this->input->post('full_name'));
				$contract_no = trim($this->input->post('contract_no'));
				$list_no = trim($this->input->post('list_no'));
				$worker = $this->input->post('worker');
				$tor_qty = $this->input->post('qty');
        $active = $this->input->post('status') == 1 ? 1 : 0;

        if( ! $this->team_model->is_exists($code))
        {
          $arr = array(
						'code' => $code,
            'name' => $name,
						'full_name' => $full_name,
						'contract_no' => $contract_no,
						'list_no' => $list_no,
						'tor_worker' => $worker > 0 ? $worker : 1,
						'tor_qty' => $tor_qty > 0 ? $tor_qty : 0,
            'status' => $active,
            'create_at' => now(),
            'create_by' => $this->_user->id
          );

          $id = $this->team_model->add($arr);

          if( ! $id)
          {
            $sc = FALSE;
            set_error('insert');
          }
          else
          {
            $ds = array(
              'id' => $id,
							'code' => $code,
              'name' => $name,
							'full_name' => $full_name,
							'contract_no' => $contract_no,
							'list_no' => $list_no,
              'status' => is_active($active),
							'tor_worker' => $worker > 0 ? $worker : 1,
							'tor_qty' => $tor_qty > 0 ? number($tor_qty) : 1,
              'create_at' => thai_date(now(), FALSE),
              'create_by' => $this->_user->uname,
              'update_by' => "",
              'update_by' => ""
            );
          }
        }
        else
        {
          $sc = FALSE;
          set_error('exists', $code);
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
      set_error('permission');
		}

    return $this->_json_response($sc, $ds);
  }


  public function update()
  {
    $sc = TRUE;
    $id = $this->input->post('id');
		$code = trim($this->input->post('code'));
    $name = trim($this->input->post('name'));
		$full_name = trim($this->input->post('full_name'));
		$contract_no = trim($this->input->post('contract_no'));
		$list_no = trim($this->input->post('list_no'));
		$worker = $this->input->post('worker');
		$tor_qty = $this->input->post('qty');
    $active = $this->input->post('status') == 1 ? 1 : 0;

		$ds = array();

    if($this->pm->can_edit)
    {
      if( ! empty($id) && ! empty($name))
      {
        if( ! $this->team_model->is_exists($code, $id))
        {
          $arr = array(
						'code' => $code,
            'name' => $name,
						'full_name' => $full_name,
						'contract_no' => $contract_no,
						'list_no' => $list_no,
						'tor_worker' => $worker > 0 ? $worker : 1,
						'tor_qty' => $tor_qty > 0 ? $tor_qty : 1,
            'status' => $active,
            'update_at' => now(),
            'update_by' => $this->_user->id
          );

          if( ! $this->team_model->update($id, $arr))
          {
            $sc = FALSE;
            set_error('update');
          }
          else
          {
            $rs = $this->team_model->get($id);

            if(! empty($rs))
            {
							$rs->tor_qty = number($rs->tor_qty);
              $rs->status = is_active($rs->status);
              $rs->create_at = thai_date($rs->create_at, FALSE);
              $rs->update_at = thai_date($rs->update_at, FALSE);
              $rs->create_by = uname($rs->create_by);
              $rs->update_by = uname($rs->update_by);

							$ds = (array) $rs;
            }
            else
            {
              $sc = FALSE;
              set_error('notfound');
            }
          }
        }
        else
        {
          $sc = FALSE;
          set_error('exists', $name);
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
      set_error('permission');
    }

    $this->_json_response($sc, $ds);
  }


  public function delete()
  {
    $sc = TRUE;
    $id = $this->input->post('id');

    if( ! $this->team_model->is_exists_transection($id))
    {
      if( ! $this->team_model->delete($id))
      {
        $sc = FALSE;
        set_error('delete');
      }
    }
    else
    {
      $sc = FALSE;
      set_error('transection');
    }

    $this->_response($sc);
  }


  public function clear_filter()
  {
    $filter = array("team_code", "team_name", "team_status", "contract_no");

    return clear_filter($filter);
  }

} //--- end class

?>
