<?php
include 'expedienteDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];
    $idEstadoCivil = $_POST['idEstadoCivil'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $tipoSangre = $_POST['tipoSangre'];
    $condMedicas = $_POST['condMedicas'];

    


    
    $expedienteDAO = new ExpedienteDAO();

    $expedienteActualizado = $expedienteDAO->actualizarDatosExpediente($idPersona,$fechaNacimiento,$idEstadoCivil,$tipoSangre,$condMedicas);

    if ($expedienteActualizado) {
        header('Location: ../expediente.php?error=false');
    } else {
        echo $expedienteActualizado;
        header('Location: ../expediente.php?error=02'); //Error interno
    }

    

} else {
    echo "Método de solicitud no permitido.";
}
?>