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
                p.idPersona,
                u.imagen
                FROM persona p
                JOIN usuario u ON u.idPersona = p.idPersona
                AND idTipoPersona = 1
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $datosPersona = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <h1>Codigos QR</h1>
            </div>

            <?php
                if (!empty($datosPersona)) {
                    foreach ($datosPersona as $row) {
                        echo "
                        <div class='report-card'>
                            <div class='report-details'>
                                <p><strong>Matricula:</strong> ".$row['idPersona']."</p>
                                <p><strong>Alumno:</strong> ".$row['nombre']."</p>
                            </div>
                            <form action='generarQr.php' class='form' >
                                <input type='hidden' name='idPersona' value='".$row['idPersona']."'>
                                <button type='submit' class='btn-primary'>Codigo QR</button>
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
