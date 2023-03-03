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

  // console.log(validUname, validDname, validUgroup, validTeam, validWh, validPwd);
  // return false;
	const uname = $('#uname').val();
	const dname = $('#dname').val();
	const team_id = $('#team_id').val();
	const pwd = $('#pwd').val();
	const ugroup = $('#ugroup').val();
	const active = $('#active').is(':checked') ? 1 : 0;
	const force_reset = $('#force_reset').is(':checked') ? 1 : 0;
  const fromWhsCode = $('#fromWhsCode').val();
  const toWhsCode = $('#toWhsCode').val();

  let teamList = [];

  $('.chk-area').each(function() {
    if($(this).is(':checked')) {
      teamList.push($(this).val());
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
      'fromWhsCode' : fromWhsCode,
      'toWhsCode' : toWhsCode,
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
  const fromWhsCode = $('#fromWhsCode').val();
  const toWhsCode = $('#toWhsCode').val();

  let teamList = [];

  $('.chk-area').each(function() {
    if($(this).is(':checked')) {
      teamList.push($(this).val());
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
      'fromWhsCode' : fromWhsCode,
      'toWhsCode' : toWhsCode,
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
  let er = 0;
  let ugroup = $('#ugroup');

  if(ugroup.val() == "") {
    er++;
  }

  if(ugroup.val() == 3) {
    let el = $('#team_id');
    let label = $('#team-error');
    if(el.val() == "") {
      set_error(el, label, "Area is required");
      er++;
    }
    else {
      clear_error(el, label);
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
      er++;
    }
    else {
      clear_error(el, label);
    }
  }

  if(er > 0) {
    validTeam = false;
  }
  else {
    validTeam = true;
  }
}


function validWarehouse() {
  let er = 0;
  let ugroup = $('#ugroup');
  let fm = $('#fromWhsCode');
  let to = $('#toWhsCode');
  let flabel = $('#from-warehouse-error');
  let tlabel = $('#to-warehouse-error');

  if(ugroup.val() == "") {
    er++;
  }

  if(ugroup.val() == 3 && fm.val() == "") {
    set_error(fm, flabel, "Warehouse is required");
    er++;
  }
  else {
    clear_error(fm, flabel);
  }

  if(ugroup.val() == 3 && to.val() == "") {
    set_error(to, tlabel, "Warehouse is required");
    er++;
  }
  else {
    clear_error(to, tlabel);
  }

  if(ugroup.val() == 3 && fm.val() == to.val()) {
    set_error(to, tlabel, "Warehouse cannot be the same");
    er++;
  }

  if(er > 0) {
    validWh = false;
  }
  else {
    validWh = true;
  }
}


function validUserGroup() {
  let er = 0;
	let el = $('#ugroup');
	let label = $('#ugroup-error');

	if(el.val() == "") {
		set_error(el, label, "Required !");
		er++;
	}
	else {
		clear_error(el, label);
	}

  if(er > 0) {
    validUgroup = false;
  }
  else {
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


$('#fromWhsCode').focusout(function() {
  validWarehouse();
});

$('#toWhsCode').focusout(function() {
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
