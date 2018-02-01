<?php
  session_start();
  if (isset($_SESSION["user"])) {
  } else {
    session_destroy();
    header("Location: ../login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  </head>
  <body>
    <div class='container'>
      <?php include("../includes/menu.php") ?>
      <hr>

<?php



  $connection = new mysqli("192.168.1.159", "root", "Admin2015","web", 3316);


  if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
  }


  $consulta="select * from usuarios u join reservas r on u.id_usuario=r.id_usuario join pistas p on r.id_pista=p.id_pista where
  u.correo='".$_SESSION["user"]."' order by r.fecha asc;";



  if ($result = $connection->query($consulta)) {
      echo "<h2>Reservas</h2>";

      if ($result->num_rows===0) {
        echo "<p>No ha realizado reservas</p>";
        echo $consulta;
      } else {
        echo "<ul>";
        while ($obj=$result->fetch_object()) {
          echo "<li>Tienes reservada la ".$obj->nombre." para el día ".$obj->fecha." y la hora es a las ".$obj->hora_inicio.".</li>";
          }
        echo "</ul>";
      }
  }
?>
<form method="post">
  <h2>Realizar reserva</h2>
  <div class="form-group">
    <label >Pista</label>
    <select class="form-control" name="id" required>
      <?php

      $consulta="select * from pistas;";

      if ($result = $connection->query($consulta)) {

          while ($obj=$result->fetch_object()) {
            echo "<option value='".$obj->id_pista."'>".$obj->nombre."</option>";
            }
      }

      ?>
    </select>
  </div>
  <div class="form-group">
    <label>Fecha</label>
    <input name="fecha" type="date" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Hora</label>
    <input name="tiempo" type="time" class="form-control" required>
  </div>
  <button type="submit" class="mb-3 btn btn-primary offset-md-9">Reservar</button>
</form>
<?php if (isset($_POST["fecha"])): ?>

<?php

$usu="select id_usuario from usuarios where correo='".$_SESSION['user']."'";
if ($result = $connection->query($usu)) {

    while ($obj=$result->fetch_object()) {
      $usuario=$obj->id_usuario;
      $consulta="INSERT INTO reservas (fecha,hora_inicio,id_usuario,id_pista) VALUES ('".$_POST['fecha']."','".$_POST['tiempo']."','$usuario','".$_POST['id']."');";

      if ($connection->query($consulta)) {
        echo "<p>Reserva realizada</p>";
      } else {
        echo "$consulta";
      }
    }
}


?>
<?php endif; ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
