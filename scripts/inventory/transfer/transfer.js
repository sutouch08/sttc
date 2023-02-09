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


function add() {
  let error = 0;
  let fromWhsCode = $('#fromWhCode').val();
  let toWhsCode = $('#toWhCode').val();
  let remark = $('#remark').val();

  if(fromWhsCode == "") {
    set_error($('#fromWhCode'), $('#from-wh-error'), 'Required');
    error++;
  }
  else {
    clear_error($('#fromWhCode'), $('#from-wh-error'));
  }

  if(toWhsCode == "") {
    set_error($('#toWhCode'), $('#to-wh-error'), 'Required');
    error++;
  }
  else {
    clear_error($('#toWhCode'), $('#to-wh-error'));
  }

  if(fromWhsCode == toWhsCode) {
    set_error($('#toWhCode'), $('#to-wh-error'), 'Required');
    error++;
  }

  if( error > 0) {
    return false;
  }

  $.ajax({
    url:HOME + 'add',
    type:'POST',
    cache:false,
    data:{
      'fromWhsCode' : fromWhsCode,
      'toWhsCode' : toWhsCode,
      'remark' : remark
    },
    success:function(rs) {
      if(isJson(rs)) {
        let ds = $.parseJSON(rs);
        edit(ds.id);
      }
      else {
        swal({
          title:'Error!',
          type:'error',
          text:rs
        });
      }
    }
  });
}
