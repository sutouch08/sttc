<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
  	<p class="pull-right top-p">
      <button type="button" class="btn btn-sm btn-info" onclick="syncData()"><i class="fa fa-refresh"></i> Sync</button>
    </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
    <label>รหัส</label>
    <input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
  </div>

  <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
    <label>ชื่อคลัง</label>
    <input type="text" class="form-control input-sm search-box" name="name" value="<?php echo $name; ?>" />
  </div>

	<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
    <label>เขต</label>
    <select class="form-control input-sm filter" name="area">
			<option value="all">ทั้งหมด</option>
			<option value="NULL" <?php echo is_selected('NULL', $area); ?>>ไม่ระบุ</option>
			<?php echo select_area($area); ?>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
    <label>ประเภท</label>
		<select class="form-control input-sm filter" name="role">
			<option value="all">ทั้งหมด</option>
			<option value="NULL" <?php echo is_selected('NULL', $role); ?>>ไม่ระบุ</option>
			<option value="0" <?php echo is_selected('0', $role); ?>>คลังรอเบิก</option>
			<option value="1" <?php echo is_selected('1', $role); ?>>คลังเบิก</option>
			<option value="2" <?php echo is_selected('2', $role); ?>>คลังสำเร็จ</option>
			<option value="3" <?php echo is_selected('3', $role); ?>>คลังลงลัง</option>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6">
    <label>Listed</label>
		<select class="form-control input-sm" name="listed" onchange="getSearch()">
			<option value="all">ทั้งหมด</opton>
			<option value="1" <?php echo is_selected('1', $listed); ?>>Yes</option>
			<option value="0" <?php echo is_selected('0', $listed); ?>>No</option>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-6">
    <label>Status</label>
		<select class="form-control input-sm" name="status" onchange="getSearch()">
			<option value="all">ทั้งหมด</opton>
			<option value="1" <?php echo is_selected('1', $status); ?>>Active</option>
			<option value="0" <?php echo is_selected('0', $status); ?>>Inactive</option>
		</select>
  </div>


  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-6">
    <label class="display-block not-show">buton</label>
    <button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
  </div>
	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-6">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
  </div>
</div>
<hr class="margin-top-15">
</form>
<?php echo $this->pagination->create_links(); ?>
<?php $role_name = array('0' => 'รอเบิก', '1' => 'เบิก', '2' => 'สำเร็จ', '3' => 'ลงลัง'); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:780px;">
			<thead>
				<tr>
					<th class="fix-width-40 middle text-center"></th>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-100 middle">รหัสคลัง</th>
					<th class="fix-width-150 middle">ชื่อคลัง</th>
					<th class="fix-width-100 middle">เขต</th>
					<th class="fix-width-100 middle">ประเภท</th>
					<th class="fix-width-80 middle text-center">Listed</th>
					<th class="fix-width-80 middle text-center">Active</th>
					<th class="min-width-150 middle">Last_sync</th>
				</tr>
			</thead>
			<tbody id="list-table">
<?php if(!empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php $active = $this->pm->can_edit ? '' : 'disabled'; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>">
					<td class="middle">
						<?php if($this->pm->can_edit) : ?>
							<button type="button" class="btn btn-mini btn-warning" onclick="getEdit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center no"><?php echo $no; ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
          <td class="middle"><?php echo $rs->name; ?></td>
					<td class="middle" id="area-<?php echo $rs->id; ?>"><?php echo $rs->area_name === NULL ? 'ไม่ระบุ' : $rs->area_name; ?></td>
					<td class="middle" id="role-<?php echo $rs->id; ?>"><?php echo $rs->role === NULL ? 'ไม่ระบุ' : $role_name[$rs->role]; ?></td>
					<td class="middle text-center">
						<label>
							<input type="checkbox" class="ace" id="chk-<?php echo $rs->id; ?>" onchange="updateListed(<?php echo $rs->id; ?>)" <?php echo is_checked('1', $rs->listed); ?> <?php echo $active; ?>/>
							<span class="lbl"></span>
						</label>
					</td>
					<td class="middle text-center"><?php echo is_active($rs->status); ?></td>
					<td class="middle"><?php echo thai_date($rs->last_sync, TRUE); ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
   <div class="modal-content">
       <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title">แก้ไข คลัง</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="padding-left:12px; padding-right:12px;">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>รหัสคลัง</label>
						<input type="text" id="edit-code" class="form-control" maxlength="8" disabled/>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<label>ชื่อคลัง</label>
						<input type="text" id="edit-name" class="form-control" disabled />
            <input type="hidden" id="edit-id"/>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
						<label>เขต</label>
						<select class="form-control" id="edit-area">
							<option value="">ไม่ระบุ</option>
							<?php echo select_area(); ?>
						</select>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
						<label>ประเภท</label>
						<select class="form-control" id="edit-role">
							<option value="">ไม่ระบุ</option>
							<option value="0">คลังรอเบิก</option>
							<option value="1">คลังเบิก</option>
							<option value="2">คลังสำเร็จ</option>
							<option value="3">คลังลงลัง</option>
						</select>
					</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default btn-100" onclick="closeModal('edit-modal')">Close</button>
				<button type="button" id="btn-update" class="btn btn-sm btn-success btn-100" onclick="update()">Update</button>
      </div>
   </div>
 </div>
</div>

<script src="<?php echo base_url(); ?>scripts/admin/warehouse.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
