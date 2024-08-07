<?php
include 'personaDAO.php';
include 'expedienteDAO.php';
include 'usuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];

    $rutaSubida = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagen']['name'];
        $tipoArchivo = $_FILES['imagen']['type'];
        $tamanioArchivo = $_FILES['imagen']['size'];
        $tempArchivo = $_FILES['imagen']['tmp_name'];
        
        $rutaSubida = 'assets/imgs/profilePictures/' . $idPersona.basename($nombreArchivo);

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

    $usuarioActualizado = $usuarioDAO->actualizarImagen($idPersona,$rutaSubida); 

    if ($usuarioActualizado) {
        header('Location: ../perfil.php?success=true');
    } else {
        echo $expedienteActualizado;
        header('Location: ../perfil.php?error=02'); //Error interno
    }

    

} else {
    echo "Método de solicitud no permitido.";
}
?>