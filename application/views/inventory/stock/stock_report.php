<?php $this->load->view('include/header'); ?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
  <div class="col-xs-12 visible-xs">
    <h3 class="title-xs"><?php echo $this->title; ?></h3>
  </div>
</div>
<hr class="margin-bottom-20"/>

<div class="row">

  <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
    <label>
      <input type="radio" name="viewType" value="warehouse" class="ace input-lg"/>
      <span class="lbl bigger-120"> แยกตามคลัง</span>
    </label>
  </div>

  <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
    <label>
      <input type="radio" name="viewType" value="area" class="ace input-lg" />
      <span class="lbl bigger-120"> แยกตามเขต</span>
    </label>
  </div>

  <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
    <label>
      <input type="radio" name="viewType" value="role" class="ace input-lg" />
      <span class="lbl bigger-120"> แยกตามประเภท</span>
    </label>
  </div>



  <div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-12">
    <button type="button" class="btn  btn-sm btn-success btn-xs btn-block" onclick="getReport()">รายงาน</button>
  </div>
</div>
<hr/>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="result" style="max-height:65vh; overflow:auto;">

  </div>
</div>


<input type="hidden" id="all-area" value="1"/>
<input type="hidden" id="all-role" value="1"/>
<input type="hidden" id="all-wh" value="1"/>

<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:300px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">ประเภทคลัง</h4>
       </div>
       <div class="modal-body">
         <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:20px;">
             <label class="display-block"><input type="checkbox" class="ace role-chk" value="0" /><span class="lbl"> คลังรอเบิก</span></label>
             <label class="display-block"><input type="checkbox" class="ace role-chk" value="1" /><span class="lbl"> คลังเบิก</span></label>
             <label class="display-block"><input type="checkbox" class="ace role-chk" value="2" /><span class="lbl"> คลังสำเร็จ</span></label>
             <label class="display-block"><input type="checkbox" class="ace role-chk" value="3" /><span class="lbl"> คลังลงลัง</span></label>
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-right">
           <button type="button" class="btn btn-sm btn-info btn-100" onclick="closeModal('roleModal')">ตกลง</button>
         </div>
       </div>
		</div>
	</div>
</div>


<div class="modal fade" id="warehouseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:300px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">คลัง</h4>
       </div>
       <div class="modal-body">
         <div class="row" style="max-height:65vh; overflow:auto;">
           <?php if( ! empty($warehouse_list)) : ?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:20px;">
               <label>
                 <input type="checkbox" class="ace" id="wh-all" onchange="checkAllWarehouse()" />
                 <span class="lbl">ทั้งหมด</span>
               </label>
             </div>
             <?php foreach($warehouse_list as $wh) : ?>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:20px;">
                <label>
                  <input type="checkbox" class="ace wh-chk" value="<?php echo $wh->code; ?>" />
                  <span class="lbl"><?php echo $wh->code; ?> : <?php echo $wh->name; ?></span>
                </label>
              </div>
             <?php endforeach; ?>
           <?php else : ?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">-- ไม่พบคลัง --</div>
           <?php endif; ?>
         </div>
       </div>
       <div class="modal-footer">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-right">
           <button type="button" class="btn btn-sm btn-info btn-100" onclick="closeModal('warehouseModal')">ตกลง</button>
         </div>
       </div>
		</div>
	</div>
</div>


<div class="modal fade" id="areaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:300px; max-width:95%; margin-left:auto; margin-right:auto;">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">คลัง</h4>
       </div>
       <div class="modal-body">
         <div class="row" style="max-height:65vh; overflow:auto;">
           <?php if( ! empty($area_list)) : ?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:20px;">
               <label>
                 <input type="checkbox" class="ace" id="area-all" onchange="checkAllArea()" />
                 <span class="lbl">ทั้งหมด</span>
               </label>
             </div>
             <?php foreach($area_list as $ar) : ?>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:20px;">
                <label>
                  <input type="checkbox" class="ace area-chk" value="<?php echo $ar->id; ?>" />
                  <span class="lbl"><?php echo $ar->code; ?> : <?php echo $ar->name; ?></span>
                </label>
              </div>
             <?php endforeach; ?>
           <?php else : ?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">-- เขต --</div>
           <?php endif; ?>
         </div>
       </div>
       <div class="modal-footer">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-right">
           <button type="button" class="btn btn-sm btn-info btn-100" onclick="closeModal('areaModal')">ตกลง</button>
         </div>
       </div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>scripts/inventory/stock/stock.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
