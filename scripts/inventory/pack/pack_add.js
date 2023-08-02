$('#date_add').datepicker({
  dateFormat:'dd-mm-yy'
});


function add() {
  let date = $('#date_add').val();
  let phase = $('#phase').val();
  let remark = $.trim($('#remark').val());

  if( ! isDate(date)) {
    swal("วันที่ไม่ถูกต้อง");
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'date_add' : date,
      'phase' : phase,
      'remark' : remark
    },
    success:function(rs) {
      load_out();

      if(isJson(rs)) {
        let ds = JSON.parse(rs);

        if(ds.status == 'success') {
          goEdit(ds.id);
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


function updateRemark() {
  let pack_id = $('#pack_id').val();
  let remark = $('#remark').val();

  $.ajax({
    url:HOME + 'update_remark',
    type:'POST',
    cache:false,
    data: {
      'id' : pack_id,
      'remark' : remark
    },
    success:function(rs) {
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
        });
      }
    }
  })
}


function finishPack() {
  let count = $('.pea-no').length;

  if(count > 0) {
    swal({
      title:'จบการแพ็ค',
      text:'ต้องการจบการแพ็คหรือไม่ ?',
      type:'info',
      showCancelButton:true,
      confirmButtonColor:'green',
      confirmButtonText:'Yes',
      cancelButtonText:'No',
      closeOnConfirm:true
    }, function() {
      let id = $('#pack_id').val();

      load_in();
      setTimeout(() => {
        $.ajax({
          url:HOME + 'finish_pack/'+id,
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
                viewDetail(id);
              }, 1200)
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
      }, 200);
    });
  }
}
