<?php
class Warehouse_model extends CI_Model
{
  private $tb = "warehouse";

  public function __construct()
  {
    parent::__construct();
  }


  public function get_all()
  {
    $rs = $this->db->where('status', 1)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_listed()
  {
    $rs = $this->db->where('status', 1)->where('listed', 1)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function get_user_warehouse($user_id)
  {
    $rs = $this->db
    ->select('w.id, w.code, w.name')
    ->from('user_warehouse AS uw')
    ->join('warehouse AS w', 'uw.warehouse_code = w.code', 'left')
    ->where('uw.user_id', $user_id)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_user_from_warehouse($user_id)
  {
    $rs = $this->db
    ->select('w.id, w.code, w.name, uw.type')
    ->from('user_warehouse AS uw')
    ->join('warehouse AS w', 'uw.warehouse_code = w.code', 'left')
    ->where('uw.user_id', $user_id)
    ->where('uw.type', 'from')
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

  public function get_user_to_warehouse($user_id)
  {
    $rs = $this->db
    ->select('w.id, w.code, w.name, uw.type')
    ->from('user_warehouse AS uw')
    ->join('warehouse AS w', 'uw.warehouse_code = w.code', 'left')
    ->where('uw.user_id', $user_id)
    ->where('uw.type', 'to')
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function add_user_warehouse(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->insert('user_warehouse', $ds);
    }

    return FALSE;
  }


  public function drop_user_warehouse($user_id)
  {
    return $this->db->where('user_id', $user_id)->delete('user_warehouse');
  }


  public function count_rows(array $ds = array())
  {
    if(isset($ds['code']) && $ds['code'] !== "" && $ds['code'] !== NULL)
    {
      $this->db->like('code', $ds['code']);
    }

    if(isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('name', $ds['name']);
    }

    if(isset($ds['status']) && $ds['status'] !== "all")
    {
      $this->db->where('status', $ds['status']);
    }

    if( isset($ds['listed']) && $ds['listed'] !== 'all')
    {
      $this->db->where('listed', $ds['listed']);
    }

    return $this->db->count_all_results($this->tb);
  }


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    if(isset($ds['code']) && $ds['code'] !== "" && $ds['code'] !== NULL)
    {
      $this->db->like('code', $ds['code']);
    }

    if(isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('name', $ds['name']);
    }

    if(isset($ds['status']) && $ds['status'] !== "all")
    {
      $this->db->where('status', $ds['status']);
    }

    if( isset($ds['listed']) && $ds['listed'] !== 'all')
    {
      $this->db->where('listed', $ds['listed']);
    }

    $rs = $this->db->order_by('code', 'ASC')->limit($limit, $offset)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function getSyncData()
  {
    $rs = $this->ms
    ->select('WhsCode AS code, WhsName AS name, Inactive')
    ->get("OWHS");

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_id($code)
  {
    $rs = $this->db->select('id')->where('code', $code)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->id;
    }

    return FALSE;
  }

  public function add(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->insert($this->tb, $ds);
    }

    return FALSE;
  }

  public function update($id, $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }

} //--- end class

 ?>
