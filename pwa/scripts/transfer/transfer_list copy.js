window.addEventListener('load', () => {
  getFilterList();
})


function getFilterList() {
  let code = $('#code').val();
  let fromDate = $('#fromDate').val();
  let toDate = $('#toDate').val();
  let status = $('#status').val();
  let perpage = $('#perpage').val();
  let offset = $('#offset').val();

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
          $('#fromDate').val(ds.fromDate);
          $('#toDate').val(ds.toDate);
          $('#status').val(ds.status);
          $('#pagination').html(ds.pagination);

          let source = $('#list-template').html();
          let output = $('#page-content');

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
  else {
    transferList();
  }
}


async function transferList() {

  if(navigator.onLine) {
    getFilterList();
  }
  else {
    await fetchList().then((data) => {
      let output = $('#page-content');
      let source = $('#list-template').html();
      render(source, data, output);
    });
  }
}

function addNew() {
  if(isOnline()) {
    load_in();
    $.ajax({
      url:BASE_URL + 'inventory/transfer/getNewCode',
      type:'GET',
      cache:false,
      success:function(rs) {
        load_out();
        if(isJson(rs)) {
          let ds = JSON.parse(rs);

        }
      }
    });
  }
  else {
    let id = uniqueId();
    let d = new Date();
    let arr = {
      "id" : id,
      "code" : id,
      "fromWhsCode" : getCookie('fromWhsCode'),
      "toWhsCode" : getCookie('toWhsCode'),
      "docDate" : (d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate()),
      "status" : -1
    };

    let ls = localStorage.getItem('transfer');

    if(ls === null || ls === "") {
      ds = JSON.stringify(arr);
      ls = {};
      ls[id] = ds;
    }
    else {
      ls = JSON.parse(ls);
      ds = JSON.stringify(arr);
      ls[id] = ds;
    }
    console.log(ls);
    localStorage.setItem('transfer', JSON.stringify(ls));
  }
}


async function fetchList() {
  return new Promise(resolve => {
    var data = [];
    if(isOnline()) {
      load_in();
      $.ajax({
        url:BASE_URL + 'inventory/transfer/get_list',
        type:'GET',
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
      let db = localStorage.getItem('transfer');
      if(db != null) {
        ds = JSON.parse(db);
        Object.keys(ds).forEach(key => {
          data.push(JSON.parse(ds[key]));
        });
      }
      console.log(data);
      resolve(data);
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
