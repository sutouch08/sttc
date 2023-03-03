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


  public function get($id)
  {
    $rs = $this->db
    ->select('tr.*, fwh.name AS from_warehouse_name, twh.name AS to_warehouse_name')
    ->select('u.uname, t.name AS team_name')
    ->from('transfer AS tr')
    ->join('warehouse AS fwh', 'tr.fromWhsCode = fwh.code', 'left')
    ->join('warehouse AS twh', 'tr.toWhsCode = twh.code', 'left')
    ->join('user AS u', 'tr.create_by = u.id', 'left')
    ->join('team AS t', 'tr.team_id = t.id', 'left')
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
    $this->db->trans_begin();

    $arr = array(
      'status' => 2,
      'update_at' => now(),
      'update_by' => $this->_user->id
    );

    $ch = $this->db->where('id', $id)->update($this->tb, $arr);
    $cd = $this->db->set('LineStatus', 'D')->where('transfer_id', $id)->update($this->td);

    if($ch && $cd)
    {
      $this->db->trans_commit();

      return TRUE;
    }
    else
    {
      $this->db->trans_rollback();
    }

    return FALSE;
  }



  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    $order_by = isset($ds['order_by']) ? $ds['order_by'] : 'code';
    $sort_by = isset($ds['sort_by']) ? $ds['sort_by'] : 'DESC';

    $this->db
    ->select('tr.*, wf.name AS fromWhsName, wt.name AS toWhsName, u.uname, t.name AS team_name')
    ->from('transfer AS tr')
    ->join('warehouse AS wf', 'tr.fromWhsCode = wf.code', 'left')
    ->join('warehouse AS wt', 'tr.toWhsCode = wt.code', 'left')
    ->join('user AS u', 'tr.create_by = u.id', 'left')
    ->join('team AS t', 'tr.team_id = t.id', 'left');

    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('tr.code', $ds['code']);
    }

    if( isset($ds['docNum']) && $ds['docNum'] != "" && $ds['docNum'] != NULL)
    {
      $this->db->like('tr.docNum', $ds['docNum']);
    }

    if( isset($ds['fromWhCode']) && $ds['fromWhCode'] != "" && $ds['fromWhCode'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('tr.fromWhsCode', $ds['fromWhCode'])
      ->or_like('wf.name', $ds['fromWhCode'])
      ->group_end();
    }

    if( isset($ds['toWhCode']) && $ds['toWhCode'] != "" && $ds['toWhCode'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('tr.toWhsCode', $ds['toWhCode'])
      ->or_like('wt.name', $ds['toWhCode'])
      ->group_end();
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('tr.date_add >=', from_date($ds['from_date']))
      ->where('tr.date_add <=', to_date($ds['to_date']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('tr.status', $ds['status']);
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('tr.team_id', $ds['team_id']);
    }

    if($this->_Outsource)
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

    $this->db->order_by($order_by, $sort_by)->limit($limit, $offset);
    $rs = $this->db->get();
    // echo $this->db->get_compiled_select();

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
    ->join('team AS t', 'tr.team_id = t.id', 'left');

    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('tr.code', $ds['code']);
    }

    if( isset($ds['docNum']) && $ds['docNum'] != "" && $ds['docNum'] != NULL)
    {
      $this->db->like('tr.docNum', $ds['docNum']);
    }

    if( isset($ds['fromWhCode']) && $ds['fromWhCode'] != "" && $ds['fromWhCode'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('tr.fromWhsCode', $ds['fromWhCode'])
      ->or_like('wf.name', $ds['fromWhCode'])
      ->group_end();
    }

    if( isset($ds['toWhCode']) && $ds['toWhCode'] != "" && $ds['toWhCode'] != NULL)
    {
      $this->db
      ->group_start()
      ->like('tr.toWhsCode', $ds['toWhCode'])
      ->or_like('wt.name', $ds['toWhCode'])
      ->group_end();
    }

    if( ! empty($ds['from_date']) && ! empty($ds['to_date']))
    {
      $this->db
      ->where('tr.date_add >=', from_date($ds['from_date']))
      ->where('tr.date_add <=', to_date($ds['to_date']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('tr.status', $ds['status']);
    }

    if(isset($ds['team_id']) && $ds['team_id'] != 'all')
    {
      $this->db->where('tr.team_id', $ds['team_id']);
    }

    if( ! $this->_Admin && ! $this->_SuperAdmin && !$this->_Lead)
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



  public function count_doc_rows(array $ds = array())
  {
    $this->db
    ->from('transfer AS tr')
    ->join('user AS u', 'tr.create_by = u.id', 'left');

    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('tr.code', $ds['code']);
    }

    if( ! empty($ds['fromDate']) && ! empty($ds['toDate']))
    {
      $this->db
      ->where('tr.date_add >=', from_date($ds['fromDate']))
      ->where('tr.date_add <=', to_date($ds['toDate']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('tr.status', $ds['status']);
    }

    $this->db->where('tr.create_by', $this->_user->id);

    return $this->db->count_all_results();
  }


  public function get_doc_list(array $ds = array())
  {
    $perpage = empty($ds['perpage']) ? 20 : $ds['perpage'];
    $offset = empty($ds['offset']) ? 0 : $ds['offset'];

    $this->db
    ->from('transfer AS tr')
    ->join('user AS u', 'tr.create_by = u.id', 'left');

    if( isset($ds['code']) && $ds['code'] != "" && $ds['code'] != NULL)
    {
      $this->db->like('tr.code', $ds['code']);
    }

    if( ! empty($ds['fromDate']) && ! empty($ds['toDate']))
    {
      $this->db
      ->where('tr.date_add >=', from_date($ds['fromDate']))
      ->where('tr.date_add <=', to_date($ds['toDate']));
    }

    if( isset($ds['status']) && $ds['status'] != 'all')
    {
      $this->db->where('tr.status', $ds['status']);
    }

    $this->db->where('tr.create_by', $this->_user->id);

    $rs = $this->db->limit($perpage, $offset)->get();

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


  public function getInstallItemDataBySerial($serial, $whsCode)
  {
    $rs = $this->ms
    ->select('I.ItemCode, I.ItemName')
    ->select('S.DistNumber AS Serial')
    ->select('Q.WhsCode, Q.Quantity, Q.CommitQty')
    ->from('OSRQ AS Q')
    ->join('OSRN AS S', 'Q.SysNumber = S.SysNumber AND Q.ItemCode = S.ItemCode', 'left')
    ->join('OITM AS I', 'S.ItemCode = I.ItemCode', 'left')
    ->where('S.DistNumber', $serial)
    ->where('Q.WhsCode', $whsCode)
    ->where('Q.Quantity >', 0, FALSE)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function getReturnItemDataBySerial($serial)
  {
    $rs = $this->ms
    ->select('I.ItemCode, I.ItemName')
    ->select('S.DistNumber AS Serial')
    ->from('OSRN AS S')
    ->join('OITM AS I', 'S.ItemCode = I.ItemCode', 'left')
    ->where('S.DistNumber', $serial)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function getItemBySerial($serial)
  {
    $rs = $this->ms
    ->select('I.ItemCode, I.ItemName')
    ->select('S.DistNumber AS Serial')
    ->from('OSRN AS S')
    ->join('OITM AS I', 'S.ItemCode = I.ItemCode', 'left')
    ->where('S.DistNumber', $serial)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function getSapDoc($docNum, $filler)
  {
    $rs = $this->ms
    ->select('DocEntry, DocNum')
    ->where('DocNum', $docNum)
    ->where_in('Filler', $filler)
    ->get('OWTR');

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function getSapTransferSerialDetails($docNum)
  {
    $rs = $this->db->get('demo_item');
    // $rs = $this->ms
    // ->select('S.DistNumber AS Serial, D.ItemCode, D.ItemName, D.WhsCode')
    // ->from('SRI1 AS D')
    // ->join('OSRN AS S', 'D.SysSerial = S.SysNumber AND D.ItemCode = S.ItemCode', 'left')
    // ->where('D.BaseNum', $docNum)
    // ->where('D.Direction', 0)
    // ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

} //--- end class

 ?>
