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
    ->select('item.*, user.uname, user.name AS display_name')
    ->from('user_item AS item')
    ->join('user AS user', 'item.user_id = user.id', 'left');

    if(isset($ds['code']) && $ds['code'] != '' && $ds['code'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('item.ItemCode', $ds['code'])
      ->or_like($ds['item.ItemName'], $ds['code'])
      ->group_end();
    }


    if(isset($ds['serial']) && $ds['serial'] != '' && $ds['serial'] != NULL)
    {
      $this->db->like('item.serial', $ds['serial']);
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


    if(isset($ds['user']) && $ds['user'] != "" && $ds['user'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('user.uname', $ds['user'])
      ->or_like('user.name', $ds['user'])
      ->group_end();
    }

    if(isset($ds['from_date']) && $ds['from_date'] != "" && isset($ds['to_date']) && $ds['to_date'] != "")
    {
      $this->db
      ->group_start()
      ->where('item.date_add >=', from_date($ds['from_date']))
      ->where('item.date_add <=', to_date($ds['to_date']))
      ->group_end();
    }


    $rs = $this->db->order_by('item.date_add', 'DESC')->order_by('item.DocNum', 'ASC')->order_by('item.serial', 'ASC')->limit($perpage, $offset)->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    $this->db
    ->select('item.*, user.uname, user.name AS display_name')
    ->from('user_item AS item')
    ->join('user AS user', 'item.user_id = user.id', 'left');

    if(isset($ds['code']) && $ds['code'] != '' && $ds['code'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('item.ItemCode', $ds['code'])
      ->or_like($ds['item.ItemName'], $ds['code'])
      ->group_end();
    }


    if(isset($ds['serial']) && $ds['serial'] != '' && $ds['serial'] != NULL)
    {
      $this->db->like('item.serial', $ds['serial']);
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


    if(isset($ds['user']) && $ds['user'] != "" && $ds['user'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('user.uname', $ds['user'])
      ->or_like('user.name', $ds['user'])
      ->group_end();
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


  public function drop_open_item($docNum, $user_id)
  {
    return $this->db->where('user_id', $user_id)->where('DocNum', $docNum)->where('status', 0)->delete($this->tb);
  }

  public function is_exists($docNum, $user_id, $serial)
  {
    $rs = $this->db->where('user_id', $user_id)->where('DocNum', $docNum)->where('Serial', $serial)->count_all_results($this->tb);

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }


  public function get_open_user_items($user_id)
  {
    $rs = $this->db->where('user_id', $user_id)->where('status', 0)->get($this->tb);

    if( $rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
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
