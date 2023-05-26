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
      <button type="button" class="btn btn-sm btn-success" onclick="sync()"><i class="fa fa-refresh"></i> Update</button>
		<?php endif; ?>
    </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4">
    <label>PK ID</label>
    <input type="text" class="form-control input-sm search-box" name="pk_id" value="<?php echo $pk_id; ?>" />
  </div>


	<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4">
    <label>Reason ID</label>
    <input type="text" class="form-control input-sm search-box" name="reason_id" value="<?php echo $reason_id; ?>" />
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4">
    <label>Title</label>
    <input type="text" class="form-control input-sm search-box" name="title" value="<?php echo $title; ?>" />
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

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1">
			<thead>
				<tr>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-100 middle text-center">PK ID</th>
					<th class="fix-width-100 middle text-center">Reason ID</th>
					<th class="fix-width-200 middle">Title</th>
					<th class="fix-width-200 middle">Description</th>
					<th class="min-width-100 middle text-right">Last Update</th>
				</tr>
			</thead>
			<tbody id="list-table">
<?php if(!empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->pk_id; ?>">
					<td class="middle text-center no"><?php echo $no; ?></td>
					<td class="middle text-center"><?php echo $rs->pk_id; ?></td>
					<td class="middle text-center"><?php echo $rs->reason_id; ?></td>
					<td class="middle"><?php echo $rs->title; ?></td>
					<td class="middle"><?php echo $rs->description; ?></td>
					<td class="middle text-right"><?php echo thai_date($rs->date_upd, TRUE); ?></td>
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
       <h4 class="modal-title">เพิ่ม สาเหตุการชำรุด</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="padding-left:12px; padding-right:12px;">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>สาเหตุการชำรุด</label>
						<input type="text" id="add-name" class="form-control" maxlength="100"	autofocus required />
						<div class="err-label" id="add-name-error"></div>
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
       <h4 class="modal-title">แก้ไข สาเหตุการชำรุด</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="padding-left:12px; padding-right:12px;">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>สาเหตุการชำรุด</label>
						<input type="text" id="edit-name" class="form-control" maxlength="100" autofocus required />
						<div class="err-label" id="edit-name-error"></div>
            <input type="hidden" id="edit-id"/>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label style="margin-top:7px; padding-left:10px;">
							<input type="checkbox" class="ace" id="edit-active" checked />
							<span class="lbl">&nbsp; Active</span>
						</label>
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


<script src="<?php echo base_url(); ?>scripts/admin/meter_cond.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
