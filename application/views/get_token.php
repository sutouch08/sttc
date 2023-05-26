<?php $this->load->view('include/header'); ?>
	<div class="row">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-center">
	    <h1>Hello! <?php echo $this->_user->uname; ?></h1>
	    <h5>Good to see you here</h5>
	  </div>
		<div class="divider"></div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 padding-5 margin-top-30">
			<div class="input-group width-100">
				<span class="input-group-addon">TOKEN</span>
				<input type="text" id="token" class="form-control text-center" value="<?php echo $token; ?>" readonly />
				<span class="input-group-btn">
					<button type="button" class="btn btn-sm btn-primary" onclick="refresh_token()">Refresh Token</button>
				</span>
			</div>
		</div>

	</div>

	<script>
		function refresh_token() {

			load_in();

			$.ajax({
				url:BASE_URL + 'scs/scs_token/get_token',
				type:'POST',
				cache:false,
				success:function(rs) {
					load_out();

					if(isJson(rs)) {
						let ds = JSON.parse(rs);

						if(ds.status == 'success') {
							$('#token').val(ds.token);

							swal({
								title:'Updated',
								type:'success',
								timer:1000
							});
						}
						else {
							swal({
								title:'Error!',
								text:ds.message,
								type:'error'
							});
						}
					}
					else {
						swal({
							title:'Error!',
							text:rs,
							type:'error'
						});
					}
				}
			});
		}

	</script>
<?php $this->load->view('include/footer'); ?>
