<div class="row">
  <div class="col-lg-9-harf col-md-9 col-sm-9 col-xs-12 padding-5" id="box-row">
    <?php if( ! empty($box_list)) : ?>
      <?php foreach($box_list as $bx) : ?>
        <button type="button"
        class="btn btn-sm box-btn"
        style="margin-bottom:3px;"
        id="btn-box-<?php echo $bx->id; ?>"
        onclick="setBox(<?php echo $bx->id; ?>, <?php echo $bx->box_no; ?>)">
          กล่องที่ <?php echo $bx->box_no; ?>&nbsp;&nbsp;
          [ <span id="bqty-<?php echo $bx->id; ?>"><?php echo number($bx->qty); ?></span> ]
        </button>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="divider visible-xs padding-5"></div>
  <div class="col-lg-2-harf col-md-3 col-sm-3 col-xs-12 padding-5">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <button type="button" class="btn btn-sm btn-primary btn-block" onclick="addBox()">เพิ่มลัง</button>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <button type="button" class="btn btn-sm btn-info btn-block" onclick="showBoxOption()">พิมพ์/ตัวเลือก</button>
      </div>
    </div>
  </div>
</div>
<hr/>

<div class="row">
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>จำนวนในกล่อง</label>
    <input type="number" class="form-control input-lg text-center" id="box-qty" style="background-color:black; color:white;" value="0" readonly/>
  </div>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>จำนวนทั้งหมด</label>
    <input type="number" class="form-control input-lg text-center" id="all-qty" style="background-color:black; color:white;" value="<?php echo $all_qty; ?>" readonly />
  </div>
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8 padding-5">
    <label class="hidden-xs">PEA NO(เก่า)</label>
    <input type="text" class="form-control input-lg text-center" inputmode="none" id="u-pea-no">
  </div>
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4 padding-5">
    <label class="display-block not-show hidden-xs">btn</label>
    <button type="button" class="btn btn-lg btn-primary btn-block" id="btn-u-pack" onclick="doPacking('u')">ตกลง</button>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-8 padding-5">
    <label class="hidden-xs">PEA NO(ใหม่)</label>
    <input type="text" class="form-control input-lg text-center" inputmode="none" id="i-pea-no">
  </div>
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-4 padding-5">
    <label class="display-block not-show hidden-xs">btn</label>
    <button type="button" class="btn btn-lg btn-primary btn-block" id="btn-i-pack" onclick="doPacking('i')">ตกลง</button>
  </div>
</div>
<input type="hidden" id="box_id" value="" />
<input type="hidden" id="box_no" value="" />
<hr/>


<script id="box-template" type="text/x-handlebars-template">
  {{#each this}}
    <button type="button"
    class="btn btn-sm box-btn {{ class }}"
    id="btn-box-{{box_id}}"
    style="margin-bottom:3px;"
    onclick="setBox({{box_id}})">
      กล่องที่ {{ no }}&nbsp;&nbsp;
      [ <span id="bqty-{{box_id}}">{{qty}}</span> ]
    </button>
  {{/each}}
</script>
<!-- แสดงผลกล่อง  -->
