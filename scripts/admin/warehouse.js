var HOME = BASE_URL + 'admin/warehouse/';

function updateListed(id) {
  const chk = $('#chk-'+id);
  let listed = chk.is(':checked') ? 1 : 0;

  $.ajax({
    url:HOME + 'update_listed/'+id,
    type:'POST',
    cache:false,
    data:{
      'listed' : listed
    },
    success:function(rs) {
      console.log(rs);
    }
  });
}


function syncData() {
  load_in();

  $.ajax({
    url:HOME + 'syncData',
    type:'POST',
    cache:false,
    success:function() {
      load_out();
      setTimeout(function() {
        window.location.reload();
      }, 1000);
    },
    error:function(xhr, status, error) {
      load_out();
			swal({
				title:'Error!',
				text:"Error-"+xhr.status+": "+xhr.statusText,
				type:'error'
			});
    }
  });
}


function getEdit(id) {
  $.ajax({
    url:HOME + 'get_data/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      if(isJson(rs)) {
        let ds = JSON.parse(rs);
        $('#edit-id').val(id);
        $('#edit-code').val(ds.code);
        $('#edit-name').val(ds.name);
        $('#edit-area').val(ds.area);
        $('#edit-role').val(ds.role);

        $('#edit-modal').modal('show');
      }
      else {
        swal({
          title:'Error',
          text:rs,
          type:'error'
        });
      }
    }
  })
}


function update() {
  let id = $('#edit-id').val();
  let area = $('#edit-area').val();
  let areaName = $('#edit-area option:selected').text();
  let role = $('#edit-role').val();
  let roleName = $('#edit-role option:selected').text();

  $('#edit-modal').modal('hide');

  setTimeout(() => {
    load_in();

    $.ajax({
      url:HOME + 'update',
      type:'POST',
      cache:false,
      data:{
        'id' : id,
        'area' : area,
        'role' : role
      },
      success:function(rs) {
        load_out();
        if(rs == 'success') {
          $('#area-'+id).text(areaName);
          $('#role-'+id).text(roleName);
        }
        else {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          }, function() {
            $('#edit-modal').modal('show');
          });
        }
      }
    })
  }, 200);
}
