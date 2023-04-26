<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends PS_Controller
{
	public $title = 'Welcome';
	public $menu_code = 'HOME';
	public $menu_group_code = '';
	public $home;

	public function __construct()
	{
		parent::__construct();
		_check_login();
		$this->pm = new stdClass();
		$this->pm->can_view = 1;
		$this->home = base_url()."main";
	}


	public function index()
	{
		$this->load->view('main_view');
	}


	public function set_rows()
  {
    if($this->input->post('set_rows') && $this->input->post('set_rows') > 0)
    {
      $rows = intval($this->input->post('set_rows'));
      $cookie = array(
        'name' => 'rows',
        'value' => $rows > 300 ? 300 : $rows,
        'expire' => 2592000, //--- 30 days
        'path' => '/'
      );

      $this->input->set_cookie($cookie);
    }
  }


	public function getConfig()
	{
		$code = $this->input->post('config_code');

		echo getConfig($code);
	}


	public function get_user_data()
	{
		$sc = TRUE;
		$uname = $this->input->post('uname');
		$ds = array();
		if( ! empty($uname))
		{
			$user = $this->user_model->get_by_uname($uname);

			if( ! empty($user))
			{
				$ds = (array) $user;
			}
			else
			{
				$sc = FALSE;
				$this->error = "not found";
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "Missing required parameter : 'uname'";
		}

		echo $sc === TRUE ? json_encode($ds) : $this->error;
	}

} //--- end class
