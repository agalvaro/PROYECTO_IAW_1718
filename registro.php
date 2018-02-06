<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
  </head>
  <body>
    <?php if (!isset($_POST['user'])) : ?>
      <div class="container">
        <div class="row mt-5 justify-content-center ">
          <div class="col-sm-6 col-md-4 bg-warning rounded">
            <form method="post">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Introduce tu nombre">
              </div>
              <div class="form-group">
                <label for="nombre">Apellidos</label>
                <input name="ape" type="text" class="form-control" id="ape" aria-describedby="emailHelp" placeholder="Introduce tus apellidos">
              </div>
              <div class="form-group">
                <label for="nombre">Teléfono</label>
                <input name="tlf" type="text" class="form-control" id="tlf" aria-describedby="emailHelp" placeholder="Introduce tu teléfono">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Correo eléctronico</label>
                <input name="user" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduce tu email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Introduce tu contraseña">
              </div>
              <div class="form-group">
              </div>
              <button type="submit" class="btn btn-primary">Registrarme</button>
            </form>
    <?php else: ?>
      <?php

      include("../includes/conexion.php");


      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }


      $usuario="INSERT INTO usuarios (nombre,apellidos,telefono,correo,passwd,tipo) VALUES ('".$_POST['name']."','".$_POST['ape']."','".$_POST['tlf']."','".$_POST['user']."',md5('".$_POST['password']."'),'usuario');";
        if ($result = $connection->query($usuario)) {
         echo "<h1>Has sido registrado</h1>";
         header("Location: ../login.php");
       } else {
         echo "<h1>Error</h1>";
       }
      ?>
    <?php endif ?>
  </body>
</html>
