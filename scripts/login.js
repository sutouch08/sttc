function isJson(str){
	try{
		JSON.parse(str);
	}catch(e){
		return false;
	}
	return true;
}


function doLogin() {
	const uname = $('#uname').val();
	const pwd = $('#pwd').val();
	const ipwd = $('#ipwd').text();
	const remember = $('#remember').is(':checked') ? 1 : 0;

	if(uname.length == 0) {
		$('#uname').focus();
		return false;
	}

	if(pwd.length == 0) {
		$('#pwd').focus();
		return false;
	}

	if(pwd != ipwd) {
		return false;
	}

	$.ajax({
		url:BASE_URL + 'users/authentication/validate_credentials',
		type:'POST',
		cache:false,
		data:{
			'uname' : uname,
			'pwd' : ipwd,
			'remember' : remember
		},
		success:function(rs) {

			if(isJson(rs)) {
				let ds = JSON.parse(rs);

				if(ds.status === 'success') {
					let sttc_uid = ds.userdata.uid;
					localStorage.setItem('sttc_uid', sttc_uid);
					localStorage.setItem('userdata', JSON.stringify(ds.userdata));

					setTimeout(() => {
						window.location.href = BASE_URL;
					}, 200);
				}
				else {
					$('#error-label').text(ds.message);
				}
			}
		}
	});
}



$('#pwd').keyup(function(e) {
	if(e.keyCode === 13) {
		doLogin();
	}
	else {
		$('#ipwd').text($(this).val());
	}
});


$('#uname').keyup(function(e) {
	if(e.keyCode === 13) {
		doLogin();
	}
});
