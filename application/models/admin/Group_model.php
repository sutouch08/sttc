<?php
class Group_model extends CI_Model
{
  private $tb = "team_group";

  public function __construct()
  {
    parent::__construct();
  }


  public function get($id)
  {
    $rs = $this->db
    ->select('g.*, t.name AS team_name')
    ->select('fw.name AS from_warehouse_name')
    ->select('tw.name AS to_warehouse_name')
    ->from('team_group AS g')
    ->join('team AS t', 'g.team_id = t.id', 'left')
    ->join('warehouse AS fw', 'g.fromWhsCode = fw.code', 'left')
    ->join('warehouse AS tw', 'g.toWhsCode = tw.code', 'left')
    ->where('g.id', $id)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_by_team_id($team_id)
  {
    $rs = $this->db
    ->where('team_id', $team_id)
    ->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
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

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }



  public function add(array $ds = array())
  {
    if( ! empty($ds))
    {
      if($this->db->insert($this->tb, $ds))
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }


  public function update($id, $ds = array())
  {
    if( ! empty($id))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }


  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
  }


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    $this->db
    ->select('g.*, t.name AS team_name')
    ->select('fw.name AS from_warehouse_name, tw.name AS to_warehouse_name')
    ->from('team_group AS g')
    ->join('team AS t', 'g.team_id = t.id', 'left')
    ->join('warehouse AS fw', 'g.fromWhsCode = fw.code', 'left')
    ->join('warehouse AS tw', 'g.toWhsCode = tw.code', 'left');

    if( isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('g.name', $ds['name']);
    }

    if($ds['team'] != 'all')
    {
      $this->db->where('g.team_id', $ds['team']);
    }

    if($ds['fromWhsCode'] != 'all')
    {
      $this->db->where('g.fromWhsCode', $ds['fromWhsCode']);
    }

    if($ds['toWhsCode'] != 'all')
    {
      $this->db->where('g.toWhsCode', $ds['toWhsCode']);
    }

    if( isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('t.status', $ds['status']);
    }

    $this->db->order_by('t.name', 'ASC')->order_by('g.name', 'ASC');
    $rs = $this->db->limit($limit, $offset)->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }


    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    $this->db
    ->from('team_group AS g')
    ->join('team AS t', 'g.team_id = t.id', 'left')
    ->join('warehouse AS fw', 'g.fromWhsCode = fw.code', 'left')
    ->join('warehouse AS tw', 'g.toWhsCode = tw.code', 'left');

    if( isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('g.name', $ds['name']);
    }

    if($ds['team'] != 'all')
    {
      $this->db->where('g.team_id', $ds['team']);
    }

    if($ds['fromWhsCode'] != 'all')
    {
      $this->db->where('g.fromWhsCode', $ds['fromWhsCode']);
    }

    if($ds['toWhsCode'] != 'all')
    {
      $this->db->where('g.toWhsCode', $ds['toWhsCode']);
    }

    if( isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('t.status', $ds['status']);
    }

    return $this->db->count_all_results();
  }



  public function is_exists_transection($group_id)
  {
    //---
    $u = $this->db->where('team_group_id IS NOT NULL', NULL, FALSE)->where('team_group_id', $group_id)->count_all_results('user');
    $w = $this->db->where('team_group_id IS NOT NULL', NULL, FALSE)->where('team_group_id', $group_id)->count_all_results('work_list');

    if($u > 0 OR $w > 0)
    {
      return TRUE;
    }

    return FALSE;
  }


} //---- end model

 ?>
