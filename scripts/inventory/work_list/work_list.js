var HOME = BASE_URL + 'inventory/work_list/';

function checkAll() {
  if($('#chk-all').is(':checked')) {
    $('.chk').prop('checked', true);
  }
  else {
    $('.chk').prop('checked', false);
  }
}

function showAssignModal() {
  let rows = [];
  let teams = [];

  $('.chk').each(function() {

    let el = $(this);

    if(el.is(':checked')) {
      let id = el.val();
      let teams_id = el.data('team');

      if(teams.includes(teams_id) == false) {
        teams.push(teams_id);
      }

      rows.push(id);
    }
  });

  if(rows.length == 0) {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาเลือกรายการที่จะมอบหมาย',
      type:'warning'
    });

    return false;
  }

  if(teams.length > 1) {
    swal({
      title:'ข้อผิดพลาด',
      text:'สามารถมอบหมายได้ครั้งละ 1 เขต/พื้นที่เท่านั้น',
      type:'warning'
    });

    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'get_team_group_by_team',
    type:'GET',
    cache:false,
    data:{
      "team_id" : teams[0]
    },
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let data = JSON.parse(rs);
        let source = $('#team-group-template').html();
        let output = $('#team-group-list');

        render(source, data, output);

        $('#assignModal').modal('show');
      }
      else {
        swal({
          title:'Error!',
          text: rs,
          type:'error'
        });
      }
    }
  });
}


function addToGroup() {
  let group_id = $('input[name=team_group]:checked').val();
  let rows = [];

  $('#assignModal').modal('hide');

  $('.chk').each(function() {

    let el = $(this);

    if(el.is(':checked')) {
      let id = el.val();
      rows.push(id);
    }
  });

  if(rows.length == 0) {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาเลือกรายการที่จะมอบหมาย',
      type:'warning'
    });

    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'assign_work_list',
    type:'POST',
    cache:false,
    data:{
      "team_group_id" : group_id,
      "work_list" : JSON.stringify(rows)
    },
    success:function(rs) {
      load_out();
      if(rs == 'success') {
        swal({
          title:'Success',
          type:'success',
          timer:1000
        });

        setTimeout(() => {
          window.location.reload();
        }, 1200);
      }
      else {
        swal({
          title:'Error!',
          text: rs,
          type:'error'
        });
      }
    }
  });
}


function unAssign() {
  let rows = [];

  $('.chk').each(function() {

    let el = $(this);

    if(el.is(':checked')) {
      let id = el.val();
      rows.push(id);
    }
  });

  if(rows.length == 0) {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาเลือกรายการที่จะยกเลิกการมอบหมาย',
      type:'warning'
    });

    return false;
  }

  swal({
    title:'ยกเลิกการมอบหมาย',
    text:'ต้องการยกเลิกการมอบหมาย ดึงใบงานกลับ หรือไม่ ?',
    type:'warning',
    showCancelButton:true,
    confirmButtonColor:'#d15b47',
    confirmButtonText:'ยืนยัน',
    cancelButtonText:'ยกเลิก',
    closeOnConfirm:true
  },
  function() {
    load_in();

    $.ajax({
      url:HOME + 'unassign_work_list',
      type:'POST',
      cache:false,
      data: {
        'work_list' : JSON.stringify(rows)
      },
      success:function(rs) {
        load_out();

        if( rs == 'success') {
          setTimeout(() => {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });

            setTimeout(() => {
              window.location.reload();
            }, 1200);
          }, 200);
        }
        else {
          setTimeout(() => {
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
