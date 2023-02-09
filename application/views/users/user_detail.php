<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class="margin-bottom-30"/>
<form class="form-horizontal">
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Username</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<input type="text" class="form-control" maxlength="50" value="<?php echo $user->uname; ?>" disabled />
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="uname-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Display name</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<input type="text" class="form-control width-100" maxlength="100" value="<?php echo $user->name; ?>" disabled/>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="dname-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">User Group</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="ugroup" disabled>
        <option value="">Please Select</option>
				<?php echo select_ugroup($user->ugroup); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="ugroup-error"></div>
	</div>


  <div class="form-group" id="team-table">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Outsource Area</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="team_id" disabled>
				<option value="">-ไม่ระบุ-</option>
      <?php echo select_team($user->team_id); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="team-error"></div>
  </div>

  <div class="form-group" id="area-table">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">Manager Area</label>
		<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="area-list" style="margin-top:10px; max-height:400px; overflow-y:auto;">
			<table class="table table-bordered border-1">
				<thead>
					<tr class="freez">
						<th class="fix-width-60 text-center outline">#</th>
						<th class="min-width-100 text-left outline">Name</th>
					</tr>
				</thead>
				<tbody>
				<?php if( ! empty($teamList)) : ?>
					<?php foreach($teamList as $rs) : ?>
            <?php $checked = isset($uteam[$rs->id]) ? 'checked' : ''; ?>
						<tr>
							<td class="middle text-center">
								<label>
									<input type="checkbox" class="ace chk-area" value="<?php echo $rs->id; ?>" <?php echo $checked; ?> disabled/>
									<span class="lbl"></span>
								</label>
							</td>
							<td class="middle"><?php echo $rs->name; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr><td colspan="2" class="text-center">Please Define Area</td></tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12 col-sm-reset inline red" id="area-error"></div>
  </div>

  <div class="form-group" id="warehouse-table">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">Warehouse</label>
		<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="wh-list" style="margin-top:10px; height:400px; overflow-y:auto;">
			<table class="table table-bordered border-1">
				<thead>
					<tr class="freez">
						<th class="fix-width-60 text-center outline">#</th>
						<th class="fix-width-100 text-center outline">Code</th>
						<th class="min-width-100 text-left outline">Name</th>
					</tr>
				</thead>
				<tbody>
				<?php if( ! empty($whList)) : ?>
					<?php foreach($whList as $rs) : ?>
            <?php $checked = isset($uwh[$rs->id]) ? 'checked' : ''; ?>
						<tr>
							<td class="middle text-center">
								<label>
									<input type="checkbox" class="ace chk-wh" value="<?php echo $rs->code; ?>" <?php echo $checked; ?> disabled/>
									<span class="lbl"></span>
								</label>
							</td>
							<td class="middle text-center"><?php echo $rs->code; ?></td>
							<td class="middle"><?php echo $rs->name; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr><td colspan="3" class="text-center">Please Define Warehouse</td></tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12 col-sm-reset inline red" id="warehouse-error"></div>
  </div>

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 control-label hidden-xs">Status</label>
    <label class="col-xs-3 font-size-18 visible-xs text-right" style="padding-top:3px;">Status : </label>
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-6" style="padding-top:3px; padding-left:15px;">
      <?php if($user->active == 1) : ?>
        <label class="font-size-18 green">Active</label>
      <?php else : ?>
        <label class="font-size-18 red">Inactive</label>
      <?php endif; ?>
    </label>
	</div>
</form>

<script src="<?php echo base_url(); ?>scripts/users/users.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
