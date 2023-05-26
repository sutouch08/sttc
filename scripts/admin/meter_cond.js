var HOME = BASE_URL + 'admin/meter_cond/';


function sync() {
  load_in();

  $.ajax({
    url:HOME + 'sync',
    type:'POST',
    cache:false,
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
          text:rs,
          type:'error'
        });
      }
    }
  });
}
