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
			<button type="button" class="btn btn-sm btn-danger top-btn" onclick="cancelPack()"><i class="fa fa-trash"></i> ยกเลิก</button>
			<button type="button" class="btn btn-sm btn-success top-btn" onclick="finishPack()">Finish Pack</button>
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
    <input type="text" class="form-control text-center edit" id="date_add" value="<?php echo thai_date($doc->date_add, FALSE); ?>" readonly disabled/>
  </div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-4 col-xs-6">
		<label>เขต</label>
		<input type="text" class="form-control edit" id="area" value="<?php echo area_name($doc->team_id); ?>" disabled />
	</div>

	<div class="col-lg-2-harf col-md-2-harf col-sm-4 col-xs-6">
		<label>คลัง</label>
		<input type="text" class="form-control edit" id="WhsCode" value="<?php echo $doc->WhsCode.' : '.warehouse_name($doc->WhsCode); ?>" disabled />
	</div>
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
		<label>เฟส</label>
		<input type="text" class="form-control text-center" name="phase" value="<?php echo $doc->phase; ?>" disabled />
	</div>
  <div class="col-lg-3 col-md-3 col-sm-9-harf col-xs-7">
    <label>Remark</label>
    <input type="text" class="form-control edit" name="remark" id="remark" maxlength="254" value="<?php echo $doc->remark; ?>" />
  </div>

	<div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-3">
		<label class="display-block not-show">btn</label>
		<button type="button" class="btn btn-sm btn-primary btn-block" onclick="updateRemark()">อัพเดต</button>
	</div>
</div>

<input type="hidden" id="pack_id" value="<?php echo $doc->id; ?>" />
<input type="hidden" id="phase" value="<?php echo $doc->phase; ?>" />
<hr class="margin-bottom-10 margin-top-10"/>
<?php $this->load->view('inventory/pack/pack_control'); ?>

<?php $this->load->view('inventory/pack/pack_details'); ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 grey" style="position:absolute; bottom:0px;">
	** "เขต" และ "คลัง" ไม่สามารถแก้ไขได้ เนื่องจากถูกผูกไว้กับ User name ของผู้ทำรายการ
</div>
<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack_add.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack_control.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/beep.js"></script>

<?php $this->load->view('include/footer'); ?>
