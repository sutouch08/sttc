<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <p class="pull-right top-p hidden-xs">
			<button type="button" class="btn btn-sm btn-warning top-btn" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
		<button type="button" class="btn btn-sm btn-warning top-btn visible-xs" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<div class="row">
  <div class="col-lg-2-harf col-md-3-harf col-sm-3 col-xs-12">
    <label>From Warehouse</label>
    <select class="form-control" name="fromWhCode" id="fromWhCode">
			<?php if( ! empty($fromWhList)) : ?>
				<?php foreach($fromWhList as $wh) : ?>
					<option value="<?php echo $wh->code; ?>"><?php echo $wh->code ." : ".$wh->name; ?></option>
				<?php endforeach; ?>
			<?php else : ?>
				<option value="">-Now Available-</option>
			<?php endif; ?>
		</select>
		<div class="col-xs-12 col-sm-reset inline red" id="from-wh-error"></div>
  </div>

  <div class="col-lg-2-harf col-md-3-harf col-sm-3 col-xs-12">
    <label>To Warehouse</label>
		<select class="form-control" name="toWhCode" id="toWhCode">
			<?php if( ! empty($toWhList)) : ?>
				<?php foreach($toWhList as $wh) : ?>
					<option value="<?php echo $wh->code; ?>"><?php echo $wh->code ." : ". $wh->name; ?></option>
				<?php endforeach; ?>
			<?php else : ?>
				<option value="">-Now Available-</option>
			<?php endif; ?>
		</select>
		<div class="col-xs-12 col-sm-reset inline red" id="to-wh-error"></div>
  </div>

	<div class="col-lg-6 col-md-4 col-sm-4-harf col-xs-12">
		<label>Remark</label>
		<input type="text" class="form-control" name="remark" id="remark" maxlength="254" value="" />
	</div>

	<div class="divider visible-xs"></div>

  <div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-12">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-sm btn-primary btn-block" onclick="add()">Add</button>
  </div>
</div>

<input type="hidden" id="team_id" value="<?php echo $this->_user->team_id; ?>" />

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
