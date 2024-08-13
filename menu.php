<?php
require_once 'controller/Database.php';
include 'controller/sesionManager.php';
include 'controller/usuarioDAO.php';
include 'controller/personaDAO.php';

$pdo = Database::getInstance();


verifySesion(false);

$usuarioDAO = new UsuarioDAO();
$personaDAO = new PersonaDAO();


$rol = $usuarioDAO->obtenerRol($_SESSION['idPersona']);
$tipo = $personaDAO->obtenerTipo($_SESSION['idPersona']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">

</head>
<body>

    <script src="assets/js/notification.js"></script>


    <?php
        try {
            $sql = "
                SELECT CONCAT(p.nombre,' ',p.apPaterno,' ',p.apMaterno) as nombre,
                r.idReporte, t.tipo, r.fechaHora, r.comentarios
                FROM reporte r
                JOIN tipoincidente t ON t.idTipoIncidente = r.idTipoIncidente
                JOIN persona p ON p.idPersona = r.idPersona
                WHERE r.estado = 'Nuevo'
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $datosReporte = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }

        
    ?>

    <script>
            <?php

                foreach ($datosReporte as $datosReporte){
                    echo "
                        if ('serviceWorker' in navigator) {
                            navigator.serviceWorker.register('service-worker.js').then(function(registration) {
                                console.log('Service Worker registrado con éxito:', registration);

                                // Verifica si registration está correctamente definido
                                if (registration) {
                                    mostrarNotificacion(registration);
                                } else {
                                    console.error('Service Worker registration fallido');
                                }

                            }).catch(function(error) {
                                console.error('Error al registrar el Service Worker:', error);
                            });
                        } else {
                            console.warn('Service Worker no soportado en este navegador.');
                        }
                    
                    ";

                }
            ?>

    </script>


    <div class="container  centered">
        

        <div class="card" >
            <div class="navbar">
                <a href='index.php?exit=true' style="float: right;">Cerrar Sesion</a>
            </div>


            <a href='perfil.php'>
                <div class='inner-card' style='background-color: #e7c8f2; color: #8f12d8;'>
                    <img src='assets/imgs/usuariofoto.png' alt='' class='icon'>
                    <p>Perfil</p>
                </div>
            </a>

            <a href='emergencia.php'>
                <div class='inner-card' style='background-color: #fb7a68; color: #a30404;'>
                    <img src='assets/imgs/salud.png' alt='' class='icon'>
                    <p>Emergencias</p>
                </div>
            </a>
            <a href='datos.php'>
                <div class='inner-card' style='background-color: #64a2ff; color: #0172cf;'>
                    <img src='assets/imgs/seguridad.png' alt='' class='icon'>
                    <p>Datos Personales</p>
                </div>
            </a>
            <a href='expediente.php'>
                <div class='inner-card' style='background-color: #ffa217; color: #895403;'>
                    <img src='assets/imgs/Datossalud.png' alt='' class='icon'>
                    <p>Expediente</p>
                </div>
            </a>
            <a href='estadistica.php'>
                <div class='inner-card' style='background-color: #f2e255; color: #8a902b;'>
                    <img src='assets/imgs/Documentos.png' alt='' class='icon'>
                    <p>Reportes</p>
                </div>
            </a>
            <a href='compañeros.php'>
                <div class='inner-card' style='background-color: #9afe81; color: #1c7f03;'>
                    <img src='assets/imgs/icono1.png' alt='' class='icon'>
                    <p>QR.Compañeros</p>
                </div>
            </a>
            <?php
            if ($tipo === 'Maestro' || $rol === "Administrador" ) {
                echo "
                    <a href='evento.php'>
                        <div class='inner-card' style='background-color: #f2e255; color: #8a902b;'>
                            <img src='assets/imgs/Documentos.png' alt='' class='icon'>
                            <p>Pase de Asistencia</p>
                        </div>
                    </a>
                    <a href='lista.php'>
                        <div class='inner-card' style='background-color: #9afe81; color: #1c7f03;'>
                            <img src='assets/imgs/Documentos.png' alt='' class='icon'>
                            <p>Reportes Recibidos</p>
                        </div>
                    </a>
                ";
            }

            if ($rol === "Administrador" ) {
                echo "
                    <a href='admQr.php'>
                        <div class='inner-card' style='background-color: #9afe81; color: #1c7f03;'>
                            <img src='assets/imgs/Documentos.png' alt='' class='icon'>
                            <p>Vizualizar QR</p>
                        </div>
                    </a>
                ";
            }
            ?>

            
            




        </div>

    </div>
</body>
</html>
