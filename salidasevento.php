<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();

$idEvento = isset($_GET['idEvento']) ? $_GET['idEvento'] : 'Desconocido';
$idPersona = $_SESSION['idPersona'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    
</head>
<body>
    <?php

        try {
        
            $sql = " 
            SELECT e.descripcion, e.fecha, CONCAT(p.nombre,' ',p.apPaterno,' ',p.apMaterno) as nombre
            FROM evento e
            JOIN persona p ON p.idPersona = e.idEncargado
            WHERE e.idEvento = :idEvento
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosEvento = $stmt->fetch(PDO::FETCH_ASSOC);
        

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }

        try {
        
            $sql = " 
            SELECT CONCAT(p.nombre,' ',p.apPaterno,' ',p.apMaterno) as nombre,
            p.idPersona
            FROM asistencia a
            JOIN persona p ON p.idPersona = a.idPersona
            WHERE a.idEvento = :idEvento
            AND a.salida IS NULL
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosAsistentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }


        
    ?>

    <div class="container centered">
        <div class="card" style="text-align: left;">  
            
        
            <div class="navbar">
                <a href="evento.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>

            <div class="title">
                <h1>Registrar salidas</h1>
            </div>

            <br><p ><?php echo $datosEvento['descripcion'];?></p>

        

            <?php
                if (!empty($datosAsistentes)) {
                    foreach ($datosAsistentes as $row) {
                        echo "
                        <div class='report-card'>
                            <div class='report-details'>
                                <p>".$row['nombre']."</p>
                            </div>

                            <form action='controller/registrarSalidas.php' class='form' method='POST'>
                                <input type='hidden' name='idEvento' value='".$idEvento."'>
                                <input type='hidden' name='idPersona' value='".$row['idPersona']."'>

                                <button type='submit' class='btn-primary'>Marcar salida</button>
                            </form>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='report-card'>
                        <p>No se requiere registrar ninguna salida</p>
                    </div>
                    ";
                }
            ?>
            
                
        </div>
    </div>

    

</body>
</html>
