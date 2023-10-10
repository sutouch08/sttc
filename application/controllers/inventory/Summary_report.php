<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary_report extends PS_Controller
{
  public $menu_code = 'OPSUMMARY';
	public $menu_group_code = 'OP';
	public $title = 'รายงานสรุปความคืบหน้า';
	public $segment = 4;
  public $error;
  public $ms;

  public function __construct()
  {
    parent::__construct();

    $this->home = base_url().'inventory/summary_report';
    $this->load->model('inventory/summary_report_model');
    $this->load->model('admin/team_model');
  }


  public function index()
  {
    $limit = date_create('2023-10-16');
    $now = date_create(date('Y-m-d'));
    $end = $limit < $now ? TRUE : FALSE;

    if($end)
    {
      $text = "เมนูนี้ถูกระงับใช้งาน เนื่องจากระยะเวลาทดลองใช้สิ้นสุดลง โปรดติดต่อผู้ให้บริการเพื่อชำระค่าบริการและเปิดใช้งานระบบอีกครั้ง";
      $this->load->view('trial_expired', array('text' => $text));
    }
    else
    {
      $this->load->view('report/summary/summary_report');
    }
  }


  public function get_report()
  {
    $sc = TRUE;
    $ds = array();

    $rate = 10/30;
    $begin_date = date_create('2023-08-10');
    $to_date = date_create(date('Y-m-d'));
    $diff = date_diff($begin_date, $to_date);
    $days = intval($diff->format('%r%a'));
    $MAT = round($days * $rate, 2);
    $teams = $this->team_model->get_all_active();

    if( ! empty($teams))
    {
      foreach($teams as $team)
      {
        $tor_qty = $team->tor_qty;
        $finished = $this->summary_report_model->get_sum_finish($team->id);
        $closed = $this->summary_report_model->get_sum_closed($team->id);
        $transfered = $this->summary_report_model->get_sum_transfered($team->id);
        $summary = $finished + $closed + $transfered;

        $percentage = $tor_qty > 0 ? ($summary / $tor_qty) * 100 : 0;

        $arr = array(
          'team_name' => $team->name,
          'tor_qty' => number($team->tor_qty),
          'finished' => number($finished),
          'closed' => number($closed),
          'transfered' => number($transfered),
          'summary' => number($summary),
          'result' => number($percentage, 2).' %',
          'color' => $percentage < $MAT ? 'red' : ''
        );

        array_push($ds, $arr);
      }

      $arr = array(
        'mat' => number($MAT, 2).' %'
      );

      array_push($ds, $arr);
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบข้อมูลเขต";
    }


    echo $sc === TRUE ? json_encode($ds) : $this->error;
  }

} //--- end class

 ?>
