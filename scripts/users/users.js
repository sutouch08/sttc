var validUname = true;
var validDname = true;
var validUgroup = true;
var validTeam = true;
var validWh = true;
var validPwd = true;

$('#cut-off-date').datepicker({
  dateFormat:'dd-mm-yy'
});

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
	validPWD();

	if( !validUname || !validDname || !validPwd ) {
		return false;
	}

	const uname = $('#uname').val();
	const dname = $('#dname').val();
	const team_id = $('#team_id').val();
	const pwd = $('#pwd').val();
	const ugroup = $('#ugroup').val();
	const active = $('#active').is(':checked') ? 1 : 0;
	const force_reset = $('#force_reset').is(':checked') ? 1 : 0;
  const can_get_meter = $('#can_get_meter').is(':checked') ? 1 : 0;
  const fromWhsCode = $('#fromWhsCode').val();
  const toWhsCode = $('#toWhsCode').val();
  let date = $('#cut-off-date').val();

  if(team_id != "") {
    if(fromWhsCode.length == 0 || toWhsCode.length == 0) {
      swal({
        title:'Required',
        text:'กรุณาระบุคลังสำเร็จและคลังลงลัง',
        typs:'warning'
      });

      return false;
    }
  }

  if( ! isDate(date)) {
    date = "";
  }

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
      'fromWhsCode' : fromWhsCode,
      'toWhsCode' : toWhsCode,
      'cut_off_date' : date,
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

	if( ! validDname ) {
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
  let date = $('#cut-off-date').val();

  if(team_id != "") {
    if(fromWhsCode.length == 0 || toWhsCode.length == 0) {
      swal({
        title:'Required',
        text:'กรุณาระบุคลังสำเร็จและคลังลงลัง',
        typs:'warning'
      });

      return false;
    }
  }

  if( ! isDate(date)) {
    date = "";
  }

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
			'ugroup' : ugroup,
      'fromWhsCode' : fromWhsCode,
      'toWhsCode' : toWhsCode,
      'cut_off_date' : date,
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



$('#dname').focusout(function(){
  validDisplayName();
});


$('#uname').focusout(function(){
  validUserName();
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


function updateWhsList() {
  let area = $('#team_id').val();

  $.ajax({
    url:HOME + 'get_warehouse_list_by_area',
    type:'POST',
    cache:false,
    data:{
      'area' : area
    },
    success:function(rs) {
      if(isJson(rs)) {
        let ds = JSON.parse(rs);

        $('#fromWhsCode').html(ds.fromWhs);
        $('#toWhsCode').html(ds.toWhs);
      }
    }
  })
}
