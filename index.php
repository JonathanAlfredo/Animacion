<?php
include 'controller/sesionManager.php';

$exit = isset($_GET['exit']) ? $_GET['exit'] : 'Desconocido';
$error = isset($_GET['error']) ? $_GET['error'] : 'Desconocido';


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <script>

        var error = <?php echo json_encode($error); ?>;

    </script>

    <script src="assets/js/messages.js"></script>

    <div class="container  centered">
        <div class="card">
            <img src="assets/imgs/image.png" alt="logo">
            <form action="controller/autenticarUsuario.php" method="POST" class="form">
                <input type="text" name="idPersona" inputmode="numeric" pattern="\d*" placeholder="Matricula" required maxlength="11" />
                <input type="password" name="pass" placeholder="Contraseña" required maxlength="100">
                <button type="submit" class="btn-primary">Iniciar Sesión</button>
                <a href="registro.php" class="link">Crear Cuenta</a>
                <!--  <a href="" class="link" style="color: crimson;">Olvide mi contraseña</a> -->
            </form>
        </div>
    </div>
</body>
</html>
