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
    <title>Reportes</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <style>

    </style>
</head>
<body>
    <?php
        try {

            $idEncargado = $_SESSION['idPersona'];

            $sql = "
                SELECT e.idEvento, e.fecha, e.descripcion
                FROM evento e
                WHERE e.idEncargado = :idEncargado
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idEncargado', $idEncargado);
            $stmt->execute();
            $datosEvento = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }
    ?>


    

    <div class="container  centered">
        <div class="card" >
            
            <div class="navbar">
                <a href="menu.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>

            <div class="title">
                <h1>Eventos</h1>
            </div>
            
            <a href='nuevoEvento.php'>
                <div class='inner-card' style='background-color: #cfd8dc; color: #1f1f1f; text-align:center; display: block;'>
                    <p>Registrar nuevo evento</p>
                </div>
            </a>


            <?php
                if (!empty($datosEvento)) {
                    foreach ($datosEvento as $row) {
                        echo "
                        <div class='report-card'>
                            <div class='report-details'>
                                <p><strong>Fecha:</strong> ".$row['fecha']."</p>
                                <p><strong>Descripción:</strong> ".substr($row['descripcion'], 0, 50)."...</p>
                            </div>
                            <form action='detallesevento.php' class='form' >
                                <input type='hidden' name='idEvento' value='".$row['idEvento']."'>
                                <button type='submit' class='btn-primary'>Detalles</button>
                            </form>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='report-card'>
                        <p>No se encontraron eventos</p>
                    </div>
                    ";
                }
            ?>


            

            

            
            

        </div>
    </div>
</body>
</html>
