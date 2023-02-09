
function saveDocument() {
  let id = $('#transfer_id').val();
  let code = $('#code').val();

  swal({
    title:'บันทึกและปิดเอกสาร ?',
    text:'เมื่อเอกสารเข้าระบบแล้วจะไม่สามารถแก้ไขได้อีก ต้องการบันทึกหรือไม่ ?',
    type:'warning',
    html:true,
    showCancelButton: true,
		confirmButtonColor: '#87b87f',
		confirmButtonText: 'บันทึก',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: true
  },
  function() {
    load_in();

    $.ajax({
      url:HOME + 'save_document',
      type:'POST',
      cache:false,
      data: {
        "id" : id
      },
      success:function(rs) {
        load_out();

        if(rs === 'success') {
          setTimeout(() => {
            swal({
              title:'Success',
              type:'success',
              timer:1000
            });

            setTimeout(() => {
              goBack();
            }, 1200);
          }, 200);
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
  });
}


function cancleDocument(id, name) {
  swal({
    title:'Are you sure ?',
    text:'ต้องการยกเลิก '+ name +' หรือไม่ ?',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'ยืนยัน',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: true
  },
  function() {
    $.ajax({
			url:HOME + 'cancle_document',
			type:'POST',
			cache:false,
			data: {
				'id' : id
			},
			success:function(rs) {
				if(rs === 'success') {
          setTimeout(function() {
            swal({
  						title:'Cancelled',
  						type:'success',
              showConfirmButton:false,
  						timer:1000
  					});

            setTimeout(() => {
              window.location.reload();
            }, 200);
          }, 200);
				}
				else {
          setTimeout(() => {
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            });
          }, 200);
				}
  		}
  	});
  });
}

function showTab(name) {
  $('.header-menu').removeClass('focus');
  $('.tab-pane').removeClass('active in');
  $('#'+name).addClass('focus');
  $('#'+name+'-tab').addClass('active in');
}


function viewDetail() {
  $('#detailModal').modal('show');
}


function saveItem() {
  let trans_id = $('#transfer_id').val();
  let trans_code = $('#code').val();
  let fromWhsCode = $('#fromWhCode').val();
  let toWhsCode = $('#toWhCode').val();
  let iSerial = $('#i-serial').val();
  let uSerial = $('#u-serial').val();
  let iImage = $('#i-photo')[0].files[0];
  let uImage = $('#u-photo')[0].files[0];
  let itemCode = $('#i-item-code').val();
  let itemName = $('#i-item-name').val();

  if(fromWhsCode == "") {
    swal("Error!", "Please Define Warehouse", "error");
    return false;
  }

  if(toWhsCode == "") {
    swal("Error!", "Please Define Destination Warehouse", "error");
    return false;
  }

  if(iSerial == "") {
    swal("Error!", "Please Scan Installed Item", "error");
    return false;
  }

  if(iImage == '') {
    swal("Error!", "Installed item image is required", "error");
    return false;
  }

  if(uSerial == "") {
    swal("Error!", "Please Scan Returnned Item", "error");
    return false;
  }

  if(uImage == '') {
    swal("Error!", "Returnned item image is required", "error");
    return false;
  }

  let fd = new FormData();
	fd.append('iImage', iImage);
  fd.append('uImage', uImage);
	fd.append('trans_id', trans_id);
	fd.append('trans_code', trans_code);
	fd.append('fromWhsCode', fromWhsCode);
	fd.append('toWhsCode', toWhsCode);
	fd.append('iSerial', iSerial);
	fd.append('uSerial', uSerial);
  fd.append('itemCode', itemCode);
  fd.append('itemName', itemName);

  load_in();

  $.ajax({
    url:HOME + 'save_item',
    type:'POST',
    cache:false,
    data:fd,
    processData:false,
    contentType:false,
    success:function(rs) {
      load_out();

      if(isJson(rs)) {

        let data = $.parseJSON(rs);
        let source = $('#detail-template').html();
        let output = $('#detail-table');

        render_append(source, data, output);

        swal({
          title:'Success',
          type:'success',
          timer:1000
        });

        clearForm();
      }
      else {
        swal({
          title:"Error!",
          text:rs,
          type:"error"
        });
      }
    }
  })
}


function viewDetail(id) {
  $.ajax({
    url:HOME + 'get_detail',
    type:'GET',
    cache:false,
    data: {
      "id" : id
    },
    success:function(rs) {
      if(isJson(rs)) {
        let ds = $.parseJSON(rs);
        let source = $('#item-detail-template').html();
        let output = $('#item-detail');

        render(source, ds, output);

        showModal('detail-modal');
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


function clearForm() {
  $('#i-result').html('');
  $('#u-result').html('');
  removeImage('i');
  removeImage('u');
}


function isDone() {
  let iserial = $('#i-result').text();
  let iphoto = $('#i-photo').val();
  let userial = $('#u-result').text();
  let uphoto = $('#u-photo').val();

  if(iserial.length > 0 && iphoto.length > 0 && userial.length > 0 && uphoto.length > 0) {
    $('#btn-save-item').removeClass('hide');
  }
  else {
    $('#btn-save-item').addClass('hide');
  }
}

function isMobile() {
	const toMatch = [
			/Android/i,
			/webOS/i,
			/iPhone/i,
			/iPad/i,
			/iPod/i,
			/BlackBerry/i,
			/Windows Phone/i
	];

	return toMatch.some((toMatchItem) => {
			return navigator.userAgent.match(toMatchItem);
	});
}

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
    setCookie('cameraId', camId, 365);
    closeModal('cameras-modal');
    let side = $('#select-side').val();

    if(side == 'i' || side == 'u') {
      setTimeout(() => {
        startScan(side);
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
    $('#cam').removeClass('hide');
    $('#btn-'+side+'-scan').addClass('hide');
    $('#btn-'+side+'-stop').removeClass('hide');
    const whsCode = $('#fromWhCode').val();

    if(whsCode == "") {
      swal({
        title:'Error!',
        text:"Warehouse code not found",
        type:'error'
      });

      return false;
    }
    else {

      scanner.start({deviceId: {exact: camId}}, config, (decodedText, decodedResult) => {
        stopScan(side);

        if(side == 'u') {
          let text = "Serial : "+decodedText;
          text += "<input type='hidden' id='u-serial' value='"+decodedText+"' />";
          $('#'+side+'-result').html(text);

          isDone();
        }
        else {

          let _data = {
            "serial" : decodedText,
            "whsCode" : whsCode,
            "type" : side
          };

          load_in();

          fetch(HOME+'get_item', {
            method:"POST",
            body: JSON.stringify(_data),
            headers: {
              "Contens-Type" : "application/json; charset=UTF-8"
            }
          })
          .then((response) => response.json())
          .then((ds) => {
            load_out();

            if(ds.status == 'success') {
              let text = "Serial : "+ds.Serial+"<br/>";
              text += ds.ItemCode != '' ? "ItemCode : " + ds.ItemCode+"<br/>" : "";
              text += ds.ItemName != '' ? "ItemName : " + ds.ItemName+"<br/>" : "";
              text += side == 'i' ? "In Stock : " + ds.instock+"<br/>" : "";
              text += "<input type='hidden' id='"+side+"-serial' value='"+ds.Serial+"' />";
              text += "<input type='hidden' id='"+side+"-item-code' value='"+ds.ItemCode+"' />";
              text += "<input type='hidden' id='"+side+"-item-name' value='"+ds.ItemName+"' />";

              $('#'+side+'-result').html(text);

              isDone();
            }
            else {
              setTimeout(function() {
                swal({
                  title:'Error!',
                  text:ds.message,
                  type:'error'
                });
              }, 200);
            }
          })
          .catch((error) => {
            console.log("Error:", error);
          });
        }
      });
    }
  } //-- else if
}


function stopScan(side) {
	scanner.stop().then((ignore) => {
		$('#cam').addClass('hide');
		$('#btn-'+side+'-stop').addClass('hide');
		$('#btn-'+side+'-scan').removeClass('hide');
	});
}

function takePhoto(side) {
	$('#'+side+'-photo').click();
}


function readURL(input, side)
{
   if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#'+side+'-preview').html('<img id="'+side+'-image" src="'+e.target.result+'" class="width-100" alt="Item image" />');
        }
        reader.readAsDataURL(input.files[0]);
        $('#del-'+side+'-image').removeClass('hide');

        isDone();
    }
}


function removeImage(side)
{
	$("#"+side+"-preview").html('');
	$("#del-"+side+"-image").addClass('hide');
	$("#"+side+"-photo").val('');

  isDone();
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
	}
});


$("#i-photo").change(function(){
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

		readURL(this, 'i');
	}
});



function getDeleteDetail(id, name) {
  swal({
    title:'Are you sure ?',
    text:'ต้องการลบ '+ name +' หรือไม่ ?',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'ยืนยัน',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: true
  },
  function() {
    $.ajax({
			url:HOME + 'delete_detail',
			type:'POST',
			cache:false,
			data: {
				'id' : id
			},
			success:function(rs) {
				if(rs === 'success') {
          $('#detail-'+id).remove();
          setTimeout(function() {
            swal({
  						title:'Deleted',
  						type:'success',
              showConfirmButton:false,
  						timer:1000
  					});
          }, 200);
				}
				else {
          setTimeout(function() {
            swal({
              title:'Error!',
              text:rs,
              type:'error'
            });
          }, 200);
				}
  		}
  	});
  });
}
