<?php

# inclui o arquivo config(arquivo de conexão com o banco de dados)
include_once("globals.php");
require("db.php");
include_once("models/seguradora.php");
include_once("dao/seguradoraDao.php");
include_once("templates/header.php");


# seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
?>
<div class="container-fluid py-1">
    <h3 class="page-title">Relação hospitais</h3>
    <hr>
    <div class="menu_pesquisa">
        <form method="post">
            <input type="text" name="pesquisa_hosp" id="pesquisa_hosp" placeholder="Pesquisa por seguradora">
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Buscar</button>
        </form>

        <?php
        $pesquisa_hosp = filter_input(INPUT_POST, "pesquisa_hosp");
        ?>
    </div>
    <?php
    if (!$pesquisa_hosp) {
        $sql = "SELECT * FROM tb_seguradora ORDER BY id_seguradora ASC LIMIT " . $inicio . ", " . $limite;
    } else {
        $sql = "SELECT * FROM tb_seguradora WHERE seguradora_seg like '$pesquisa_hosp%' ORDER BY id_seguradora desc";
    }

    try {

        $query = $conn->prepare($sql);
        $query->execute();
    } catch (PDOexception $error_sql) {

        echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
    } ?>

    <div class="container-fluid py-5">
        <h2 class="page-title">Relação hospitais</h2>
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
                <?php while ($linha = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                    <?php
                    foreach ($query as $seguradora) : ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $seguradora["id_seguradora"] ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $seguradora["seguradora_seg"] ?></td>
                            <td scope="row"><?= $seguradora["cnpj_seg"] ?></td>
                            <td scope="row"><?= $seguradora["endereco_seg"] ?></td>
                            <td scope="row"><?= $seguradora["numero_seg"] ?></td>
                            <td scope="row"><?= $seguradora["bairro_seg"] ?></td>
                            <td scope="row"><?= $seguradora["cidade_seg"] ?></td>
                            <td scope="row"><?= $seguradora["telefone01_seg"] ?></td>
                            <td scope="row"><?= $seguradora["telefone02_seg"] ?></td>
                            <td scope="row"><?= $seguradora["email01_seg"] ?></td>
                            <td scope="row"><?= $seguradora["email02_seg"] ?></td>

                            <td class="action">
                                <a href="cad_seguradora.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                                <a href="<?= $BASE_URL ?>show_seguradora.php?id_seguradora=<?= $seguradora["id_seguradora"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                                <a href="<?= $BASE_URL ?>edit_seguradora.php?id_seguradora=<?= $seguradora["id_seguradora"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                                <!--<a href="<?= $BASE_URL ?>process_seguradora.php?id_seguradora=<?= $seguradora["id_seguradora"] ?>"><i style="color:red" name="type" value="deletar" class="aparecer-acoes fas fa-times delete-icon"></i></a>
                -->
                                <form class="d-inline-block delete-form" action="del_seguradora.php" method="POST">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id_seguradora" value="<?= $seguradora["id_seguradora"] ?>">
                                    <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
        <?php $id_seguradora = filter_input(INPUT_GET, "id_seguradora"); ?>

        <div class="btn_acoes oculto">
            <p>Deseja deletar este seguradora: <?php $seguradora['nome'] ?> ?</p>
            <button class="cancelar btn btn-success styled" type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button class="btn btn-danger styled" type="button" id="deletar" name="deletar">Deletar</button>
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
                echo " <li class='page-item'><a class='page-link' href='list_seguradora.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
                if ($qtdPag > 1 && $pg <= $qtdPag) {

                    for ($i = 1; $i <= $qtdPag; $i++) {

                        if ($i == $pg) {

                            echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
                        } else {

                            echo "<li class='page-item '><a class='page-link' href='list_seguradora.php?pg=$i'>" . $i . "</a></li>";
                        }
                    }
                }
                echo "<li class='page-item'><a class='page-link' href='list_seguradora.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
                echo " </ul>";
                echo "</nav>";
                echo "</div>";



?>