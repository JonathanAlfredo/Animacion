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
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos adicionales */
        #asistentesList {
            margin-top: 20px;
        }
        #asistentesList li {
            list-style-type: none;
            padding: 5px;
            border-bottom: 1px solid #ccc;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container centered">
        <div class="card">
            <a href="menu.php">Regresar</a>
            <div class="title">
                <h1>Nuevo Evento</h1>
            </div>
            <form action="controller/registrarEvento.php" class="form" method="POST" id="eventoForm">
                <input type="hidden" name="idEncargado" required value="<?php echo $idPersona; ?>"/>
                <label>Fecha:</label>
                <input type="date" name="fecha" required>
                <label>Descripcion:</label>
                <textarea name="descripcion" rows="10" cols="50" required></textarea>
                <br>
                <div id="qr-reader" style="max-width:500px;"></div>
                <br>
                <div id="asistentesContainer">
                    <h2>Asistentes:</h2>
                    <input type="hidden" id="asistentes" name="asistentes" value="">
                    <ul id="asistentesList"></ul>
                </div>
                <div class="error" id="error"></div>
                <button type='submit' class='btn-primary'>Registrar Evento</button>
            </form>
        </div>
    </div>
    <script>
        function docReady(fn) {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function () {
            var lastResult, countResults = 0;
            var asistentes = [];
            var asistentesInput = document.getElementById('asistentes');
            var asistentesList = document.getElementById('asistentesList');
            var errorDiv = document.getElementById('error');
            var eventoForm = document.getElementById('eventoForm');

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    asistentes.push(decodedText);
                    asistentesInput.value = asistentes.join(',');

                    $.ajax({
                        url: 'controller/obtenerNombrePersona.php',
                        type: 'POST',
                        data: { matricula: decodedText },
                        success: function(response) {
                            var result = JSON.parse(response);
                            var li = document.createElement('li');
                            li.textContent = result.nombre;
                            asistentesList.appendChild(li);
                        },
                        error: function() {
                            var li = document.createElement('li');
                            li.textContent = 'Error al obtener el nombre';
                            asistentesList.appendChild(li);
                        }
                    });

                    console.log(`Scan result ${decodedText}`, decodedResult);
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);

            eventoForm.addEventListener('submit', function(event) {
                if (asistentes.length === 0) {
                    event.preventDefault();
                    errorDiv.textContent = 'La lista de asistentes no puede estar vacía.';
                }
            });
        });
    </script>
</body>
</html>
