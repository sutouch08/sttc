
function updatePackQty() {
  let packed = $('.pea-no').length;
  $('#all-qty').val(packed);
}


$('#i-pea-no').keyup(function(e) {
  if(e.keyCode === 13) {
    doPacking('i');
  }
});

$('#u-pea-no').keyup(function(e) {
  if(e.keyCode === 13) {
    doPacking('u');
  }
});


function doPacking(op) {
  let phase = $('#phase').val();
  let el = $('#'+op+'-pea-no');
  el.attr('disabled', 'disabled');
  let peaNo = el.val();
  let limit = parseDefault(parseInt($('#limit').val()), 0);
  let count = $('.pea-no').length;

  if(count < limit) {
    if(peaNo.length) {
      let id = $('#pack_id').val();
  
      $.ajax({
        url:HOME + 'do_packing',
        type:'POST',
        cache:false,
        data:{
          'op' : op, //--- u = u_pea_no, i = i_pea_no
          'pea_no' : peaNo,
          'pack_id' : id,
          'phase' : phase
        },
        success:function(rs) {
          if(isJson(rs)) {
            let ds = JSON.parse(rs);
            let source = $('#row-template').html();
            let output = $('#row-table');
  
            render_prepend(source, ds, output);
            updatePackQty();
            reIndex();
            el.removeAttr('disabled').val('').focus();
          }
          else {
            beep();
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            }, function() {
              setTimeout(() => {
                el.val('').removeAttr('disabled').focus();
              }, 200)
            });
          }
        }
      });
  
    }
    else {
      el.val('').removeAttr('disabled').focus();
    }
  }
  else {
    beep();
    swal({
      title:'Error!',
      text:'จำนวนเกินกำหนด',
      type:'error'
    });

    return false;
  }
}


function confirmDelete() {
  let count = $('.chk:checked').length;

  if(count > 0) {
    swal({
      title:'คุณแน่ใจ ?',
      text:'ต้องการลบรายการตามที่เลือกไว้หรือไม่ ?',
      type:'warning',
      showCancelButton:true,
      confirmButtonColor:'#d15b47',
      confirmButtonText:'ยืนยัน',
      cancelButtonText:'ยกเลิก',
      closeOnConfirm:true
    },function() {
      let ds = [];

      $('.chk:checked').each(function() {
        ds.push({"id" : $(this).val(), "u_pea_no" : $(this).data('upeano')});
      });

      if(ds.length == 0) {
        setTimeout(() => {
          swal("กรุณาเลือกรายการ");
          return false;
        }, 200);
      }
      else {
        load_in();
        setTimeout(() => {
          $.ajax({
            url:HOME + 'delete_rows',
            type:'POST',
            cache:false,
            data:{
              'rows' : JSON.stringify(ds)
            },
            success: function(rs) {
              load_out();
              if(rs == 'success') {
                swal({
                  title:'Success',
                  typd:'success',
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

        }, 200);
      }

    });
  }
}


function checkAll() {
  if($('#chk-all').is(":checked")) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
}


function activeEdit(id) {
  $('#btn-edit-'+id).addClass('hide');
  $('#btn-update-'+id).removeClass('hide');
  $('#dispose-'+id).removeAttr('readonly').focus().select();
}

$('.dispose').focus(function() {
  $(this).select();
})


function updateDispose(id) {
  let dispose = $('#dispose-'+id).val();

  $.ajax({
    url:HOME + 'update_dispose',
    type:'POST',
    cache:false,
    data: {
      'id' : id,
      'dispose_reason' : dispose
    },
    success:function(rs) {
      if(rs == 'success') {
        $('#dispose-'+id).attr('readonly', 'readonly');
        $('#btn-update-'+id).addClass('hide');
        $('#btn-edit-'+id).removeClass('hide');
        $('#i-pea-no').focus();
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