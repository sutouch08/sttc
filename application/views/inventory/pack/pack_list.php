<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs padding-5">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<?php if($this->pm->can_add && ! empty($this->_user->team_id) && ! empty($this->_user->fromWhsCode)) : ?>
				<button type="button" class="btn btn-sm btn-success btn-100" onclick="addNew(1)"><i class="fa fa-plus"></i> เพิ่ม (1เฟส)</button>
				<button type="button" class="btn btn-sm btn-primary btn-100" onclick="addNew(3)"><i class="fa fa-plus"></i> เพิ่ม (3เฟส)</button>
			<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>" autocomplete="off">
	<div class="row">
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
			<label>เลขที่</label>
			<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
		</div>

		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
			<label>Reference</label>
			<input type="text" class="form-control input-sm search-box" name="reference" value="<?php echo $reference; ?>" />
		</div>

		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
			<label>User</label>
			<select class="form-control input-sm filter" name="user">
				<option value="all">ทั้งหมด</option>
				<?php echo select_user($user); ?>
			</select>
		</div>
<?php if(empty($this->_user->team_id)) : ?>
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
			<label>เขต</label>
			<select class="form-control input-sm filter" name="area">
				<option value="all">ทั้งหมด</option>
				<?php echo select_area($area); ?>
			</select>
		</div>
<?php endif; ?>

		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
			<label>คลัง</label>
			<select class="form-control input-sm filter" name="warehouse">
				<option value="all">ทั้งหมด</option>
				<?php echo select_listed_warehouse($warehouse); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label>สถานะ</label>
			<select class="form-control input-sm filter" name="status">
				<option value="all">ทั้งหมด</option>
				<option value="O" <?php echo is_selected('O', $status); ?>>Open</option>
				<option value="F" <?php echo is_selected('F', $status); ?>>Finished</option>
				<option value="C" <?php echo is_selected('C', $status); ?>>Closed</option>
				<option value="D" <?php echo is_selected('D', $status); ?>>Cancelled</option>
				<option value="S" <?php echo is_selected('S', $status); ?>>โอนแล้ว</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label>เฟส</label>
			<select class="form-control input-sm filter" name="phase">
				<option value="all">ทั้งหมด</option>
				<option value="1" <?php echo is_selected('1', $phase); ?>>1</option>
				<option value="3" <?php echo is_selected('3', $phase); ?>>3</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
	    <label>วันที่</label>
	    <div class="input-daterange input-group">
	      <input type="text" class="form-control input-sm text-center width-50 from-date" name="from_date" id="fromDate" value="<?php echo $from_date; ?>" />
	      <input type="text" class="form-control input-sm text-center width-50" name="to_date" id="toDate" value="<?php echo $to_date; ?>" />
	    </div>
	  </div>

		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
		</div>
		<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 margin-bottom-5">
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
		<table class="table table-hover border-1" style="min-width:1000px;">
			<thead>
				<tr>
					<th class="fix-width-80 middle"></th>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-100 middle">วันที่</th>
					<th class="fix-width-100 middle">เลขที่</th>
					<th class="fix-width-60 middle text-center">เฟส</th>
					<th class="fix-width-80 middle">เขต</th>
					<th class="min-width-150 middle">คลัง</th>
					<th class="fix-width-80 middle text-center">จำนวน</th>
					<th class="fix-width-80 middle">สถานะ</th>
					<th class="fix-width-100 middle">User</th>
					<th class="fix-width-100 middle text-center">Reference</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php
				$color = array(
					'O' => '',
					'F' => 'color:#428bca;',
					'C' => 'color:#87b87f;',
					'D' => 'color:red;'
				);
	 ?>
	<?php foreach($data as $rs) : ?>

				<tr style="<?php echo $color[$rs->status]; ?>">
					<td class="middle">
						<button type="button" class="btn btn-mini btn-info" onclick="viewDetail(<?php echo $rs->id; ?>)"><i class="fa fa-eye"></i></button>
						<?php if($rs->status == 'O' && $this->pm->can_edit) : ?>
							<button type="button" class="btn btn-mini btn-warning" onclick="goEdit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center no"><?php echo $no; ?></td>
					<td class="middle"><?php echo thai_date($rs->date_add); ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle text-center"><?php echo $rs->phase; ?></td>
					<td class="middle"><?php echo area_name($rs->team_id); ?></td>
					<td class="middle"><?php echo $rs->WhsCode .' : '.warehouse_name($rs->WhsCode); ?></td>
					<td class="middle text-center"><?php echo sum_pack_qty($rs->id); ?></td>
					<td class="middle">
						<?php if($rs->status == 'C' && $rs->DocEntry) : ?>
							โอนแล้ว
						<?php elseif($rs->status == 'C' && empty($rs->DocEntry)) : ?>
							Closed
						<?php elseif($rs->status == 'O') : ?>
							Open
						<?php elseif($rs->status== 'F') : ?>
							Finished
						<?php elseif($rs->status == 'D') : ?>
							Cancelled
						<?php endif; ?>
					</td>
					<td class="middle"><?php echo display_name($rs->user); ?></td>
					<td class="middle text-center"><?php echo $rs->transfer_code; ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>


<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
