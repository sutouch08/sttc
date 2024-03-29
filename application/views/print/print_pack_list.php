<?php
$this->load->helper('print');
$footer_address = FALSE; //--- แสดงที่อยู่ท้ายแผ่นหรือไม่
$row_per_page = 40; //--- จำนวนบรรทัด/หน้า
$total_row = count($details);

$total_row 	= $total_row == 0 ? 1 : $total_row;


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
	"text_color" => "text-orange", //--- hilight text color class
	"css_files" => array("assets/css/font-sarabun.css")
);

$this->printer->config($config);

$page  = '';
$page .= $this->printer->doc_header();
$page .= '<style>
						body { font-family: Sarabun, sans-serif;}
						.sender-name, .receiver-name { border:0; border-bottom:dotted 1px;}
					</style>';
$page .= '<div class="hidden-print" style="width:190mm; border:none; top:10px; margin-left:auto; margin-right:auto; margin-bottom:10px;">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <label>ชื่อผู้ส่ง</label>
      <input type="text" class="form-control input-large sender" autofocus/>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <label>ชื่อผู้รับ</label>
      <input type="text" class="form-control input-large receiver" autofocus/>
    </div>
  </div>
</div>';
//**************  กำหนดหัวตาราง  ******************************//
$thead	= array(
          array("ลำดับ", "width:10mm; text-align:center; padding:0px;"),
          array("วัน/เดือน/ปี สับเปลี่ยน", "width:30mm; text-align:center; padding:0px;"),
					array("PEA NO", "width:25mm; text-align:center;padding:0px;"),
          array("เฟส", "width:20mm; text-align:center; padding:0px;"),
					array("ขนาด", "width:20mm; text-align:center;padding:0px;"),
					array("หน่วย(kWh)", "width:20mm; text-align:center; padding:0px;"),
          array("อายุ", "width:20mm; text-align:center; padding:0px;"),
					array("ลักษณะชำรุด", "width:40mm; text-align:center; padding:0px;")
          );

$this->printer->add_subheader($thead);


//***************************** กำหนด css ของ td *****************************//
$pattern = array(
            "text-align:center; padding:1px; min-height:5mm; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; border-bottom:solid 1px #333;",
						"text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; border-bottom:solid 1px #333;",
            "text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; border-bottom:solid 1px #333;",
						"text-align:center; padding:1px; min-height:5mm; white-space:pre-wrap; border-bottom:solid 1px #333;",
						"text-align:left; padding:1px; min-height:5mm; overflow-x:hidden; border-bottom:solid 1px #333;"
            );

$this->printer->set_pattern($pattern);

// $footer = "<div style='width:190mm; height:10mm; margin:auto; border:none;'>";
// $footer .=   "<p class='text-right' style='font-size:11px; padding-left:15px; padding-top:10px;'>พิมพ์วันที่ &nbsp;&nbsp; ".date('d/m/Y').' &nbsp; '.date('H:i:s')." &nbsp; โดย ".display_name($this->_user->id)."</p>";
// $footer .= "</div>";

$footer = "<div style='width:190mm; height:30mm; margin:auto; border:none; position:absolute; bottom:100px;'>";

$footer .="<div style='width:100%; height30mm;'>";
$footer .= '<table class="table" style="width:100%; margin-top:60px;">
							<tr>
								<td class="text-left" style="width:10mm; border:none; padding-left:0px; font-size:14px;">ลงชื่อ</td>
								<td class="" style="width:50mm; height:10mm; padding:1px; border:none; font-size:16px;"><input type="text" class="width-100" style="border:none; border-bottom:dotted 1px;" readonly/></td>
								<td class="text-right font-size-16" style="width:50mm; border:none;"></td>
								<td class="text-left" style="width:10mm; border:none; padding-left:0px; font-size:14px;">ลงชื่อ</td>
								<td class="" style="width:50mm; height:10mm; padding:1px; border:none; font-size:16px;"><input type="text" class="width-100" style="border:none; border-bottom:dotted 1px;" readonly/></td>

							</tr>
							<tr>
								<td colspan="2" class="middle text-center" style="height:10mm; padding:1px; border:none; font-size:14px;">(&nbsp;<input type="text" class="sender-name text-center" style="width:60mm;" readonly/>&nbsp;)</td>
								<td class="text-right font-size-16" style="width:50mm; border:none;"></td>
								<td colspan="2" class="middle text-center" style="height:10mm; padding:1px; border:none; font-size:14px;">(&nbsp;<input type="text" class="receiver-name text-center" style="width:60mm;" readonly/>&nbsp;)</td>

							</tr>
							<tr>
								<td colspan="2" class="text-center" style="height:10mm; padding:1px; border:none; font-size:14px;">เจ้าหน้าที่คู่สัญญา</td>
								<td class="text-right font-size-16" style="width:50mm; border:none;"></td>
								<td colspan="2" class="text-center" style="height:10mm; padding:1px; border:none; font-size:14px;">เจ้าหน้าที่การไฟฟ้าส่วนภูมิภาค</td>
							</tr>
						</table>';
$footer .= "</div>";
$footer .= "<p class='pull-right' style='font-size:14px;'>อ้างอิง : {$doc->code}</p>";
$footer .= "</div>";

$this->printer->footer = $footer;

$total_page  = $this->printer->total_page == 0 ? 1 : $this->printer->total_page;

$n = 1;
$index = 0;
while($total_page > 0 )
{
	$top = "";
	$top .= "<div style='width:190mm; margin:auto;'>";
	$top .= "<div class='text-left' style='padding-top:10px; padding-bottom:10px;'>";
	$top .= "<table class='width-100'>
						<tr>
							<td style='font-size:12px; text-align:right;'>Page {$this->printer->current_page}/{$this->printer->total_page}</td>
						</tr>
						<tr>
							<td style='font-size:12px;'>รายละเอียดมิเตอร์จานหมุนรื้อถอน ตามสัญญาเลขที่..{$contract_no}.. งวดที่ .....{$doc->period_no}..... ลังที่ ....{$doc->box_no}..... สี ...{$color}.....</td>
						</tr>
						<tr>
							<td style='font-size:12px;'>รายการที่ ..{$list_no}... จัดซื้อมิเตอร์อิเล็กทรอนิกส์พร้อมติดตั้งสับเปลี่ยนทดแทนจานหมุนในพื้นที่ {$sub_area_name} การไฟฟ้า {$team_full_name}</td>
						</tr>
						</table>";
	$top .= "";
	$top .= "</div>";

  $page .= $this->printer->page_start();
  $page .= $top;

  $page .= $this->printer->content_start();
  $page .= $this->printer->table_start();
  $i = 0;

	$row = $this->printer->row;

  while($i < $row)
  {
    $rs = isset($details[$index]) ? $details[$index] : FALSE;

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
			$data = array("&nbsp","", "", "", "", "", "", "");
    }

		$page .= $this->printer->print_row($data);
		$n++;
		$i++;
		$index++;
  }


  $subTotal = array();
	$page .= $this->printer->table_end();
  $page .= $this->printer->content_end();
  $page .= $this->printer->footer;

	$page .= $this->printer->page_end(FALSE);

  $total_page --;
  $this->printer->current_page++;

}

$page .= $this->printer->doc_footer();

echo $page;
 ?>
<script>
	$('.sender').keyup(function() {
		let value = $(this).val();
		$('.sender-name').val(value);
	});

	$('.receiver').keyup(function() {
		let value = $(this).val();
		$('.receiver-name').val(value);
	})
</script>
 <style type="text/css" media="print">
 	@page{
 		margin:0;
 		size:A4 portrait;
 	}
  </style>
