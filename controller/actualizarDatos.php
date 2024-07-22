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


    

    $rutaSubida = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagen']['name'];
        $tipoArchivo = $_FILES['imagen']['type'];
        $tamanioArchivo = $_FILES['imagen']['size'];
        $tempArchivo = $_FILES['imagen']['tmp_name'];
        
        $rutaSubida = 'assets/imgs/profilePictures/' . basename($nombreArchivo);

        if (!file_exists('../assets/imgs/profilePictures')) {
            mkdir('../assets/imgs/profilePictures', 0777, true);
        }

        if (!move_uploaded_file($tempArchivo, "../" . $rutaSubida)) {
            echo $rutaSubida;
            echo "Error al mover el archivo subido.";
            exit;
        }

    } else {
        echo "Error en la subida del archivo.";
    }


    


    
    $personaDAO = new PersonaDAO();
    $usuarioDAO = new UsuarioDAO();
    $expedienteDAO = new ExpedienteDAO();

    if ($personaDAO->existe($idTutor)) {
        $personaActualizada = $personaDAO->actualizarPersona($idPersona,$nombre,$apPaterno,$apMaterno,$telefono,$correo,$sexo);
        $usuarioActualizado = $usuarioDAO->actualizarImagen($idPersona,$rutaSubida); 
        $expedienteActualizado = $expedienteDAO->actualizarTutorCarrera($idPersona,$idTutor,$idCarrera);

        if ($usuarioActualizado && $personaActualizada && $expedienteActualizado) {
            header('Location: ../perfil.php?success=true');
        } else {
            echo $expedienteActualizado;
            header('Location: ../perfil.php?error=02'); //Error interno
        }
        
    }else{
        $idParteTiempo = intval(microtime(true) * 0.00001);
        $idParteAleatoria = mt_rand(1, 999);
        $idUnica = $idParteTiempo . $idParteAleatoria;
        $tutorInsertado = $personaDAO->insertarPersona($idUnica,$nombreT,$apPaternoT,$apMaternoT,$telefonoT,'','',3);
        
        if ($tutorInsertado) {
            $personaActualizada = $personaDAO->actualizarPersona($idPersona,$nombre,$apPaterno,$apMaterno,$telefono,$correo,$sexo);
            $usuarioActualizado = $usuarioDAO->actualizarImagen($idPersona,$rutaSubida); 
            $expedienteActualizado = $expedienteDAO->actualizarTutorCarrera($idPersona,$idUnica,$idCarrera);

            if ($usuarioActualizado && $personaActualizada && $expedienteActualizado) {
                header('Location: ../perfil.php?success=true');
            } else {
                echo $expedienteActualizado;
                header('Location: ../perfil.php?error=02'); //Error interno
            }

        } else {
            header('Location: ../perfil.php?error=03'); //Esta persona ya esta registrada
        }
    }

    

} else {
    echo "Método de solicitud no permitido.";
}
?>