<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PS_Controller extends CI_Controller
{
  public $pm;
  public $home;
	public $_user;
	public $_SuperAdmin = FALSE;
	public $_Admin = FALSE;
  public $_Lead = FALSE;
  public $_Outsource = FALSE;
	public $ms;
  public $mc;
  public $e = NULL;
  public $error;


  public function __construct()
  {
    parent::__construct();


    //--- check is user has logged in ?
    _check_login();

    $uid = get_cookie('uid');

		$this->_user = $this->user_model->get_user_by_uid($uid);

		$this->close_system   = getConfig('CLOSE_SYSTEM'); //--- ปิดระบบทั้งหมดหรือไม่
		$this->_SuperAdmin = $this->_user->ugroup == -987654321 ? TRUE : FALSE;
		$this->_Admin = $this->_user->ugroup == 1 ? TRUE : FALSE;
    $this->_Lead = $this->_user->ugroup == 2 ? TRUE : FALSE;
    $this->_Outsource = $this->_user->ugroup == 3 ? TRUE : FALSE;

    //$this->ms = $this->load->database('ms', TRUE);

    if($this->close_system == 1 && $this->_SuperAdmin === FALSE)
    {
      redirect(base_url().'maintenance');
    }

		if( ! $this->_SuperAdmin && $this->is_expire_password($this->_user->last_pass_change))
		{
			redirect(base_url().'change_password/e');
		}

		if($this->_user->force_reset)
		{
			redirect(base_url().'change_password/f');
		}

    $this->pm = get_permission($this->menu_code, $this->_user->id);
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


	public function _response($sc = TRUE)
  {
    echo $sc === TRUE ? 'success' : $this->error;
  }

  public function _json_response($sc , $arr)
  {
    echo $sc === TRUE ? json_encode($arr) : $this->error;
  }

  public function deny_page()
  {
    return $this->load->view('deny_page');
  }

  public function permission_deny()
  {
    return $this->load->view('permission_deny');
  }

	public function permission_page()
  {
    return $this->load->view('permission_deny');
  }

  public function expired_page()
  {
    return $this->load->view('expired_page');
  }


  public function error_page()
  {
    return $this->load->view('page_error');
  }

  public function page_error()
  {
    return $this->load->view('page_error');
  }
}

?>
