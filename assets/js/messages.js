

if (error === 'badAuentication') {
    Swal.fire({
        icon: "error",
        text: "Usuario o contraseña incorrectos"
    });
}else if (error === 'badPassAuth') {
    Swal.fire({
        icon: "error",
        text: "Las contraseñas no coinciden"
    });
}else if (error === 'userAlreadyExists') {
    Swal.fire({
        icon: "error",
        text: "Este usuario ya esta registrado"
    });
}else if (error === '02') {
    Swal.fire({
        icon: "error",
        text: "No se pudo realizar la operacion"
    });
}else if (error === 'false') {
    Swal.fire({
        icon: "success",
        text: "La operacion se realizó con éxito"
    });
}