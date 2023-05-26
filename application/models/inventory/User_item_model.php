<?php
class User_item_model extends CI_Model
{
  private $tb = "user_item";

  public function __construct()
  {
    parent::__construct();
  }


  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    $this->db
    ->select('item.*, g.name AS team_group_name, t.name AS team_name')
    ->from('user_item AS item')
    ->join('team AS t', 'item.team_id = t.id', 'left')
    ->join('team_group AS g', 'item.team_group_id = g.id', 'left');

    if(isset($ds['code']) && $ds['code'] != '' && $ds['code'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('item.ItemCode', $ds['code'])
      ->or_like($ds['item.ItemName'], $ds['code'])
      ->group_end();
    }

    if(isset($ds['pea_no']) && $ds['pea_no'] != "")
    {
      $this->db->like('item.pea_no', $ds['pea_no']);
    }

    if(isset($ds['serial']) && $ds['serial'] != '' && $ds['serial'] != NULL)
    {
      $this->db->like('item.serial', $ds['serial']);
    }

    if(isset($ds['team_group']) && $ds['team_group'] != "")
    {
      $this->db->like('g.name', $ds['team_group']);
    }

    if(isset($ds['team']) && $ds['team'] != 'all')
    {
      $this->db->where('item.team_id', $ds['team']);
    }


    if(isset($ds['docNum']) && $ds['docNum'] != '' && $ds['docNum'] != NULL)
    {
      $this->db->like('item.DocNum', $ds['docNum']);
    }


    if(isset($ds['whCode']) && $ds['whCode'] != 'all')
    {
      $this->db->where('item.WhsCode', $ds['whCode']);
    }


    if(isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('item.status', $ds['status']);
    }


    if(isset($ds['from_date']) && $ds['from_date'] != "" && isset($ds['to_date']) && $ds['to_date'] != "")
    {
      $this->db
      ->group_start()
      ->where('item.date_add >=', from_date($ds['from_date']))
      ->where('item.date_add <=', to_date($ds['to_date']))
      ->group_end();
    }


    $rs = $this->db
    ->order_by('item.date_add', 'DESC')
    ->order_by('item.DocNum', 'ASC')
    ->order_by('item.serial', 'ASC')
    ->limit($perpage, $offset)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    $this->db
    ->from('user_item AS item')
    ->join('team AS t', 'item.team_id = t.id', 'left')
    ->join('team_group AS g', 'item.team_group_id = g.id', 'left');

    if(isset($ds['code']) && $ds['code'] != '' && $ds['code'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('item.ItemCode', $ds['code'])
      ->or_like($ds['item.ItemName'], $ds['code'])
      ->group_end();
    }

    if(isset($ds['pea_no']) && $ds['pea_no'] != "")
    {
      $this->db->like('item.pea_no', $ds['pea_no']);
    }

    if(isset($ds['serial']) && $ds['serial'] != '' && $ds['serial'] != NULL)
    {
      $this->db->like('item.serial', $ds['serial']);
    }

    if(isset($ds['team_group']) && $ds['team_group'] != "")
    {
      $this->db->like('g.name', $ds['team_group']);
    }

    if(isset($ds['team']) && $ds['team'] != 'all')
    {
      $this->db->where('item.team_id', $ds['team']);
    }


    if(isset($ds['docNum']) && $ds['docNum'] != '' && $ds['docNum'] != NULL)
    {
      $this->db->like('item.DocNum', $ds['docNum']);
    }


    if(isset($ds['whCode']) && $ds['whCode'] != 'all')
    {
      $this->db->where('item.WhsCode', $ds['whCode']);
    }


    if(isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('item.status', $ds['status']);
    }


    if(isset($ds['from_date']) && $ds['from_date'] != "" && isset($ds['to_date']) && $ds['to_date'] != "")
    {
      $this->db
      ->group_start()
      ->where('item.date_add >=', from_date($ds['from_date']))
      ->where('item.date_add <=', to_date($ds['to_date']))
      ->group_end();
    }

    return $this->db->count_all_results();
  }


  public function drop_open_item($docNum, $team_group_id)
  {
    return $this->db->where('team_group_id', $team_group_id)->where('DocNum', $docNum)->where('status', 0)->delete($this->tb);
  }


  public function is_exists($docNum, $team_group_id, $serial)
  {
    $rs = $this->db->where('team_group_id', $team_group_id)->where('DocNum', $docNum)->where('Serial', $serial)->count_all_results($this->tb);

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }

  //
  // public function get_open_user_items($team_group_id)
  // {
  //   $rs = $this->db->where('team_group_id', $team_group_id)->where('status', 0)->get($this->tb);
  //
  //   if( $rs->num_rows() > 0)
  //   {
  //     return $rs->result();
  //   }
  //
  //   return NULL;
  // }


  public function get_open_team_group_items($team_group_id)
  {
    $rs = $this->db->where('team_group_id', $team_group_id)->where_in('status', array('P', 'R', 'U'))->get($this->tb);

    if( $rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function delete_open_team_group_items($team_group_id, $docNum)
  {
    return $this->db->where('DocNum', $docNum)->where('team_group_id', $team_group_id)->where_in('status', 'P')->delete($this->tb);
  }


  public function update_row($id, $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }

} //--- end class

 ?>
