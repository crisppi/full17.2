<?php

# inclui o arquivo config(arquivo de conexão com o banco de dados)
include_once("globals.php");
require("db.php");
include_once("models/hospital.php");
include_once("dao/hospitalDao.php");
include_once("templates/header.php");


# seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
?>
<div class="container-fluid py-1">
    <h3 class="page-title">Relação hospitais</h3>
    <hr>
    <div class="menu_pesquisa">
        <form method="post">
            <input type="text" name="pesquisa_hosp" id="pesquisa_hosp" placeholder="Pesquisa por hospital">
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Buscar</button>
        </form>

        <?php
        $pesquisa_hosp = filter_input(INPUT_POST, "pesquisa_hosp");
        ?>
    </div>
    <?php
    if (!$pesquisa_hosp) {
        $sql = "SELECT * FROM tb_hospital ORDER BY id_hospital ASC LIMIT " . $inicio . ", " . $limite;
    } else {
        $sql = "SELECT * FROM tb_hospital WHERE nome_hosp like '$pesquisa_hosp%' ORDER BY id_hospital desc";
    }

    try {

        $query = $conn->prepare($sql);
        $query->execute();
    } catch (PDOexception $error_sql) {

        echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
    }
    while ($linha = $query->fetch(PDO::FETCH_ASSOC)) { ?>

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
                    <th scope="col">Telefone 01</th>
                    <th scope="col">Telefone 02</th>
                    <th scope="col">Email 01</th>
                    <th scope="col">Email 02</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $hospital) : ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $hospital["id_hospital"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $hospital["nome_hosp"] ?></td>
                        <td scope="row"><?= $hospital["cnpj_hosp"] ?></td>
                        <td scope="row"><?= $hospital["endereco_hosp"] ?></td>
                        <td scope="row"><?= $hospital["numero_hosp"] ?></td>
                        <td scope="row"><?= $hospital["bairro_hosp"] ?></td>
                        <td scope="row"><?= $hospital["cidade_hosp"] ?></td>
                        <td scope="row"><?= $hospital["telefone01_hosp"] ?></td>
                        <td scope="row"><?= $hospital["telefone02_hosp"] ?></td>
                        <td scope="row"><?= $hospital["email01_hosp"] ?></td>
                        <td scope="row"><?= $hospital["email02_hosp"] ?></td>

                        <td class="action">
                            <a href="cad_hospital.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_hospital.php?id_hospital=<?= $hospital["id_hospital"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                            <a href="<?= $BASE_URL ?>edit_hospital.php?id_hospital=<?= $hospital["id_hospital"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                            <!--<a href="<?= $BASE_URL ?>process_hospital.php?id_hospital=<?= $hospital["id_hospital"] ?>"><i style="color:red" name="type" value="deletar" class="aparecer-acoes fas fa-times delete-icon"></i></a>
                -->
                            <form class="d-inline-block delete-form" action="del_hospital.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_hospital" value="<?= $hospital["id_hospital"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $id_hospital = filter_input(INPUT_GET, "id_hospital"); ?>

        <div class="btn_acoes oculto">
            <p>Deseja deletar este hospital: <?php $hospital['nome'] ?> ?</p>
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
    echo " <li class='page-item'><a class='page-link' href='list_hospital.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
    if ($qtdPag > 1 && $pg <= $qtdPag) {

        for ($i = 1; $i <= $qtdPag; $i++) {

            if ($i == $pg) {

                echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
            } else {

                echo "<li class='page-item '><a class='page-link' href='list_hospital.php?pg=$i'>" . $i . "</a></li>";
            }
        }
    }
    echo "<li class='page-item'><a class='page-link' href='list_hospital.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
    echo " </ul>";
    echo "</nav>";
    echo "</div>";



?>