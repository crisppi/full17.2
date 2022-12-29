<?php

# inclui o arquivo config(arquivo de conexão com o banco de dados)
include_once("globals.php");
require("db.php");
include_once("models/estipulante.php");
include_once("dao/estipulanteDao.php");
include_once("templates/header.php");


# seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
?>
<div class="container-fluid py-1">
    <h3 class="page-title">Relação hospitais</h3>
    <hr>
    <div class="menu_pesquisa">
        <form method="post">
            <input type="text" name="pesquisa_est" id="pesquisa_est" placeholder="Pesquisa por estipulante">
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Buscar</button>
        </form>

        <?php
        $pesquisa_est = filter_input(INPUT_POST, "pesquisa_est");
        ?>
    </div>
    <?php
    if (!$pesquisa_est) {
        $sql = "SELECT * FROM tb_estipulante ORDER BY id_estipulante ASC LIMIT " . $inicio . ", " . $limite;
    } else {
        $sql = "SELECT * FROM tb_estipulante WHERE nome_est like '$pesquisa_est%' ORDER BY id_estipulante desc";
    }

    try {

        $query = $conn->prepare($sql);
        $query->execute();
    } catch (PDOexception $error_sql) {

        echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
    }
    while ($linha = $query->fetch(PDO::FETCH_ASSOC)) { ?>

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
                    foreach ($query as $estipulante) : ?>
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

</div>

<?php }



    try {

        $query_Total = $conn->prepare($sql_Total);
        $query_Total->execute();

        $query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);

        # conta quantos registros tem no banco de dados
        $query_count = $query_Total->rowCount();

        # calcula o total de paginas a serem exibidas
        $qtdPag = ceil($query_count / $limite);
    } catch (PDOexception $error_Total) {

        echo 'Erro ao retornar os Dados. ' . $error_Total->getMessage();
    }
    echo "<div style=margin-left:20px;>";
    echo "<div style='color:blue; margin-left:20px;'>";
    echo "Navegação";
    echo "</div>";
    echo "<nav aria-label='Page navigation example'>";
    echo " <ul class='pagination'>";
    echo " <li class='page-item'><a class='page-link' href='list_estipulante.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
    if ($qtdPag > 1 && $pg <= $qtdPag) {

        for ($i = 1; $i <= $qtdPag; $i++) {

            if ($i == $pg) {

                echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
            } else {

                echo "<li class='page-item '><a class='page-link' href='list_estipulante.php?pg=$i'>" . $i . "</a></li>";
            }
        }
    }
    echo "<li class='page-item'><a class='page-link' href='list_estipulante.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
    echo " </ul>";
    echo "</nav>";
    echo "</div>";



?>