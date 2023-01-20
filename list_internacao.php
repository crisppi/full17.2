<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <?php
    include_once("globals.php");

    require_once("templates/header.php");
    require_once("dao/internacaoDao.php");
    require_once("models/message.php");
    include_once("models/hospital.php");
    include_once("dao/hospitalDao.php");
    include_once("models/patologia.php");
    include_once("dao/patologiaDao.php");
    require_once("dao/pacienteDAO.php");

    $internacaoDao = new internacaoDAO($conn, $BASE_URL);
    $hospital_geral = new hospitalDAO($conn, $BASE_URL);
    $hospitals = $hospital_geral->findGeral();
    $pacienteDao = new pacienteDAO($conn, $BASE_URL);
    $pacientes = $pacienteDao->findGeral();
    $patologiaDao = new patologiaDAO($conn, $BASE_URL);
    $patologias = $patologiaDao->findGeral();
    ?>
    <?php
    //Instanciando a classe
    //Criado o objeto $listarinternacaos
    $internacao_geral = new internacaoDAO($conn, $BASE_URL);

    //Instanciar o metodo listar internacao
    $internacaos = $internacao_geral->joininternacaoHospital();

    ?>
    <!-- FORMULARIO DE PESQUISAS -->
    <div class="container py-2">
        <form class="formulario visible" action="#" id="select-internacao-form" method="POST" enctype="multipart/form-data">
            <h6 class="page-title">Pesquisa internações</h6>
            <div>
                <input type="hidden" name="type" value="pesquisaList">
            </div>
            <div class="form-group row">

                <div class="form-group col-sm-4">
                    <select class="form-control mb-2" id="pesquisa_hosp" name="pesquisa_hosp">
                        <option value="">Selecione o Hospital</option>
                        <?php foreach ($hospitals as $hospital) : ?>
                            <option value="<?= $hospital["id_hospital"] ?>"><?= $hospital["nome_hosp"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <select class="form-control mb-3" id="pesqInternado" name="pesqInternado">
                        <option value="Sim">Busca por Internados</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <button type="submit" class="btn btn-primary mb-1">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- BASE DAS PESQUISAS -->
    <?php
    $pesquisa_hosp = "";
    $type = "";
    $pesqInternado = "";
    $limite = "";
    $inicio = "";

    $pesquisa_hosp = filter_input(INPUT_POST, "pesquisa_hosp");
    $pesqInternado = filter_input(INPUT_POST, "pesqInternado");
    $type = filter_input(INPUT_POST, "type");
    ?>
    <?php
    // validacao do formulario
    if (isset($_POST['pesqInternado'])) {
        $pesqInternado = $_POST['pesqInternado'];
    }

    if (isset($_POST['pesquisa_hosp'])) {
        $pesquisa_hosp = $_POST['pesquisa_hosp'];
    }

    // ENCAMINHAMENTO DOS INPUTS DO FORMULARIO
    if (($pesquisa_hosp != "")) {
        $query = $internacao->findInternByHosp($pesquisa_hosp, $limite, $inicio);
    }

    if (($pesqInternado != "")) {
        $query = $internacao->findInternByInternado($pesqInternado, $limite, $inicio);
    }
    if (($pesqInternado != "") || ($pesquisa_hosp != "")) {
        $query = $internacao->findInternAll($limite, $inicio);
    }


    try {

        $internacao = $conn->prepare($sql);
        $internacao->execute();
    } catch (PDOexception $error_sql) {
        echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
    } ?>
    <div class="container">
        <h6 class="page-title">Relatório de internações</h6>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Internado</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Data internação</th>
                    <th scope="col">Acomodação</th>
                    <th scope="col">Data visita</th>
                    <th scope="col">Patologia</th>
                    <th scope="col">Grupo Patologia</th>
                    <th scope="col">Modo Admissão</th>
                    <th scope="col">Tipo internação</th>
                    <th scope="col">Médico</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Relatório</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($internacaos as $internacao) : ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $internacao["id_internacao"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $internacao["internado_int"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $internacao["nome_hosp"] ?></td>
                        <td scope="row"><?= $internacao["nome_pac"] ?></td>
                        <td scope="row"><?= $internacao["data_intern_int"] ?></td>
                        <td scope="row"><?= $internacao["acomodacao_int"] ?></td>
                        <td scope="row"><?= $internacao["data_visita_int"] ?></td>
                        <td scope="row"><?= $internacao["patologia_pat"] ?></td>
                        <td scope="row"><?= $internacao["grupo_patologia_int"] ?></td>
                        <td scope="row"><?= $internacao["tipo_admissao_int"] ?></td>
                        <td scope="row"><?= $internacao["modo_internacao_int"] ?></td>
                        <td scope="row"><?= $internacao["titular_int"] ?></td>
                        <td scope="row"><?= $internacao["especialidade_int"] ?></td>
                        <td scope="row"><?= $internacao["rel_int"] ?></td>
                        <td scope="row"><?= $internacao["acoes_int"] ?></td>


                        <td class="action">
                            <a href="cad_internacao.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_internacao.php?id_internacao=<?= $internacao["id_internacao"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>edit_internacao.php?id_internacao=<?= $internacao["id_internacao"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>cad_visita.php?id_internacao=<?= $internacao["id_internacao"] ?>"><i style="color:black; font-weigth:bold; margin-left:5px;margin-right:5px" name="type" value="visita" class="aparecer-acoes bi bi-file-text"></i></a>

                            <form class="d-inline-block delete-form" action="process_alta.php" method="POST">
                                <input type="hidden" name="type" value="alta">
                                <input type="hidden" name="alta" value="Não">
                                <input type="hidden" name="id_internacao" value="<?= $internacao["id_internacao"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block bi bi-door-open"></i></button>
                            </form>
                            <form class="d-inline-block delete-form" action="del_internacao.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_internacao" value="<?= $internacao["id_internacao"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $id_internacao = filter_input(INPUT_GET, "id_internacao"); ?>

        <div class="btn_acoes oculto">
            <p>Deseja deletar este internacao: <?php $internacao['nome'] ?> ?</p>
            <button class="cancelar btn btn-success styled" type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button class="btn btn-danger styled" type="button" id="deletar" name="deletar">Deletar</button>
        </div>
    </div>
    <script>
        $(".aparecer-acoes").click(function() {
            $('.btn_acoes').removeClass('oculto');
            $('.btn_acoes').addClass('visible');
        });

        var id_internacao = $(this).attr('id_internacao');
        console.log(id_internacao);
    </script>

    <script>
        $(".cancelar").click(function() {
            $('.btn_acoes').removeClass('visible');
            $('.btn_acoes').addClass('oculto');
        });

        $('#deletar').click(function() {
            window.location.href = 'del_internacao.php';
        });

        document.getElementById("fk_hospital").onclick = function() {
            var comboHospital = document.getElementById("fk_hospital");

            console.log("O indice é: " + comboHospital.selectedIndex);
            console.log("O texto é: " + comboHospital.options[comboHospital.selectedIndex].text);
            console.log("A chave é: " + comboHospital.options[comboHospital.selectedIndex].value);

            varhosp = comboHospital.options[comboHospital.selectedIndex].value;
            varhospNome = comboHospital.options[comboHospital.selectedIndex].text;

            console.log(varhosp);
            console.log(varhospNome);

            document.getElementById("texto").innerHTML = "Você selecionou : " + varhospNome;


        };
    </script>
    <?php

    //modo cadastro
    $formData = "0";
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($formData != "0") {
        $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
        //header("Location: index.php");
    } else {
        echo "<p style='color: #f00;'>Erro: Usuário não cadastrado!</p>";
    };
    ?>
    <?php
    include_once("templates/footer.php");
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>



</html>