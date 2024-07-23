<?php
include 'personaDAO.php';
include 'usuarioDAO.php';
include 'expedienteDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $passConf = $_POST['pass1'];
    $idTipoPersona = $_POST['idTipoPersona'];

    if ($pass != $passConf) {
        header('Location: ../registro.php?error=01'); //Las contraseñas no coinciden
        exit;
    }

    $personaDAO = new PersonaDAO();
    $usuarioDAO = new UsuarioDAO();
    $expedienteDAO = new ExpedienteDAO();

    $personaInsertada = $personaDAO->insertarPersona($idPersona,"","","","",$correo,"",$idTipoPersona);

    if ($personaInsertada) {
        $usuarioInsertado = $usuarioDAO->insertarUsuario($idPersona, $pass,1);
        $expedienteInsertado = $expedienteDAO->insertarExpediente($idPersona);

        if ($usuarioInsertado && $expedienteInsertado) {
            header('Location: ../index.php?success=true');
        } else {
            header('Location: ../registro.php?error=02'); //Error interno, problema al insertar usuario
        }

    } else {
        echo $personaInsertada;
        header('Location: ../registro.php?error=03'); //Esta persona ya esta registrada
    }

} else {
    echo "Método de solicitud no permitido.";
}
?>