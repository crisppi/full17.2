<?php

# inclui o arquivo config(arquivo de conexão com o banco de dados)
include_once("globals.php");
require("db.php");
include_once("models/paciente.php");
include_once("dao/pacienteDao.php");
include_once("templates/header.php");


# seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
?>
<div class="container-fluid py-1">
    <h3 class="page-title">Relação de Pacientes</h3>
    <hr>
    <div class="menu_pesquisa">
        <form method="post">
            <input type="text" name="pesquisa_pac" id="pesquisa_pac" placeholder="Pesquisa por paciente">
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Buscar</button>
        </form>

        <?php
        $pesquisa_pac = filter_input(INPUT_POST, "pesquisa_pac");
        ?>
    </div>
    <?php
    if (!$pesquisa_pac) {
        $sql = "SELECT * FROM tb_paciente ORDER BY id_paciente ASC LIMIT " . $inicio . ", " . $limite;
    } else {
        $sql = "SELECT * FROM tb_paciente WHERE nome_pac like '$pesquisa_pac%' ORDER BY nome_pac desc";
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
                foreach ($query as $paciente) : ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $paciente["id_paciente"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $paciente["nome_pac"] ?></td>
                        <td scope="row"><?= $paciente["cpf_pac"] ?></td>
                        <td scope="row"><?= $paciente["endereco_pac"] ?></td>
                        <td scope="row"><?= $paciente["numero_pac"] ?></td>
                        <td scope="row"><?= $paciente["bairro_pac"] ?></td>
                        <td scope="row"><?= $paciente["cidade_pac"] ?></td>
                        <td scope="row"><?= $paciente["telefone01_pac"] ?></td>
                        <td scope="row"><?= $paciente["telefone02_pac"] ?></td>
                        <td scope="row"><?= $paciente["email01_pac"] ?></td>
                        <td scope="row"><?= $paciente["email02_pac"] ?></td>

                        <td class="action">
                            <a href="cad_paciente.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_paciente.php?id_paciente=<?= $paciente["id_paciente"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                            <a href="<?= $BASE_URL ?>edit_paciente.php?id_paciente=<?= $paciente["id_paciente"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>
                            <form class="d-inline-block delete-form" action="del_paciente.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_paciente" value="<?= $paciente["id_paciente"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $id_paciente = filter_input(INPUT_GET, "id_paciente"); ?>

        <div class="btn_acoes oculto">
            <p>Deseja deletar este paciente: <?php $paciente['nome'] ?> ?</p>
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
    echo " <li class='page-item'><a class='page-link' href='list_paciente.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
    if ($qtdPag > 1 && $pg <= $qtdPag) {

        for ($i = 1; $i <= $qtdPag; $i++) {

            if ($i == $pg) {

                echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
            } else {

                echo "<li class='page-item '><a class='page-link' href='list_paciente.php?pg=$i'>" . $i . "</a></li>";
            }
        }
    }
    echo "<li class='page-item'><a class='page-link' href='list_paciente.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
    echo " </ul>";
    echo "</nav>";
    echo "</div>";



?>