<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_list extends PS_Controller
{
  public $menu_code = 'OPWOLS';
	public $menu_group_code = 'OP';
	public $title = 'ใบสั่งงาน';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/work_list';
    $this->load->model('inventory/work_list_model');
    $this->load->helper('team');
    $this->load->helper('work_list');

    if($this->_Lead)
    {
      $this->pm = grant_permission();
    }
  }


  public function index()
  {
		$filter = array(
			'pea_no' => get_filter('pea_no', 'pea_no', ''),
      'customer' => get_filter('customer', 'customer', ''),
      'ca_no' => get_filter('ca_no', 'ca_no', ''),
      'cust_route' => get_filter('cust_route', 'cust_route', ''),
      'team_id' => get_filter('team_id', 'w_team_id', 'all'),
      'team_group' => get_filter('team_group', 'w_team_group', ''),
      'assigned' => get_filter('assigned', 'assigned', 'all'),
      'status' => get_filter('status', 'w_status', 'all'),
      'from_date' => get_filter('from_date', 'w_from_date', ''),
      'to_date' => get_filter('to_date', 'w_to_date', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->work_list_model->count_rows($filter);

		$filter['data'] = $this->work_list_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $filter['count_rows'] = $rows;
    $filter['team'] = team_array();
    $filter['myteam'] = ($this->_Admin OR $this->_SuperAdmin) ? select_team($filter['team_id']) : select_my_team($this->_user->id, $filter['team_id']);

    $this->load->view('inventory/work_list/work_list', $filter);
  }



  public function get_team_group_by_team()
  {
    $this->load->model('admin/group_model');
    $ds = array();
    $team_id = $this->input->get('team_id');
    $groups = $this->group_model->get_by_team_id($team_id);

    if( ! empty($groups))
    {
      foreach($groups as $rs)
      {
        $arr = array(
          'id' => $rs->id,
          'name' => $rs->name
        );

        array_push($ds, $arr);
      }
    }

    echo json_encode($ds);
  }


  public function assign_work_list()
  {
    $sc = TRUE;
    $team_group_id = $this->input->post('team_group_id');
    $work_list = json_decode($this->input->post('work_list'));

    if( ! empty($work_list))
    {
      if( ! $this->work_list_model->assign_work_list($work_list, $team_group_id) )
      {
        $sc = FALSE;
        $this->error = "มอบหมายใบงานไม่สำเร็จ";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบข้อมูลใบงาน";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function unassign_work_list()
  {
    $sc = TRUE;
    $work_list = json_decode($this->input->post('work_list'));

    if( ! empty($work_list))
    {
      if( ! $this->work_list_model->unassign_work_list($work_list) )
      {
        $sc = FALSE;
        $this->error = "ยกเลิกการมอบหมายใบงานไม่สำเร็จ";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบข้อมูลใบงาน";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }

  public function clear_filter()
  {
    $filter = array(
			'pea_no',
      'customer',
      'ca_no',
      'cust_route',
      'w_team_id',
      'team_selected',
      'w_team_group',
      'w_status',
      'assigned',
      'w_from_date',
      'w_to_date'
		);

    return clear_filter($filter);
  }


} //-- end class

?>
