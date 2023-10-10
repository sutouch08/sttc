<?php
class Install_list_model extends CI_Model
{
  private $tb = "install_list";

  public function __construct()
  {
    parent::__construct();
  }

  public function is_exists($u_pea_no)
  {
    $rs = $this->db->where('u_pea_no', $u_pea_no)->count_all_results($this->tb);

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }

  public function get($pea_no, $op = 'u')
  {
    if($op == 'i')
    {
      $this->db->where('i_pea_no', $pea_no);
    }
    else
    {
      $this->db->where('u_pea_no', $pea_no);
    }

    $rs = $this->db->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return $rs->num_rows() > 1 ? FALSE : NULL;
  }


  public function get_id($pea_no)
  {
    $rs = $this->db->select('id')->where('u_pea_no', $pea_no)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row()->id;
    }

    return NULL;
  }


  public function get_by_id($id)
  {
    $rs = $this->db->where('id', $id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function add(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->insert($this->tb, $ds);
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


  public function update_by_u_pea_no($u_pea_no, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('u_pea_no', $u_pea_no)->update($this->tb, $ds);
    }

    return FALSE;
  }


  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    if( ! empty($ds['u_pea_no']))
    {
      $this->db->like('u_pea_no', $ds['u_pea_no']);
    }

    if( ! empty($ds['i_pea_no']))
    {
      $this->db->like('i_pea_no', $ds['i_pea_no']);
    }

    if( ! empty($ds['worker']))
    {
      $this->db->like('worker', $ds['worker']);
    }

    if( ! empty($ds['user']))
    {
      $this->db->like('user', $ds['user']);
    }

    if( ! empty($ds['transfer_code']))
    {
      $this->db->like('transfer_code', $ds['transfer_code']);
    }


    if( ! empty($ds['pack_code_from']) OR ! empty($ds['pack_code_to']))
    {
      if( ! empty($ds['pack_code_from']) && ! empty($ds['pack_code_to']))
      {
        $this->db
        ->group_start()
        ->where('pack_code >=', $ds['pack_code_from'])
        ->where('pack_code <=', $ds['pack_code_to'])
        ->group_end();
      }
      else
      {
        if( ! empty($ds['pack_code_from']))
        {
          $this->db->like('pack_code', $ds['pack_code_from']);
        }

        if( ! empty($ds['pack_code_to']))
        {
          $this->db->like('pack_code', $ds['pack_code_to']);
        }
      }
    }


    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->group_start()
      ->where('work_date >=', from_date($ds['from_date']))
      ->where('work_date <=', to_date($ds['to_date']))
      ->group_end();
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      if($ds['status'] == 'O0')
      {
        $this->db->where('status', 'O')->where('pack_status', 0);
      }
      else if($ds['status'] == 'O1')
      {
        $this->db->where('status', 'O')->where('pack_status', 1);
      }
      else
      {
        $this->db->where('status', $ds['status']);
      }
    }

    if( ! empty($ds['whsCode']) && $ds['whsCode'] != 'all')
    {
      $this->db->where('WhsCode', $ds['whsCode']);
    }

    if( ! empty($ds['area']) && $ds['area'] != 'all')
    {
      $this->db->where('area', $ds['area']);
    }


    $rs = $this->db->order_by('id', 'DESC')->limit($perpage, $offset)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

  public function count_rows(array $ds = array())
  {
    if( ! empty($ds['u_pea_no']))
    {
      $this->db->like('u_pea_no', $ds['u_pea_no']);
    }

    if( ! empty($ds['i_pea_no']))
    {
      $this->db->like('i_pea_no', $ds['i_pea_no']);
    }

    if( ! empty($ds['worker']))
    {
      $this->db->like('worker', $ds['worker']);
    }

    if( ! empty($ds['user']))
    {
      $this->db->like('user', $ds['user']);
    }

    if( ! empty($ds['transfer_code']))
    {
      $this->db->like('transfer_code', $ds['transfer_code']);
    }

    if( ! empty($ds['pack_code_from']) OR ! empty($ds['pack_code_to']))
    {
      if( ! empty($ds['pack_code_from']) && ! empty($ds['pack_code_to']))
      {
        $this->db
        ->group_start()
        ->where('pack_code >=', $ds['pack_code_from'])
        ->where('pack_code <=', $ds['pack_code_to'])
        ->group_end();
      }
      else
      {
        if( ! empty($ds['pack_code_from']))
        {
          $this->db->like('pack_code', $ds['pack_code_from']);
        }

        if( ! empty($ds['pack_code_to']))
        {
          $this->db->like('pack_code', $ds['pack_code_to']);
        }
      }
    }

    if( ! empty($ds['area']) && $ds['area'] != 'all')
    {
      $this->db->where('area', $ds['area']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->group_start()
      ->where('work_date >=', from_date($ds['from_date']))
      ->where('work_date <=', to_date($ds['to_date']))
      ->group_end();
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      if($ds['status'] == 'O0')
      {
        $this->db->where('status', 'O')->where('pack_status', 0);
      }
      else if($ds['status'] == 'O1')
      {
        $this->db->where('status', 'O')->where('pack_status', 1);
      }
      else
      {
        $this->db->where('status', $ds['status']);
      }
    }

    if( ! empty($ds['whsCode']) && $ds['whsCode'] != 'all')
    {
      $this->db->where('WhsCode', $ds['whsCode']);
    }

    return $this->db->count_all_results($this->tb);
  }


  public function count_worker(array $ds = array())
  {
    if( ! empty($ds['u_pea_no']))
    {
      $this->db->like('u_pea_no', $ds['u_pea_no']);
    }

    if( ! empty($ds['i_pea_no']))
    {
      $this->db->like('i_pea_no', $ds['i_pea_no']);
    }

    if( ! empty($ds['worker']))
    {
      $this->db->like('worker', $ds['worker']);
    }

    if( ! empty($ds['user']))
    {
      $this->db->like('user', $ds['user']);
    }

    if( ! empty($ds['transfer_code']))
    {
      $this->db->like('transfer_code', $ds['transfer_code']);
    }

    if( ! empty($ds['pack_code_from']) OR ! empty($ds['pack_code_to']))
    {
      if( ! empty($ds['pack_code_from']) && ! empty($ds['pack_code_to']))
      {
        $this->db
        ->group_start()
        ->where('pack_code >=', $ds['pack_code_from'])
        ->where('pack_code <=', $ds['pack_code_to'])
        ->group_end();
      }
      else
      {
        if( ! empty($ds['pack_code_from']))
        {
          $this->db->like('pack_code', $ds['pack_code_from']);
        }

        if( ! empty($ds['pack_code_to']))
        {
          $this->db->like('pack_code', $ds['pack_code_to']);
        }
      }
    }

    if( ! empty($ds['area']) && $ds['area'] != 'all')
    {
      $this->db->where('area', $ds['area']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->group_start()
      ->where('work_date >=', from_date($ds['from_date']))
      ->where('work_date <=', to_date($ds['to_date']))
      ->group_end();
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      if($ds['status'] == 'O0')
      {
        $this->db->where('status', 'O')->where('pack_status', 0);
      }
      else if($ds['status'] == 'O1')
      {
        $this->db->where('status', 'O')->where('pack_status', 1);
      }
      else
      {
        $this->db->where('status', $ds['status']);
      }
    }

    if( ! empty($ds['whsCode']) && $ds['whsCode'] != 'all')
    {
      $this->db->where('WhsCode', $ds['whsCode']);
    }

    $this->db->order_by('id', 'DESC')->group_by('worker');

    return $this->db->count_all_results($this->tb);
  }


  public function get_open_items_by_filter(array $ds = array())
  {
    $this->db
    ->select('i.id, i.u_pea_no, i.i_pea_no, i.worker, i.work_date, i.area')
    ->select('a.name AS area_name')
    ->from('install_list AS i')
    ->join('team AS a', 'i.area = a.code', 'left')
    ->where('i.status', 'O')
    ->where('i.pack_status', 0);

    if( ! empty($ds['pea_no']))
    {
      $this->db
      ->group_start()
      ->like('i.u_pea_no', $ds['pea_no'])
      ->or_like('i.i_pea_no', $ds['pea_no'])
      ->group_end();
    }

    if( ! empty($ds['area']) && $ds['area'] != 'all')
    {
      $this->db->where('i.area', $ds['area']);
    }

    $this->db->order_by('i.work_date', 'ASC')->limit(300);

    $rs = $this->db->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_item_data_by_pea_no(string $pea_no)
  {
    $rs = $this->ms
    ->select('ItemCode, itemName AS ItemName, DistNumber')
    ->where('DistNumber', $pea_no)
    ->get('OSRN');

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function delete_rows(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('pack_status', 0)->where_in('id', $ds)->delete($this->tb);
    }

    return FALSE;
  }


  public function close_rows(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->set('prev_status', 'status', FALSE)->set('status', 'C')->where_in('id', $ds)->update($this->tb);
    }

    return FALSE;
  }


  public function un_close_rows(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->set('status', 'prev_status', FALSE)->where_in('id', $ds)->update($this->tb);
    }

    return FALSE;
  }


  public function change_status($id, $status, $transfer_code = NULL)
  {
    return $this->db->set('status', $status)->set('transfer_code', $transfer_code)->where('id', $id)->update($this->tb);
  }


  public function change_status_by_u_pea_no($u_pea_no, $status, $transfer_code = NULL)
  {
    return $this->db->set('status', $status)->set('transfer_code', $transfer_code)->where('u_pea_no', $u_pea_no)->update($this->tb);
  }

  public function change_status_by_transfer_code($transfer_code, $status)
  {
    return $this->db->set('status', $status)->where('transfer_code', $transfer_code)->update($this->tb);
  }

  public function unpack($pea_no, $op = 'u')
  {
    $ds = array(
      'pack_status' => 0,
      'pack_code' => NULL
    );

    if($op == 'i')
    {
      return $this->db->where('i_pea_no', $pea_no)->update($this->tb, $ds);
    }
    else
    {
      return $this->db->where('u_pea_no', $pea_no)->update($this->tb, $ds);
    }
  }

  public function unpack_by_pack_code($pack_code)
  {
    $arr = array(
      'pack_code' => NULL,
      'pack_status' => 0
    );

    return $this->db->where('pack_status', 1)->where('pack_code', $pack_code)->update($this->tb, $arr);
  }


  public function count_worker_by_date($date, $area)
  {
    $qr = "SELECT COUNT(DISTINCT(worker)) AS workers_qty ";
    $qr .= "FROM install_list ";
    $qr .= "WHERE work_date = '{$date}' AND area = '{$area}'";

    $rs = $this->db->query($qr);


    if($rs->num_rows() == 1)
    {
      return $rs->row()->workers_qty;
    }

    return NULL;
  }

} //--- end class

 ?>
