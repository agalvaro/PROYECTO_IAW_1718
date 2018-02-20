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

        $consulta="select r.id_reserva as n5,r.fecha,r.hora_inicio,p.tipo,u.correo,m.nombre,m.id_material as n6
                    from usuarios u join reservas r on u.id_usuario=r.id_usuario
                    join pistas p on r.id_pista=p.id_pista
                    left join reserva_material on r.id_reserva=reserva_material.id_reserva
                    left join material m on reserva_material.id_material=m.id_material
                    order by r.fecha asc;";

        if ($result = $connection->query($consulta)) {

          echo "<table class='table table-striped table-inverse'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Fecha</th>";
          echo "<th>Hora Inicio</th>";
          echo "<th>Pista</th>";
          echo "<th>Cliente</th>";
          echo "<th>Material</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

              while ($obj=$result->fetch_object()) {
                $name=$obj->nombre;
                echo "<tr>";
                  echo "<td>".$obj->fecha."</td>";
                  echo "<td>".$obj->hora_inicio."</td>";
                  echo "<td>".$obj->tipo."</td>";
                  echo "<td>".$obj->correo."</td>";
                  if ($obj->nombre===NULL) {
                    echo "<td><a href='add_mat2.php?a=".$obj->n5."'>+</a></td>";
                  } else {
                    echo "<td><a href='quitar_mat.php?a=".$obj->n5."&b=".$obj->n6."'>$name -</a></td>";
                  }
                  echo "<td><a href='editar_reserva.php?i=".$obj->id_reserva."'><img class='img-responsive' width='25px' alt='Responsive image' src='../img/lapiz.png'></a></td>";
                  echo "<td><a href='borrar_reserva.php?i=".$obj->id_reserva."'><img class='img-responsive' width='25px' alt='Responsive image' src='../img/trash.jpg'></a></td>";
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
