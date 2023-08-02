<?php
class Stock_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_items_list()
  {
    $rs = $this->ms
    ->select('ItemCode')
    ->where('U_ITM_TYPE', '8Ket')
    ->or_where('U_ITM_TYPE', '8ket')
    ->order_by('ItemCode', 'ASC')
    ->get('OITM');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }
  }


  public function get_stock_by_warehouse($WhsCode, $ds = array())
  {
    if( ! empty($ds))
    {
      $rs = $this->ms
      ->select('ItemCode, OnHand, WhsCode')
      ->where('WhsCode', $WhsCode)
      ->where_in('ItemCode', $ds)
      ->order_by('ItemCode', 'ASC')
      ->get('OITW');

      if($rs->num_rows() > 0)
      {
        return $rs->result();
      }
    }

    return NULL;
  }


  public function get_stock_by_area(array $Whs = array(), array $items = array())
  {
    if( ! empty($Whs) && ! empty($items))
    {
      $rs = $this->ms
      ->select('ItemCode')
      ->select_sum('OnHand')
      ->where_in('WhsCode', $Whs)
      ->where_in('ItemCode', $items)
      ->group_by('ItemCode')
      ->order_by('ItemCode', 'ASC')
      ->get('OITW');

      if($rs->num_rows() > 0)
      {
        return $rs->result();
      }
    }

    return NULL;
  }

  public function get_stock_by_role(array $Whs = array(), array $items = array())
  {
    if( ! empty($Whs) && ! empty($items))
    {
      $rs = $this->ms
      ->select('ItemCode')
      ->select_sum('OnHand')
      ->where_in('WhsCode', $Whs)
      ->where_in('ItemCode', $items)
      ->group_by('ItemCode')
      ->order_by('ItemCode', 'ASC')
      ->get('OITW');

      if($rs->num_rows() > 0)
      {
        return $rs->result();
      }
    }

    return NULL;
  }



  public function get_stock($ItemCode, array $warehouse = array())
  {
    if( ! empty($warehouse))
    {
      $rs = $this->ms
      ->select('ItemCode, OnHand, WhsCode')
      ->where('ItemCode', $ItemCode)
      ->where_in('WhsCode', $warehouse)
      ->order_by('WhsCode', 'ASC')
      ->get('OITW');

      if($rs->num_rows() > 0)
      {
        return $rs->result();
      }
    }

    return NULL;
  }


  public function get_listed_warehouse()
  {
    $rs = $this->db
    ->select('code')
    ->where('listed', 1)
    ->where('status', 1)
    ->order_by('code', 'ASC')
    ->get('warehouse');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_listed_warehouse_by_area($area_id)
  {
    $rs = $this->db
    ->select('code')
    ->where('listed', 1)
    ->where('status', 1)
    ->where('team_id', $area_id)
    ->get('warehouse');

    if($rs->num_rows() > 0)
    {
      $wh = array();

      foreach($rs->result() as $rd)
      {
        $wh[] = $rd->code;
      }

      return $wh;
    }

    return NULL;
  }


  public function get_listed_warehouse_by_role($role)
  {
    $rs = $this->db
    ->select('code')
    ->where('listed', 1)
    ->where('status', 1)
    ->where('role', $role)
    ->get('warehouse');

    if($rs->num_rows() > 0)
    {
      $wh = array();

      foreach($rs->result() as $rd)
      {
        $wh[] = $rd->code;
      }

      return $wh;
    }

    return NULL;
  }

}

 ?>
