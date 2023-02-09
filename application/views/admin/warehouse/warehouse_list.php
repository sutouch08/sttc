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
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
    <label>Code</label>
    <input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
  </div>

  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
    <label>name</label>
    <input type="text" class="form-control input-sm search-box" name="name" value="<?php echo $name; ?>" />
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

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:780px;">
			<thead>
				<tr>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-100 middle">Code</th>
					<th class="fix-width-300 middle">Name</th>
					<th class="fix-width-80 middle text-center">Listed</th>
					<th class="fix-width-80 middle text-center">Active</th>
					<th class="min-width-150 middle">Last_sync</th>
				</tr>
			</thead>
			<tbody id="list-table">
<?php if(!empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>">
					<td class="middle text-center no"><?php echo $no; ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
          <td class="middle"><?php echo $rs->name; ?></td>
					<td class="middle text-center">
						<label>
							<input type="checkbox" class="ace" id="chk-<?php echo $rs->id; ?>" onchange="updateListed(<?php echo $rs->id; ?>)" <?php echo is_checked('1', $rs->listed); ?> />
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

<script src="<?php echo base_url(); ?>scripts/admin/warehouse.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
