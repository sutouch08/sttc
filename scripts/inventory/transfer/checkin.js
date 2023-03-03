function mainPage() {
  window.location.href = BASE_URL;
}

window.addEventListener('load', function() {
  getItemList();
});

let scan_type = $('#scan-type').val();

let formatToSupport = [Html5QrcodeSupportedFormats.QR_CODE];
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

if( scan_type == 'both') {
  formatToSupport = [
    Html5QrcodeSupportedFormats.QR_CODE,
    Html5QrcodeSupportedFormats.EAN_13,
    Html5QrcodeSupportedFormats.CODE_39,
    Html5QrcodeSupportedFormats.CODE_93,
    Html5QrcodeSupportedFormats.CODE_128
  ];
}

const scanner = new Html5Qrcode("reader", {formatsToSupport: formatToSupport});
const config = {
  fps: 60,
  qrbox: {width: qrWidth, height: qrHeight},
  experimentalFeatures: {
    useBarCodeDetectorIfSupported: true
  }
};



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
    $('#cam').removeClass('hide');
    $('#btn-scan').addClass('hide');
    $('#btn-stop').removeClass('hide');
    $('#btn-save').addClass('hide');
    $('#promt-text').removeClass('hide');

    scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
      stopScan();
      let exists = false;

      localforage.getItem('inventory').then((data) => {
        if(data != null && data != undefined) {
          exists = data.filter((row) => {
            return row.hasOwnProperty(decodedText);
          }).length > 0;
        }

        if(exists) {
          swal("Error!", `${decodedText} เคยถูกบันทึกไปแล้ว`, "warning");
          return false;
        }
        else {
          getTransferDetail(decodedText);
        }
      });
    });
  }
}

function submitDocument() {
  let docnum = $('#doc-num').val();

  if(docnum.length > 5) {
    getTransferDetail(docnum);
  }
}


function getTransferDetail(docnum) {
  if(docnum.length > 5 ) {
    load_in();
    $.ajax({
      url:HOME + 'getTransferDetail',
      type:'GET',
      cache:false,
      data:{
        "docNum" : docnum
      },
      success:function(rs) {
        load_out();
        if(isJson(rs)) {
          let data = JSON.parse(rs);
          let source = $('#template').html();
          let output = $('#result');

          render(source, data, output);
          $('#btn-save').removeClass('hide');
          $('#promt-text').addClass('hide');
          window.scrollTo(0, document.body.scrollHeight);
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
  let ds = [];
  localforage.getItem('inventory').then((data) => {
    if(data != null && data != undefined) {
      ds = data;
    }

    $('.item-data').each(function() {
      let serial = $(this).data('serial');
      let docnum = $(this).data('docnum');

      let arr = {
        "docnum" : docnum,
        "serial" : serial,
        "code" : $(this).data('code'),
        "name" : $(this).data('name'),
        "whCode" : $(this).data('wh')
      };
      arr[serial] = serial;
      arr[docnum] = docnum;

      ds.push(arr);
    });

    if(ds.length > 0) {
      localforage.setItem('inventory', ds).then(() => {
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

      }).catch((err) => {
        console.log(err);
      });
    }
  });
}

function deleteStockByDocNum(code) {
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
  })
}
