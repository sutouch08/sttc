	<?php $active = empty($doc->pack_code) ? "" : "disabled"; ?>
	<?php $g = empty($doc->pack_code) ? "" : "hide"; ?>
	<?php $c = empty($doc->pack_code) ? 'hide' : ''; ?>
<div class="row">
  <div class="col-lg-2 col-md-2 col-sm-2-harf col-xs-8">
    <input type="text" class="form-control text-center" id="pack-code-box" placeholder="ใบแพ็ค" value="<?php echo $doc->pack_code; ?>" <?php echo $active; ?> />
  </div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-4">
		<button type="button" class="btn btn-sm btn-primary btn-block <?php echo $g; ?>" id="btn-pack-code" onclick="getPackItems()">โหลด</button>
		<button type="button" class="btn btn-sm btn-warning btn-block <?php echo $c; ?>" id="btn-clear-code" onclick="clearPackItems()">เคลียร์</button>
	</div>

  <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6 hide">
    <button type="button" class="btn btn-sm btn-danger btn-block" onclick="deleteSelected()">ลบรายการที่เลือก</button>
  </div>
</div>
<hr/>
