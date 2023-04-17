<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>เลขที่</label>
			<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>พนักงาน</label>
			<select class="form-control input-sm" name="user_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<?php echo select_outsource($user_id); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 margin-bottom-5">
			<label>คลังต้นทาง</label>
			<select class="form-control input-sm" name="fromWhsCode" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<?php echo select_warehouse($fromWhsCode); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 margin-bottom-5">
			<label>คลังปลายทาง</label>
			<select class="form-control input-sm" name="toWhsCode" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="null">ไม่ระบุ</option>
				<?php echo select_warehouse($toWhsCode); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>เขต/พื้นที่</label>
			<select class="form-control input-sm" name="team_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
				<?php echo select_team($team_id); ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>Status</label>
			<select class="form-control input-sm" name="status" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
					<option value="-1" <?php echo is_selected('-1', $status); ?>>ดราฟ</option>
					<option value="0" <?php echo is_selected('0', $status); ?>>รอยืนยัน</option>
					<option value="10" <?php echo is_selected('10', $status); ?>>รออนุมัติ</option>
					<option value="11" <?php echo is_selected('11', $status); ?>>สำเร็จ</option>
					<option value="2" <?php echo is_selected('2', $status); ?>>ยกเลิก</option>
					<option value="3" <?php echo is_selected('3', $status); ?>>ผิดพลาด</option>
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
	<div class="col-lg-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:1400px;;">
			<thead>
				<tr>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-120 middle text-center" style="min-width:120px; max-width:120px;"></th>
					<th class="fix-width-80 middle text-center">สถานะ</th>
					<th class="fix-width-100 middle text-center" style="min-width:100px; max-width:100px;">วันที่</th>
					<th class="fix-width-120 middle" style="min-width:120px; max-width:120px;">เลขที่</th>
					<th class="fix-width-100 middle">ผู้ทำรายการ</th>
					<th class="fix-width-200 middle">คลังต้นทาง</th>
          <th class="fix-width-200 middle">คลังปลายทาง</th>
					<th class="min-width-150 middle">เขต/พื้นที่</th>
					<th class="fix-width-100 middle">SAP No.</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>">
					<td class="middle text-center" id="no-<?php echo $rs->id; ?>"><?php echo $no; ?></td>
					<td class="middle">
						<button type="button" class="btn btn-mini btn-primary" onclick="viewDetail(<?php echo $rs->id; ?>)"><i class="fa fa-eye"></i></button>
						<?php if(($rs->status == 0 OR ($rs->status == 1 && $rs->is_approve == 0)) && $this->pm->can_edit) : ?>
							<button type="button" class="btn btn-mini btn-warning" onclick="edit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center"><?php echo statusLabel($rs->status, $rs->is_approve); ?></td>
					<td class="middle text-center"><?php echo thai_date($rs->date_add, FALSE); ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle"><?php echo $rs->uname; ?></td>
					<td class="middle"><?php echo $rs->whsCode.' : '.$rs->fromWhsName; ?></td>
          <td class="middle"><?php echo empty($rs->toWhsCode) ? "ไม่ระบุ" : ($rs->toWhsCode .' : '.$rs->toWhsName); ?></td>
					<td class="middle"><?php echo $rs->team_name; ?></td>
					<td class="middle"><?php echo $rs->DocNum; ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<?php
function statuslabel($status , $is_approve)
{
	if($status == -1)
	{
		return '<span class="purple">ดราฟ</span>';
	}

	if($status == 0)
	{
		return '<span class="orange">รอยืนยัน</span>';
	}

	if($status == 2)
	{
		return '<span class="red">ยกเลิก</span>';
	}

	if($status == 3)
	{
		return '<span class="red">Failed</span>';
	}

	if($status == 1 && $is_approve == 0)
	{
		return '<span class="blue">รออนุมัติ</span>';
	}

	if($status == 1 && $is_approve == 1)
	{
		return '<span class="green">สำเร็จ</span>';
	}

	return '<span class="dark">Unknow</span>';
}
?>

<script src="<?php echo base_url(); ?>scripts/inventory/return/return.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
