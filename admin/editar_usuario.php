<?php
  session_start();
  if ( isset($_SESSION["user"])) {
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
      <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin' ) {
                include("../includes/menuadmin.php");
              } else{
                include("../includes/menu.php");
            }

      ?>
      <hr>
      <?php

        if (empty($_GET)) {
          echo "No se han recibido datos del usuario";
          exit();
        }


      ?>

      <?php if (!isset($_POST["correo"])) : ?>

      <?php

        include("../includes/conexion.php");

        $query="SELECT * from usuarios where id_usuario='".$_GET["u"]."'";

        if ($result = $connection->query($query))  {

          $obj = $result->fetch_object();

          if ($result->num_rows==0) {
            echo "No existe el usuario";
            exit();
          }

          $codigo = $obj->id_usuario;
          $nom = $obj->nombre;
          $ap = $obj->apellidos;
          $tlf = $obj->telefono;
          $co = $obj->correo;

        } else {
          echo "No se han recuperado los datos del usuario";
          exit();
        }

      ?>
      <form>
        <div class="form-group">
          <label for="formGroupExampleInput">Nombre</label>
          <input type="text" class="form-control" id="formGroupExampleInput" value='<?php echo $nom; ?>' required>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Apellidos</label>
          <input type="text" class="form-control" id="formGroupExampleInput2" value='<?php echo $ap; ?>' required>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Telefono</label>
          <input type="text" class="form-control" id="formGroupExampleInput" value='<?php echo $num; ?>' required>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Correo</label>
          <input type="text" class="form-control" id="formGroupExampleInput" value='<?php echo $co; ?>' required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
      <form method="post">
        <fieldset>
          <legend>Información de la reserva</legend>
          <span>Fecha:</span><input value='<?php echo $fecha; ?>' type="date" name="fecha" required><br>
          <span>Hora:</span><input value='<?php echo $hora; ?>'type="text" name="hora" required><br>




          <input type="hidden" name="codigo" value='<?php echo $codigo; ?>'>



          <p><input type="submit" value="Actualizar"></p>
        </fieldset>
      </form>

    <?php else: ?>

      <?php

      $codigo = $_POST["codigo"];
      $fecha = $_POST["fecha"];
      $hora = $_POST["hora"];

      include("../includes/conexion.php");

      $query="update reservas set fecha='$fecha',hora_inicio='$hora'
      WHERE id_reserva='$codigo'";

      echo $query;
      if ($result = $connection->query($query)) {
        echo "Datos actualizados";
      } else {
        echo "Error al actualizar los datos";
      }

      ?>

    <?php endif ?>
  </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
