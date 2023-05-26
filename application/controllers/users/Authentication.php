<?php
class Authentication extends CI_Controller
{
	public $error;

  public function __construct()
	{
		parent::__construct();
		$this->home = base_url()."users/authentication";
	}


	public function index()
	{
		$this->load->view("login");
	}



	public function validate_credentials()
	{
    $sc = TRUE;
    $user_name = $this->input->post('uname');
    $pwd = $this->input->post('pwd');
		$rem = $this->input->post('remember') == 1 ? TRUE : FALSE;

		//$rs = $this->user_model->get_user_credentials($user_name);
		$rs = $this->user_model->get_by_uname($user_name);

    if(! empty($rs))
    {
			if(password_verify($pwd, $rs->pwd))
			{
				if($rs->active == 0)
				{
					$sc = FALSE;
	        $this->error = 'Your account has been suspended';
				}
				else
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
						'toWhsCode' => $rs->toWhsCode
					);

					$this->create_user_data($ds, $rem);
				}
			}
			else
			{
				$sc = FALSE;
        $this->error = 'Username or password is incorrect';
			}
    }
    else
    {
			$sc = FALSE;
			$this->error = 'Username or password is incorrect';
    }

		$arr = array(
			'status' => $sc === TRUE ? 'success' : 'failed',
			'message' => $sc === TRUE ? 'success' : $this->error,
			'userdata' => $sc === TRUE ? $ds : NULL
		);

		echo json_encode($arr);
		//echo $sc === TRUE ? 'success' : $this->error;
	}



  public function create_user_data(array $ds = array(), $remember = FALSE )
  {
    if(!empty($ds))
    {
      $time = intval(86400); //-- 1 days

			$times = $time * 365 ; //$remember === TRUE ? ($time * 365) : $time;

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
  }




	public function logout()
	{
		delete_cookie('uid');
    delete_cookie('displayName');
    delete_cookie('ugroup');
		delete_cookie('uname');
    redirect($this->home);
	}


} //--- end class


 ?>
