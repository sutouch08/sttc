<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install_list extends PS_Controller
{
  public $menu_code = 'OPISTL';
	public $menu_group_code = 'OP';
	public $title = 'รายการติดตั้งสำเร็จ';
	public $segment = 4;
  public $error;
  public $ms;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'inventory/install_list';
    $this->load->model('inventory/install_list_model');
    $this->load->model('inventory/transfer_model');
    $this->load->helper('warehouse');
    $this->load->helper('area');
    $this->load->helper('dispose_reason');
    $this->load->helper('meter');
  }


  public function index()
  {
		$filter = array(
			'transfer_code' => get_filter('transfer_code', 'transfer_code', ''),
      'pack_code' => get_filter('pack_code', 'pack_code', ''),
      'u_pea_no' => get_filter('u_pea_no', 'u_pea_no', ''),
      'i_pea_no' => get_filter('i_pea_no', 'i_pea_no', ''),
      'area' => get_filter('area', 'area', 'all'),
      'whsCode' => get_filter('whsCode', 'whsCode', 'all'),
      'user' => get_filter('user', 'user', ''),
      'worker' => get_filter('worker', 'worker', ''),
      'status' => get_filter('status', 'status', 'all'),
      'from_date' => get_filter('from_date', 'from_date', ''),
      'to_date' => get_filter('to_date', 'to_date', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->install_list_model->count_rows($filter);

		$filter['data'] = $this->install_list_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $this->load->view('inventory/install_list/install_list', $filter);
  }


  public function add_rows()
  {
    $sc = TRUE;
    $data = json_decode($this->input->post('data'));
    if( ! empty($data))
    {
      $this->ms = $this->load->database('ms', TRUE);

      foreach($data as $rs)
      {
        $a = str_replace('/', '-', $rs->work_date);
        $d = explode('-', $a);
        $date = $d[2]."-".$d[1]."-".$d[0];
        $work_date = db_date($date, TRUE);
        $item = $this->install_list_model->get_item_data_by_pea_no($rs->i_pea_no);

        $arr = array(
          'work_date' => $work_date,
          'u_pea_no' => $rs->u_pea_no,
          'i_pea_no' => $rs->i_pea_no,
          'meter_age' => $rs->meter_age,
          'meter_type' => $rs->meter_type,
          'phase' => get_meter_phase($rs->meter_type), //--- meter_helper
          'meter_size' => $rs->meter_size,
          'meter_size_name' => get_meter_size_name($rs->meter_size), //--- meter_helper
          'meter_read_end' => $rs->meter_read_end,
          'dispose_reason' => $rs->dispose_reason == '0' ? $rs->dispose_reason : sprintf('%02s', $rs->dispose_reason),
          'route' => $rs->route,
          'area' => $rs->area,
          'worker' => $rs->worker,
          'ItemCode' => ( ! empty($item) ? $item->ItemCode : NULL),
          'ItemName' => ( ! empty($item) ? $item->ItemName : NULL),
          'status' => (empty($item) ? 'E' : 'O'),
          'message' => (empty($item) ? 'ไม่พบ PEA NO ในระบบ SAP' : NULL),
          'date_add' => now(),
          'user' => $this->_user->uname
        );

        if( ! $this->install_list_model->is_exists($rs->u_pea_no))
        {
          if( ! $this->install_list_model->add($arr))
          {
            $sc = FALSE;
            $this->error = "Insert failed at : {$rs->u_pea_no}";
          }
        }
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Nodata";
    }

    $this->_response($sc);
  }


  public function add_row()
  {
    $sc = TRUE;
    $rs = json_decode($this->input->post('data'));

    if( ! empty($rs))
    {
      $this->ms = $this->load->database('ms', TRUE);
      $a = str_replace('/', '-', $rs->work_date);
      $d = explode('-', $a);
      $date = $d[2]."-".$d[1]."-".$d[0];
      $work_date = db_date($date, TRUE);
      $item = $this->install_list_model->get_item_data_by_pea_no($rs->i_pea_no);

      $arr = array(
        'work_date' => $work_date,
        'u_pea_no' => $rs->u_pea_no,
        'i_pea_no' => $rs->i_pea_no,
        'meter_age' => $rs->meter_age,
        'meter_type' => $rs->meter_type,
        'phase' => get_meter_phase($rs->meter_type), //--- meter_helper
        'meter_size' => $rs->meter_size,
        'meter_size_name' => get_meter_size_name($rs->meter_size), //--- meter_helper
        'meter_read_end' => $rs->meter_read_end,
        'dispose_reason' => $rs->dispose_reason == '0' ? $rs->dispose_reason : sprintf('%02s', $rs->dispose_reason),
        'route' => $rs->route,
        'area' => $rs->area,
        'worker' => $rs->worker,
        'ItemCode' => ( ! empty($item) ? $item->ItemCode : NULL),
        'ItemName' => ( ! empty($item) ? $item->ItemName : NULL),
        'status' => (empty($item) ? 'E' : 'O'),
        'message' => (empty($item) ? 'ไม่พบ PEA NO ในระบบ SAP' : NULL),
        'date_add' => now(),
        'user' => $this->_user->uname
      );

      if( ! $this->install_list_model->is_exists($rs->u_pea_no))
      {
        if( ! $this->install_list_model->add($arr))
        {
          $sc = FALSE;
          $this->error = "Insert failed at : {$rs->u_pea_no}";
        }
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Nodata";
    }

    $this->_response($sc);
  }



  public function get_detail($id)
  {
    $detail = $this->install_list_model->get_by_id($id);

    if( ! empty($detail))
    {
      $label = array(
    		'O' => 'รอโอน',
    		'L' => 'ระหว่างโอน',
    		'S' => 'โอนแล้ว',
        'E' => 'Error'
    	);

      $detail->status_label = $label[$detail->status];
      $detail->work_date = thai_date($detail->work_date);
      $detail->date_add = thai_date($detail->date_add, TRUE);
      $detail->area_name = area_name_by_code($detail->area);
      $detail->dispose_reason_name = dispose_reason_name($detail->dispose_reason);

      echo json_encode($detail);
    }
    else
    {
      echo "not found";
    }
  }


  public function delete_rows()
  {
    $sc = TRUE;
    $data = json_decode($this->input->post('data'));

    if( ! empty($data))
    {
      if( $this->pm->can_delete)
      {
        if( ! $this->install_list_model->delete_rows($data))
        {
          $sc = FALSE;
          $this->error = "ลบรายการไม่สำเร็จ";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "คุณไม่มีสิทธิ์ในการลบรายการ";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "No rows selected";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function manual_close_rows()
  {
    $sc = TRUE;
    $data = json_decode($this->input->post('data'));

    if( ! empty($data))
    {
      if( $this->pm->can_delete)
      {
        if( ! $this->install_list_model->close_rows($data))
        {
          $sc = FALSE;
          $this->error = "Close รายการไม่สำเร็จ";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "คุณไม่มีสิทธิ์ในการ Close";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "No rows selected";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function un_close_rows()
  {
    $sc = TRUE;
    $data = json_decode($this->input->post('data'));

    if( ! empty($data))
    {
      if( $this->pm->can_delete)
      {
        if( ! $this->install_list_model->un_close_rows($data))
        {
          $sc = FALSE;
          $this->error = "unClose รายการไม่สำเร็จ";
        }
      }
      else
      {
        $sc = FALSE;
        $this->error = "คุณไม่มีสิทธิ์ในการ unClose";
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "No rows selected";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }

  public function get_open_items()
  {
    $sc = TRUE;

    $filter = array(
      'pea_no' => trim($this->input->post('pea_no')),
      'area' => trim($this->input->post('area'))
    );

    $list = $this->install_list_model->get_open_items_by_filter($filter);

    $ds = array();

    if( ! empty($list))
    {
      foreach($list as $rs)
      {
        $arr = array(
          'id' => $rs->id,
          'work_date' => thai_date($rs->work_date),
          'u_pea_no' => $rs->u_pea_no,
          'i_pea_no' => $rs->i_pea_no,
          'area' => $rs->area,
          'area_name' => $rs->area_name,
          'worker' => $rs->worker
        );

        array_push($ds, $arr);
      }
    }
    else
    {
      $arr = array('nodata' => 'nodata');

      array_push($ds, $arr);
    }

    echo json_encode($ds);
  }


  public function clear_filter()
  {
    $filter = array(
			'transfer_code',
      'pack_code',
      'u_pea_no',
      'i_pea_no',
      'area',
      'whsCode',
      'user',
      'worker',
      'status',
      'from_date',
      'to_date'
		);

    return clear_filter($filter);
  }

} //--- end class

 ?>
