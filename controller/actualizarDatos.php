<?php
include 'personaDAO.php';
include 'expedienteDAO.php';
include 'usuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];
    $sexo = $_POST['sexo'];
    $idCarrera = $_POST['idCarrera'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $nombreT = $_POST['nombreT'];
    $apPaternoT = $_POST['apPaternoT'];
    $apMaternoT = $_POST['apMaternoT'];
    $telefonoT = $_POST['telefonoT'];
    $idTutor = $_POST['idTutor'];


    $personaDAO = new PersonaDAO();
    $expedienteDAO = new ExpedienteDAO();

    if ($personaDAO->existe($idTutor)) {
        $personaActualizada = $personaDAO->actualizarPersona($idPersona,$nombre,$apPaterno,$apMaterno,$telefono,$correo,$sexo);
        $expedienteActualizado = $expedienteDAO->actualizarTutorCarrera($idPersona,$idTutor,$idCarrera);

        if ($personaActualizada && $expedienteActualizado) {
            header('Location: ../datos.php?error=false');
        } else {
            echo $expedienteActualizado;
            header('Location: ../datos.php?error=02'); //Error interno
        }
        
    }else{
        $idParteTiempo = intval(microtime(true) * 0.00001);
        $idParteAleatoria = mt_rand(1, 999);
        $idUnica = $idParteTiempo . $idParteAleatoria;
        $tutorInsertado = $personaDAO->insertarPersona($idUnica,$nombreT,$apPaternoT,$apMaternoT,$telefonoT,'','',3);
        
        if ($tutorInsertado) {
            $personaActualizada = $personaDAO->actualizarPersona($idPersona,$nombre,$apPaterno,$apMaterno,$telefono,$correo,$sexo);
            $expedienteActualizado = $expedienteDAO->actualizarTutorCarrera($idPersona,$idUnica,$idCarrera);

            if ($personaActualizada && $expedienteActualizado) {
                header('Location: ../datos.php?error=false');
            } else {
                echo $expedienteActualizado;
                header('Location: ../datos.php?error=02'); //Error interno
            }

        } else {
            header('Location: ../datos.php?error=03'); //Esta persona ya esta registrada
        }
    }

    

} else {
    echo "Método de solicitud no permitido.";
}
?>