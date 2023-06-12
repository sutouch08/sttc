<?php
class Inform_model extends CI_Model
{
  private $tb = "inform";

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

  public function update_by_pea_no($pea_no, $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('pea_no', $pea_no)->update($this->tb, $ds);
    }

    return FALSE;
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
    $this->db
    ->select('w.*, u.name AS team_group_name')
    ->from('inform AS w')
    ->join('team_group AS u', 'w.team_group_id = u.id', 'left')
    ->where('w.team_id IS NOT NULL');

    if(! empty($ds['pea_no']))
    {
      $this->db->like('w.pea_no', $ds['pea_no']);
    }

    if(! empty($ds['ca_no']))
    {
      $this->db->like('w.ca_no', $ds['ca_no']);
    }

    if(! empty($ds['cust_route']))
    {
      $this->db->like('w.cust_route', $ds['cust_route']);
    }

    if( ! empty($ds['team_group']))
    {
      $this->db->like('u.name', $ds['team_group']);
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

        $this->db->where_in('w.team_id', $team_in);
      }
      else
      {
        $this->db->where('w.team_id', 0);
      }
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      if($ds['team_id'] == 'null')
      {
        $this->db->where("w.team_id IS NULL", NULL, FALSE);
      }
      else
      {
        $this->db->where('w.team_id', $ds['team_id']);
      }
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('w.status', $ds['status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db->where('w.date_add >=', from_date($ds['from_date']))->where('w.date_add <=', to_date($ds['to_date']));
    }

    $this->db->order_by('w.date_add', 'DESC')->limit($perpage, $offset);

    $rs = $this->db->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function count_rows(array $ds = array())
  {
    $this->db
    ->from('inform AS w')
    ->join('team_group AS u', 'w.team_group_id = u.id', 'left')
    ->where('w.team_id IS NOT NULL');

    if(! empty($ds['pea_no']))
    {
      $this->db->like('w.pea_no', $ds['pea_no']);
    }

    if(! empty($ds['ca_no']))
    {
      $this->db->like('w.ca_no', $ds['ca_no']);
    }

    if(! empty($ds['cust_route']))
    {
      $this->db->like('w.cust_route', $ds['cust_route']);
    }

    if( ! empty($ds['team_group']))
    {
      $this->db->like('u.name', $ds['team_group']);
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

        $this->db->where_in('w.team_id', $team_in);
      }
      else
      {
        $this->db->where('w.team_id', 0);
      }
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      if($ds['team_id'] == 'null')
      {
        $this->db->where("w.team_id IS NULL", NULL, FALSE);
      }
      else
      {
        $this->db->where('w.team_id', $ds['team_id']);
      }
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('w.status', $ds['status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db->where('w.date_add >=', from_date($ds['from_date']))->where('w.data_add <=', to_date($ds['to_date']));
    }

    return $this->db->count_all_results();
  }


  public function is_exists($pea_no)
  {
    $rs = $this->db->where('pea_no', $pea_no)->count_all_results($this->tb);

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }


  public function set_status($pea_no, $status)
  {
    if( ! empty($pea_no))
    {
      return $this->db->set('status', $status)->where('pea_no', $pea_no)->update($this->tb);
    }

    return FALSE;
  }


} //--- end class

 ?>
