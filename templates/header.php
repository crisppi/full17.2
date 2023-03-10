<?php

include_once("globals.php");
include_once("db.php");
date_default_timezone_set('America/Sao_Paulo');
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/img/favicon.ico">

  <title>Full-2022</title>
  <!-- Boostrap -->
  <link href="<?php $BASE_URL ?>css/style.css" rel="stylesheet">
  <link href="<?php $BASE_URL ?>css/styleMenu.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <div class="col-md-12">
    <nav style="background-image: linear-gradient(to right, #949494, #d3d3d3 , #e9e9e9)" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img src="img/logo.png" style="width:50px; height:50px " alt="Full">
        </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="nav-tabs navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php $BASE_URL ?>index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Menu</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?php $BASE_URL ?>list_paciente.php" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cadastro
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_paciente.php">Paciente</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_usuario.php">Usu??rio</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_hospital.php">Hospital</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_seguradora.php">Seguradora</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_estipulante.php">Estipulante</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_acomodacao.php">Acomoda????o</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_patologia.php">Patologia</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_antecedente.php">Antecedente</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pesquisas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_paciente.php">Pacientes</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_usuario.php">Usu??rios</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_hospitalUser.php">Hospital por Usu??rio</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_hospital.php">Hospitais</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_seguradora.php">Seguradora</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_estipulante.php">Estipulante</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_acomodacao.php">Acomoda????o</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_patologia.php">Patologia</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_antecedente.php">Antecedente</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Produ????o
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_internacao.php">Interna????o</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_visita.php">Visita</a></li>
                <li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_internacao_niveis.php">N??veis</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_internacao.php">Lista Interna????o</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_internacao_uti.php">Lista Interna????o UTI</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_gestao.php">Lista gest??o</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_internacao_uti_alta.php">Alta UTI</a></li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_internacao_alta.php">Alta Hospitalar</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Contas
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>list_internacao_cap.php">Lan??ar Contas</a></li>
                <li>

                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php $BASE_URL ?>cad_capeante.php">Contas</a></li>
                <li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
      <div class="col-md-2" style="margin-left:200px; font-weight:600 ;font-size:12px">
        <?php
        if ($_SESSION) {
          echo "<span style='color:green; font-size:1.2em'>Bem vindo!!  " . $_SESSION['login_user'] . "</span><br>";
          $agora = date('d/m/Y H:i');
        } else {
          echo "<span style='color:red'> Voc?? n??o esta logado!!</span>" . "<br>";
        }

        $agora = date('d/m/Y H:i');
        echo "Local: " . $agora ?>
        <div>
          <a class="dropdown-item" style="margin-left:20px; color:red; font-size:larger; font-weight:600" href="<?php $BASE_URL ?>destroi.php"> Sair</a>
        </div>
      </div>
  </div>
  </nav>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>