var scanner;
var config;

function readerInit() {

  let formatToSupport = [
    Html5QrcodeSupportedFormats.QR_CODE,
    Html5QrcodeSupportedFormats.EAN_13,
    Html5QrcodeSupportedFormats.CODE_39,
    Html5QrcodeSupportedFormats.CODE_93,
    Html5QrcodeSupportedFormats.CODE_128
  ];

  let qrWidth = 200;
  let qrHeight = 200;

  if( scanType == 'barcode') {
    formatToSupport = [
      Html5QrcodeSupportedFormats.EAN_13,
      Html5QrcodeSupportedFormats.CODE_39,
      Html5QrcodeSupportedFormats.CODE_93,
      Html5QrcodeSupportedFormats.CODE_128
    ];

    qrWidth = 300;
    qrHeight = 100;
  }

  if( scanType == 'qrcode') {
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
    localStorage.setItem('cameraId', camId);
    closeModal('cameras-modal');
  }
}


function changeCameraId() {
  Html5Qrcode.getCameras().then(devices => {
    if(devices && devices.length) {
      let source = $('#cameras-list-template').html();
      let output = $('#cameras-list');
      let camId = localStorage.getItem('cameraId');
      render(source, devices, output);
      $('#'+camId).prop('checked', true);
      showModal('cameras-modal');
    }
  })
  .catch((error) => {
    console.log('error', error);
    swal({
      title:'Oops!',
      text: error,
      type:'error'
    });
  });
}


async function updateScanType() {
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



function startScan(actionCallback) {
  let camId = localStorage.getItem('cameraId');

  if(camId == "" || camId == undefined) {
    changeCameraId();
  }
  else {

    $('#cam').removeClass('hide');
    $('#reader-backdrop').removeClass('hide');
    $('.sc').addClass('hide');

    scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
      stopScan();
      $('#scan-result').val(decodedText);

      if(actionCallback != null && actionCallback != undefined) {
        actionCallback();
      }
      else {
        console.log(actionCallback);
      }
    }).then(() => {
      setTimeout(() => {
        let overlayElement = document.getElementById('qr-shaded-region');
        let childElements = overlayElement.querySelectorAll('div');

        // Remove corners
        for (let childElement of childElements) {
          childElement.remove();
        }

        // Create own corner elements
        let topLeftElement = document.createElement('div');
        let leftTopElement = document.createElement('div');
        let bottomLeftElement = document.createElement('div');
        let leftBottomElement = document.createElement('div');
        let topRightElement = document.createElement('div');
        let rightTopElement = document.createElement('div');
        let bottomRightElement = document.createElement('div');
        let rightBottomElement = document.createElement('div');
        let middleLineElement = document.createElement('div');

        topLeftElement.classList.add('top-left');
        leftTopElement.classList.add('left-top');
        bottomLeftElement.classList.add('bottom-left');
        leftBottomElement.classList.add('left-bottom');
        topRightElement.classList.add('top-right');
        rightTopElement.classList.add('right-top');
        bottomRightElement.classList.add('bottom-right');
        rightBottomElement.classList.add('right-bottom');
        middleLineElement.classList.add('middle-line');

        overlayElement.appendChild(topLeftElement);
        overlayElement.appendChild(leftTopElement);
        overlayElement.appendChild(bottomLeftElement);
        overlayElement.appendChild(leftBottomElement);
        overlayElement.appendChild(topRightElement);
        overlayElement.appendChild(rightTopElement);
        overlayElement.appendChild(bottomRightElement);
        overlayElement.appendChild(rightBottomElement);
        overlayElement.appendChild(middleLineElement);
      }, 100)
    });

  }
}


function stopScan() {
	scanner.stop().then((ignore) => {
		$('#cam').addClass('hide');
    $('#reader-backdrop').addClass('hide');
    $('.sc').removeClass('hide');
	});
}

async function syncAll() {
  const i = await Promise.all([syncItem(), syncWorkList(), syncDamageList()]);
  return i;
}


async function init() {
  if(navigator.onLine) {
    load_in();
    await syncAll();
    await updateMenu();
    load_out();
  }
}


function syncDamageList() {
  return new Promise((resolve, reject) => {
    if(navigator.onLine) {
      $('#loader-message').text('กำลังซิงค์ตัวเลือกสภาพมิเตอร์');
      let json = JSON.stringify({"user" : 0});
      let requestUri = URI + 'get_damaged_list';
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
      .then((result) => {
        let ds = JSON.parse(result);
        if(ds.status == 'success') {
          localforage.setItem('damageList', ds.data);
        }
      });

      resolve(console.log('sync completed'));
    }
    else {
      resolve('ofline');
    }
  })
}

function syncItem() {
  return new Promise((resolve, reject) => {
    if(navigator.onLine) {
      $('#loader-message').text('กำลังซิงค์ข้อมูลมิเตอร์..');
      let ud = JSON.parse(localStorage.getItem('userdata'));
      let json = JSON.stringify({'team_group_id' : ud.team_group_id});
      let requestUri = URI + 'sync_team_group_items';
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
              "peaNo" : item.PeaNo,
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
            localforage.removeItem('inventory');
          }
          else {
            localforage.setItem('inventory', data);
          }

          resolve(console.log('sync completed'));
        }
      });
    }
    else {
      resolve('offline');
    }
  })
}


function updateMenu () {
  return new Promise((resolve, reject) => {
    $('#check-in').addClass('hide');
    $('#meter-list').addClass('hide');

    if(canGetMeter == 1) {
      $('#check-in').removeClass('hide');
    }
    else {
      $('#meter-list').removeClass('hide');
    }

    $('#first-menu').removeClass('hide');

    resolve(true);
  });
}


function syncWorkList() {
  return new Promise((resolve, reject) => {
    if(navigator.onLine) {
      let ud = JSON.parse(localStorage.getItem('userdata'));

      let json = JSON.stringify({'team_group_id' : ud.team_group_id});
      let requestUri = URI + 'sync_team_group_work_list';
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
            let arr = {
              "id" : item.id,
              "pea_no" : item.pea_no,
              'cust_route' : item.cust_route,
              "cust_no" : item.cust_no,
              "ca_no" : item.ca_no,
              "cust_name" : item.cust_name,
              "cust_address" : item.cust_address,
              "cust_tel" : item.cust_tel,
              "age_meter" : item.age_meter
            };

            data.push(arr);
          });

          if(data.length == 0) {
            localforage.removeItem('work_list');
          }
          else {
            localforage.setItem('work_list', data);
          }
        }

        resolve(console.log('sync completed'));
      });
    }
    else {
      resolve("offline");
    }
  });
}
