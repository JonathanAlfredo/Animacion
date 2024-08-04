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
        
            $sql = "
                SELECT ti.tipo as tipo, COUNT(r.idReporte) as numero
                FROM tipoincidente ti
                LEFT JOIN reporte r ON r.idTipoIncidente = ti.idTipoIncidente
                GROUP BY ti.tipo
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        
            $datosReporte = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }


        
    ?>

    

    <div class="container full-height centered">
        <div class="card" >
            
            <div class="navbar">
                <a href="menu.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>

            <div class="title">
                <h1>Incidentes</h1>
            </div> 
            

            

            <?php
                if (!empty($datosReporte)) {
                    foreach ($datosReporte as $row) {
                        echo "

                        <div class='cont'>
                            <span class='category'>".$row['tipo']."</span>
                            <div class='circle'>".$row['numero']."</div>
                        </div>
                       
                        
                        
                        ";
                    }
                } 
            ?>
            

        </div>
    </div>
</body>
</html>
