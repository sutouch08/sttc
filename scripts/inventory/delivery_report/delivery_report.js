var HOME = BASE_URL + 'inventory/delivery_report/';

function renderSubArea() {
  let team_id = $('#team').val();

  if(team_id == "") {
    let source = $('#no-area-template').html();
    let data = {};
    let output = $('#sub-area');

    render(source, data, output);
  }
  else {
    $.ajax({
      url:HOME + 'get_sub_area_team',
      type:'GET',
      cache:false,
      data:{
        "team_id" : team_id
      },
      success:function(rs) {
        if(isJson(rs)) {
          let data = JSON.parse(rs);
          let source = $('#no-area-template').html();

          if(data.length > 0) {
            source = $('#sub-area-template').html();
          }

          let output = $('#sub-area');
          render(source, data, output);
        }
        else {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          })
        }
      }
    })
  }
}

$('#pack-code-from').autocomplete({
  source:BASE_URL + 'auto_complete/get_pack_code',
  autoFocus:true,
  close:function() {
    let from = $(this).val();
    if(from.length) {
      let to = $('#pack-code-to').val();
      if(to.length > 0 && to < from) {
        $('#pack-code-from').val(to);
        $('#pack-code-to').val(from);
      }

      $('#pack-code-to').focus();
    }
  }
});


$('#pack-code-to').autocomplete({
  source:BASE_URL + 'auto_complete/get_pack_code',
  autoFocus:true,
  close:function() {
    let to = $(this).val();
    if(to.length) {
      let from = $('#pack-code-to').val();
      if(from.length > 0 && to < from) {
        $('#pack-code-from').val(to);
        $('#pack-code-to').val(from);
      }
    }
  }
});


function getReport() {
  let fromCode = $('#pack-code-from').val();
  let toCode = $('#pack-code-to').val();
  let teamId = $('#team').val();
  let subArea = $('#sub-area').val();
  let roundNo = $('#round-no').val();

  if(fromCode.length == 0 || toCode.length == 0) {
    $('#pack-code-from').addClass('has-error');
    $('#pack-code-to').addClass('has-error');
    return false;
  }
  else {
    $('#pack-code-from').removeClass('has-error');
    $('#pack-code-to').removeClass('has-error');
  }

  if(teamId == "") {
    $('#team').addClass('has-error');
    return false;
  }
  else {
    $('#team').removeClass('has-error');
  }

  if(subArea == "") {
    $('#sub-area').addClass('has-error');
    return false;
  }
  else {
    $('#sub-area').removeClass('has-error');
  }

  if(roundNo <= 0 || roundNo == "") {
    $('#round-no').addClass('has-error');
    return false;
  }
  else {
    $('#round-no').removeClass('has-error');
  }

  load_in();

  $.ajax({
    url:HOME + 'get_report',
    type:'POST',
    cache:false,
    data:{
      'fromCode' : fromCode,
      'toCode' : toCode,
      'teamId' : teamId,
      'subArea' : subArea,
      'roundNo' : roundNo
    },
    success:function(rs) {
      load_out();

      if(isJson(rs)) {
        let data = JSON.parse(rs);
        if(data.length) {
          let source = $('#report-template').html();
          let output = $('#result');

          render(source, data, output);
        }
        else {
          let el = `<h4 class="text-center margin-top-30">ไม่พบข้อมูล</h4>`;

          $('#result').html(el);
        }
      }
      else {
        swal({
          title:'Error!',
          text:rs,
          type:'error'
        })
      }
    }
  })
}

function doExport() {
  let fromCode = $('#pack-code-from').val();
  let toCode = $('#pack-code-to').val();
  let teamId = $('#team').val();
  let subArea = $('#sub-area').val();
  let roundNo = $('#round-no').val();
  let token	= new Date().getTime();

  if(fromCode.length == 0 || toCode.length == 0) {
    $('#pack-code-from').addClass('has-error');
    $('#pack-code-to').addClass('has-error');
    return false;
  }
  else {
    $('#pack-code-from').removeClass('has-error');
    $('#pack-code-to').removeClass('has-error');
  }

  if(teamId == "") {
    $('#team').addClass('has-error');
    return false;
  }
  else {
    $('#team').removeClass('has-error');
  }

  if(subArea == "") {
    $('#sub-area').addClass('has-error');
    return false;
  }
  else {
    $('#sub-area').removeClass('has-error');
  }

  if(roundNo <= 0 || roundNo == "") {
    $('#round-no').addClass('has-error');
    return false;
  }
  else {
    $('#round-no').removeClass('has-error');
  }

  $('#exFromCode').val(fromCode);
  $('#exToCode').val(toCode);
  $('#exTeamId').val(teamId);
  $('#exSubArea').val(subArea);
  $('#exRoundNo').val(roundNo);
  $('#token').val(token);

  get_download(token);

  $('#exportForm').submit();
}
