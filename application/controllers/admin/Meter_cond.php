<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meter_cond extends PS_Controller {
	public $menu_code = 'SCDAMG'; //--- Add/Edit Users
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'สภาพมิเตอร์';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/meter_cond';
    $this->load->model('admin/dispose_reason_model');
  }



  public function index()
  {
		$filter = array(
			'pk_id' => get_filter('pk_id', 'pk_id', ''),
			'reason_id' => get_filter('reason_id', 'reason_id', ''),
			'title' => get_filter('title', 'title', ''),
			'desc' => get_filter('desc', 'desc', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->dispose_reason_model->count_rows($filter);

		$filter['data'] = $this->dispose_reason_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('admin/meter_cond/cond_list', $filter);
  }


	public function sync()
	{
		$sc = TRUE;
		$this->load->model('logs_model');
		$this->load->library('scs');

		$response = json_decode($this->scs->init());

    $logs = array(
      'code' => 'init',
      'status' => 'failed'
    );

    if( ! empty($response))
    {
      $list = $response->data->ddlDisposeReason;

      if( ! empty($list))
      {
        foreach($list as $rs)
        {
          $arr = array(
            'pk_id' => $rs->pk_id,
            'reason_id' => $rs->reason_id,
            'title' => $rs->title,
            'description' => $rs->desc,
            'is_break_down' => $rs->is_break_down
          );

          if($this->dispose_reason_model->is_exists($rs->pk_id))
          {
            $this->dispose_reason_model->update($rs->pk_id, $arr);
          }
          else
          {
            $this->dispose_reason_model->add($arr);
          }
        }

        $logs['status'] = 'success';
      }
    }

    $this->logs_model->log_scs($logs);

		echo 'success';
	}


  public function clear_filter()
  {
		$filter = array(
			'pk_id' ,
			'reason_id',
			'title',
			'desc'
		);

    return clear_filter($filter);
  }

} //--- end class

?>
