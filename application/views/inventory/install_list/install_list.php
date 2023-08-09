<?php $this->load->view('include/header'); ?>
<?php $pm = get_permission('OPWHTR', $this->_user->id); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-5 hidden-xs padding-5">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
	<div class="col-xs-12 visible-xs padding-5">
    <h3 class="title-xs">
      <?php echo $this->title; ?>
    </h3>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
		<p class="pull-right top-p">
			<?php if($this->pm->can_add) : ?>
				<!--<button type="button" class="btn btn-sm btn-success top-btn" onclick="createTransfer()">สร้างเอกสารโอนคลัง</button>-->
			<?php endif; ?>
			<?php if($this->pm->can_add OR $this->pm->can_edit) : ?>
				<button type="button" class="btn btn-sm btn-primary top-btn" onclick="getImportFile()">Import file</button>
			<?php endif; ?>
			<?php if($this->pm->can_delete) : ?>
				<button type="button" class="btn btn-sm btn-warning top-btn" onclick="confirmClose()">Close</button>
				<button type="button" class="btn btn-sm btn-warning top-btn" onclick="unClose()">UnClose</button>
				<button type="button" class="btn btn-sm btn-danger top-btn" onclick="confirmDelete()">ลบรายการ</button>
			<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>" autocomplete="off">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>PEA NO(เก่า)</label>
			<input type="text" class="form-control input-sm search-box" name="u_pea_no" id="u_pea_no" value="<?php echo $u_pea_no; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>PEA NO(ใหม่)</label>
			<input type="text" class="form-control input-sm search-box" name="i_pea_no" id="i_pea_no" value="<?php echo $i_pea_no; ?>" />
		</div>

<?php if(empty($this->_user->team_id)) : ?>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>เขต</label>
			<select class="form-control input-sm filter" name="area" id="area">
				<option value="all">ทั้งหมด</option>
				<?php echo select_area_code($area); ?>
			</select>
		</div>
<?php endif; ?>
		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 margin-bottom-5">
			<label>ผู้ติดตั้ง</label>
			<input type="text" class="form-control input-sm search-box" name="worker" id="worker" value="<?php echo $worker; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 margin-bottom-5">
			<label>ผู้นำเข้า</label>
			<input type="text" class="form-control input-sm search-box" name="user" id="user" value="<?php echo $user; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 margin-bottom-5">
			<label>เลขที่ใบแพ็ค</label>
			<input type="text" class="form-control input-sm search-box" name="pack_code" id="pack_code" value="<?php echo $pack_code; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 margin-bottom-5">
			<label>เลขที่ใบโอน</label>
			<input type="text" class="form-control input-sm search-box" name="transfer_code" id="transfer_code" value="<?php echo $transfer_code; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 margin-bottom-5">
			<label>Status</label>
			<select class="form-control input-sm" name="status" id="status" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
				<option value="O0" <?php echo is_selected('O0', $status); ?>>รอแพ็ค</option>
				<option value="O1" <?php echo is_selected('O1', $status); ?>>รอโอน</option>
				<option value="L" <?php echo is_selected('L', $status); ?>>ระหว่างโอน</option>
				<option value="S" <?php echo is_selected('S', $status); ?>>โอนแล้ว</option>
				<option value="E" <?php echo is_selected('E', $status); ?>>Error</option>
				<option value="C" <?php echo is_selected('C', $status); ?>>Closed</option>
			</select>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
	    <label>วันที่ติดตั้ง</label>
	    <div class="input-daterange input-group">
	      <input type="text" class="form-control input-sm text-center width-50 from-date" name="from_date" id="fromDate" value="<?php echo $from_date; ?>" />
	      <input type="text" class="form-control input-sm text-center width-50" name="to_date" id="toDate" value="<?php echo $to_date; ?>" />
	    </div>
	  </div>

		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
		</div>
		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
		</div>
		<div class="col-lg-1 col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-success btn-block" onclick="exportFilter()"><i class="fa fa-file-excel-o"></i> Export</button>
		</div>

		<div class="col-lg-3-harf visible-lg">&nbsp;</div>

		<div class="col-lg-1 col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>จำนวนคน</label>
			<input type="number" class="form-control input-sm text-center" id="count-worker" value="" disabled/>
		</div>
		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-info btn-block" onclick="countWorker()">แสดง</button>
		</div>
	</div>
</form>
<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>

<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:1300px;;">
			<thead>
				<tr>
					<?php if($this->pm->can_delete) : ?>
					<th class="fix-width-40 middle">
						<label><input type="checkbox" class="ace" id="chk-all" onchange="checkAll()" /><span class="lbl"></span></label>
					</th>
					<?php endif; ?>
					<th class="fix-width-40 middle text-center">#</th>
					<th class="fix-width-60 middle"></th>
					<th class="fix-width-80 middle">สถานะ</th>
					<th class="fix-width-100 middle">วันที่ติดตั้ง</th>
					<th class="fix-width-120 middle">PEA NO(เก่า)</th>
					<th class="fix-width-120 middle">PEA NO(ใหม่)</th>
					<th class="fix-width-80 middle">เขต</th>
					<th class="fix-width-200 middle">ผู้ติดตั้ง</th>
					<th class="fix-width-100 middle">ผู้นำเข้า</th>
					<th class="fix-width-100 middle">วันที่นำเข้า</th>
					<th class="fix-width-100 middle">เลขที่ใบแพ็ค</th>
					<th class="fix-width-100 middle">เลขที่ใบโอน</th>
					<th class="min-width-100 middle">Error</th>
				</tr>
			</thead>
			<tbody>
<?php
	$color = array(
		"O0" => "" ,
		"O1" => "color:#428bca;",
		"L" => "color:blue;",
		"S" => "color:#4caf50;",
		"E" => "color:red",
		"C" => "color:grey"
	);

	function labelx($pk)
	{
		$label = array(
			'O0' => 'รอแพ็ค',
			'O1' => 'รอโอน',
			'L' => 'ระหว่างโอน',
			'S' => 'โอนแล้ว',
			'E' => 'Error',
			'C' => 'Closed'
		);

		return $label[$pk];
	}
	?>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php $area = area_code_array(); ?>
	<?php foreach($data as $rs) : ?>
		<?php $pk = $rs->status == 'O' ? $rs->status.$rs->pack_status : $rs->status; ?>
				<tr id="row-<?php echo $rs->id; ?>" style="<?php echo $color[$pk]; ?>">
					<?php if($this->pm->can_delete) : ?>
					<td class="middle">
						<?php if($rs->pack_status == 0 && ($rs->status == 'O' OR $rs->status == 'E' OR $rs->status == 'C')) : ?>
							<label>
								<input type="checkbox" class="ace chk" name="chk" value="<?php echo $rs->id; ?>" />
								<span class="lbl"></span>
							</label>
						<?php endif; ?>
					</td>
					<?php endif; ?>
					<td class="middle text-center" id="no-<?php echo $rs->id; ?>"><?php echo $no; ?></td>
					<td class="middle"><button type="button" class="btn btn-mini btn-primary" onclick="preview(<?php echo $rs->id; ?>)"><i class="fa fa-eye"></i></button></td>
					<td class="middle"><?php echo labelx($pk); ?></td>
					<td class="middle"><?php echo thai_date($rs->work_date, FALSE); ?></td>
					<td class="middle"><?php echo $rs->u_pea_no; ?></td>
					<td class="middle"><?php echo $rs->i_pea_no; ?></td>
					<td class="middle"><?php echo empty($area[$rs->area]) ? "" : $area[$rs->area]; ?></td>
					<td class="middle" style="white-space-collapse:break-spaces;"><?php echo $rs->worker; ?></td>
					<td class="middle"><?php echo $rs->user; ?></td>
          <td class="middle"><?php echo thai_date($rs->date_add, FALSE); ?></td>
					<td class="middle"><?php echo $rs->pack_code; ?></td>
					<td class="middle"><?php echo $rs->transfer_code; ?></td>
					<td class="middle"><?php echo $rs->message; ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<?php $this->load->view('inventory/install_list/import_excel'); ?>

<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header" style="background-color:white; border-bottom:0px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">สร้างเอกสารโอนสินค้าระหว่างคลัง</h4>
       </div>
       <div class="modal-body">
         <div class="row" >
					 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
					 	<label>คลังต้นทาง</label>
						<select class="form-control input-sm" name="fromWhs" id="fromWhs">
							<option value="">Please Select</option>
							<?php echo select_listed_warehouse(); ?>
						</select>
						<div class="col-xs-12 col-sm-reset inline red" id="fromWhs-error"></div>
					 </div>
					 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
					 	<label>คลังปลายทาง</label>
						<select class="form-control input-sm" name="toWhs" id="toWhs">
							<option value="">Please Select</option>
							<?php echo select_listed_warehouse(); ?>
						</select>
						<div class="col-xs-12 col-sm-reset inline red" id="toWhs-error"></div>
					 </div>
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
					 	<label>หมายเหตุ</label>
						<input type="text" class="form-control input-sm" maxlength="254" name="remark" id="remark" />
					 </div>
         </div>
       </div>
			 <div class="modal-footer">
 				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" >Close</button>
				<?php if($pm->can_add) : ?>
					<button type="button" class="btn btn-sm btn-success" onclick="addTransfer()">สร้างเอกสาร</button>
				<?php endif; ?>
 			</div>
		</div>
	</div>
</div>

<form id="export_filter_form" action="<?php echo $this->home; ?>/export_filter" method="post">
	<input type="hidden" name="export_u_pea_no" id="export_u_pea_no">
	<input type="hidden" name="export_i_pea_no" id="export_i_pea_no">
	<input type="hidden" name="export_area" id="export_area">
	<input type="hidden" name="export_worker" id="export_worker">
	<input type="hidden" name="export_user" id="export_user">
	<input type="hidden" name="export_pack_code" id="export_pack_code">
	<input type="hidden" name="export_transfer_code" id="export_transfer_code">
	<input type="hidden" name="export_status" id="export_status">
	<input type="hidden" name="export_from_date" id="export_from_date">
	<input type="hidden" name="export_to_date" id="export_to_date">
	<input type="hidden" name="token" id="token">
</form>

<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header" style="background-color:white; border-bottom:0px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
       </div>
       <div class="modal-body">
         <div class="row" >
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5" style="padding-top:0px;" id="preview-table">

					 </div>
         </div>
       </div>
			 <div class="modal-footer">
 				<button type="button" class="btn btn-lg btn-default" data-dismiss="modal" >Close</button>
 			</div>
		</div>
	</div>
</div>

<script type="text/x-handlebarsTemplate" id="preview-template">
	<table class="table table-striped border-1">
		<tr><td class="width-20">วันที่ติดตั้ง</td><td class="width-80">{{work_date}}</td></tr>
		<tr><td>PEA NO เก่า</td><td>{{u_pea_no}}</td></tr>
		<tr><td>PEA NO ใหม่</td><td>{{i_pea_no}}</td></tr>
		<tr><td>เฟส</td><td>{{phase}}</td></tr>
		<tr><td>ขนาด</td><td>{{meter_size_name}}</td></tr>
		<tr><td>หน่วย(kWh)</td><td>{{meter_read_end}}</td></tr>
		<tr><td>อายุมิเตอร์</td><td>{{meter_age}}</td></tr>
		<tr><td>สภาพมิเตอร์</td><td>{{dispose_reason_name}}</td></tr>
		<tr><td>สายจดหน่วย</td><td>{{route}}</td></tr>
		<tr><td>เขต</td><td>{{area_name}}</td></tr>
		<tr><td>ผู้ติดตั้ง</td><td>{{worker}}</td></tr>
		<tr><td>ผู้นำเข้า</td><td>{{user}}</td></tr>
		<tr><td>วันที่นำเข้า</td><td>{{date_add}}</td></tr>
		<tr><td>Item code</td><td>{{ItemCode}}</td></tr>
		<tr><td>Description</td><td>{{ItemName}}</td></tr>
		<tr><td>สถานะ</td><td>{{status_label}}</td></tr>
	</table>
</script>

<script>
function exportFilter() {

	let u_pea_no = $('#u_pea_no').val();
	let i_pea_no = $('#i_pea_no').val();
	let area = $('#area').val();
	let worker = $('#worker').val();
	let user = $('#user').val();
	let pack_code = $('#pack_code').val();
	let transfer_code = $('#transfer_code').val();
	let status = $('#status').val();
	let from_date = $('#fromDate').val();
	let to_date = $('#toDate').val();
  let token	= new Date().getTime();


  $('#export_u_pea_no').val(u_pea_no);
	$('#export_i_pea_no').val(i_pea_no);
	$('#export_area').val(area);
	$('#export_worker').val(worker);
	$('#export_user').val(user);
	$('#export_pack_code').val(pack_code);
	$('#export_transfer_code').val(transfer_code);
	$('#export_status').val(status);
	$('#export_from_date').val(from_date);
	$('#export_to_date').val(to_date);
  $('#token').val(token);

	if(!isDate(from_date) || !isDate(to_date)){
		swal("กรุณาระบุวันที่ติดตั้ง");
		return false;
	}

  get_download(token);

  $('#export_filter_form').submit();

}

function countWorker() {
	let u_pea_no = $('#u_pea_no').val();
	let i_pea_no = $('#i_pea_no').val();
	let area = $('#area').val();
	let worker = $('#worker').val();
	let user = $('#user').val();
	let pack_code = $('#pack_code').val();
	let transfer_code = $('#transfer_code').val();
	let status = $('#status').val();
	let from_date = $('#fromDate').val();
	let to_date = $('#toDate').val();

	$.ajax({
		url:HOME + 'count_worker',
		type:'POST',
		cache:false,
		data: {
			"u_pea_no" : u_pea_no,
			"i_pea_no" : i_pea_no,
			"area" : area,
			"worker" : worker,
			"user" : user,
			"pack_code" : pack_code,
			"transfer_code" : transfer_code,
			"status" : status,
			"from_date" : from_date,
			"to_date" : to_date
		},
		success:function(rs) {
			$('#count-worker').val(rs);
		}
	})
}
</script>

<script src="<?php echo base_url(); ?>scripts/inventory/install_list/install_list.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
