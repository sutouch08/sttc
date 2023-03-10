<?php
    $open     = $CLOSE_SYSTEM == 0 ? 'btn-success' : '';
    $close    = $CLOSE_SYSTEM == 1 ? 'btn-danger' : '';
		$strongOn = $USE_STRONG_PWD == 1 ? 'btn-primary' : '';
		$strongOff = $USE_STRONG_PWD == 0 ? 'btn-primary' : '';
		$disable = $this->_SuperAdmin ? "" : "disabled";
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
    <div class="col-lg-5 col-md-9 col-sm-9 col-xs-12">
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

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span class="form-control left-label">Barcode Format</span></div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
      <select class="form-control input-sm input-medium" name="SCANTYPE">
        <option value="qrcode" <?php echo is_selected('qrcode', $SCANTYPE); ?>>QR CODE</option>
        <option value="barcode" <?php echo is_selected('barcode', $SCANTYPE); ?>>BARCODE</option>
        <option value="both" <?php echo is_selected('both', $SCANTYPE); ?>>BOTH</option>
      </select>
      <span class="help-block">กำหนดค่าการ Scan QR CODE หรือ BARCODE กรณีเลือก BOTH จะสามารถ Scan ได้ทั้งคู่ แต่จะทำให้ Performance ลดลง</span>
    </div>
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
