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

        include("../includes/conexion.php");

        $consulta="select * from pistas;";

        if ($result = $connection->query($consulta)) {

          echo "<table class='table table-striped table-inverse'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th><a href='anadir_pista.php'>+</th>";
          echo "<th>Nombre</th>";
          echo "<th>Tipo</th>";
          echo "<th></th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

              while ($obj=$result->fetch_object()) {
                echo "<tr>";
                  echo "<td></td>";
                  echo "<td>".$obj->nombre."</td>";
                  echo "<td>".$obj->tipo."</td>";
                  echo "<td><a href='editar_pista.php?p=".$obj->id_pista."'><img class='img-responsive' width='25px' alt='Responsive image' src='../img/lapiz.png'></a></td>";
                  echo "<td><a href='borrar_pista.php?p=".$obj->id_pista."'><img class='img-responsive' width='25px' alt='Responsive image' src='../img/trash.jpg'></a></td>";
                echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        $result->close();
        unset($obj);
        unset($connection);
      ?>
    </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
