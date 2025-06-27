const CACHE_NAME = 'v1.0.0';

const cacheAssets = [
    '/',
    '/manifest.json',
    '/favicon.ico',
    '/pwa/icons/android/android-launchericon-48-48.png',
    '/pwa/icons/android/android-launchericon-72-72.png',
    '/pwa/icons/android/android-launchericon-96-96.png',
    '/pwa/icons/android/android-launchericon-144-144.png',
    '/pwa/icons/android/android-launchericon-192-192.png',
    '/pwa/icons/android/android-launchericon-512-512.png',
    '/pwa/icons/ios/180.png',
    // Adicione todos os outros ícones de iOS e Windows aqui
    '/pwa/icons/windows11/SmallTile.scale-100.png',
    '/pwa/icons/windows11/SmallTile.scale-125.png',
    '/pwa/icons/windows11/SmallTile.scale-150.png',
    '/pwa/icons/windows11/SmallTile.scale-200.png',
    '/pwa/icons/windows11/Square150x150Logo.scale-100.png',
    '/pwa/icons/windows11/Square150x150Logo.scale-125.png',
    '/pwa/icons/windows11/Square150x150Logo.scale-150.png',
    '/pwa/icons/windows11/Wide310x150Logo.scale-100.png',
    '/pwa/icons/windows11/Wide310x150Logo.scale-125.png',
    '/pwa/icons/windows11/Wide310x150Logo.scale-150.png',
    '/pwa/icons/windows11/LargeTile.scale-100.png',
    '/pwa/icons/windows11/LargeTile.scale-125.png',
    '/pwa/icons/windows11/LargeTile.scale-150.png',
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Caching app shell');
                return cache.addAll(cacheAssets);
            })
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Removing old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) {
                    console.log('Serving from cache:', event.request.url);
                    return response;
                }
                console.log('Fetching from network:', event.request.url);
                return fetch(event.request);
            })
    );
});
