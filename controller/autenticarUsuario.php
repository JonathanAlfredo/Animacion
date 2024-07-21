<?php
include 'usuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];
    $pass = $_POST['pass'];

    $usuarioDAO = new UsuarioDAO();

    $usuario = $usuarioDAO->autenticarUsuario($idPersona, $pass);

    if ($usuario) {
        header('Location: ../menu.php'); //acceso
    } else {
        header('Location: ../index.php?error=04'); //usuario o contraseña incorrecto
    }

} else {
    echo "Método de solicitud no permitido.";
}
?>