<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive">
		<table class="table table-striped border-1" style="min-width:900px;">
			<thead>
				<tr>
          <th class="fix-width-60 text-center">
						<label>
							<input type="checkbox" class="ace" id="chk-all" onchange="checkAll()"/>
							<span class="lbl"></span>
						</label>
					</th>
					<th class="fix-width-60 text-center">#</th>
          <th class="fix-width-100 text-center">วันที่สับเปลี่ยน</th>
					<th class="fix-width-150">PEA NO(เก่า)</th>
					<th class="fix-width-150">PEA NO(ใหม่)</th>
					<th class="fix-width-100 text-center">เฟส</th>
					<th class="fix-width-100 text-center">ขนาด</th>
          <th class="fix-width-150 text-center">หน่วย (kWh)</th>
          <th class="fix-width-100 text-center">อายุ (ปี)</th>
          <th class="min-width-100">การชำรุด</th>
					<th class="fix-width-40"></th>
				</tr>
			</thead>
			<tbody id="row-table">
				<?php if(!empty($details)) : ?>
					<?php $no = 1; ?>
					<?php foreach($details as $rs) : ?>
						<tr id="row-<?php echo $rs->id; ?>">
              <td class="middle text-center">
                <label>
                  <input type="checkbox" class="ace chk" value="<?php echo $rs->id; ?>" data-upeano="<?php echo $rs->u_pea_no; ?>" />
                  <span class="lbl"></span>
                </label>
              </td>
							<td class="middle text-center no"><?php echo $no; ?></td>
              <td class="middle text-center"><?php echo thai_date($rs->work_date, FALSE); ?></td>
              <td class="middle pea-no"><?php echo $rs->u_pea_no; ?></td>
							<td class="middle"><?php echo $rs->i_pea_no; ?></td>
              <td class="middle text-center"><?php echo $rs->phase; ?></td>
              <td class="middle text-center"><?php echo $rs->meter_size; ?></td>
							<td class="middle text-center"><?php echo $rs->meter_read_end; ?></td>
							<td class="middle text-center"><?php echo $rs->meter_age; ?></td>
							<td class="middle">
								<input type="text" class="form-control input-sm dispose" id="dispose-<?php echo $rs->id; ?>" value="<?php echo $rs->dispose_reason_name; ?>" readonly />
							</td>
							<td class="middle">
								<button type="button" class="btn btn-mini btn-warning" id="btn-edit-<?php echo $rs->id; ?>" onclick="activeEdit(<?php echo $rs->id; ?>)"><i class="fa fa-pencil"></i></button>
								<button type="button" class="btn btn-mini btn-primary hide" id="btn-update-<?php echo $rs->id; ?>" onclick="updateDispose(<?php echo $rs->id; ?>)"><i class="fa fa-save"></i></button>
							</td>
						</tr>
						<?php $no++; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>



<script id="row-template" type="text/x-handlebarsTemplate">
  <tr class="row-{{box_no}}" id="row-{{id}}">
    <td class="middle text-center">
      <label>
        <input type="checkbox" class="ace chk" value="{{id}}" data-upeano="{{u_pea_no}}"/>
        <span class="lbl"></span>
      </label>
    </td>
    <td class="middle text-center no"></td>
    <td class="middle text-center">{{work_date}}</td>
    <td class="middle pea-no">{{u_pea_no}}</td>
		<td class="middle">{{i_pea_no}}</td>
    <td class="middle text-center">{{phase}}</td>
    <td class="middle text-center">{{meter_size}}</td>
    <td class="middle text-center">{{meter_read_end}}</td>
    <td class="middle text-center">{{meter_age}}</td>
    <td class="middle">
			<input type="text" class="form-control input-sm dispose" id="dispose-{{id}}" value="{{dispose_reason_name}}" readonly />
		</td>
		<td class="middle">
			<button type="button" class="btn btn-mini btn-warning" id="btn-edit-{{id}}" onclick="activeEdit({{id}})"><i class="fa fa-pencil"></i></button>
			<button type="button" class="btn btn-mini btn-primary hide" id="btn-update-{{id}}" onclick="updateDispose({{id}})"><i class="fa fa-save"></i></button>
		</td>
  </tr>
</script>
