var HOME = BASE_URL + 'admin/group/';

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
  $('#add-team').val('');
  $('#add-team-error').text('');
  $('#add-toWh').val('');
  $('#add-fromWh').val('');
  $('#add-active').prop('checked', true);

  openModal('add-modal');
}


function saveAdd() {
  let err = 0;
  let name = $('#add-name').val();
  let team = $('#add-team').val();
  let team_name = $('#add-team option:selected').text();
  let fWhCode = $('#add-fromWh').val();
  let fWhName = $('#add-fromWh option:selected').text();
  let toWhCode = $('#add-toWh').val();
  let toWhName = $('#add-toWh option:selected').text();
  let status = $('#add-active').is(':checked') ? 1 : 0;

  if(name.length == 0) {
    $('#add-name-error').text('required');
    return false;
  }
  else {
    $('#add-name-error').text('');
  }

  if(team == "") {
    $('#add-team-error').text('required');
    return false;
  }
  else {
    $('#add-team-error').text('');
  }

  if(fWhCode == "") {
    $('#add-fromWh-error').text('Required');
    err++;
  }
  else {
    $('#add-fromWh-error').text('');
  }

  if(toWhCode == "") {
    $('#add-toWh-error').text('Required');
    err++;
  }
  else {
    $('#add-toWh-error').text('');
  }

  if(fWhCode != "" && toWhCode != "") {
    if(fWhCode == toWhCode) {
      $('#add-toWh-error').text('คลังปลายทางต้องไม่ซ้ำกับคลังต้นทาง');
      err++;
    }
  }

  if(err > 0) {
    return false;
  }

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'name' : name,
      'team' : team,
      'team_name' : team_name,
      'fromWhsCode' : fWhCode,
      'fromWhsName' : fWhName,
      'toWhsCode' : toWhCode,
      'toWhsName' : toWhName,
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

        render_append(source, data, output);
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
        $('#edit-team').val(ds.team_id);
        $('#edit-fromWh').val(ds.fromWhsCode);
        $('#edit-toWh').val(ds.toWhsCode);

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
  let err = 0;
  let id = $('#edit-id').val();
  let name = $('#edit-name').val();
  let team = $('#edit-team').val();
  let team_name = $('#edit-team option:selected').text();
  let fWhCode = $('#edit-fromWh').val();
  let fWhName = $('#edit-fromWh option:selected').text();
  let toWhCode = $('#edit-toWh').val();
  let toWhName = $('#edit-toWh option:selected').text();
  let status = $('#edit-active').is(':checked') ? 1 : 0;

  if(name.length == 0) {
    $('#edit-name-error').text('Required');
    err++;
  }
  else {
    $('#edit-name-error').text('');
  }

  if(team == "") {
    $('#edit-team-error').text('Required');
    err++;
  }
  else {
    $('#edit-team-error').text('');
  }

  if(fWhCode == "") {
    $('#edit-fromWh-error').text('Required');
    err++;
  }
  else {
    $('#edit-fromWh-error').text('');
  }

  if(toWhCode == "") {
    $('#edit-toWh-error').text('Required');
    err++;
  }
  else {
    $('#edit-toWh-error').text('');
  }

  if(fWhCode != "" && toWhCode != "") {
    if(fWhCode == toWhCode) {
      $('#edit-toWh-error').text('คลังปลายทางต้องไม่ซ้ำกับคลังต้นทาง');
      err++;
    }
  }

  if(err > 0) {
    return false;
  }

  $.ajax({
    url:HOME + 'update',
    type:'POST',
    cache:false,
    data:{
      'id' : id,
      'name' : name,
      'team' : team,
      'team_name' : team_name,
      'fromWhsCode' : fWhCode,
      'fromWhsName' : fWhName,
      'toWhsCode' : toWhCode,
      'toWhsName' : toWhName,
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
        $('#edit-team').val('');
        $('#edit-team-error').text('');
        $('#edit-fromWh').val('');
        $('#edit-fromWh-error').text('');
        $('#edit-toWh').val('');
        $('#edit-toWh-error').text('');
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
