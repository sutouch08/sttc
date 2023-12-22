var HOME = BASE_URL + 'admin/sub_area/';

$('#add-modal').on('shown.bs.modal', function() {
  $('#add-name').focus();
});

$('#edit-modal').on('shown.bs.modal', function() {
  $('#edit-name').focus();
});


function closeModal(name) {
  $('#'+name).modal('hide');
}


function openModal(name) {
  $('#'+name).modal('show');
}


function addNew() {
  $('#add-code').val('');
  $('#add-code-error').text('');
  $('#add-name').val('');
  $('#add-name-error').text('');
  $('#add-team').val('');
  $('#add-team-error').text('');
  $('#add-active').prop('checked', true);

  openModal('add-modal');
}


function saveAdd() {
  let code = $.trim($('#add-code').val());
  let name = $.trim($('#add-name').val());
  let team = $('#add-team').val();
  let status = $('#add-active').is(':checked') ? 1 : 0;

  if(name.length == 0) {
    $('#add-name-error').text('required');
    return false;
  }
  else {
    $('#add-name-error').text('');
  }

  if(code.length < 4) {
    $('#add-code-error').text('Required 4 characters');
    return false;
  }
  else {
    $('#add-code-error').text('');
  }

  if(team.val == "") {
    $('#add-team-error').text('required');
    return false;
  }
  else {
    $('#add-team-error').text('');
  }

  closeModal('add-modal');

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'code' : code,
      'name' : name,
      'team_id' : team,
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
        $('#edit-team').val(ds.team_id);

        if(ds.status == 1) {
          $('#edit-active').prop('checked', true);
        }
        else {
          $('#edit-active').prop('checked', false);
        }

        $('#edit-code-error').text('');
        $('#edit-name-error').text('');
        $('#edit-team-error').text('');
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
  let code = $.trim($('#edit-code').val());
  let name = $.trim($('#edit-name').val());
  let team = $('#edit-team').val();
  let status = $('#edit-active').is(':checked') ? 1 : 0;

  if(name.length == 0) {
    $('#edit-name-error').text('Required');
    return false;
  }
  else {
    $('#edit-name-error').text('');
  }

  if(code.length < 4) {
    $('#edit-code-error').text('Required 4 characters');
    return false;
  }
  else {
    $('#edit-code-error').text('');
  }

  if(team.val == "") {
    $('#add-team-error').text('required');
    return false;
  }
  else {
    $('#add-team-error').text('');
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
      'team_id' : team,
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
        $('#edit-name').val('');
        $('#edit-name-error').text('');
        $('#edit-code-error').text('');
        $('#edit-team').val('');
        $('#edit-team-error').text('');
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
