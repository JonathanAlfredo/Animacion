function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        document.getElementById("location").value = "Geolocalización no es soportada por este navegador.";
    }
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    document.getElementById("location").value = lat + "," + lon;
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            document.getElementById("location").value = "El usuario negó la solicitud de geolocalización.";
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("location").value = "La información de ubicación no está disponible.";
            break;
        case error.TIMEOUT:
            document.getElementById("location").value = "La solicitud para obtener la ubicación del usuario ha caducado.";
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("location").value = "Se ha producido un error desconocido.";
            break;
    }
}

getLocation();