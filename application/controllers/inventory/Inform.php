<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inform extends PS_Controller
{
  public $menu_code = 'OPWHIF';
	public $menu_group_code = 'OP';
	public $title = 'เหตุสุดวิสัย';
	public $segment = 4;
  public $error;

  public function __construct()
  {
    parent::__construct();

    if($this->_Lead)
    {
      $this->pm = grant_permission();
    }

    $this->home = base_url().'inventory/inform';
    $this->load->model('inventory/inform_model');
    $this->load->helper('team');
    $this->load->helper('work_list');
  }

  public function index()
  {
    $filter = array(
			'pea_no' => get_filter('pea_no', 'i_pea_no', ''),
      'ca_no' => get_filter('ca_no', 'i_ca_no', ''),
      'cust_route' => get_filter('cust_route', 'i_cust_route', ''),
      'team_id' => get_filter('team_id', 'i_team_id', 'all'),
      'team_group' => get_filter('team_group', 'i_team_group', ''),
      'status' => get_filter('status', 'i_status', 'all'),
      'from_date' => get_filter('from_date', 'i_from_date', ''),
      'to_date' => get_filter('to_date', 'i_to_date', '')
		);

		//--- แสดงผลกี่รายการต่อหน้า
		$perpage = get_rows();

		$rows = $this->inform_model->count_rows($filter);

		$filter['data'] = $this->inform_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

		$this->pagination->initialize($init);

    $filter['count_rows'] = $rows;
    $filter['team'] = team_array();
    $filter['myteam'] = ($this->_Admin OR $this->_SuperAdmin) ? select_team($filter['team_id']) : select_my_team($this->_user->id, $filter['team_id']);

    $this->load->view('inventory/inform/inform_list', $filter);
  }


  public function get_detail($id)
  {
    $sc = TRUE;
    $rs = $this->inform_model->get($id);
    $ds = NULL;

    if( ! empty($rs))
    {
      $rs->f_image_path = base_url().$this->config->item('image_path')."inform/{$rs->pea_no}-f.jpg";
      $rs->s_image_path = base_url().$this->config->item('image_path')."inform/{$rs->pea_no}-s.jpg";
      $rs->status_name = ($rs->status == 'S' ? "ส่งข้อมูลแล้ว" : ($rs->status == 'F' ? 'ส่งข้อมูลไม่สำเร็จ' : 'ไม่ได้ส่งข้อมูล'));
      $rs->state = $rs->status == 'S' ? TRUE : FALSE;
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการ";
    }

    echo $sc === TRUE ? json_encode($rs) : $this->error;
  }


  public function send_to_scs()
  {
    $sc = TRUE;

    $id = $this->input->post('id');

    if($id)
    {
      $rs = $this->inform_model->get($id);

      if( ! empty($rs))
      {
        if($rs->status != 'S')
        {
          if(getConfig('PEA_API'))
          {
            $this->load->library('scs');
            $this->load->helper('image');

            $ds = array(
              'cust_no' => $rs->cust_no,
              'pea_no' => $rs->pea_no,
              'pea_no_full' => $rs->pea_no_full,
              'mat_code_full' => $rs->mat_code_full,
              'ca_no' => $rs->ca_no,
              'cust_name' => $rs->cust_name,
              'cust_address' => $rs->cust_address,
              'cust_tel' => $rs->cust_tel,
              'cust_route' => $rs->cust_route,
              'age_meter' => $rs->age_meter,
              'Plan_TableName' => $rs->Plan_TableName,
              'remark' => $rs->remark,
              'latitude' => $rs->latitude,
              'longitude' => $rs->longitude
            );

            $f_path = $this->config->item('image_path')."inform/{$rs->pea_no}-f.jpg";
            $s_path = $this->config->item('image_path')."inform/{$rs->pea_no}-s.jpg";

            $ds['f_path'] = $f_path;
            $ds['s_path'] = $s_path;
            $ds['image1'] = readImage($f_path);
            $ds['image2'] = readImage($s_path);


            $res = json_decode($this->scs->send_inform($ds));

            if( ! empty($res))
            {
              if($res->status == 0)
              {
                $sc = FALSE;
                $this->error = "ส่งข้อมูลไประบบ SCS ไม่สำเร็จ : {$res->friendly_msg_en}";

                $arr = array(
                  'status' => 'F',
                  'message' => $res->friendly_msg_en
                );
              }
              else
              {
                $arr = array(
                  'status' => 'S',
                  'message' => NULL
                );
              }

              $this->inform_model->update($id, $arr);
            }
            else
            {
              $sc = FALSE;
              $this->error = "ส่งข้อมูลไประบบ SCS ไม่สำเร็จ";

              $arr = array(
                'status' => 'F',
                'message' => "ไม่ได้รับการตอบกลับ"
              );

              $this->inform_model->update($id, $arr);
            }
          }
        }
        else
        {
          $sc = FALSE;
          set_error(0, "Invalid status");
        }
      }
      else
      {
        $sc = FALSE;
        set_error(0, "Invalid id");
      }
    }
    else
    {
      $sc = FALSE;
      set_error("required");
    }

    $this->_response($sc);
  }


  public function clear_filter()
  {
    $filter = array('i_pea_no', 'i_ca_no', 'i_cust_route', 'i_team_id', 'i_team_group', 'i_status', 'i_from_date', 'i_to_date');

    return clear_filter($filter);
  }

} //--- end class

?>
