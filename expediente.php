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
                SELECT e.fechaNacimiento, e.idEstadoCivil, e.tipoSangre, e.condMedicas
                FROM persona p
                JOIN expediente e ON p.idPersona = e.idPersona
                WHERE p.idPersona = :idPersona
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosExpediente = $stmt->fetch(PDO::FETCH_ASSOC);
        

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }

    ?>

    <div class="container full-height centered">
        <div class="card" style="text-align: left;">
            
            <a href="menu.php">Regresar</a>

            <div class="title">
                <h1>Expediente</h1>
            </div> 

            <form action="controller/actualizarDatosExpediente.php" class="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idPersona" inputmode="numeric" pattern="\d*" required readonly value="<?php echo $idPersona; ?>"/>

                <label >Fecha de Nacimiento:</label>
                <input type="date" name="fechaNacimiento" required value="<?php echo $datosExpediente['fechaNacimiento'];?>">

                <label >Estado Civil:</label>
                <?php
                    echo "
                    <select name='idEstadoCivil' required>
                    <option value='' ". ($datosExpediente['idEstadoCivil'] == '' ? 'selected' : '') .">Seleccionar</option>
                    ";
                    try {
                    $stmt = $pdo->query('SELECT * FROM estadocivil');
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "<option value='" . $row['idEstadoCivil'] . "' ". ($datosExpediente['idEstadoCivil'] == $row['idEstadoCivil'] ? 'selected' : '') .">" . $row["estado"] . "</option>";
                    }
                    } catch (PDOException $e) {
                    echo 'Query failed: ' . $e->getMessage();
                    }
                    echo "</select>";
                ?>

                <label >Tipo de Sangre:</label>
                <input type="text" name="tipoSangre" required value="<?php echo $datosExpediente['tipoSangre'];?>">

                <label >¿Padece alguna condicion medica? (especifique)</label>
                <textarea name="condMedicas" rows="10" cols="50" required > <?php echo $datosExpediente['condMedicas'];?> </textarea><br>


                <button type="submit" class="btn-primary">Actualizar Datos</button>
                    
            </form>
        </div>
    </div>
</body>
</html>
