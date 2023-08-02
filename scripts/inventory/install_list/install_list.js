var HOME = BASE_URL + 'inventory/install_list/';

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


function getImportFile() {
  $('#upload-modal').modal('show');
}


function preview(id) {
  load_in();

  $.ajax({
    url:HOME + 'get_detail/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let ds = JSON.parse(rs);
        let source = $('#preview-template').html();
        let output = $('#preview-table');

        render(source, ds, output);

        $('#previewModal').modal('show');
      }
      else {
        swal({
          title:'Error',
          text:rs,
          type:'error'
        });
      }
    }
  })
}



function confirmDelete() {
  let ds = $('.chk:checked');

  if(ds.length > 0) {

    let data = [];

    ds.each(function() {
      data.push(this.value);
    });

    if(data.length > 0) {
      swal({
        title:'คุณแน่ใจ ?',
        text:'ต้องการลบรายการนำเข้าตามที่เลือกไว้หรือไม่ ?',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#d15b47',
        confirmButtonText:'ยืนยัน',
        cancelButtonText:'ยกเลิก',
        closeOnConfirm:true
      },
      function() {
        load_in();
        $.ajax({
          url:HOME + 'delete_rows',
          type:'POST',
          cache:false,
          data: {
            data : JSON.stringify(data)
          },
          success:function(rs) {
            load_out();

            if( rs == 'success') {
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
              }, 200);
            }
          }
        });
      });
    }
  }
}


function confirmClose() {
  console.log('close');
  let ds = $('.chk:checked');

  if(ds.length > 0) {
    let data = [];

    ds.each(function() {
      data.push(this.value);
    });

    if(data.length > 0) {
      swal({
        title:'Manual Close',
        text:'ต้องการ Close รายการที่เลือกหรือไม่',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#ffb752',
        confirmButtonText:'Yes',
        cancelButtonText:'No',
        closeOnConfirm:true
      }, function() {
        load_in();

        setTimeout(() => {
          $.ajax({
            url:HOME + 'manual_close_rows',
            type:'POST',
            cache:false,
            data: {
              data:JSON.stringify(data)
            },
            success:function(rs) {
              load_out();

              if( rs == 'success') {
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
                }, 200);
              }
            }
          })
        }, 200);
      });
    }
  }
}


function unClose() {
  let ds = $('.chk:checked');

  if(ds.length > 0) {
    let data = [];

    ds.each(function() {
      data.push(this.value);
    });

    if(data.length > 0) {
      swal({
        title:'UnClose',
        text:'ต้องการ UnClose รายการที่เลือกหรือไม่',
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:'#ffb752',
        confirmButtonText:'Yes',
        cancelButtonText:'No',
        closeOnConfirm:true
      }, function() {
        load_in();

        setTimeout(() => {
          $.ajax({
            url:HOME + 'un_close_rows',
            type:'POST',
            cache:false,
            data: {
              data:JSON.stringify(data)
            },
            success:function(rs) {
              load_out();

              if( rs == 'success') {
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
                }, 200);
              }
            }
          })
        }, 200);
      });
    }
  }
}


function checkAll() {
  let checked = $('#chk-all').is(':checked');

  if(checked) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
}


function addTransfer() {
  let err = 0;
  let fromWhs = $('#fromWhs').val();
  let toWhs = $('#toWhs').val();
  let remark = $('#remark').val();

  if(fromWhs == "") {
    $('#fromWhs-error').text('กรุณาเลือกคลังสินค้า');
    err++;
  }

  if(toWhs == "") {
    $('#toWhs-error').text('กรุณาเลือกคลังสินค้า');
    err++;
  }

  if(err > 0) {
    return false;
  }

  if(fromWhs == toWhs) {
    $('#fromWhs-error').text('คลังต้นทางและคลังปลายทาง ต้องไม่ใช่คลังเดียวกัน');
    $('#toWhs-error').text('คลังต้นทางและคลังปลายทาง ต้องไม่ใช่คลังเดียวกัน');
    err++;
  }

  if(err > 0) {
    return false;
  }

  let ds = [];

  $('.chk').each(function() {
    if($(this).is(':checked')) {
      let id = $(this).val();
      ds.push(id);
    }
  });

  $('#transferModal').modal('hide');

  if(ds.length < 1) {
    swal({
      title:"ข้อผิดพลาด",
      text:"กรุณาเลือกรายการที่ต้องการโอน",
      type:'warning'
    });

    return false;
  }
  else {
    let data = {
      'fromWhsCode' : fromWhs,
      'toWhsCode' : toWhs,
      'remark' : remark,
      'items' : ds
    };

    load_in();

    $.ajax({
      url:BASE_URL + 'inventory/transfer/add',
      type:'POST',
      cache:false,
      data: {
        'data' : JSON.stringify(data)
      },
      success:function(rs) {
        load_out();

        if(isJson(rs)) {
          let ds = JSON.parse(rs);

          if(ds.status == 'success') {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });

            setTimeout(() => {
              window.location.href = BASE_URL + 'inventory/transfer/edit/'+ds.transfer_id;
            }, 1200);
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
    })
  }
}


function createTransfer() {

  let count = $('.chk:checked').length;

  if(count < 1) {
    swal({
      title:'',
      text:"กรุณาเลือกรายการที่ต้องการโอน",
      type:'warning'
    });

    return false;
  }
  else {
    $('#transferModal').modal('show');
  }
}
