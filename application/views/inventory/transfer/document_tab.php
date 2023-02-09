<div id="document-tab" class="tab-pane">
  <div class="row">
    <div class="col-xs-12">
      <input type="text" class="form-control" id="code" value="<?php echo $doc->code; ?>" readonly/>
      <input type="hidden" id="transfer_id" value="<?php echo $doc->id; ?>" />
    </div>
    <div class="col-xs-12">
      <label>From Warehouse</label>
      <select class="form-control" name="fromWhCode" id="fromWhCode">
        <?php if( ! empty($fromWhList)) : ?>
          <?php foreach($fromWhList as $wh) : ?>
            <option value="<?php echo $wh->code; ?>"><?php echo $wh->code ." : ".$wh->name; ?></option>
          <?php endforeach; ?>
        <?php else : ?>
          <option value="">-Now Available-</option>
        <?php endif; ?>
      </select>
      <div class="col-xs-12 col-sm-reset inline red" id="from-wh-error"></div>
    </div>

    <div class="col-xs-12">
      <label>To Warehouse</label>
      <select class="form-control" name="toWhCode" id="toWhCode">
        <?php if( ! empty($toWhList)) : ?>
          <?php foreach($toWhList as $wh) : ?>
            <option value="<?php echo $wh->code; ?>"><?php echo $wh->code ." : ". $wh->name; ?></option>
          <?php endforeach; ?>
        <?php else : ?>
          <option value="">-Now Available-</option>
        <?php endif; ?>
      </select>
      <div class="col-xs-12 col-sm-reset inline red" id="to-wh-error"></div>
    </div>

    <div class="col-xs-12">
      <label>Remark</label>
      <input type="text" class="form-control" name="remark" id="remark" maxlength="254" value="<?php echo $doc->remark; ?>" disabled/>
    </div>
  </div>
</div>
