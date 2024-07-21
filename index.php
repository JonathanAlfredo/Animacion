<?php
include 'controller/sesionManager.php';

$exit = isset($_GET['exit']) ? $_GET['exit'] : 'Desconocido';

if ($exit=='true') {
    sesionKiller();
}else{
    verifySesion(true);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
</head>
<body>
    <div class="container full-height centered">
        <div class="card">
            <img src="assets/imgs/image.png" alt="logo">
            <form action="controller/autenticarUsuario.php" method="POST" class="form">
                <input type="text" name="idPersona" inputmode="numeric" pattern="\d*" placeholder="Matricula" required  />
                <input type="password" name="pass" placeholder="Contraseña" required>
                <button type="submit" class="btn-primary">Iniciar Sesión</button>
                <a href="registro.php" class="link">Crear Cuenta</a>
                <a href="" class="link" style="color: crimson;">Olvide mi contraseña</a>
            </form>
        </div>
    </div>
</body>
</html>
