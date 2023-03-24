window.addEventListener('load', () => {
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
        if( ! result == "" && ! result == null) {
          $('#scan-type').val(result);
        }
        else {
          $('#scan-type').val('both');
        }
      })
      .catch(error => console.error('error', error));
  }
  else {
    $('#scan-type').val('both');
  }

  let d = new Date();

  let thisYear = d.getFullYear();
  // console.log(thisYear);

  let lastYear = 30;


  for(let i = 0; i < lastYear; i++) {
    let year = thisYear - i;
    let el = `<option value="${year}">${year}</option>`;

    $('#year-no').append(el);
  }

  $('#remark').autosize({append:"\n"});

  readerInit();
});



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
    setCookie('cameraId', camId, 365);
    closeModal('cameras-modal');
    let side = $('#select-side').val();

    if(side == 'i' || side == 'u') {
      setTimeout(() => {
        startScan(side);
      }, 200);
    }

    if(side == 'pea') {
      setTimeout(() => {
        peaScan();
      }, 200);
    }
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


function peaScan() {
  let camId = getCookie('cameraId');

  if(camId == "" || camId == undefined) {
    $('#select-side').val('pea');
    Html5Qrcode.getCameras().then(devices => {
      if(devices && devices.length) {
        let source = $('#cameras-list-template').html();
        let output = $('#cameras-list');

        render(source, devices, output);
        showModal('cameras-modal');
      }
    });
  }
  else
  {
    $('#cam').removeClass('hide');
    $('#btn-u-scan').addClass('hide');
    $('#btn-pea-stop').removeClass('hide');

    scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
      stopScan('pea');

      $('#pea-no').val(decodedText);
    });
  }
}



function startScan(side) {
  let camId = getCookie('cameraId');

  if(camId == "" || camId == undefined) {
    $('#select-side').val(side);
    Html5Qrcode.getCameras().then(devices => {
  		if(devices && devices.length) {
        let source = $('#cameras-list-template').html();
        let output = $('#cameras-list');

        render(source, devices, output);
        showModal('cameras-modal');
  		}
  	});
  }
  else
  {

    if(fWhCode == "" || fWhCode == undefined || tWhCode == "" || tWhCode == undefined) {
      swal({
        title:'Error!',
        text:"ไม่พบข้อมูลคลังสินค้า กรุณาติดต่อผู้ดูแล",
        type:'error'
      });

      return false;
    }
    else {
      $('#cam').removeClass('hide');
      $('#btn-'+side+'-stop').removeClass('hide');

      scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
        stopScan(side);

        if(side == 'u') {
          $('#u-serial').val(decodedText);
          $('#u-serial-code').val(decodedText);
        }
        else {
          $('#i-serial-code').val(decodedText);
          let items = [];

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

              $('#i-result').text("กรุณาระบุ Serial มิเตอร์");
              $('#i-serial').val("");
              $('#item-code').val("");
              $('#item-name').val("");
              $('#fromWhsCode').val("");
              $('#from-doc').val("");
            }
            else {
              let item = items[0];
              console.log(item);
              let text = "";
              text += "Serial : "+item.serial+"<br/>";
              text += "Item Code : "+item.code+"<br/>";
              text += "Item Name : "+item.name+"<br/>";

              $('#i-result').html(text);
              $('#i-serial').val(item.serial);
              $('#item-code').val(item.code);
              $('#item-name').val(item.name);
              $('#fromWhsCode').val(item.whCode);
              $('#from-doc').val(item.docnum);
            }
          });
        }
      });
    }
  } //-- else if
}


function stopScan(side) {
	scanner.stop().then((ignore) => {
		$('#cam').addClass('hide');

    $('#btn-i-stop').addClass('hide');
    $('#btn-u-stop').addClass('hide');
    $('#btn-pea-stop').addClass('hide');
	});
}

function takePhoto(side) {
	$('#'+side+'-photo').click();
}


function getExif(name) {
	var img = document.getElementById(name);
  //console.log(img);
	EXIF.getData(img, function () {
		var MetaData = EXIF.getAllTags(this);
    //console.log(MetaData);
    return JSON.stringify(MetaData, null, "\t");
		//console.log(JSON.stringify(MetaData, null, "\t"));
	});
}


function readURL(input, side)
{
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#'+side+'-preview').html('<img id="'+side+'-image" src="'+e.target.result+'" class="width-100" alt="Item image" />');
      $('#'+side+'-blob').val(e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    $('#del-'+side+'-image').removeClass('hide');
  }
}


function readImageASBlob(input) {
  let result = "";
  if(input.files && input.files[0]) {
    let reader = new FileReader();

    reader.onload = (e) => {
      result = e.target.result;
    }

    reader.readerAsDataURL(input.files[0]);
  }

  return result;
}


function removeImage(side)
{
	$("#"+side+"-preview").html('');
	$("#del-"+side+"-image").addClass('hide');
	$("#"+side+"-photo").val('');
  $('#'+side+'-blob').val('');
}



$("#u-photo").change(function(){
	if($(this).val() != '')
	{
		var file 		= this.files[0];
		var name		= file.name;
		var type 		= file.type;
		var size		= file.size;
		if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' )
		{
			swal("รูปแบบไฟล์ไม่ถูกต้อง", "กรุณาเลือกไฟล์นามสกุล jpg, jpeg, png หรือ gif เท่านั้น", "error");
			$(this).val('');
			return false;
		}

		readURL(this, 'u');

    setTimeout(() => {
      var img = document.getElementById("u-image");
      //console.log(img);
    	EXIF.getData(img, function () {
        let orientation = EXIF.getTag(this, "Orientation");
        //console.log(orientation);
        img.dataset.orientation = orientation;
        $('#u-orientation').val(orientation);
        //console.log(img.dataset.orientation);
        //swal(img.dataset.orientation);
    	});
    }, 1000);
	}
});


$("#i-photo").change(function(){
	if($(this).val() != '')
	{
		let file 		= this.files[0];
		let name		= file.name;
		let type 		= file.type;
		let size		= file.size;

		if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' )
		{
			swal("รูปแบบไฟล์ไม่ถูกต้อง", "กรุณาเลือกไฟล์นามสกุล jpg, jpeg, png หรือ gif เท่านั้น", "error");
			$(this).val('');
			return false;
		}

		readURL(this, 'i');

    setTimeout(() => {
      let img = document.getElementById("i-image");
      //console.log(img);
    	EXIF.getData(img, function () {
        let orientation = EXIF.getTag(this, "Orientation");
        img.dataset.orientation = orientation;
        $('#i-orientation').val(orientation);
        //console.log(img.dataset.orientation);
        //swal(img.dataset.orientation);
    	});
    }, 1000);
	}
});


function nextStep() {
  let step = parseDefault(parseInt($('#step').val()), 1);

  if(step == 1) {
    step_1_2();
  }


  if(step == 2) {
    step_2_3();
  }

  if(step == 3) {
    step_3_4();
  }
}

function step_1() {
  $('#step').val(1);

  $('.body-step').addClass('hide');
  $('#step-1').removeClass('hide');
  $('#head-step-1').addClass('active');
  $('#head-step-2').removeClass('active');
  $('#head-step-3').removeClass('active');
  $('#head-step-4').removeClass('active');
  $('#btn-back').removeClass('hide');
  $('#btn-prev').addClass('hide');
  $('#btn-next').removeClass('hide');
  $('#btn-finish').addClass('hide');
}

function step_1_2() {
  let serial = $('#u-serial-code').val(); //serial
  let peaNo = $('#pea-no').val(); // PEA NO
  let runNo = $('#run-no').val(); // หน่วยไฟที่ใช้ บนหน้าปัดมิเตอร์
  let mYear = $('#year-no').val(); // ปีที่ผลิตมิเตอร์
  let cond = $('#condition').val(); // สภาพมิเตอร์ 1 = สภาพดี, 2 = ชำรุด

  if(serial.length < 5) {
    swal({
      title:'ข้อผิดพลาด',
      text:'Serial ไม่ถูกต้อง',
      type:'warning'
    });

    return false;
  }

  if(peaNo.length != 10) {
    swal({
      title:'ข้อผิดพลาด',
      text:'PEA No. ไม่ถูกต้อง',
      type:'warning'
    });

    return false;
  }

  if(runNo.length != 5) {
    swal({
      title:'ข้อผิดพลาด',
      text:'หน่วยไฟไม่ถูกต้อง',
      type:'warning'
    });

    return false;
  }

  if(mYear == "") {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาระบุปีมิเตอร์',
      type:'warning'
    });

    return false;
  }

  if(cond == "") {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาระบุสภาพมิเตอร์',
      type:'warning'
    });

    return false;
  }

  step_2();
}


function step_2() {
  $('#step').val(2);

  $('.body-step').addClass('hide');
  $('#step-2').removeClass('hide');
  $('#head-step-2').addClass('active');
  $('#head-step-3').removeClass('active');
  $('#head-step-4').removeClass('active');

  $('#btn-back').addClass('hide');
  $('#btn-prev').removeClass('hide');
  $('#btn-next').removeClass('hide');
  $('#btn-finish').addClass('hide');
}


function step_2_3() {
  let uImage = $('#u-blob').val();

  if(uImage == "") {
    swal("กรุณาถ่ายรูปมิเตอร์ตัวเก่า");
    return false;
  }

  step_3();
}

function step_3() {
  $('#step').val(3);

  $('.body-step').addClass('hide');
  $('#step-3').removeClass('hide');
  $('#head-step-3').addClass('active');
  $('#head-step-4').removeClass('active');

  $('#btn-back').addClass('hide');
  $('#btn-prev').removeClass('hide');
  $('#btn-next').removeClass('hide');
  $('#btn-finish').addClass('hide');
}


function step_3_4() {
  let serial = $('#i-serial').val();
  if(serial.length < 5) {
    swal({
      title:"ข้อผิดพลาด",
      text:"Serial ไม่ถูกต้อง",
      type:'error'
    });

    return false;
  }

  step_4();
}

function step_4() {
  $('#step').val(4);
  $('.body-step').addClass('hide');
  $('#step-4').removeClass('hide');
  $('#head-step-4').addClass('active');
  $('#btn-back').addClass('hide');
  $('#btn-prev').removeClass('hide');
  $('#btn-next').addClass('hide');
  $('#btn-finish').removeClass('hide');
}


function finish() {
  let uSerial = $('#u-serial').val(); //serial
  let iSerial = $('#i-serial').val();
  let peaNo = $('#pea-no').val(); // PEA NO
  let runNo = $('#run-no').val(); // หน่วยไฟที่ใช้ บนหน้าปัดมิเตอร์
  let mYear = $('#year-no').val(); // ปีที่ผลิตมิเตอร์
  let useAge = $('#use-age').val();
  let cond = $('#condition').val(); // สภาพมิเตอร์ 1 = สภาพดี, 2 = ชำรุด
  let uImage = $('#u-blob').val();
  let iImage = $('#i-blob').val();
  let uOrientation = $('#u-orientation').val();
  let iOrientation = $('#i-orientation').val();
  let itemCode = $('#item-code').val();
  let itemName = $('#item-name').val();
  let remark = $.trim($('#remark').val());
  let fromWhsCode = $('#fromWhsCode').val();
  let toWhsCode = tWhCode; //-- from cookie
  let fromDoc = $('#from-doc').val();

  if(uSerial.length < 5 || iSerial.length < 5) {
    swal({
      title:'ข้อผิดพลาด',
      text:'Serial ไม่ถูกต้อง',
      type:'warning'
    });

    return false;
  }

  if(peaNo.length != 10) {
    swal({
      title:'ข้อผิดพลาด',
      text:'PEA No. ไม่ถูกต้อง',
      type:'warning'
    });

    return false;
  }

  if(runNo.length != 5) {
    swal({
      title:'ข้อผิดพลาด',
      text:'หน่วยไฟไม่ถูกต้อง',
      type:'warning'
    });

    return false;
  }

  if(mYear == "") {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาระบุปีมิเตอร์',
      type:'warning'
    });

    return false;
  }

  if(cond == "") {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาระบุสภาพมิเตอร์',
      type:'warning'
    });

    return false;
  }

  if(iImage.length == "" || uImage.length == "") {
    swal({
      title:'ข้อผิดพลาด',
      text:'กรุณาถ่ายรูปให้ครบทั้ง 2 มิเตอร์',
      type:'warning'
    });

    return false;
  }

  if(fromWhsCode == "" || toWhsCode == "") {
    swal({
      title:'ข้อผิดพลาด',
      text:'คลังสินค้าไม่ถูกต้อง กรุณาตรวจสอบสินค้ากับคลังสินค้า',
      type:'warning'
    });

    return false;
  }

  //--- save data
  if(navigator.onLine) {
    let ds = {
      "itemCode" : itemCode,
      "itemName" : itemName,
      "fromWhsCode" : fromWhsCode,
      "toWhsCode" : toWhsCode,
      "remark" : remark,
      "uSerial" : uSerial,
      "iSerial" : iSerial,
      "peaNo" : peaNo,
      "runNo" : runNo,
      "mYear" : mYear,
      "cond" : cond,
      "usageAge" : useAge,
      "uImage" : uImage,
      "iImage" : iImage,
      "uOrientation" : uOrientation,
      "iOrientation" : iOrientation,
      "fromDoc" : fromDoc
    };

    let json = JSON.stringify(ds);
    let requestUri = URI + 'add_transfer';
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

    load_in();

    fetch(requestUri, requestOptions)
      .then(response => response.text())
      .then(result => {
        if(isJson(result)) {
          load_out();
          let rs = JSON.parse(result);
          if(rs.status == 'success') {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });

            deleteItemStockBySerial(iSerial);
            setTimeout(() => {
              window.location.href = "transfer.html";
            }, 1200);
          }
          else {
            swal({
              title:'Error!',
              text:rs.message,
              type:'error'
            });
          }
        }
        else {
          swal({
            title:'Error!',
            text:rs,
            type:'error'
          });
        }
      })
      .catch(error => console.err('error', error));
  }
  else {
    let ds = [];
    localforage.getItem('transfers').then((data) => {
      if(data != null && data != undefined) {
        ds = data;
      }

      let d = new Date();
      let date = d.getDate() + "-"+(d.getMonth() + 1) + "-" + d.getFullYear();

      let arr = {
        "date_add" : date,
        "itemCode" : itemCode,
        "itemName" : itemName,
        "fromWhsCode" : fromWhsCode,
        "toWhsCode" : toWhsCode,
        "remark" : remark,
        "uSerial" : uSerial,
        "iSerial" : iSerial,
        "peaNo" : peaNo,
        "runNo" : runNo,
        "mYear" : mYear,
        "cond" : cond,
        "usageAge" : useAge,
        "uImage" : uImage,
        "iImage" : iImage,
        "uOrientation" : uOrientation,
        "iOrientation" : iOrientation,
        "fromDoc" : fromDoc
      };

      ds.push(arr);

      if(ds.length > 0) {
        localforage.setItem('transfers', ds).then(() => {
          swal({
            title:'Success!',
            type:'success',
            timer:1000
          });

          deleteItemStockBySerial(iSerial);
          setTimeout(() => {
            window.location.href = "transfer.html";
          }, 1200);

        }).catch((err) => {
          console.log(err);
        });
      }
    });
  }
}



function prevStep() {
  let step = $('#step').val();
  if(step > 1) {
    step--;
  }

  if(step == 1) {
    step_1();
  }

  if(step == 2) {
    step_2();
  }

  if(step == 3) {
    step_3();
  }
}


function suggest() {
  let year = parseDefault(parseInt($('#year-no').val()), 0);
  let cond = $('#condition').val();
  let label = "";

  if(year == 0 || year == "" || cond == "") {
    if(cond == "" && (year == "" || year == 0)) {
      $('#suggest-label').html(`<div class="alert alert-normal">กรุณาระบุปีและสภาพมิเตอร์</div>`);
    }
    else {
      if(cond != "" && (year == 0 || year == "")) {
        $('#suggest-label').html(`<div class="alert alert-normal">กรุณาระบุปีมิเตอร์</div>`);
      }

      if(cond == "" && (year != 0 && year != "")) {
        $('#suggest-label').html(`<div class="alert alert-normal">กรุณาระบุสภาพมิเตอร์</div>`);
      }
    }

    $('#use-age').val(0);
  }
  else {
    let thisYear = new Date().getFullYear();
    let age = thisYear - year;
    let label = `<div class="alert" style="background-color:red; color:white; min-height:100px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี ติดสติ๊กเกอร์สีแดง</div>`;
    $('#use-age').val(age);

    if( age < 10 )
    {
      if( cond == 2 && age > 3) {
        label = `<div class="alert" style="background-color:orange; color:white; min-height:100px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี สภาพชำรุด ติดสติ๊กเกอร์สีส้ม</div>`;
      }

      if( cond == 2 && age <= 3) {
        label = `<div class="alert" style="background-color:blue; color:white; min-height:100px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี สภาพชำรุด ติดสติ๊กเกอร์สีน้ำเงิน</div>`;
      }

      if( cond == 1) {
        label = `<div class="alert" style="background-color:green; color:white; min-height:100px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี สภาพดี ติดสติ๊กเกอร์สีเขียว</div>`;
      }
    }

    $('#suggest-label').html(label);
  }
}


$('#i-serial-code').change(function(e) {
  let decodedText = $(this).val();
  let items = [];

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

      $('#i-result').text("กรุณาระบุ Serial มิเตอร์");
      $('#i-serial').val("");
      $('#item-code').val("");
      $('#item-name').val("");
      $('#fromWhsCode').val("");
      $('#from-doc').val("");
    }
    else {
      let item = items[0];
      console.log(item);
      let text = "";
      text += "Serial : "+item.serial+"<br/>";
      text += "Item Code : "+item.code+"<br/>";
      text += "Item Name : "+item.name+"<br/>";

      $('#i-result').html(text);
      $('#i-serial').val(item.code);
      $('#i-serial').val(item.serial);
      $('#item-code').val(item.code);
      $('#item-name').val(item.name);
      $('#fromWhsCode').val(item.whCode);
      $('#from-doc').val(item.docnum);
    }
  });
})


$('#u-serial-code').change(function(e) {
  let serial = $(this).val();

  if(serial.length < 5) {
    swal({
      title:'ข้อผิดพลาด',
      text:`Serial ไม่ถูกต้อง`,
      type:'warning'
    });

    return false;
  }

  $('#u-serial').val(serial);
});



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
