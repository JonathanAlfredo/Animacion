<?php
require_once 'controller/Database.php';

$pdo = Database::getInstance();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/layout.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <title>Registrar Usuario</title>
  </head>
  <body>



    <div class="container full-height centered">
      <div class="card">
        <form action="controller/registrarUsuario.php" method="POST" class="form">
          <h2>Crea tu cuenta</h2>

            <input type="text" name="idPersona" inputmode="numeric" pattern="\d*" placeholder="Matricula" required  maxlength="11"/>

            <input type="email" name="correo" placeholder="Correo" required maxlength="50"/>

            <input type="password" name="pass" placeholder="Contraseña" required maxlength="100"/>

            <input type="password" name="pass1" placeholder="Confirmar Contraseña" required maxlength="100"/>

            <select name="idTipoPersona"  required>
              <option value='1'> Alumno </option>
              <option value='2'> Maestro </option>
            </select>

            <button type="submit" class="btn-primary">Crear Cuenta</button>
            <a href="index.php" class="link">Iniciar Sesión</a>

        </form>

      </div>
    </div>




  </body>
</html>
