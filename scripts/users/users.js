var validUname = true;
var validDname = true;
var validUgroup = true;
var validTeam = true;
var validGroup = true;
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
  validTeamGroup();
	validPWD();

	if( !validUname || !validDname || !validUgroup || !validTeam || !validGroup || !validPwd ) {
		return false;
	}

	const uname = $('#uname').val();
	const dname = $('#dname').val();
	const team_id = $('#team_id').val();
  const group_id = $('#group_id').val();
	const pwd = $('#pwd').val();
	const ugroup = $('#ugroup').val();
	const active = $('#active').is(':checked') ? 1 : 0;
	const force_reset = $('#force_reset').is(':checked') ? 1 : 0;
  const can_get_meter = $('#can_get_meter').is(':checked') ? 1 : 0;

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
      'group_id' : group_id,
      'can_get_meter': can_get_meter,
      'team_list' : JSON.stringify(teamList),
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
  validTeamGroup();

	if( !validDname || !validUgroup || !validTeam || !validGroup ) {
		return false;
	}

	const id = $('#user_id').val();
  const uname = $('#uname').val();
	const dname = $('#dname').val();
	const team_id = $('#team_id').val();
	const ugroup = $('#ugroup').val();
	const active = $('#active').is(':checked') ? 1 : 0;
  const group_id = $('#group_id').val();
  const can_get_meter = $('#can_get_meter').is(':checked') ? 1 : 0;

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
      'group_id' : group_id,
      'can_get_meter': can_get_meter,
      'team_list' : JSON.stringify(teamList),
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
      $('#cm-pwd-error').text('รหัสผ่านไม่ตรงกัน !');
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
    $('#pwd-error').text('ต้องกำหนดรหัสผ่าน !');
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
          $('#uname-error').text('ชื่อผู้ใช้งานซ้ำ !');
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
    $('#uname-error').text('ต้องกำหนดชื่อผู้ใช้งาน !');
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
	        $('#dname-error').text('ชื่อพนักงานซ้ำ !');
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
    $('#dname-error').text('ต้องกำหนดชื่อพนักงาน !');
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
      set_error(el, label, "ต้องระบุเขต/พื้นที");
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
      set_error(el, label, "ต้องระบุเขต/พื้นที่");
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


function validTeamGroup() {
  let er = 0;
  let ugroup = $('#ugroup');

  if(ugroup.val() == "") {
    er++;
  }

  if(ugroup.val() == 3) {
    let el = $('#group_id');
    let label = $('#team-group-error');
    if(el.val() == "") {
      set_error(el, label, "ต้องระบุทีมติดตั้ง");
      er++;
    }
    else {
      clear_error(el, label);
    }
  }


  if(er > 0) {
    validGroup = false;
  }
  else {
    validGroup = true;
  }
}


function validUserGroup() {
  let er = 0;
	let el = $('#ugroup');
	let label = $('#ugroup-error');

	if(el.val() == "") {
		set_error(el, label, "ต้องเลือกกลุ่มผู้ใช้งาน !");
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


$('#pwd').focusout(function(){
  validPWD();
});


$('#cm-pwd').keyup(function(e){
  validPWD();
});

$('#cm-pwd').focusout(function(){
  validPWD();
});

function toggleArea() {
  let ugroup = $('#ugroup').val();

  if(ugroup == 1) {
    $('#team-table').addClass('hide');
    $('#area-table').addClass('hide');
    $('#team-group-table').addClass('hide');
    $('#get-meter-table').addClass('hide');
    return;
  }

  if(ugroup == 2) {
    $('#team-table').addClass('hide');
    $('#team-group-table').addClass('hide');
    $('#area-table').removeClass('hide');
    $('#get-meter-table').addClass('hide');
    return;
  }

  if(ugroup == 3) {
    $('#team-table').removeClass('hide');
    $('#team-group-table').removeClass('hide');
    $('#area-table').addClass('hide');  
    $('#get-meter-table').removeClass('hide');
    return;
  }
}


function getPermission(id) {
  window.location.href = HOME + 'user_permission/'+id;
}


function groupViewCheck(el, id)
{
	if(el.is(":checked")){
		$(".view-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".view-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}

function groupAddCheck(el, id)
{
	if(el.is(":checked")){
		$(".add-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".add-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}

function groupEditCheck(el, id)
{
	if(el.is(":checked")){
		$(".edit-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".edit-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}

function groupDeleteCheck(el, id)
{
	if(el.is(":checked")){
		$(".delete-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".delete-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}


function groupApproveCheck(el, id)
{
	if(el.is(":checked")){
		$(".approve-"+id).each(function(index, element) {
			$(this).prop("checked",true);
		});
	}else{
		$(".approve-"+id).each(function(index, element) {
			$(this).prop("checked",false);
		});
	}
}


function groupAllCheck(el, id)
{
  var view = $("#view-group-"+id);
  var add = $("#add-group-"+id);
  var edit = $("#edit-group-"+id);
  var del  = $("#delete-group-"+id);
  var ap = $('#approve-group-'+id);

	if(el.is(":checked")){
		view.prop("checked", true);
		groupViewCheck(view, id);
		add.prop("checked", true);
		groupAddCheck(add, id);
		edit.prop("checked", true);
		groupEditCheck(edit, id);
		del.prop("checked", true);
		groupDeleteCheck(del, id);
    ap.prop("checked", true);
		groupApproveCheck(ap, id);

	}else{
    view.prop("checked", false);
		groupViewCheck(view, id);
		add.prop("checked", false);
		groupAddCheck(add, id);
		edit.prop("checked", false);
		groupEditCheck(edit, id);
		del.prop("checked", false);
		groupDeleteCheck(del, id);
    ap.prop("checked", false);
		groupApproveCheck(ap, id);
	}
}


function allCheck(el, id_tab){
  if(el.is(":checked")){
    $("."+id_tab).each(function(index, element) {
      $(this).prop("checked", true);
    });
  }
  else {
    $("."+id_tab).each(function(index, element) {
      $(this).prop("checked", false);
    });
  }
}


function savePermission(){
  var id = $('#user_id').val();
	var pms = [];

	$('.menu-code').each(function(){
		let menu = $(this).val();
		let view = $('#view-'+menu).is(':checked') ? 1 : 0;
		let add = $('#add-'+menu).is(':checked') ? 1 : 0;
		let edit = $('#edit-'+menu).is(':checked') ? 1 : 0;
		let del = $('#delete-'+menu).is(':checked') ? 1 : 0;
    let ap = $('#approve-'+menu).is(':checked') ? 1 : 0;

		let row = {
			"menu" : menu,
			"view" : view,
			"add" : add,
			"edit" : edit,
			"delete" : del,
      "approve" : ap
		}

		pms.push(row);
	});

	load_in();

	$.ajax({
		url:HOME + 'update_permission',
		type:'POST',
		cache:false,
		data:{
			'user_id' : id,
			'data' : JSON.stringify(pms)
		},
		success:function(rs) {
			load_out();
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
					text:rs,
					type:'error'
				});
			}
		}
	})
}


function getTeamGroupList() {
  let team_id = $('#team_id').val();
  let data = [];
  let source = $('#group-template').html();
  let output = $('#group_id');

  if(team_id == "") {
    $('#team_id').addClass('has-error');
    $('#team-error').text('ต้องระบุเขต/พื้นที่');
  }
  else {
    $('#team_id').removeClass('has-error');
    $('#team-error').text('');
  }

  $.ajax({
    url:BASE_URL + 'admin/group/get_team_group_by_team_id',
    type:'GET',
    cache:false,
    data:{
      'team_id' : team_id
    },
    success:function(rs) {
      if(isJson(rs)) {
        data = JSON.parse(rs);
        source = $('#group-template').html();
        output = $('#group_id');

        render(source, data, output);
      }
      else {
        console.log(rs);
        render(source, data, output);
      }
    }
  });

}
