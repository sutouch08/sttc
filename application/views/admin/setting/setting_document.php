
	<form id="documentForm" method="post" action="<?php echo $this->home; ?>/update_config">
    <div class="row">
    	<div class="col-lg-3 col-md-3-harf col-sm-4 col-xs-8 col-xs-offset-2 margin-bottom-15">
				<div class="input-group width-100">
					<span class="input-group-addon">Prefix Transfer</span>
					<input type="text" class="form-control input-sm text-center prefix" name="PREFIX_TRANSFER" required value="<?php echo $PREFIX_TRANSFER; ?>" />
				</div>
			</div>
			<div class="col-lg-3 col-md-3-harf col-sm-4 col-xs-8 col-xs-offset-2 margin-bottom-15">
				<div class="input-group width-100">
					<span class="input-group-addon">Running Digits</span>
					<input type="text" class="form-control input-sm text-center digit" required name="RUN_DIGIT_TRANSFER" value="<?php echo $RUN_DIGIT_TRANSFER; ?>" />
				</div>
			</div>
      <div class="divider-hidden"></div>
		</div>


		<div class="row">
      <div class="divider-hidden"></div>
			<div class="divider-hidden"></div>
      <div class="col-lg-6-harf col-md-8-harf col-sm-9 hidden-xs padding-5 text-right">
			<?php if($this->pm->can_edit OR $this->pm->can_add) : ?>
      	<button type="button" class="btn btn-sm btn-success input-small" onClick="checkDocumentSetting()"><i class="fa fa-save"></i> บันทึก</button>
			<?php endif; ?>
      </div>
			<div class="col-xs-12 visible-xs padding-5 text-center">
			<?php if($this->pm->can_edit OR $this->pm->can_add) : ?>
      	<button type="button" class="btn btn-sm btn-success btn-100" onClick="checkDocumentSetting()"><i class="fa fa-save"></i> บันทึก</button>
			<?php endif; ?>
      </div>
      <div class="divider-hidden"></div>
		</div>
  </form>
