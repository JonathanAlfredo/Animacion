<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Reportes</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">


</head>
<body>
    <?php
        try {
            $sql = "
                SELECT CONCAT(p.nombre,' ',p.apPaterno,' ',p.apMaterno) as nombre,
                r.idReporte, t.tipo, r.fechaHora, r.comentarios
                FROM reporte r
                JOIN tipoincidente t ON t.idTipoIncidente = r.idTipoIncidente
                JOIN persona p ON p.idPersona = r.idPersona
                WHERE r.estado = 'Nuevo'
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $datosReporte = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }
    ?>

    <div class="container full-height centered">
        <div class="card" style="text-align: left;">

            <div class="navbar">
                <a href="menu.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>
            
            <div class="title">
                <h1>Lista de Reportes Nuevos</h1>
            </div>

            
            <?php
                if (!empty($datosReporte)) {
                    foreach ($datosReporte as $row) {
                        echo "
                        <div class='report-card'>
                            <div class='report-details'>
                                <p><strong>Tipo:</strong> ".$row['tipo']."</p>
                                <p><strong>Fecha:</strong> ".$row['fechaHora']."</p>
                                <p><strong>Alumno:</strong> ".$row['nombre']."</p>
                                <p><strong>Descripción:</strong> ".substr($row['comentarios'], 0, 50)."...</p>
                            </div>
                            <form action='detallesreporte.php' class='form' >
                                <input type='hidden' name='idReporte' value='".$row['idReporte']."'>
                                <button type='submit' class='btn-primary'>Detalles</button>
                            </form>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='report-card'>
                        <p>No hay reportes nuevos por el momento</p>
                    </div>
                    ";
                }
            ?>
                
        </div>
    </div>
</body>

</html>
