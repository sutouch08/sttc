var HOME = BASE_URL + 'inventory/transfer/';

function goBack() {
  window.location.href = HOME;
}


function addNew() {
  window.location.href = HOME + 'add_new';
}


function edit(id) {
  window.location.href = HOME + 'edit/'+id;
}


function showTab(name) {
  $('.header-menu').removeClass('focus');
  $('.tab-pane').removeClass('active in');
  $('#'+name).addClass('focus');
  $('#'+name+'-tab').addClass('active in');
}


function preview(id) {
  $('#transfer-id').val(id);

  load_in();

  $.ajax({
    url:HOME + 'get_item/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let source = $('#preview-template').html();
        let data = JSON.parse(rs);
        let output = $('#item-detail');

        render(source, data, output);

        if(data.status == 0 && data.is_approve == 0) {
          $('#btn-approve').removeClass('hide');
        }

        if(data.status == 1 || data.is_approve > 0) {
          $('#btn-approve').addClass('hide');
        }

        if(data.status > 0 && data.is_approve == 1) {
          $('#btn-temp').removeClass('hide');
        }
        else {
          $('#btn-temp').addClass('hide');
        }

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
  });
}


function doApprove() {
  let id = $('#transfer-id').val();
  let no = $('#no-'+id).text();

  $('#previewModal').modal('hide');

  setTimeout(() => {
    load_in();

    $.ajax({
      url:HOME + 'approve',
      type:'POST',
      cache:false,
      data:{
        "id" : id
      },
      success:function(rs) {
        load_out();
        if(rs == 'success') {
          swal({
            title:'Approved',
            type:'success',
            timer:1000
          });

          updateRow(id, no);
        }
      }
    });
  }, 500);
}


function updateRow(id, no) {
  $.ajax({
    url:HOME + 'get_row/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      if(isJson(rs)) {
        let source = $('#row-template').html();
        let data = JSON.parse(rs);
        let output = $('#row-'+id);

        render(source, data, output);

        $('#no-'+id).text(no);
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
