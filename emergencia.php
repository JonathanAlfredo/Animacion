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
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
</head>
<body>
    <?php   
        try {
            $idPersona = $_SESSION['idPersona'];
        
            $sql = "
                SELECT e.nss, e.clinica, e.direccion
                FROM Persona p
                JOIN Expediente e ON p.idPersona = e.idPersona
                WHERE p.idPersona = :idPersona
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosEmergencia = $stmt->fetch(PDO::FETCH_ASSOC);
        

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }
    ?>

    <div class="container full-height centered">
        <div class="card" style="text-align: left;">
            <a href="menu.php">Regresar</a>

            <div class="title">
                <h1>Emergencia</h1>
            </div>


            <form action="controller/actualizarDatosE.php" class="form" method="POST">

                <input type="hidden" name="idPersona" inputmode="numeric" pattern="\d*" required readonly value="<?php echo $idPersona; ?>"/>


                <label >Numero de Seguro social:</label>
                <input type="text" name="nss" required value="<?php echo $datosEmergencia['nss'];?>">

                <label >Clinica:</label>
                <input type="text" name="clinica" required value="<?php echo $datosEmergencia['clinica'];?>">

                <label >Direccion:</label>
                <input type="text" name="direccion" required value="<?php echo $datosEmergencia['direccion'];?>">

                <p >Numero Ambulancia:<p><br>

                <p >Numero de seguridad(policia):</p><br>

                <button type="submit" class="btn-primary">Actualizar Datos</button>

                <a href="juridico.html" class="link"> Indicaciones a juridico </a>
                <a href="" class="link" style="color:rgb(181, 10, 44);">Llamadas de emergencia </a>



                    
            </form>
        </div>
    </div>
</body>
</html>
