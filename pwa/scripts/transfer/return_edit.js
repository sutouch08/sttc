window.addEventListener('load', () => {
  let id = localStorage.getItem('return_id');
  if(navigator.onLine) {
    getDetails(id);
    updateScanType();
  }
});


function getDetails(id) {
  if(navigator.onLine) {
    let json = JSON.stringify({"id" : id});
    let requestUri = URI + 'get_return_detail';
    let header = new Headers({"X-API-KEY" : API_KEY, "Authorization" : AUTH, "Content-Type" : "application/json"});
    let requestOptions = {method : 'POST', headers : header, body : json};

    fetch(requestUri, requestOptions)
    .then(response => response.text())
    .then(result => {
      let ds = JSON.parse(result);
      $('#code').val(ds.header.code);
      $('#date-add').val(ds.header.date_add);
      $('#remark').val(ds.header.remark);

      let source = $('#details-template').html();
      let data = ds.details;
      let output = $('#details-table');

      render(source, data, output);

      reIndex();
    })
    .catch((error) => {
      console.error('error', error);
    });
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


function updateScanType() {
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
  })
  .then(() => {
    readerInit();
  })
}


function stopScan() {
	scanner.stop().then((ignore) => {
		$('#cam').addClass('hide');
		$('#btn-stop').addClass('hide');
		$('#btn-scan').removeClass('hide');
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
    $('#cam').removeClass('hide');
    $('#btn-scan').addClass('hide');
    $('#btn-stop').removeClass('hide');

    scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
      stopScan();

      localforage.getItem('inventory').then((data) => {
        if(data != null && data != undefined) {
          items = data.filter((row) => {
            return row.hasOwnProperty(decodedText);
          });
        }

        if(items.length == 0) {
          swal({
            title:'ข้อผิดพลาด',
            text:`ไม่พบ ${decodedText} ในคลัง`,
            type:'error'
          });
          return false;
        }
        else {
          let item = items[0];
          let return_id = localStorage.getItem('return_id');
          let return_code = localStorage.getItem('return_code');
          let body = JSON.stringify({
            "return_id" : return_id,
            "return_code" : return_code,
            "ItemCode" : item.code,
            "ItemName" : item.name,
            "serial" : item.serial,
            "WhsCode" : item.whCode,
            "docNum" : item.docnum
          });

          let requestUri = URI + 'add_return_row';
          let header = new Headers({"X-API-KEY" : API_KEY, "Authorization" : AUTH, "Content-Type" : "application/json"});
          let requestOptions = {method : 'POST', headers : header, body : body};

          fetch(requestUri, requestOptions)
          .then(response => response.text())
          .then(result => {
            let rs = JSON.parse(result);

            if(rs.status == 'success') {
              let source = $('#details-template').html();
              let data = rs.data;
              let output = $('#details-table');

              render(source, data, output);

              reIndex();

              deleteItemStockBySerial(item.serial);
            }
            else {
              swal({
                title:'Error!',
                text:rs.message,
                type:'error'
              });
            }
          });
        }
      });
    });
  }
}


function submitSerial() {
  let serial = $.trim($('#input-serial').val());
  if(serial.length > 0) {
    localforage.getItem('inventory').then((data) => {
      let items = [];

      if(data != null && data != undefined) {
        items = data.filter((row) => {
          return row.hasOwnProperty(serial);
        });
      }

      if(items.length == 0) {
        swal({
          title:'ข้อผิดพลาด',
          text:`ไม่พบ ${serial} ในคลัง`,
          type:'error'
        });
        return false;
      }
      else {
        let item = items[0];
        let return_id = localStorage.getItem('return_id');
        let return_code = localStorage.getItem('return_code');
        let body = JSON.stringify({
          "return_id" : return_id,
          "return_code" : return_code,
          "ItemCode" : item.code,
          "ItemName" : item.name,
          "serial" : item.serial,
          "WhsCode" : item.whCode,
          "docNum" : item.docnum
        });

        let requestUri = URI + 'add_return_row';
        let header = new Headers({"X-API-KEY" : API_KEY, "Authorization" : AUTH, "Content-Type" : "application/json"});
        let requestOptions = {method : 'POST', headers : header, body : body};

        fetch(requestUri, requestOptions)
        .then(response => response.text())
        .then(result => {
          let rs = JSON.parse(result);

          if(rs.status == 'success') {
            let source = $('#details-template').html();
            let data = rs.data;
            let output = $('#details-table');

            render(source, data, output);
            reIndex();

            deleteItemStockBySerial(item.serial);
          }
          else {
            swal({
              title:'Error!',
              text:rs.message,
              type:'error'
            });
          }
        });
      }
    });
  }
}

function deleteItemStockBySerial(serial) {
  localforage.getItem('inventory').then((data) => {
    if(data != null && data != undefined) {
      let items = data.filter((el) => {
        return el.serial != serial;
      });

      if(items.length == 0) {
        localforage.removeItem('inventory').then(() => {
          return true;
        });
      }
      else {
        localforage.setItem('inventory', items).then(() => {
          return true;
        });
      }
    }
  })
}
