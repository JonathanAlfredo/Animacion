<?php
include 'expedienteDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];


    $rutaSubida = '';
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['file']['name'];
        $tipoArchivo = $_FILES['file']['type'];
        $tamanioArchivo = $_FILES['file']['size'];
        $tempArchivo = $_FILES['file']['tmp_name'];
        
        $rutaSubida = 'assets/files/' . basename($idPersona.".pdf");

        if (!file_exists('../assets/files')) {
            mkdir('../assets/files', 0777, true);
        }

        if (!move_uploaded_file($tempArchivo, "../" . $rutaSubida)) {
            echo $rutaSubida;
            echo "Error al mover el archivo subido.";
            exit;
        }

    } else {
        echo "Error en la subida del archivo.";
    }


    
    $expedienteDAO = new ExpedienteDAO();

    $expedienteActualizado = $expedienteDAO->actualizarConstancia($idPersona,$rutaSubida);

    if ($expedienteActualizado) {
        header('Location: ../emergencia.php?success=true');
    } else {
        echo $expedienteActualizado;
        //header('Location: ../emergencia.php?error=02'); //Error interno
    }

    

} else {
    echo "Método de solicitud no permitido.";
}
?>