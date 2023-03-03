var uid = "";
var uname = "";
var displayName = "";
var ugroup = "";
var teamName = "";
var cameraId = "";
var fWhCode = "";
var tWhCode = "";

window.addEventListener('load', function() {
  uid = getCookie('uid');
  uname = getCookie('uname');
  displayName = decodeURIComponent(getCookie('displayName'));
  ugroup = getCookie('ugroup');
  teamName = getCookie('teamName');
  cameraId = getCookie('cameraId');
  fWhCode = getCookie('fromWhsCode');
  tWhCode = getCookie('toWhsCode');

  if( uid == "") {
    if(navigator.onLine) {
      window.location.href = BASE_URL + "users/authentication";
    }
    else {
      window.location.href = "login.html";
    }
  }
});
