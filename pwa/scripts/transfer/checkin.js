
window.addEventListener('load', function() {
  updateScanType();
  getItemList();
});

function showTab(name) {
  $('.header-menu').removeClass('focus');
  $('.tab-pane').removeClass('active in');
  $('#'+name).addClass('focus');
  $('#'+name+'-tab').addClass('active in');

  if(name == 'home') {
    $('#sync-li').addClass('hide');
    $('#scan-li').removeClass('hide');
  }
  else {
    $('#scan-li').addClass('hide');
    $('#sync-li').removeClass('hide');
  }
}

var scanner;
var config;

function readerInit() {
  let scan_type = $('#scan-type').val();

  let formatToSupport = [
    Html5QrcodeSupportedFormats.QR_CODE,
    Html5QrcodeSupportedFormats.EAN_13,
    Html5QrcodeSupportedFormats.CODE_39,
    Html5QrcodeSupportedFormats.CODE_93,
    Html5QrcodeSupportedFormats.CODE_128
  ];

  let qrWidth = 250;
  let qrHeight = 250;

  if( scan_type == 'barcode') {
    formatToSupport = [
      Html5QrcodeSupportedFormats.EAN_13,
      Html5QrcodeSupportedFormats.CODE_39,
      Html5QrcodeSupportedFormats.CODE_93,
      Html5QrcodeSupportedFormats.CODE_128
    ];

    qrWidth = 350;
    qrHeight = 100;
  }

  if( scan_type == 'qrcode') {
    formatToSupport = [Html5QrcodeSupportedFormats.QR_CODE];
  }

  scanner = new Html5Qrcode("reader", {formatsToSupport: formatToSupport});
  config = {
    fps: 60,
    qrbox: {width: qrWidth, height: qrHeight},
    experimentalFeatures: {
      useBarCodeDetectorIfSupported: true
    }
  };
}



function saveCameraId() {
  let camId = $("input[name='camera_id']:checked").val();

  if(camId === undefined || camId == "") {
    $('#camera-error').text("Please choose camera for use to scan");
    return false;
  }
  else {
    setCookie('cameraId', camId, 3650);
    closeModal('cameras-modal');
    setTimeout(() => {
      startScan();
    }, 200);
  }
}


function changeCameraId() {
  Html5Qrcode.getCameras().then(devices => {
    if(devices && devices.length) {
      $('#select-side').val('');
      let source = $('#cameras-list-template').html();
      let output = $('#cameras-list');

      render(source, devices, output);
      showModal('cameras-modal');
    }
  });
}


function startScan() {
  let camId = getCookie('cameraId');

  if(camId == "" || camId == undefined) {
    Html5Qrcode.getCameras().then(devices => {
  		if(devices && devices.length) {
        let source = $('#cameras-list-template').html();
        let output = $('#cameras-list');
        render(source, devices, output);
        showModal('cameras-modal');
  		}
  	});
  }
  else {
    if(navigator.onLine) {

      $('#cam').removeClass('hide');
      $('#btn-scan').addClass('hide');
      $('#btn-stop').removeClass('hide');
      $('#btn-save').addClass('hide');
      $('#promt-text').removeClass('hide');

      scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
        stopScan();
        $('#code').val(decodedText);

        getTransferDetail(decodedText);
      });
    }
    else {
      swal({
        title:'ข้อผิดพลาด',
        text:'ไม่สามารถโหลดข้อมูลในขณะออฟไลน์ได้',
        type:'warning'
      });
    }
  }
}


function submitDocument() {
  let exists = false;
  let docnum = $('#doc-num').val();

  if(docnum.length < 5) {
    return false;
  }

  if(navigator.onLine) {
    getTransferDetail(docnum);
  }
  else {
    swal({
      title:'ข้อผิดพลาด',
      text:'ไม่สามารถโหลดข้อมูลในขณะออฟไลน์ได้',
      type:'warning'
    });
  }
}


function getTransferDetail(docnum) {
  if(docnum.length > 5 ) {
    if(navigator.onLine) {
      $('#code').val(docnum);
      load_in();
      let json = JSON.stringify({"docNum" : docnum, 'reload' : 'N'});
      let requestUri = URI + 'get_transfer_details';
      let header = new Headers();
      header.append('X-API-KEY', API_KEY);
      header.append('Authorization', AUTH);
      header.append('Content-type', 'application/json');

      let requestOptions = {
        method : 'POST',
        headers : header,
        body : json,
        redirect : 'follow'
      };

      fetch(requestUri, requestOptions)
        .then(response => response.text())
        .then(result => {
          load_out();
          $('#doc-num').val('');
          if(isJson(result)) {
            let ds = JSON.parse(result);
            if(ds.status == 'success') {
              let source = $('#template').html();
              let output = $('#result');

              render(source, ds.data, output);
              $('#btn-save').removeClass('hide');
              $('#promt-text').addClass('hide');
              window.scrollTo(0, document.body.scrollHeight);
            }
            else if(ds.status == 'exists') {
              swal({
                title:'เอกสารถูกโหลดไปแล้ว',
                text:`เอกสาร ${docnum} ถูกโหลดไปแล้ว ต้องการโหลดใหม่อีกครั้งหรือไม่`,
                type:'warning',
                showCancelButton: true,
            		confirmButtonColor: '#FA5858',
            		confirmButtonText: 'โหลดใหม่',
            		cancelButtonText: 'ยกเลิก',
            		closeOnConfirm: true
              }, function() {
                let body = JSON.stringify({"docNum" : docnum, 'reload' : 'Y'});
                let uri = URI + 'get_transfer_details';
                let hd = new Headers({
                  'X-API-KEY' : API_KEY,
                  'Authorization' : AUTH,
                  'Content-Type' : 'application/json'
                });

                let options = {method : 'POST', headers : hd, body : body};

                load_in();

                fetch(uri, options).then(rest => rest.text())
                .then(res => {
                  let rs = JSON.parse(res);
                  load_out();
                  if(rs.status == 'success') {
                    let source = $('#template').html();
                    let output = $('#result');

                    render(source, rs.data, output);
                    $('#btn-save').removeClass('hide');
                    $('#promt-text').addClass('hide');
                    window.scrollTo(0, document.body.scrollHeight);
                  }
                  else {
                    swal({
                      title:'Error!',
                      text:rs.message,
                      type:'error'
                    });
                  }
                })
              });
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
              text:result,
              type:'error'
            });
          }
        })
        .catch(error => console.log('error', error));
    }
    else {
      swal({
        title:'ข้อผิดพลาด',
        text:'ไม่สามารถโหลดข้อมูลในขณะออฟไลน์ได้',
        type:'warning'
      });
    }
  }
  else {
    swal({
      title:'Error!',
      text:"Barcode ไม่ถูกต้อง",
      type:'error'
    });
  }
}


function stopScan() {
	scanner.stop().then((ignore) => {
		$('#cam').addClass('hide');
		$('#btn-stop').addClass('hide');
		$('#btn-scan').removeClass('hide');
	});
}


function getItemList() {
  localforage.getItem('inventory').then((data) => {
    let ds = [];
    if(data == null || data == undefined) {
      data = [];
    }
    else {

      data.forEach((item, i) => {

        let xx = ds.filter((row) => {
          return row.docnum == item.docnum;
        });

        if(xx.length > 0) {
          let index = ds.map(object => object.docnum).indexOf(xx[0].docnum);

          ds[index].qty++;
        }
        else {
          ds.push({"docnum" : item.docnum, "qty" : 1});
        }
      });
    }

    let source = $('#stock-template').html();
    let output = $('#detail-table');
    render(source, data, output);
    reIndex();

    let sc = $('#docnum-template').html();
    let op = $('#doc-table');
    render(sc, ds, op);
  });
}



function saveItem() {
  const code = $('#code').val();
  if(navigator.onLine) {
    let requestUri = URI + 'update_user_item';
    let json = JSON.stringify({"docNum" : code});
    let header = new Headers({
      'X-API-KEY' : API_KEY,
      'Authorization' : AUTH,
      'Content-Type' : 'application/json'
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
      let rs = JSON.parse(result);
      if(rs.status == 'success') {
        syncItem();
        setTimeout(() => {
          swal({
            title:'Success!',
            type:'success',
            timer:1000
          });

          $('#result').html('');
          $('#btn-save').addClass('hide');
          $('#promt-text').removeClass('hide');
          getItemList();
          showTab('detail');

        }, 500);
      }
      else {
        swal({
          title:'Error!',
          text:rs.message,
          type:'error'
        });
      }
    })
    .catch((error)=> {
      console.error('error', error);
    });

  }
}



function deleteStockByDocNum(code) {
  swal({
    title:'Are sure ?',
    text:'ต้องการลบ ' + code + ' หรือไม่ ?',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'ยืนยัน',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: true
  },function() {
    let json = JSON.stringify({'docNum' : code});
    let requestUri = URI + 'delete_open_user_items';
    let header = new Headers();
    header.append('X-API-KEY', API_KEY);
    header.append('Authorization', AUTH);
    header.append('Content-type', 'application/json');

    let requestOptions = {
      method : 'POST',
      headers : header,
      body : json
    };

    fetch(requestUri, requestOptions)
    .then(response => response.text())
    .then(result => {
      let rs = JSON.parse(result);

      if(rs.status == 'success') {
        localforage.getItem('inventory').then((data) => {
          if(data != null && data != undefined) {
            let items = data.filter((el) => {
              return el.docnum != code;
            });

            if(items.length == 0) {
              localforage.removeItem('inventory').then(() => {
                getItemList();
              });
            }
            else {
              localforage.setItem('inventory', items).then(() => {
                getItemList();
              });
            }
          }
        }).then(() => {
          setTimeout(() => {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });
          }, 200);
        })
      }
      else {
        swal({
          title:'Error!',
          text:rs.message,
          type:'error'
        });
      }
    })
    .catch(error => {
      console.error('error', error);
    });
  });
}


function updateScanType() {
  if(navigator.onLine) {
    let json = JSON.stringify({"config_code" : "SCANTYPE"});
    let requestUri = URI + 'getConfig';
    let header = new Headers();
    header.append('X-API-KEY', API_KEY);
    header.append('Authorization', AUTH);
    header.append('Content-type', 'application/json');

    let requestOptions = {
      method : 'POST',
      headers : header,
      body : json,
      redirect : 'follow'
    };

    fetch(requestUri, requestOptions)
    .then(response => response.text())
    .then(result => {
      let ds = JSON.parse(result);
      $('#scan-type').val(ds);
      localStorage.setItem('scanType', ds);
    })
    .then(() => {
      readerInit();
    })
  }
  else {
    let ds = localStorage.getItem('scanType');

    if(ds == "qrcode" || ds == "barcode" || ds == "both")
    {
      $('#scan-type').val(ds);
    }

    readerInit();
  }
}


function syncItem() {
  if(navigator.onLine) {
    load_in();

    let json = JSON.stringify({'user_id' : userId});
    let requestUri = URI + 'sync_user_items';
    let header = new Headers();
    header.append('X-API-KEY', API_KEY);
    header.append('Authorization', AUTH);
    header.append('Content-type', 'application/json');

    let requestOptions = {
      method : 'POST',
      headers : header,
      body : json,
      redirect : 'follow'
    };

    fetch(requestUri, requestOptions)
    .then(response => response.text())
    .then(result => {
      let ds = JSON.parse(result);

      if(ds.data != null || ds.data != "") {
        let data = [];

        ds.data.forEach((item, i) => {
          let serial = item.Serial;
          let docnum = item.DocNum;

          let arr = {
            "docnum" : item.DocNum,
            "serial" : item.Serial,
            "code" : item.ItemCode,
            "name" : item.ItemName,
            "whCode" : item.WhsCode
          };

          arr[serial] = serial;
          arr[docnum] = docnum;

          data.push(arr);
        });

        if(data.length == 0) {
          localforage.removeItem('inventory').then(() => {
            getItemList();
          });
        }
        else {
          localforage.setItem('inventory', data).then(() => {
            getItemList();
          });
        }
      }
    })
    .catch((error) => {
      console.error('error', error);
    });

    load_out();
  }
  else {
    swal({
      title:'ข้อผิดพลาด',
      text:'ไม่สามารถโหลดข้อมูลในขณะออฟไลน์ได้',
      type:'warning'
    });
  }
}
