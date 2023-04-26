<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends PS_Controller {
	public $menu_code = 'SCOWHS'; //--- Add/Edit Users
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'Warehouse';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/warehouse';
    $this->load->model('admin/warehouse_model');

    if($this->pm->can_view === FALSE)
    {
      $this->deny_page();
    }
  }



  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'wh_code', ''),
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


  public function clear_filter()
  {
    $filter = array("wh_code", "wh_name", "wh_status", "wh_listed");

    return clear_filter($filter);
  }

} //--- end class

?>
