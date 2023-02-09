<?php $this->load->view('include/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/html5-qrcode.min.js"></script>
<input type="hidden" id="scan-type" value="<?php echo getConfig('SCANTYPE'); ?>" />
<div id="cam" class="hide" style="position: absolute; top:0; left:0; height: 100vh; width:100vw; z-index:10; border:solid 1px #000;">
	<div id="reader" style="width:100%;"></div>
</div>
<?php $this->load->view('inventory/transfer/tab_content'); ?>

<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer.js?v=<?php echo date('YmdHis'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/transfer/transfer_add.js?v=<?php echo date('YmdHis'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
