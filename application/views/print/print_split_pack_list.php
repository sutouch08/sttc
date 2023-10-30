<?php
$this->load->helper('print');
$footer_address = FALSE; //--- แสดงที่อยู่ท้ายแผ่นหรือไม่
$row_per_page = 38;
$split_row = empty($split) ? 4 : $split; //--- จำนวนบรรทัด/หน้า
$split_form = $split_row + 2;
$total_row = count($details);
$total_row 	= $total_row == 0 ? 1 : $total_row;
$all_box = ceil($total_row/$split_row);
$total_row += $all_box * 2;
$form_per_page = ceil($row_per_page/$split_form);


$config = array(
	"logo_position" => "middle",
	"title_position" => "center",
	"page_width" => 210,
	"content_width" => 190,
	"table_height" => 0,
	"row" => $row_per_page,
	"footer" => FALSE,
	"total_row" => $total_row,
	"font_size" => 11,
	"total_page" => ceil($total_row/$row_per_page),
	"text_color" => "text-orange" //--- hilight text color class
);

$this->printer->config($config);

$page  = '';
$page .= $this->printer->doc_header();

//**************  กำหนดหัวตาราง  ******************************//
$thead	= array(
          array("ลำดับ", "width:10mm; text-align:center; padding:0px; font-family:calibri;"),
          array("วัน/เดือน/ปี สับเปลี่ยน", "width:30mm; text-align:center; padding:0px; font-family:calibri;"),
					array("PEA NO", "width:25mm; text-align:center;padding:0px; font-family:calibri;"),
          array("เฟส", "width:20mm; text-align:center; padding:0px; font-family:calibri;"),
					array("ขนาด", "width:20mm; text-align:center;padding:0px; font-family:calibri;"),
					array("หน่วย(kWh)", "width:20mm; text-align:center; padding:0px; font-family:calibri;"),
          array("อายุ", "width:20mm; text-align:center; padding:0px; font-family:calibri;"),
					array("ลักษณะชำรุด", "width:40mm; text-align:center; padding:0px; font-family:calibri;")
          );

$this->printer->add_subheader($thead);


//***************************** กำหนด css ของ td *****************************//
$pattern = array(
            "text-align:center; padding:1px; min-height:5mm; font-family:calibri; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; font-family:calibri; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; font-family:calibri; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; font-family:calibri; border-bottom:solid 1px #333;",
						"text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; font-family:calibri; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; font-family:calibri; border-bottom:solid 1px #333;",
						"text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; font-family:calibri; border-bottom:solid 1px #333;",
						"text-align:left; padding:1px; min-height:5mm; overflow-x:hidden; font-family:calibri; border-bottom:solid 1px #333;"
            );

$this->printer->set_pattern($pattern);

$footer = "<div style='width:190mm; height:10mm; margin:auto; border:none;'>";

$footer .= "<div style='width:100%; height:20mm; font-size:10px;'>";
$footer .=   "<p class='text-right' style='padding-left:15px;'>พิมพ์วันที่ &nbsp;&nbsp; ".date('d/m/Y').' &nbsp; &nbsp;'.date('H:i:s')."</p>";
$footer .= "</div>";
$footer .= "</div>";


$this->printer->footer = $footer;

$total_page  = $this->printer->total_page == 0 ? 1 : $this->printer->total_page;

$n = 1;
$index = 0;
$current_box = 1;

while($total_page > 0 )
{
  $page .= $this->printer->page_start();
  // $page .= $top;

  $page .= $this->printer->content_start();

  $i = 0;
	$perpage = $form_per_page;

	$row = $this->printer->row;

  while($i < $row && $perpage > 0 && (! empty($details[$index]) OR $n <= $split_row) && $current_box <= $all_box)
  {
    $rs = isset($details[$index]) ? $details[$index] : FALSE;

		if($n == 1)
		{
			$page .= $this->printer->table_start();
		}

    if( ! empty($rs) )
    {
			$dispose_name = $rs->dispose_reason_name;

			if(empty($dispose_name) && $doc->color == 'Red')
			{
				$dispose_name = 'หมดวาระ';
			}

			$data = array(
				$n,
				thai_date($rs->work_date, FALSE, '/'),
				$rs->u_pea_no,
				$rs->phase,
				$rs->meter_size,
				$rs->meter_read_end,
				$rs->meter_age,
				$dispose_name
			);
    }
    else
    {
			$data = array("&nbsp;","", "", "", "", "", "", "");
    }

		$page .= $this->printer->print_row($data);
		$n++;
		$i++;
		$index++;

		if($n > $split_row )
		{
			$page .= '<tr><td colspan="7" class="text-center"></td><td class="font-size-14 text-center">'.$current_box.'/'.$all_box.'</td></td>';
			$page .= $this->printer->table_end();
			$page .= '<div style="width:100%; height:5mm;">&nbsp;</div>';
			$n = 1;
			$i++;
			$current_box++;
			$perpage--;
		}
  }

  $page .= $this->printer->content_end();
  //$page .= $this->printer->footer;

	$page .= $this->printer->page_end(FALSE);

  $total_page --;
  $this->printer->current_page++;

}

$page .= $this->printer->doc_footer();

echo $page;
 ?>

 <style type="text/css" media="print">
 	@page{
 		margin:0;
 		size:A4 portrait;
 	}
  </style>
