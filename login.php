<?php
  session_start();
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
      <div class="row mt-5 justify-content-center ">
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
            <button type="submit" class="btn btn-primary">Entrar</button>
          </form>

    <?php

        if (isset($_POST["user"])) {


          $connection = new mysqli("192.168.1.159", "root", "Admin2015","web", 3316);


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
                    if ($obj->tipo=="usuario") {
                      $_SESSION["user"]=$_POST["user"];
                      header("Location: usuario/index.php");
                    } else {
                      $_SESSION["user"]=$_POST["user"];
                      $_SESSION["admin"]="Admin";
                      header("Location: admin/index.php");
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
