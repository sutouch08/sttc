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
		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>เลขที่</label>
			<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>PEA NO(เก่า)</label>
			<input type="text" class="form-control input-sm search-box" name="u_pea_no" value="<?php echo $u_pea_no; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>PEA NO(ใหม่)</label>
			<input type="text" class="form-control input-sm search-box" name="i_pea_no" value="<?php echo $i_pea_no; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>Serial</label>
			<input type="text" class="form-control input-sm search-box" name="serial" value="<?php echo $serial; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>พนักงาน</label>
			<input type="text" class="form-control input-sm search-box" name="user" value="<?php echo $user; ?>" />
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>ทีมติดตั้ง</label>
			<select class="form-control input-sm" name="team_group_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
				<?php echo select_team_group($team_group_id); ?>
			</select>
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>เขต</label>
			<select class="form-control input-sm" name="team_id" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
				<?php echo select_team($team_id); ?>
			</select>
		</div>

		<div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 margin-bottom-5">
			<label>Status</label>
			<select class="form-control input-sm" name="status" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
					<option value="I" <?php echo is_selected('I', $status); ?>>รออนุมัติ</option>
					<option value="A" <?php echo is_selected('A', $status); ?>>อนุมัติแล้ว</option>
					<option value="R" <?php echo is_selected('R', $status); ?>>ไม่อนุมัติ</option>
					<option value="W" <?php echo is_selected('W', $status); ?>>รอตรวจรับ</option>
					<option value="S" <?php echo is_selected('S', $status); ?>>ตรวจรับแล้ว</option>
					<option value="U" <?php echo is_selected('U', $status); ?>>ต้องแก้ไข</option>
					<option value="C" <?php echo is_selected('C', $status); ?>>ยกเลิก</option>
				</select>
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>SAP</label>
			<select class="form-control input-sm" name="sap_status" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
				<option value="P" <?php echo is_selected('P', $sap_status); ?>>ยังไม่เข้า SAP</option>
				<option value="S" <?php echo is_selected('S', $sap_status); ?>>เข้า SAP แล้ว</option>
				<option value="F" <?php echo is_selected('F', $sap_status); ?>>ส่งเข้า SAP ไม่สำเร็จ</option>
			</select>
		</div>

		<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-4 margin-bottom-5">
			<label>SCS</label>
			<select class="form-control input-sm" name="pea_status" onchange="getSearch()">
				<option value="all">ทั้งหมด</opton>
				<option value="P" <?php echo is_selected('P', $pea_status); ?>>ยังไม่ส่ง</option>
				<option value="S" <?php echo is_selected('S', $pea_status); ?>>ส่งสำเร็จแล้ว</option>
				<option value="F" <?php echo is_selected('F', $pea_status); ?>>ส่งไม่สำเร็จ</option>
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
		<table class="table table-hover border-1" style="min-width:1860px;;">
			<thead>
				<tr>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-120 middle text-center"></th>
					<th class="fix-width-80 middle text-center">สถานะ</th>
					<th class="fix-width-80 middle text-center">SAP</th>
					<th class="fix-width-80 middle text-center">SCS</th>
					<th class="fix-width-100 middle text-center">วันที่</th>
					<th class="fix-width-120 middle">เลขที่</th>
					<th class="fix-width-150 middle">PEA NO(เก่า)</th>
					<th class="fix-width-150 middle">PEA NO(ใหม่)</th>
					<th class="fix-width-150 middle">Serial</th>
					<th class="fix-width-100 middle">ผู้ทำรายการ</th>
					<th class="fix-width-200 middle">คลังต้นทาง</th>
          <th class="fix-width-200 middle">คลังปลายทาง</th>
					<th class="fix-width-150 middle">เขต/พื้นที่</th>
					<th class="fix-width-100 middle">SAP No.</th>
					<th class="fix-width-100 middle">ผู้อนุมัติ</th>
				</tr>
			</thead>
			<tbody>
<?php if(! empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>">
					<td class="middle text-center" id="no-<?php echo $rs->id; ?>"><?php echo $no; ?></td>
					<td class="middle">
						<button type="button" class="btn btn-mini btn-primary" onclick="preview(<?php echo $rs->id; ?>)">Preview</button>
						<?php if($rs->status == 'I' && $this->pm->can_edit) : ?>
							<button type="button" class="btn btn-mini btn-warning" onclick="edit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
						<?php endif; ?>
					</td>
					<td class="middle text-center">
						<?php echo transfer_status_label($rs->status); ?>
					</td>
					<td class="middle text-center">
						<?php echo sap_status_label($rs->sap_status); ?>
					</td>
					<td class="middle text-center">
						<?php echo sap_status_label($rs->pea_status); ?>
					</td>
					<td class="middle text-center"><?php echo thai_date($rs->date_add, FALSE); ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle"><?php echo $rs->u_pea_no; ?></td>
					<td class="middle"><?php echo $rs->i_pea_no; ?></td>
					<td class="middle"><?php echo $rs->i_serial; ?></td>
					<td class="middle"><?php echo $rs->uname; ?></td>
					<td class="middle"><?php echo $rs->fromWhsCode.' : '.$rs->fromWhsName; ?></td>
          <td class="middle"><?php echo $rs->toWhsCode .' : '.$rs->toWhsName; ?></td>
					<td class="middle"><?php echo $rs->team_name; ?></td>
					<td class="middle"><?php echo $rs->docNum; ?></td>
					<td class="middle"><?php echo $rs->approver;?></td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>

		<input type="hidden" name="edit-id" value="">
	</div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">แก้ไขรายละเอียด</h4>
        <input type="hidden" id="transfer-id" value="" />
       </div>
       <div class="modal-body">
         <div class="row" id="edit-detail" style="max-height:75vh; overflow:auto;">

         </div>
       </div>

			<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-default" data-dismiss="modal" >Close</button>
				<button type="button" class="btn btn-lg btn-success" id="btn-update" onclick="updateItem()">Update</button>
			</div>
		</div>
	</div>
</div>


<script id="edit-template" type="text/x-handlebarsTemplate">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <table class="table table-bordered"style="margin-right:10px;">
			<tr>
				<td colspan="2" class="text-center">
					<div class="width-100 padding-0">
						<div class="text-center red font-size-18">ภาพมิเตอร์ที่เก็บคืน</div>
						<img src="{{u_image_path}}" style="width:100%;" />
					</div>
				</td>
			</tr>
				<tr><td colspan="2" class="text-center bold">มิเตอร์เก่า</td></tr>
	      <tr><td class="width-30 bold">PEA NO</td><td class="width-70">{{u_pea_no}}</td></tr>
				<tr>
					<td class="middle bold">หน่วยตัดกลับ</td>
					<td class="">
						<input type="number" inputmode="numeric"
						class="form-cotnrol input-lg input-small text-center" id="u-power-no" value="{{u_power_no}}"
						onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
					</td>
				</tr>
				<tr><td class="bold">อายุการใช้งาน</td><td class="">{{use_age}} ปี</td></tr>
				<tr>
					<td class="bold">สภาพมิเตอร์</td>
					<td class="">
						<select id="damage_id" class="form-control input-lg" onchange="suggest()">
							<?php echo select_damage(); ?>
						</select>
					</td>
				</tr>
				<tr><td class="middle bold">สติ๊กเกอร์</td><td class="" id="suggest-label">{{{color}}}</td></tr>
				<tr>
					<td colspan="2" class="text-center">
						<div class="width-100">
							<div class="text-center red font-size-18">ภาพมิเตอร์ที่ติดตั้ง</div>
							<img src="{{i_image_path}}" style="width:100%;" />
						</div>
					</td>
				</tr>
				<tr><td colspan="2" class="text-center bold">มิเตอร์ที่ติดตั้งใหม่</td></tr>
				<tr><td class="width-30 bold">PEA NO</td><td class="width-70">{{i_pea_no}}</td></tr>
				<tr><td class="bold">Serial</td><td class="width-70">{{i_serial}}</td></tr>
				<tr>
					<td class="middle bold">หน่วยตั้งต้น</td>
					<td class="">
						<input type="number" inputmode="numeric"
						class="form-cotnrol input-lg input-small text-center" id="i-power-no" value="{{i_power_no}}"
						onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
					</td>
				</tr>
				<tr>
					<td class="middle bold">เฟสมิเตอร์</td>
					<td class="">
						<select class="form-control input-lg input-small" id="phase">
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="ABC">ABC</option>
						</select>
					</td>
				</tr>
				<tr><td class="bold">Item Code</td><td class="">{{item_code}}</td></tr>
				<tr><td class="bold">Item Name</td><td class="">{{item_name}}</td></tr>
	    </table>
			<input type="hidden" id="use-age" value="{{use_age}}" />
	  </div>
	</div>
</script>


<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Preview</h4>
        <input type="hidden" id="transfer-id" value="" />
       </div>
       <div class="modal-body">
         <div class="row" id="item-detail" style="max-height:75vh; overflow:auto;">

         </div>
       </div>
			 <div class="divider-hidden"></div>
			 <div class="divider-hidden"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="errorMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Failed</h4>
       </div>
       <div class="modal-body">
         <div class="row" style="max-height:75vh; overflow:auto;">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" id="error-message">

					 </div>
         </div>
       </div>
		</div>
	</div>
</div>

<script id="preview-template" type="text/x-handlebarsTemplate">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <table class="table table-bordered"style="margin-right:10px;">
				<tr>
					<td colspan="2" class="text-center">
						<div class="width-100 padding-0">
							<div class="text-center red font-size-18">ภาพมิเตอร์ที่เก็บคืน</div>
							<img src="{{u_image_path}}" style="width:100%;" />
						</div>
					</td>
				</tr>
				<tr><td colspan="2" class="text-center bold">มิเตอร์เก่า</td></tr>
	      <tr><td class="width-30 bold">PEA NO</td><td class="width-70">{{u_pea_no}}</td></tr>
				<tr><td class="middle bold">หน่วยตัดกลับ</td><td class="font-size-18">{{u_power_no}}</td></tr>
				<tr><td class="bold">อายุใช้งาน</td><td class="">{{use_age}} ปี</td></tr>
				<tr><td class="bold">สภาพมิเตอร์</td><td class="">{{damage_name}}</td></tr>
				<tr><td class="middle bold">สติ๊กเกอร์</td><td class="">{{{color}}}</td></tr>
				<tr>
					<td colspan="2" class="text-center">
						<div class="width-100">
							<div class="text-center red font-size-18">ภาพมิเตอร์ที่ติดตั้ง</div>
							<img src="{{i_image_path}}" style="width:100%;" />
						</div>
					</td>
				</tr>
				<tr><td colspan="2" class="text-center bold">มิเตอร์ที่ติดตั้งใหม่</td></tr>
				<tr><td class="width-30 bold">PEA NO</td><td class="width-70">{{i_pea_no}}</td></tr>
				<tr><td class="bold">Serial</td><td class="">{{i_serial}}</td></tr>
				<tr><td class="middle bold">หน่วยตั้งต้น</td><td class="font-size-18">{{i_power_no}}</td></tr>
				<tr><td class="bold">เฟสมิเตอร์</td><td class="">{{phase}}</td></tr>
				<tr><td class="bold">Item Code</td><td class="">{{item_code}}</td></tr>
				<tr><td class="bold">Item Name</td><td class="">{{item_name}}</td></tr>
	    </table>
	  </div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5px 10px;">
	<?php if($this->pm->can_approve) : ?>
	 <button type="button" class="btn btn-lg btn-success pull-right hide" id="btn-approve" onclick="doApprove()">อนุมัติ</button>
	 <button type="button" class="btn btn-lg btn-danger pull-right margin-right-10 hide" id="btn-reject" onclick="doReject()">ไม่อนุมัติ</button>
 <?php endif; ?>

	 <button type="button" class="btn btn-lg btn-primary pull-right hide" id="btn-temp" onclick="sendToSAP()">ส่งเข้า SAP อีกครั้ง</button>
	 <button type="button" class="btn btn-lg btn-purple pull-right hide" id="btn-scs" onclick="sendToSCS()">ส่งเข้า SCS อีกครั้ง</button>
 <?php if($this->pm->can_edit) : ?>
	 <button type="button" class="btn btn-lg btn-warning pull-left hide" id="btn-edit" onclick="getEdit()" >
		 <i class="fa fa-pencil"></i> แก้ไข
	 </button>
 <?php endif; ?>
 </div>
</script>

<script id="row-template" type="text/x-handlebarsTemplate">
	<td class="middle text-center" id="no-{{id}}"></td>
	<td class="middle text-center">
		<button type="button" class="btn btn-mini btn-primary" onclick="preview({{id}})">Preview</button>
		<button type="button" class="btn btn-mini btn-warning" onclick="edit({{id}})"><i class="fa fa-pencil"></i></button>
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

<script>
	function showErrorMessage(msg) {
		$('#error-message').text(msg);

		$('#errorMessageModal').modal('show');
	}

	function powerInit() {
		$('#u-power-no').on('input', function() {
			if($(this).val().length > 5) {
				$(this).val($(this).val().slice(0, 5));
			}
		});

		$('#i-power-no').on('input', function() {
			if($(this).val().length > 5) {
				$(this).val($(this).val().slice(0, 5));
			}
		});
	}
</script>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
