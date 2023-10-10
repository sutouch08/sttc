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
		</p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<div class="row">
  <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
    <label>วันที่</label>
    <input type="text" class="form-control text-center edit" id="date_add" value="<?php echo date('d-m-Y'); ?>" disabled />
  </div>
	<div class="col-lg-2 col-md-2 col-sm-2-harf col-xs-6">
		<label>เขต</label>
		<input type="text" class="form-control edit" id="area" value="<?php echo $this->_user->team_name; ?>" disabled />
		<input type="hidden" id="team_id" value="<?php echo $this->_user->team_id; ?>" />
	</div>

	<div class="col-lg-4-harf col-md-4-harf col-sm-4-harf col-xs-12">
		<label>คลัง</label>
		<input type="text" class="form-control edit" id="WhsCode" value="<?php echo $this->_user->fromWhsCode.' : '.warehouse_name($this->_user->fromWhsCode); ?>" disabled />
	</div>

	<div class="col-lg-2 col-md-2-harf col-sm-3 col-xs-6">
		<label>พื้นที่</label>
		<select class="form-control edit" id="sub-area">
			<option value="">เลือกพื้นที่</option>
			<?php echo select_sub_area_team($this->_user->team_id); ?>
		</select>
	</div>

	<div class="col-lg-2 col-md-1-harf col-sm-2-harf col-xs-6">
		<label>สี</label>
		<select class="form-control edit" id="color">
			<option value="">เลือกสี</option>
			<option value="Green">สีเขียว</option>
			<option value="Blue">น้ำเงิน</option>
			<option value="Orange">ส้ม</option>
			<option value="Red">แดง</option>
		</select>
	</div>

  <div class="col-lg-11 col-md-10-harf col-sm-8 col-xs-9">
    <label>Remark</label>
    <input type="text" class="form-control edit" name="remark" id="remark" maxlength="254" value="" autofocus />
  </div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3">
		<label class="display-block not-show">btn</label>
		<button type="button" class="btn btn-sm btn-success btn-block" onclick="add()"><i class="fa fa-plus"></i> Add</button>
	</div>

	<input type="hidden" id="phase" value="<?php echo $phase; ?>" />
</div>

<hr class="margin-bottom-10 margin-top-10"/>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h4 class="text-center grey">*** สร้างเอกสารแพ็ค สำหรับแพ็คมิเตอร์ <?php echo $phase; ?> เฟสเท่านั้น *** </h4>
</div>

<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack_add.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
