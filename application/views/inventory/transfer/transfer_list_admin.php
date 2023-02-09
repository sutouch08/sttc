<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row">
		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
			<label>Doc No.</label>
			<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
			<label>SAP No.</label>
			<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $docNum; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2-harf col-xs-6">
			<label>From Warehouse</label>
			<input type="text" class="form-control input-sm search-box" name="fromWhCode" value="<?php echo $fromWhCode; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2-harf col-xs-6">
			<label>To Warehouse</label>
			<input type="text" class="form-control input-sm search-box" name="toWhCode" value="<?php echo $toWhCode; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
			<label>เขต/พื้นที่</label>
			<select class="form-control input-sm" name="team_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
					<?php echo select_team($team_id); ?>
				</select>
			</div>

			<div class="col-lg-1 col-md-1 col-sm-2 col-xs-6">
				<label>Status</label>
				<select class="form-control input-sm" name="status" onchange="getSearch()">
					<option value="all">ทั้งหมด</opton>
						<option value="-1" <?php echo is_selected('-1', $status); ?>>Draft</option>
						<option value="1" <?php echo is_selected('1', $status); ?>>Success</option>
						<option value="2" <?php echo is_selected('2', $status); ?>>Cancelled</option>
						<option value="3" <?php echo is_selected('3', $status); ?>>Failed</option>
					</select>
				</div>

				<div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-3">
					<label class="display-block not-show">buton</label>
					<button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-3">
					<label class="display-block not-show">buton</label>
					<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
				</div>
			</div>
		</form>
<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:1000px;;">
			<thead>
				<tr>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-60 middle text-center">Status</th>
					<th class="fix-width-100 middle">Doc No.</th>
					<th class="fix-width-100 middle">SAP No.</th>
					<th class="fix-width-200 middle">From Warehouse</th>
          <th class="fix-width-200 middle">To Warehouse</th>
					<th class="fix-width-150 middle text-center">Area</th>
					<th class="fix-width-100 middle text-center">User</th>
				</tr>
			</thead>
			<tbody>
<?php if(!empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>" onclick="edit(<?php echo $rs->id; ?>)">
					<td class="middle text-center"><?php echo $no; ?></td>
					<td class="middle text-center"><?php echo transfer_status_label($rs->status); ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle"><?php echo $rs->docNum; ?></td>
					<td class="middle"><?php echo $rs->fromWhsCode.' : '.$rs->fromWhsName; ?></td>
          <td class="middle"><?php echo $rs->toWhsCode .' : '.$rs->toWhsName; ?></td>
					<td class="middle text-center"><?php echo $rs->team_name; ?></td>
					<td class="middle text-center"><?php echo $rs->uname; ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
