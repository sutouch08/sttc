<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
    <h3 class="title"> <?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning top-btn" onclick="goBack()"><i class="fa fa-arrow-left"></i> กลับ</button>
			<?php if($doc->status != 'C' && $this->pm->can_delete) : ?>
				<button type="button" class="btn btn-sm btn-danger top-btn" onclick="confirmCancle()"><i class="fa fa-times"></i> ยกเลิก</button>
			<?php endif; ?>
      <?php if($doc->status == 'P' && $this->pm->can_edit) : ?>
      <button type="button" class="btn btn-sm btn-warning top-btn" onclick="edit(<?php echo $doc->id; ?>)"><i class="fa fa-pencil"></i> แก้ไข</button>
      <?php endif; ?>
		</p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<div class="row">
  <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
    <label>เลขที่</label>
    <input type="text" class="form-control text-center" id="code" value="<?php echo $doc->code; ?>" disabled/>
  </div>
  <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
    <label>วันที่</label>
    <input type="text" class="form-control text-center" id="date_add" value="<?php echo thai_date($doc->date_add, FALSE); ?>" readonly disabled />
  </div>
  <div class="col-lg-4-harf col-md-4-harf col-sm-4 col-xs-6">
    <label>คลังต้นทาง</label>
    <select class="form-control" name="fromWhsCode" id="fromWhsCode" disabled>
      <option value="">เลือกคลังต้นทาง</option>
      <?php echo select_warehouse($doc->fromWhsCode); ?>
		</select>
  </div>

  <div class="col-lg-4-harf col-md-4-harf col-sm-4 col-xs-6">
    <label>คลังปลายทาง</label>
		<select class="form-control" name="toWhsCode" id="toWhsCode" disabled>
      <option value="">เลือกคลังปลายทาง</option>
      <?php echo select_warehouse($doc->toWhsCode); ?>
		</select>
  </div>

  <div class="col-lg-10-harf col-md-10-harf col-sm-10-harf col-xs-9">
    <label>Remark</label>
    <input type="text" class="form-control edit" name="remark" id="remark" maxlength="254" value="<?php echo $doc->remark; ?>" disabled/>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-3">
		<label>SAP NO</label>
		<input type="text" class="form-control text-center" value="<?php echo $doc->DocNum; ?>" disabled />
	</div>
</div>

<input type="hidden" id="transfer_id" value="<?php echo $doc->id; ?>" />

<?php if($doc->status == 'C') { $this->load->view('cancle_watermark'); } ?>
<hr class="margin-bottom-10 margin-top-10"/>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
    <table class="table table-striped border-1">
      <thead>
        <tr>
          <th class="fix-width-40 text-center">#</th>
          <th class="fix-width-100">PEA NO</th>
          <th class="fix-width-100">Item Code</th>
          <th class="min-width-200">Description</th>
          <th class="fix-width-100">ต้นทาง</th>
          <th class="fix-width-100">ปลายทาง</th>
          <th class="fix-width-80 text-center">Qty</th>
        </tr>
      </thead>
      <tbody>
    <?php if( ! empty($details)) : ?>
      <?php $no = 1; ?>
			<?php $totalQty = 0; ?>
      <?php foreach($details as $rs) : ?>
        <tr id="row-<?php echo $no; ?>">
          <td class="middle text-center no"><?php echo $no; ?></td>
          <td class="middle"><?php echo $rs->i_pea_no; ?></td>
          <td class="middle"><?php echo $rs->ItemCode; ?></td>
          <td class="middle"><?php echo $rs->ItemName; ?></td>
          <td class="middle"><?php echo $rs->fromWhsCode; ?></td>
          <td class="middle"><?php echo $rs->toWhsCode; ?></td>
          <td class="middle text-center"><?php echo $rs->qty; ?></td>
        </tr>
        <?php $no++; ?>
				<?php $totalQty = $totalQty + $rs->qty; ?>
      <?php endforeach; ?>

			<tr>
				<td colspan="6" class="middle text-right"><strong>รวม</strong></td>
				<td class="middle text-center"><strong><?php echo number($totalQty); ?></strong></td>
			</tr>
    <?php endif; ?>
      </tbody>
    </table>
  </div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		สร้างโดย : <?php echo display_name($doc->user); ?> @ <?php echo thai_date($doc->create_date, TRUE); ?>
		<?php if( ! empty($doc->update_user)) : ?>
			<br/>
			แก้ไขล่าสุดโดย : <?php echo display_name($doc->update_user); ?> @ <?php echo thai_date($doc->date_upd, TRUE); ?>
		<?php endif; ?>
	</div>
</div>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
