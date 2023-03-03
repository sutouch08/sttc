<?php $this->load->view('include/header'); ?>
<style>
	li {
		list-style-type: none;
	}
</style>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
    <h3 class="title">
      <?php echo $this->title; ?>
    </h3>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 padding-5 hidden-xs">
  	<p class="pull-right top-p">
      <button type="button" class="btn btn-sm btn-success" onclick="addNew()"><i class="fa fa-plus"></i> Add new</button>
    </p>
  </div>
</div><!-- End Row -->
<hr class="padding-5"/>
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
						Filter
					</a>
				</h4>
			</div>
			<div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="border-radius: 5px; height: 0px;">
				<div class="panel-body">
					<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
						<div class="row">
							<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
								<label>code</label>
								<input type="text" class="form-control input-sm search-box" name="code" value="<?php echo $code; ?>" />
							</div>

							<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
								<label>From Warehouse</label>
								<input type="text" class="form-control input-sm search-box" name="fromWhCode" value="<?php echo $fromWhCode; ?>" />
							</div>

							<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-6">
								<label>To Warehouse</label>
								<input type="text" class="form-control input-sm search-box" name="toWhCode" value="<?php echo $toWhCode; ?>" />
							</div>

							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
								<label>เขต/พื้นที่</label>
								<select class="form-control input-sm" name="team_id" onchange="getSearch()">
									<option value="all">ทั้งหมด</opton>
										<?php echo select_team($team_id); ?>
									</select>
								</div>

								<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6">
									<label>Status</label>
									<select class="form-control input-sm" name="status" onchange="getSearch()">
										<option value="all">ทั้งหมด</opton>
											<option value="-1" <?php echo is_selected('-1', $status); ?>>Draft</option>
											<option value="1" <?php echo is_selected('1', $status); ?>>Success</option>
											<option value="2" <?php echo is_selected('2', $status); ?>>Cancelled</option>
											<option value="3" <?php echo is_selected('3', $status); ?>>Failed</option>
										</select>
									</div>

									<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3">
										<label class="display-block not-show">buton</label>
										<button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
									</div>
									<div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3">
										<label class="display-block not-show">buton</label>
										<button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
									</div>
								</div>
							</form>
							<div class="divider"></div>
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div>
				</div>
	</div>
</div>

<hr class="margin-top-15">
<style>
	.doc-card {
		border:solid 1px lightsalmon;
		border-radius: 5px;
		margin-bottom:10px;
		text-align: center;
	}

	.doc-head {
		font-size: 20px;
		font-weight: bold;
		color:white;
		background-color: lightsalmon;
		text-align: center;
		margin: -8px -8px 8px;
		padding: 5px;
	}

	.doc-table {
		width:100%;
		max-width:100%;
		margin-bottom: 10px;
	}

	.doc-table > tbody > tr > td {
		padding: 0px 8px 0px 8px;
		font-size: 16px;
	}

	.td-label {
		width:50%;
		text-align: left;
	}

	.hide-text {
		max-width: 10px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.doc-bar {
		font-size: 16px;
		font-weight: bold;
		color:white;
		margin: -8px -8px 8px;
		padding: 5px;
	}
</style>

<div class="row hidden-lg" id="detail-table">
	<?php if( ! empty($data)) : ?>
		<?php foreach($data as $rs) : ?>
			<?php $label = transfer_status_label($rs->status); ?>

			<div class="col-md-4 col-sm-6 col-xs-12" id="detail-<?php echo $rs->id; ?>" onclick="edit(<?php echo $rs->id; ?>)" >
				<div class="doc-card" style="padding:8px;">
					<div class="doc-head"><?php echo $rs->code; ?></div>
					<table class="doc-table">
						<tr><td class="td-label">Date : <?php echo thai_date($rs->docDate, FALSE); ?></td><td class="td-label hide-text"> Area : <?php echo $rs->team_name; ?></td></tr>
						<tr><td class="td-label">Status : <?php echo $label; ?></td><td class="td-label hide-text">Create By : <?php echo $rs->uname; ?></td></tr>
						<?php if( ! empty($rs->remark)) : ?>
						<tr><td colspan="2" class="td-label hide-text">remark : <?php echo $rs->remark; ?></td></tr>
						<?php endif; ?>
				</table>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else : ?>
		<div class="col-md-4 col-sm-6 col-xs-12 doc-card text-center" style="padding:8px;">
			<h4 class="text-center">No Data found </h4>
			<button class="btn btn-sm btn-warning" onclick="clearFilter()">Clear Filter</button>
		</div>
	<?php endif; ?>
</div>


<div class="row visible-lg">
	<div class="col-lg-12 table-responsive">
		<table class="table table-hover border-1" style="min-width:940;">
			<thead>
				<tr>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-100 middle">Code</th>
					<th class="fix-width-150 middle">From Warehouse</th>
          <th class="fix-width-150 middle">To Warehouse</th>
					<th class="fix-width-150 middle text-center">Area</th>
					<th class="fix-width-100 middle text-center">User</th>
					<th class="fix-width-60 middle text-center">Status</th>
					<th class="min-width-120"></th>
				</tr>
			</thead>
			<tbody>
<?php if(!empty($data))	: ?>
	<?php $no = $this->uri->segment($this->segment) + 1; ?>
	<?php foreach($data as $rs) : ?>
				<tr id="row-<?php echo $rs->id; ?>">
					<td class="middle text-center"><?php echo $no; ?></td>
					<td class="middle"><?php echo $rs->code; ?></td>
					<td class="middle"><?php echo $rs->fromWhsName; ?></td>
          <td class="middle"><?php echo $rs->toWhsName; ?></td>
					<td class="middle text-center"><?php echo $rs->team_name; ?></td>
					<td class="middle text-center"><?php echo $rs->uname; ?></td>
					<td class="middle text-center"><?php echo $rs->status; ?></td>
					<td class="middle">
						<button type="button" class="btn btn-minier btn-info" title="Details" onclick="viewDetail('<?php echo $rs->id; ?>')"><i class="fa fa-eye"></i></button>
						<button type="button" class="btn btn-minier btn-warning" onclick="edit('<?php echo $rs->id; ?>')"><i class="fa fa-pencil"></i></button>
						<button type="button" class="btn btn-minier btn-danger" onclick="getDelete('<?php echo $rs->id; ?>', '<?php echo $rs->uname; ?>')"><i class="fa fa-trash"></i></button>
					</td>
				</tr>
				<?php $no++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="divider-hidden"></div>
<div class="divider-hidden"></div>
<div class="divider-hidden"></div>
<div class="divider-hidden"></div>

<div class="pg-footer visible-xs">
	<div class="pg-footer-inner">
		<div class="pg-footer-content text-right" style="z-index:100;">
			<?php if($this->_Outsource) : ?>
			<button type="button" class="btn btn-sm btn-success" onclick="addNew()"><i class="fa fa-plus"></i> Add New</button>
			<?php endif; ?>
		</div>
 </div><!-- footer inner-->
</div><!-- /.footer -->
</div>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
