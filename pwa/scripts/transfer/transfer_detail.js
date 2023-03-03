$(document).ready(function() {
  let id = localStorage.getItem('transfer_id');
  let isOnline = localStorage.getItem('isOnline');

  if(isOnline == 1) {
    load_in();

    $.ajax({
      url:BASE_URL + 'inventory/transfer/view_detail/'+id,
      type:'POST',
      cache:false,
      success:function(rs) {
        load_out();
        if(isJson(rs)) {
          let ds = JSON.parse(rs);
          let condLabel = ds.cond == 1 ? "สภาพดี" : "ชำรุด";
          $('#status').val(ds.status);
          $('#date-add').val(ds.date_add);
          $('#code').val(ds.code);
          $('#u-serial-code').val(ds.uSerial);
          $('#pea-no').val(ds.peaNo);
          $('#run-no').val(ds.powerNo);
          $('#year-no').val(ds.mYear);
          $('#condition').val(ds.cond);
          $('#cond').val(condLabel);
          $('#use-age').val(ds.usageAge);
          $('#from-doc').val(ds.fromDoc);
          $('#u-preview').html('<img id="u-image" src="'+ds.u_image_data+'" class="width-100" alt="Item image" />');

          suggest();

          $('#i-serial-code').val(ds.iSerial);
          $('#item-code').val(ds.itemCode);
          $('#item-name').val(ds.itemName);
          $('#from-wh').val(ds.fromWhsCode);
          $('#i-preview').html('<img id="i-image" src="'+ds.i_image_data+'" class="width-100" alt="Item image" />');
        }
      }
    });
  }
  else {
    localforage.getItem("transfers").then((data) => {
      if(data != null || data != undefined) {
        let item = data.filter((el) => {
          return el.iSerial == id;
        });

        if(item.length == 1) {
          let ds = item[0];
          let condLabel = ds.cond == 1 ? "สภาพดี" : "ชำรุด";
          $('#date-add').val(ds.date_add);
          $('#code').val(ds.code);
          $('#u-serial-code').val(ds.uSerial);
          $('#pea-no').val(ds.peaNo);
          $('#run-no').val(ds.powerNo);
          $('#year-no').val(ds.mYear);
          $('#condition').val(ds.cond);
          $('#cond').val(condLabel);
          $('#use-age').val(ds.usageAge);
          $('#from-doc').val(ds.fromDoc);
          $('#u-preview').html('<img id="u-image" src="'+ds.uImage+'" class="width-100" alt="Item image" />');
          suggest();

          $('#i-serial-code').val(ds.iSerial);
          $('#item-code').val(ds.itemCode);
          $('#item-name').val(ds.itemName);
          $('#from-wh').val(ds.fromWhsCode);
          $('#i-preview').html('<img id="i-image" src="'+ds.iImage+'" class="width-100" alt="Item image" />');
        }
        else {
          swal({
            title:'Error!',
            text:'Item Not Found',
            type:'error'
          });
        }
      }
    });
  }
});




function nextStep() {
  let status = $('#status').val();

  $('.body-step').addClass('hide');
  $('#step-2').removeClass('hide');
  $('#head-step-2').addClass('active');
  $('#head-step-1').removeClass('active');
  $('#btn-prev').removeClass('hide');
  $('#btn-next').addClass('hide');
  $('#btn-back').addClass('hide');

  if(status == 0) {
    $('#btn-cancle').removeClass('hide');
  }
}



function prevStep() {
  $('.body-step').addClass('hide');
  $('#step-1').removeClass('hide');
  $('#head-step-1').addClass('active');
  $('#head-step-2').removeClass('active');
  $('#btn-prev').addClass('hide');
  $('#btn-next').removeClass('hide');
  $('#btn-back').removeClass('hide');
  $('#btn-cancle').addClass('hide');
}


function suggest() {
  let year = parseDefault(parseInt($('#year-no').val()), 0);
  let cond = $('#condition').val();
  let age = $('#use-age').val();
  let label = "";

  if(year == 0 || year == "" || cond == "") {
    $('#suggest-label').html(`<div class="alert alert-normal">กรุณาระบุปีและสภาพมิเตอร์</div>`);
  }
  else {

    let label = `<div class="alert alert-danger">ใช้งานมาแล้ว ${age} ปี ติดสติ๊กเกอร์สีแดง</div>`;

    if( age < 10 )
    {
      if( cond == 2 && age > 3) {
        label = `<div class="alert alert-warning">ใช้งานมาแล้ว ${age} ปี สภาพชำรุด ติดสติ๊กเกอร์สีส้ม</div>`;
      }

      if( cond == 2 && age <= 3) {
        label = `<div class="alert alert-info">ใช้งานมาแล้ว ${age} ปี สภาพชำรุด ติดสติ๊กเกอร์สีน้ำเงิน</div>`;
      }

      if( cond == 1) {
        label = `<div class="alert alert-success">ใช้งานมาแล้ว ${age} ปี สภาพดี ติดสติ๊กเกอร์สีเขียว</div>`;
      }
    }

    $('#suggest-label').html(label);
  }
}


function confirmCancle() {
  let id = localStorage.getItem('transfer_id');
  let isOnline = localStorage.getItem('isOnline');
  let code = $('#code').val();

  if(id != "" || id != undefined) {
    swal({
      title:'ต้องการยกเลิก <br/>'+code,
      text:'เมื่อยกเลิกสำเร็จแล้วจะไม่สามารถย้อนกลับได้อีก ยืนยันการยกเลิกหรือไม่ ?',
      type:'warning',
      html:true,
      showCancelButton: true,
      confirmButtonColor: '#d15b47',
      confirmButtonText: 'ยืนยัน',
      cancelButtonText: 'ไม่',
      closeOnConfirm: true
    },
    function() {
      if(isOnline == 1) {
        //--- request to server
        load_in();
        $.ajax({
          url:BASE_URL + 'inventory/transfer/cancle/'+id,
          type:'POST',
          cache:false,
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
      }
      else {
        localforage.getItem("transfers").then((data) => {
          if(data != null || data != undefined) {
            let item = data.filter((el) => {
              return el.iSerial == id;
            });

            if(item.length == 1) {
              let ds = [];
              localforage.getItem('inventory').then((items) => {
                if(items != null && items != undefined) {
                  ds = items;
                }

                // console.log(item);
                item = item[0];

                let serial = item.iSerial;
                let docnum = item.fromDoc;

                let arr = {
                  "docnum" : docnum,
                  "serial" : serial,
                  "code" : item.itemCode,
                  "name" : item.itemName,
                  "whCode" : item.fromWhsCode
                };

                arr[serial] = serial;
                arr[docnum] = docnum;

                ds.push(arr);

                if(ds.length > 0) {
                  localforage.setItem('inventory', ds).then(() => {
                    localforage.getItem('transfers').then((data) => {
                      if(data != null && data != undefined) {
                        let items = data.filter((el) => {
                          return el.iSerial != serial;
                        });

                        if(items.length == 0) {
                          localforage.removeItem('transfers').then(() => {
                            swal({
                              title:'Success',
                              type:'success',
                              timer:1000
                            });

                            setTimeout(() => {
                              goList();
                            }, 1200);
                          });
                        }
                        else {
                          localforage.setItem('transfers', items).then(() => {
                            swal({
                              title:'Success',
                              type:'success',
                              timer:1000
                            });

                            setTimeout(() => {
                              goList();
                            }, 1200);
                          });
                        }
                      }
                    })
                  })
                  .catch((err) => {
                    console.log(err);
                    swal({
                      title:'Error!',
                      text:"Delete failed",
                      type:'error'
                    });
                  });
                }
              });
            }
          }
        })
      }
    });
  }
}
