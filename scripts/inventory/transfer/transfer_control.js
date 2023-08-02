$('#pack-code-box').autocomplete({
  source:BASE_URL + 'auto_complete/get_finished_pack_list',
  autoFocus:true,
  close:function() {
    let result = $(this).val();

    if(result == 'not found' || result == '') {
      $(this).val('');
    }
  }
});


function getPackItems() {
  let id = $('#transfer_id').val();
  let pack_code = $('#pack-code-box').val();

  if(pack_code.length) {
    swal({
      title:'นำเข้าเอกสาร',
      text:'ต้องการโหลดเอกสารแพ็ค '+pack_code+' หรือไม่',
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
          url:HOME + 'import_from_pack',
          type:'GET',
          cache:false,
          data:{
            'transfer_id' : id,
            'pack_code' : pack_code
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
                title:'Error !',
                text:rs,
                type:'error'
              });
            }
          }
        })
      }, 200);
    })
  }
}


function clearPackItems() {
  let id = $('#transfer_id').val();
  let pack_code = $('#pack-code-box').val();

  if(pack_code.length) {
    swal({
      title:'ลบรายการนำเข้า',
      text:'ต้องการนำรายการจากเอกสารแพ็ค '+pack_code+' ออกหรือไม่',
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
          url:HOME + 'remove_pack_items',
          type:'GET',
          cache:false,
          data:{
            'transfer_id' : id,
            'pack_code' : pack_code
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
                title:'Error !',
                text:rs,
                type:'error'
              });
            }
          }
        })
      }, 200);
    })
  }
}

function reloadWarehouse() {
  let id = $('#transfer_id').val();

  load_in();
  $.ajax({
    url:HOME + 'reloadWarehouse/'+id,
    type:'GET',
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
          window.location.reload();
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
}
