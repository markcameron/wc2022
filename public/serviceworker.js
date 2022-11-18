var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    // '/offline',
    // '/build/assets/app.*.css',
    // '/js/app.js',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
    '/images/flags/de.png',
    '/images/flags/dk.png',
    '/images/flags/ec.png',
    '/images/flags/es.png',
    '/images/flags/fr.png',
    '/images/flags/gb-eng.png',
    '/images/flags/gb-wls.png',
    '/images/flags/gh.png',
    '/images/flags/hr.png',
    '/images/flags/ir.png',
    '/images/flags/jp.png',
    '/images/flags/kr.png',
    '/images/flags/ma.png',
    '/images/flags/mx.png',
    '/images/flags/nl.png',
    '/images/flags/pl.png',
    '/images/flags/pt.png',
    '/images/flags/qa.png',
    '/images/flags/rs.png',
    '/images/flags/sa.png',
    '/images/flags/sn.png',
    '/images/flags/tn.png',
    '/images/flags/us.png',
    '/images/flags/uy.png',
    '/images/flags/ar.png',
    '/images/flags/au.png',
    '/images/flags/be.png',
    '/images/flags/br.png',
    '/images/flags/ca.png',
    '/images/flags/ch.png',
    '/images/flags/cm.png',
    '/images/flags/cr.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
// self.addEventListener("fetch", event => {
//     event.respondWith(
//         caches.match(event.request)
//             .then(response => {
//                 return response || fetch(event.request);
//             })
//             .catch((e) => {
//                 return caches.match('offline');
//             })
//     )
// });
