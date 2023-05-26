<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends PS_Controller {
	public $menu_code = 'SCGROUP'; //--- Add/Edit User Group
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'เพิ่ม/แก้ไข ทีมติดตั้ง';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/group';
		$this->load->model('admin/warehouse_model');
    $this->load->model('admin/group_model');
		$this->load->model('admin/team_model');
		$this->load->helper('team');
		$this->load->helper('warehouse');
  }



  public function index()
  {
		$filter = array(
			'name' => get_filter('name', 'group_name', ''),
			'team' => get_filter('team', 'group_team', 'all'),
			'fromWhsCode' => get_filter('fromWhsCode', 'group_fromWhsCode', 'all'),
			'toWhsCode' => get_filter('toWhsCode', 'group_toWhsCode', 'all'),
      'status' => get_filter('status', 'group_status', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->group_model->count_rows($filter);

		$filter['data'] = $this->group_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('admin/group/group_list', $filter);
  }


  public function get($id)
  {
    $sc = TRUE;
    $rs = $this->group_model->get($id);

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


	public function get_team_group_by_team_id()
	{
		$sc = TRUE;

		$team_id = $this->input->get('team_id');

		$groups = empty($team_id) ? NULL : $this->group_model->get_by_team_id($team_id);

		if(empty($groups))
		{
			$sc = FALSE;
			set_error('notfound');
		}

		echo $sc === TRUE ? json_encode((array) $groups) : $this->error;
	}


  public function add()
  {
    $sc = TRUE;

		if($this->pm->can_add)
		{
			if($this->input->post('name') && $this->input->post('team'))
      {
        $name = trim($this->input->post('name'));
				$team_id = $this->input->post('team');
				$team_name = $this->input->post('team_name');
				$fromWhsCode = $this->input->post('fromWhsCode');
				$fromWhsName = $this->input->post('fromWhsName');
				$toWhsCode = $this->input->post('toWhsCode');
				$toWhsName = $this->input->post('toWhsName');
        $active = $this->input->post('status') == 1 ? 1 : 0;

        if( ! $this->group_model->is_exists($name))
        {
          $arr = array(
            'name' => $name,
						'team_id' => $team_id,
						'fromWhsCode' => $fromWhsCode,
						'toWhsCode' => $toWhsCode,
            'status' => $active,
            'create_at' => now(),
            'create_by' => $this->_user->id
          );

          $id = $this->group_model->add($arr);

          if( ! $id)
          {
            $sc = FALSE;
            set_error('insert');
          }
          else
          {
            $ds = array(
              'id' => $id,
              'name' => $name,
							'team' => $team_id,
							'team_name' => $team_name,
							'fromWhsCode' => $fromWhsCode,
							'fromWhsName' => $fromWhsName,
							'toWhsCode' => $toWhsCode,
							'toWhsName' => $toWhsName,
              'status' => is_active($active),
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

    return $this->_json_response($sc, $ds);
  }


  public function update()
  {
    $sc = TRUE;
    $id = $this->input->post('id');
		$name = trim($this->input->post('name'));
		$team_id = $this->input->post('team');
		$team_name = $this->input->post('team_name');
		$fromWhsCode = $this->input->post('fromWhsCode');
		$fromWhsName = $this->input->post('fromWhsName');
		$toWhsCode = $this->input->post('toWhsCode');
		$toWhsName = $this->input->post('toWhsName');
		$active = $this->input->post('status') == 1 ? 1 : 0;

    if($this->pm->can_edit)
    {
      if( ! empty($id) && ! empty($name) && ! empty($team_id))
      {
        if( ! $this->group_model->is_exists($name, $id))
        {
          $arr = array(
            'name' => $name,
						'team_id' => $team_id,
						'fromWhsCode' => $fromWhsCode,
						'toWhsCode' => $toWhsCode,
            'status' => $active,
            'update_at' => now(),
            'update_by' => $this->_user->id
          );

          if( ! $this->group_model->update($id, $arr))
          {
            $sc = FALSE;
            set_error('update');
          }
          else
          {
            $rs = $this->group_model->get($id);

            if(! empty($rs))
            {
              $rs->status = is_active($rs->status);
              $rs->create_at = thai_date($rs->create_at, FALSE);
              $rs->update_at = thai_date($rs->update_at, FALSE);
              $rs->create_by = uname($rs->create_by);
              $rs->update_by = uname($rs->update_by);
							$rs->fromWhsName = empty($rs->fromWhsCode) ? "" : $rs->fromWhsCode.' : '.$rs->from_warehouse_name;
							$rs->toWhsName = empty($rs->toWhsCode) ? "" : $rs->toWhsCode.' : '.$rs->to_warehouse_name;
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

    $this->_json_response($sc, (array) $rs);
  }


  public function delete()
  {
    $sc = TRUE;
    $id = $this->input->post('id');

    if( ! $this->group_model->is_exists_transection($id))
    {
      if( ! $this->group_model->delete($id))
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
    $filter = array("group_name", "group_team", "group_status", "group_fromWhsCode", "group_toWhsCode");

    return clear_filter($filter);
  }

} //--- end class

?>
