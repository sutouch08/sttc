<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<p class="pull-right top-p">
			<?php if($this->pm->can_add OR $this->pm->can_edit) : ?>
			<button type="button" class="btn btn-xs btn-primary" onclick="loadWorkList()"><i class="fa fa-download"></i> Load Work list</button>
			<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>PEA No.</label>
			<input type="text" class="form-control input-sm search-box" name="pea_no" value="<?php echo $pea_no; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>CA No.</label>
			<input type="text" class="form-control input-sm search-box" name="ca_no" value="<?php echo $ca_no; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>Customer No.</label>
			<input type="text" class="form-control input-sm search-box" name="cust_no" value="<?php echo $cust_no; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>Customer</label>
			<input type="text" class="form-control input-sm search-box" name="cust_name" value="<?php echo $cust_name; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>Phone</label>
			<input type="text" class="form-control input-sm search-box" name="cust_tel" value="<?php echo $cust_tel; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>Route</label>
			<input type="text" class="form-control input-sm search-box" name="cust_route" value="<?php echo $cust_route; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>Plan Name</label>
			<input type="text" class="form-control input-sm search-box" name="plan_table_name" value="<?php echo $plan_table_name; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<label>เขต/พื้นที่</label>
			<select class="form-control input-sm" name="team_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="null" <?php echo is_selected('null', $team_id); ?>>ไม่ระบุ</option>
				<?php echo select_team($team_id); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
	    <label>วันที่</label>
	    <div class="input-daterange input-group">
	      <input type="text" class="form-control input-sm text-center width-50 from-date" name="from_date" id="fromDate" value="<?php echo $from_date; ?>" />
	      <input type="text" class="form-control input-sm text-center width-50" name="to_date" id="toDate" value="<?php echo $to_date; ?>" />
	    </div>
	  </div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
		</div>
		<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
		</div>
	</div>
</form>
<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-8">
		<select class="form-control" id="team-list">
			<option value="">เลือกเขต</option>
			<option value="null">ไม่ระบุ</option>
			<?php echo select_team(); ?>
		</select>
	</div>
	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4">
		<button type="button" class="btn btn-sm btn-primary btn-block" onclick="addToTeam()">แบ่งเขต</button>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:1450px;;">
			<thead>
				<tr>
					<th class="fix-width-60 text-center">#</th>
					<th class="fix-width-40 text-center">
						<label>
							<input type="checkbox" class="ace" id="chk-all" onclick="checkAll()" />
							<span class="lbl"></span>
						</label>
					</th>
					<th class="fix-width-120">เขต/พื้นที่</th>
					<th class="fix-width-120">PEA No</th>
					<th class="fix-width-100 ">CA No</th>
					<th class="fix-width-100 ">Route</th>
					<th class="fix-width-100 ">Cust. No</th>
					<th class="fix-width-150 ">Cust. Name</th>
					<th class="fix-width-200 ">Address</th>
					<th class="fix-width-100 ">Phone</th>
					<th class="fix-width-150 ">Plan Name</th>
					<th class="fix-width-100 ">Create at</th>
					<th class="fix-width-150 ">Update at</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr>
					<td class="text-center no"><?php echo $no; ?></td>
					<td class="text-center">
						<?php if(empty($rs->is_loaded)) : ?>
							<label>
								<input type="checkbox" class="ace chk" value="<?php echo $rs->id; ?>">
								<span class="lbl"></span>
							</label>
						<?php endif; ?>
					</td>
					<td class=""><?php echo (empty($rs->team_id) ? "ไม่ระบุ" : (empty($team[$rs->team_id]) ? "" : $team[$rs->team_id])); ?></td>
					<td class=""><?php echo $rs->pea_no; ?></td>
					<td class=""><?php echo $rs->ca_no; ?></td>
					<td class=""><?php echo $rs->cust_route; ?></td>
					<td class=""><?php echo $rs->cust_no; ?></td>
					<td class=""><?php echo $rs->cust_name; ?></td>
					<td class=""><?php echo $rs->cust_address; ?></td>
					<td class=""><?php echo $rs->cust_tel; ?></td>
					<td class=""><?php echo $rs->Plan_TableName; ?></td>
					<td class=""><?php echo thai_date($rs->CreatedDate, FALSE); ?></td>
					<td class=""><?php echo thai_date($rs->date_upd, TRUE);?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>




<script src="<?php echo base_url(); ?>scripts/admin/work_plan.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
