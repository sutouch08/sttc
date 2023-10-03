<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_area extends PS_Controller {
	public $menu_code = 'SCSUBAREA'; //--- Add/Edit Users
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'เพิ่ม/แก้ไข พื้นที่';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/sub_area';
    $this->load->model('admin/sub_area_model');
		$this->load->helper('area');
  }



  public function index()
  {
		$filter = array(
			'name' => get_filter('name', 'area_name', ''),
			'team_id' => get_filter('team_id', 'area_team_id', 'all'),
      'status' => get_filter('status', 'area_status', 'all')
		);

		if($this->input->post('search'))
		{
			redirect($this->home);
		}
		else
		{
			//--- แสดงผลกี่รายการต่อหน้า
			$perpage = get_rows();

			$rows = $this->sub_area_model->count_rows($filter);

			$filter['data'] = $this->sub_area_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

			//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
			$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

			$this->pagination->initialize($init);

			$this->load->view('admin/sub_area/sub_area_list', $filter);			
		}
  }


  public function get($id)
  {
    $sc = TRUE;
    $rs = $this->sub_area_model->get($id);

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
			if($this->input->post('name') && $this->input->post('team_id'))
      {
        $name = trim($this->input->post('name'));
				$team_id = $this->input->post('team_id');
        $active = $this->input->post('status') == 1 ? 1 : 0;

        if( ! $this->sub_area_model->is_exists($name, $team_id))
        {
          $arr = array(
            'name' => $name,
						'team_id' => $team_id,
            'status' => $active,
            'create_at' => now(),
            'create_by' => $this->_user->id
          );

          $id = $this->sub_area_model->add($arr);

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
							'team_id' => $team_id,
							'team_name' => area_name($team_id),
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
    $name = trim($this->input->post('name'));
		$team_id = $this->input->post('team_id');
    $active = $this->input->post('status') == 1 ? 1 : 0;

		$ds = array();

    if($this->pm->can_edit)
    {
      if( ! empty($id) && ! empty($name))
      {
        if( ! $this->sub_area_model->is_exists($name, $team_id, $id))
        {
					$arr = array(
            'name' => $name,
						'team_id' => $team_id,
            'status' => $active,
            'update_at' => now(),
            'update_by' => $this->_user->id
          );

          if( ! $this->sub_area_model->update($id, $arr))
          {
            $sc = FALSE;
            set_error('update');
          }
          else
          {
            $rs = $this->sub_area_model->get($id);

            if(! empty($rs))
            {
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

    if( ! $this->sub_area_model->is_exists_transection($id))
    {
      if( ! $this->sub_area_model->delete($id))
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
    $filter = array("area_team_id", "area_name", "area_status");

    return clear_filter($filter);
  }

} //--- end class

?>
