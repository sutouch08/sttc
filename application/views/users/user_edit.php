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
			<select class="form-control" id="ugroup" onchange="toggleArea()">
        <option value="">Please Select</option>
				<?php echo select_ugroup($user->ugroup); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="ugroup-error"></div>
	</div>


  <div class="form-group <?php echo ($user->ugroup == 3 ? '' : 'hide'); ?>" id="team-table">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Area</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="team_id" onchange="getTeamGroupList()">
				<option value="">-ไม่ระบุ-</option>
      <?php echo select_team($user->team_id); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="team-error"></div>
  </div>

	<div class="form-group <?php echo ($user->ugroup == 3 ? '' : 'hide'); ?>" id="team-group-table">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">ทีมติดตั้ง</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="group_id" onchange="validTeamGroup()">
				<option value="">-ไม่ระบุ-</option>
			<?php if( ! empty($teamGroup)) : ?>
				<?php foreach($teamGroup as $g_id => $g_name) : ?>
					<option value="<?php echo $g_id; ?>" <?php echo is_selected($user->team_group_id, $g_id); ?>><?php echo $g_name; ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="team-group-error"></div>
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
  

	<div class="form-group <?php echo ($user->ugroup == 3 ? '' : 'hide'); ?>" id="get-meter-table">
		<label class="col-lg-3 col-md-3 col-sm-3 hidden-xs control-label"></label>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<label style="margin-top:7px; padding-left:10px;">
				<input type="checkbox" class="ace" id="can_get_meter" <?php echo is_checked($user->can_get_meter, '1'); ?> />
				<span class="lbl">&nbsp; สามารถเบิกมิเตอร์ได้</span>
			</label>
		</div>
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

<script id="group-template" type="text/x-handlebarsTemplate">
	<option value="">-ไม่ระบุ-</option>
	{{#each this}}
		<option value="{{id}}">{{name}}</option>
	{{/each}}
</script>

<script src="<?php echo base_url(); ?>scripts/users/users.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
