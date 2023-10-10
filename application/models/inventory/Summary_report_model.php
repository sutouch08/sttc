<?php
class Summary_report_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_sum_finish($team_id)
  {
    $count = $this->db
    ->from('pack_detail AS pd')
    ->join('pack AS pa', 'pd.pack_id = pa.id', 'left')
    ->where('pa.team_id', $team_id)
    ->where('pa.status', 'F')
    ->where('pd.status', 'F')
    ->count_all_results();

    return $count;
  }

  public function get_sum_closed($team_id)
  {
    $count = $this->db
    ->from('pack_detail AS pd')
    ->join('pack AS pa', 'pd.pack_id = pa.id', 'left')
    ->join('transfer AS tr', 'pd.transfer_code = tr.code', 'left')
    ->where('pa.team_id', $team_id)
    ->where('pa.status', 'C')
    ->where('pd.status', 'C')
    ->where('tr.DocEntry IS NULL', NULL, FALSE)
    ->count_all_results();

    return $count;
  }


  public function get_sum_transfered($team_id)
  {
    $count = $this->db
    ->from('pack_detail AS pd')
    ->join('pack AS pa', 'pd.pack_id = pa.id', 'left')
    ->join('transfer AS tr', 'pd.transfer_code = tr.code', 'left')
    ->where('pa.team_id', $team_id)
    ->where('pa.status', 'C')
    ->where('pd.status', 'C')
    ->where('tr.DocEntry IS NOT NULL', NULL, FALSE)
    ->where('tr.status', 'S')
    ->count_all_results();

    return $count;
  }


} //--- end class

 ?>
