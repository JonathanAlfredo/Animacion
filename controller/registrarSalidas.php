<?php
include 'asistenciaDAO.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];
    $idEvento = $_POST['idEvento'];


    $asistenciaDAO = new AsistenciaDAO();








    

    $salidaRegisrada = $asistenciaDAO->registrarSalida($idEvento,$idPersona);

    if(!$salidaRegisrada) {

        header('Location: ../evento.php?error=02');
        exit;
    }
        
    
    
    header('Location: ../evento.php?error=false');
    exit;

       

    

} else {
    echo "Método de solicitud no permitido.";
}
?>