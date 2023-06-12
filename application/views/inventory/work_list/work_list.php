<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>PEA No.</label>
			<input type="text" class="form-control input-sm search-box" name="pea_no" value="<?php echo $pea_no; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>CA No.</label>
			<input type="text" class="form-control input-sm search-box" name="ca_no" value="<?php echo $ca_no; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>ลูกค้า</label>
			<input type="text" class="form-control input-sm search-box" name="customer" value="<?php echo $customer; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>สายจดมิเตอร์</label>
			<input type="text" class="form-control input-sm search-box" name="cust_route" value="<?php echo $cust_route; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>ทีมติดตั้ง</label>
			<input type="text" class="form-control input-sm search-box" name="team_group" value="<?php echo $team_group; ?>" />
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>เขต</label>
			<select class="form-control input-sm" name="team_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<?php echo $myteam; ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>การมอบหมาย</label>
			<select class="form-control input-sm" name="assigned" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="1" <?php echo is_selected('1', $assigned); ?>>มอบหมายแล้ว</option>
				<option value="0" <?php echo is_selected('0', $assigned); ?>>ยังไม่มอบหมาย</option>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
			<label>สถานะ</label>
			<select class="form-control input-sm" name="status" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<option value="P" <?php echo is_selected('P', $status); ?>>รอสับเปลี่ยน</option>
				<option value="I" <?php echo is_selected('I', $status); ?>>รออนุมัติ</option>
				<option value="A" <?php echo is_selected('A', $status); ?>>อนุมัติแล้ว</option>
				<option value="R" <?php echo is_selected('R', $status); ?>>ไม่อนุมัติ</option>
				<option value="W" <?php echo is_selected('W', $status); ?>>PEA รออนุมัติ</option>
				<option value="S" <?php echo is_selected('S', $status); ?>>PEA อนุมัติแล้ว</option>
				<option value="U" <?php echo is_selected('U', $status); ?>>PEA ไม่อนุมัติ</option>
				<option value="F" <?php echo is_selected('F', $status); ?>>เหตุสุดวิสัย</option>
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

<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>
<hr class="hidden-xs"/>
<div class="divider visible-xs" style="margin-top:5px; margin-bottom:5px;"></div>
<div class="row">
	<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-4">
		<button type="button" class="btn btn-xs btn-primary btn-block" onclick="showAssignModal()">มอบหมายใบงาน</button>
	</div>
	<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-4">
		<button type="button" class="btn btn-xs btn-danger btn-block" onclick="unAssign()">ยกเลิกการมอบหมาย</button>
	</div>
</div>
</form>
<div class="divider-hidden"></div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:1450px;;">
			<thead>
				<tr>
					<th class="fix-width-40 text-center">#</th>
					<th class="fix-width-40 text-center">
						<label>
							<input type="checkbox" class="ace" id="chk-all" onclick="checkAll()" />
							<span class="lbl"></span>
						</label>
					</th>
					<th class="fix-width-100 text-center ">สถานะ</th>
					<th class="fix-width-120">เขต/พื้นที่</th>
					<th class="fix-width-120">PEA No</th>
					<th class="fix-width-100 ">CA No</th>
					<th class="fix-width-100 ">สายจดมิเตอร์</th>
					<th class="fix-width-150 ">ทีมติดตั้ง</th>
					<th class="fix-width-100 ">Cust. No</th>
					<th class="fix-width-150 ">ชื่อลูกค้า</th>
					<th class="fix-width-200 ">ที่อยู่</th>
					<th class="fix-width-100 ">เบอร์โทร.</th>
					<th class="fix-width-100 ">วันที่สร้าง</th>
					<th class="fix-width-150 ">วันที่ปรุบปรุง</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
		<?php $color = (empty($rs->user_id) ? '' : 'background-color:#e3f3db;'); ?>
		<?php $text_color = status_color($rs->status); ?>
				<tr style="<?php echo $color; ?> <?php echo $text_color; ?>">
					<td class="text-center no"><?php echo $no; ?></td>
					<td class="text-center">
						<?php if($rs->status == 'P' OR $rs->status == 'R') : ?>
							<label>
								<input type="checkbox" class="ace chk" value="<?php echo $rs->id; ?>" data-team="<?php echo $rs->team_id; ?>" data-peano="<?php echo $rs->pea_no; ?>">
								<span class="lbl"></span>
							</label>
						<?php endif; ?>
					</td>
					<td class="text-center"><?php echo status_text($rs->status); ?></td>
					<td class=""><?php echo (empty($rs->team_id) ? "ไม่ระบุ" : (empty($team[$rs->team_id]) ? "" : $team[$rs->team_id])); ?></td>
					<td class=""><?php echo $rs->pea_no; ?></td>
					<td class=""><?php echo $rs->ca_no; ?></td>
					<td class=""><?php echo $rs->cust_route; ?></td>
					<td class=""><?php echo $rs->team_group_name; ?></td>
					<td class=""><?php echo $rs->cust_no; ?></td>
					<td class=""><?php echo $rs->cust_name; ?></td>
					<td class=""><?php echo $rs->cust_address; ?></td>
					<td class=""><?php echo $rs->cust_tel; ?></td>
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

<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">การมอบหมาย</h4>
       </div>
       <div class="modal-body">
         <div class="row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="team-group-list">

					 </div>
         </div>
       </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" >Close</button>
				<button type="button" class="btn btn-sm btn-success" onclick="addToGroup()">มอบหมาย</button>
			</div>
		</div>
	</div>
</div>


<script id="team-group-template" type="text/x-handlebarsTemplate">
	{{#each this}}
		<div class="radio">
			<label><input type="radio" class="ace" name="team_group" value="{{id}}"><span class="lbl"> {{name}}</label>
		</div>
	{{/each}}
</script>


<script src="<?php echo base_url(); ?>scripts/inventory/work_list/work_list.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
