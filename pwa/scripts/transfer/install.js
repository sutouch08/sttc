window.addEventListener('load', () => {
  updateScanType();
  getData();
});


async function getData() {
  load_in();
  let ds = await getWorkData();
  if(ds.pea_no != undefined) {
    $('#u-pea-no').val(ds.pea_no);
    $('#use-age').val(ds.age_meter);
    await renderDamageList();
    await suggest();
    load_out();
  }
  else {
    load_out();
    swal({
      title:'Error!',
      text:ds,
      type:'error'
    });
  }
}


function getWorkData() {
  return new Promise((resolve, reject) => {
    let pea_no = localStorage.getItem('work_no');
    localforage.getItem('work_list').then((data) => {
      if(data != null && data != undefined) {
        let ds = data.filter((obj) => {
          return obj.pea_no == pea_no;
        });
        console.log(1);
        resolve(ds[0]);
      }
      else {
        console.log(2);
        resolve('ไม่พบใบสั่งงาน');
      }
    })
    .catch((error) => {
      console.log(3);
      resolve(error);
    });
  })
}


function renderDamageList() {
  return new Promise((resolve, reject) => {
    localforage.getItem('damageList').then((data) => {
      if(data != null && data != undefined) {
        let source = $('#damage-list-template').html();
        let output = $('#u-dispose-id');

        render(source, data, output);
      }

      resolve('done');
    });
  });
}


function suggest() {
  let cond = $('#u-dispose-id').val();
  let age = parseDefault(parseInt($('#use-age').val()), 0);

  let label = `<div class="alert" style="background-color:red; color:white; min-height:60px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี ติดสติ๊กเกอร์สีแดง</div>`;

  if( age <= 10 )
  {
    if( cond != '0' && age > 3) {
      label = `<div class="alert" style="background-color:orange; color:white; min-height:60px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี สภาพชำรุด ติดสติ๊กเกอร์สีส้ม</div>`;
    }

    if( cond != '0' && age <= 3) {
      label = `<div class="alert" style="background-color:blue; color:white; min-height:60px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี สภาพชำรุด ติดสติ๊กเกอร์สีน้ำเงิน</div>`;
    }

    if( cond == '0') {
      label = `<div class="alert" style="background-color:green; color:white; min-height:60px; font-size:18px;">ใช้งานมาแล้ว ${age} ปี สภาพดี ติดสติ๊กเกอร์สีเขียว</div>`;
    }
  }

  $('#suggest-label').html(label);
}



function peaScan() {
  let camId = localStorage.getItem('cameraId');

  if(camId == "" || camId == undefined) {
    $('#select-side').val('pea');
    Html5Qrcode.getCameras().then(devices => {
      if(devices && devices.length) {
        let source = $('#cameras-list-template').html();
        let output = $('#cameras-list');

        render(source, devices, output);
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
  else
  {
    $('#cam').removeClass('hide');
    $('#btn-u-scan').addClass('hide');
    $('#btn-pea-stop').removeClass('hide');
    $('#space').addClass('hide');

    scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
      stopScan('pea');

      $('#pea-no').val(decodedText);
    });
  }
}


function iSerialScan() {
  let result = $('#scan-result').val();
  $('#i-serial-code').val(result);

}

function uSerialScan() {
  let result = $('#scan-result').val();
  $('#u-serial-code').val(result);
}


function iPeaScan() {
  let result = $('#scan-result').val();
  $('#i-pea-no').val(result);

  setTimeout(() => {
    getPeaNo();
  }, 500);
}


function getPeaNo() {
  let peaNo = $('#i-pea-no').val();

  if(peaNo.length) {
    $('#pea-search').addClass('hide');
    $('#pea-clear').removeClass('hide');

    localforage.getItem('inventory')
    .then((result) => {
      if(result != null && result != undefined) {
        let keys = ['peaNo'];
        ds = result.filter((obj) => keys.some((key) => obj[key].includes(peaNo)));

        if(ds.length == 1) {
          updatePeaNo(ds[0]);
          return;
        }

        if(ds.length > 1) {
          showMeterList(ds);
          return;
        }

        if(ds.length == 0) {
          swal({
            title:'Oops!',
            text: "ไม่พบ PEA NO ที่สแกน",
            type:"info"
          });

          return;
        }
      }
      else {
        swal({
          title:'Oops!',
          text: "ไม่พบ PEA NO ที่สแกน",
          type:"info"
        });

        return;
      }
    });
  }
}


function getSerial() {
  let serial = $('#i-serial-code').val();

  if(serial.length) {
    $('#serial-search').addClass('hide');
    $('#serial-clear').removeClass('hide');

    localforage.getItem('inventory')
    .then((result) => {
      if(result != null && result != undefined) {
        let keys = ['serial'];
        ds = result.filter((obj) => keys.some((key) => obj[key].includes(serial)));

        if(ds.length == 1) {
          updateSerial(ds[0]);
          return;
        }

        if(ds.length > 1) {
          showSerial(ds);
          return;
        }

        if(ds.length == 0) {
          swal({
            title:'Oops!',
            text: "ไม่พบ PEA NO ที่สแกน",
            type:"info"
          });

          return;
        }
      }
      else {
        swal({
          title:'Oops!',
          text: "ไม่พบ PEA NO ที่สแกน",
          type:"info"
        });

        return;
      }
    });
  }
}


function updatePeaNo(ds) {
  if(ds.peaNo != undefined) {
    $('#i-serial-code').val(ds.serial);
    $('#serial-search').addClass('hide');
    $('#serial-clear').removeClass('hide');
    let txt = `<p>Item Code: ${ds.code}</p><p>Description: ${ds.name}</p><p>Serial: ${ds.serial}</p>`;
    $('#i-result').html(txt);
  }
  else {
    $('#i-result').text('ไม่พบมิเตอร์');
  }
}


function clearPeaNo() {
  $('#i-pea-no').val('');
  $('#pea-clear').addClass('hide');
  $('#pea-search').removeClass('hide');
  $('#i-serial-code').val('');
  $('#serial-clear').addClass('hide');
  $('#serial-search').removeClass('hide');
  $('#i-result').text("ข้อมูลมิเตอร์ใหม่");
  $('#i-pea-no').focus();
}

function clearSerial() {
  $('#i-pea-no').val('');
  $('#pea-clear').addClass('hide');
  $('#pea-search').removeClass('hide');
  $('#i-serial-code').val('');
  $('#serial-clear').addClass('hide');
  $('#serial-search').removeClass('hide');
  $('#i-result').text("ข้อมูลมิเตอร์ใหม่");
  $('#i-pea-no').focus();
}


function showMeterList(ds) {
  if(ds.length > 0) {
    let source = $('#meter-list-template').html();
    let output = $('#meter-list');

    render(source, ds, output);

    $('#meter-modal').modal('show');
  }
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
      $('#'+side+'-preview').html('<img id="'+side+'-image" src="'+e.target.result+'" style="width:100%; border-radius:10px;" alt="Item image" />');
      $('#'+side+'-blob').val(e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    $('#'+side+'-preview').removeClass('hide');
    $('#'+side+'-photo-btn').addClass('hide');
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
	$("#del-"+side+"-image").addClass('hide');
	$("#"+side+"-photo").val('');
  $('#'+side+'-blob').val('');
  $('#'+side+'-photo-btn').removeClass('hide');
  $("#"+side+"-preview").html('');
  $('#'+side+'-preview').addClass('hide');
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
    	EXIF.getData(img, function () {
        let orientation = EXIF.getTag(this, "Orientation");
        $('#u-orientation').val(orientation);
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
    	EXIF.getData(img, function () {
        let orientation = EXIF.getTag(this, "Orientation");
        $('#i-orientation').val(orientation);
    	});
    }, 1000);
	}
});

function toggleSign(option) {
  $('#sign-status').val(option);

  $('.tg').removeClass('btn-primary');
  $('#btn-sign-'+option).addClass('btn-primary');
}



function save() {
  let uSerial = $('#u-serial').val(); //serial
  let iSerial = $('#i-serial').val();
  let peaNo = $('#pea-no').val(); // PEA NO
  let runNo = $('#run-no').val(); // หน่วยไฟที่ใช้ บนหน้าปัดมิเตอร์
  let mYear = $('#year-no').val(); // ปีที่ผลิตมิเตอร์
  let useAge = $('#use-age').val();
  let cond = $('#condition').val(); // สภาพมิเตอร์ 1 = สภาพดี, 2 = ชำรุด
  let damage_id = $("input[name='damage_id']:checked").val();
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

  let peaNoMinLength = parseDefault(parseInt($('#peaNo-minLength').val()), 4);
  let peaNoMaxLength = parseDefault(parseInt($('#peaNo-maxLength').val()), 10);
  let powerNoMinLength = parseDefault(parseInt($('#powerNo-minLength').val()), 5);
  let powerNoMaxLength = parseDefault(parseInt($('#powerNo-maxLength').val()), 5);

  let isVerify = parseDefault(parseInt($('#peaNo-verify').val()), 0);


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
      "damage_id" : damage_id,
      "usageAge" : useAge,
      "uImage" : uImage,
      "iImage" : iImage,
      "uOrientation" : uOrientation,
      "iOrientation" : iOrientation,
      "fromDoc" : fromDoc,
      "pea_verify" : isVerify
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
            text:result,
            type:'error'
          });
        }
      })
      .catch(error => {
        swal({
          title:'Error!',
          text:error,
          type:'error',
          html:true
        });
      });
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
        "damage_id" : damage_id,
        "usageAge" : useAge,
        "uImage" : uImage,
        "iImage" : iImage,
        "uOrientation" : uOrientation,
        "iOrientation" : iOrientation,
        "fromDoc" : fromDoc,
        "pea_verify" : isVerify
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

function selectDamage() {
  $('#damaged-modal').modal('show');
}

function closeDamageOption() {
  $('#damaged-modal').modal('hide');
}


function updateSuggest() {
  let dam = $("input[name='damage_id']:checked");
  console.log(dam);

  if(dam.val() === undefined) {
    return false;
  }


  if(dam.val() !== undefined) {
    closeDamageOption();
    let name = dam.data('name');
    let label = `<div class="alert alert-info" style="font-size:18px;">${name}</div>`;
    $('#damage-label').html(label);
    $('#damage-label').removeClass('hide');
  }
}



function checkCond() {
  let cond = $('#condition').val();
  if(cond == 2) {
    selectDamage();
  }
  else {
    $('.chk-dam').each(function() {
      $(this).prop('checked', false);
    });

    $('#damage-label').addClass('hide');
  }

  suggest();
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


function damageListInit() {
  if(navigator.onLine) {
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
      let data = ds.data;
      let source = $('#damaged-list-template').html();
      let output = $('#damaged-list');
      render(source, data, output);

      localforage.setItem('damageList', data);
    })
    .catch((error) => console.log('error', error));
  }
  else {
    localforage.getItem('damageList')
    .then((data) => {
      if(data != null || data != undefined) {
        let source = $('#damaged-list-template').html();
        let output = $('#damaged-list');
        render(source, data, output);
      }
    })
  }
}
