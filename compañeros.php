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
    <title>Compañeros</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body>
    <div class="container full-height centered">
        <div class="card" style="text-align: left;">  
            
        
            <a href="menu.php">Regresar</a>
            
            <div class="title">
                <h1>Compañeros</h1>
            </div>

            <div>
                <div id="qr-reader" style="max-width:500px;"></div>
            </div>

            

        
        </div>
    </div>

    <script src="assets/js/qrScanner.js"></script>
</body>
</html>
