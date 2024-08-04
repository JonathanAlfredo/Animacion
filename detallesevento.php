<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();

$idEvento = isset($_GET['idEvento']) ? $_GET['idEvento'] : 'Desconocido';
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
            a.entrada, a.salida
            FROM asistencia a
            JOIN persona p ON p.idPersona = a.idPersona
            WHERE a.idEvento = :idEvento
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
                <h1>Detalles de Evento</h1>
            </div>

            <br><p ><?php echo $datosEvento['descripcion'];?></p>

            <br><p >Encargado:  <?php echo $datosEvento['nombre'];?></p>
            <br><p >Fecha: <?php echo $datosEvento['fecha'];?></p>
            <br><h2>Asistentes</h2>
           
            
                <?php
                if ($datosAsistentes) {
                    foreach($datosAsistentes as $asistente);

                    echo "
                        <div class='report-card'>
                            <div class='report-details'>
                                <p><strong>Asistente:</strong> ".$asistente['nombre']."</p>
                                <p><strong>Hora de entrada:</strong> ".$asistente['entrada']."</p>
                                <p><strong>Hora de salida:</strong> ".$asistente['salida']."</p>
                            </div>    
                        </div>
                        ";
                }
                    
                ?>
        </div>
    </div>

</body>
</html>
