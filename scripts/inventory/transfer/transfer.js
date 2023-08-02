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


$('#date_add').datepicker({
  dateFormat:'dd-mm-yy'
});



function addNew() {
  window.location.href = HOME + 'add_new';
}


function edit(id) {
  load_in();
  window.location.href = HOME + 'edit/'+id;
}


function viewDetail(id) {
  load_in();
  window.location.href = HOME + 'view_detail/'+id;
}


function getEdit() {
  $('.edit').removeAttr('disabled');
  $('#btn-edit').addClass('hide');
  $('#btn-update').removeClass('hide');
}


function update() {
  let id = $('#transfer_id').val();
  let remark = $('#remark').val();

  load_in();

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      "id" : id,
      "remark" : remark
    },
    success:function(rs) {
      load_out();
      if(rs === 'success') {
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
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        });
      }
    }
  })
}


function confirmCancle() {
  swal({
    title:'ยกเลิก',
    text:'คุณต้องการยกเลิกเอกสารนี้หรือไม่ ?',
    type:'warning',
    showCancelButton:true,
    confirmButtonColor:'#d15b47 ',
    confirmButtonText:'Yes',
    cancelButtonText:'No',
    closeOnConfirm:true
  }, function() {
    setTimeout(() => {
      cancleTransfer();
    }, 200)
  });
}


function cancleTransfer() {
  let id = $('#transfer_id').val();

  load_in();

  $.ajax({
    url:HOME + 'cancle_transfer',
    type:'POST',
    cache:false,
    data:{
      'id' : id
    },
    success:function(rs) {
      load_out();
      if(rs === 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
        });

        setTimeout(() => {
          viewDetail(id);
        }, 1200);
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        });
      }
    }
  })
}



function confirmSave() {
  swal({
    title:'บันทึกเอกสาร ?',
    text:'คุณต้องการบันทึกเอกสารหรือไม่ ?',
    type:'warning',
    showCancelButton:true,
    confirmButtonColor:'#87b87f ',
    confirmButtonText:'Yes',
    cancelButtonText:'No',
    closeOnConfirm:true
  }, function() {
    setTimeout(() => {
      save();
    }, 200)
  });
}


function save() {
  let id = $('#transfer_id').val();
  let date_add = $('#date_add').val();
  let fromWhsCode = $('#fromWhsCode').val();
  let toWhsCode = $('#toWhsCode').val();
  let err = 0;

  $('.no').each(function() {
    let no = $(this).data('no');
    let fromWh = $('#from-'+no).text();
    let toWh = $('#to-'+no).text();

    if((fromWh != fromWhsCode) || (toWh != toWhsCode)) {
      err++;
    }
  });

  if(err > 0) {
    console.log(err);
    swal({
      title:'Error!',
      text:`พบคลังไม่ตรงกับหัวเอกสาร ${err} รายการ กรุณาแก้ไข`,
      type:'error'
    });

    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'save',
    type:'POST',
    cache:false,
    data:{
      "id" : id
    },
    success:function(rs) {
      load_in();

      if(isJson(rs)) {
        let ds = JSON.parse(rs);

        if(ds.status == 'success') {
          setTimeout(() => {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });
          }, 200);

          setTimeout(() => {
            viewDetail(id);
          }, 1200);
        }
        else {
          if(ds.ex == 1) {
            setTimeout(() => {
              swal({
                title:'Warning !',
                text:ds.message,
                type:'warning'
              }, function() {
                viewDetail(id);
              });
            }, 200);
          }
          else {
            setTimeout(() => {
              swal({
                title:'Error!',
                text:ds.message,
                type:'error'
              });
            }, 200);
          }
        }
      }
      else {
        setTimeout(() => {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          });
        }, 200);
      }
    }
  });
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


function checkAll() {
  if( $('#chk-all').is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
}

function selectAll() {
  if($('#select-all').is(':checked')) {
    $('.sel').prop('checked', true);
  }
  else {
    $('.sel').prop('checked', false);
  }
}


function clearList() {
  $('.fl').val('');
}


function getInstallList() {
  let pea_no = $('#pea-no').val();
  let area = $('#area').val();
  $('#select-all').prop('checked', false);

  load_in();

  $.ajax({
    url:BASE_URL + 'inventory/install_list/get_open_items',
    type:'POST',
    cache:false,
    data:{
      "pea_no" : pea_no,
      "area" : area
    },
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        ds = JSON.parse(rs);
        if(ds.length) {
          let source = $('#items-template').html();
          let output = $('#items-table');
          render(source, ds, output);
          $('#installListModal').modal('show');
        }
      }
    }
  })
}

function deleteSelected() {
  let checked = $('.chk:checked').length;

  if(checked > 0) {
    swal({
      title:'คุณแน่ใจ ?',
      text:'ต้องการลบรายการนำเข้าตามที่เลือกไว้หรือไม่ ?',
      type:'warning',
      showCancelButton:true,
      confirmButtonColor:'#d15b47',
      confirmButtonText:'ยืนยัน',
      cancelButtonText:'ยกเลิก',
      closeOnConfirm:true
    }, function() {
      let ds = [];
      $('.chk:checked').each(function() {
        let val = $(this).val();

        ds.push(val);
      });

      if(ds.length > 0) {
        load_in();

        $.ajax({
          url:HOME + 'delete_details',
          type:'POST',
          cache:false,
          data:{
            "data" : JSON.stringify(ds)
          },
          success:function(rs) {
            load_out();

            if(rs === 'success') {
              setTimeout(() => {
                swal({
                  title:'Success',
                  type:'success',
                  timer:1000
                });
              }, 200);

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
                });
              }, 200);
            }
          }
        });
      }
      else {
        setTimeout(() => {
          swal({
            title:"Error!",
            text:"Please select items",
            type:"error"
          });
        }, 200);
      }
    });
  }
}


function addToTransfer() {
  let id = $('#transfer_id').val();
  let ds = [];

  $('.sel').each(function() {
    if($(this).is(':checked')) {
      ds.push($(this).val());
    }
  });

  if(ds.length == 0) {
    swal("กรุณาเลือกรายการ");
    return false;
  }

  $('#installListModal').modal('hide');

  load_in();

  $.ajax({
    url:HOME + 'add_details',
    type:'POST',
    cache:false,
    data:{
      "id" : id,
      "data" : JSON.stringify(ds)
    },
    success:function(rs) {
      load_out();

      if(rs === 'success') {
        setTimeout(() => {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });
        }, 200);

        setTimeout(() => {
          window.location.reload();
        }, 1300);
      }
      else {
        setTimeout(() => {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          });
        }, 200);
      }
    }
  });
}
