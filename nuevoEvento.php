<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();

$idPersona = $_SESSION['idPersona'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Evento</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">

    
</head>
<body>
    <div class="container centered">
        <div class="card">
            <div class="navbar">
                <a href="evento.php">Regresar</a>
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>            <div class="title">
                <h1>Nuevo Evento</h1>
            </div>
            <form action="controller/registrarEvento.php" class="form" method="POST" id="eventoForm">
                <input type="hidden" name="idEncargado" required value="<?php echo $idPersona; ?>"/>
                <label>Fecha:</label>
                <input type="date" name="fecha" required>
                <label>Descripcion:</label>
                <textarea name="descripcion" rows="10" cols="50" required maxlength="99"></textarea>
                <br>
                <button type='submit' class='btn-primary'>Registrar Evento</button>
            </form>
        </div>
    </div>
   
</body>
</html>
