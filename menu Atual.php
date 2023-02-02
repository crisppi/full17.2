<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
require_once("templates/header.php");
echo "<pre>";
print_r($_SESSION);
?>

<div class="container">
    <div class="row" style="margin-top:10px; background-color:#F1F0EF">
        <div style="height: 10px;">
        </div>
        <div class="col lista_menu">
            <div>
                <h4>CADASTRO</h4>
            </div>
            <hr>
            <li>
                <a href="cad_paciente.php">Pacientes</a>
            </li>
            <li>
                <a href="cad_hospital.php">Hospital</a>
            </li>
            <li>
                <a href="cad_usuario.php">Usuário</a>
            </li>
            <li>
                <a href="cad_paciente.php">Estipulante</a>
            </li>
            <li>
                <a href="cad_seguradora.php">Seguradora</a>
            </li>
        </div>

        <div class="col lista_menu">

            <h4>LISTAS</h4>
            <hr>

            <li>
                <a href="list_paciente.php">Pacientes</a>
            </li>
            <li>
                <a href="list_hospital.php">Hospital</a>
            </li>
            <li>
                <a href="list_usuario.php">Usuário</a>
            </li>
            <li>
                <a href="list_estipulante.php">Estipulante</a>
            </li>
            <li>
                <a href="list_seguradora.php">Seguradora</a>
            </li>
        </div>
        <div class="col lista_menu">
            <h4>ADMINISTRATIVO</h4>
            <hr>

            <li>
                <a href="cad_patologia.php">Cadastro Patologias</a>
            </li>
            <li>
                <a href="cad_acomodacao.php">Cadastro Acomodação</a>
            </li>
            <hr>
            <li>
                <a href="list_patologia.php">Relação Patologias</a>
            </li>
            <li>
                <a href="list_acomodacao.php">Relação Acomodação</a>
            </li>

        </div>
        <div class="col lista_menu">
            <h4>PRODUÇÃO</h4>
            <hr>
            <li>
                <a href="cad_internacao.php">Nova Internação</a>
            </li>
            <li>
                <a href="cad_visita.php">Outras Visitas</a>
            </li>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once("templates/footer.php");
?>