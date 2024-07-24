<?php
include 'controller/sesionManager.php';
require_once 'controller/Database.php';

verifySesion(false);
$pdo = Database::getInstance();

$idPersona = isset($_GET['idPersona']) ? $_GET['idPersona'] : 'Desconocido';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Reportes</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body>
<div class="container full-height centered">
        <div class="card" style="text-align: left;">    
            <a href="admQr.php">Regresar</a>
            <div>
                <div id="qr-code"></div>
            </div>
            
        </div>
    </div>
    <script src="assets/js/qrGenerator.js"></script>
    <script>
        generateQRCode("<?php echo $idPersona;?>");
    </script>
</body>

</html>
