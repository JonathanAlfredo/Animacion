<?php
include 'controller/sesionManager.php';

verifySesion(false);
$idPersona = $_SESSION['idPersona'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentacion</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
</head>
<body>
    <div class="container full-height centered">
        <div class="card" style="text-align: left;">
                <div class="navbar">
                    <a href="emergencia.php">Regresar</a>
                    <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
                </div>

                <div class="title">
                    <h1>Documentacion</h1>
                </div>

                

                

                
                <form action="controller/guardarConstancia.php" method="POST" enctype="multipart/form-data" class="form">

                    <input type="hidden" name="idPersona" value="<?php echo $idPersona;?>">

                    <label for="">Adjunte a continuacion su constancia de vigencia de derechos:</label><br>
                    <input type="file" name="file" id="file" accept="application/pdf" required>

                    
                    <button type="submit" name="submit" class='btn-primary' >Guardar</button>
                </form>

                
                
                







                



                    
        </div>
    </div>
</body>
</html>
