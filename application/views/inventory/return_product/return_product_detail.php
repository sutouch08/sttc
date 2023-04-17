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
			<button type="button" class="btn btn-xs btn-warning top-btn" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
			<?php if($doc->status == 1 && $doc->is_approve == 0 && $this->pm->can_approve) : ?>
				<button type="button" class="btn btn-xs btn-success top-btn" onclick="approve()"><i class="fa fa-check-circle"></i> &nbsp; อนุมัติ</button>
			<?php endif; ?>
			<?php if($doc->status != 2 && $this->pm->can_delete) : ?>
				<button type="button" class="btn btn-xs btn-danger top-btn" onclick="cancle()"><i class="fa fa-times"></i> ยกเลิก</button>
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
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-6">
    <label>วันที่</label>
    <input type="text" class="form-control text-center" id="date_add" value="<?php echo thai_date($doc->date_add, FALSE); ?>" disabled />
  </div>
  <div class="col-lg-2-harf col-md-3-harf col-sm-3 col-xs-6">
    <label>คลังต้นทาง</label>
    <select class="form-control" name="fromWhCode" id="fromWhCode" disabled>
      <option value="">Please Select</option>
      <?php echo select_warehouse($doc->whsCode); ?>
		</select>
  </div>

  <div class="col-lg-3 col-md-3-harf col-sm-3 col-xs-6">
    <label>คลังปลายทาง</label>
		<select class="form-control" name="toWhCode" id="toWhCode" disabled>
      <option value="">Please Select</option>
      <?php echo select_warehouse($doc->toWhsCode); ?>
		</select>
  </div>

  <div class="col-lg-2 col-md-2 col-sm-2-harf col-xs-6">
    <label>Outsource</label>
    <input type="text" class="form-control" value="<?php echo $doc->display_name; ?>" disabled />
  </div>

  <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
    <label>เขต/พื้นที่</label>
    <input type="text" class="form-control" value="<?php echo $doc->team_name; ?>" disabled />
  </div>

	<div class="col-lg-9 col-md-7 col-sm-6 col-xs-12">
		<label>Remark</label>
		<input type="text" class="form-control" name="remark" id="remark" maxlength="254" value="" disabled/>
	</div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6">
		<label>สถานะ</label>
		<input type="text" class="form-control text-center" id="status" value="<?php echo status_text($doc->status, $doc->is_approve); ?>" disabled />
	</div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6">
		<label>SAP No.</label>
		<input type="text" class="form-control text-center" value="<?php echo $doc->DocNum; ?>" disabled />
	</div>
</div>

<input type="hidden" id="return_id" value="<?php echo $doc->id; ?>" />
<hr/>

<?php
function status_text($status, $is_approve)
{
	$text = "Unknow";

	if($status == 0)
	{
		$text = "รอยืนยัน";
	}

	if($status == 1 && $is_approve == 0)
	{
		$text = "รออนุมัติ";
	}

	if($status == 1 && $is_approve == 1)
	{
		$text = "สำเร็จ";
	}

	if($status == 2)
	{
		$text = "ยกเลิก";
	}

	if($status == 3)
	{
		$text = "Interface failed";
	}

	return $text;
}


if($doc->status == 1 && $doc->is_approve == 0)
{
	$this->load->view('approve_watermark');
}

if($doc->status == 0)
{
	$this->load->view('accept_watermark');
}

if($doc->status == 2)
{
	$this->load->view('cancle_watermark');
}
?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
    <table class="table table-striped border-1">
      <thead>
        <tr>
          <th class="fix-width-40 text-center">#</th>
          <th class="fix-width-60 text-center" style="width:60px !important;">ยืนยัน</th>
          <th class="fix-width-150">Serial</th>
          <th class="fix-width-150">Item Code</th>
          <th class="fix-width-250">Description</th>
          <th class="fix-width-100 text-center">Whs Code</th>
          <th class="fix-width-100 text-center">From Doc No</th>
        </tr>
      </thead>
      <tbody>
    <?php if( ! empty($details)) : ?>
      <?php $no = 1; ?>
      <?php foreach($details as $rs) : ?>
        <tr id="row-<?php echo $no; ?>">
          <td class="middle text-center no"><?php echo $no; ?></td>
          <td class="middle text-center"><span><?php echo is_active($rs->valid); ?></span></td>
          <td class="middle"><?php echo $rs->Serial; ?></td>
          <td class="middle"><?php echo $rs->ItemCode; ?></td>
          <td class="middle"><?php echo $rs->ItemName; ?></td>
          <td class="middle text-center"><?php echo $rs->WhsCode; ?></td>
          <td class="middle text-center"><?php echo $rs->fromDoc; ?></td>
        </tr>
        <?php $no++; ?>
      <?php endforeach; ?>
    <?php endif; ?>
      </tbody>
    </table>
  </div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<?php if($doc->is_receive) : ?>
		<span class="green display-block">ยืนยันโดย : <?php echo $this->user_model->get_name($doc->receive_by); ?> @ <?php echo thai_date($doc->receive_at, TRUE); ?></span>
	<?php endif; ?>
	<?php if($doc->is_approve) : ?>
		<span class="green display-block">อนุมัติโดย : <?php echo $this->user_model->get_name($doc->approve_by); ?> @ <?php echo thai_date($doc->approve_at, TRUE); ?></span>
	<?php endif; ?>
	<?php if($doc->is_cancle) : ?>
		<span class="red display-block">ยกเลิกโดย : <?php echo $this->user_model->get_name($doc->cancle_by); ?> @ <?php echo thai_date($doc->cancle_at, TRUE); ?></span>
	<?php endif; ?>
	</div>
</div>

<script src="<?php echo base_url(); ?>scripts/inventory/return/return.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/md5.js"></script>
<script src="<?php echo base_url(); ?>scripts/beep.js"></script>

<?php $this->load->view('include/footer'); ?>
