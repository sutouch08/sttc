<style>
	.top-li {
		list-style-type: none;
		cursor: pointer;
		line-height: 30px;
	}
	.focus {
		background-color:lightsalmon;
		color:white !important;
	}

	li {
		list-style-type: none;
	}

	.width-22-5 {
		width:22.5% !important;
	}
</style>

<div class="row" style="margin-top:-8px; border-bottom:solid 1px #dddddd;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 header-menu orange"><li class="top-li" onclick="goBack()"><i class="fa fa-arrow-left fa-2x"></i></li></div>
			<?php if($this->_Outsource && $doc->status != 1 && $doc->status != 2) : ?>
			<div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 header-menu green focus" id="home"><li class="top-li" onclick="showTab('home')"><i class="fa fa-pencil-square-o fa-2x"></i></li></div>
			<div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 header-menu blue" id="detail"><li class="top-li" onclick="showTab('detail')"><i class="fa fa-tasks fa-2x"></i></li></div>
			<?php endif; ?>
		</div>
	</div>
</div><!-- End Row -->

<div class="row">
	<div class="col-xs-12 padding-5">
		<div class="tabbable">
			<div class="tab-content" style="border: none;">
    <?php
				if($this->_Outsource && $doc->status != 1 && $doc->status != 2 )
				{
					$this->load->view('inventory/transfer/home_tab');
				}
		?>
        <?php $this->load->view('inventory/transfer/detail_tab'); ?>
			</div>
		</div>
	</div>
	</div>

<script id="detail-template" type="text/x-handlebarsTemplate">
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="detail-{{id}}" style="padding:5px;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-card">
			<table class="table border-none"style="margin-bottom:0px; margin-right:10px; max-width:100%;">
				<tr>
					<td style="width:125px;">
						<img src="{{image_path}}" onclick="viewDetail({{id}})" style="width:125px; height: 125px; object-fit:cover;" />
					</td>
					<td class="padding-10 text-right" style="position: relative; vertical-align: text-top; max-width:0;">
						<div class="width-100 margin-bottom-0 text-left"><strong>Serial :</strong> {{serial}}</div>
						<div class="width-100 margin-bottom-0 text-left"><strong>Item code :</strong> {{itemCode}}</div>
						<div class="width-100 margin-bottom-0 text-left"><strong>Description :</strong> {{itemName}}</div>
							<div class="width-100" style="position:absolute; bottom:0px; margin-bottom:0px; padding-bottom:10px; padding-right:10px;">
								<button type="button" class="btn btn-xs btn-danger margin-right-5" onclick="getDeleteDetail({{id}}, '{{serial}}')">
									<i class="fa fa-trash"></i> Delete
								</button>
							</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</script>
