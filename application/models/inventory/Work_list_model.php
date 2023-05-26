<?php
class Work_list_model extends CI_Model
{
  private $tb = "work_list";

  public function __construct()
  {
    parent::__construct();
  }


  public function update($id, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
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
    $this->db
    ->select('w.*, u.name AS team_group_name')
    ->from('work_list AS w')
    ->join('team_group AS u', 'w.team_group_id = u.id', 'left')
    ->where('w.team_id IS NOT NULL');

    if(! empty($ds['pea_no']))
    {
      $this->db->like('w.pea_no', $ds['pea_no']);
    }

    if(! empty($ds['customer']))
    {
      $this->db
      ->group_start()
      ->like('w.cust_no', $ds['customer'])
      ->or_like('w.cust_name', $ds['customer'])
      ->or_like('w.cust_tel', $ds['customer'])
      ->group_end();
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


    if( isset($ds['assigned']) && $ds['assigned'] != 'all')
    {
      if($ds['assigned'] == 1)
      {
        $this->db->where('w.team_group_id IS NOT NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('w.team_group_id IS NULL', NULL, FALSE);
      }
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('w.status', $ds['status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db->where('w.date_upd >=', from_date($ds['from_date']))->where('w.date_upd <=', to_date($ds['to_date']));
    }

    $this->db->order_by('w.date_upd', 'DESC')->limit($perpage, $offset);

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
    ->from('work_list AS w')
    ->join('team_group AS u', 'w.team_group_id = u.id', 'left')
    ->where('w.team_id IS NOT NULL');

    if(! empty($ds['pea_no']))
    {
      $this->db->like('w.pea_no', $ds['pea_no']);
    }

    if(! empty($ds['customer']))
    {
      $this->db
      ->group_start()
      ->like('w.cust_no', $ds['customer'])
      ->or_like('w.cust_name', $ds['customer'])
      ->or_like('w.cust_tel', $ds['customer'])
      ->group_end();
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


    if( isset($ds['assigned']) && $ds['assigned'] != 'all')
    {
      if($ds['assigned'] == 1)
      {
        $this->db->where('w.team_group_id IS NOT NULL', NULL, FALSE);
      }
      else
      {
        $this->db->where('w.team_group_id IS NULL', NULL, FALSE);
      }
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('w.status', $ds['status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db->where('w.date_upd >=', from_date($ds['from_date']))->where('w.date_upd <=', to_date($ds['to_date']));
    }

    return $this->db->count_all_results();
  }


  public function assign_work_list($rows_id = array(), $team_group_id)
  {
    if( ! empty($rows_id))
    {
      $this->db
      ->set('team_group_id', $team_group_id)
      ->where_in('id', $rows_id)
      ->where_in('status', array('P', 'R', 'U'));

      return $this->db->update($this->tb);
    }

    return FALSE;
  }


  public function unassign_work_list($rows_id = array())
  {
    /*
    *  P = Pending (รอติดตั้ง)
    *  I = Installed (ติดตั้งแล้ว รอหลังบ้านอนุมัติ)
    *  A = Approved (หลังบ้านอนุมัติแล้ว แต่ยังไม่ส่งไป PEA)
    *  R = Rejected (หลังบ้านไม่อนุมัติ ต้องกลับไปแก้ไขที่จุดติดตั้ง)
    *  W = Waitin (ส่งข้อมูลไป PEA แล้ว รอผลว่าผ่านหรือไม่)
    *  S = Success (PEA อนุมัติแล้วการสลับมิเตอร์เสร็จสมบูรณ์)
    *  U = Rejectd (PEA ตรวจแล้วไม่ผ่าน ต้องกลับไปแก้ไขใหม่)
    */

    if( ! empty($rows_id))
    {
      $this->db
      ->set('team_group_id', NULL)
      ->where_in('id', $rows_id)
      ->where_in('status', array('P', 'R', 'U'))
      ->where('team_group_id IS NOT NULL', NULL, FALSE);

      return $this->db->update($this->tb);
    }

    return FALSE;
  }


  public function get_open_work_list_by_team_group($team_group_id)
  {
    $rs = $this->db
    ->where('team_group_id', $team_group_id)
    ->where_in('status', array('P', 'R', 'U'))
    ->get($this->tb);

    if( ! empty($rs))
    {
      return $rs->result();
    }

    return NULL;
  }

  public function get_work_list_by_pea_no($pea_no)
  {
    $rs = $this->db
    ->where('pea_no', $pea_no)    
    ->get($this->tb);

    if($rs->num_rows() == 1)
    {
      return $rs->row();
    }

    return NULL;
  }


} //--- end class

 ?>
