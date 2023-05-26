<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scs_init extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
		$this->load->library('scs');
    $this->load->model('admin/dispose_reason_model');
		$this->load->model('logs_model');
  }


  public function index()
  {
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
  }
} //--- end class 

 ?>
