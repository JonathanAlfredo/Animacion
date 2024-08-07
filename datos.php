<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();


$error = isset($_GET['error']) ? $_GET['error'] : 'Desconocido';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<script>

var error = <?php echo json_encode($error); ?>;

</script>

<script src="assets/js/messages.js"></script>

    <?php
        try {
            $idPersona = $_SESSION['idPersona'];
        
            $sql = "
                SELECT p.nombre, p.apPaterno, p.apMaterno, p.sexo, e.idCarrera, p.telefono, p.correo, u.imagen
                FROM persona p
                JOIN expediente e ON p.idPersona = e.idPersona
                JOIN usuario u ON p.idPersona = u.idPersona
                WHERE p.idPersona = :idPersona
            ";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosPersona = $stmt->fetch(PDO::FETCH_ASSOC);
        

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }

        try {        
            $sql = "SELECT e.idTutor, t.nombre as nombreT, t.apPaterno as apPaternoT, t.apMaterno as apMaternoT, t.telefono as telefonoT\n"
                . "FROM persona p \n"
                . "JOIN expediente e ON p.idPersona = e.idPersona\n"
                . "JOIN persona t ON e.idTutor = t.idPersona\n"
                . "WHERE p.idPersona =:idPersona";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idPersona', $idPersona, PDO::PARAM_INT);
            $stmt->execute();
        
            $datosTutor = $stmt->fetch(PDO::FETCH_ASSOC);
    

        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }
    ?>

    <div class="container centered">
        <div class="card" style="text-align: left;">
            
            <div class="navbar">
                <a href="menu.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>

            <div class="title">
                <h1>Datos Personales</h1>
            </div> 

            <form action="controller/actualizarDatos.php" class="form" method="POST" enctype="multipart/form-data">
                <label >Matricula:</label>
                <input type="text" name="idPersona" inputmode="numeric" pattern="\d*" required readonly value="<?php echo $idPersona; ?>"/>

                <label >Nombre(s):</label>
                <input type="text" name="nombre" required value="<?php echo $datosPersona['nombre'];?>"  maxlength="50" >

                <label >Apellido Paterno:</label>
                <input type="text" name="apPaterno" required value="<?php echo $datosPersona['apPaterno'];?>" maxlength="50">

                <label >Apellido Materno:</label>
                <input type="text" name="apMaterno" required value="<?php echo $datosPersona['apMaterno'];?>" maxlength="50">

                <label >Sexo:</label>
                
                <?php
                echo "
                    <select name='sexo' required>
                    <option value='' ". ($datosPersona['sexo'] == '' ? 'selected' : '') .">Seleccionar</option>
                    <option value='M' ". ($datosPersona['sexo'] == 'M' ? 'selected' : '') .">Masculino</option>
                    <option value='F' ". ($datosPersona['sexo'] == 'F' ? 'selected' : '') .">Femenino</option>
                    </select>
                    ";
                ?>

                <label >Carrera:</label>
                <?php
                    echo "
                    <select name='idCarrera' required>
                    <option value='' ". ($datosPersona['idCarrera'] == '' ? 'selected' : '') .">Seleccionar</option>
                    ";
                    try {
                    $stmt = $pdo->query('SELECT * FROM carrera');
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "<option value='" . $row['idCarrera'] . "' ". ($datosPersona['idCarrera'] == $row['idCarrera'] ? 'selected' : '') .">" . $row["nombre"] . "</option>";
                    }
                    } catch (PDOException $e) {
                    echo 'Query failed: ' . $e->getMessage();
                    }
                    echo "</select>";
                ?>
                

                <label >Numero Celular:</label required>
                <input type="text" name="telefono" inputmode="numeric" pattern="\d*" value="<?php echo $datosPersona['telefono'];?>" maxlength="10">

                <label >Correo:</label>
                <input type="email" name="correo" required value="<?php echo $datosPersona['correo'];?>" maxlength="50">

                <input type="hidden" name="idTutor" required value="<?php echo $datosTutor['idTutor'];?>"> 

                <label >Nombre(s) del Tutor:</label>
                <input type="text" name="nombreT" required value="<?php echo $datosTutor['nombreT'];?>" maxlength="50">

                <label >Apellido Paterno del Tutor:</label>
                <input type="text" name="apPaternoT" required value="<?php echo $datosTutor['apPaternoT'];?>" maxlength="50">

                <label >Apellido Materno del Tutor:</label>
                <input type="text" name="apMaternoT" required value="<?php echo $datosTutor['apMaternoT'];?>" maxlength="50">

                <label >Numero Celular del Tutor:</label>
                <input type="text" name="telefonoT" inputmode="numeric" pattern="\d*" required value="<?php echo $datosTutor['telefonoT'];?>" maxlength="10">


                <button type="submit" class="btn-primary">Actualizar Datos</button>
                    
            </form>
        </div>
    </div>
</body>
</html>
