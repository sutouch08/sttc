window.addEventListener('load', () => {
  let code = getCookie('rnCode');
  let from = getCookie('rnFrom');
  let to = getCookie('rnTo');
  let status = getCookie('rnStatus');
  let perpage = getCookie('rnPerpage');
  let offset = getCookie('rnOffset');

  $('#code').val(code);
  $('#fromDate').val(from);
  $('#toDate').val(to);
  $('#status').val((status == "" ? "all" : status));
  $('#perpage').val((perpage == "" ? 20 : perpage));
  $('#offset').val((offset == "" ? 0 : offset));

  getFilterList();
});


function clearFilterList() {
  setCookie('rnCode', '');
  setCookie('rnFrom', '');
  setCookie('rnTo', '');
  setCookie('rnStatus', 'all');
  setCookie('rnPerpage', 20);
  setCookie('rnOffset', 0);

  window.location.reload();
}

async function getFilterList() {
  let code = $('#code').val();
  let fromDate = $('#fromDate').val();
  let toDate = $('#toDate').val();
  let status = $('#status').val();
  let perpage = $('#perpage').val();
  let offset = $('#offset').val();

  setCookie('rnCode', code);
  setCookie('rnFrom', fromDate);
  setCookie('rnTo', toDate);
  setCookie('rnStatus', status);
  setCookie('rnPerpage', perpage);
  setCookie('rnOffset', offset);

  if(navigator.onLine) {
    let requestUri = URI + 'get_return_list';
    let header = new Headers();
    header.append('X-API-KEY', API_KEY);
    header.append('Authorization', AUTH);
    header.append('Content-type', 'application/json');

    let json = JSON.stringify({
      "code" : code,
      "fromDate" : fromDate,
      "toDate" : toDate,
      "status" : status,
      "perpage" : perpage,
      "offset" : offset
    });

    let requestOptions = {
      method : 'POST',
      headers : header,
      body : json,
      redirect : 'follow'
    };

    fetch(requestUri, requestOptions)
    .then(response => response.text())
    .then(result => {
      if(isJson(result)) {
        let ds = JSON.parse(result);
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
    })
    .catch(error => console.log('error', error));
  }
  else {
    $('#online-job').html('<div class="alert alert-danger text-center">Network Error!</div>');
  }
}



function addNew() {
  window.location.href = 'return_add.html';
}


function edit(id, code) {
  localStorage.setItem('return_id', id);
  localStorage.setItem('return_code', code);
  window.location.href = "return_edit.html";
}
