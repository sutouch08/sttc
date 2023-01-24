<?php $this->load->view('include/header'); ?>
	<div class="row">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-center">
	    <h1>Hello! <?php echo get_cookie('displayName'); ?></h1>
	    <h5>Good to see you here</h5>
	  </div>
	  <div class="divider-hidden"></div>
		<div class="divider"></div>
	  <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 padding-5 text-center">

	  </div>

	</div>

<?php if($this->_SuperAdmin) : ?>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
			<button type="button" class="btn btn-sm btn-primary" onclick="GetQuotaStock()">Test</button>
		</div>
	</div>

	<script>
	function GetQuotaStock() {
		$.ajax({
			url:BASE_URL + 'main/testApi',
			type:'GET',
			cache:false,
			success:function(rs) {
				console.log(rs);
			}
		});
	}
	</script>
<?php endif; ?>

<?php $this->load->view('include/footer'); ?>
