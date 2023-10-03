<?php $this->load->view('include/header'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
<style>
 		body {
      font-family:'Sarabun', sans-serif;
    }

		.page_layout{
      border: solid 1px #AAA; border-radius:0px;
      position:relative;
      width:210mm;
      padding-top:15mm;
      height:287mm;
      margin-left:auto;
      margin-right: auto;
      margin-bottom:10mm;
    }

		@media print{
      .page_layout{ border: none; }
    }

    .table {
      font-size:12px;
    }

    .table > thead > tr > th {
      border: none !important;
      background-color: white;
      font-size:12px;
      font-weight: bold;
    }

		.table > tbody > tr > td {
      border:solid 1px #555555;
      padding:2px;
      height: 5.8mm;
    }

		.table > tbody > tr:first-child > td {
      font-size: 12px;
      font-weight: bold;
    }
</style>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
</div>
<hr>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>" autocomplete="off">
  <div class="row">
    <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 padding-5">
      <label>ใบแพ็ค</label>
      <input type="text" class="form-control text-center" name="from_code" id="pack-code-from" placeholder="เริ่มต้น" autofocus/>
    </div>
    <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 padding-5">
      <label class="not-show">Pack Code</label>
      <input type="text" class="form-control text-center" name="to_code" id="pack-code-to" placeholder="สิ้นสุด" />
    </div>

    <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 padding-5">
      <label>เขต</label>
      <select class="form-control" id="team" name="team_id" onchange="renderSubArea()">
        <option value="">เลือกเขต</option>
        <?php echo select_area(); ?>
      </select>
    </div>

    <div class="col-lg-2-harf col-md-2-harf col-sm-3 col-xs-6 padding-5">
      <label>พื้นที่</label>
      <select class="form-control" name="sub_area_id" id="sub-area">
        <option value="">กรุณาเลือกเขตก่อน</option>
      </select>
    </div>

    <div class="col-lg-1 col-md-1 col-sm-1-้harf col-xs-6 padding-5">
      <label>งวดที่</label>
      <input type="number" class="form-control text-center" name="round_no" id="round-no" value="" />
    </div>

    <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 padding-3">
      <label class="display-block not-show">report</label>
      <button type="button" class="btn btn-sm btn-success btn-block" onclick="getReport()">รายงาน</button>
    </div>

    <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 padding-3">
      <label class="display-block not-show">export</label>
      <button type="button" class="btn btn-sm btn-primary btn-block" onclick="doExport()"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Export</button>
    </div>
  </div>

  <input type="hidden" name="search" value="1" />
  <input type="hidden" name="limit" id="limit" value="40" />
  <input type="hidden" name="offset" id="offset" value="0" />
</form>
<hr class="margin-top-15">

<div id="result" style="width:100%;"> </div>


<form id="exportForm" action="<?php echo $this->home; ?>/do_export" method="post">
	<input type="hidden" name="exFromCode" id="exFromCode">
	<input type="hidden" name="exToCode" id="exToCode">
	<input type="hidden" name="exTeamId" id="exTeamId">
	<input type="hidden" name="exSubArea" id="exSubArea">
	<input type="hidden" name="exRoundNo" id="exRoundNo">
	<input type="hidden" name="token" id="token">
</form>

<?php $this->load->view('report/delivery/report_template'); ?>

<script src="<?php echo base_url(); ?>scripts/inventory/delivery_report/delivery_report.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
