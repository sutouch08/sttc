<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_complete extends CI_Controller
{
  public $ms;
  public function __construct()
  {
    parent::__construct();
  }

  public function get_finished_pack_list()
  {
    $txt = $_REQUEST['term'];
    $sc = array();
    $this->db
    ->select('code')
    ->where('status', 'F');

    if($txt != '*')
    {
      $this->db->like('code', $txt);
    }

    $rs = $this->db->limit(50)->get('pack');

    if($rs->num_rows() > 0)
    {
      foreach($rs->result() as $rd)
      {
        $sc[] = $rd->code;
      }
    }
    else
    {
      $sc[] = "not found";
    }

    echo json_encode($sc);
  }  

} //-- end class
?>
