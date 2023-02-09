<?php $active = ($doc->status == 1 OR $doc->status == 2 OR ! $this->_Outsource) ? 'active in' : ''; ?>
<div id="detail-tab" class="tab-pane <?php echo $active; ?>" style="margin-top:-10px;">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 accordion-style1 panel-group" style="margin-bottom:0px;">
  		<div class="panel panel-default" style="border-radius: 5px; border-color:lightsalmon;">
  			<div class="panel-heading" style="color:white; background-color:lightsalmon; border-color:lightsalmon;">
  				<h4 class="panel-title">
  					<a class="accordion-toggle collapsed width-100" style="color:white; background-color:lightsalmon; font-size:20px; font-weight:normal;"
  					data-toggle="collapse"
  					data-parent="#accordion"
  					href="#collapseOne"
  					aria-expanded="false">
  						<i class="bigger-110 ace-icon fa fa-angle-right pull-right"
  						data-icon-hide="ace-icon fa fa-angle-down"
  						data-icon-show="ace-icon fa fa-angle-right"></i>
  						Document
  					</a>
  				</h4>
  			</div>

        <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="border-radius: 5px; height: 0px;">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
                <label>Doc No.</label>
                <input type="text" class="form-control text-center" id="code" value="<?php echo $doc->code; ?>" readonly />
                <input type="hidden" id="transfer_id" value="<?php echo $doc->id; ?>" />
              </div>
              <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
                <label>Doc Date</label>
                <input type="text" class="form-control text-center" id="docDate" value="<?php echo thai_date($doc->docDate, FALSE); ?>" readonly />
              </div>
              <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
                <label>From Warehouse</label>
                <input type="text" class="form-control" value="<?php echo $doc->fromWhsCode . " : ".$doc->from_warehouse_name; ?>" readonly />
                <input type="hidden" id="fromWhCode" value="<?php echo $doc->fromWhsCode; ?>" />
              </div>
              <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
                <label>From Warehouse</label>
                <input type="text" class="form-control" value="<?php echo $doc->toWhsCode . " : ".$doc->to_warehouse_name; ?>" readonly />
                <input type="hidden" id="toWhCode" value="<?php echo $doc->toWhsCode; ?>" />
              </div>
              <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-8">
                <label>Remark</label>
                <input type="text" class="form-control" value="<?php echo $doc->remark; ?>" readonly />
              </div>
              <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-4">
                <label>SAP No</label>
                <input type="text" class="form-control text-center" value="<?php echo $doc->docNum; ?>" readonly />
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
  <style>
    .border-none > tbody > tr > td {
      border: none;
    }

    .list-card {
      border-radius: 5px;
      border: solid 1px lightsalmon;
      padding: 0px;
    }
  </style>

  <?php
      if($doc->status == 2)
      {
        $this->load->view('cancle_watermark');
      }

  ?>
  <div class="row" id="detail-table">
    <?php if( ! empty($details)) : ?>
  		<?php foreach($details as $rs) : ?>
  			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="detail-<?php echo $rs->id; ?>" style="padding:5px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-card">
              <table class="table border-none"style="margin-bottom:0px; margin-right:10px; max-width:100%;">
                <tr>
                  <td style="width:125px;">
                    <img src="<?php echo get_image_path($rs->InstallSerialNum, 'installed'); ?>" onclick="viewDetail(<?php echo $rs->id; ?>)" style="width:125px; height: 125px; object-fit:cover;" />
                  </td>
                  <td class="padding-10 text-right" style="position: relative; vertical-align: text-top; max-width:0;">
                    <div class="width-100 margin-bottom-0 text-left"><strong>Serial :</strong> <?php echo $rs->InstallSerialNum; ?></div>
                    <div class="width-100 margin-bottom-0 text-left"><strong>Item code :</strong> <?php echo $rs->ItemCode; ?></div>
                    <div class="width-100 margin-bottom-0 text-left"><strong>Description :</strong> <?php echo $rs->ItemName; ?></div>
                    <?php if($doc->status != 1 && $doc->status != 2 && $rs->LineStatus == 'O') : ?>
                      <div class="width-100" style="position:absolute; bottom:0px; margin-bottom:0px; padding-bottom:10px; padding-right:10px;">
                        <button type="button" class="btn btn-xs btn-danger margin-right-5" onclick="getDeleteDetail(<?php echo $rs->id; ?>, '<?php echo $rs->InstallSerialNum; ?>')">
                          <i class="fa fa-trash"></i> Delete
                        </button>
                      </div>
                    <?php endif; ?>
                  </td>
                </tr>
              </table>
            </div>

        </div>
  		<?php endforeach; ?>
  	<?php endif; ?>
  </div>

<?php if($doc->status != 1 && $doc->status != 2) : ?>
  <div class="divider-hidden"></div>
  <div class="divider-hidden"></div>
  <div class="divider-hidden"></div>
  <div class="divider-hidden"></div>


  <div class="bp-footer">
    <span id="test"></span>
    <div class="bp-footer-inner">
      <div class="bp-footer-content text-center" style="z-index:100;">
        <div class="footer-menu width-25">
          <?php if($this->_Outsource && ($doc->status == -1 OR $doc->status == 0 OR $doc->status == 3)) : ?>
          <button type="button"
            class="btn btn-sm btn-danger btn-block" id="btn-doc-canele"
            onclick="cancleDocument(<?php echo $doc->id; ?>, '<?php echo $doc->code; ?>')">
            <i class="fa fa-times"></i> Cancel
          </button>
          <?php endif; ?>
        </div>
        <div class="footer-menu width-25"><li>&nbsp;</li></div>
        <div class="footer-menu width-25"><li>&nbsp;</li></div>
        <div class="footer-menu width-25">
          <?php if($this->_Outsource && ($doc->status == -1 OR $doc->status == 0 OR $doc->status == 3)) : ?>
          <button type="button" class="btn btn-sm btn-success btn-block" id="btn-doc-save" onclick="saveDocument()"><i class="fa fa-save"></i> Save</button>
          <?php endif; ?>
        </div>
      </div>
    </div><!-- footer inner-->
  </div><!-- /.footer -->
<?php endif; ?>
</div>

<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
   <div class="modal-content">
       <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title">Item detail</h4>
       <input type="hidden" id="detail-id" value="" />
      </div>
      <div class="modal-body">
        <div class="row" id="item-detail" style="max-height:90vh; overflow:auto;">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default btn-100" onclick="closeModal('detail-modal')">Close</button>
      </div>
   </div>
 </div>
</div>


<script id="item-detail-template" type="text/x-handlebarsTemplate">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <table class="table table-bordered"style="margin-right:10px;">
      <tr>
        <td class="padding-10 text-right" style="position: relative; vertical-align: text-top; max-width:100%;">
          <div class="width-100 margin-bottom-0 text-left"><strong>Install Serial :</strong> {{i_serial}}</div>
          <div class="width-100 margin-bottom-0 text-left"><strong>Item code :</strong> {{i_item_code}}</div>
          <div class="width-100 margin-bottom-0 text-left"><strong>Description :</strong> {{i_item_name}}</div>
          <div class="width-100 margin-bottom-0 text-left"><strong>From WH :</strong> {{fromWhsCode}} : {{fromWhsName}}</div>
          <div class="width-100 margin-bottom-0 text-left"><strong>To WH :</strong> {{toWhsCode}} : {{toWhsName}}</div>
          <div class="width-100 margin-bottom-0 text-left"><strong>Returnned Serial :</strong> {{u_serial}}</div>
          <div class="width-100 margin-bottom-0 text-left"><strong>Status :</strong> {{{status_label}}}</div>
        </td>
      </tr>
      <tr>
        <td>
          <img src="{{i_image_path}}" style="width:100%;" />
          <div class="width-100 margin-bottom-0 text-center red"><strong>Serial :</strong> {{i_serial}}</div>
        </td>
      </tr>
      <tr>
        <td>
          <img src="{{u_image_path}}" style="width:100%;" />
          <div class="width-100 margin-bottom-0 text-center red"><strong>Serial :</strong> {{u_serial}}</div>
        </td>
      </tr>
    </table>
  </div>
</div>
</script>
