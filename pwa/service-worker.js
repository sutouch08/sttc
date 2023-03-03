// the cache version gets updated every time there is a new deployment
const version = 1;
const cacheName = `cacheName-${version}`;

// these are the routes we are going to cache for offline support
let cacheFiles = [
  '/sttc/pwa',
  '/sttc/pwa/index.html',
  '/sttc/pwa/login.html',
  '/sttc/pwa/transfer.html',
  '/sttc/pwa/transfer_add.html',
  '/sttc/pwa/transfer_edit.html',
  '/sttc/pwa/scripts/app.js',
  '/sttc/pwa/scripts/login.js',
  '/sttc/pwa/scripts/transfer/transfer.js',
  '/sttc/pwa/scripts/transfer/transfer_list.js',
  '/sttc/pwa/scripts/transfer/transfer_add.js',
  '/sttc/pwa/scripts/transfer/transfer_edit.js',
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
  '/sttc/pwa/assets/fonts/OpenSans-300.wof',
  '/sttc/pwa/assets/css/ace.css',
  '/sttc/pwa/assets/css/jquery-ui-1.10.4.custom.min.css',
  '/sttc/pwa/assets/css/template.css',
  '/sttc/pwa/assets/css/sweet-alert.css'
];


// on install we download the routes we want to cache for offline
self.addEventListener('install', (ev) => {
  console.log(`Installing Version ${version}`);

  ev.waitUntil(
    caches.open(cacheName).then(
      cache => {
        cache.addAll(cacheFiles).then(
          () => {
            console.log(`${cacheName} has been updated`);
          },
          (err) => {
            console.warn(`Failed to update ${cacheName}`);
          }
        );
    })
  );
});

// on activation we clean up the previously registered service workers
self.addEventListener('activate', (ev) => {
  console.log('activated');
  ev.waitUntil(
    caches.keys().then((keys) => {
      return Promise.all(
        keys
          .filter((key) => key != cacheName)
          .map((key) => cache.delete(key))
      );
    })
  );
});

// fetch the resource from the network
const fromNetwork = (request, timeout) =>
  new Promise((fulfill, reject) => {
    const timeoutId = setTimeout(reject, timeout);
    fetch(request).then(response => {
      clearTimeout(timeoutId);
      fulfill(response);
      update(request);
    }, reject);
  });

// fetch the resource from the browser cache
const fromCache = request =>
  caches
    .open(cacheName)
    .then(cache =>
      cache
        .match(request)
        .then(matching => matching)
    );

// cache the current page to make it available for offline
const update = request =>
  caches
    .open(cacheName)
    .then(cache => {
      fetch(request.url)
        .then(fetchResponse => {
          cache.put(request, fetchResponse.clone());
          return fetchResponse;
        })
    });

// general strategy when making a request (eg if online try to fetch it
// from the network with a timeout, if something fails serve from cache)
self.addEventListener('fetch', ev => {
  if(ev.request.method !== 'GET') {
    return;
  }

  ev.respondWith(
    fromNetwork(ev.request, 10000).catch(() => fromCache(ev.request))
  );

  if(navigator.onLine) {
    ev.waitUntil(update(ev.request));
  }
});
