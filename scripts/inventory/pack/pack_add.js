$('#date_add').datepicker({
  dateFormat:'dd-mm-yy'
});


function add() {
  let date = $('#date_add').val();
  let phase = $('#phase').val();
  let sub_area = $('#sub-area').val();
  let color = $('#color').val();
  let period_no = $('#period-no').val();
  let box_no = $('#box-no').val();
  let remark = $.trim($('#remark').val());

  if( ! isDate(date)) {
    swal("วันที่ไม่ถูกต้อง");
    return false;
  }

  if(sub_area == "") {
    swal("กรุณาระบุพื้นที่");
    return false;
  }

  if(color == "") {
    swal("กรุณาระบุสี");
    return false;
  }

  if(period_no.length == 0) {
    swal("กรุณาระบุงวดที่");
    return false;
  }

  if(box_no.length == 0) {
    swal("กรุณาระบุลังที่");
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
      'sub_area' : sub_area,
      'color' : color,
      'period_no' : period_no,
      'box_no' : box_no,
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
  let sub_area = $('#sub-area').val();
  let color = $('#color').val();
  let period_no = $('#period-no').val();
  let box_no = $('#box-no').val();
  let remark = $('#remark').val();

  if(sub_area == "") {
    swal("กรุณาระบุพื้นที่");
    return false;
  }

  if(color == "") {
    swal("กรุณาระบุสี");
    return false;
  }

  if(period_no.length == 0) {
    swal("กรุณาระบุงวดที่");
    return false;
  }

  if(box_no.length == 0) {
    swal("กรุณาระบุลังที่");
    return false;
  }

  $.ajax({
    url:HOME + 'update_remark',
    type:'POST',
    cache:false,
    data: {
      'id' : pack_id,
      'sub_area' : sub_area,
      'color' : color,
      'period_no' : period_no,
      'box_no' : box_no,
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
  let pack_id = $('#pack_id').val();
  let sub_area = $('#sub-area').val();
  let color = $('#color').val();
  let period_no = $('#period-no').val();
  let box_no = $('#box-no').val();

  if(sub_area == "") {
    swal("กรุณาระบุพื้นที่");
    return false;
  }

  if(color == "") {
    swal("กรุณาระบุสี");
    return false;
  }

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

      load_in();

      setTimeout(() => {
        $.ajax({
          url:HOME + 'finish_pack/'+pack_id,
          type:'GET',
          cache:false,
          data:{
            "sub_area" : sub_area,
            "color" : color,
            "period_no" : period_no,
            "box_no" : box_no
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
                viewDetail(pack_id);
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
