<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding-5">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding-5">
  	<p class="pull-right top-p">
      <button type="button" class="btn btn-sm btn-success" onclick="addNew()"><i class="fa fa-plus"></i> Add new</button>
    </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
    <label>ชื่อผู้ใช้งาน</label>
    <input type="text" class="form-control input-sm search-box" name="uname" value="<?php echo $uname; ?>" />
  </div>

  <div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
    <label>ชื่อพนักงาน</label>
    <input type="text" class="form-control input-sm search-box" name="dname" value="<?php echo $dname; ?>" />
  </div>

	<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
		<label>เขต</label>
		<select class="form-control input-sm filter" name="team_id">
			<option value="all">ทั้งหมด</option>
			<option value="NULL" <?php echo is_selected($team_id, "NULL"); ?>>-ไม่ระบุ-</option>
			<?php echo select_team($team_id); ?>
		</select>
	</div>

	<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
		<label>คลังสำเร็จ</label>
		<select class="form-control input-sm filter" name="fromWhs">
			<option value="all">ทั้งหมด</option>
			<option value="NULL" <?php echo is_selected($fromWhs, "NULL"); ?>>-ไม่ระบุ-</option>
			<?php echo select_listed_warehouse_by_role(2, $fromWhs); ?>
		</select>
	</div>

	<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
		<label>คลังลงลัง</label>
		<select class="form-control input-sm filter" name="toWhs">
			<option value="all">ทั้งหมด</option>
			<option value="NULL" <?php echo is_selected($toWhs, "NULL"); ?>>-ไม่ระบุ-</option>
			<?php echo select_listed_warehouse_by_role(3, $toWhs); ?>
		</select>
	</div>

	<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
		<label>กลุ่มผู้ใช้งาน</label>
		<select class="form-control input-sm" name="ugroup" onchange="getSearch()">
			<option value="all">ทั้งหมด</option>
			<option value="1" <?php echo is_selected('1', $ugroup); ?>>User</option>
			<option value="2" <?php echo is_selected('2', $ugroup); ?>>Admin</option>
		</select>
	</div>

	<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6">
    <label>Status</label>
		<select class="form-control input-sm" name="active" onchange="getSearch()">
			<option value="all">ทั้งหมด</opton>
			<option value="1" <?php echo is_selected('1', $active); ?>>Active</option>
			<option value="0" <?php echo is_selected('0', $active); ?>>Inactive</option>
		</select>
  </div>

  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3">
    <label class="display-block not-show">buton</label>
    <button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
  </div>
	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
  </div>
</div>
<hr class="margin-top-15">
</form>
<?php echo $this->pagination->create_links(); ?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" style="min-height:400px;">
		<table class="table table-hover table-bordered border-1" style="min-width:1020px;">
			<thead>
				<tr>
					<th class="fix-width-120">&nbsp;</th>
					<th class="fix-width-40 middle text-center">#</th>
					<th class="fix-width-150 middle">ชื่อผู้ใช้งาน</th>
					<th class="min-width-150 middle">ชื่อพนักงาน</th>
					<th class="fix-width-100 middle text-center">กลุ่มผู้ใช้งาน</th>
					<th class="fix-width-100 middle">เขต</th>
					<th class="fix-width-100 middle">คลังสำเร็จ</th>
					<th class="fix-width-100 middle">คลังลงลัง</th>
					<th class="fix-width-100 middle">Cut Off</th>
					<th class="fix-width-60 middle text-center">สถานะ</th>
				</tr>
			</thead>
			<tbody>
<?php if(!empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php $pno = count($data) - 3; ?>
	<?php $cno = 1; ?>
	<?php $dropup = ""; ?>
	<?php foreach($data as $rs) : ?>
		<?php $dropup = ($cno > $pno && $cno > 4) ? "dropup" : ""; ?>
				<tr>
					<td class="middle">
						<?php if($this->pm->can_add OR $this->pm->can_edit) : ?>
							<button type="button" class="btn btn-minier btn-purple" title="Reset password" onclick="getReset('<?php echo $rs->id; ?>')"><i class="fa fa-key"></i></button>
						<?php endif; ?>
						<?php if($this->pm->can_edit) : ?>
							<button type="button" class="btn btn-minier btn-warning" onclick="getEdit('<?php echo $rs->id; ?>')"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
						<?php if($this->pm->can_delete) : ?>
							<button type="button" class="btn btn-minier btn-danger" onclick="getDelete('<?php echo $rs->id; ?>', '<?php echo $rs->uname; ?>')"><i class="fa fa-trash"></i></button>
						<?php endif; ?>
						<?php if($can_edit_permission) : ?>
							<button type="button" class="btn btn-minier btn-primary" title="Permission" onclick="getPermission('<?php echo $rs->id; ?>')"><i class="fa fa-lock"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center"><?php echo $no; ?></td>
					<td class="middle"><?php echo $rs->uname; ?></td>
					<td class="middle"><?php echo $rs->display_name; ?></td>
					<td class="middle text-center"><?php echo $rs->group_name; ?></td>
					<td class="middle"><?php echo empty($rs->team_name) ? 'ไม่ระบุ' : $rs->team_name; ?></td>
					<td class="middle"><?php echo empty($rs->fromWhsCode) ? 'ไม่ระบุ' : $rs->fromWhsCode; ?></td>
					<td class="middle"><?php echo empty($rs->toWhsCode) ? 'ไม่ระบุ' : $rs->toWhsCode; ?></td>
					<td class="middle"><?php echo empty($rs->cut_off_date) ? 'ไม่ระบุ' : thai_date($rs->cut_off_date); ?></td>
					<td class="middle text-center"><?php echo is_active($rs->active); ?></td>
				</tr>
				<?php $no++; ?>
				<?php $cno++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script src="<?php echo base_url(); ?>scripts/users/users.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
