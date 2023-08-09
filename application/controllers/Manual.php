<?php
class Manual extends PS_Controller
{
  public $title = 'Dowload Manual';
	public $menu_code = 'Manual';
	public $menu_group_code = '';
	public $home;

	public function __construct()
	{
		parent::__construct();
		_check_login();
		$this->pm = new stdClass();
		$this->pm->can_view = 1;
		$this->home = base_url()."manual";
	}

  public function index()
  {
    $this->load->helper('download');

    $file = $this->config->item('upload_path')."manual.pdf";

    force_download($file, null);
  }
}

 ?>
