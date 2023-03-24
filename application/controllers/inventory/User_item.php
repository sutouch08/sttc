<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_item extends PS_Controller
{
  public $menu_code = 'OPUITM';
	public $menu_group_code = 'OP';
	public $title = 'User Items';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/user_item';
    $this->load->model('inventory/user_item_model');
    $this->load->model('admin/warehouse_model');
    $this->load->helper('team');
    $this->load->helper('image');
    $this->load->helper('transfer');
    $this->load->helper('warehouse');
  }


  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'u_code', ''),
      'serial' => get_filter('serial', 'u_serial', ''),
      'docNum' => get_filter('docNum', 'u_docNum', ''),
      'whCode' => get_filter('whCode', 'u_whCode', 'all'),
      'status' => get_filter('status', 'u_status', 'all'),
      'from_date' => get_filter('from_date', 'u_from_date', ''),
      'to_date' => get_filter('to_date', 'u_to_date', ''),      
      'user' => get_filter('user', 'u_user', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->user_item_model->count_rows($filter);

		$filter['data'] = $this->user_item_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('inventory/user_item/user_item_list', $filter);
  }



  public function clear_filter()
  {
    $filter = array(
      'u_code',
      'u_serial',
      'u_docNum',
      'u_whCode',
      'u_status',
      'u_from_date',
      'u_to_date',
      'u_user'
    );

    return clear_filter($filter);
  }


} //-- end class

?>
