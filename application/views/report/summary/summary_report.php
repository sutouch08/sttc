<?php $this->load->view('include/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/localforage.js"></script>
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 padding-5">
    <p class="pull-right top-p">
      <button type="button" class="btn btn-sm btn-primary" onclick="getReport()">รายงาน</button>
    </p>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 table-responsive" id="result">

  </div>
</div>
<script id="summary-template" type="text/x-handlebarsTemplate">
<table class="table table-striped table-bordered">
  <thead>
    <tr><th colspan="7" class="text-center font-size-18" style="color:orange; background-color:#2f2e2e;"><strong>{{report_date}}</strong></th></tr>
    <tr>
      <th class="fix-width-150 text-center" style="color:white; background-color:black; font-size:18px;"><strong>แพ็ค</strong></th>
      <th class="fix-width-150 text-center" style="color:white; background-color:black; font-size:18px;"><strong>TOR</strong></th>
      <th class="fix-width-150 text-center" style="color:white; background-color:black; font-size:18px;"><strong>Finish</strong></th>
      <th class="fix-width-150 text-center" style="color:white; background-color:black; font-size:18px;"><strong>Close</strong></th>
      <th class="fix-width-150 text-center" style="color:white; background-color:black; font-size:18px;"><strong>โอน</strong></th>
      <th class="fix-width-150 text-center" style="color:white; background-color:black; font-size:18px;"><strong>รวม</strong></th>
      <th class="fix-width-150 text-center" style="color:white; background-color:black; font-size:18px;"><strong>%</strong></th>
    </tr>
  </thead>
  <tbody>
{{#each data}}
  {{#if @last}}
    <tr style="font-size:16px;">
      <td>MAT</td>
      <td colspan="5"></td>
      <td class="text-right">{{mat}}</td>
    </tr>
  {{else}}
  <tr style="font-size:16px;">
    <td>{{team_name}}</td>
    <td class="text-right">{{tor_qty}}</td>
    <td class="text-right">{{finished}}</td>
    <td class="text-right">{{closed}}</td>
    <td class="text-right">{{transfered}}</td>
    <td class="text-right">{{summary}}</td>
    <td class="text-right {{color}}">{{result}}</td>
  </tr>
  {{/if}}
{{/each}}
</tbody>
</table>
</script>

<script>
  window.addEventListener('load', function() {
    localforage.getItem('sttc_summary').then((data) => {
      if(data === null || data === undefined) {
        data = [];
      }
      else {
        let source = $('#summary-template').html();
        let output = $('#result');
        render(source, data, output);
      }
    });
  });


  function getReport() {
    load_in();

    $.ajax({
      url:BASE_URL + 'inventory/summary_report/get_report',
      type:'POST',
      cache:false,
      success:function(rs) {
        load_out();

        if(isJson(rs)) {
          let ds = JSON.parse(rs);
          let source = $('#summary-template').html();
          let output = $('#result');
          render(source, ds, output);

          localforage.setItem('sttc_summary', ds);
        }
        else {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          })
        }
      }
    })
  }
</script>
<?php $this->load->view('include/footer'); ?>
