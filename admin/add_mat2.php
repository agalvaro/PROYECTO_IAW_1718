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

      <?php

      if (empty($_GET)) {
        echo "No se han recibido datos del material";
        exit();
      }
      else {
        echo "<br>";
        echo "<div class='col-md-11'>";
        echo "<form method='post'>";
        echo "<label >Material</label>";
        echo "<select class='form-control' name='material'>";
        echo "<option value=''></option>";

          include("../includes/conexion.php");

          $consulta="select * from material;";

          if ($result = $connection->query($consulta)) {

              while ($obj=$result->fetch_object()) {
                echo "<option value='".$obj->id_material."'>".$obj->nombre."</option>";

                }
          }



        echo "</select>";
        echo "<br>";
        echo "<div class='row'>";
        echo "<div class='col-md-10'>
        </div>
        <div class='col-md-1'>";
        echo "<button type='submit' class='mb-3 btn btn-primary offset-md-6'>Añadir</button>";
        echo "</div>";
        echo "</div>";
      echo "</form>";
      }
    ?>

    <?php if (isset($_POST["material"])) : ?>

    <?php

      include("../includes/conexion.php");

      $consulta="INSERT INTO reserva_material (id_reserva,id_material) VALUES('".$_GET['a']."','".$_GET['b']."');";

      if ($result = $connection->query($consulta))  {
        header('Location: gestionreservas.php');

      } else {
        echo "Error al actualizar los datos";
        echo "$consulta";
      }

      ?>

  <?php endif ?>
  </div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
