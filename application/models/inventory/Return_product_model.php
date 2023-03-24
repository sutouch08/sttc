<?php
class Return_product_model extends CI_Model
{
  private $tb = "return_product";
  private $td = "return_product_detail";

  public function __construct()
  {
    parent::__construct();
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



  public function update($id, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }


  public function add_detail(array $ds = array())
  {
    if( ! empty($ds))
    {
      if($this->db->insert($this->td, $ds))
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }


  public function update_user_item($user_id, $serial)
  {
    return $this->db->set('status', 2)->where('user_id', $user_id)->where('serial', $serial)->update('user_item');
  }


  public function get($id)
  {
    $rs = $this->db
    ->select('rt.*, wh.name AS whName, u.uname, t.name AS team_name')
    ->from('return_product AS rt')
    ->join('warehouse AS wh', 'rt.whsCode = wh.code', 'left')
    ->join('user AS u', 'rt.create_by = u.id', 'left')
    ->join('team AS t', 'rt.team_id = t.id', 'left')
    ->where('rt.id', $id)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_details($return_id)
  {
    $rs = $this->db->where('return_id', $return_id)->get($this->td);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_detail($id)
  {
    $rs = $this->db->where('id', $id)->get($this->td);

    if($rs->num_rows() == 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function is_exists_detail($return_id, $serial)
  {
    $rs = $this->db->where('return_id', $return_id)->where('Serial', $serial)->count_all_results($this->td);

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }




  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    $this->db
    ->select('rt.*, wh.name AS whsName, u.uname, t.name As team_name')
    ->from('return_product AS rt')
    ->join('warehouse AS wh', 'rt.whsCode = wh.code', 'left')
    ->join('user AS u', 'rt.create_by = u.id', 'left')
    ->join('team AS t', 'rt.team_id = t.id', 'left');

    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('rt.code', $ds['code']);
    }

    if( isset($ds['whsCode']) && $ds['whsCode'] != "" && $ds['whsCode'] != NULL && $ds['whsCode'] != 'all')
    {
      $this->db->where('rt.whsCode', $ds['whsCode']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('rt.date_add >=', from_date($ds['from_date']))
      ->where('rt.date_add <=', to_date($ds['to_date']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('rt.status', $ds['status']);
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('rt.team_id', $ds['team_id']);
    }

    if($this->_Outsource)
    {
      $this->db->where('rt.create_by', $this->_user->id);
    }

    if($this->_Lead)
    {
      $team_in = array();

      $teams = $this->user_model->get_user_team($this->_user->id);

      if( ! empty($teams))
      {
        foreach($teams as $team)
        {
          $team_in[] = $team->team_id;
        }

        $this->db->where_in('rt.team_id', $team_in);
      }
      else
      {
        $this->db->where('rt.team_id', 0);
      }
    }

    $this->db->order_by('rt.code', 'DESC')->limit($limit, $offset);
    $rs = $this->db->get();
    // echo $this->db->get_compiled_select();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    $this->db
    ->select('rt.*, wh.name AS whsName, u.uname, t.name As team_name')
    ->from('return_product AS rt')
    ->join('warehouse AS wh', 'rt.whsCode = wh.code', 'left')
    ->join('user AS u', 'rt.create_by = u.id', 'left')
    ->join('team AS t', 'rt.team_id = t.id', 'left');

    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('rt.code', $ds['code']);
    }

    if( isset($ds['whsCode']) && $ds['whsCode'] != "" && $ds['whsCode'] != NULL && $ds['whsCode'] != 'all')
    {
      $this->db->where('rt.whsCode', $ds['whsCode']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('rt.date_add >=', from_date($ds['from_date']))
      ->where('rt.date_add <=', to_date($ds['to_date']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('rt.status', $ds['status']);
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('rt.team_id', $ds['team_id']);
    }

    if($this->_Outsource)
    {
      $this->db->where('rt.create_by', $this->_user->id);
    }

    if($this->_Lead)
    {
      $team_in = array();

      $teams = $this->user_model->get_user_team($this->_user->id);

      if( ! empty($teams))
      {
        foreach($teams as $team)
        {
          $team_in[] = $team->team_id;
        }

        $this->db->where_in('rt.team_id', $team_in);
      }
      else
      {
        $this->db->where('rt.team_id', 0);
      }
    }

    return $this->db->count_all_results();

  }


  public function get_max_code($pre)
  {
    $rs = $this->db
    ->select_max('code')
    ->like('code', $pre, 'after')
    ->order_by('code', 'DESC')
    ->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->code;
    }

    return NULL;
  }

} //--- end class

 ?>
