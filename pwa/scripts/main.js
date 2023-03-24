var uid = "";
var uname = "";
var displayName = "";
var ugroup = "";
var teamName = "";
var cameraId = "";
var fWhCode = "";
var tWhCode = "";
var userId = "";

window.addEventListener('load', function() {
  uid = getCookie('uid');
  userId = getCookie('userId');
  uname = getCookie('uname');
  displayName = decodeURIComponent(getCookie('displayName'));
  ugroup = getCookie('ugroup');
  teamName = getCookie('teamName');
  cameraId = getCookie('cameraId');
  fWhCode = getCookie('fromWhsCode');
  tWhCode = getCookie('toWhsCode');

  if( uid == "") {
    window.location.href = "login.html";
  }

  if(navigator.onLine) {
    $('#online-status').text('Online');
  }
  else {
    $('#online-status').text('Offline');
  }
});
