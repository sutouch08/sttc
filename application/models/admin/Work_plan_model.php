<?php
class Work_plan_model extends CI_Model
{
  private $tb = "work_list";

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


  public function set_team($team_id, array $ds = array())
  {
    if( ! empty($ds) && ! empty($team_id))
    {
      return $this->db->set('team_id', $team_id)->where_in('id', $ds)->update($this->tb);
    }

    return FALSE;
  }


  public function unset_team(array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->set('team_id', NULL)->where_in('id', $ds)->update($this->tb);
    }

    return FALSE;
  }


  public function get_id($pea_no)
  {
    $rs = $this->db->select('id')->where('pea_no', $pea_no)->get($this->tb);

    if($rs->num_rows() == 1)
    {
      return $rs->row()->id;
    }

    return NULL;
  }



  public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {
    if(! empty($ds['pea_no']))
    {
      $this->db->like('pea_no', $ds['pea_no']);
    }

    if(! empty($ds['cust_no']))
    {
      $this->db->like('cust_no', $ds['cust_no']);
    }

    if(! empty($ds['ca_no']))
    {
      $this->db->like('ca_no', $ds['ca_no']);
    }

    if(! empty($ds['cust_name']))
    {
      $this->db->like('cust_name', $ds['cust_name']);
    }

    if(! empty($ds['cust_tel']))
    {
      $this->db->like('cust_tel', $ds['cust_tel']);
    }

    if(! empty($ds['cust_route']))
    {
      $this->db->like('cust_route', $ds['cust_route']);
    }

    if(! empty($ds['plan_table_name']))
    {
      $this->db->like('Plan_TableName', $ds['plan_table_name']);
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      if($ds['team_id'] == 'null')
      {
        $this->db->where("team_id IS NULL", NULL, FALSE);
      }
      else
      {
        $this->db->where('team_id', $ds['team_id']);
      }
    }

    if(isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('status', $ds['status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db->where('date_upd >=', from_date($ds['from_date']))->where('date_upd <=', to_date($ds['to_date']));
    }

    $this->db->order_by('date_upd', 'DESC')->limit($perpage, $offset);

    $rs = $this->db->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    if(! empty($ds['pea_no']))
    {
      $this->db->like('pea_no', $ds['pea_no']);
    }

    if(! empty($ds['cust_no']))
    {
      $this->db->like('cust_no', $ds['cust_no']);
    }

    if(! empty($ds['ca_no']))
    {
      $this->db->like('ca_no', $ds['ca_no']);
    }

    if(! empty($ds['cust_name']))
    {
      $this->db->like('cust_name', $ds['cust_name']);
    }

    if(! empty($ds['cust_tel']))
    {
      $this->db->like('cust_tel', $ds['cust_tel']);
    }

    if(! empty($ds['cust_route']))
    {
      $this->db->like('cust_route', $ds['cust_route']);
    }

    if(! empty($ds['plan_table_name']))
    {
      $this->db->like('Plan_TableName', $ds['plan_table_name']);
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      if($ds['team_id'] == 'null')
      {
        $this->db->where("team_id IS NULL", NULL, FALSE);
      }
      else
      {
        $this->db->where('team_id', $ds['team_id']);
      }
    }

    if(isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('status', $ds['status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db->where('date_upd >=', from_date($ds['from_date']))->where('date_upd <=', to_date($ds['to_date']));
    }

    return $this->db->count_all_results($this->tb);
  }


} //--- end class

 ?>
