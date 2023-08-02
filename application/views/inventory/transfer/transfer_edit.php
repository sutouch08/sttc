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
      <?php if($doc->status == 'P' && $this->pm->can_edit) : ?>
        <button type="button" class="btn btn-sm btn-primary top-btn" onclick="reloadWarehouse()">ตรวจสอบต้นทาง</button>
				<button type="button" class="btn btn-sm btn-danger top-btn" onclick="confirmCancle()"><i class="fa fa-times"></i> ยกเลิก</button>
      	<button type="button" class="btn btn-sm btn-success top-btn" onclick="confirmSave()"><i class="fa fa-save"></i> บันทึก</button>
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
  <div class="col-lg-1 col-md-1-harf col-sm-2 col-xs-6">
    <label>วันที่</label>
    <input type="text" class="form-control text-center" id="date_add" value="<?php echo thai_date($doc->date_add, FALSE); ?>" readonly disabled />
  </div>
  <div class="col-lg-3 col-md-3-harf col-sm-3 col-xs-6">
    <label>คลังต้นทาง</label>
    <input type="text" class="form-control" value="<?php echo $doc->fromWhsCode.' : '.warehouse_name($doc->fromWhsCode); ?>" disabled />
  </div>

  <div class="col-lg-3 col-md-3-harf col-sm-3 col-xs-6">
    <label>คลังปลายทาง</label>
		<input type="text" class="form-control" value="<?php echo $doc->toWhsCode.' : '.warehouse_name($doc->toWhsCode); ?>" disabled />
  </div>

	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
		<label>User</label>
		<input type="text" class="form-control text-center" value="<?php echo display_name($doc->user); ?>" disabled />
	</div>

	<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
		<label>ใบแพ็ค</label>
		<input type="text" class="form-control text-center" id="pack-code" value="<?php echo $doc->pack_code; ?>" disabled />
	</div>

  <div class="col-lg-10-harf col-md-8-harf col-sm-8-harf col-xs-9">
    <label>Remark</label>
    <input type="text" class="form-control edit" name="remark" id="remark" maxlength="254" value="<?php echo $doc->remark; ?>" disabled/>
  </div>

  <?php if($doc->status == 'P') : ?>
  <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-3">
    <label class="display-block not-show">btn</label>
    <button type="button" class="btn btn-sm btn-warning btn-block" id="btn-edit" onclick="getEdit()"><i class="fa fa-pencil"></i> แก้ไข</button>
    <button type="button" class="btn btn-sm btn-success btn-block hide" id="btn-update" onclick="update()"><i class="fa fa-save"></i> Update</button>
  </div>
  <?php else : ?>
    <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-3">
      <label>SAP NO</label>
      <input type="text" class="form-control text-center" value="<?php echo $doc->DocNum; ?>" disabled />
    </div>
  <?php endif; ?>
</div>

<input type="hidden" id="transfer_id" value="<?php echo $doc->id; ?>" />
<input type="hidden" id="fromWhsCode" value="<?php echo $doc->fromWhsCode; ?>"/>
<input type="hidden" id="toWhsCode" value="<?php echo $doc->toWhsCode; ?>" />
<hr class="margin-bottom-10 margin-top-10"/>
<?php if($doc->status == 'P' && $doc->input_type == 'M' && $this->pm->can_edit) : ?>
	<?php $this->load->view('inventory/transfer/transfer_control'); ?>
<?php endif; ?>
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
      <?php foreach($details as $rs) : ?>
				<?php $fcolor = ($rs->fromWhsCode == $doc->fromWhsCode) ? "" : "color:red"; ?>
				<?php $tcolor = ($rs->toWhsCode == $doc->toWhsCode) ? "" : "color:red"; ?>
        <tr id="row-<?php echo $no; ?>" >
          <td class="middle text-center no" data-no="<?php echo $no; ?>"><?php echo $no; ?></td>
          <td class="middle"><?php echo $rs->i_pea_no; ?></td>
          <td class="middle"><?php echo $rs->ItemCode; ?></td>
          <td class="middle"><?php echo $rs->ItemName; ?></td>
          <td class="middle" style="<?php echo $fcolor; ?>" id="from-<?php echo $no; ?>"><?php echo $rs->fromWhsCode; ?></td>
          <td class="middle" style="<?php echo $tcolor; ?>" id="to-<?php echo $no; ?>"><?php echo $rs->toWhsCode; ?></td>
          <td class="middle text-center"><?php echo $rs->qty; ?></td>
        </tr>
        <?php $no++; ?>
      <?php endforeach; ?>
    <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('inventory/transfer/install_list_modal'); ?>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer_control.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
