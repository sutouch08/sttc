<?php
class Pack_model extends CI_Model
{
  private $tb = "pack";
  private $td = "pack_detail";
  private $bx = "pack_box";

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

  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
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


  public function get_by_code($code)
  {
    $rs = $this->db->where('code', $code)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_details($pack_id)
  {
    $rs = $this->db->where('pack_id', $pack_id)->order_by('id', 'DESC')->get($this->td);

    if( $rs->num_rows() > 0)
    {
      return $rs->result();
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


  public function add_detail(array $ds = array())
  {
    if($this->db->insert($this->td, $ds))
    {
      return $this->db->insert_id();
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


  public function update_details($pack_id, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('pack_id', $pack_id)->update($this->td, $ds);
    }

    return FALSE;
  }


  public function delete_detail($id)
  {
    return $this->db->where('id', $id)->delete($this->td);
  }


  public function delete_details($pack_id)
  {
    return $this->db->where('pack_id', $pack_id)->delete($this->td);
  }

  public function delete_rows(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where_in('id', $ds)->delete($this->td);
    }

    return FALSE;
  }

  public function get_sum_qty($pack_id)
  {
    return $this->db->where('pack_id', $pack_id)->count_all_results($this->td);
  }



  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    if( ! empty($ds['code']))
    {
      $this->db->like('code', $ds['code']);
    }

    if( ! empty($ds['reference']))
    {
      $this->db->like('transfer_code', $ds['reference']);
    }

    if( ! empty($ds['area']) && $ds['area'] != 'all')
    {
      $this->db->where('team_id', $ds['area']);
    }

    if( ! empty($ds['warehouse']) && $ds['warehouse'] != 'all')
    {
      $this->db->where('WhsCode', $ds['warehouse']);
    }


    if( ! empty($ds['user']) && $ds['user'] != 'all')
    {
      $this->db->where('user', $ds['user']);
    }

    if( ! empty($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('status', $ds['status']);
    }

    if( ! empty($ds['phase']) && $ds['phase'] != 'all')
    {
      $this->db->where('phase', $ds['phase']);
    }

    if( ! empty($ds['from_date']))
    {
      $this->db->where('date_add >=', from_date($ds['from_date']));
    }

    if( ! empty($ds['to_date']))
    {
      $this->db->where('date_add <=', to_date($ds['to_date']));
    }

    $rs = $this->db->order_by($ds['code'], 'DESC')->limit($perpage, $offset)->get($this->tb);

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

    if( ! empty($ds['reference']))
    {
      $this->db->like('transfer_code', $ds['reference']);
    }

    if( ! empty($ds['area']) && $ds['area'] != 'all')
    {
      $this->db->where('team_id', $ds['area']);
    }

    if( ! empty($ds['warehouse']) && $ds['warehouse'] != 'all')
    {
      $this->db->where('WhsCode', $ds['warehouse']);
    }

    if( ! empty($ds['user']) && $ds['user'] != 'all')
    {
      $this->db->where('user', $ds['user']);
    }

    if( ! empty($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('status', $ds['status']);
    }

    if( ! empty($ds['phase']) && $ds['phase'] != 'all')
    {
      $this->db->where('phase', $ds['phase']);
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


  public function get_max_code($prefix)
  {
    if( ! empty($prefix))
    {
      $rs = $this->db
      ->select_max('code')
      ->like('code', $prefix, 'after')
      ->order_by('code', 'DESC')
      ->get($this->tb);

      if($rs->num_rows() === 1)
      {
        return $rs->row()->code;
      }

      return NULL;
    }
  }

} //--- end class

 ?>
