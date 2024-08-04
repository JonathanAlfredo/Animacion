<?php
include 'eventoDAO.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idEncargado = $_POST['idEncargado'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    $eventoDAO = new EventoDAO();





    $eventoInsertado = $eventoDAO->insertarEvento($idEncargado,$descripcion,$fecha);

    if ($eventoInsertado) {
        
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