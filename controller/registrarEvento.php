<?php
include 'eventoDAO.php';
include 'asistenciaDAO.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idEncargado = $_POST['idEncargado'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $asistentes = explode(",",$_POST['asistentes']);

    $eventoDAO = new EventoDAO();
    $asistenciaDAO = new AsistenciaDAO();





    $eventoInsertado = $eventoDAO->insertarEvento($idEncargado,$descripcion,$fecha);

    if ($eventoInsertado) {
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
        echo $eventoInsertada;
        header('Location: ../evento.php?error=03');
    }

} else {
    echo "Método de solicitud no permitido.";
}
?>