<?php
include 'eventoDAO.php';
include 'asistenciaDAO.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idEncargado = $_POST['idEncargado'];
    $asistentes = explode(",",$_POST['asistentes']);
    $fecha = $_POST['fecha'];
    $eventoDAO = new EventoDAO();
    $asistenciaDAO = new AsistenciaDAO();






    $idEvento = $eventoDAO->obtenerId($idEncargado,$fecha);


    foreach ($asistentes as $asistente){

        $asistenteInsertado = $asistenciaDAO->insertarAsistencia($idEvento,$asistente);

        if (!$asistenteInsertado) {

            header('Location: ../evento.php?error=02');
            exit;
        }
        
    }
    
    header('Location: ../evento.php?success=true');
    exit;

       

    

} else {
    echo "Método de solicitud no permitido.";
}
?>