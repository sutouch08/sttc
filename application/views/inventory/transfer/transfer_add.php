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
	<div class="col-md-1-harf col-sm-2 col-xs-6 hidden-lg">
    <label>เลขที่</label>
    <input type="text" class="form-control text-center" id="code" value="<?php echo $code; ?>" disabled />
  </div>
  <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
    <label>วันที่</label>
    <input type="text" class="form-control text-center edit" id="date_add" value="<?php echo date('d-m-Y'); ?>" readonly disabled />
  </div>
  <div class="col-lg-2 col-md-4-harf col-sm-4 col-xs-6">
    <label>คลังต้นทาง</label>
    <input type="text" class="form-control" value="<?php echo $this->_user->fromWhsCode .' : '.warehouse_name($this->_user->fromWhsCode); ?>" disabled />
		<input type="hidden" id="fromWhsCode" value="<?php echo $this->_user->fromWhsCode; ?>" />
  </div>

  <div class="col-lg-2 col-md-4-harf col-sm-4 col-xs-6">
    <label>คลังปลายทาง</label>
		<input type="text" class="form-control" value="<?php echo $this->_user->toWhsCode .' : '.warehouse_name($this->_user->toWhsCode); ?>" disabled />
		<input type="hidden" id="toWhsCode" value="<?php echo $this->_user->toWhsCode; ?>" />
  </div>

  <div class="col-lg-5-harf col-md-10-harf col-sm-10-harf col-xs-9">
    <label>Remark</label>
    <input type="text" class="form-control edit" name="remark" id="remark" maxlength="254" value="" autofocus/>
  </div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3">
		<label class="display-block not-show">btn</label>
		<button type="button" class="btn btn-sm btn-success btn-block" onclick="add()"><i class="fa fa-plus"></i> Add</button>
	</div>
</div>

<hr class="margin-bottom-10 margin-top-10"/>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center grey" style="padding-top:15px;">
	** คลังต้นทางและคลังปลายทาง ถูกกำหนดโดยการตั้งค่าของ username ที่สร้างเอกสาร **
</div>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer_add.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
