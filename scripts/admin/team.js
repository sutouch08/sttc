var HOME = BASE_URL + 'admin/team/';

$('#add-modal').on('shown.bs.modal', function() {
  $('#add-code').focus();
});

$('#edit-modal').on('shown.bs.modal', function() {
  $('#edit-code').focus();
});


function closeModal(name) {
  $('#'+name).modal('hide');
}


function openModal(name) {
  $('#'+name).modal('show');
}


function addNew() {
  $('#add-code').val('');
  $('#add-code-error').val('');
  $('#add-name').val('');
  $('#add-name-error').text('');
  $('#add-active').prop('checked', true);

  openModal('add-modal');
}


function saveAdd() {
  let code = $('#add-code').val();
  let name = $('#add-name').val();
  let status = $('#add-active').is(':checked') ? 1 : 0;

  if(code.length == 0) {
    $('#add-code-error').text('required');
    return false;
  }
  else {
    $('#add-code-error').text('');
  }

  if(name.length == 0) {
    $('#add-name-error').text('required');
    return false;
  }
  else {
    $('#add-name-error').text('');
  }

  closeModal('add-modal');

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'code' : code,
      'name' : name,
      'status' : status
    },
    success:function(rs) {
      if(isJson(rs)) {
        setTimeout(function() {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });
        }, 200);

        let ds = $.parseJSON(rs);
        let source = $('#row-template').html();
        let data = ds;
        let output = $('#list-table');

        render_prepend(source, data, output);
        reIndex();
      }
      else {
        setTimeout(function() {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          }, function() {
            $('#add-modal').modal('show');
          });
        }, 200);
      }
    }
  });
}


function getEdit(id) {
  $.ajax({
    url:HOME + 'get/'+id,
    type:'GET',
    cache:false,
    success:function(rs) {
      if(isJson(rs)) {
        let ds = $.parseJSON(rs);
        $('#edit-id').val(ds.id);
        $('#edit-code').val(ds.code);
        $('#edit-name').val(ds.name);

        if(ds.status == 1) {
          $('#edit-active').prop('checked', true);
        }
        else {
          $('#edit-active').prop('checked', false);
        }

        $('#edit-code-error').text('');
        $('#edit-name-error').text('');
        openModal('edit-modal');
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


function update() {
  let id = $('#edit-id').val();
  let code = $('#edit-code').val();
  let name = $('#edit-name').val();
  let status = $('#edit-active').is(':checked') ? 1 : 0;

  if(code.length == 0) {
    $('#edit-code-error').text('Required');
    return false;
  }
  else {
    $('#edit-code-error').text('');
  }

  if(name.length == 0) {
    $('#edit-name-error').text('Required');
    return false;
  }
  else {
    $('#edit-name-error').text('');
  }

  closeModal('edit-modal');

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      'id' : id,
      'code' : code,
      'name' : name,
      'status' : status
    },
    success:function(rs) {
      if(isJson(rs)) {

        setTimeout(function() {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });
        }, 200);

        let ds = $.parseJSON(rs);
        let source = $('#in-row-template').html();
        let data = ds;
        let output = $('#row-'+id);

        render(source, data, output);
        reIndex();

        $('#edit-id').val('');
        $('#edit-code').val('');
        $('#edit-code-error').text('');
        $('#edit-name').val('');
        $('#edit-name-error').text('');
      }
      else {
        setTimeout(function() {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          });
        }, 200);
      }
    }
  });
}


function getDelete(id, name) {
  swal({
    title:'Are you sure ?',
    text:'ต้องการลบ '+ name +' หรือไม่ ?',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'ใช่, ฉันต้องการลบ',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: true
  },
  function() {
    $.ajax({
			url:HOME + 'delete',
			type:'POST',
			cache:false,
			data: {
				'id' : id
			},
			success:function(rs) {
				if(rs === 'success') {
          setTimeout(function() {
            swal({
  						title:'Deleted',
  						type:'success',
              showConfirmButton:false,
  						timer:1000
  					});

  					setTimeout(function() {
  						goBack();
  					}, 1500);
          }, 200);
				}
				else {
          setTimeout(function() {
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            });
          }, 200);
				}
  		}
  	});
  });
}
