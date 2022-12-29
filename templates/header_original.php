<?php

include_once("globals.php");
include_once("db.php");

// limpa a mensagem
if (isset($_SESSION['msg'])) {
  $printMsg = $_SESSION['msg'];
  $_SESSION['msg'] = '';
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>

  <!-- Boostratp -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="<?php $BASE_URL ?>css/style.css" rel="stylesheet">

  <!-- Boostratp icones-->


</head>

<body>
  <header>
    <Div>
      <nav style="background-image: linear-gradient(to left, #949494, #d3d3d3 , #e9e9e9)" class="navbar sticky-top navbar-expand-md">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="<?php $BASE_URL ?>img/Full-01.png" style="width:70px; height:70px " alt="Full">
          </a>

          <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#itens">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="itens">
            <ul class="nav nav-tabs">

              <li class="nav-item dropdown navega">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Gestão dados</a>
                <ul class="dropdown-menu">
                  <li><a href="<?php $BASE_URL ?>cad_paciente.php" class="dropdown-item">Paciente</a></li>
                  <li><a href="#" class="dropdown-item">Seguradora</a></li>
                  <li><a href="#" class="dropdown-item">Empresa</a></li>
                  <li><a href="<?php $BASE_URL ?>cad_usuario.php" class="dropdown-item">Usuário</a></li>
                  <li><a href="<?php $BASE_URL ?>cad_hospital.php" class="dropdown-item">Hospital</a></li>
                  <li><a href="#" class="dropdown-item">Acomodação</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown navega">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Pesquisas</a>
                <ul class="dropdown-menu">
                  <li><a href="<?php $BASE_URL ?>list_paciente.php" class="dropdown-item">Paciente</a></li>
                  <li><a href="#" class="dropdown-item">Seguradora</a></li>
                  <li><a href="#" class="dropdown-item">Empresa</a></li>
                  <li><a href="<?php $BASE_URL ?>list_usuario.php" class="dropdown-item">Usuário</a></li>
                  <li><a href="<?php $BASE_URL ?>list_hospital.php" class="dropdown-item">Hospital</a></li>
                  <li><a href="#" class="dropdown-item">Acomodação</a></li>
                </ul>
              </li>


              <li class="nav-item">
                <a class="nav-link" href="<?php $BASE_URL ?>cad_paciente.php">Pacientes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php $BASE_URL ?>list_paciente.php">List Pacientes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php $BASE_URL ?>list_usuario.php">List Usuario</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php $BASE_URL ?>list_hospital.php">List Hospital</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Altas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php">Login</a>
              </li>

            </ul>
            <form style="margin-left:450px" class="d-flex">
              <input class="form-control" placeholder="digite uma palavra..." type="search" />
              <button style="margin-left:10px" class="btn btn-success" type="submit">Pesquisar</button>
            </form>
          </div>
        </div>
      </nav>
    </Div>
  </header>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <!-- Jquery Boostratp -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js" integrity="sha512-8Y8eGK92dzouwpROIppwr+0kPauu0qqtnzZZNEF8Pat5tuRNJxJXCkbQfJ0HlUG3y1HB3z18CSKmUo7i2zcPpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>