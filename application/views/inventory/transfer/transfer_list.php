<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs padding-5">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<?php if($this->pm->can_add) : ?>
				<button type="button" class="btn btn-sm btn-primary btn-100" onclick="addNew()"><i class="fa fa-plus"></i> เพิ่มใหม่</button>
			<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row">
		<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>เลขที่</label>
			<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-3 col-sm-2 col-xs-6 margin-bottom-5">
			<label>คลังต้นทาง</label>
			<select class="form-control input-sm filter" name="from_warehouse">
				<option value="all">ทั้งหมด</option>
				<?php echo select_listed_warehouse($from_warehouse); ?>
			</select>
		</div>

		<div class="col-lg-1-harf col-md-3 col-sm-2 col-xs-6 margin-bottom-5">
			<label>คลังปลายทาง</label>
			<select class="form-control input-sm filter" name="to_warehouse">
				<option value="all">ทั้งหมด</option>
				<?php echo select_listed_warehouse($to_warehouse); ?>
			</select>
		</div>

		<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>Status</label>
			<select class="form-control input-sm filter" name="status">
				<option value="all">ทั้งหมด</opton>
				<option value="P" <?php echo is_selected('P', $status); ?>>ดราฟ</option>
				<option value="S" <?php echo is_selected('S', $status); ?>>บันทึกแล้ว</option>
				<option value="C" <?php echo is_selected('C', $status); ?>>ยกเลิก</option>
			</select>
		</div>

		<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>Interface</label>
			<select class="form-control input-sm filter" name="export_status">
				<option value="all">ทั้งหมด</opton>
				<option value="P" <?php echo is_selected('P', $export_status); ?>>Pending</option>
				<option value="S" <?php echo is_selected('S', $export_status); ?>>Success</option>
				<option value="F" <?php echo is_selected('F', $export_status); ?>>Failed</option>
			</select>
		</div>

		<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>พนักงาน</label>
			<input type="text" class="form-control input-sm search-box" name="user" value="<?php echo $user; ?>" />
		</div>



		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
	    <label>วันที่</label>
	    <div class="input-daterange input-group">
	      <input type="text" class="form-control input-sm text-center width-50 from-date" name="from_date" id="fromDate" value="<?php echo $from_date; ?>" />
	      <input type="text" class="form-control input-sm text-center width-50" name="to_date" id="toDate" value="<?php echo $to_date; ?>" />
	    </div>
	  </div>

		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="submit" class="btn btn-xs btn-primary btn-block">Search</button>
		</div>
		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()">Reset</button>
		</div>
	</div>
</form>
<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:1000px;;">
			<thead>
				<tr>
					<th class="fix-width-120 middle text-center"></th>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-80 middle text-center">สถานะ</th>
					<th class="fix-width-80 middle text-center">SAP</th>
					<th class="fix-width-100 middle text-center">วันที่</th>
					<th class="fix-width-120 middle">เลขที่</th>
					<th class="fix-width-200 middle">คลังต้นทาง</th>
					<th class="fix-width-200 middle">คลังปลายทาง</th>
					<th class="fix-width-80 middle text-center">จำนวน</th>
					<th class="fix-width-100 middle">ผู้ทำรายการ</th>
					<th class="fix-width-100 middle">SAP No.</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>">
					<td class="middle">
						<button type="button" class="btn btn-mini btn-primary" onclick="viewDetail(<?php echo $rs->id; ?>)"><i class="fa fa-eye"></i></button>
						<?php if($rs->status == 'P' && $this->pm->can_edit) : ?>
							<button type="button" class="btn btn-mini btn-warning" onclick="edit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center" id="no-<?php echo $rs->id; ?>"><?php echo $no; ?></td>
					<td class="middle text-center">
							<?php echo transfer_status_label($rs->status); ?>
					</td>
					<td class="middle text-center">
						<?php if($rs->status == 'S') : ?>
							<?php if($rs->export_status == 'F') : ?>
								<a class="red" href="javascript:showErrorMessage(`<?php echo $rs->Message; ?>`)">Failed</a>
							<?php else : ?>
								<?php echo sap_status_label($rs->export_status); ?>
							<?php endif; ?>
						<?php endif; ?>
					</td>
					<td class="middle text-center"><?php echo thai_date($rs->date_add, FALSE); ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle"><?php echo $rs->fromWhsCode; ?></td>
					<td class="middle"><?php echo $rs->toWhsCode; ?></td>
					<td class="middle text-center"><?php echo number($this->transfer_model->totalRow($rs->id)); ?></td>
					<td class="middle"><?php echo display_name($rs->user); ?></td>
					<td class="middle"><?php echo $rs->DocNum;?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="errorMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Failed</h4>
       </div>
       <div class="modal-body">
         <div class="row" style="max-height:75vh; overflow:auto;">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="error-message">

					 </div>
         </div>
       </div>
		</div>
	</div>
</div>

<script>
	function showErrorMessage(msg) {
		$('#error-message').text(msg);
		$('#errorMessageModal').modal('show');
	}
</script>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
