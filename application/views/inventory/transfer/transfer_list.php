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
					<th class="fix-width-150 middle text-center" style="min-width:150px; max-width:150px;"></th>
					<th class="fix-width-60 middle text-center">สถานะ</th>
					<th class="fix-width-100 middle text-center" style="min-width:100px; max-width:100px;">วันที่</th>
					<th class="fix-width-120 middle" style="min-width:120px; max-width:120px;">เลขที่</th>
					<th class="fix-width-150 middle" style="min-width:150px; max-width:150px;">Serial</th>
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
					<td class="middle text-center">
						<button type="button" class="btn btn-mini btn-primary" onclick="preview(<?php echo $rs->id; ?>)">Preview</button>
						<?php if($this->pm->can_edit) : ?>
							<button type="button" class="btn btn-mini btn-warning" onclick="edit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
						<?php if($this->pm->can_delete) : ?>
							<button type="button" class="btn btn-mini btn-danger" onclick="cancle(<?php echo $rs->id; ?>)"><i class="fa fa-trash"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center"><?php echo transfer_status_label($rs->status); ?></td>
					<td class="middle text-center"><?php echo thai_date($rs->date_add, FALSE); ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle"><?php echo $rs->InstallSerialNum; ?></td>
					<td class="middle"><?php echo $rs->uname; ?></td>
					<td class="middle"><?php echo $rs->fromWhsCode.' : '.$rs->fromWhsName; ?></td>
          <td class="middle"><?php echo $rs->toWhsCode .' : '.$rs->toWhsName; ?></td>
					<td class="middle"><?php echo $rs->team_name; ?></td>
					<td class="middle"><?php echo $rs->docNum; ?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>



<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Preview</h4>
        <input type="hidden" id="transfer-id" value="" />
       </div>
       <div class="modal-body">
         <div class="row" id="item-detail" style="max-height:80vh; overflow:auto;">

         </div>
       </div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-success pull-left hide" id="btn-approve" onclick="doApprove()">อนุมัติ</button>
				<button type="button" class="btn btn-sm btn-primary pull-left hide" id="btn-temp" onclick="sendToSAP()">Send To Temp</button>
				<button type="button" class="btn btn-sm btn-danger pull-right" id="btn-close" data-dismiss="modal" >Close</button>
			</div>
		</div>
	</div>
</div>

<script id="preview-template" type="text/x-handlebarsTemplate">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <table class="table table-bordered"style="margin-right:10px;">
				<tr><td colspan="2" class="text-center bold">มิเตอร์เก่า</td></tr>
	      <tr><td class="width-30 bold">Serial</td><td class="width-70">{{u_serial}}</td></tr>
				<tr><td class="bold">PEA No.</td><td class="">{{pea_no}}</td></tr>
				<tr><td class="bold">หน่วยไฟ</td><td class="">{{power_no}}</td></tr>
				<tr><td class="bold">ปีบนมิเตอร์</td><td class="">{{mYear}}</td></tr>
				<tr><td class="bold">สภาพมิเตอร์</td><td class="">{{cond}}</td></tr>
				<tr><td class="bold">อายุใช้งาน</td><td class="">{{usageAge}} ปี</td></tr>
				<tr><td class="bold">สติ๊กเกอร์</td><td class="">{{{color}}}</td></tr>
				<tr>
					<td colspan="2" class="text-center">
						<img src="{{u_image_path}}" style="width:100%;" />
						<strong>ภาพมิเตอร์เก่า</strong>
					</td>
				</tr>
				<tr><td colspan="2" class="text-center bold">มิเตอร์ที่ติดตั้งใหม่</td></tr>
				<tr><td class="width-30 bold">Serial</td><td class="width-70">{{i_serial}}</td></tr>
				<tr><td class="bold">Item Code</td><td class="">{{item_code}}</td></tr>
				<tr><td class="bold">Item Name</td><td class="">{{item_name}}</td></tr>
				<tr><td class="bold">คลังต้นทาง</td><td class="">{{fromWhsCode}} : {{fromWhsName}}</td></tr>
				<tr><td class="bold">คลังปลายทาง</td><td class="">{{toWhsCode}} : {{toWhsName}}</td></tr>
				<tr>
					<td colspan="2" class="text-center">
						<img src="{{i_image_path}}" style="width:100%;" />
						<strong>ภาพมิเตอร์ที่ติดตั้งใหม่</strong>
					</td>
				</tr>
	    </table>
	  </div>
	</div>
</script>

<script id="row-template" type="text/x-handlebarsTemplate">
	<td class="middle text-center" id="no-{{id}}"></td>
	<td class="middle text-center">
		<button type="button" class="btn btn-mini btn-primary" onclick="preview({{id}})">Preview</button>
		<button type="button" class="btn btn-mini btn-warning" onclick="edit({{id}})"><i class="fa fa-pencil"></i></button>
		<button type="button" class="btn btn-mini btn-danger" onclick="cancle({{id}})"><i class="fa fa-trash"></i></button>
	</td>
	<td class="middle text-center">{{status_label}}</td>
	<td class="middle text-center">{{date_add}}</td>
	<td class="middle">{{code}}</td>
	<td class="middle">{{i_serial}}</td>
	<td class="middle">{{uname}}</td>
	<td class="middle">{{fromWhs}}</td>
	<td class="middle">{{toWhs}}</td>
	<td class="middle">{{teamName}}</td>
	<td class="middle">{{docNum}}</td>
</script>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
