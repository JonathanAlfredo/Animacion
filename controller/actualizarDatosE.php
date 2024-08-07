<?php
include 'expedienteDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];
    $nss = $_POST['nss'];
    $clinica = $_POST['clinica'];
    $direccion = $_POST['direccion'];

    


    
    $expedienteDAO = new ExpedienteDAO();

    $expedienteActualizado = $expedienteDAO->actualizarDatosEm($idPersona,$nss,$clinica,$direccion);

    if ($expedienteActualizado) {
        header('Location: ../emergencia.php?error=false');
    } else {
        echo $expedienteActualizado;
        header('Location: ../emergencia.php?error=02'); //Error interno
    }

    

} else {
    echo "Método de solicitud no permitido.";
}
?>