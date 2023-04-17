
	<form id="documentForm" method="post" action="<?php echo $this->home; ?>/update_config">
    <div class="row">
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<table class="table table-bordered border-1">
					<thead>
						<tr>
							<th class="fix-width-150 text-center">Document</th>
							<th class="fix-width-100 text-center">Prefix</th>
							<th class="fix-width-100 text-center">Running(digit)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-right">Transfer</td>
							<td class="text-center">
								<input type="text" class="form-control text-center prefix" name="PREFIX_TRANSFER" required maxlength="2" value="<?php echo $PREFIX_TRANSFER; ?>" />
							</td>
							<td class="text-center">
								<input type="number" class="form-control text-center digit" required name="RUN_DIGIT_TRANSFER" value="<?php echo $RUN_DIGIT_TRANSFER; ?>" />
							</td>
						</tr>
						<tr>
							<td class="text-right">Return</td>
							<td class="text-center">
								<input type="text" class="form-control text-center prefix" name="PREFIX_RETURN" required maxlength="2" value="<?php echo $PREFIX_RETURN; ?>" />
							</td>
							<td class="text-center">
								<input type="number" class="form-control text-center digit" required name="RUN_DIGIT_RETURN" value="<?php echo $RUN_DIGIT_RETURN; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>


		<div class="row">
      <div class="divider-hidden"></div>
			<div class="divider-hidden"></div>
      <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 padding-5 text-center">
			<?php if($this->pm->can_edit OR $this->pm->can_add) : ?>
      	<button type="button" class="btn btn-sm btn-success input-small" onClick="checkDocumentSetting()"><i class="fa fa-save"></i> บันทึก</button>
			<?php endif; ?>
      </div>

      <div class="divider-hidden"></div>
		</div>
  </form>
