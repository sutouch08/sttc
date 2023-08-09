<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog" style="min-width:250px; max-width:90vw;">
   <div class="modal-content">
       <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title">นำเข้าไฟล์ Excel</h4>
      </div>
      <div class="modal-body">
        <form id="upload-form" name="upload-form" method="post" enctype="multipart/form-data">
        <div class="row margin-left-0 margin-right-0">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5">
            <button type="button" class="btn btn-lg btn-primary btn-block" id="show-file-name" onclick="getFile()">เลือกไฟล์ Excel</button>
          </div>
        </div>
        <input type="file" class="hide" name="uploadFile" id="uploadFile" accept=".csv" />
        <input type="hidden" name="555" />
        </form>
       </div>
      <div class="modal-footer">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-5 text-right">
          <button type="button" class="btn btn-sm btn-info btn-100" onclick="uploadfile()"><i class="fa fa-cloud-upload"></i> นำเข้า</button>
        </div>
      </div>
   </div>
 </div>
</div>

<style>
  #modal-body {
    border-radius: 10px;
  }

</style>
<div class="modal fade" id="progress-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
 <div class="modal-dialog" style="width:250px;">
   <div class="modal-content"  id="modal-body">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-15 text-center font-size-18" id="txt-label">Reading file..</div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="padding-left:20px; padding-right:20px;">
            <div class="progress pos-rel progress-striped" style="background-color:#CCC;" id="txt-percent" data-percent="0%">
        			<div class="progress-bar progress-bar-primary" id="progress-bar" style="width: 0%;"></div>
        		</div>
          </div>
          <div class="col-xs-12 text-center margin-top-10">
            <button type="button" class="btn btn-sm btn-primary btn-100" onclick="stop_import()">หยุด</button>
          </div>
        </div>
      </div>
   </div>
 </div>
</div>


<script>
<?php if( ! empty($area_list)) : ?>
<?php $ai = 0; ?>
var areaList = {
  <?php foreach($area_list as $as) : ?>
  <?php echo $ai == 0 ? "'{$as->code}' : '{$as->code}'" : ", '{$as->code}' : '{$as->code}'"; ?>
  <?php $ai++; ?>
  <?php endforeach; ?>
};
<?php else : ?>
var areaList = {};
<?php endif; ?>
var count = 0;
var imported = 0;
var allow_import = 0;
var label = $('#txt-label');
var importData = [];
var importKey = 0;

function sendData(data) {
  if(data.length > 0) {
    count = data.length;
    label.text()
    label.text('Importing '+ imported +'/'+ count);
    $('#progress-modal').modal('show');

    setTimeout(() => {
      var r = 0;
      var c = 0;
      var v = 100;
      var ds = [];

      data.forEach(function(el) {
        if(c == v) {
          importData.push(ds);
          c = 0;
          ds = [];
          ds.push(el);
          c++;
        }
        else {
          ds.push(el);
          c++;
        }
      });

      if(ds.length) {
        importData.push(ds);
        ds = [];
      }

      send_data();

    }, 1000);
  }
}

function send_data() {
  if(allow_import == 1) {
    let limit = importData.length;
    let data = importData[importKey];
    let no = data.length;
    console.log(limit);
    console.log(no);
    $.ajax({
      url:HOME + 'add_rows',
      type:'POST',
      cache:false,
      data:{
        "data" : JSON.stringify(data)
      },
      success:function(rs) {
        imported += no;
        importKey++;
        label.text('Imported '+ imported +'/'+ count);
        update_progress();
        if(imported >= count) {
          finish_import();
        }

        ro = importKey + 1;
        if(ro <= limit) {
          send_data();
        }
      }
    })
  }
}


function finish_import() {
  setTimeout(() => {
    $('#progress-modal').modal('hide');

    setTimeout(() => {
      window.location.reload();
    }, 1000);
  }, 1000);
}

function stop_import() {
  allow_import = 0;
  finish_import();
}


function update_progress(){
  percent = (imported/count) * 100;

  var percentage;

  if(percent > 100){
    percentage = 100;
  }else{
    percentage = parseInt(percent);
  }

  $('#txt-percent').attr("data-percent", percentage + "%");
  $('#progress-bar').css("width", percentage + "%");

}

function getFile(){
  $('#uploadFile').click();
}

$("#uploadFile").change(function(){
	if($(this).val() != '')
	{
		var file 		= this.files[0];
		var name		= file.name;
		var type 		= file.type;
		var size		= file.size;

		if( size > 5000000 )
		{
			swal("ขนาดไฟล์ใหญ่เกินไป", "ไฟล์แนบต้องมีขนาดไม่เกิน 5 MB", "error");
			$(this).val('');
			return false;
		}
		//readURL(this);
    $('#show-file-name').text(name);
	}
});


function uploadfile()
{
  count = 0;
  imported = 0;
  allow_import = 1;

  $('#upload-modal').modal('hide');

  var file	= $("#uploadFile")[0].files[0];

  if( file !== '')
  {
    var reader = new FileReader();
    reader.readAsText(file);
    reader.onload = function(e) {
      try{
        setTimeout(() => {
          var jsonData = [];
          var header = ["work_date", "u_pea_no", "i_pea_no", "meter_age", "meter_type", "meter_size", "dispose_reason", "meter_read_end", "route", "area", "worker"];
          var rows = e.target.result.split("\r\n");
          var first = rows[0].split(',');
          if(first.length != 11) {

            swal({
              title:'Error!',
              text:'รูปแบบไฟล์ไม่ถูกต้องกรุณาตรวจสอบ',
              type:'error'
            });

            return false;
          }

          for(var i = 0; i < rows.length; i++) {
            var cells = rows[i].split(',');
            if(cells[0] !='CreatedDate' && cells[0] != '' && cells[1] != '' && cells[2] != '' && areaList[cells[9]] !== undefined) {
              var rowData = {};
              for(var j = 0; j < cells.length; j++) {
                var key = header[j];
                if(key) {
                  rowData[key] = cells[j].replace(/"/g, '').trim();
                }
              }

              jsonData.push(rowData);
            }
          }

          if(jsonData.length) {
            sendData(jsonData);
          }
        }, 200)
      }
      catch(e) {
        console.log(e);
        setTimeout(() => {
          swal({
            title:'Error!',
            text:"Error!",
            type:"error"
          });
        }, 200)
      }
    }
  }
}


</script>
