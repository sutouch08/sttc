
function viewDetail(id) {
  localStorage.setItem('transfer_id', id);
  localStorage.setItem('isOnline', 1);
  setTimeout(() => {
    window.location.href = "transfer_detail.html";
  }, 200);
}


function viewOfflineDetail(id) {
  localStorage.setItem('transfer_id', id);
  localStorage.setItem('isOnline', 0);

  setTimeout(() => {
    window.location.href = "transfer_detail.html";
  }, 200);
}


window.addEventListener('load', () => {
  $('#code').val(getCookie('trCode'));
  $('#fromDate').val(getCookie('trFrom'));
  $('#toDate').val(getCookie('trTo'));
  $('#status').val(getCookie('trStatus'));
  $('#perpage').val(getCookie('trPerpage'));
  $('#offset').val(getCookie('trOffset'));

  loadPage();
});


function clearFilterList() {
  setCookie('trCode', '');
  setCookie('trFrom', '');
  setCookie('trTo', '');
  setCookie('trStatus', 'all');
  setCookie('trPerpage', 20);
  setCookie('trOffset', 0);

  window.location.reload();
}

async function loadPage() {
  await updateOfflineList();
  await getFilterList();
  return true;
}


async function getFilterList() {
  let code = $('#code').val();
  let fromDate = $('#fromDate').val();
  let toDate = $('#toDate').val();
  let status = $('#status').val();
  let perpage = $('#perpage').val();
  let offset = $('#offset').val();

  setCookie('trCode', code);
  setCookie('trFrom', fromDate);
  setCookie('trTo', toDate);
  setCookie('trStatus', status);
  setCookie('trPerpage', perpage);
  setCookie('trOffset', offset);

  if(navigator.onLine) {
    $.ajax({
      url:BASE_URL + 'inventory/transfer/get_list',
      type:'POST',
      cache:false,
      data: {
        "code" : code,
        "fromDate" : fromDate,
        "toDate" : toDate,
        "status" : status,
        "perpage" : perpage,
        "offset" : offset
      },
      success:function(rs) {
        if(isJson(rs)) {
          let ds = JSON.parse(rs);

          $('#code').val(ds.code);
          $('#fromDate').val(ds.from_date);
          $('#toDate').val(ds.to_date);
          $('#status').val(ds.status);
          $('#pagination').html(ds.pagination);

          let source = $('#online-template').html();
          let output = $('#online-job');

          render(source, ds.data, output);
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
}


async function updateOfflineList() {
  return new Promise((resolve, reject) => {
    let source = $('#offline-template').html();
    let output = $('#offline-job');

    localforage.getItem('transfers').then((data) => {
      if(data != null && data != undefined) {
        //--- send data to server if online
        if(navigator.onLine) {
          data.forEach((ds, index, array) => {
            let data = {
              "itemCode" : ds.itemCode,
              "itemName" : ds.itemName,
              "fromWhsCode" : ds.fromWhsCode,
              "toWhsCode" : ds.toWhsCode,
              "remark" : ds.remark,
              "uSerial" : ds.uSerial,
              "iSerial" : ds.iSerial,
              "peaNo" : ds.peaNo,
              "runNo" : ds.runNo,
              "mYear" : ds.mYear,
              "cond" : ds.cond,
              "usageAge" : ds.usageAge,
              "uImage" : ds.uImage,
              "iImage" : ds.iImage,
              "fromDoc" : ds.fromDoc
            };

            $.ajax({
              url:BASE_URL + 'inventory/transfer/add',
              type:'POST',
              cache:false,
              data: ds,
              success:function(rs) {
                if(rs == 'success') {
                  deleteOfflineTransfer(ds.iSerial);
                }
              }
            });

            if(index === array.length -1) {
              resolve();
            }
          });
        }
        else {
          render(source, data, output);
          resolve();
        }
      }
      else {
        data = [];
        render(source, data, output);
        resolve();
      }
    });

  });
}


function deleteOfflineTransfer(serial) {
  localforage.getItem('transfers').then((data) => {
    if(data != null && data != undefined) {
      let items = data.filter((el) => {
        return el.iSerial != serial;
      });

      if(items.length == 0) {
        localforage.removeItem('transfers');
      }
      else {
        localforage.setItem('transfers', items);
      }
    }
  });
}



function addNew() {
  window.location.href = 'transfer_add.html';
}


function fetchList() {
  console.log('fetchList');
  return new Promise(resolve => {
    var data = [];
    if(navigator.onLine) {
      load_in();
      $.ajax({
        url:BASE_URL + 'inventory/transfer/get_list',
        type:'POST',
        cache:false,
        success:function(rs) {
          load_out();
          if(isJson(rs)) {

            let data = JSON.parse(rs);
            resolve(data);
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
    else {
      let ds = [];
      resolve(ds);
    }
  });
}


async function getTransfer(id) {
  return new Promise(resolve => {
    var data = {};
    let db = localStorage.getItem('transfer');
    if(db.length) {
      data = JSON.parse(db);
      let row = data[id];
      console.log(row);
      resolve(row);
    }
  });
}
