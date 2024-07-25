<?php
require_once 'controller/Database.php';

$pdo = Database::getInstance();

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
    <script src="assets/js/documentacion.js"></script>
</head>
<body>
    <div class="container full-height centered">
        <div class="card" style="text-align: left;">
            <a href="datos.php">Regresar</a>


            <form action="" class="form" method="POST">

                <div class="title">
                    <h1>Documentacion</h1>
                </div>


                <form id="pdf" enctype="multipart/form-data">
                    <input type="file" id="pdfs" name="file" accept="application/pdf" required>
                    <button type="submit">sube</button>
                </form>
                <ul id="mostrar"><li></li></ul>
                <div class="inner-card">
                    <img src="assets/imgs/pdf.png"class="icon-sm"  >
                    <a href="assets/files/Constancia-de-vigencia-de-derechos-PASOS.pdf" >Constancia-de-vigencia-de-derechos-PASOS</a>
                </div>
                







                



                    
            </form>
        </div>
    </div>
</body>
</html>
