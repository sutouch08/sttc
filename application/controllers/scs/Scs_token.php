<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scs_token extends CI_Controller
{
  public $error;

  public function __construct()
  {
    parent::__construct();
		$this->load->library('scs');
  }


  public function refresh_token()
  {
    $response = json_decode($this->scs->get_token());

    if( ! empty($response))
    {
      if($response->status == 1)
      {
        $token = $response->data->Token;

        $this->db->set('value', $token)->where('code', 'SCS_TOKEN')->update('config');
      }
    }
  }


  public function get_token()
  {
    $sc = TRUE;
    $response = json_decode($this->scs->get_token());

    if( ! empty($response))
    {
      if($response->status == 1)
      {
        $token = $response->data->Token;

        $this->db->set('value', $token)->where('code', 'SCS_TOKEN')->update('config');
      }
      else
      {
        $sc = FALSE;
        $this->error = $response->friendly_msg_en;
      }
    }

    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'token' => $sc === TRUE ? $token : ""
    );

    echo json_encode($arr);
  }


} //--- end class

 ?>
