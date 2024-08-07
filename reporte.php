<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();

$idPersona = isset($_GET['person']) ? $_GET['person'] : 'Desconocido';

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
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="assets/js/location.js"></script>
</head>
<body>
    <?php

        try {
            $idReportante = $_SESSION['idPersona'];
        
            $sql = " 
            SELECT CONCAT(p.nombre,' ',p.apPaterno,' ',p.apMaterno) as nombre,
            e.nss, e.clinica, e.direccion, p.sexo, u.imagen
            FROM persona p
            JOIN expediente e ON e.idPersona = p.idPersona
            JOIN usuario u ON u.idPersona = p.idPersona
            WHERE p.idPersona = :idPersona;
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosPersona = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$datosPersona) {
                header('Location: compañeros.php?error=notvalid'); //usuario o contraseña incorrecto
            }
        

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }

    ?>

    <div class="container centered">
        <div class="card" style="text-align: left;">  
            
        
            <div class="navbar">
                <a href="compañeros.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>           
            
            <div class="title">
                <h1>Realizar reporte</h1>
            </div>
            <img src="<?php echo ($datosPersona['imagen'] == '' ? 'assets/imgs/usuariofoto.png' : $datosPersona['imagen'] );?>" alt="Foto de Perfil" class="profile-foto">


            <br><p >Nombre: <?php echo $datosPersona['nombre'];?></p>
            <br><p >Numero de Seguro Social: <?php echo $datosPersona['nss'];?> </p>
            <br><p >Clinica: <?php echo $datosPersona['clinica'];?></p>
            <br><p >Direccion: <?php echo $datosPersona['direccion'];?></p>
            <br>

            <form action="controller/reportarIncidente.php" class="form" id="reporte" method="POST">
            
                <input type="hidden" name="idPersona" value="<?php echo $idPersona; ?>" >
                <input type="hidden" name="idReportante" value="<?php echo $idReportante; ?>" >
                <input type="hidden" name="ubicacion" id="location" >

                <label>Comentarios:</label>
                <textarea name="comentarios" rows="10" cols="50" maxlength="240"></textarea>

                <label >Tipo Incidente:</label>
                <?php
                    echo "
                    <select name='idTipoIncidente' required>
                    <option value='' selected >Seleccionar</option>
                    ";
                    try {
                    $stmt = $pdo->query('SELECT * FROM tipoincidente');
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "<option value='" . $row['idTipoIncidente'] . "'>" . $row["tipo"] . "</option>";
                    }
                    } catch (PDOException $e) {
                    echo 'Query failed: ' . $e->getMessage();
                    }
                    echo "</select>";
                ?>

                <button type="submit" class="btn-primary">Reportar incidente</button> 


            </form>

            
        <script>
            
        </script>

        </div>
    </div>

    <script src="assets/js/qrScanner.js"></script>
</body>
</html>
