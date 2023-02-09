var validUname = true;
var validDname = true;
var validUgroup = true;
var validTeam = true;
var validWh = true;
var validPwd = true;



function addNew() {
  window.location.href = HOME +'add_new';
}



function goBack() {
  window.location.href = HOME;
}

function getEdit(id) {
  window.location.href = HOME + 'edit/'+id;
}


function viewDetail(id) {
	window.location.href = HOME + 'view_detail/'+id;
}


function getReset(id) {
  window.location.href = HOME + 'reset_password/'+id;
}


function saveAdd() {
	validUserName();
	validDisplayName();
	validUserGroup();
  validUserTeam();
  validWarehouse();
	validPWD();

	if( !validUname || !validDname || !validUgroup || !validTeam || !validWh || !validPwd ) {
		return false;
	}

	const uname = $('#uname').val();
	const dname = $('#dname').val();
	const team_id = $('#team_id').val();
	const pwd = $('#pwd').val();
	const ugroup = $('#ugroup').val();
	const active = $('#active').is(':checked') ? 1 : 0;
	const force_reset = $('#force_reset').is(':checked') ? 1 : 0;

  let teamList = [];
  let fwhList = [];
  let twhList = [];

  $('.chk-area').each(function() {
    if($(this).is(':checked')) {
      teamList.push($(this).val());
    }
  });

  $('.from-wh').each(function() {
    if($(this).is(':checked')) {
      fwhList.push($(this).val());
    }
  });

  $('.to-wh').each(function() {
    if($(this).is(':checked')) {
      twhList.push($(this).val());
    }
  });

	load_in();

	$.ajax({
		url:HOME + 'add',
		type:'POST',
		cache:false,
		data:{
			'uname' : uname,
			'dname' : dname,
      'ugroup' : ugroup,
			'team_id' : team_id,
      'team_list' : JSON.stringify(teamList),
      'from_warehouse_list' : JSON.stringify(fwhList),
      'to_warehouse_list' : JSON.stringify(twhList),
			'pwd' : pwd,
			'active' : active,
			'force_reset' : force_reset
		},
		success:function(rs) {
			load_out();

			rs = $.trim(rs);

			if(rs === 'success') {
				swal({
					title:'Success',
					type:'success',
					timer:1000
				});

				setTimeout(function() {
					addNew();
				}, 1500);
			}
			else {
				swal({
					title:'Error!',
					text: rs,
					type:'error'
				});
			}
		},
		error:function(xhr) {
			load_out();
			swal({
				title:"Error!",
				text: xhr.responseText,
				type:'error',
				html:true
			});
		}
	});
}



function update() {
	validDisplayName();
	validUserGroup();
	validUserTeam();
  validWarehouse();

	if( !validDname || !validUgroup || !validTeam || !validWh ) {
		return false;
	}

	const id = $('#user_id').val();
  const uname = $('#uname').val();
	const dname = $('#dname').val();
	const team_id = $('#team_id').val();
	const ugroup = $('#ugroup').val();
	const active = $('#active').is(':checked') ? 1 : 0;

  let teamList = [];
  let fwhList = [];
  let twhList = [];

  $('.chk-area').each(function() {
    if($(this).is(':checked')) {
      teamList.push($(this).val());
    }
  });

  $('.from-wh').each(function() {
    if($(this).is(':checked')) {
      fwhList.push($(this).val());
    }
  });

  $('.to-wh').each(function() {
    if($(this).is(':checked')) {
      twhList.push($(this).val());
    }
  });

	load_in();

	$.ajax({
		url:HOME + 'update',
		type:'POST',
		cache:false,
		data:{
			'id' : id,
      'uname' : uname,
			'dname' : dname,
			'team_id' : team_id,
      'team_list' : JSON.stringify(teamList),
      'from_warehouse_list' : JSON.stringify(fwhList),
      'to_warehouse_list' : JSON.stringify(twhList),
			'ugroup' : ugroup,
			'active' : active
		},
		success:function(rs) {
			load_out();

			rs = $.trim(rs);

			if(rs === 'success') {
				swal({
					title:'Success',
					type:'success',
					timer:1000
				});
			}
			else {
				swal({
					title:'Error!',
					text: rs,
					type:'error'
				});
			}
		},
		error:function(xhr) {
			load_out();
			swal({
				title:"Error!",
				text: xhr.responseText,
				type:'error',
				html:true
			});
		}
	});
}



function changePassword()
{
	validPWD();

	if( ! validPwd) {
		return false;
	}

	const id = $('#user_id').val();
	const pwd = $('#pwd').val();
	const force = $('#force_reset').is(':checked') ? 1 : 0;

	$.ajax({
		url:HOME + 'change_pwd',
		type:'POST',
		cache:false,
		data:{
			'id' : id,
			'pwd' : pwd,
			'force_reset' : force
		},
		success:function(rs) {
			rs = $.trim(rs);

			if(rs === 'success') {
				swal({
					title:'Success',
					type:'success',
					timer:1000
				});
			}
			else {
				swal({
					title:'Error!',
					text: rs,
					type:'error'
				});
			}
		}
	});
}

function getDelete(id, uname){
  swal({
    title:'Are sure ?',
    text:'ต้องการลบ '+ uname +' หรือไม่ ?',
    type:'warning',
    showCancelButton: true,
		confirmButtonColor: '#FA5858',
		confirmButtonText: 'ใช่, ฉันต้องการลบ',
		cancelButtonText: 'ยกเลิก',
		closeOnConfirm: false
  },function(){
		$.ajax({
			url:HOME + 'delete',
			type:'POST',
			cache:false,
			data: {
				'id' : id
			},
			success:function(rs) {
				if(rs === 'success') {
					swal({
						title:'Deleted',
						type:'success',
						timer:1000
					});

					setTimeout(function() {
						goBack();
					}, 1500);
				}
				else {
					swal({
						title:'Error!',
						text:rs,
						type:'error'
					})
				}
			}
		})
  })
}



function validatePassword(input)
{
	if(USE_STRONG_PWD == 1) {
		var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;

		if(input.match(passw))
		{
			return true;
		}

		return false;
	}

	return true;
}



function validPWD() {
  var pwd = $('#pwd').val();
  var cmp = $('#cm-pwd').val();
  if(pwd.length > 0) {

		if( ! validatePassword(pwd)) {
			$('#pwd-error').text('รหัสผ่านต้องมีความยาว 8 - 20 ตัวอักษร และต้องประกอบด้วย ตัวอักษรภาษาอังกฤษ พิมพ์เล็ก พิมพ์ใหญ่ และตัวเลขอย่างน้อย อย่างละตัว');
      $('#pwd').addClass('has-error');
			validPwd = false;
      return false;
		}
		else {
			$('#pwd-error').text('');
			$('#pwd').removeClass('has-error');
			validPwd = true;
		}

    if(pwd != cmp) {
      $('#cm-pwd-error').text('Password missmatch!');
      $('#cm-pwd').addClass('has-error');
      validPwd = false;
			return false;
    }
		else {
      $('#cm-pwd-error').text('');
      $('#cm-pwd').removeClass('has-error');
      validPwd = true;
    }
  }
	else {
    $('#pwd-error').text('Password is required!');
    $('#pwd').addClass('has-error');
    validPwd = false;
  }
}





function validUserName() {
  var uname = $('#uname').val();
  var id = $('#user_id').val();
  if(uname.length > 0) {
		$.ajax({
			url:HOME + 'valid_uname',
			type:'GET',
			cache:false,
			data:{
				'id' : id,
				'uname' : uname
			},
			success:function(rs) {
				rs = $.trim(rs);
        if(rs === 'exists'){
          $('#uname-error').text('User name already exists!');
          $('#uname').addClass('has-error');
          validUname = false;
        }
				else {
          $('#uname-error').text('');
          $('#uname').removeClass('has-error');
          validUname = true;
        }
			}
		})
  }
	else {
    $('#uname-error').text('User name is required!');
    $('#uname').addClass('has-error');
    validUname = false;
  }
}



function validDisplayName() {
  var dname = $('#dname').val();
  var id = $('#user_id').val();
  if(dname.length > 0){
    $.ajax({
			url:HOME + 'valid_dname',
			type:'GET',
			cache:false,
			data:{
				'id' : id,
				'dname' : dname
			},
			success:function(rs) {
				var rs = $.trim(rs);
				if(rs === 'exists'){
	        $('#dname-error').text('Display name already exists!');
	        $('#dname').addClass('has-error');
	        validDname = false;
	      }
				else {
	        $('#dname-error').text('');
	        $('#dname').removeClass('has-error');
	        validDname = true;
	      }
			}
		});
  }
	else {
    $('#dname-error').text('Display name is required!');
    $('#dname').addClass('has-error');
    validDname = false;
  }
}


function validUserTeam() {
  let ugroup = $('#ugroup');

  if(ugroup.val() == "") {
    validTeam = false;
  }

  if(ugroup.val() == 3) {
    let el = $('#team_id');
    let label = $('#team-error');
    if(el.val() == "") {
      set_error(el, label, "Area is required");
      validTeam = false;
    }
    else {
      clear_error(el, label);
      validTeam = true;
    }
  }


  if(ugroup.val() == 2) {
    let el = $('#area-list');
    let label = $('#area-error');
    let areaList = 0;

    $('.chk-area').each(function() {
      if($(this).is(':checked')) {
        areaList++;
      }
    });

    if(areaList == 0) {
      set_error(el, label, "Area is required");
      validTeam = false;
    }
    else {
      clear_error(el, label);
      validTeam = true;
    }
  }
}


function validWarehouse() {
  let ugroup = $('#ugroup');
  let fm = $('#from-wh-list');
  let to = $('#to-wh-list');
  let flabel = $('#from-warehouse-error');
  let tlabel = $('#to-warehouse-error');
  let fwhList = 0;
  let twhList = 0;

  $('.from-wh').each(function() {
    if($(this).is(':checked')) {
      fwhList++;
    }
  });

  $('.to-wh').each(function() {
    if($(this).is(':checked')) {
      twhList++;
    }
  });

  if(ugroup.val() == "") {
    validWh = false;
  }

  if(ugroup.val() == 3 && fwhList == 0) {
    set_error(fm, flabel, "Warehouse is required");
    validWh = false;
  }
  else {
    clear_error(fm, flabel);
    validWh = true;
  }

  if(ugroup.val() == 3 && twhList == 0) {
    set_error(to, tlabel, "Warehouse is required");
    validWh = false;
  }
  else {
    clear_error(to, tlabel);
    validWh = true;
  }
}


function validUserGroup() {
	let el = $('#ugroup');
	let label = $('#ugroup-error');

	if(el.val() == "") {
		set_error(el, label, "Required !");
		validUgroup = false;
	}
	else {
		clear_error(el, label);
		validUgroup = true;
	}
}



$('#dname').focusout(function(){
  validDisplayName();
});


$('#uname').focusout(function(){
  validUserName();
});

$('#ugroup').focusout(function() {
  validUserGroup();
});

$('#team_id').focusout(function() {
  validUserTeam();
});


$('#warehouse').focusout(function() {
  validWarehouse();
});

$('#pwd').focusout(function(){
  validPWD();
});


$('#cm-pwd').keyup(function(e){
  validPWD();
});

$('#cm-pwd').focusout(function(){
  validPWD();
});

function toggleAreaAndWarehouse() {
  let ugroup = $('#ugroup').val();

  if(ugroup == 1) {
    $('#team-table').addClass('hide');
    $('#area-table').addClass('hide');
    $('#from-warehouse-table').addClass('hide');
    $('#to-warehouse-table').addClass('hide');
    return;
  }

  if(ugroup == 2) {
    $('#team-table').addClass('hide');
    $('#area-table').removeClass('hide');
    $('#from-warehouse-table').addClass('hide');
    $('#to-warehouse-table').addClass('hide');

    return;
  }

  if(ugroup == 3) {
    $('#team-table').removeClass('hide');
    $('#area-table').addClass('hide');
    $('#from-warehouse-table').removeClass('hide');
    $('#to-warehouse-table').removeClass('hide');

    return;
  }
}
