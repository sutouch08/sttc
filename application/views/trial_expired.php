<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
    	<center><h1><i class="fa fa-lock fa-3x"></i></h1></center>
      <center><h3>We are sorry</h3></center>
      <p><h4 style="line-height:1.5;"><?php echo $text; ?></h4></p>
			<p><h4 class="text-right">&mdash; The Team</h4></p>
    </div>
</div>

<script>
	$(document).ready(function() {
		//---	reload ทุก 5 นาที
		setTimeout(function(){ window.location.reload(); }, 300000);
	});
</script>
<?php $this->load->view('include/footer'); ?>
<?php exit(); ?>
