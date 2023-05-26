<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pea_data extends PS_Controller
{
  public $menu_code = 'OPPEAD';
	public $menu_group_code = 'OP';
	public $title = 'PEA Data';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/pea_data';
    $this->load->model('inventory/pea_data_model');
  }


  public function index()
  {
		$filter = array(
			'pea_no' => get_filter('pea_no', 'u_pea_no', ''),
      'from_date' => get_filter('from_date', 'u_from_date', ''),
      'to_date' => get_filter('to_date', 'u_to_date', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->pea_data_model->count_rows($filter);

		$filter['data'] = $this->pea_data_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('inventory/pea_data/pea_data_list', $filter);
  }



  public function clear_filter()
  {
    $filter = array(
      'u_pea_no',
      'u_from_date',
      'u_to_date'
    );

    return clear_filter($filter);
  }


} //-- end class

?>
