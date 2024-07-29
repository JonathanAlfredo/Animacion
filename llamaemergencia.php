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
    <title>llamaemergente</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/layout.css">
    <link rel="stylesheet" href="assets/css/components.css">
</head>
<body>
    <div class="container full-height centered">
        <div class="card" style="text-align: left;">
            
            

        <a href="emergencia.php"><h1>Regresar</h1></a>
        <?php
// Asegúrate de que la clase Database esté definida como en el código proporcionado

// Obtener la instancia de PDO
$pdo = Database::getInstance();

// Ejecutar una consulta a la tabla clinica
$query = $pdo->query('SELECT * FROM clinicaa');

// Recuperar los resultados de la consulta
$results = $query->fetchAll(PDO::FETCH_ASSOC);

// Mostrar los resultados en una tabla con estilos
echo '<style>

        table {
            max-width: 1200px;
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            color:white;
        }

        td {
            padding: 10px;
            border: 2px solid #000;
        }
        .centered {
        display: flex;

        align-items: center;
        height: 100%;
        }
        .table-container {
            width: 20%;
            max-width: 1200px;
            margin: 0 auto;
            
        }
            


    </style>';

echo '<div class="container  centered">';
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Detalles de la Unidad</th>';
echo '</tr>';

foreach ($results as $row) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>';
    echo 'Nombre: ' . $row['nombre_unidad'] . '<br>';
    echo 'Tipo: ' . $row['tipo_unidad'] . '<br>';
    echo 'Dirección: ' . $row['direccion'] . '<br>';
    echo 'Teléfono: ' . $row['telefono'] . '<br>';
    echo 'Horario: ' . $row['horario'];
    echo '</td>';
    echo '</tr>';
}

echo '</table>';

echo '</div>';
?>









            </form>
        </div>
    </div>
</body>
</html>
