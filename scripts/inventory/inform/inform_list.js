var HOME = BASE_URL + 'inventory/inform/';

function viewDetail(id) {
  $('#inform-id').val(id);
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
        let output = $('#inform-detail');


        render(source, ds, output);

        $('#previewModal').modal('show');
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


function sendToSCS() {
  let id = $('#inform-id').val();

  $('#previewModal').modal('hide');

  setTimeout(() => {
    load_in();

    $.ajax({
      url:HOME + 'send_to_scs',
      type:'POST',
      cache:false,
      data:{
        'id' : id
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
          setTimeout(() => {
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            }, () => {
              $('#previewModal').modal('show');
            });
          }, 200)
        }
      }
    });
  }, 500);
}
