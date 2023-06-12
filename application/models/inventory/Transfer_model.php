<?php
class Transfer_model extends CI_Model
{
  private $tb = "transfer";

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


  public function get($id)
  {
    $rs = $this->db
    ->select('tr.*')
    ->select('fwh.name AS from_warehouse_name, twh.name AS to_warehouse_name')
    ->select('u.uname, u.name AS display_name, t.name AS team_name, tg.name AS team_group_name')
    ->from('transfer AS tr')
    ->join('warehouse AS fwh', 'tr.fromWhsCode = fwh.code', 'left')
    ->join('warehouse AS twh', 'tr.toWhsCode = twh.code', 'left')
    ->join('user AS u', 'tr.create_by = u.id', 'left')
    ->join('team AS t', 'tr.team_id = t.id', 'left')
    ->join('team_group AS tg', 'tr.team_group_id = tg.id', 'left')
    ->where('tr.id', $id)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }



  public function cancle_document($id)
  {
    $arr = array(
      'status' => 'C',
      'update_at' => now(),
      'update_by' => $this->_user->id
    );

    return $this->db->where('id', $id)->update($this->tb, $arr);
  }



  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    $this->db
    ->select('tr.*')
    ->select('wf.name AS fromWhsName, wt.name AS toWhsName')
    ->select('u.uname, u.name AS display_name, t.name AS team_name, tg.name AS team_group_name')
    ->from('transfer AS tr')
    ->join('warehouse AS wf', 'tr.fromWhsCode = wf.code', 'left')
    ->join('warehouse AS wt', 'tr.toWhsCode = wt.code', 'left')
    ->join('user AS u', 'tr.create_by = u.id', 'left')
    ->join('team AS t', 'tr.team_id = t.id', 'left')
    ->join('team_group AS tg', 'tr.team_group_id = tg.id', 'left');

    if( ! empty($ds['code']))
    {
      $this->db->like('tr.code', $ds['code']);
    }

    if( ! empty($ds['u_pea_no']))
    {
      $this->db->like('tr.u_pea_no', $ds['u_pea_no']);
    }

    if( ! empty($ds['i_pea_no']))
    {
      $this->db->like('tr.i_pea_no', $ds['i_pea_no']);
    }

    if( ! empty($ds['serial']))
    {
      $this->db->like('tr.i_serial', $ds['serial']);
    }

    if( ! empty($ds['user']))
    {
      $this->db
      ->group_start()
      ->like('u.uname', $ds['user'])
      ->or_like('u.name', $ds['user'])
      ->group_end();
    }

    if($ds['team_group_id'] != 'all')
    {
      $this->db->where('tr.team_group_id', $ds['team_group_id']);
    }

    if($ds['team_id'] != 'all')
    {
      $this->db->where('tr.team_id', $ds['team_id']);
    }

    if($ds['status'] != 'all')
    {
      $this->db->where('tr.status', $ds['status']);
    }

    if($ds['sap_status'] != 'all')
    {
      $this->db->where('tr.sap_status', $ds['sap_status']);
    }

    if($ds['pea_status'] != 'all')
    {
      $this->db->where('tr.pea_status', $ds['pea_status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('tr.date_add >=', from_date($ds['from_date']))
      ->where('tr.date_add <=', to_date($ds['to_date']));
    }


    if( ! $this->_Admin && ! $this->_SuperAdmin && ! $this->_Lead)
    {
      $this->db->where('tr.create_by', $this->_user->id);
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

        $this->db->where_in('tr.team_id', $team_in);
      }
      else
      {
        $this->db->where('tr.team_id', 0);
      }
    }

    $this->db->order_by('tr.code', 'DESC')->limit($limit, $offset);
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
    ->from('transfer AS tr')
    ->join('warehouse AS wf', 'tr.fromWhsCode = wf.code', 'left')
    ->join('warehouse AS wt', 'tr.toWhsCode = wt.code', 'left')
    ->join('user AS u', 'tr.create_by = u.id', 'left')
    ->join('team AS t', 'tr.team_id = t.id', 'left')
    ->join('team_group AS tg', 'tr.team_group_id = tg.id', 'left');

    if( ! empty($ds['code']))
    {
      $this->db->like('tr.code', $ds['code']);
    }

    if( ! empty($ds['u_pea_no']))
    {
      $this->db->like('tr.u_pea_no', $ds['u_pea_no']);
    }

    if( ! empty($ds['i_pea_no']))
    {
      $this->db->like('tr.i_pea_no', $ds['i_pea_no']);
    }

    if( ! empty($ds['serial']))
    {
      $this->db->like('tr.i_serial', $ds['serial']);
    }

    if( ! empty($ds['user']))
    {
      $this->db
      ->group_start()
      ->like('u.uname', $ds['user'])
      ->or_like('u.name', $ds['user'])
      ->group_end();
    }

    if($ds['team_group_id'] != 'all')
    {
      $this->db->where('tr.team_group_id', $ds['team_group_id']);
    }

    if($ds['team_id'] != 'all')
    {
      $this->db->where('tr.team_id', $ds['team_id']);
    }

    if($ds['status'] != 'all')
    {
      $this->db->where('tr.status', $ds['status']);
    }

    if($ds['sap_status'] != 'all')
    {
      $this->db->where('tr.sap_status', $ds['sap_status']);
    }

    if($ds['pea_status'] != 'all')
    {
      $this->db->where('tr.pea_status', $ds['pea_status']);
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('tr.date_add >=', from_date($ds['from_date']))
      ->where('tr.date_add <=', to_date($ds['to_date']));
    }


    if( ! $this->_Admin && ! $this->_SuperAdmin && ! $this->_Lead)
    {
      $this->db->where('tr.create_by', $this->_user->id);
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

        $this->db->where_in('tr.team_id', $team_in);
      }
      else
      {
        $this->db->where('tr.team_id', 0);
      }
    }

    return $this->db->count_all_results();

  }



  public function count_history_rows($txt)
  {
    $this->db->where('create_by', $this->_user->id);

    if($txt != "")
    {
      $this->db
      ->group_start()
      ->like('u_pea_no', $txt)
      ->or_like('route', $txt)
      ->group_end();
    }

    return $this->db->count_all_results($this->tb);
  }


  public function get_history_list($txt, $perpage = 20, $offset = 0)
  {
    $this->db->where('create_by', $this->_user->id);

    if($txt != "")
    {
      $this->db
      ->group_start()
      ->like('u_pea_no', $txt)
      ->or_like('route', $txt)
      ->group_end();
    }

    $rs = $this->db->order_by('create_at', 'DESC')->limit($perpage, $offset)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
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


  public function getSapDoc($docNum)
  {
    $rs = $this->ms->query("SELECT DocEntry, DocNum, Filler, toWhsCode FROM OWTR WHERE DocNum = '{$docNum}'");

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function getSapTransferSerialDetails($docNum)
  {
    $qr  = "SELECT S.DistNumber AS Serial, S.MnfSerial AS PeaNo, D.ItemCode, ";
    $qr .= "D.ItemName, D.WhsCode, B.FisrtBin AS BinCode, O.DocEntry ";
    $qr .= "FROM SRI1 AS D ";
    $qr .= "LEFT JOIN OSRN AS S ON D.SysSerial = S.SysNumber AND D.ItemCode = S.ItemCode ";
    $qr .= "LEFT JOIN OWTR AS O ON D.BaseNum = O.DocNum ";
    $qr .= "LEFT JOIN WTR1 AS B ON O.DocEntry = B.DocEntry AND B.WhsCode = D.WhsCode AND D.Direction = 0 ";
    $qr .= "WHERE D.BaseNum = '{$docNum}' AND D.Direction = 0 ";

    $rs = $this->ms->query($qr);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function is_loaded($docNum)
  {
    $rs = $this->db->where('DocNum', $docNum)->count_all_results('user_item');

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }

  public function get_demo_items($docNum)
  {
    $rs = $this->db->get('demo_item');

    if($rs->num_rows() > 0)
    {
      foreach($rs->result() as $ds)
      {
        $ds->docNum = $docNum;
      }

      return $rs->result();
    }

    return NULL;
  }

} //--- end class

 ?>
