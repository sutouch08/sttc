<?php
class Team_model extends CI_Model
{
  private $tb = "team";

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


  public function get_user_team($user_id)
  {
    $rs = $this->db
    ->select('t.id, t.name, ut.team_role AS role')
    ->from('user_team AS ut')
    ->join('team AS t', 'ut.team_id = t.id', 'left')
    ->where('ut.user_id', $user_id)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_outsource_by_team($team_id)
  {
    $rs = $this->db
    ->select('id, uname, name, team_id, ugroup')
    ->where('ugroup', 3)
    ->where('team_id', $team_id)
    ->get('user');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function add_user_team(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->insert('user_team', $ds);
    }

    return FALSE;
  }


  public function drop_user_team($user_id)
  {
    return $this->db->where('user_id', $user_id)->delete('user_team');
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
    $u = $this->db->where('team_id', $id)->count_all_results('user');
    $ut = $this->db->where('team_id', $id)->count_all_results('user_team');
    $t = $this->db->where('team_id', $id)->count_all_results('transfer');
    $all = $u + $ut + $t;

    return $all > 0 ? TRUE : FALSE;
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
