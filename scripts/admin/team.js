var HOME = BASE_URL + 'admin/team/';

function goBack() {
  window.location.href = HOME;
}

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
  $('#add-name').val('');
  $('#add-name-error').text('');
  $('#add-active').prop('checked', true);

  openModal('add-modal');
}


function saveAdd() {
  let name = $('#add-name').val();
  let status = $('#add-active').is(':checked') ? 1 : 0;

  if(name.length == 0) {
    $('#add-name-error').text('required');
    return false;
  }
  else {
    $('#add-name-error').text('');
  }

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'name' : name,
      'status' : status
    },
    success:function(rs) {
      if(isJson(rs)) {
        closeModal('add-modal');
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
        $('#add-name-error').text(rs);
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
        $('#edit-name').val(ds.name);

        if(ds.status == 1) {
          $('#edit-active').prop('checked', true);
        }
        else {
          $('#edit-active').prop('checked', false);
        }

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
  let name = $('#edit-name').val();
  let status = $('#edit-active').is(':checked') ? 1 : 0;

  if(name.length == 0) {
    $('#edit-name-error').text('Required');
    return false;
  }
  else {
    $('#edit-name-error').text('');
  }

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      'id' : id,
      'name' : name,
      'status' : status
    },
    success:function(rs) {
      if(isJson(rs)) {
        closeModal('edit-modal');
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
        $('#edit-name').val('');
        $('#edit-name-error').text('');
      }
      else {
        $('#edit-name-error').text(rs);
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
