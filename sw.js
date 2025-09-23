// k: service worker cache-first strategy
const CACHE = 'kamar-v1';
const OFFLINE = '/offline/';
self.addEventListener('install', e => {
  e.waitUntil(
    caches.open(CACHE).then(cache =>
      cache.addAll([
        '/',
        OFFLINE,
        '/wp-content/themes/kamar-hkombat/assets/css/tailwind.min.css',
        '/wp-content/themes/kamar-hkombat/assets/js/app.js'
      ])
    )
  );
});
self.addEventListener('fetch', e => {
  e.respondWith(
    caches.match(e.request).then(res => res || fetch(e.request))
  );
});