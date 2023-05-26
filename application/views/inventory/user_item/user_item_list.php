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
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>Item</label>
			<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>PEA No</label>
			<input type="text" class="form-control input-sm search-box" name="pea_no" value="<?php echo $pea_no; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>Serial</label>
			<input type="text" class="form-control input-sm search-box" name="serial" value="<?php echo $serial; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>DocNum</label>
			<input type="text" class="form-control input-sm search-box" name="docNum" value="<?php echo $docNum; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>เขต/พื้นที่</label>
			<select class="form-control input-sm search" name="team" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<?php echo select_team($team); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>ทีมติดตั้ง</label>
			<input type="text" class="form-control input-sm search-box" name="team_group" value="<?php echo $team_group; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 margin-bottom-5">
			<label>คลังสินค้า</label>
			<select class="form-control input-sm" name="fromWhCode" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<?php echo select_warehouse($whCode); ?>
			</select>
		</div>


		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>สถานะ</label>
			<select class="form-control input-sm" name="status" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="P" <?php echo is_selected('P', $status); ?>>รอติดตั้ง</option>
				<option value="I" <?php echo is_selected('I', $status); ?>>ติดตั้งแล้ว</option>
				<option value="A" <?php echo is_selected('A', $status); ?>>STTC อนุมัติแล้ว</option>
				<option value="R" <?php echo is_selected('R', $status); ?>>ต้องแก้ไข</option>
				<option value="W" <?php echo is_selected('W', $status); ?>>PEA กำลังตรวจสอบ</option>
				<option value="S" <?php echo is_selected('S', $status); ?>>PEA อนุมัติแล้ว</option>
				<option value="U" <?php echo is_selected('U', $status); ?>>PEA ไม่อนุมัติ</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 margin-bottom-5">
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
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:1310px;;">
			<thead>
				<tr>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-80 middle text-center">สถานะ</th>
					<th class="fix-width-120 middle">ทีมติดตั้ง</th>
					<th class="fix-width-120 middle">เขต/พื้นที่</th>
					<th class="fix-width-150 middle">PEA No</th>
					<th class="fix-width-150 middle">ซีเรียล</th>
					<th class="fix-width-150 middle">รหัสสินค้า</th>
					<th class="fix-width-200 middle">ชื่อสินค้า</th>
					<th class="fix-width-100 middle">เลขที่เอกสาร</th>
					<th class="fix-width-100 middle">คลังสินค้า</th>
          <th class="fix-width-100 middle">วันที่เพิ่ม</th>
					<th class="fix-width-100 middle">Update</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>" style="<?php echo status_color($rs->status); ?>">
					<td class="middle text-center" id="no-<?php echo $rs->id; ?>"><?php echo $no; ?></td>
					<td class="middle text-center"><?php echo status_text($rs->status); ?></td>
					<td class="middle"><?php echo $rs->team_group_name; ?></td>
					<td class="middle"><?php echo $rs->team_name; ?></td>
					<td class="middle"><?php echo $rs->pea_no; ?></td>
					<td class="middle"><?php echo $rs->serial; ?></td>
					<td class="middle"><?php echo $rs->ItemCode; ?></td>
					<td class="middle"><?php echo $rs->ItemName; ?></td>
					<td class="middle"><?php echo $rs->DocNum; ?></td>
					<td class="middle"><?php echo $rs->WhsCode; ?></td>
					<td class="middle"><?php echo thai_date($rs->date_add, FALSE); ?></td>
					<td class="middle"><?php echo thai_date($rs->date_upd, FALSE);?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>


<script src="<?php echo base_url(); ?>scripts/inventory/user_item/user_item.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
