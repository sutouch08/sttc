<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends PS_Controller{
	public $menu_code = 'SCUSER'; //--- Add/Edit Users
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'Users';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'users/users';
		$this->load->model('admin/warehouse_model');
		$this->load->model('admin/team_model');
		$this->load->helper('team');
		$this->load->helper('warehouse');

		if($this->pm->can_view === FALSE)
    {
      $this->deny_page();
    }
  }



  public function index()
  {
		$filter = array(
			'uname' => get_filter('uname', 'user_uname', ''),
			'dname' => get_filter('dname', 'user_dname', ''),
			'ugroup' => get_filter('ugroup', 'user_ugroup', 'all'),
			'team_id' => get_filter('team_id', 'user_team_id', 'all'),
			'active' => get_filter('active', 'user_active', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->user_model->count_rows($filter);

		$filter['data'] = $this->user_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

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
			$whList = $this->warehouse_model->get_listed();
			$teams = $this->team_model->get_all_active();

			$ds = array(
				'whList' => $whList,
				'teamList' => $teams
			);

			$this->load->view('users/user_add', $ds);
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
				$team_id = get_null($this->input->post('team_id'));
				$team_list = json_decode($this->input->post('team_list'));
				$fromWhsCode = $this->input->post('fromWhsCode');
				$toWhsCode = $this->input->post('toWhsCode');
				$pwd = $this->input->post('pwd');
				$ugroup = $this->input->post('ugroup');
				$active = $this->input->post('active') == 1 ? 1 : 0;
				$force_reset = $this->input->post('force_reset') == 1 ? 1 : 0;

				if( ! $this->user_model->is_exists_uname($uname))
				{
					if( ! $this->user_model->is_exists_display_name($dname))
					{
						if($ugroup > 0)
						{
							if(($ugroup == 2 && empty($team_list)) OR ($ugroup == 3 && empty($team_id)))
							{
								$sc = FALSE;
								set_error(0, "Missing Area(s)");
							}

							if($ugroup == 3 && (empty($fromWhsCode) OR empty($toWshCode)) && $fromWhsCode == $toWhsCode)
							{
								$sc = FALSE;
								set_error(0, "Invalid Warehouse");
							}

							if($sc === TRUE)
							{
								$arr = array(
									'uname' => $uname,
									'pwd' => password_hash($pwd, PASSWORD_DEFAULT),
									'name' => $dname,
									'uid' => md5($uname),
									'ugroup' => $ugroup,
									'active' => $active,
									'team_id' => $ugroup == 3 ? $team_id : NULL,
									'fromWhsCode' => $ugroup == 3 ? $fromWhsCode : NULL,
									'toWhsCode' => $ugroup == 3 ? $toWhsCode : NULL,
									'last_pass_change' => date('Y-m-d'),
									'force_reset' => $force_reset,
									'create_at' => now(),
									'create_by' => $this->_user->id
								);

								$this->db->trans_begin();

								$id = $this->user_model->add($arr);

								if( ! $id)
								{
									$sc = FALSE;
									set_error('insert', 'user');
								}
								else
								{
									if($ugroup == 2)
									{
										//--- insert user team
										if( ! empty($team_list))
										{
											foreach($team_list as $tid)
											{
												if($sc === FALSE)
												{
													break;
												}

												$arr = array(
													'user_id' => $id,
													'team_id' => $tid,
													'team_role' => 'Lead'
												);

												if( ! $this->team_model->add_user_team($arr))
												{
													$sc = FALSE;
													set_error('insert', 'user area');
												}
											}
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
						}
						else
						{
							$sc = FALSE;
							set_error('required', ' : User group');
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
				$userTeam = $this->team_model->get_user_team($id);
				$uteam = array();
				if( ! empty($userTeam))
				{
					foreach($userTeam as $rs)
					{
						$uteam[$rs->id] = $rs->id;
					}
				}

				$ds = array(
					'user' => $user,
					'teamList' => $teams,
					'uteam' => $uteam
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
				$team_list = json_decode($this->input->post('team_list'));
				$fromWhsCode = $this->input->post('fromWhsCode');
				$toWhsCode = $this->input->post('toWhsCode');
				$ugroup = $this->input->post('ugroup');
				$active = $this->input->post('active') == 1 ? 1 : 0;

				if( ! $this->user_model->is_exists_display_name($dname, $id))
				{
					if($ugroup > 0)
					{
						if(($ugroup == 2 && empty($team_list)) OR ($ugroup == 3 && empty($team_id)))
						{
							$sc = FALSE;
							set_error(0, "Missing Area(s)");
						}

						if($ugroup == 3 && (empty($fromWhsCode) OR empty($toWhsCode)) && $fromWhsCode == $toWhsCode)
						{
							$sc = FALSE;
							set_error(0, "Invalid Warehouse(s)");
						}

						if($sc === TRUE)
						{
							$arr = array(
								'name' => $dname,
								'ugroup' => $ugroup,
								'active' => $active,
								'team_id' => $ugroup == 3 ? $team_id : NULL,
								'fromWhsCode' => $ugroup == 3 ? $fromWhsCode : NULL,
								'toWhsCode' => $ugroup == 3 ? $toWhsCode : NULL,
								'update_at' => now(),
								'update_by' => $this->_user->id
							);

							$this->db->trans_begin();

							if( ! $this->user_model->update($id, $arr))
							{
								$sc = FALSE;
								set_error('insert', 'user');
							}
							else
							{
								if($sc === TRUE)
								{
									if( ! $this->team_model->drop_user_team($id))
									{
										$sc = FALSE;
										set_error(0, "Drop User area failed");
									}
								}

								if($sc === TRUE)
								{
									if($ugroup == 2)
									{
										//--- insert user team
										if( ! empty($team_list))
										{
											foreach($team_list as $tid)
											{
												if($sc === FALSE)
												{
													break;
												}

												$arr = array(
												'user_id' => $id,
												'team_id' => $tid,
												'team_role' => 'Lead'
												);

												if( ! $this->team_model->add_user_team($arr))
												{
													$sc = FALSE;
													set_error('insert', 'user area');
												}
											}
										}
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
					}
					else
					{
						$sc = FALSE;
						set_error('required', ' : User group');
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




	public function view_detail($id)
	{
		$user = $this->user_model->get($id);

		if(!empty($user))
		{
			$user = $this->user_model->get($id);

			if( ! empty($user))
			{
				$whList = $this->warehouse_model->get_all();
				$userWh = $this->warehouse_model->get_user_warehouse($id);
				$uwh = array();
				if( ! empty($userWh))
				{
					foreach($userWh as $rs)
					{
						$uwh[$rs->id] = $rs->code;
					}
				}

				$teams = $this->team_model->get_all_active();
				$userTeam = $this->team_model->get_user_team($id);
				$uteam = array();
				if( ! empty($userTeam))
				{
					foreach($userTeam as $rs)
					{
						$uteam[$rs->id] = $rs->id;
					}
				}

				$ds = array(
					'user' => $user,
					'whList' => $whList,
					'uwh' => $uwh,
					'teamList' => $teams,
					'uteam' => $uteam
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


	public function clear_filter()
	{
		$filter = array('user_uname', 'user_dname', 'user_team_id', 'user_ugroup', 'user_active');

		return clear_filter($filter);

	}

}//--- end class


 ?>
