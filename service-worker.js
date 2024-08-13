self.addEventListener('push', function(event) {
    const data = event.data.json();
    const opciones = {
        body: data.body || 'CLICK PARA VISUALIZAR',
        vibrate: [200, 100, 200],
        requireInteraction: true,
    };

    event.waitUntil(
        self.registration.showNotification(data.title || 'Se ha encontrado un reporte nuevo', opciones)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow('lista.php')
    );
});
