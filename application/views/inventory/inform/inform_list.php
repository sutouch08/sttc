<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
</div><!-- End Row -->
<hr class="padding-5"/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
	<div class="row">
		<div class="col-lg-1-harf col-md-1-harf col-sm-2-harf col-xs-6">
			<label>PEA No.</label>
			<input type="text" class="form-control input-sm search-box" name="pea_no" value="<?php echo $pea_no; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2-harf col-xs-6">
			<label>CA No.</label>
			<input type="text" class="form-control input-sm search-box" name="ca_no" value="<?php echo $ca_no; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2-harf col-xs-6">
			<label>สายจดมิเตอร์</label>
			<input type="text" class="form-control input-sm search-box" name="cust_route" value="<?php echo $cust_route; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2-harf col-xs-6">
			<label>ทีมติดตั้ง</label>
			<input type="text" class="form-control input-sm search-box" name="team_group" value="<?php echo $team_group; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6">
			<label>เขต</label>
			<select class="form-control input-sm" name="team_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</option>
				<?php echo $myteam; ?>
			</select>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
	    <label>วันที่</label>
	    <div class="input-daterange input-group">
	      <input type="text" class="form-control input-sm text-center width-50 from-date" name="from_date" id="fromDate" value="<?php echo $from_date; ?>" />
	      <input type="text" class="form-control input-sm text-center width-50" name="to_date" id="toDate" value="<?php echo $to_date; ?>" />
	    </div>
	  </div>

		<div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="submit" class="btn btn-xs btn-primary btn-block">Search</button>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-3 margin-bottom-5">
			<label class="display-block not-show">buton</label>
			<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()">Reset</button>
		</div>
	</div>

</form>
<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>
<div class="divider-hidden"></div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:800px;;">
			<thead>
        <tr>
          <th class="fix-width-60 text-center">#</th>
					<th class="fix-width-60"></th>
					<th class="fix-width-100 text-center">Status</th>
					<th class="fix-width-120">PEA No</th>
					<th class="fix-width-100">CA No</th>
					<th class="fix-width-100">สายจดมิเตอร์</th>
          <th class="fix-width-120">เขต</th>
					<th class="fix-width-150">ทีมติดตั้ง</th>
					<th class="fix-width-100">Cust. No</th>
					<th class="min-width-100">วันที่สร้าง</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr>
					<td class="middle text-center no"><?php echo $no; ?></td>
					<td class="middle">
						<button type="button" class="btn btn-mini btn-primary" onclick="viewDetail(<?php echo $rs->id; ?>)">Preview</button>
					</td>
					<td class="middle text-center">
						<?php if($rs->status == 'F') : ?>
							<span class="red">Failed</span>
						<?php elseif($rs->status == 'S') : ?>
							<span class="green">Success</span>
						<?php else : ?>
							<span class="">Pending</span>
						<?php endif; ?>
					</td>
					<td class="middle"><?php echo $rs->pea_no; ?></td>
					<td class="middle"><?php echo $rs->ca_no; ?></td>
					<td class="middle"><?php echo $rs->cust_route; ?></td>
					<td class="middle"><?php echo $rs->team_group_name; ?></td>
          <td class="middle"><?php echo (empty($rs->team_id) ? "ไม่ระบุ" : (empty($team[$rs->team_id]) ? "" : $team[$rs->team_id])); ?></td>
					<td class="middle"><?php echo $rs->cust_no; ?></td>
					<td class="middle"><?php echo thai_date($rs->date_add, FALSE); ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>


<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Preview</h4>
        <input type="hidden" id="inform-id" value="" />
       </div>
       <div class="modal-body">
         <div class="row" id="inform-detail" style="max-height:75vh; overflow:auto;">

         </div>
       </div>
			 <div class="divider-hidden"></div>
			 <div class="divider-hidden"></div>
		</div>
	</div>
</div>

<script id="preview-template" type="text/x-handlebarsTemplate">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <table class="table table-bordered"style="margin-right:10px;">
				<tr><td class="width-30 bold">PEA NO</td><td class="width-70 font-size-18">{{pea_no}}</td></tr>
				<tr><td class="bold">CA No</td><td class="">{{ca_no}}</td></tr>
				<tr><td class="bold">สายจดมิเตอร์</td><td class="">{{cust_route}}</td></tr>
				<tr><td class="bold">ผู้ใช้ไฟ</td><td class="">{{cust_name}}</td></tr>
				<tr><td class="bold">ที่อยู่</td><td class="">{{cust_address}}</td></tr>
				<tr><td class="bold">สาเหตุ</td><td class="">{{remark}}</td></tr>
				<tr><td class="bold">ชื่อแผน</td><td class="">{{Plan_TableName}}</td></tr>
				<tr><td class="bold">สถานะ</td><td class="{{#unless state}} red {{/unless}}">{{status_name}}</td></tr>
				<tr>
					<td colspan="2" class="text-center">
						<div class="width-100 padding-0">
							<div class="text-center red font-size-18">ภาพมิเตอร์ด้านหน้า</div>
							<img src="{{f_image_path}}" style="width:100%;" />
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-center">
						<div class="width-100">
							<div class="text-center red font-size-18">ภาพมิเตอร์ด้านข้าง</div>
							<img src="{{s_image_path}}" style="width:100%;" />
						</div>
					</td>
				</tr>
	    </table>
	  </div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5px 10px;">
	{{#unless state}}
	 <button type="button" class="btn btn-lg btn-purple pull-right" id="btn-scs" onclick="sendToSCS()">ส่งข้อมูลอีกครั้ง</button>
	 {{/unless}}
 </div>
</script>

<script src="<?php echo base_url(); ?>scripts/inventory/inform/inform_list.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
