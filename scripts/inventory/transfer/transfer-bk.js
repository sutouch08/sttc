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

        $('#damage_id').val(data.damage_id);
        $('#phase').val(data.phase);
        powerInit();

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


function getEdit() {
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
        console.log(data)
        $('#damage_id').val(data.damage_id);
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

        $('#btn-approve').addClass('hide');
        $('#btn-reject').addClass('hide');
        $('#btn-edit').addClass('hide');
        $('#btn-temp').addClass('hide');
        $('#btn-scs').addClass('hide');

        if(data.status == 'I' && data.is_approve == 0) {
          $('#btn-approve').removeClass('hide');
          $('#btn-reject').removeClass('hide');
          $('#btn-edit').removeClass('hide');
        }

        if(data.status == 'A' && data.is_approve == 1 && (data.sap_status == 'P' || data.sap_status == 'F')) {
          $('#btn-temp').removeClass('hide');
        }

        if(data.status == 'A' && data.is_approve == 1 && (data.pea_status == 'P' || data.pea_status == 'F')) {
          $('#btn-scs').removeClass('hide');
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
        }
        else {
          swal({
            title:'Error!',
            text: rs,
            type:'error'
          }, function() {
            setTimeout(() => {
              window.location.reload();
            }, 500);
          });
        }
      }
    });
  }, 500);
}


function doReject() {
  let id = $('#transfer-id').val();

  swal({
    title:'กรุณายืนยัน',
    text:'กรุณายืนยันว่าคุณ "ไม่อนุมัติ" รายการนี้<br/>เพื่อให้ใบสั่งงานถูกดึงกลับไปแก้ไขใหม่อีกครั้ง',
    type:'warning',
    html:true,
    showCancelButton:true,
    confirmButtonText: 'ยืนยัน',
    cancelButtonText:'ยกเลิก',
    closeOnConfirm:true
  }, function() {
    $('#previewModal').modal('hide');
    load_in();

    $.ajax({
      url:HOME + 'reject',
      type:'POST',
      cache:false,
      data:{
        'id' : id
      },
      success:function(rs) {
        load_out();

        if(rs == 'success') {
          setTimeout(() => {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });

            setTimeout(() => {
              window.location.reload();
            }, 1200);
          }, 200);
        }
        else {
          setTimeout(() => {
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            });
          }, 200)
        }
      }
    })
  })
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

  let age = parseDefault(parseInt($('#use-age').val()), 0);
  let cond = $('#damage_id').val();
  let color = "red";

  if(age <= 10) {
    if(cond != '0' && age > 3) {
      color = "orange";
    }

    if(cond != '0' && age <= 3) {
      color = "blue";
    }

    if(cond == '0') {
      color = "green";
    }
  }

  let label = `<div style="background-color:${color}; width:40px; height:40px;"></div>`;
  $('#suggest-label').html(label);

}



function updateItem() {
  $('#btn-update').attr('disabled', 'disabled');

  let id = $('#transfer-id').val();
  let i_power_no = $('#i-power-no').val();
  let u_power_no = $('#u-power-no').val();
  let damage_id = $('#damage_id').val();
  let phase = $('#phase').val();


  setTimeout(() => {
    if(id == "" || id == 0) {
      swal({
        title:'Oops!',
        text: "Missing required parameter : transferId",
        type:'error'
      });

      $('#btn-update').removeAttr('disabled');

      return false;
    }


    if(i_power_no.length != 5) {
      swal({
        title:'Opps!',
        text:"หน่วยตัดกลับไม่ถูกต้อง",
        type:'error'
      });

      $('#btn-update').removeAttr('disabled');
      return false;
    }

    if(u_power_no.length != 5) {
      swal({
        title:'Opps!',
        text:"หน่วยตั้งต้นไม่ถูกต้อง",
        type:'error'
      });

      $('#btn-update').removeAttr('disabled');
      return false;
    }

    $('#editModal').modal('hide');

    load_in();

    $.ajax({
      url:HOME + 'update_item/'+id,
      type:'POST',
      cache:false,
      data: {
        'i_power_no' : i_power_no,
        'u_power_no' : u_power_no,
        'damage_id' : damage_id,
        'phase' : phase
      },
      success:function(rs) {
        load_out();

        if(rs == 'success') {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });

          setTimeout(() => {
            window.location.reload();
          }, 1200);
        }
        else {
          $('#btn-update').removeAttr('disabled');
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


function sendToSAP() {
  let id = $('#transfer-id').val();

  $('#previewModal').modal('hide');

  setTimeout(() => {
    load_in();

    $.ajax({
      url:HOME + 'send_to_sap',
      type:'POST',
      cache:false,
      data:{
        'id' : id
      },
      success:function(rs) {
        load_out();

        if(rs == 'success') {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });

          setTimeout(() => {
            window.location.reload();
          }, 1200);
        }
        else {
          setTimeout(() => {
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            }, () => {
              $('#previewModal').modal('show');
            });
          }, 200)
        }
      }
    });
  }, 500);
}


function sendToSCS() {
  let id = $('#transfer-id').val();

  $('#previewModal').modal('hide');

  setTimeout(() => {
    load_in();

    $.ajax({
      url:HOME + 'send_to_scs',
      type:'POST',
      cache:false,
      data:{
        'id' : id
      },
      success:function(rs) {
        load_out();

        if(rs == 'success') {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });

          setTimeout(() => {
            window.location.reload();
          }, 1200);
        }
        else {
          setTimeout(() => {
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            }, () => {
              $('#previewModal').modal('show');
            });
          }, 200)
        }
      }
    });
  }, 500);
}
