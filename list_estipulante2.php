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
    include_once("models/estipulante.php");
    include_once("dao/estipulanteDao.php");
    include_once("templates/header.php");
    ?>
    <?php
    //Instanciando a classe
    //Criado o objeto $listarestipulantes
    $estipulante_geral = new estipulanteDAO($conn, $BASE_URL);

    //Instanciar o metodo listar estipulante
    $estipulantes = $estipulante_geral->findGeral();
    //var_dump($estipulantes);
    ?>

    <!--tabela usuarios-->

    <div class="container-fluid py-5">
        <h2 class="page-title">Relação Estipulante</h2>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Número</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Telefone01</th>
                    <th scope="col">Telefone 02</th>
                    <th scope="col">Email01</th>
                    <th scope="col">Email02</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($estipulantes as $estipulante) : ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $estipulante["id_estipulante"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $estipulante["nome_est"] ?></td>
                        <td scope="row"><?= $estipulante["cnpj_est"] ?></td>
                        <td scope="row"><?= $estipulante["endereco_est"] ?></td>
                        <td scope="row"><?= $estipulante["numero_est"] ?></td>
                        <td scope="row"><?= $estipulante["bairro_est"] ?></td>
                        <td scope="row"><?= $estipulante["cidade_est"] ?></td>
                        <td scope="row"><?= $estipulante["telefone01_est"] ?></td>
                        <td scope="row"><?= $estipulante["telefone02_est"] ?></td>
                        <td scope="row"><?= $estipulante["email01_est"] ?></td>
                        <td scope="row"><?= $estipulante["email02_est"] ?></td>

                        <td class="action">
                            <a href="cad_estipulante.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_estipulante.php?id_estipulante=<?= $estipulante["id_estipulante"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                            <a href="<?= $BASE_URL ?>edit_estipulante.php?id_estipulante=<?= $estipulante["id_estipulante"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                            <!--<a href="<?= $BASE_URL ?>process_estipulante.php?id_estipulante=<?= $estipulante["id_estipulante"] ?>"><i style="color:red" name="type" value="deletar" class="aparecer-acoes fas fa-times delete-icon"></i></a>
                -->
                            <form class="d-inline-block delete-form" action="del_estipulante.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_estipulante" value="<?= $estipulante["id_estipulante"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $id_estipulante = filter_input(INPUT_GET, "id_estipulante"); ?>

        <div class="btn_acoes oculto">
            <p>Deseja deletar este estipulante: <?php $estipulante['nome'] ?> ?</p>
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
            window.location.href = 'del_estipulante.php';
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