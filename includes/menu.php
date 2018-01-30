<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">ePistas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="pistas.php">Pistas</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="material.php">Material</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="reservas.php">Reservas</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"><?php echo $_SESSION['user'];?></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../login.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
