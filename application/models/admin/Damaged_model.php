<?php
class Damaged_model extends CI_Model
{
  private $tb = "damage_list";

  public function __construct()
  {
    parent::__construct();
  }


  public function get($id)
  {
    $rs = $this->db->where('id', $id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }



  public function get_name($id)
  {
    $rs = $this->db->where('id', $id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->name;
    }

    return NULL;
  }

  public function get_all_active()
  {
    $rs = $this->db->where('status', 1)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
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


  public function is_exists($name, $id = NULL)
  {
    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    $rs = $this->db->where('name', $name)->count_all_results($this->tb);

    if($rs)
    {
      return TRUE;
    }

    return FALSE;
  }


  public function add(array $ds = array())
  {
    if( ! empty($ds))
    {
      $rs = $this->db->insert($this->tb, $ds);

      if($rs)
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }


  public function update($id, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }


  public function is_exists_transection($id)
  {
    $count = $this->db->where('damage_id', $id)->count_all_results('transfer');

    return $count > 0 ? TRUE : FALSE;
  }


  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
  }

  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    if( isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('name', $ds['name']);
    }

    if( isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('status', $ds['status']);
    }

    $rs = $this->db->order_by('name', 'ASC')->limit($limit, $offset)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }


    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    if( isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('name', $ds['name']);
    }

    if( isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('status', $ds['status']);
    }

    return $this->db->count_all_results($this->tb);
  }



} //---- end model

 ?>
