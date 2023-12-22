<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends PS_Controller{
	public $menu_code = 'SCUSER'; //--- Add/Edit Users
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'ผู้ใช้งาน';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'users/users';
		$this->load->model('admin/warehouse_model');
		$this->load->model('admin/team_model');
		$this->load->helper('team');
		$this->load->helper('warehouse');
  }



  public function index()
  {
		$filter = array(
			'uname' => get_filter('uname', 'user_uname', ''),
			'dname' => get_filter('dname', 'user_dname', ''),
			'ugroup' => get_filter('ugroup', 'user_ugroup', 'all'),
			'team_id' => get_filter('team_id', 'user_team_id', 'all'),
			'fromWhs' => get_filter('fromWhs', 'user_fromWhs', 'all'),
			'toWhs' => get_filter('toWhs', 'user_toWhs', 'all'),
			'active' => get_filter('active', 'user_active', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->user_model->count_rows($filter);

		$filter['data'] = $this->user_model->get_list($filter, $perpage, $this->uri->segment($this->segment));
		$filter['can_edit_permission'] = $this->can_edit_permission();

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('users/users_list', $filter);
  }





  public function add_new()
  {
		if($this->pm->can_add)
		{
			$this->title = "Add user";

			$this->load->view('users/user_add');
		}
		else
		{
			$this->permission_deny();
		}
  }



	public function add()
	{
		$sc = TRUE;

		if($this->pm->can_add)
		{
			if($this->input->post())
			{
				$uname = trim($this->input->post('uname'));
				$dname = trim($this->input->post('dname'));
				$ugroup = $this->input->post('ugroup');
				$team_id = get_null($this->input->post('team_id'));
				$fromWhsCode = get_null($this->input->post('fromWhsCode'));
				$toWhsCode = get_null($this->input->post('toWhsCode'));
				$cut_off_date = get_null($this->input->post('cut_off_date'));
				$pwd = $this->input->post('pwd');
				$active = $this->input->post('active') == 1 ? 1 : 0;
				$force_reset = $this->input->post('force_reset') == 1 ? 1 : 0;

				if( ! $this->user_model->is_exists_uname($uname))
				{
					if( ! $this->user_model->is_exists_display_name($dname))
					{
						$arr = array(
							'uname' => $uname,
							'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
							'name' => $dname,
							'uid' => md5($uname),
							'ugroup' => $ugroup,
							'active' => $active,
							'team_id' => $team_id,
							'fromWhsCode' => $fromWhsCode,
							'toWhsCode' => $toWhsCode,
							'last_pass_change' => date('Y-m-d'),
							'force_reset' => $force_reset,
							'create_at' => now(),
							'create_by' => $this->_user->id,
							'cut_off_date' => empty($cut_off_date) ? NULL : db_date($cut_off_date)
						);

						if( ! $this->user_model->add($arr))
						{
							$sc = FALSE;
							set_error('insert', 'user');
						}
					}
					else
					{
						$sc = FALSE;
						set_error('exists', "Display name : {$dname}");
					}
				}
				else
				{
					$sc = FALSE;
					set_error('exists', "Username : {$uname}");
				}
			}
			else
			{
				$sc = FALSE;
				set_error('required', ' : form data');
			}
		}
		else
		{
			$sc = FALSE;
			set_error('permission');
		}

		$this->_response($sc);
	}


	public function edit($id)
	{
		$this->title = "Edit user";

		if($this->pm->can_edit)
		{
			$user = $this->user_model->get($id);

			if( ! empty($user))
			{
				$teams = $this->team_model->get_all_active();

				$ds = array(
					'user' => $user,
					'teamList' => $teams
				);

				$this->load->view('users/user_edit', $ds);
			}
			else
			{
				$this->error_page();
			}
		}
		else
		{
			$this->permission_deny();
		}
	}


	public function update()
	{
		$sc = TRUE;

		if($this->pm->can_edit)
		{
			if($this->input->post())
			{
				$id = $this->input->post('id');
				$dname = trim($this->input->post('dname'));
				$team_id = get_null($this->input->post('team_id'));
				$ugroup = $this->input->post('ugroup');
				$fromWhsCode = get_null($this->input->post('fromWhsCode'));
				$toWhsCode = get_null($this->input->post('toWhsCode'));
				$cut_off_date = get_null($this->input->post('cut_off_date'));
				$active = $this->input->post('active') == 1 ? 1 : 0;

				if( ! $this->user_model->is_exists_display_name($dname, $id))
				{
					$arr = array(
						'name' => $dname,
						'ugroup' => $ugroup,
						'active' => $active,
						'team_id' => $team_id,
						'fromWhsCode' => $fromWhsCode,
						'toWhsCode' => $toWhsCode,
						'update_at' => now(),
						'update_by' => $this->_user->id,
						'cut_off_date' => empty($cut_off_date) ? NULL : db_date($cut_off_date)
					);

					if( ! $this->user_model->update($id, $arr))
					{
						$sc = FALSE;
						set_error('insert', 'user');
					}
				}
				else
				{
					$sc = FALSE;
					set_error('exists', "Display name : {$dname}");
				}
			}
			else
			{
				$sc = FALSE;
				set_error('required', ' : form data');
			}
		}
		else
		{
			$sc = FALSE;
			set_error('permission');
		}

		$this->_response($sc);
	}


	public function get_warehouse_list_by_area()
	{
		$sc = TRUE;
		$area = $this->input->post('area');
		$fromWhs = '<option value="">--ไม่รุบุ--</option>';
		$toWhs = '<option value="">--ไม่รุบุ--</option>';

		if( ! empty($area))
		{
			$fromWhs = select_listed_warehouse_by_role_and_area(2, $area);
			$toWhs = select_listed_warehouse_by_role_and_area(3, $area);

			if(empty($fromWhs))
			{
				$fromWhs = '<option value="">--ไม่รุบุ--</option>'.select_listed_warehouse_by_role(2);
			}

			if(empty($toWhs))
			{
				$toWhs = '<option value="">--ไม่รุบุ--</option>'.select_listed_warehouse_by_role(3);
			}
		}


		$arr = array(
			'fromWhs' => $fromWhs,
			'toWhs' => $toWhs
		);

		echo json_encode($arr);
	}




	public function view_detail($id)
	{
		$user = $this->user_model->get($id);

		if(!empty($user))
		{
			$user = $this->user_model->get($id);

			if( ! empty($user))
			{
				$teams = $this->team_model->get_all_active();

				$ds = array(
					'user' => $user,
					'teamList' => $teams
				);

				$this->load->view('users/user_detail', $ds);
			}
			else
			{
				$this->error_page();
			}
		}
	}


	public function delete()
	{
		$sc = TRUE;

		if($this->pm->can_delete)
		{
			$id = $this->input->post('id');

			if( ! empty($id))
			{
				if( ! $this->user_model->has_transection($id))
				{
					if( ! $this->user_model->delete($id))
					{
						$sc = FALSE;
						set_error('delete');
					}
					else
					{
						$this->load->model('masters/warehouse_model');
						$this->warehouse_model->drop_user_warehouse($id);
					}
				}
				else
				{
					$sc = FALSE;
					$this->error = "Delete failed because completed transection exists OR link to another module.";
				}
			}
			else
			{
				$sc = FALSE;
				set_error('required', ' : id');
			}
		}
		else
		{
			$sc = FALSE;
			set_error('permission');
		}

		$this->_response($sc);
	}



	public function reset_password($id)
	{
		$this->title = 'Reset Password';

		if($this->pm->can_edit OR $this->pm->can_add)
		{
			$user = $this->user_model->get($id);

			if( ! empty($user))
			{
				$this->load->view('users/user_reset_pwd', array('user' => $user));
			}
			else
			{
				$this->error_page();
			}
		}
		else
		{
			$this->permission_deny();
		}
	}



	public function change_pwd()
	{
		$sc = TRUE;

		if($this->pm->can_edit OR $this->pm->can_add)
		{
			$id = $this->input->post('id');
			$pwd = $this->input->post('pwd');
			$force = $this->input->post('force_reset') == 1 ? 1 : 0;

			if( ! empty($id) && ! empty($pwd))
			{
				$arr = array(
					'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
					'last_pass_change' => date('Y-m-d'),
					'force_reset' => $force
				);

				if( ! $this->user_model->update($id, $arr))
				{
					$sc = FALSE;
					set_error('update', 'password');
				}
			}
			else
			{
				$sc = FALSE;
				set_error('required', 'Password and id');
			}
		}
		else
		{
			$sc = FALSE;
			set_error('permission');
		}

		$this->_response($sc);
	}


	public function valid_uname()
	{
		$uname = trim($this->input->get('uname'));
		$id = $this->input->get('id');

		if( ! $this->user_model->is_exists_uname($uname, $id))
		{
			echo "ok";
		}
		else
		{
			echo "exists";
		}
	}


	public function valid_dname()
	{
		$dname = trim($this->input->get('dname'));
		$id = $this->input->get('id');

		if( ! $this->user_model->is_exists_display_name($dname, $id))
		{
			echo "OK";
		}
		else
		{
			echo "exists";
		}
	}



	public function user_permission($user_id)
	{
		$this->load->model('menu');
		$user = $this->user_model->get($user_id);

		if( ! empty($user))
		{
			$this->title = 'Permissions - '.$user->uname;
	    $data['menus'] = array();
			$data['user'] = $user;

	    $groups = $this->menu->get_active_menu_groups();
	    if(!empty($groups))
	    {
	      foreach($groups as $group)
	      {
	        $ds = array(
	          'group_code' => $group->code,
	          'group_name' => $group->name,
	          'menu' => ''
	        );

	        $menus = $this->menu->get_menus_by_group($group->code);

	        if(!empty($menus))
	        {
	          $item = array();

	          foreach($menus as $menu)
	          {
							if($menu->valid)
							{
								$arr = array(
		              'menu_code' => $menu->code,
		              'menu_name' => $menu->name,
		              'permission' => $this->user_model->get_permission($menu->code, $user_id)
		            );
		            array_push($item, $arr);
							}

	          }

	          $ds['menu'] = $item;
	        }

	        array_push($data['menus'], $ds);
	      }
	    }

	    $this->load->view('users/permission_edit', $data);
		}
		else
		{
			$this->page_error();
		}
	}


	public function update_permission()
	{
		$sc = TRUE;

		$user_id = $this->input->post('user_id');
		$perm = json_decode($this->input->post('data'));

		$user = $this->user_model->get($user_id);

		if($this->can_edit_permission($this->_user->id) === TRUE)
		{
			if( ! empty($perm))
			{
				if($this->user_model->drop_permission($user_id))
				{
					foreach($perm as $rs)
					{
						if($sc === FALSE) {	break; }

						$arr =array(
							'user_id' => $user_id,
							'menu' => $rs->menu,
							'can_view' => $rs->view,
							'can_add' => $rs->add,
							'can_edit' => $rs->edit,
							'can_delete' => $rs->delete,
							'can_approve' => $rs->approve
						);

						if( ! $this->user_model->add_permission($arr))
						{
							$sc = FALSE;
							set_error("insert");
						}
					}
				}
				else
				{
					$sc = FALSE;
					set_error("delete", "Current Permission");
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

		echo $sc === TRUE ? 'success' : $this->error;
	}

	private function can_edit_permission()
	{

		if($this->_SuperAdmin)
		{
			return TRUE;
		}

		$pm = $this->user_model->get_permission('SCPERM', $this->_user->id);

		if( ! empty($pm))
		{
			if($pm->can_add OR $pm->can_edit)
			{
				return TRUE;
			}
		}

		return FALSE;
	}




	public function clear_filter()
	{
		$filter = array('user_uname', 'user_dname', 'user_team_id', 'user_fromWhs', 'user_toWhs','user_ugroup', 'user_active');

		return clear_filter($filter);

	}

}//--- end class


 ?>
