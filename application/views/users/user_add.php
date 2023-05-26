<?php $this->load->view('include/header'); ?>
<script>
	var USE_STRONG_PWD = <?php echo getConfig('USE_STRONG_PWD'); ?>;
</script>

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
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">ชื่อผู้ใช้งาน</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<input type="text" name="uname" id="uname"
			class="form-control" maxlength="50"
			onkeyup="validCode(this)"
			placeholder="Allow &nbsp; a-z,  A-Z,  0-9,  &quot;-&quot;,  &quot;_&quot;,  &quot;.&quot;,  &quot;@&quot;"
			autofocus required />
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="uname-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">ชื่อพนักงาน</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<input type="text" name="dname" id="dname" class="form-control" maxlength="100" required />
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="dname-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">กลุ่มผู้ใช้งาน</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="ugroup" onchange="toggleArea()">
        <option value="">โปรดเลือก</option>
				<?php echo select_ugroup(); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="ugroup-error"></div>
	</div>


	<div class="form-group hide" id="team-table">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">เขต/พื้นที่</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="team_id" onchange="getTeamGroupList()">
				<option value="">-ไม่ระบุ-</option>
      <?php echo select_team(); ?>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="team-error"></div>
  </div>

	<div class="form-group hide" id="team-group-table">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">ทีมติดตั้ง</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<select class="form-control" id="group_id" onchange="validTeamGroup()">
				<option value="">-ไม่ระบุ-</option>
      </select>
    </div>
		<div class="col-xs-12 col-sm-reset inline red" id="team-group-error"></div>
  </div>

  <div class="form-group hide" id="area-table">
		<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label ">เขต/พื้นที่</label>
		<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="area-list" style="margin-top:10px; max-height:400px; overflow-y:auto;">
			<table class="table table-bordered border-1">
				<thead>
					<tr class="freez">
						<th class="fix-width-60 text-center outline">#</th>
						<th class="min-width-100 text-left outline">เขต/พื้นที่</th>
					</tr>
				</thead>
				<tbody>
				<?php if( ! empty($teamList)) : ?>
					<?php foreach($teamList as $rs) : ?>
						<tr>
							<td class="middle text-center">
								<label>
									<input type="checkbox" class="ace chk-area" data-id="<?php echo $rs->id; ?>" id="area-<?php echo $rs->id; ?>" value="<?php echo $rs->id; ?>" />
									<span class="lbl"></span>
								</label>
							</td>
							<td class="middle"><?php echo $rs->name; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr><td colspan="2" class="text-center">กรุณาระบุเขต/พื้นที่</td></tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12 col-sm-reset inline red" id="area-error"></div>
  </div>


	<div class="form-group hide" id="get-meter-table">
		<label class="col-lg-3 col-md-3 col-sm-3 hidden-xs control-label"></label>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<label style="margin-top:7px; padding-left:10px;">
				<input type="checkbox" class="ace" id="can_get_meter" />
				<span class="lbl">&nbsp; สามารถเบิกมิเตอร์ได้</span>
			</label>
		</div>
	</div>

	<div class="divider"></div>

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">รหัสผ่าน</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="input-icon input-icon-right width-100">
        <input type="password" name="pwd" id="pwd" class="form-control" required />
				<i class="ace-icon fa fa-key"></i>
			</span>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 red" id="pwd-error"></div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">ยืนยันรหัสผ่าน</label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<span class="input-icon input-icon-right width-100">
        <input type="password" name="cm-pwd" id="cm-pwd" class="form-control" required />
				<i class="ace-icon fa fa-key"></i>
			</span>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 red" id="cm-pwd-error"></div>
  </div>


	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 hidden-xs control-label"></label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<label style="margin-top:7px; padding-left:10px;">
				<input type="checkbox" class="ace" id="active" checked />
				<span class="lbl">&nbsp; Active</span>
			</label>
    </div>
  </div>

	<div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 hidden-xs control-label"></label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<label style="margin-top:7px; padding-left:10px;">
				<input type="checkbox" class="ace" id="force_reset" checked />
				<span class="lbl">&nbsp; บังคับผู้ใช้เปลี่ยนรหัสผ่าน</span>
			</label>
    </div>
  </div>


	<div class="divider-hidden"></div>

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"></label>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <p class="pull-right">
        <button type="button" class="btn btn-sm btn-success btn-100" onclick="saveAdd()">Add</button>
      </p>
    </div>
  </div>
</form>

<script id="group-template" type="text/x-handlebarsTemplate">
	<option value="">-ไม่ระบุ-</option>
	{{#each this}}
		<option value="{{id}}">{{name}}</option>
	{{/each}}
</script>

<script src="<?php echo base_url(); ?>scripts/users/users.js?v=<?php echo date('Ymd'); ?>"></script>
<?php $this->load->view('include/footer'); ?>
