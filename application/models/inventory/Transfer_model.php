<?php
class Transfer_model extends CI_Model
{
  public $tb = "transfer";
  public $td = "transfer_detail";

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


  public function get_detail($id)
  {
    $rs = $this->db->where('id', $id)->get($this->td);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_details($transfer_id)
  {
    $rs = $this->db->where('transfer_id', $transfer_id)->get($this->td);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
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


  public function add_detail(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->insert($this->td, $ds);
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


  public function update_detail($id, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('id', $id)->update($this->td, $ds);
    }

    return FALSE;
  }


  public function update_details($transfer_id, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('transfer_id', $transfer_id)->update($this->td, $ds);
    }

    return FALSE;
  }


  public function change_to_warehouse_code($transfer_id, $toWhsCode)
  {
    return $this->db->set('toWhsCode', $toWhsCode)->where('transfer_id', $transfer_id)->update($this->td);
  }


  public function delete_detail($id)
  {
    return $this->db->where('id', $id)->delete($this->td);
  }


  public function delete_details($transfer_id)
  {
    return $this->db->where('transfer_id', $transfer_id)->delete($this->td);
  }


  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    if( ! empty($ds['code']))
    {
      $this->db->like('code', $ds['code']);
    }

    if( ! empty($ds['from_warehouse']) && $ds['from_warehouse'] != 'all')
    {
      $this->db->where('fromWhsCode', $ds['from_warehouse']);
    }

    if( ! empty($ds['to_warehouse']) && $ds['to_warehouse'] != 'all')
    {
      $this->db->where('toWhsCode', $ds['to_warehouse']);
    }

    if( ! empty($ds['user']))
    {
      if(is_array($ds['user_in']) && ! empty($ds['user_in']))
      {
        $this->db->where_in('user', $ds['user_in']);
      }
    }

    if( ! empty($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('status', $ds['status']);
    }

    if( ! empty($ds['export_status']) && $ds['export_status'] != 'all')
    {
      $this->db->where('export_status', $ds['export_status']);
    }

    if( ! empty($ds['from_date']))
    {
      $this->db->where('date_add >=', from_date($ds['from_date']));
    }

    if( ! empty($ds['to_date']))
    {
      $this->db->where('date_add <=', to_date($ds['to_date']));
    }

    $rs = $this->db->order_by('code', 'DESC')->limit($perpage, $offset)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function count_rows(array $ds = array())
  {
    if( ! empty($ds['code']))
    {
      $this->db->like('code', $ds['code']);
    }

    if( ! empty($ds['from_warehouse']) && $ds['from_warehouse'] != 'all')
    {
      $this->db->where('fromWhsCode', $ds['from_warehouse']);
    }

    if( ! empty($ds['to_warehouse']) && $ds['to_warehouse'] != 'all')
    {
      $this->db->where('toWhsCode', $ds['to_warehouse']);
    }

    if( ! empty($ds['user']))
    {
      if(is_array($ds['user_in']) && ! empty($ds['user_in']))
      {
        $this->db->where_in('user', $ds['user_in']);
      }
    }

    if( ! empty($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('status', $ds['status']);
    }

    if( ! empty($ds['export_status']) && $ds['export_status'] != 'all')
    {
      $this->db->where('export_status', $ds['export_status']);
    }

    if( ! empty($ds['from_date']))
    {
      $this->db->where('date_add >=', from_date($ds['from_date']));
    }

    if( ! empty($ds['to_date']))
    {
      $this->db->where('date_add <=', to_date($ds['to_date']));
    }

    return $this->db->count_all_results($this->tb);
  }


  public function get_max_line_num($transfer_id)
  {
    $rs = $this->db->select_max('LineNum')->where('transfer_id', $transfer_id)->get($this->td);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->LineNum;
    }

    return NULL;
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


  ///---- check rows is all open ?
  public function is_all_open(array $ds = array())
  {
    $rs = $this->db->where('LineStatus !=', 'O')->where_in('id', $ds)->count_all_results($this->td);

    if($rs > 0)
    {
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }


  public function get_warehouse_code_by_serial($serial)
  {
    $rs = $this->ms
    ->select('Q.WhsCode')
    ->from('OSRN AS S')
    ->join('OSRQ AS Q', 'S.ItemCode = Q.ItemCode AND S.SysNumber = Q.SysNumber', 'left')
    ->where('S.DistNumber', $serial)
    ->where('Q.Quantity >', 0, FALSE)
    ->get();

    if($rs->num_rows() == 1)
    {
      return $rs->row()->WhsCode;
    }

    return NULL;
  }


  public function is_exists_row($i_pea_no)
  {
    $exists = $this->db->where('i_pea_no', $i_pea_no)->where('LineStatus', 'O')->count_all_results($this->td);

    if($exists)
    {
      return TRUE;
    }

    return FALSE;
  }


  public function totalRow($id)
  {
    return $this->db->where('transfer_id', $id)->count_all_results($this->td);
  }
} //--- end class

 ?>
