<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding-5">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding-5">
  	<p class="pull-right top-p">
		<?php if($this->pm->can_add) : ?>
      <button type="button" class="btn btn-sm btn-success" onclick="addNew()"><i class="fa fa-plus"></i> Add new</button>
		<?php endif; ?>
    </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
    <label>พื้นที่</label>
    <input type="text" class="form-control input-sm search-box" name="name" value="<?php echo $name; ?>" />
  </div>

	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
    <label>เขต</label>
    <select class="form-control input-sm" name="team_id" onchange="getSearch()">
			<option value="all">ทั้งหมด</option>
			<?php echo select_area($team_id); ?>
		</select>
  </div>

	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
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
<input type="hidden" name="search" value="1" />
</form>
<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:920px;">
			<thead>
				<tr>
					<th class="fix-width-80"></th>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-100 middle">รหัส</th>
					<th class="fix-width-100 middle">พื้นที่</th>
					<th class="fix-width-100 middle">เขต</th>
					<th class="fix-width-80 middle text-center">สถานะ</th>
					<th class="fix-width-100 middle">สร้างเมื่อ</th>
					<th class="fix-width-100 middle">สร้างโดย</th>
					<th class="fix-width-100 middle">แก้ไขเมื่อ</th>
					<th class="min-width-100 middle">แก้ไขโดย</th>
				</tr>
			</thead>
			<tbody id="list-table">
<?php if(!empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>">
					<td class="">
						<?php if($this->pm->can_edit) : ?>
							<button type="button" class="btn btn-minier btn-warning" onclick="getEdit('<?php echo $rs->id; ?>')"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
						<?php if($this->pm->can_delete) : ?>
							<button type="button" class="btn btn-minier btn-danger" onclick="getDelete('<?php echo $rs->id; ?>', '<?php echo $rs->name; ?>')"><i class="fa fa-trash"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center no"><?php echo $no; ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle"><?php echo $rs->name; ?></td>
					<td class="middle"><?php echo $rs->team_name; ?></td>
					<td class="middle text-center"><?php echo is_active($rs->status); ?></td>
					<td class="middle"><?php echo thai_date($rs->create_at, FALSE); ?></td>
					<td class="middle"><?php echo uname($rs->create_by); ?></td>
					<td class="middle"><?php echo thai_date($rs->update_at, FALSE); ?></td>
					<td class="middle"><?php echo uname($rs->update_by); ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>


<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
   <div class="modal-content">
       <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title">เพิ่ม พื้นที่</h4>
      </div>
      <div class="modal-body">
				<div class="row" style="padding-left:12px; padding-right:12px;">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>ชื่อพื้นที่</label>
						<input type="text" id="add-name" class="form-control" maxlength="100"	required />
						<div class="err-label" id="add-name-error"></div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>รหัสพื้นที่(Route)</label>
						<input type="text" id="add-code" class="form-control" maxlength="4" placeholder="รหัส 4 ตัวหน้าของสายจดหน่วย"	required />
						<div class="err-label" id="add-code-error"></div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>เขต</label>
						<select class="form-control" id="add-team">
							<option value="">เลือก</option>
							<?php echo select_area(); ?>
						</select>
						<div class="err-label" id="add-team-error"></div>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label style="margin-top:7px; padding-left:10px;">
							<input type="checkbox" class="ace" id="add-active" checked />
							<span class="lbl">&nbsp; Active</span>
						</label>
					</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default btn-100" onclick="closeModal('add-modal')">Close</button>
				<button type="button" id="btn-add" class="btn btn-sm btn-success btn-100" onclick="saveAdd()">Add</button>

      </div>
   </div>
 </div>
</div>




<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
   <div class="modal-content">
       <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title">แก้ไข เขต/พื้นที่</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="padding-left:12px; padding-right:12px;">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>ชื่อพื้นที่</label>
						<input type="text" id="edit-name" class="form-control" maxlength="100"	required />
						<div class="err-label" id="edit-name-error"></div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>รหัสพื้นที่(Route)</label>
						<input type="text" id="edit-code" class="form-control" maxlength="4" placeholder="4 ตัวหน้ายองสายจดหน่วย" title="รหัส 4 ตัวหน้าของสายจดหน่วย"	required />
						<div class="err-label" id="edit-code-error"></div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<label>เขต</label>
						<select class="form-control" id="edit-team">
							<option value="">เลือก</option>
							<?php echo select_area(); ?>
						</select>
						<div class="err-label" id="edit-team-error"></div>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label style="margin-top:7px; padding-left:10px;">
							<input type="checkbox" class="ace" id="edit-active" checked />
							<span class="lbl">&nbsp; Active</span>
						</label>
					</div>
        </div>

				<input type="hidden" id="edit-id" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default btn-100" onclick="closeModal('edit-modal')">Close</button>
				<button type="button" id="btn-update" class="btn btn-sm btn-success btn-100" onclick="update()">Update</button>
      </div>
   </div>
 </div>
</div>


<script id="row-template" type="text/x-handlebarsTemplate">
<tr id="row-{{id}}">
	<td class="">
		<button type="button" class="btn btn-minier btn-warning" onclick="getEdit({{id}})"><i class="fa fa-pencil"></i></button>
		<button type="button" class="btn btn-minier btn-danger" onclick="getDelete({{id}}, '{{name}}')"><i class="fa fa-trash"></i></button>
	</td>
  <td class="middle text-center no">{{no}}</td>
	<td class="middle">{{code}}</td>
  <td class="middle">{{name}}</td>
	<td class="middle">{{team_name}}</td>
  <td class="middle text-center">{{{status}}}</td>
  <td class="middle">{{create_at}}</td>
  <td class="middle">{{create_by}}</td>
  <td class="middle">{{update_at}}</td>
  <td class="middle">{{update_by}}</td>
</tr>
</script>

<script id="in-row-template" type="text/x-handlebarsTemplate">
	<td class="">
		<button type="button" class="btn btn-minier btn-warning" onclick="getEdit({{id}})"><i class="fa fa-pencil"></i></button>
		<button type="button" class="btn btn-minier btn-danger" onclick="getDelete({{id}}, '{{name}}')"><i class="fa fa-trash"></i></button>
	</td>
	<td class="middle text-center no">{{no}}</td>
	<td class="middle">{{code}}</td>
  <td class="middle">{{name}}</td>
	<td class="middle">{{team_name}}</td>
  <td class="middle text-center">{{{status}}}</td>
  <td class="middle">{{create_at}}</td>
  <td class="middle">{{create_by}}</td>
  <td class="middle">{{update_at}}</td>
  <td class="middle">{{update_by}}</td>
</script>

<script src="<?php echo base_url(); ?>scripts/admin/sub_area.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
