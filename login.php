<?php
  session_start();
  if ( isset($_SESSION["user"])) {
    session_destroy();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
      <div class="row mt-5 justify-content-center">
        <div class="col-sm-6 col-md-4 bg-warning rounded">
          <form method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Correo eléctronico</label>
              <input name="user" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduce tu email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contraseña</label>
              <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Introduce tu contraseña">
            </div>
            <p>¿Aún no tienes cuenta?<a href="registro.php">¡Regístrate!</a></p>
            <button type="submit" class="mb-3 btn btn-primary offset-md-9">Entrar</button>
          </form>

    <?php

    if (isset($_POST["user"])) {


          include("includes/conexion.php");


          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }


          $consulta="select * from usuarios where
          correo='".$_POST["user"]."' and passwd=md5('".$_POST["password"]."');";


          if ($result = $connection->query($consulta)) {


              if ($result->num_rows===0) {
                echo "<center>LOGIN INVALIDO</center>";
              } else {
                  while ($obj=$result->fetch_object()) {
                    $_SESSION["user"]=$_POST["user"];
                    $_SESSION["id"]=$obj->id_usuario;
                    if ($obj->tipo=="usuario") {
                      $_SESSION["tipo"]="Usuario";
                      header("Location: usuario/inicio.php");
                    } else {
                      $_SESSION["tipo"]="admin";
                      header("Location: admin/inicio.php");
                    }
                }
              }

          } else {
            echo "Wrong Query";
          }
      }
    ?>
  </div>
</div>
</div>
  </body>
</html>
