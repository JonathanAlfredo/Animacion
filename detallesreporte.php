<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();

$idReporte = isset($_GET['idReporte']) ? $_GET['idReporte'] : 'Desconocido';

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
    <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>

</head>
<body>
    <?php

        try {
            $idReportante = $_SESSION['idPersona'];
        
            $sql = " 
            SELECT CONCAT(p.nombre,' ',p.apPaterno,' ',p.apMaterno) as nombre,
            CONCAT(t.nombre,' ',t.apPaterno,' ',t.apMaterno) as nombreTutor,
            CONCAT(re.nombre,' ',re.apPaterno,' ',re.apMaterno) as nombreReportante,
            t.telefono as telefonoTutor,
            r.fechaHora,
            r.ubicacion,
            r.comentarios,
            ti.tipo,
            u.imagen
            FROM reporte r
            JOIN persona p ON p.idPersona = r.idPersona
            JOIN expediente e ON p.idPersona = e.idPersona
            JOIN persona t ON t.idPersona = e.idTutor
            JOIN persona re ON re.idPersona = r.idReportante
            JOIN tipoincidente ti ON ti.idTipoIncidente = r.idTipoIncidente
            JOIN usuario u ON u.idPersona = r.idPersona
            WHERE r.idReporte = :idReporte
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idReporte', $idReporte, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosReporte = $stmt->fetch(PDO::FETCH_ASSOC);
        

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }

    ?>

    <div class="container centered">
        <div class="card" style="text-align: left;">  
            
        
            <a href="lista.php">Regresar</a>
            <div class="title">
                <h1>Detalles de Reporte</h1>
            </div>

            <img src="<?php echo ($datosReporte['imagen'] == '' ? 'assets/imgs/usuariofoto.png' : $datosReporte['imagen'] );?>" alt="Foto de Perfil" class="profile-foto">


            <br><p >Nombre: <?php echo $datosReporte['nombre'];?></p>
            <br><p >Tutor: <?php echo $datosReporte['nombreTutor'];?></p>
            <br><p >Telefono del tutor: <?php echo $datosReporte['telefonoTutor'];?></p>
            <br><p >Fecha del incidente: <?php echo $datosReporte['fechaHora'];?></p>
            <br><p >Detalles: <?php echo $datosReporte['comentarios'];?></p>
            <br><p >Incidente: <?php echo $datosReporte['tipo'];?></p>
            <br><p>Ubicacion: <?php echo $datosReporte['ubicacion'];?></p>
            <div id="map"></div>

            <br><p >Persona que reportó: <?php echo $datosReporte['nombreReportante'];?></p>

            <br>

            <form action="" class="form" id="reporte" method="POST">
            
                <input type="hidden" name="idReporte" value="<?php echo $idReporte; ?>" >

                <button type="submit" class="btn-primary">Marcar como Atendido</button> 


            </form>

            
            <script>
                var map;
                var ubi = "<?php echo $datosReporte['ubicacion']; ?>".split(",");

                function initMap() {
                    var lat = parseFloat(ubi[0]);
                    var lng = parseFloat(ubi[1]);
                    var location = {lat: lat, lng: lng};

                    map = new google.maps.Map(document.getElementById('map'), {
                        center: location,
                        zoom: 15
                    });

                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }
            </script>

        </div>
    </div>

</body>
</html>
