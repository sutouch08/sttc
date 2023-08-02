<?php
class Warehouse_model extends CI_Model
{
  private $tb = "warehouse";

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


  public function get_listed_warehouse_by_role($role = 0)
  {
    $rs = $this->db->where('status', 1)->where('listed', 1)->where('role', $role)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

  public function get_listed_warehouse_by_role_and_area($role, $area)
  {
    $rs = $this->db
    ->where('status', 1)
    ->where('listed', 1)
    ->where('role', $role)
    ->where('team_id', $area)
    ->get($this->tb);

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
    $this->db
    ->from('warehouse AS w')
    ->join('team AS t', 'w.team_id = t.id', 'left');

    if(isset($ds['code']) && $ds['code'] !== "" && $ds['code'] !== NULL)
    {
      $this->db->like('w.code', $ds['code']);
    }

    if(isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('w.name', $ds['name']);
    }

    if(isset($ds['area']) && $ds['area'] != 'all')
    {
      if($ds['area'] == 'NULL')
      {
        $this->db->where('w.team_id IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('w.team_id', $ds['area']);
      }
    }

    if(isset($ds['role']) && $ds['role'] !== 'all')
    {
      if($ds['role'] == 'NULL')
      {
        $this->db->where('w.role IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('w.role', $ds['role']);
      }
    }

    if(isset($ds['status']) && $ds['status'] !== "all")
    {
      $this->db->where('w.status', $ds['status']);
    }

    if( isset($ds['listed']) && $ds['listed'] !== 'all')
    {
      $this->db->where('w.listed', $ds['listed']);
    }

    return $this->db->count_all_results();
  }


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    $this->db
    ->select('w.*, t.code AS area_code, t.name AS area_name')
    ->from('warehouse AS w')
    ->join('team AS t', 'w.team_id = t.id', 'left');

    if(isset($ds['code']) && $ds['code'] !== "" && $ds['code'] !== NULL)
    {
      $this->db->like('w.code', $ds['code']);
    }

    if(isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('w.name', $ds['name']);
    }

    if(isset($ds['area']) && $ds['area'] != 'all')
    {
      if($ds['area'] == 'NULL')
      {
        $this->db->where('w.team_id IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('w.team_id', $ds['area']);
      }
    }

    if(isset($ds['role']) && $ds['role'] !== 'all')
    {
      if($ds['role'] == 'NULL')
      {
        $this->db->where('w.role IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('w.role', $ds['role']);
      }
    }

    if(isset($ds['status']) && $ds['status'] !== "all")
    {
      $this->db->where('w.status', $ds['status']);
    }

    if( isset($ds['listed']) && $ds['listed'] !== 'all')
    {
      $this->db->where('w.listed', $ds['listed']);
    }

    $rs = $this->db->order_by('code', 'ASC')->limit($limit, $offset)->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function getSyncData()
  {
    $this->ms = $this->load->database('ms', TRUE);

    $qr = "SELECT WhsCode AS code, WhsName AS name, Inactive FROM OWHS";
    $rs = $this->ms->query($qr);

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

  public function get_name($code)
  {
    $rs = $this->db->select('name')->where('code', $code)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->name;
    }

    return NULL;
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
