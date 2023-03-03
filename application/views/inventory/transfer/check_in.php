<?php $this->load->view('include/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/html5-qrcode.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/localforage.js"></script>
<input type="hidden" id="scan-type" value="<?php echo getConfig('SCANTYPE'); ?>" />
<div id="cam" class="hide" style="position: absolute; top:0; left:0; height: 100vh; width:100vw; z-index:10; border:solid 1px #000;">
	<div id="reader" style="width:100%;"></div>
</div>

<div class="row" style="margin-top:-8px; border-bottom:solid 1px #dddddd;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 header-menu orange" onclick="mainPage()"><li class="top-li"><i class="fa fa-arrow-left fa-2x"></i></li></div>
			<div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 header-menu green focus" id="home"><li class="top-li foucs" onclick="showTab('home')"><i class="fa fa-qrcode fa-2x"></i></li></div>
			<div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 header-menu blue" id="detail"><li class="top-li" onclick="showTab('detail')"><i class="fa fa-mobile fa-2x"></i></li></div>
		</div>
	</div>
</div><!-- End Row -->

<div class="row">

</div>

<div class="row">
	<div class="col-xs-12 padding-5">

		<div class="row">
			<div class="col-xs-12 padding-5">
				<div class="tabbable">
					<div class="tab-content" style="border: none;">

						<div id="home-tab" class="tab-pane fade active in">
							<div class="row">
								<div class="col-xs-12 text-center">
									<div class="input-group">
										<input type="text" class="form-control input-lg text-center" id="doc-num" placeholder="เลขที่เอกสาร" />
										<span class="input-group-btn">
											<button type="button" class="btn btn-lg btn-primary" onclick="submitDocument()">Submit</button>
										</span>
									</div>
								</div>
							</div>
							<hr/>
							<div class="row">
								<div class="col-xs-12 padding-5 table-responsive text-center" id="promt-text">
									<h1 class="grey">แสกน Barcode เพื่อโหลดข้อมูลสินค้า</h1>
								</div>
								<div class="col-xs-12 padding-5 table-responsive text-center" style="max-height:75vh; overflow:auto;" id="result">

								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center hide" id="btn-save" style="margin-bottom:60px;">
									<button class="btn btn-sm btn-success btn-100" onclick="saveItem()">บันทึกลงโทรศัพท์</button>
								</div>
							</div>

							<div class="bp-footer">
								<span id="test"></span>
								<div class="bp-footer-inner">
									<div class="bp-footer-content text-center" style="z-index:100;">
										<div class="footer-menu width-90 text-center">
											<button type="button" class="btn btn-sm btn-primary btn-100" id="btn-scan" onclick="startScan()">Scan</button>
											<button type="button" class="btn btn-sm btn-info btn-100 hide" id="btn-stop" onclick="stopScan()">Stop</button>
										</div>
										<div class="footer-menu width-10"><li onclick="changeCameraId()"><i class="fa fa-ellipsis-v fa-2x"></i></li></div>
									</div>
								</div><!-- footer inner-->
							</div><!-- /.footer -->
						</div><!-- home tab -->

						<div id="detail-tab" class="tab-pane" style="margin-top:-10px;">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" id="doc-table" style="max-height:200px; overflow: auto; margin-bottom:5px;">
								</div><!-- col-->
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" id="detail-table" style="max-height:400px; overflow: auto; margin-bottom:20px;">
								</div><!-- col-->
							</div><!-- row -->
						</div> <!-- detail tab -->
					</div> <!-- tab content -->
				</div> <!-- Tabable-->
			</div>
	</div>
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

	<script id="docnum-template" type="text/x-handlebarsTemplate">
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding:5px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table class="table table-bordered"style="margin-bottom:20px;">
					<thead>
						<tr>
							<th class="min-width-100 text-center">เลขที่</th>
							<th class="fix-width-100 text-center">จำนวน</th>
							<th class="fix-width-80 text-center"></th>
						</tr>
					</thead>
					{{#each this}}
						<tr>
							<td class="text-center">{{docnum}}</td>
							<td class="text-center">{{qty}}</td>
							<td class="text-center">
								<button type="button" class="btn btn-minier btn-danger" onclick="deleteStockByDocNum('{{docnum}}')">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
					{{/each}}
				</table>
			</div>
		</div>
	</script>

<script id="stock-template" type="text/x-handlebarsTemplate">
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding:5px;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table table-bordered"style="margin-bottom:20px; min-width:800px;">
				<thead>
					<tr>
						<th class="fix-width-40 text-center">#</th>
						<th class="fix-width-100 text-center">docnum</th>
						<th class="fix-width-150 text-center">Serial</th>
						<th class="fix-wisth-120">Item Code</th>
						<th class="min-width-250">Item Name</th>
						<th class="fix-width-100 text-center">Warehouse</th>
					</tr>
				</thead>
				{{#each this}}
					<tr>
						<td class="text-center no"></td>
						<td class="text-center">{{docnum}}</td>
						<td class="text-center">{{serial}}</td>
						<td>{{code}}</td>
						<td>{{name}}</td>
						<td class="text-center">{{whCode}}</td>
					</tr>
				{{/each}}
			</table>
		</div>
	</div>
</script>


<script id="template" type="text/x-handlebarsTemplate">
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding:5px;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table table-bordered"style="margin-bottom:20px; min-width:800px;">
				<thead>
					<tr>
						<th class="fix-width-40 text-center">#</th>
						<th class="fix-width-100 text-center">DocNum</th>
						<th class="fix-width-150 text-center">Serial</th>
						<th class="fix-wisth-120">Item Code</th>
						<th class="min-width-250">Item Name</th>
						<th class="fix-width-100 text-center">Warehouse</th>
					</tr>
				</thead>
				{{#each this}}
					<tr>
						<td>
							{{no}}
							<input type="hidden" class="item-data" data-docnum="{{DocNum}}" data-serial="{{Serial}}" data-code="{{ItemCode}}" data-name="{{ItemName}}" data-wh="{{WhsCode}}" />
						</td>
						<td class="text-center">{{DocNum}}</td>
						<td class="text-center">{{Serial}}</td>
						<td>{{ItemCode}}</td>
						<td>{{ItemName}}</td>
						<td class="text-center">{{WhsCode}}</td>
					</tr>
				{{/each}}
			</table>
		</div>
	</div>
</script>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('YmdHis'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/checkin.js?v=<?php echo date('YmdHis'); ?>"></script>

<script>
//window.onload = getExif;


</script>

<?php $this->load->view('include/footer'); ?>
