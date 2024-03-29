<?php $this->load->view('include/header'); ?>
<?php
	$pm = get_permission('OPWHTR', $this->_user->id);
?>
<div class="row">
	<div class="col-lg-2 col-md-12 col-sm-12 hidden-xs">
    <h3 class="title"> <?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
	<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
    <p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning top-btn" onclick="goBack()"><i class="fa fa-arrow-left"></i> กลับ</button>
			<?php if(empty($doc->DocEntry)) : ?>
			<button type="button" class="btn btn-sm btn-purple top-btn" onclick="updateInstallData()">Update ข้อมูลสับเปลี่ยน</button>
			<?php endif; ?>
			<?php if($doc->status != 'O' && $doc->status != 'D') : ?>
				<?php if($pm->can_add && $doc->status == 'F' && getConfig('ALLOW_CREATE_TRANSFER_FROM_PACK_LIST')) : ?>
					<button type="button" class="btn btn-sm btn-success top-btn" onclick="createTransfer()">สร้างใบโอนสินค้า</button>
				<?php endif; ?>
				<?php if($doc->status == 'F' && $this->pm->can_edit) : ?>
					<button type="button" class="btn btn-sm btn-warning top-btn" onclick="unFinished()">ยกเลิกการบันทึก</button>
				<?php endif; ?>
				<?php if($doc->status != 'D' && $doc->status != 'C' && $this->pm->can_delete) : ?>
					<button type="button" class="btn btn-sm btn-danger top-btn" onclick="cancelPack()">ยกเลิก</button>
				<?php endif; ?>
				<button type="button" class="btn btn-sm btn-info top-btn" onclick="printPackList()">พิมพ์ใบปะหน้า(รวม)</button>
				<button type="button" class="btn btn-sm btn-info top-btn" onclick="printSplitPackList()">พิมพ์ใบปะหน้า(ซอย)</button>
			<?php endif; ?>
		</p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
<div class="row">
  <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4">
    <label>เลขที่</label>
    <input type="text" class="form-control text-center" id="code" value="<?php echo $doc->code; ?>" disabled/>
  </div>
  <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-4">
    <label>วันที่</label>
    <input type="text" class="form-control text-center" id="date_add" value="<?php echo thai_date($doc->date_add, FALSE); ?>" readonly disabled/>
  </div>
	<div class="col-lg-2-harf col-md-1-harf col-sm-1-harf col-xs-4">
		<label>เขต</label>
		<input type="text" class="form-control" id="area" value="<?php echo area_name($doc->team_id); ?>" disabled />
	</div>

	<div class="col-lg-2-harf col-md-3-harf col-sm-3-harf col-xs-4">
		<label>คลัง</label>
		<input type="text" class="form-control" id="WhsCode" value="<?php echo $doc->WhsCode.' : '.warehouse_name($doc->WhsCode); ?>" disabled />
	</div>

	<div class="col-lg-2 col-md-4 col-sm-3-harf col-xs-4">
		<label>พื้นที่</label>
		<select class="form-control edit" id="sub-area" disabled>
			<option value="">เลือกพื้นที่</option>
			<?php echo select_sub_area_team($doc->team_id, $doc->sub_area_id); ?>
		</select>
	</div>

	<div class="col-lg-2 col-md-2-harf col-sm-2 col-xs-4">
		<label>ผู้ทำรายการ</label>
		<input type="text" class="form-control" id="user" value="<?php echo display_name($doc->user); ?>" disabled />
	</div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4">
		<label>สี</label>
		<select class="form-control edit" id="color" disabled>
			<option value="">เลือกสี</option>
			<option value="Green" <?php echo is_selected($doc->color, 'Green'); ?>>สีเขียว</option>
			<option value="Blue" <?php echo is_selected($doc->color, 'Blue'); ?>>น้ำเงิน</option>
			<option value="Orange" <?php echo is_selected($doc->color, 'Orange'); ?>>ส้ม</option>
			<option value="Red" <?php echo is_selected($doc->color, 'Red'); ?>>แดง</option>
		</select>
	</div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4">
		<label>งวดที่</label>
		<input type="text" class="form-control text-center edit" id="period-no" value="<?php echo $doc->period_no; ?>" />
	</div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4">
		<label>ลังที่</label>
		<input type="text" class="form-control text-center edit" id="box-no" value="<?php echo $doc->box_no; ?>"/>
	</div>

	<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-4">
		<label>Reference</label>
		<input type="text" class="form-control text-center" value="<?php echo $doc->transfer_code; ?>" disabled />
	</div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4">
		<label>สถานะ</label>
		<input type="text" class="form-control text-center" value="<?php echo pack_status_label($doc->status); ?>" disabled />
	</div>

	<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4">
		<label>เฟส</label>
		<input type="text" class="form-control text-center" value="<?php echo $doc->phase; ?>" disabled />
	</div>

  <div class="col-lg-4-harf col-md-12 col-sm-12 col-xs-12">
    <label>Remark</label>
    <input type="text" class="form-control" name="remark" id="remark" maxlength="254" value="<?php echo $doc->remark; ?>" disabled/>
  </div>
	<div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-3">
		<label class="display-block not-show">u</label>
		<button type="button" class="btn btn-sm btn-primary btn-block" onclick="updateRemark()">Update</button>
	</div>
</div>

<?php if($doc->status == 'D') : ?>
	<?php $this->load->view('cancle_watermark'); ?>
<?php endif; ?>

<input type="hidden" id="pack_id" value="<?php echo $doc->id; ?>" />
<hr class="margin-bottom-10 margin-top-10"/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped border-1" style="min-width:900px;">
			<thead>
				<tr>
					<th class="fix-width-60 text-center">#</th>
          <th class="fix-width-100 text-center">วันที่สับเปลี่ยน</th>
					<th class="fix-width-150">PEA NO(เก่า)</th>
					<th class="fix-width-150">PEA NO(ใหม่)</th>
					<th class="fix-width-100 text-center">เฟส</th>
					<th class="fix-width-100 text-center">ขนาด</th>
          <th class="fix-width-150 text-center">หน่วย (kWh)</th>
          <th class="fix-width-100 text-center">อายุ (ปี)</th>
          <th class="min-width-100">การชำรุด</th>
				</tr>
			</thead>
			<tbody id="row-table">
				<?php if(!empty($details)) : ?>
					<?php $no = 1; ?>
					<?php foreach($details as $rs) : ?>
						<tr id="row-<?php echo $rs->id; ?>">
							<td class="middle text-center no"><?php echo $no; ?></td>
              <td class="middle text-center"><?php echo thai_date($rs->work_date, FALSE); ?></td>
              <td class="middle pea-no"><?php echo $rs->u_pea_no; ?></td>
							<td class="middle"><?php echo $rs->i_pea_no; ?></td>
              <td class="middle text-center"><?php echo $rs->phase; ?></td>
              <td class="middle text-center"><?php echo $rs->meter_size; ?></td>
							<td class="middle text-center"><?php echo $rs->meter_read_end; ?></td>
							<td class="middle text-center"><?php echo $rs->meter_age; ?></td>
							<td class="middle"><?php echo $rs->dispose_reason_name; ?></td>
						</tr>
						<?php $no++; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 grey hidden-xs" style="position:absolute; bottom:0px;">
	** "เขต" และ "คลัง" ไม่สามารถแก้ไขได้ เนื่องจากถูกผูกไว้กับ User name ของผู้ทำรายการ
</div>
<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/pack/pack_add.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
