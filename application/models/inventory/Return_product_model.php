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


  public function update_details($return_id, $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('return_id', $return_id)->update($this->td, $ds);
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


  public function update_user_item($user_id, $serial, $docNum, $status)
  {
    $this->db
    ->set('status', $status)
    ->where('user_id', $user_id)
    ->where('serial', $serial)
    ->where('DocNum', $docNum);

    return $this->db->update('user_item');
  }


  public function get($id)
  {
    $rs = $this->db
    ->select('rt.*, wh.name AS whName, u.uname, u.name AS display_name, t.name AS team_name')
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


  public function get_return_draft_by_user_id($user_id)
  {
    $rs = $this->db
    ->where('create_by', $user_id)
    ->where('status', -1)
    ->get($this->tb);

    if($rs->num_rows() > 0)
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


  public function delete_detail($id)
  {
    return $this->db->where('id', $id)->delete($this->td);
  }




  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    $this->db
    ->select('rt.*, fwh.name AS fromWhsName, twh.name AS toWhsName, u.uname, t.name As team_name')
    ->from('return_product AS rt')
    ->join('warehouse AS fwh', 'rt.whsCode = fwh.code', 'left')
    ->join('warehouse AS twh', 'rt.toWhsCode = twh.code', 'left')
    ->join('user AS u', 'rt.create_by = u.id', 'left')
    ->join('team AS t', 'rt.team_id = t.id', 'left');

    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('rt.code', $ds['code']);
    }

    if( isset($ds['fromWhsCode']) && $ds['fromWhsCode'] != "" && $ds['fromWhsCode'] != NULL && $ds['fromWhsCode'] != 'all')
    {
      if($ds['fromWhsCode'] == 'null')
      {
        $this->db->where('rt.whsCode IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('rt.whsCode', $ds['fromWhsCode']);
      }
    }

    if( isset($ds['toWhsCode']) && $ds['toWhsCode'] != "" && $ds['toWhsCode'] != NULL && $ds['toWhsCode'] != 'all')
    {
      if($ds['toWhsCode'] == 'null')
      {
        $this->db->where('rt.toWhsCode IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('rt.toWhsCode', $ds['toWhsCode']);
      }
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('rt.date_add >=', from_date($ds['from_date']))
      ->where('rt.date_add <=', to_date($ds['to_date']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      if($ds['status'] == 10)
      {
        $this->db->where('rt.is_approve', 0)->where('rt.status', 1);
      }
      else if($ds['status'] == 11)
      {
        $this->db->where('rt.is_approve', 1)->where('rt.status', 1);
      }
      else
      {
        $this->db->where('rt.status', $ds['status']);
      }
    }

    if( isset($ds['is_receive']) && $ds['is_receive'] != "" && $ds['is_receive'] != NULL && $ds['is_receive'] != "all")
    {
      $this->db->where('rt.is_receive', $ds['is_receive']);
    }

    if( isset($ds['receive_by']) && $ds['receive_by'] != "" && $ds['receive_by'] != NULL && $ds['receive_by'] != "all")
    {
      $this->db->where('rt.receive_by', $ds['receive_by']);
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('rt.team_id', $ds['team_id']);
    }

    if(isset($ds['user_id']) && $ds['user_id'] != 'all')
    {
      $this->db->where('rt.create_by', $ds['user_id']);
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
    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('code', $ds['code']);
    }

    if( isset($ds['fromWhsCode']) && $ds['fromWhsCode'] != "" && $ds['fromWhsCode'] != NULL && $ds['fromWhsCode'] != 'all')
    {
      if($ds['fromWhsCode'] == 'null')
      {
        $this->db->where('whsCode IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('whsCode', $ds['fromWhsCode']);
      }
    }

    if( isset($ds['toWhsCode']) && $ds['toWhsCode'] != "" && $ds['toWhsCode'] != NULL && $ds['toWhsCode'] != 'all')
    {
      if($ds['toWhsCode'] == 'null')
      {
        $this->db->where('toWhsCode IS NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('toWhsCode', $ds['toWhsCode']);
      }
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('date_add >=', from_date($ds['from_date']))
      ->where('date_add <=', to_date($ds['to_date']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      if($ds['status'] == 10)
      {
        $this->db->where('is_approve', 0)->where('status', 1);
      }
      else if($ds['status'] == 11)
      {
        $this->db->where('is_approve', 1)->where('status', 1);
      }
      else
      {
        $this->db->where('status', $ds['status']);
      }
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('team_id', $ds['team_id']);
    }

    if(isset($ds['user_id']) && $ds['user_id'] != 'all')
    {
      $this->db->where('create_by', $ds['user_id']);
    }

    if( isset($ds['is_receive']) && $ds['is_receive'] != "" && $ds['is_receive'] != NULL && $ds['is_receive'] != "all")
    {
      $this->db->where('is_receive', $ds['is_receive']);
    }

    if( isset($ds['receive_by']) && $ds['receive_by'] != "" && $ds['receive_by'] != NULL && $ds['receive_by'] != "all")
    {
      $this->db->where('receive_by', $ds['receive_by']);
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

        $this->db->where_in('team_id', $team_in);
      }
      else
      {
        $this->db->where('team_id', 0);
      }
    }

    return $this->db->count_all_results($this->tb);

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


  public function getSapDocNum($code)
  {
    // $rs = $this->ms
    // ->select('DocNum')
    // ->where('U_WEBCODE', $code)
    // ->where('CANCELED', 'N')
    // ->where('DocStatus', 'O')
    // ->get('OWTR');
    //
    // if($rs->num_rows() > 0)
    // {
    //   return $rs->row()->DocNum;
    // }

    return NULL;
  }

} //--- end class

 ?>
