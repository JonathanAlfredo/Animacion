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

