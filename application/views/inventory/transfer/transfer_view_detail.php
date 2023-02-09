<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding-5">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding-5">
    <p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<div class="row">
	<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
		<label>Doc No.</label>
		<input type="text" class="form-control text-center" id="code" value="<?php echo $doc->code; ?>" disabled />
		<input type="hidden" id="transfer_id" value="<?php echo $doc->id; ?>" />
	</div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6">
		<label>Doc Date</label>
		<input type="text" class="form-control text-center" id="docDate" value="<?php echo thai_date($doc->docDate, FALSE); ?>" disabled />
	</div>
	<div class="col-lg-3-harf col-md-3-harf col-sm-3-harf col-xs-6">
		<label>From Warehouse</label>
		<input type="text" class="form-control" value="<?php echo $doc->fromWhsCode . " : ".$doc->from_warehouse_name; ?>" disabled />
	</div>
	<div class="col-lg-3-harf col-md-3-harf col-sm-3-harf col-xs-6">
		<label>From Warehouse</label>
		<input type="text" class="form-control" value="<?php echo $doc->toWhsCode . " : ".$doc->to_warehouse_name; ?>" disabled />
	</div>
	<div class="col-lg-2 col-md-2 col-sm-1-harf col-xs-6">
		<label>User</label>
		<input type="text" class="form-control text-center" value="<?php echo uname($doc->create_by); ?>" disabled />
	</div>
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-6">
		<label>Remark</label>
		<input type="text" class="form-control" value="<?php echo $doc->remark; ?>" disabled />
	</div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
		<label>Status</label>
		<select class="form-control" disabled>
			<option value="-1" <?php echo is_selected('-1', $doc->status); ?>>Draft</option>
			<option value="1" <?php echo is_selected('1', $doc->status); ?>>Success</option>
			<option value="2" <?php echo is_selected('2', $doc->status); ?>>Cancelled</option>
			<option value="3" <?php echo is_selected('3', $doc->status); ?>>Failed</option>
		</select>
	</div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
		<label>SAP No</label>
		<input type="text" class="form-control text-center" value="<?php echo $doc->docNum; ?>" disabled />
	</div>
</div>
<hr class="margin-top-15 padding-5" />

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-bordered table-hover border-1" style="min-width:800px;">
			<thead>
				<tr>
					<th class="fix-width-60 text-center"></th>
					<th class="fix-width-200 text-center">Installed Serial</th>
					<th class="fix-width-200 text-center">Item Code</th>
					<th class="fix-width-200 text-center">Item Name</th>
					<th class="fix-width-60 text-center"></th>
					<th class="fix-width-200 text-center">Returnned Serial</th>
				</tr>
			</thead>
			<tbody>
				<?php if( ! empty($details)) : ?>
					<?php $no = 1; ?>
					<?php foreach($details as $rs) : ?>
						<tr id="row-<?php echo $rs->id; ?>">
							<td class="middle text-center">
								<img src="<?php echo get_image_path($rs->InstallSerialNum, 'installed'); ?>" style="width:60px; height: 60px; object-fit:cover;" />
							</td>
							<td class="middle text-center"><?php echo $rs->InstallSerialNum; ?></td>
							<td class="middle"><?php echo $rs->ItemCode; ?></td>
							<td class="middle text-center"><?php echo $rs->ItemName; ?></td>
							<td class="middle text-center">
								<img src="<?php echo get_image_path($rs->ReturnnedSerialNum, 'returnned'); ?>" style="width:60px; height: 60px; object-fit:cover;" />
							</td>
							<td class="middle text-center"><?php echo $rs->ReturnnedSerialNum; ?></td>
						</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('YmdHis'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer_add.js?v=<?php echo date('YmdHis'); ?>"></script>


<?php $this->load->view('include/footer'); ?>
