<?php
include 'reporteDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPersona = $_POST['idPersona'];
    $idReportante = $_POST['idReportante'];
    $ubicacion = $_POST['ubicacion'];
    $comentarios = $_POST['comentarios'];
    $idTipoIncidente = $_POST['idTipoIncidente'];

    $reporteDAO = new ReporteDAO();

    $reporteInsertado = $reporteDAO->insertarReporte($idPersona,$idReportante,$comentarios,$ubicacion,$idTipoIncidente);

    if ($reporteInsertado) {
        header('Location: ../compañeros.php?error=false');
    } else {
        echo $reporteInsertado;
        header('Location: ../compañeros.php?error=02'); //Error interno
    }


} else {
    echo "Método de solicitud no permitido.";
}
?>