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

    if($this->config->item('system_date'))
    {
      $this->home = base_url().'inventory/install_list';
      $this->load->model('inventory/install_list_model');
      $this->load->model('inventory/transfer_model');
      $this->load->model('admin/team_model');
      $this->load->helper('warehouse');
      $this->load->helper('area');
      $this->load->helper('dispose_reason');
      $this->load->helper('meter');
    }
  }


  public function index()
  {
    if($this->config->item('system_date'))
    {
      $filter = array(
        'transfer_code' => get_filter('transfer_code', 'transfer_code', ''),
        'pack_code_from' => get_filter('pack_code_from', 'pack_code_from', ''),
        'pack_code_to' => get_filter('pack_code_to', 'pack_code_to', ''),
        'u_pea_no' => get_filter('u_pea_no', 'u_pea_no', ''),
        'i_pea_no' => get_filter('i_pea_no', 'i_pea_no', ''),
        'area' => (! empty($this->_user->team_id) ? $this->team_model->get_code($this->_user->team_id) : get_filter('area', 'area', 'all')),
        'whsCode' => get_filter('whsCode', 'whsCode', 'all'),
        'user' => get_filter('user', 'user', ''),
        'worker' => get_filter('worker', 'worker', ''),
        'status' => get_filter('status', 'status', 'all'),
        'from_date' => get_filter('from_date', 'from_date', ''),
        'to_date' => get_filter('to_date', 'to_date', '')
      );

      if($this->input->post('search'))
      {
        redirect($this->home);
      }
      else
      {
        //--- แสดงผลกี่รายการต่อหน้า
        $perpage = get_rows();

        $rows = $this->install_list_model->count_rows($filter);

        $filter['data'] = $this->install_list_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

        //--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
        $init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

        $this->pagination->initialize($init);

        $filter['area_list'] = $this->team_model->get_all_active();

        $this->load->view('inventory/install_list/install_list', $filter);

      }

    }
    else
    {
      redirect(base_url().'suspended');
    }

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
          'date_add' => now(),
          'user' => $this->_user->uname
        );

        $id = $this->install_list_model->get_id($rs->u_pea_no);

        if( ! $id)
        {
          $arr['status'] = (empty($item) ? 'E' : 'O');
          $arr['message'] = (empty($item) ? 'ไม่พบ PEA NO ในระบบ SAP' : NULL);

          if( ! $this->install_list_model->add($arr))
          {
            $sc = FALSE;
            $this->error = "Insert failed at : {$rs->u_pea_no}";
          }
        }
        else
        {
          if( ! $this->install_list_model->update($id, $arr))
          {
            $sc = FALSE;
            $this->error = "Update failed at : {$rs->u_pea_no}";
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
        'O0' => 'รอแพ็ค',
        'O1' => 'รอโอน',
        'L' => 'ระหว่างโอน',
        'S' => 'โอนแล้ว',
        'E' => 'Error',
        'C' => 'Closed'
      );

      $pk = $detail->status == 'O' ? $detail->status.$detail->pack_status : $detail->status;
      $detail->status_label = $label[$pk];
      $detail->work_date = thai_date($detail->work_date);
      $detail->date_add = thai_date($detail->date_add, TRUE);
      $detail->area_name = area_name_by_code($detail->area);
      $detail->dispose_reason_name = empty($detail->dispose) ? dispose_reason_name($detail->dispose_reason) : $detail->dispose;

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


  public function export_filter()
  {
    $memory = getConfig('EXPORT_MEMORY_LIMIT');
    $memory = empty($memory) ? '2048M' : $memory;
    ini_set('memory_limit', $memory); // This also needs to be increased in some cases. Can be changed to a higher value as per need)

    $token = $this->input->post('token');
    $limit = intval(getConfig('EXPORT_LIMIT_ROWS'));
    $limit = $limit > 0 ? $limit : 50000;

    $ds = array(
      'u_pea_no' => $this->input->post('export_u_pea_no'),
      'i_pea_no' => $this->input->post('export_i_pea_no'),
      'area' => $this->input->post('export_area'),
      'worker' => $this->input->post('export_worker'),
      'user' => $this->input->post('export_user'),
      'transfer_code' => $this->input->post('export_transfer_code'),
      'pack_code_from' => $this->input->post('export_pack_code_from'),
      'pack_code_to' => $this->input->post('export_pack_code_to'),
      'status' => $this->input->post('export_status'),
      'from_date' => $this->input->post('export_from_date'),
      'to_date' => $this->input->post('export_to_date')
    );

    $header = array('วันที่ติดตั้ง', 'PeaNo (เก่า)', 'PeaNo (ใหม่)', 'เขต', 'อายุ', 'เฟส', 'ขนาด', 'หน่วย(kWh)', 'ผู้ติดตั้ง', 'สถานะ', 'pack code', 'ลักษณะการชำรุด');
    $area = area_code_array();
    $reason = dispose_reason_array();
    $label = array(
			'O0' => 'รอแพ็ค',
			'O1' => 'รอโอน',
			'L' => 'ระหว่างโอน',
			'S' => 'โอนแล้ว',
			'E' => 'Error',
			'C' => 'Closed'
		);

    $results = $this->install_list_model->get_list($ds, $limit, 0);

    // Create a file pointer
    $f = fopen('php://memory', 'w');
    $delimiter = ",";
    fputs($f, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    fputcsv($f, $header, $delimiter);

    if(!empty($results))
    {
      foreach($results as $rs)
      {
        $pk = $rs->status == 'O' ? $rs->status.$rs->pack_status : $rs->status;
        $status = empty($label[$pk]) ? 'unknow' : $label[$pk];

        $arr = array(
          thai_date($rs->work_date, FALSE),
          $rs->u_pea_no,
          $rs->i_pea_no,
          (empty($area[$rs->area]) ? 'unknow' : $area[$rs->area]),
          $rs->meter_age,
          $rs->phase,
          $rs->meter_size_name,
          $rs->meter_read_end,
          $rs->worker,
          $status,
          $rs->pack_code,
          ( ! empty($rs->dispose) ? $rs->dispose : (empty($reason[$rs->dispose_reason]) ? "" : $reason[$rs->dispose_reason]))
        );

        fputcsv($f, $arr, $delimiter);
      }

      $memuse = (memory_get_usage() / 1024) / 1024;
      $arr = array('memory usage', round($memuse, 2).' MB');

      fputcsv($f, $arr, $delimiter);
    }

    //--- Move to begin of file
    fseek($f, 0);

    setToken($token);

    $file_name = "export_filter ".date('Ymd').".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="'.$file_name.'"');

    //output all remaining data on a file pointer
    fpassthru($f); ;

    exit();
  }


  public function count_worker()
  {

    $ds = array(
      'u_pea_no' => $this->input->post('u_pea_no'),
      'i_pea_no' => $this->input->post('i_pea_no'),
      'area' => $this->input->post('area'),
      'worker' => $this->input->post('worker'),
      'user' => $this->input->post('user'),
      'transfer_code' => $this->input->post('transfer_code'),
      'pack_code_from' => $this->input->post('pack_code_from'),
      'pack_code_to' => $this->input->post('pack_code_to'),
      'status' => $this->input->post('status'),
      'from_date' => $this->input->post('from_date'),
      'to_date' => $this->input->post('to_date')
    );

    $rows = $this->install_list_model->count_worker($ds);

    echo $rows;
  }

  public function count_worker_each_day()
  {
    $sc = TRUE;
    $from_date = db_date($this->input->post('from_date'));
    $to_date = db_date($this->input->post('to_date'));
    $area = $this->input->post('area');
    $ds = "";

    if($area === 'all')
    {
      $areas = $this->team_model->get_all();
    }
    else
    {
      $areas = array($this->team_model->get_by_code($area));
    }

    $range = date_range($from_date, $to_date);
    $days = count($range);
    $width = ($days * 80) + 160;

    $ds  = '<table class="table table-bordered table-striped border-1" style="min-width:'.$width.'px;">';
    $ds .= '<tr><td colspan="2" class=""></td> <td colspan="'.$days.'">จำนวนคน</td></tr>';

    if( ! empty($range))
    {
      $ds .= '<tr><td class="fix-width-80"><strong>เขต<strong></td><td class="fix-width-80 text-center" style="color:white; background-color:#4e585d;">TOR</td>';

      foreach($range as $date)
      {
        $ds .= '<td class="fix-width-80 text-center"><strong>'.date('d-M', strtotime($date)).'</strong></td>';
      }

      $ds .= '</tr>';

      if( ! empty($areas))
      {
        foreach($areas as $ar)
        {
          $ds .= '<tr><td class="fix-width-80">'.$ar->name.'</td><td class="fix-width-80 text-center" style="color:white; background-color:#4e585d;">'.$ar->tor_worker.'</td>';

          foreach($range as $date)
          {
            $workers_qty = $this->install_list_model->count_worker_by_date($date, $ar->code);

            $ds .= '<td class="fix-width-80 text-center">'.$workers_qty.'</td>';
          }

          $ds .= '</tr>';
        }
      }

      $ds .= '</table>';
    }

    echo $ds;
  }


  public function clear_filter()
  {
    $filter = array(
			'transfer_code',
      'pack_code_from',
      'pack_code_to',
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
