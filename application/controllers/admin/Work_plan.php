<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work_plan extends PS_Controller
{
  public $menu_code = 'SCWOPL';
	public $menu_group_code = 'SC';
	public $title = 'WORK PLAN';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/work_plan';
    $this->load->model('admin/work_plan_model');
    $this->load->helper('team');
  }


  public function index()
  {
		$filter = array(
			'pea_no' => get_filter('pea_no', 'w_pea_no', ''),
      'cust_no' => get_filter('cust_no', 'cust_no', ''),
      'ca_no' => get_filter('ca_no', 'ca_no', ''),
      'cust_name' => get_filter('cust_name', 'cust_name', ''),
      'cust_tel' => get_filter('cust_tel', 'cust_tel', ''),
      'cust_route' => get_filter('cust_route', 'cust_route', ''),
      'plan_table_name' => get_filter('plan_table_name', 'plan_table_name', ''),
      'team_id' => get_filter('team_id', 'w_team_id', 'all'),
      'from_date' => get_filter('from_date', 'w_from_date', ''),
      'to_date' => get_filter('to_date', 'w_to_date', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->work_plan_model->count_rows($filter);

		$filter['data'] = $this->work_plan_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $filter['team'] = team_array();

    $this->load->view('admin/work_plan/work_plan', $filter);
  }



  public function add_to_team()
  {
    $sc = TRUE;
    $team_id = $this->input->post('team_id');
    $team_id = $team_id === 'null' ? NULL : $team_id;
    $rows = json_decode($this->input->post('data'));

    if( ! empty($team_id))
    {
      if( ! $this->work_plan_model->set_team($team_id, $rows))
      {
        $sc = FALSE;
        $this->error = "แบ่งเขตไม่สำเร็จ";
      }
    }
    else
    {
      if( ! $this->work_plan_model->unset_team($rows))
      {
        $sc = FALSE;
        $this->error = "ดำเนินการไม่สำเร็จ";
      }
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }



  public function load_work_list()
  {
    $sc = TRUE;
    $ex = 0;
    $this->load->library('scs');
    $batch_id = uniqid();
    $response = json_decode($this->scs->get_work_list());

    if( ! empty($response))
    {
      if($response->status == 1)
      {
        $work_lists = $response->data->work->work_list;

        if( ! empty($work_lists))
        {
          foreach($work_lists as $rs)
          {
            $id = $this->work_plan_model->get_id($rs->pea_no);

            $arr = array(
              'cust_no' => $rs->cust_no,
              'pea_no' => $rs->pea_no,
              'pea_no_full' => $rs->pea_no_full,
              'mat_code_full' => $rs->mat_code_full,
              'ca_no' => $rs->ca_no,
              'cust_name' => $rs->cust_name,
              'cust_address' => $rs->cust_address,
              'cust_tel' => $rs->cust_tel,
              'cust_route' => $rs->cust_route,
              'age_meter' => $rs->age_meter,
              'Plan_TableName' => $rs->Plan_TableName,
              'CreatedDate' => $rs->CreatedDate,
              'remark' => get_null($rs->remark),
              'batch_id' => $batch_id
            );

            if( ! empty($id))
            {
              $arr['date_upd'] = now();
              $this->work_plan_model->update($id, $arr);
            }
            else
            {
              $this->work_plan_model->add($arr);
            }
          }
        }
        else
        {
          $sc = FALSE;
          $ex = 1;
          $this->error = "No Work list";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "ServerError: ".$response->friendly_msg_en;
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "No response";
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : ($ex == 1 ? 'info' : 'failed'),
      'message' => $sc === TRUE ? 'Success' : $this->error
    );

    echo json_encode($arr);
  }



  public function clear_filter()
  {
    $filter = array(
			'w_pea_no',
      'cust_no',
      'ca_no',
      'cust_name',
      'cust_tel',
      'cust_route',
      'plan_table_name',
      'w_team_id',
      'w_from_date',
      'w_to_date'
		);

    return clear_filter($filter);
  }


} //-- end class

?>
