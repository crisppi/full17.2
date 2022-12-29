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
    include_once("models/acomodacao.php");
    include_once("dao/acomodacaoDao.php");
    include_once("templates/header.php");
    ?>
    <?php
    //Instanciando a classe
    //Criado o objeto $listaracomodacaos
    $acomodacao_geral = new acomodacaoDAO($conn, $BASE_URL);

    //Instanciar o metodo listar acomodacao
    $acomodacao = $acomodacao_geral->joinAcomodacaoHospital();
    ?>

    <!--tabela usuarios-->

    <div class="container-fluid py-5">
        <h2 class="page-title">Relação acomodação</h2>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Acomodação</th>
                    <th scope="col">Valor diária</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($acomodacao as $acomod) : ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $acomod["id_acomodacao"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $acomod["acomodacao_aco"] ?></td>
                        <td scope="row" class="nome-coluna-table">R$ <?= number_format($acomod["valor_aco"], 2, ",", ".")  ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $acomod["nome_hosp"] ?></td>
                        <td class="action">
                            <a href="cad_acomodacao.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_acomodacao.php?id_acomodacao=<?= $acomod["id_acomodacao"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                            <a href="<?= $BASE_URL ?>edit_acomodacao.php?id_acomodacao=<?= $acomod["id_acomodacao"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                            <a href="<?= $BASE_URL ?>process_acomodacao.php?id_acomodacao=<?= $acomod["id_acomodacao"] ?>"><i style="color:red; margin-left:10px" name="type" value="deletar" class="aparecer-acoes fas bi bi-x-square-fill  delete-icon"></i></a>

                            <!-- <form class="d-inline-block delete-form" action="del_acomodacao.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_acomodacao" value="<?= $acomodacao["id_acomodacao"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes fas fa-times delete-icon"></i></button>
                            </form> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $id_acomodacao = filter_input(INPUT_GET, "id_acomodacao"); ?>

        <div class="btn_acoes oculto">
            <p>Deseja deletar este acomodacao: <?php $acomodacao['nome'] ?> ?</p>
            <button class="cancelar btn btn-success styled" type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button class="btn btn-danger styled" type="button" id="deletar" name="deletar">Deletar</button>
        </div>
    </div>

    <script>
        $(".aparecer-acoes").click(function() {

            $('.btn_acoes').removeClass('oculto');
            $('.btn_acoes').addClass('visible');
        });
    </script>

    <script>
        $(".cancelar").click(function() {
            $('.btn_acoes').removeClass('visible');
            $('.btn_acoes').addClass('oculto');
        });

        $('#deletar').click(function() {
            window.location.href = 'del_acomodacao.php';
        });
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
    include_once("templates/footer1.php");
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


</html>