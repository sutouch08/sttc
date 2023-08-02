<?php
class Dispose_reason_model extends CI_Model
{
  private $tb = "dispose_reason";

  public function __construct()
  {
    parent::__construct();
  }


  public function get_all()
  {
    $rs = $this->db->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

  public function get_name($reason_id = 0)
  {
    $rs = $this->db->where('reason_id', $reason_id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->title;
    }

    return NULL;
  }

} //--- end class

 ?>
