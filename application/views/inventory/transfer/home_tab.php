<div id="home-tab" class="tab-pane fade active in">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="min-height: 400px; max-height:100%;">
      <span class="label label-xlg label-success label-white middle width-100" style="font-size:20px; height:45px; line-height:0.5; padding:15px 10px 15px 10px;">Install</span>
      <div class="col-xs-12 text-left" id="i-result" style="color:green;"></div>
      <div class="col-xs-12 text-left" >
        <div class="width-100" id="i-preview">

        </div>
        <button type="button"
          class="btn btn-mini btn-danger hide"
          style="position:absolute; top:0; right:5px;"
          id="del-i-image" onclick="removeImage('i')">
          <i class="fa fa-trash"></i>
        </button>
      </div>
      <input type="file" class="hide" id="i-photo" accept="image/jpeg" capture>
    </div>


    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center" style="min-height: 400px; max-height:100%;">
      <span class="label label-xlg label-info label-white middle width-100" style="font-size:20px; height:45px; line-height:0.5; padding:15px 10px 15px 10px;">Return</span>
      <div class="col-xs-12 text-left" id="u-result" style="color:blue;"></div>
      <div class="col-xs-12 text-left">
        <div class="width-100" id="u-preview">

        </div>
        <button type="button"
        class="btn btn-mini btn-danger hide"
        style="position:absolute; top:0; right:5px;"
        id="del-u-image" onclick="removeImage('u')">
        <i class="fa fa-trash"></i>
      </button>
    </div>
    <input type="file" class="hide" id="u-photo" accept="image/jpeg" capture>
  </div>
  </div>




  <div class="row">
    <div class="col-xs-12 text-center">
      <button type="button" class="btn btn-success btn-sm btn-100 margin-top-15 hide" id="btn-save-item" onclick="saveItem()">SAVE</button>
    </div>
  </div>


  <div class="bp-footer">
  	<span id="test"></span>
  	<div class="bp-footer-inner">
  		<div class="bp-footer-content text-center" style="z-index:100;">

        <div class="footer-menu width-22-5">
          <li id="btn-i-scan" onclick="startScan('i')"><i class="fa fa-qrcode fa-2x green"></i></li>
          <li id="btn-i-stop" class="hide" onclick="stopScan('i')"><i class="fa fa-stop-circle fa-2x green"></i></li>
        </div>
        <div class="footer-menu width-22-5"><li onclick="takePhoto('i')"><i class="fa fa-camera fa-2x green"></i></li></div>


  			<div class="footer-menu width-22-5">
          <li id="btn-u-scan" onclick="startScan('u')"><i class="fa fa-qrcode fa-2x blue"></i></li>
          <li id="btn-u-stop" class="hide" onclick="stopScan('u')"><i class="fa fa-stop-circle fa-2x blue"></i></li>
        </div>
        <div class="footer-menu width-22-5"><li onclick="takePhoto('u')"><i class="fa fa-camera fa-2x blue"></i></li></div>
        <div class="footer-menu width-10"><li onclick="changeCameraId()"><i class="fa fa-ellipsis-v fa-2x"></i></li></div>


  		</div>
   </div><!-- footer inner-->
  </div><!-- /.footer -->
</div>

<div class="modal fade" id="cameras-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog" style="width:500px; max-width:95%; margin-left:auto; margin-right:auto;">
   <div class="modal-content">
       <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title">Choose Camera</h4>
       <input type="hidden" id="select-side" value="i" />
      </div>
      <div class="modal-body">
        <div class="row" id="cameras-list" style="padding-left:12px; padding-right:12px;">

        </div>
        <div class="err-label" id="camera-error"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default btn-100" onclick="closeModal('cameras-modal')">Close</button>
				<button type="button" class="btn btn-sm btn-success btn-100" onclick="saveCameraId()">Choose</button>
      </div>
   </div>
 </div>
</div>

<script id="cameras-list-template" type="text/x-handlebarsTemplate">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  {{#each this}}
  <div class="radio">
    <label>
      <input type="radio" name="camera_id"  class="ace" maxlength="100"	value="{{id}}" />
      <span class="lbl">{{label}}</span>
    </label>
  </div>
  {{/each}}
</div>
</script>
