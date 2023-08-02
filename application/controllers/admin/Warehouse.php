<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends PS_Controller {
	public $menu_code = 'SCOWHS'; //--- Add/Edit Users
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'คลังสินค้า';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/warehouse';
    $this->load->model('admin/warehouse_model');
		$this->load->helper('area');
  }



  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'wh_code', ''),
			'role' => get_filter('role', 'wh_role', 'all'),
			'area' => get_filter('area', 'wh_area', 'all'),
			'name' => get_filter('name', 'wh_name', ''),
			'listed' => get_filter('listed', 'wh_listed', 'all'),
      'status' => get_filter('status', 'wh_status', 'all')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->warehouse_model->count_rows($filter);

		$filter['data'] = $this->warehouse_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('admin/warehouse/warehouse_list', $filter);
  }


	function update_listed($id)
	{
		$sc = TRUE;

		$listed = $this->input->post('listed') == 1 ? 1 : 0;

		$arr = array('listed' => $listed);

		if( ! $this->warehouse_model->update($id, $arr))
		{
			$sc = FALSE;
			set_error('update');
		}

		$this->_response($sc);
	}



	public function syncData()
	{

		$data = $this->warehouse_model->getSyncData();

		if( ! empty($data))
		{
			foreach($data as $rs)
			{
				$id = $this->warehouse_model->get_id($rs->code);

				if( ! $id)
				{
					$arr = array(
						'code' => $rs->code,
						'name' => $rs->name,
						'status' => $rs->Inactive == 'Y' ? 0 : 1,
						'last_sync' => now()
					);

					$this->warehouse_model->add($arr);
				}
				else
				{
					$arr = array(
						'name' => $rs->name,
						'status' => $rs->Inactive == 'Y' ? 0 : 1,
						'last_sync' => now()
					);

					$this->warehouse_model->update($id, $arr);
				}
			}
		}
	}

	public function get_data($id)
	{
		$sc = TRUE;
		$ds = array();
		$wh = $this->warehouse_model->get($id);

		if( ! empty($wh))
		{
			$ds = array(
				'id' => $wh->id,
				'code' => $wh->code,
				'name' => $wh->name,
				'area' => $wh->team_id,
				'role' => $wh->role
			);
		}
		else
		{
			$sc = FALSE;
			$this->error = "Not found";
		}

		echo $sc === TRUE ? json_encode($ds) : $this->error;
	}


	public function update()
	{
		$sc = TRUE;
		$id = $this->input->post('id');
		$area = get_null($this->input->post('area'));
		$role = get_null($this->input->post('role'));

		$arr = array(
			'team_id' => $area,
			'role' => $role
		);

		if( ! $this->warehouse_model->update($id, $arr))
		{
			$sc = FALSE;
			$this->error = "Update failed";
		}

		echo $sc === TRUE ? 'success' : $this->error;
	}


  public function clear_filter()
  {
    $filter = array("wh_code", "wh_name", "wh_status", "wh_listed", "wh_area", "wh_role");

    return clear_filter($filter);
  }

} //--- end class

?>
