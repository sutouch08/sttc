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
  $('#add-code-error').text('');
  $('#add-name').val('');
  $('#add-name-error').text('');
  $('#add-fullname').val('');
  $('#add-fullname-error').text('');
  $('#add-contract').val('');
  $('#add-contract-error').text('')
  $('#add-list').val('');
  $('#add-list-error').text('');
  $('#add-active').prop('checked', true);
  $('#add-worker').val('');
  $('#add-qty').val('');

  openModal('add-modal');
}


function saveAdd() {
  let code = $('#add-code').val();
  let name = $('#add-name').val();
  let fullname = $('#add-fullname').val();
  let contract = $('#add-contract').val();
  let list = $('#add-list').val();
  let worker = parseDefault(parseInt($('#add-worker').val()), 0);
  let qty = parseDefault(parseInt($('#add-qty').val()), 0);
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

  if(fullname.length == 0) {
    $('#add-fullname-error').text('required');
    return false;
  }
  else {
    $('#add-fullname-error').text('');
  }

  if(contract.length == 0) {
    $('#add-contract-error').text('required');
    return false;
  }
  else {
    $('#add-contract-error').text('');
  }

  if(list.length == 0) {
    $('#add-list-error').text('required');
    return false;
  }
  else {
    $('#add-list-error').text('');
  }

  if(worker.length == 0 || worker <= 0) {
    $('#add-worker-error').text('required');
    return false;
  }
  else {
    $('#add-worker-error').text('');
  }

  if(qty.length == 0 || qty <= 0) {
    $('#add-qty-error').text('required');
    return false;
  }
  else {
    $('#add-qty-error').text('');
  }

  closeModal('add-modal');

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'code' : code,
      'name' : name,
      'full_name' : fullname,
      'contract_no' : contract,
      'list_no' : list,
      'worker' : worker,
      'qty' : qty,
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
        $('#edit-fullname').val(ds.full_name);
        $('#edit-contract').val(ds.contract_no);
        $('#edit-list').val(ds.list_no);
        $('#edit-worker').val(ds.tor_worker);
        $('#edit-qty').val(ds.tor_qty);

        if(ds.status == 1) {
          $('#edit-active').prop('checked', true);
        }
        else {
          $('#edit-active').prop('checked', false);
        }

        $('#edit-code-error').text('');
        $('#edit-name-error').text('');
        $('#edit-fullname-error').text('');
        $('#edit-contract-error').text('');
        $('#edit-list-error').text('');
        $('#edit-worker-error').text('');
        $('#edit-qty-error').text('');
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
  let fullname = $('#edit-fullname').val();
  let contract = $('#edit-contract').val();
  let list = $('#edit-list').val();
  let worker = parseDefault(parseInt($('#edit-worker').val()), 0);
  let qty = parseDefault(parseInt($('#edit-qty').val()), 0);
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

  if(fullname.length == 0) {
    $('#edit-fullname-error').text('required');
    return false;
  }
  else {
    $('#edit-fullname-error').text('');
  }

  if(contract.length == 0) {
    $('#edit-contract-error').text('Required');
    return false;
  }
  else {
    $('#edit-contract-error').text('');
  }

  if(list.length == 0) {
    $('#edit-list-error').text('Required');
    return false;
  }
  else {
    $('#edit-list-error').text('');
  }

  if(worker.length == 0 || worker <= 0) {
    $('#edit-worker-error').text('Required');
    return false;
  }
  else {
    $('#edit-worker-error').text('');
  }

  if(qty.length == 0 || qty <= 0) {
    $('#edit-qty-error').text('Required');
    return false;
  }
  else {
    $('#edit-qty-error').text('');
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
      'full_name' : fullname,
      'contract_no' : contract,
      'list_no' : list,
      'worker' : worker,
      'qty' : qty,
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
        $('#edit-fullname').val('');
        $('#edit-fullname-error').text('');
        $('#edit-contract').val('');
        $('#edit-contract-error').text('')
        $('#edit-list').val('');
        $('#edit-list-error').text('');
        $('#edit-worker').val('');
        $('#edit-worker-error').text('');
        $('#edit-qty-error').text('');
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
