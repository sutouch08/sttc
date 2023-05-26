<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_item extends PS_Controller
{
  public $menu_code = 'OPUITM';
	public $menu_group_code = 'OP';
	public $title = 'ข้อมูลมิเตอร์';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    if($this->_Lead)
    {
      $this->pm->can_view = 1;
    }

    $this->home = base_url().'inventory/user_item';
    $this->load->model('inventory/user_item_model');
    $this->load->model('admin/warehouse_model');
    $this->load->helper('team');
    $this->load->helper('image');
    $this->load->helper('transfer');
    $this->load->helper('warehouse');
    $this->load->helper('work_list');
  }


  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'u_code', ''),
      'serial' => get_filter('serial', 'u_serial', ''),
      'pea_no' => get_filter('pea_no', 'u_pea_no', ''),
      'docNum' => get_filter('docNum', 'u_docNum', ''),
      'whCode' => get_filter('whCode', 'u_whCode', 'all'),
      'status' => get_filter('status', 'u_status', 'all'),
      'from_date' => get_filter('from_date', 'u_from_date', ''),
      'to_date' => get_filter('to_date', 'u_to_date', ''),
      'team_group' => get_filter('team_group', 'u_team_group', ''),
      'team' => get_filter('team', 'u_team', 'all')
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
      'u_pea_no',
      'u_team',
      'u_team_group',
      'u_docNum',
      'u_whCode',
      'u_status',
      'u_from_date',
      'u_to_date'    
    );

    return clear_filter($filter);
  }


} //-- end class

?>
