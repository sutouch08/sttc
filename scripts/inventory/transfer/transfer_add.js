function add() {
  let date_add = $('#date_add').val();
  let fromWhsCode = $('#fromWhsCode').val();
  let toWhsCode = $('#toWhsCode').val();
  let remark = $('#remark').val();

  if(! isDate(date_add)) {
    swal("วันที่ไม่ถูกต้อง");
    return false;
  }

  if(fromWhsCode == "") {
    swal("กรุณาระบุคลังต้นทาง");
    return false;
  }

  if(toWhsCode == "") {
    swal("กรุณาระบุคลังปลายทาง");
    return false;
  }

  if(fromWhsCode == toWhsCode) {
    swal("คลังต้นทางและคลังปลายทางต้องไม่เหมือนกัน");
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      "date_add" : date_add,
      "fromWhsCode" : fromWhsCode,
      "toWhsCode" : toWhsCode,
      "remark" : remark
    },
    success:function(rs) {
      load_out();

      if(isJson(rs)) {
        let ds = JSON.parse(rs);

        if(ds.status === 'success') {
          setTimeout(() => {
            edit(ds.id);
          }, 200);
        }
        else {
          swal({
            title:'Error!',
            text:ds.message,
            type:'error'
          });
        }
      }
      else
      {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        });
      }
    }
  });
}
