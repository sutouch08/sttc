<?php $limit = $doc->phase == 3 ? getConfig('PACK_LIMIT_3_PHASE') : getConfig('PACK_LIMIT_1_PHASE'); ?>

<div class="row">
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 padding-5">
    <label>จำนวนทั้งหมด</label>
    <input type="text" class="form-control input-lg text-center" id="all-qty" style="background-color:black; color:white;" value="<?php echo sum_pack_qty($doc->id); ?> / <?php echo $limit; ?>" readonly />
  </div>
  <div class="col-xs-12 visible-xs">&nbsp;</div>
  <div class="col-lg-3 col-md-2-harf col-sm-2-harf col-xs-8 padding-5">
    <label class="hidden-xs">PEA NO(เก่า)</label>
    <input type="text" class="form-control input-lg text-center" inputmode="" id="u-pea-no" placeholder="PEA NO (เก่า)">
  </div>
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4 padding-5">
    <label class="display-block not-show hidden-xs">btn</label>
    <button type="button" class="btn btn-lg btn-primary btn-block" id="btn-u-pack" onclick="doPacking('u')">ตกลง</button>
  </div>
  <div class="col-xs-12 visible-xs">&nbsp;</div>
  <div class="col-lg-3 col-md-2-harf col-sm-2-harf col-xs-8 padding-5">
    <label class="hidden-xs">PEA NO(ใหม่)</label>
    <input type="text" class="form-control input-lg text-center" inputmode="" id="i-pea-no" placeholder="PEA NO (ใหม่)" autofocus>
  </div>
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4 padding-5">
    <label class="display-block not-show hidden-xs">btn</label>
    <button type="button" class="btn btn-lg btn-primary btn-block" id="btn-i-pack" onclick="doPacking('i')">ตกลง</button>
  </div>

  <div class="col-xs-12 visible-xs">&nbsp;</div>

  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
    <label class="display-block not-show hidden-xs">del</label>
    <button type="button" class="btn btn-lg btn-danger btn-block" onclick="confirmDelete()">ลบรายการ</button>
  </div>

  <input type="hidden" id="limit" value="<?php echo $limit; ?>" />
</div>
<hr/>

<!-- แสดงผลกล่อง  -->
