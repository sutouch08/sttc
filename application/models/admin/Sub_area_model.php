<?php
class Sub_area_model extends CI_Model
{
  private $tb = "sub_area";

  public function __construct()
  {
    parent::__construct();
  }


  public function get($id)
  {
    $rs = $this->db
    ->select('a.*')
    ->select('t.name AS team_name, t.full_name AS team_full_name')
    ->from('sub_area AS a')
    ->join('team AS t', 'a.team_id = t.id', 'left')
    ->where('a.id', $id)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  //--- for report
  public function get_area_data($id)
  {
    $rs = $this->db
    ->select('a.*')
    ->select('t.full_name, t.contract_no, t.list_no')
    ->from('sub_area AS a')
    ->join('team AS t', 'a.team_id = t.id', 'left')
    ->where('a.id', $id)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
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


  public function get_all_active_by_team($team_id)
  {
    $rs = $this->db->where('status', 1)->where('team_id', $team_id)->get($this->tb);

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


  public function get_name($id)
  {
    $rs = $this->db->select('name')->where('id', $id)->get($this->tb);

    if( $rs->num_rows() === 1)
    {
      return $rs->row()->name;
    }

    return NULL;
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


  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
  }


  public function is_exists($name, $team_id, $id = NULL)
  {
    $this->db
    ->where('name', $name)
    ->where('team_id', $team_id);

    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    $row = $this->db->count_all_results($this->tb);

    if($row > 0)
    {
      return TRUE;
    }

    return FALSE;
  }

  public function is_exists_transection($id)
  {
    return FALSE;
  }


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    $this->db
    ->select('a.*')
    ->select('t.name AS team_name')
    ->from('sub_area AS a')
    ->join('team AS t', 'a.team_id = t.id', 'left');

    if( isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('a.name', $ds['name']);
    }

    if( isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('a.team_id', $ds['team_id']);
    }

    if( isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('a.status', $ds['status']);
    }

    $rs = $this->db->order_by('a.name', 'ASC')->limit($limit, $offset)->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }


    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    $this->db
    ->from('sub_area AS a')
    ->join('team AS t', 'a.team_id = t.id', 'left');

    if( isset($ds['name']) && $ds['name'] !== "" && $ds['name'] !== NULL)
    {
      $this->db->like('a.name', $ds['name']);
    }

    if( isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('a.team_id', $ds['team_id']);
    }

    if( isset($ds['status']) && $ds['status'] != "all")
    {
      $this->db->where('a.status', $ds['status']);
    }

    return $this->db->count_all_results();
  }



} //---- end model

 ?>
