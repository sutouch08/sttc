<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_report extends PS_Controller
{
  public $menu_code = 'OPDELIVERY';
	public $menu_group_code = 'OP';
	public $title = 'รายงานการส่งมอบมิเตอร์';
	public $segment = 4;
  public $error;
  public $ms;

  public function __construct()
  {
    parent::__construct();

    $this->home = base_url().'inventory/delivery_report';
    $this->load->model('inventory/delivery_report_model');
    $this->load->model('admin/team_model');
    $this->load->model('admin/sub_area_model');
    $this->load->helper('warehouse');
    $this->load->helper('area');
    $this->load->helper('dispose_reason');
  }


  public function index()
  {    
    $this->load->view('report/delivery/delivery_report');
  }


  public function get_sub_area_team()
  {
    $sc = TRUE;
    $ds = array();
    $team_id = $this->input->get('team_id');

    if( ! empty($team_id))
    {
      $areas = $this->sub_area_model->get_all_active_by_team($team_id);

      if( ! empty($areas))
      {
        foreach($areas as $rs)
        {
          $ds[] = array('id' => $rs->id, 'name' => $rs->name, 'team_id' => $rs->team_id);
        }
      }
    }
    else
    {
      $sc = FALSE;
      set_error('required');
    }

    echo $sc === TRUE ? json_encode($ds) : $this->error;
  }


  public function get_report()
  {

    $filter = array(
      'from_code' => $this->input->post('fromCode'),
      'to_code' => $this->input->post('toCode'),
      'team_id' => $this->input->post('teamId'),
      'sub_area_id' => $this->input->post('subArea')
    );

    $sub_area = $this->sub_area_model->get_area_data($filter['sub_area_id']);

    $team_full_name = empty($sub_area) ? "" : $sub_area->full_name;
    $sub_area_name = empty($sub_area) ? "" : $sub_area->name;
    $contract_no = empty($sub_area) ? "" : $sub_area->contract_no;
    $list_no = empty($sub_area) ? "" : $sub_area->list_no;
    $round_no = $this->input->post('roundNo');

    $pages = array();

    $list = $this->delivery_report_model->get_pack_list($filter);

    if( ! empty($list))
    {


      foreach($list as $row)
      {
        $limit = 120;
        $no = 1;

        $details = $this->delivery_report_model->get_pack_details_by_pack_id($row->id);

        if( ! empty($details))
        {
          $page = array(
            'team_full_name' => $team_full_name,
            'sub_area_name' => $sub_area_name,
            'contract_no' => $contract_no,
            'list_no' => $list_no,
            'round_no' => $round_no,
            'data' => array()
          );

          $num = 1;
          $perpage = 40;
          $count = count($details);

          foreach($details as $rs)
          {
            $arr = array(
              'no' => $no,
              'pack_code' => $row->code,
              'work_date' => thai_date($rs->work_date),
              'pea_no' => $rs->u_pea_no,
              'phase' => $rs->phase,
              'meter_size' => $rs->meter_size,
              'meter_read_end' => $rs->meter_read_end,
              'meter_age' => $rs->meter_age,
              'dispose_reason_name' => (empty($rs->dispose_reason_name) && $rs->dispose_reason_id == 0) ? "สภาพปกติ" : $rs->dispose_reason_name
            );

            array_push($page['data'], $arr);

            if($num == $perpage)
            {
              array_push($pages, $page);
              $page['data'] = array();
              $num = 1;
            }
            else
            {
              $num++;
            }

            if($no == $limit)
            {
              $no = 1;
            }
            else
            {
              if($no < $limit && $no >= $count)
              {
                $rest = $limit - $no;
                while($rest > $perpage)
                {
                  $rest = $rest - $perpage;
                }

                while($rest > 0)
                {
                  $arr = array(
                    'no' => NULL,
                    'pack_code' => NULL,
                    'work_date' => NULL,
                    'pea_no' => NULL,
                    'phase' => NULL,
                    'meter_size' => NULL,
                    'meter_read_end' => NULL,
                    'meter_age' => NULL,
                    'dispose_reason_name' => NULL
                  );

                  array_push($page['data'], $arr);
                  $rest--;
                }

                array_push($pages, $page);
                $num = 1;
                $no = 1;
              }

              $no++;
            }
          }
        }
      }
    }

    echo json_encode($pages);
  }


  public function do_export()
  {
    $token = $this->input->post('token');
    $filter = array(
      'from_code' => $this->input->post('exFromCode'),
      'to_code' => $this->input->post('exToCode'),
      'team_id' => $this->input->post('exTeamId'),
      'sub_area_id' => $this->input->post('exSubArea')
    );

    $sub_area = $this->sub_area_model->get_area_data($filter['sub_area_id']);

    $team_full_name = empty($sub_area) ? "" : $sub_area->full_name;
    $sub_area_name = empty($sub_area) ? "" : $sub_area->name;
    $contract_no = empty($sub_area) ? "" : $sub_area->contract_no;
    $list_no = empty($sub_area) ? "" : $sub_area->list_no;
    $round_no = $this->input->post('exRoundNo');

    $sheetName = empty($sub_area) ? "Sheet1" : $sub_area->name;
    $title_1 = "รายละเอียดมิเตอร์จานหมุนรื้อถอน ตามสัญญาเลขที่ {$contract_no}....... งวดที่ ....{$round_no}......";
    $title_2 = "รายการที่ ..{$list_no}... จัดซื้อมิเตอร์อิเล็กทรอนิกส์พร้อมติดตั้งสับเปลี่ยนทดแทนจานหมุนในพื้นที่ {$sub_area_name} การไฟฟ้า {$team_full_name}";

    //--- load excel library
    $this->load->library('excel');

    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle($sheetName);
    //--- set default font style and font size
    $this->excel->getDefaultStyle()->getFont()->setName('TH SarabunPSK');
    $this->excel->getDefaultStyle()->getFont()->setSize(16);

    //--- set report title header
    $this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(24);
    $this->excel->getActiveSheet()->setCellValue('A1', $title_1);
    $this->excel->getActiveSheet()->mergeCells('A1:I1');
    $this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(24);
    $this->excel->getActiveSheet()->setCellValue('A2', $title_2);
    $this->excel->getActiveSheet()->mergeCells('A2:I2');
    $this->excel->getActiveSheet()->getStyle('A1:I2')->getFont()->setBold(TRUE);

    //--- table header
    $this->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(24);
    $this->excel->getActiveSheet()->setCellValue('A3', 'ลำดับ');
    $this->excel->getActiveSheet()->setCellValue('B3', 'ลังที่');
    $this->excel->getActiveSheet()->setCellValue('C3', 'วันที่รื้อถอน');
    $this->excel->getActiveSheet()->setCellValue('D3', 'PEA No.');
    $this->excel->getActiveSheet()->setCellValue('E3', 'เฟส');
    $this->excel->getActiveSheet()->setCellValue('F3', 'ขนาด');
    $this->excel->getActiveSheet()->setCellValue('G3', 'หน่วย (kWh)');
    $this->excel->getActiveSheet()->setCellValue('H3', 'อายุ (ปี)');
    $this->excel->getActiveSheet()->setCellValue('I3', 'ลักษณะชำรุด (ถ้ามี)');
    $this->excel->getActiveSheet()->getStyle('A3:I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //--- set Column width
    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(7.1);
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(11.5); //--10.8
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(13); //-- 12.14
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(7.1); //-- 6.7
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(9); //-- 8.43
    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10.95); //-- 10.29
    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.1); //--- 7.57
    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(24.2); //-- 26.3

    $this->excel->getActiveSheet()->getStyle('A3:I3')->getFont()->setBold(TRUE);
    $this->excel->getActiveSheet()->getStyle('A3:I3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    //--- set print header to repeate every page
    $this->excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);

    $rows = 4; //--- data start at row 4

    $details = $this->delivery_report_model->get_pack_details($filter);
    $total = empty($details) ? 0 : count($details);
    $limit = 120;
    $perpage = 40;
    $row = 1;
    $no = 1;
    $packCode = NULL;

    if( ! empty($details))
    {
      foreach($details as $rs)
      {
        if($packCode != $rs->code)
        {
          if($no > 1)
          {
            $rox = $rows -1;
            $this->excel->getActiveSheet()->setBreak("A{$rox}", PHPExcel_Worksheet::BREAK_ROW);
          }

          $packCode = $rs->code;
          $no = 1;
          $row = 1;
        }

        $this->excel->getActiveSheet()->getRowDimension("{$rows}")->setRowHeight(21);
        $this->excel->getActiveSheet()->setCellValue("A{$rows}", $no);
        $this->excel->getActiveSheet()->setCellValue("B{$rows}", $rs->code);
        $this->excel->getActiveSheet()->setCellValue("C{$rows}", thai_date($rs->work_date));
        $this->excel->getActiveSheet()->setCellValue("D{$rows}", $rs->u_pea_no);
        $this->excel->getActiveSheet()->setCellValue("E{$rows}", $rs->phase);
        $this->excel->getActiveSheet()->setCellValue("F{$rows}", $rs->meter_size);
        $this->excel->getActiveSheet()->setCellValue("G{$rows}", $rs->meter_read_end);
        $this->excel->getActiveSheet()->setCellValue("H{$rows}", $rs->meter_age);
        $this->excel->getActiveSheet()->setCellValue("I{$rows}", (empty($rs->dispose_reason_name) && $rs->dispose_reason_id == 0) ? "สภาพปกติ" : $rs->dispose_reason_name);

        if($row == $perpage)
        {
          if($total > 0)
          {
            $this->excel->getActiveSheet()->setBreak("A{$rows}", PHPExcel_Worksheet::BREAK_ROW);
          }

          $row = 1;
        }
        else
        {
          $row++;
        }

        $rows++;
        $total--;

        if($no == $limit)
        {
          $no = 1;
        }
        else
        {
          $no++;
        }
      } //-- end foreach

      if($rows > 4)
      {
        $bf_row = $rows - 1;
        $this->excel->getActiveSheet()->getStyle("A4:I{$bf_row}")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $this->excel->getActiveSheet()->getStyle("A3:A{$bf_row}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      }
    }
    else
    {
      $this->excel->getActiveSheet()->setCellValue("A{$rows}", "ไม่พบข้อมูล");
      $this->excel->getActiveSheet()->mergeCells("A{$rows}:I{$rows}");
      $this->excel->getActiveSheet()->getStyle("A{$rows}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    } //-- end if

    //--- Print setup
    $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
    $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    $this->excel->getActiveSheet()->getPageSetup()->setScale(85);
    $this->excel->getActiveSheet()->getPageSetup()->setHorizontalCentered(TRUE);
    //$this->excel->getActiveSheet()->getPageSetup()->setVerticalCentered(TRUE);
    //$this->excel->getActiveSheet()->getPageSetup()->setFitToPage(TRUE);
    $this->excel->getActiveSheet()->getPageMargins()->setTop(0.5);
    $this->excel->getActiveSheet()->getPageMargins()->setHeader(0.5);
    $this->excel->getActiveSheet()->getPageMargins()->setLeft(0.5);
    $this->excel->getActiveSheet()->getPageMargins()->setRight(0.5);
    $this->excel->getActiveSheet()->getPageMargins()->setBottom(0.5);
    $this->excel->getActiveSheet()->getPageMargins()->setFooter(0.5);

    setToken($token);
    $file_name = "รายงานส่งมอบมิเตอร์.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); /// form excel 2007 XLSX
    header('Content-Disposition: attachment;filename="'.$file_name.'"');
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    $writer->save('php://output');

  }


} //--- end class

 ?>
