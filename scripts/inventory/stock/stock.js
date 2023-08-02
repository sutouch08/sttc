var HOME = BASE_URL + '/inventory/stock/';

function getReport() {
  let viewType = $("input[name='viewType']:checked").val();

  if(viewType === undefined) {
    swal("กรุณาเลือกมุมมอง");
    return false;
  }

  load_in();

  $.ajax({
    url:HOME + 'get_report',
    type:'POST',
    cache:false,
    data: {
      "viewType" : viewType
    },
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        let ds = JSON.parse(rs);

        if(ds.status == 'success') {
          $('#result').html(ds.result);
        }
        else {
          swal({
            title:'Error!',
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
        })
      }
    }
  })
}


// function getReport() {
//   let allArea = $('#all-area').val();
//   let allRole = $('#all-role').val();
//   let allWh = $('#all-wh').val();
//   let seArea = $('.area-chk:checked');
//   let seRole = $('.role-chk:checked');
//   let seWh = $('.wh-chk:checked');
//   let ds = [
//     {"allArea" : allArea},
//     {"allRole" : allRole},
//     {"allWh" : allWh}
//   ];
//
//   console.log(seArea);
//
//   if(allArea == 0 && seArea.length == 0) {
//     $('#areaModal').modal('show');
//     return false;
//   }
//
//   if(allRole == 0 && seRole.length == 0) {
//     $('#roleModal').modal('show');
//     return false;
//   }
//
//   if(allWh == 0 && seWh.length == 0) {
//     $('#warehouseModal').modal('show');
//     return false;
//   }
//
//   if(allArea == 0 && seArea.length > 0) {
//     let area = [];
//     seArea.each(function() {
//       area.push($(this).val());
//     });
//
//     ds.push({"area" : area});
//   }
//
//   if(allRole == 0 && seRole.length > 0) {
//     let role = [];
//     seRole.each(function() {
//       role.push($(this).val());
//     });
//
//     ds.push({"role" : role});
//   }
//
//   if(allWh == 0 && seWh.length > 0) {
//     let wh = [];
//     seWh.each(function() {
//       wh.push($(this).val());
//     });
//
//     ds.push({"warehouse" : wh});
//   }
//
//   load_in();
//
//   $.ajax({
//     url:HOME + 'get_report',
//     type:'POST',
//     cache:false,
//     data: {
//       data: JSON.stringify(ds)
//     },
//     success:function(rs) {
//       load_out();
//       if(isJson(rs)) {
//         let ds = JSON.parse(rs);
//
//         if(ds.status == 'success') {
//           $('#result').html(ds.result);
//         }
//         else {
//           swal({
//             title:'Error!',
//             text:ds.message,
//             type:'error'
//           });
//         }
//       }
//       else {
//         swal({
//           title:'Error!',
//           text:rs,
//           type:'error'
//         })
//       }
//     }
//   })
// }


function toggleAllRole(option) {
  $('#all-role').val(option);

  if(option == 1) {
    $('#btn-role-all').addClass('btn-primary');
    $('#btn-role-select').removeClass('btn-primary');
    $('.role-chk').prop('checked', false);
  }
  else {
    $('#btn-role-all').removeClass('btn-primary');
    $('#btn-role-select').addClass('btn-primary');
    $('#roleModal').modal('show');
  }
}

function toggleAllWarehouse(option) {
  $('#all-wh').val(option);

  if(option == 1) {
    $('#btn-wh-all').addClass('btn-primary');
    $('#btn-wh-select').removeClass('btn-primary');
    $('.wh-chk').prop('checked', false);
    $('#wh-all').prop('checked', false);
  }
  else {
    $('#btn-wh-all').removeClass('btn-primary');
    $('#btn-wh-select').addClass('btn-primary');
    $('#warehouseModal').modal('show');
  }
}


function toggleAllArea(option) {
  $('#all-area').val(option);

  if(option == 1) {
    $('#btn-area-all').addClass('btn-primary');
    $('#btn-area-select').removeClass('btn-primary');
    $('.area-chk').prop('checked', false);
    $('#area-all').prop('checked', false);
  }
  else {
    $('#btn-area-all').removeClass('btn-primary');
    $('#btn-area-select').addClass('btn-primary');
    $('#areaModal').modal('show');
  }
}


function checkAllArea() {
  if($('#area-all').is(':checked')) {
    $('.area-chk').prop('checked', true);
  }
  else {
    $('.area-chk').prop('checked', false);
  }
}


function checkAllWarehouse() {
  if($('#wh-all').is(':checked')) {
    $('.wh-chk').prop('checked', true);
  }
  else {
    $('.wh-chk').prop('checked', false);
  }
}
