var HOME = BASE_URL + 'inventory/transfer/';

$('#fromDate').datepicker({
  dateFormat:'dd-mm-yy',
  onClose:function(sd) {
    $('#toDate').datepicker('option', 'minDate', sd);
  }
});

$('#toDate').datepicker({
  dateFormat:'dd-mm-yy',
  onClose:function(sd) {
    $('#fromDate').datepicker('option', 'maxDate', sd);
  }
});

function goBack() {
  window.location.href = HOME;
}


function addNew() {
  window.location.href = HOME + 'add_new';
}


function edit(id) {
  $('#transfer-id').val(id);

  load_in();

  $.ajax({
    url:HOME + 'get_item/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let source = $('#edit-template').html();
        let data = JSON.parse(rs);
        let output = $('#edit-detail');

        render(source, data, output);

        $('#editModal').modal('show');
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        })
      }
    }
  });
}


function getEdit()
{
  let id = $('#transfer-id').val();

  $('#previewModal').modal('hide');

  load_in();

  $.ajax({
    url:HOME + 'get_item/'+id,
    type:'GET',
    cache: false,
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let source = $('#edit-template').html();
        let data = JSON.parse(rs);
        let output = $('#edit-detail');

        render(source, data, output);

        $('#editModal').modal('show');
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


function showTab(name) {
  $('.header-menu').removeClass('focus');
  $('.tab-pane').removeClass('active in');
  $('#'+name).addClass('focus');
  $('#'+name+'-tab').addClass('active in');
}


function preview(id) {
  $('#transfer-id').val(id);

  load_in();

  $.ajax({
    url:HOME + 'get_item/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let source = $('#preview-template').html();
        let data = JSON.parse(rs);
        let output = $('#item-detail');

        render(source, data, output);

        if(data.status == 0 && data.is_approve == 0) {
          $('#btn-approve').removeClass('hide');
        }

        if(data.status == 1 || data.is_approve > 0) {
          $('#btn-approve').addClass('hide');
          $('#btn-edit').addClass('hide');
        }
        else {
          $('#btn-edit').removeClass('hide');
        }

        if(data.status > 0 && data.is_approve == 1) {
          $('#btn-temp').removeClass('hide');
        }
        else {
          $('#btn-temp').addClass('hide');
        }

        $('#previewModal').modal('show');
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


function doApprove() {
  let id = $('#transfer-id').val();
  let no = $('#no-'+id).text();

  $('#previewModal').modal('hide');

  setTimeout(() => {
    load_in();

    $.ajax({
      url:HOME + 'approve',
      type:'POST',
      cache:false,
      data:{
        "id" : id
      },
      success:function(rs) {
        load_out();
        if(rs == 'success') {
          swal({
            title:'Approved',
            type:'success',
            timer:1000
          });

          setTimeout(() => {
            window.location.reload();
          }, 1200);

          //updateRow(id, no);
        }
      }
    });
  }, 500);
}


function updateRow(id, no) {
  $.ajax({
    url:HOME + 'get_row/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      if(isJson(rs)) {
        let source = $('#row-template').html();
        let data = JSON.parse(rs);
        let output = $('#row-'+id);

        render(source, data, output);

        $('#no-'+id).text(no);
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


function suggest() {
  let year = parseDefault(parseInt($('#mYear').val()), 0);
  let cond = $('#condition').val();
  let label = "";

  if(year == 0 || year == "" || cond == "") {
    if(cond == "" && (year == "" || year == 0)) {
      $('#suggest-label').html(`<div>กรุณาระบุปีและสภาพมิเตอร์</div>`);
    }
    else {
      if(cond != "" && (year == 0 || year == "")) {
        $('#suggest-label').html(`<div>กรุณาระบุปีมิเตอร์</div>`);
      }

      if(cond == "" && (year != 0 && year != "")) {
        $('#suggest-label').html(`<div>กรุณาระบุสภาพมิเตอร์</div>`);
      }
    }

    $('#use-age').text("0 ปี");
    $('#useAge').val("");
  }
  else {
    let thisYear = new Date().getFullYear();
    let age = thisYear - year;
    let label = `<div style="background-color:red; width:20px; height:20px;"></div>`;

    $('#use-age').text(age + " ปี");
    $('#useAge').val(age);

    if( age < 10 )
    {
      if( cond == 2 && age > 3) {
        label = `<div style="background-color:orange; width:20px; height:20px;"></div>`;
      }

      if( cond == 2 && age <= 3) {
        label = `<div style="background-color:blue; width:20px; height:20px;"></div>`;
      }

      if( cond == 1) {
        label = `<div style="background-color:green; width:20px; height:20px;"></div>`;
      }
    }

    $('#suggest-label').html(label);
  }
}


function updateItem() {
  let id = $('#transfer-id').val();
  let peaNo = $('#peaNo').val();
  let powerNo = $('#powerNo').val();
  let mYear = $('#mYear').val();
  let cond = $('#condition').val();
  let useAge = $('#useAge').val();

  //$('#editModal').modal('hide');

  setTimeout(() => {
    if(id == "" || id == 0) {
      swal({
        title:'Oops!',
        text: "Missing required parameter : transferId",
        type:'error'
      });

      return false;
    }

    if(peaNo.length != 10) {
      swal({
        title:'Oops!',
        text:"PEA NO ไม่ถูกต้อง",
        type:'error'
      });

      return false;
    }

    if(powerNo.length != 5) {
      swal({
        title:'Opps!',
        text:"หน่วยไฟไม่ถูกต้อง",
        type:'error'
      });

      return false;
    }

    if(mYear == "" || mYear == 0) {
      swal({
        title:'Opps!',
        text:"กรุณาระบุปีมิเตอร์",
        type:'error'
      });

      return false;
    }

    if(cond == "" || cond == 0) {
      swal({
        title:'Opps!',
        text:"กรุณาระบุสภาพมิเตอร์",
        type:'error'
      });

      return false;
    }

    if(useAge === "") {
      swal({
        title:'Opps!',
        text:'อายุการใช้งานไม่ถูกต้อง',
        type:'error'
      });

      return false;
    }

    $('#editModal').modal('hide');
    load_in();

    $.ajax({
      url:HOME + 'update_item/'+id,
      type:'POST',
      cache:false,
      data: {
        'peaNo' : peaNo,
        'powerNo' : powerNo,
        'mYear' : mYear,
        'cond' : cond,
        'useAge' : useAge
      },
      success:function(rs) {
        load_out();

        if(rs == 'success') {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });
        }
        else {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          },
          function() {
            $('#editModal').modal('show');
          });
        }
      }
    })

  }, 200);

}
