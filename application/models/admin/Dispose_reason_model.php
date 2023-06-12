<?php
class Dispose_reason_model extends CI_Model
{
  private $tb = "dispose_reason";

  public function __construct()
  {
    parent::__construct();
  }


  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    if(isset($ds['pk_id']) && $ds['pk_id'] != "")
    {
      $this->db->where('pk_id', $ds['pk_id']);
    }

    if(isset($ds['reason_id']) && $ds['reason_id'] != "")
    {
      $this->db->like('reason_id', $ds['reason_id']);
    }

    if(isset($ds['title']) && $ds['title'] != "")
    {
      $this->db->like('title', $ds['title']);
    }

    if(isset($ds['desc']) && $ds['desc'] != "")
    {
      $this->db->like('description', $ds['desc']);
    }

    $rs = $this->db->limit($perpage, $offset)->get($this->tb);

    if( $rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function count_rows(array $ds = array())
  {
    if(isset($ds['pk_id']) && $ds['pk_id'] != "")
    {
      $this->db->where('pk_id', $ds['pk_id']);
    }

    if(isset($ds['reason_id']) && $ds['reason_id'] != "")
    {
      $this->db->like('reason_id', $ds['reason_id']);
    }

    if(isset($ds['title']) && $ds['title'] != "")
    {
      $this->db->like('title', $ds['title']);
    }

    if(isset($ds['desc']) && $ds['desc'] != "")
    {
      $this->db->like('description', $ds['desc']);
    }

    return $this->db->count_all_results($this->tb);
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



  public function get($pk_id)
  {
    $rs = $this->db->where('pk_id', $pk_id)->get($this->tb);

    if($rs->num_rows() == 1)
    {
      return $rs->row();
    }

    return NULL;
  }

  public function get_title($reason_id)
  {
    $rs = $this->db->select('title')->where('reason_id', $reason_id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->title;
    }

    return NULL;
  }


  public function is_exists($pk_id)
  {
    $count = $this->db->where('pk_id', $pk_id)->count_all_results($this->tb);

    if($count > 0)
    {
      return TRUE;
    }

    return FALSE;
  }


  public function add(array $ds = array())
  {
    return $this->db->insert($this->tb, $ds);
  }


  public function update($pk_id, $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('pk_id', $pk_id)->update($this->tb, $ds);
    }

    return FALSE;
  }
}


 ?>
