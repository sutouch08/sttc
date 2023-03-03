var BASE_URL = 'http://localhost/sttc/';
var COOKIE_PATH = '/sttc';

if('serviceWorker' in navigator) {
  navigator.serviceWorker.register('service-worker.js').then(() => {
    console.log('Service Worker Registered');
  });
}




function logout() {
  deleteCookie('uid', COOKIE_PATH);
  window.location.href = "login.html";
}

function isOnline() {
  return navigator.onLine;
}
