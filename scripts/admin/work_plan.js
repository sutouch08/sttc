var HOME = BASE_URL + 'admin/work_plan/';


function checkAll() {
  if($('#chk-all').is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
}


function addToTeam() {
  let team_id = $('#team-list').val();
  let row = [];
  if(team_id == "") {
    $('#team-list').addClass('has-error');
    return false;
  }
  else {
    $('#team-list').removeClass('has-error');
  }

  $('.chk').each(function() {
    if($(this).is(':checked')) {
      row.push($(this).val());
    }
  });


  if(row.length == 0) {
    swal({
      title:'กรุณาเลือกรายการ',
      type:'warning'
    });

    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'add_to_team',
    type:'POST',
    cache:false,
    data: {
      "team_id" : team_id,
      "data" : JSON.stringify(row)
    },
    success:function(rs) {
      load_out();

      if(rs == 'success') {
        swal({
          title:'Success',
          timer:1000,
          type:'success'
        });

        setTimeout(() => {
          window.location.reload();
        }, 1200);
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

function loadWorkList() {
  load_in();
  $.ajax({
    url:HOME + 'load_work_list',
    type:'POST',
    cache:false,
    success:function(rs) {
      load_out();

      if(isJson(rs)) {
        let ds = JSON.parse(rs);

        if(ds.status == 'success') {
          swal({
            title:'Success',
            type:'success',
            timer:1000
          });

          setTimeout(() => {
            window.location.reload();
          }, 1200);
        }
        else if(ds.status == 'info') {
          swal({
            title:'No Worklist available',
            type:'info',
            timer:1000
          });
        }
        else {
          swal({
            title:'Failed',
            text:ds.message,
            type:'error'
          });
        }
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
