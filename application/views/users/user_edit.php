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
<form class="form-horizontal" id="addForm" method="post">
	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Username</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<input type="text" name="uname" id="uname" class="form-control" maxlength="50" value="<?php echo $user->uname; ?>" disabled />
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="uname-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Display name</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<input type="text" name="dname" id="dname" class="form-control width-100" maxlength="100" value="<?php echo $user->name; ?>" />
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="dname-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">User Group</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="ugroup" onchange="toggleAreaAndWarehouse()">
        <option value="">Please Select</option>
				<?php echo select_ugroup($user->ugroup); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="ugroup-error"></div>
	</div>


  <div class="form-group <?php echo ($user->ugroup == 3 ? '' : 'hide'); ?>" id="team-table">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Area</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="team_id">
				<option value="">-ไม่ระบุ-</option>
      <?php echo select_team($user->team_id); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="team-error"></div>
  </div>

  <div class="form-group <?php echo ($user->ugroup == 2 ? '' : 'hide'); ?>" id="area-table">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">Area</label>
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
									<input type="checkbox" class="ace chk-area" value="<?php echo $rs->id; ?>" <?php echo $checked; ?> />
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

  <div class="form-group <?php echo ($user->ugroup == 3 ? '' : 'hide'); ?>" id="from-warehouse-table">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">From Warehouse</label>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="fromWhsCode">
				<option value="">-ไม่ระบุ-</option>
      <?php echo select_listed_warehouse($user->fromWhsCode); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="from-warehouse-error"></div>
  </div>

	<div class="form-group <?php echo ($user->ugroup == 3 ? '' : 'hide'); ?>" id="to-warehouse-table">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">To Warehouse</label>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="toWhsCode">
				<option value="">-ไม่ระบุ-</option>
      <?php echo select_listed_warehouse($user->toWhsCode); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="to-warehouse-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 hidden-xs control-label"></label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<label style="margin-top:7px; padding-left:10px;">
				<input type="checkbox" class="ace" id="active" <?php echo is_checked($user->active, '1'); ?> />
				<span class="lbl">&nbsp; Active</span>
			</label>
    </div>
  </div>

	<div class="divider-hidden"></div>

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"></label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <p class="pull-right">
        <button type="button" class="btn btn-sm btn-success btn-100" onclick="update()">Update</button>
      </p>
    </div>
  </div>

  <input type="hidden" id="user_id" value="<?php echo $user->id; ?>" />
</form>

<script src="<?php echo base_url(); ?>scripts/users/users.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
