var HOME = BASE_URL + 'inventory/return_product/';

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
  window.location.href = HOME + 'edit/'+id;
}


function viewDetail(id) {
  window.location.href = HOME + 'view_detail/'+id;
}

function save() {
  let return_id = $('#return_id').val();

  let date = $('#date_add').val();
  let fromWhsCode = $('#fromWhCode').val();
  let toWhsCode = $('#toWhCode').val();
  let remark = $.trim($('#remark').val());

  if( ! isDate(date)) {
    swal({
      title:'วันที่ไม่ถูกต้อง',
      type:'warning'
    });

    return false;
  }

  if(toWhsCode == "") {
    swal({
      title:'กรุณาระบุคลังปลายทาง',
      type:'warning'
    });

    return false;
  }

  if(toWhsCode == fromWhsCode) {
    swal({
      title:'คลังปลายทางต้องไม่ตรงกับคลังต้นทาง',
      type:'warning'
    });

    return false;
  }

  let count = 0;
  let check = 0;

  $('.chk').each(function() {
    count++;
    if($(this).is(':checked')) {
      check++;
    }
  });

  if(count == 0 || check == 0 || (count != check)) {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณายืนยันรายการให้ครบทุกรายการ',
      type:'error'
    });

    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'save_return',
    type:'POST',
    cache:false,
    data:{
      'return_id' : return_id,
      'date_add' : date,
      'toWhsCode' : toWhsCode,
      'remark' : remark
    },
    success:function(rs) {
      load_out();

      if( isJson(rs)) {
        let ds = JSON.parse(rs);

        if(ds.status == 'success') {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });

          setTimeout(() => {
            viewDetail(return_id);
          }, 1200);
        }
        else if(ds.status == 'warning') {
          swal({
            title:'Warning',
            text:ds.message,
            type:'warning'
          },
          () => {
            window.location.reload();
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
          title:'Error',
          text:rs,
          type:'error'
        });
      }
    }
  });
}


function approve() {
  let id = $('#return_id').val();

  swal({
    title:'Approveal',
    text:'ต้องการอนุมัติหรือไม่',
    type:'info',
    showCancelButton:true,
    confirmButtonColor:'#87b87f',
    confirmButtonText:'อนุมัติ',
    cancelButtonText:'ยกเลิก',
    clolseOnConfirm:true
  },
  function() {
    load_out();
    $.ajax({
      url:HOME + 'approve',
      type:'POST',
      cache:false,
      data:{
        'id' : id
      },
      success:function(result) {
        load_out();

        if(isJson(result)) {
          let rs = JSON.parse(result);

          if(rs.status == 'success') {
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
          else if(rs.status == 'warning') {
            setTimeout(() => {
              swal({
                title:'Warning',
                text:rs.message,
                type:'warning'
              }, () => {
                window.location.reload();
              });
            }, 200);
          }
          else {
            setTimeout(() => {
              swal({
                title:'Error!',
                text:rs.message,
                type:'error'
              });
            }, 200);
          }
        }
        else {
          setTimeout(() => {
            swal({
              title:'Error!',
              text:result,
              type:'error'
            });
          }, 200);
        }
      }
    })
  });
}


function sendToSAP() {
  let id = $('#return_id').val();

  load_in();

  $.ajax({
    url:HOME + 'send_to_sap',
    type:'POST',
    cache: false,
    data: {
      "id" : id
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
        swal({
          title:'Error!',
          text: rs,
          type:'error'
        },() => {
          window.location.reload();
        });
      }
    }
  });
}

function cancle()
{
  let id = $('#return_id').val();

  swal({
    title:'Warning',
    text:'ต้องการยกเลิกเอกสารหรือไม่ ?',
    type:'warning',
    showCancelButton:true,
    confirmButtonColor:'#d15b47',
    confirmButtonText:'ยืนยัน',
    cancelButtonText:'ไม่ใช่',
    clolseOnConfirm:true
  },
  function() {
    load_in();

    $.ajax({
      url:HOME + 'cancle_return',
      type:'POST',
      cache:false,
      data: {'id' : id},
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
          }, 200);
        }
      }
    });
  });
}



function checkSerial() {
  let barcode = $.trim($('#input-barcode').val());
  let encode = md5(barcode);
  let el = $('#'+encode);

  if(el.length) {
    if(el.is(':checked')) {
      beep();

      swal({
        title:"สแกนซ้ำ",
        type:'warning'
      });
    }
    else {
      el.prop('checked', true);
      let id = el.data('id');
      $('#label-'+id).html('<i class="fa fa-check green"></i>');
      $('#input-barcode').val('').focus();
    }
  }
  else {
    beep();

    swal({
      title:"ไม่พบรายการ",
      type:"warning"
    });

  }
}

$('#input-barcode').keyup(function(e) {
  if(e.keyCode == 13) {
    checkSerial();
  }
});


function checkAll(el) {
  if(el.is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
}
