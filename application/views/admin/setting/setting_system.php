<?php
    $open     = $CLOSE_SYSTEM == 0 ? 'btn-success' : '';
    $close    = $CLOSE_SYSTEM == 1 ? 'btn-danger' : '';
		$strongOn = $USE_STRONG_PWD == 1 ? 'btn-primary' : '';
		$strongOff = $USE_STRONG_PWD == 0 ? 'btn-primary' : '';
		$disable = $this->_SuperAdmin ? "" : "disabled";
    $checkboxOn = $RETURN_CHECKBOX == 1 ? 'btn-primary' : '';
    $checkboxOff = $RETURN_CHECKBOX == 0 ? 'btn-primary' : '';
?>

  <form id="systemForm" method="post" action="<?php echo $this->home; ?>/update_config">
    <div class="row">
      <?php if($this->_SuperAdmin) : ?>
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">ปิดระบบ</span></div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      	<div class="btn-group input-medium">
        	<button type="button" class="btn btn-sm width-50 <?php echo $open; ?>" id="btn-open" onClick="openSystem()" <?php echo $disable; ?>>เปิด</button>
          <button type="button" class="btn btn-sm width-50 <?php echo $close; ?>" id="btn-close" onClick="closeSystem()" <?php echo $disable; ?>>ปิด</button>
        </div>
        <span class="help-block">กรณีปิดระบบจะไม่สามารถเข้าใช้งานระบบได้ในทุกส่วน โปรดใช้ความระมัดระวังในการกำหนดค่านี้</span>
      	<input type="hidden" name="CLOSE_SYSTEM" id="closed" value="<?php echo $CLOSE_SYSTEM; ?>" />
      </div>
      <div class="divider-hidden"></div>
    <?php endif; ?>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Strong Password</span></div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div class="btn-group input-medium">
        <button type="button" class="btn btn-sm <?php echo $strongOn; ?>" style="width:50%;" id="btn-strong-on" onClick="toggleStrongPWD(1)">เปิด</button>
        <button type="button" class="btn btn-sm <?php echo $strongOff; ?>" style="width:50%;" id="btn-strong-off" onClick="toggleStrongPWD(0)">ปิด</button>
      </div>
      <span class="help-block">เมื่อเปิดใช้งาน การกำหนดรหัสผ่านจะต้องประกอบด้วย ตัวอักษรภาษาอังกฤษ พิมพ์ใหญ่ พิมพ์เล็ก ตัวเลข และสัญลักษณ์พิเศษ อย่างน้อย อย่างล่ะ 1 ตัว และต้องมีความยาว 8 ตัวอักษรขึ้นไป</span>
      <input type="hidden" name="USE_STRONG_PWD" id="use-strong-pwd" value="<?php echo $USE_STRONG_PWD; ?>" />
    </div>
    <div class="divider-hidden"></div>


		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Password Age</span></div>
    <div class="col-lg-7 col-md-9 col-sm-9 col-xs-12">
      <input type="number" class="form-control input-sm input-small text-center" name="USER_PASSWORD_AGE" id="pwd-age" value="<?php echo $USER_PASSWORD_AGE; ?>" />
      <span class="help-block">กำหนดอายุของรหัสผ่าน(วัน) User จำเป็นต้องเปลี่ยนรหัสผ่านหากรหัสผ่านหมดอายุ</span>
    </div>
    <div class="divider-hidden"></div>

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Interface API Endpoint</span></div>
    <div class="col-lg-5 col-md-7 col-sm-7 col-xs-12">
      <input type="text" class="form-control input-sm" name="SAP_API_HOST" id="" value="<?php echo $SAP_API_HOST; ?>" />
      <span class="help-block">กำหนด URL endpoint สำหรับการ Interface กับ ระบบ SAP</span>
    </div>
    <div class="divider-hidden"></div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">จำกัดจำนวนในการแพ็ค/ลัง (1 เฟส)</span></div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <input type="number" class="form-control input-sm input-small text-center" name="PACK_LIMIT_1_PHASE" value="<?php echo $PACK_LIMIT_1_PHASE; ?>" />
      <span class="help-block">ตั้งค่าจำกัดจำนวนมิเตอร์ 1 เฟส ที่สามารถแพ็คลงลังได้ต่อ 1 ลังไม่เกินจำนวนที่กำหนด</span>
    </div>
    <div class="divider-hidden"></div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">จำกัดจำนวนในการแพ็ค/ลัง (3 เฟส)</span></div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <input type="number" class="form-control input-sm input-small text-center" name="PACK_LIMIT_3_PHASE" value="<?php echo $PACK_LIMIT_3_PHASE; ?>" />
      <span class="help-block">ตั้งค่าจำกัดจำนวนมิเตอร์ 3 เฟส ที่สามารถแพ็คลงลังได้ต่อ 1 ลังไม่เกินจำนวนที่กำหนด</span>
    </div>
    <div class="divider-hidden"></div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">จำนวนบรรทัดการพิมพ์/กล่อง</span></div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <input type="number" class="form-control input-sm input-small text-center" name="PRINT_SPLIT_ROWS" value="<?php echo $PRINT_SPLIT_ROWS; ?>" />
      <span class="help-block"></span>
    </div>
    <div class="divider-hidden"></div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">จำกัดจำนวนในการ Export ข้อมูล</span></div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <input type="number" class="form-control input-sm input-small text-center" name="EXPORT_LIMIT_ROWS" value="<?php echo $EXPORT_LIMIT_ROWS; ?>" />
      <span class="help-block"></span>
    </div>
    <div class="divider-hidden"></div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Export Memory Limit</span></div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <select class="form-control input-sm input-small" name="EXPORT_MEMORY_LIMIT">
        <option value="1024M" <?php echo is_selected('1024M', $EXPORT_MEMORY_LIMIT); ?>>1 GB</option>
        <option value="2048M" <?php echo is_selected('2048M', $EXPORT_MEMORY_LIMIT); ?>>2 GB</option>
        <option value="3072M" <?php echo is_selected('3072M', $EXPORT_MEMORY_LIMIT); ?>>3 GB</option>
        <option value="4096M" <?php echo is_selected('4096M', $EXPORT_MEMORY_LIMIT); ?>>4 GB</option>
      </select>
      <span class="help-block"></span>
    </div>
    <div class="divider-hidden"></div>

    <div class="divider-hidden"></div>
		<div class="divider-hidden"></div>
		<div class="divider-hidden"></div>


      <div class="col-lg-9 col-md-9 col-sm-9 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 hidden-xs">
        <?php if($this->pm->can_add OR $this->pm->can_edit) : ?>
      	<button type="button" class="btn btn-sm btn-success btn-100" onClick="updateConfig('systemForm')"><i class="fa fa-save"></i> บันทึก</button>
        <?php endif; ?>
      </div>
			<div class="col-xs-12 text-center visible-xs">
        <?php if($this->pm->can_add OR $this->pm->can_edit) : ?>
      	<button type="button" class="btn btn-sm btn-success btn-100" onClick="updateConfig('systemForm')"><i class="fa fa-save"></i> บันทึก</button>
        <?php endif; ?>
      </div>
      <div class="divider-hidden"></div>

    </div><!--/row-->
  </form>
