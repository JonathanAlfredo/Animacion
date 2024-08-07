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
    <title>Perfil</title>
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

    ?>

    

    <div class="container  centered">
        <div class="card" style="text-align: left;">
            
            
         

            <div class="navbar">
                <a href="menu.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>
            
            <div class="title">
                <h1>Perfil</h1>
            </div> 
            <div class="profile-foto-container">
                <img src="<?php echo ($datosPersona['imagen'] == '' ? 'assets/imgs/usuariofoto.png' : $datosPersona['imagen'] );?>" alt="Foto de Perfil" class="profile-foto">
            </div>

            <br><p >Nombre(s): <?php echo $datosPersona['nombre'];?></p>
            <br><p >Apellido Paterno: <?php echo $datosPersona['apPaterno'];?></p>
            <br><p >Matricula: <?php echo $idPersona; ?> </p>
            <br><p >Apellido Materno: <?php echo $datosPersona['apMaterno'];?></p>
            <br><p >Sexo: <?php echo ($datosPersona['sexo'] == 'M' ? 'Masculino' : 'Femenino');?></p>
            <br><p >Numero Celular: <?php echo $datosPersona['telefono'];?></p>
            <br><p >Correo: <?php echo $datosPersona['correo'];?></p>
            <br>

            <form action="controller/actualizarFoto.php" class="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idPersona" inputmode="numeric" pattern="\d*" required readonly value="<?php echo $idPersona; ?>"/>

                <p >Cambiar Foto:</p>
                <input type="file" id="imagen" name="imagen" accept="image/*" src="<?php echo $datosPersona['imagen'];?>" required>
                <button type="submit" class="btn-primary">Actualizar Foto</button>
                    
            </form>

        </div>
    </div>
</body>
</html>
