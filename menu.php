<?php
include 'controller/sesionManager.php';

verifySesion(false);
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
    <div class="container full-height centered">

        <div class="card" >
            <a href="perfil.php">
                <div class="inner-card" style="background-color: #e7c8f2; color: #8f12d8;">
                    <img src="assets/imgs/usuariofoto.png" alt="" class="icon">
                    <p>Perfil</p>
                </div>
            </a>

            <a href="emergencia.php">
                <div class="inner-card" style="background-color: #fb7a68; color: #a30404;">
                    <img src="assets/imgs/salud.png" alt="" class="icon">
                    <p>Emergencias</p>
                </div>
            </a>
            <a href="datos.php">
                <div class="inner-card" style="background-color: #64a2ff; color: #0172cf;">
                    <img src="assets/imgs/seguridad.png" alt="" class="icon">
                    <p>Datos Personales</p>
                </div>
            </a>
            <a href="">
                <div class="inner-card" style="background-color: #ffa217; color: #895403;">
                    <img src="assets/imgs/Datossalud.png" alt="" class="icon">
                    <p>Expediente</p>
                </div>
            </a>
            <a href="">
                <div class="inner-card" style="background-color: #f2e255; color: #8a902b;">
                    <img src="assets/imgs/Documentos.png" alt="" class="icon">
                    <p>Reportes</p>
                </div>
            </a>
            <a href="">
                <div class="inner-card" style="background-color: #9afe81; color: #1c7f03;">
                    <img src="assets/imgs/icono1.png" alt="" class="icon">
                    <p>QR.Compañeros</p>
                </div>
            </a>
            <a href="index.php?exit=true">Cerra Sesion</a>


        </div>

    </div>
</body>
</html>
