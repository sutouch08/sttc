<?php $this->load->view('include/header'); ?>
	<div class="row">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-center">
	    <h1>Hello! <?php echo get_cookie('uname'); ?></h1>
	    <h5>Good to see you here</h5>
	  </div>
		<div class="divider"></div>
	</div>
	<?php if( ! $this->_Admin && ! $this->_SuperAdmin) : ?>
	<div class="row">
		<?php if($this->_Outsource) : ?>
		<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-3 col-sm-offset-3 col-xs-6">
			<button type="button" class="btn btn-lg btn-info btn-block" onclick="transferListing()"><i class="fa fa-list-ul"></i> Job List</button>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
			<button type="button" class="btn btn-lg btn-primary btn-block" onclick="addTransferJob()"><i class="fa fa-plus"></i> New Job</button>
		</div>
		<?php endif; ?>
	</div>

	<script>
		function transferListing() {
			window.location.href = BASE_URL + 'inventory/transfer/';
		}

		function addTransferJob() {
			window.location.href = BASE_URL + 'inventory/transfer/add_new/';
		}
	</script>
	<?php endif; ?>

<?php $this->load->view('include/footer'); ?>
