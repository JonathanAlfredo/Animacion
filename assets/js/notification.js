Notification.requestPermission().then(permission => {
    if (permission === 'granted') {
        console.log('Permiso concedido');
    } else {
        console.log('Permiso denegado');
    }
});

function mostrarNotificacion() {
    const opciones = {
        body: 'CLICK PARA VISUALIZAR',
        vibrate: [200, 100, 200],
        requireInteraction: true,
        icon: 'assets/imgs/advertencia.png'
    };

    const notificacion = new Notification('Se ha encontrado un reporte nuevo', opciones);

    notificacion.onclick = function() {
        window.location.href = 'lista.php'; 
    };

    notificacion.onclose = function() {
        console.log('Notificación cerrada');
    };
}

