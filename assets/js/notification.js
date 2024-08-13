Notification.requestPermission().then(permission => {
    if (permission === 'granted') {
        console.log('Permiso concedido');
    } else {
        console.log('Permiso denegado');
    }
});

// Función para mostrar la notificación
function mostrarNotificacion(registration) {
    if (!registration) {
        console.error('La registration es undefined. Asegúrate de que el Service Worker está registrado correctamente.');
        return;
    }

    const opciones = {
        body: 'CLICK PARA VISUALIZAR',
        vibrate: [200, 100, 200],
        requireInteraction: true,
        icon: 'assets/imgs/advertencia.png'
    };

    registration.showNotification('Se ha encontrado un reporte nuevo', opciones);
}

// Registro del Service Worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('service-worker.js').then(function(registration) {
        console.log('Service Worker registrado con éxito:', registration);

        // Verifica si registration está correctamente definido
        if (registration) {
            mostrarNotificacion(registration);
        } else {
            console.error('Service Worker registration fallido');
        }

    }).catch(function(error) {
        console.error('Error al registrar el Service Worker:', error);
    });
} else {
    console.warn('Service Worker no soportado en este navegador.');
}
