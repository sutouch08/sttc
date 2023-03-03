var HOME = 'http://172.20.10.2/sttc/pwa/';
$(document).ready(function() {
	if(isOnline()) {
		window.location.href = BASE_URL + "users/authentication";
	}
});

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

	if(isOnline()) {
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
				rs = $.trim(rs);

				if(rs === 'success') {
					window.location.href = HOME;
				}
				else {
					$('#error-label').text(rs);
				}
			}
		});
	}
	else {
		swal({
			title:"ไม่สำเร็จ",
			text:"ไม่สามารถเชื่อมต่อบริการได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง",
			type:"info"
		});
	}

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
