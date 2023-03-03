
'use strict';

// CODELAB: Update cache names any time any of the cached files change.
const cacheName = '2aa1ws';

// CODELAB: Add list of files to cache here.

const filesToCache = [
  '/sttc/pwa',
  '/sttc/pwa/index.html',
  '/sttc/pwa/login.html',
  '/sttc/pwa/transfer.html',
  '/sttc/pwa/scripts/app.js',
  '/sttc/pwa/scripts/login.js',
  '/sttc/pwa/scripts/transfer/transfer_add.js',
  '/sttc/pwa/scripts/transfer/transfer_list.js',
  '/sttc/pwa/assets/js/localforage.js',
  '/sttc/pwa/assets/js/ace-extra.js',
  '/sttc/pwa/assets/js/jquery.min.js',
  '/sttc/pwa/assets/js/jquery-ui-1.10.4.custom.min.js',
  '/sttc/pwa/assets/js/bootstrap.js',
  '/sttc/pwa/assets/js/ace.js',
  '/sttc/pwa/assets/js/sweet-alert.js',
  '/sttc/pwa/assets/js/handlebars-v3.js',
  '/sttc/pwa/assets/css/bootstrap.css',
  '/sttc/pwa/assets/css/font-awesome.css',
  '/sttc/pwa/assets/css/ace-fonts.css',
  '/sttc/pwa/assets/css/ace.css',
  '/sttc/pwa/assets/css/jquery-ui-1.10.4.custom.min.css',
  '/sttc/pwa/assets/css/template.css',
  '/sttc/pwa/assets/css/sweet-alert.css'
];

// const filesToCache = [
//   '/pwa',
//   '/pwa/index.html',
//   '/pwa/login.html',
//   '/pwa/transfer/transfer.html',
//   '/pwa/scripts/app.js',
//   '/pwa/scripts/login.js',
//   '/pwa/scripts/transfer/transfer.js',
//   '/pwa/scripts/transfer/transfer_list.js',
//   '/pwa/assets/js/localforage.js',
//   '/pwa/assets/js/ace-extra.js',
//   '/pwa/assets/js/jquery.min.js',
//   '/pwa/assets/js/jquery-ui-1.10.4.custom.min.js',
//   '/pwa/assets/js/bootstrap.js',
//   '/pwa/assets/js/ace.js',
//   '/pwa/assets/js/sweet-alert.js',
//   '/pwa/assets/js/handlebars-v3.js',
//   '/pwa/assets/css/bootstrap.css',
//   '/pwa/assets/css/font-awesome.css',
//   '/pwa/assets/css/ace-fonts.css',
//   '/pwa/assets/css/ace.css',
//   '/pwa/assets/css/jquery-ui-1.10.4.custom.min.css',
//   '/pwa/assets/css/template.css',
//   '/pwa/assets/css/sweet-alert.css'
// ];

// self.addEventListener('install', (e) => {
//   console.log('[ServiceWorker] Install');
//   e.waitUntil(caches.open(cacheName).then((cache) => {
//     cache.addAll(filesToCache);
//   }));
//   //self.skipWaiting();
// });

self.addEventListener("install", (e) => {
  console.log("[Service Worker] Install");
  e.waitUntil(
    (async () => {
      const cache = await caches.open(cacheName);
      console.log("[Service Worker] Caching all: app shell and content");
      await cache.addAll(filesToCache);
    })()
  );
});


self.addEventListener('activate', event => {
  console.log('[ServiceWorker] Activate');
  var cacheKeeplist = [cacheName];
  event.waitUntil(
      caches.keys().then( keyList => {
          return Promise.all(keyList.map( key => {
              if (cacheKeeplist.indexOf(key) === -1) {
                  return caches.delete(key);
              }
          }));
      })
.then(self.clients.claim())); //this line is important in some contexts
});

// self.addEventListener('activate', (e) => {
//   console.log('[ServiceWorker] Activate');
//   // CODELAB: Remove previous cached data from disk.
//
//   //self.clients.claim();
// });


self.addEventListener("fetch", (e) => {
  e.respondWith(
    (async () => {
      const r = await caches.match(e.request);
      console.log(`[Service Worker] Fetching resource: ${e.request.url}`);
      if (r) {
        return r;
      }
      const response = await fetch(e.request);
      const cache = await caches.open(cacheName);
      console.log(`[Service Worker] Caching new resource: ${e.request.url}`);
      cache.put(e.request, response.clone());
      return response;
    })()
  );
});
