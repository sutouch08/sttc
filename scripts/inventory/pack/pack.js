var HOME = BASE_URL + 'inventory/pack/';

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


function addNew(phase) {
  window.location.href = HOME + 'add_new/'+phase;
}


function goEdit(id) {
  load_in();
  window.location.href = HOME + 'edit/'+id;
}


function viewDetail(id) {
  load_in();
  window.location.href = HOME + 'view_detail/'+id;
}


function printPackList() {
  let id = $('#pack_id').val();

  if(id !== undefined) {
    //--- properties for print
    var center = ($(document).width() - 900)/2;
    var prop = "width=900, height=900. left="+center+", scrollbars=yes";
  	var target  = HOME + 'print_pack_list/'+id;
    window.open(target, '_blank', prop);
  }
}

function printSplitPackList() {
  let id = $('#pack_id').val();

  if(id !== undefined) {
    //--- properties for print
    var center = ($(document).width() - 900)/2;
    var prop = "width=900, height=900. left="+center+", scrollbars=yes";
  	var target  = HOME + 'print_split_pack_list/'+id;
    window.open(target, '_blank', prop);
  }
}


function createTransfer() {
  let id = $('#pack_id').val();
  let count = $('.pea-no').length;

  if(count > 0)
  {
    swal({
      title:'',
      text:'ต้องการสร้างเอกสารโอนสินค้าหรือไม่ ?',
      type:'info',
      showCancelButton:true,
      confirmButtonColor:'green',
      confirmButtonText:'Yes',
      cancelButtonText:'No',
      closeOnConfirm:true
    }, function() {
      load_in();

      setTimeout(() => {
        $.ajax({
          url:BASE_URL + 'inventory/transfer/createFromPackList/'+id,
          type:'GET',
          cache:false,
          success:function(rs) {
            load_out();

            if(isJson(rs)) {
              let ds = JSON.parse(rs);

              if(ds.status === 'success') {
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
        });
      }, 200)
    })
  }
  else {
    swal("ไม่พบรายการโอนย้าย");
  }
}


function unFinished() {
  let id = $('#pack_id').val();

  swal({
    title:'ยกเลิกการบันทึก',
    text:'ต้องการยกเลิกการบันทึกเพื่อย้อนสถานะกลับไป Open หรือไม่ ?',
    type:'warning',
    showCancelButton:true,
    confirmButtonColor:'red',
    confirmButtonText:'Yes',
    cancelButtonText:'No',
    closeOnConfirm:true
  }, function() {
    load_in();

    setTimeout(() => {
      $.ajax({
        url:HOME + 'un_finish/'+id,
        type:'POST',
        cache:false,
        success:function(rs) {
          load_out();

          if(rs === 'success') {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });

            setTimeout(() => {
              goEdit(id);
            }, 1200);
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
    }, 200);
  });
}


function cancelPack() {
  let id = $('#pack_id').val();

  swal({
    title:'ยกเลิกเอกสาร',
    text:'เมื่อยกเลิกแล้วรายการที่แพ็คแล้วจะถูกลบ <br/> ต้องการยกเลิกเอกสารแพ็คหรือไม่ ?',
    type:'warning',
    html:true,
    showCancelButton:true,
    confirmButtonColor:'red',
    confirmButtonText:'Yes',
    cancelButtonText:'No',
    closeOnConfirm:true
  }, function() {
    load_in();

    setTimeout(() => {
      $.ajax({
        url:HOME + 'cancel_pack',
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
            })
          }
        }
      })
    }, 200);
  })
}
