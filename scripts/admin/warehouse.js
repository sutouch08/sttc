var HOME = BASE_URL + 'admin/warehouse/';

function goBack() {
  window.location.href = HOME;
}

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
