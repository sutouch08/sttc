<?php
class Delivery_report_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_pack_list($ds = array())
  {
    $rs = $this->db
    ->where_in('status', array('F', 'C'))
    ->where('code >=', $ds['from_code'])
    ->where('code <=', $ds['to_code'])
    ->where('team_id', $ds['team_id'])
    ->where('sub_area_id', $ds['sub_area_id'])
    ->order_by('code', 'ASC')
    ->get('pack');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }
  }


  public function get_pack_details_by_pack_id($pack_id)
  {
    $rs = $this->db->where('pack_id', $pack_id)->get('pack_detail');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }

  public function get_pack_details($ds = array())
  {
    $rs = $this->db
    ->select('pd.*, p.code')
    ->from('pack_detail AS pd')
    ->join('pack AS p', 'pd.pack_id = p.id', 'left')
    ->where_in('p.status', array('F', 'C'))
    ->where('p.code >=', $ds['from_code'])
    ->where('p.code <=', $ds['to_code'])
    ->where('p.team_id', $ds['team_id'])
    ->where('p.sub_area_id', $ds['sub_area_id'])
    ->order_by('p.code', 'ASC')
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


} //--- end class

 ?>
