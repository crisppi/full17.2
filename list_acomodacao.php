<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit;
}
# inclui o arquivo config(arquivo de conexão com o banco de dados)
include_once("globals.php");
require("db.php");
include_once("models/acomodacao.php");
include_once("dao/acomodacaoDao.php");
include_once("dao/hospitalDao.php");
include_once("templates/header.php");


# seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
?>
<div class="container-fluid py-1">
    <h3 class="page-title">Relação Acomodações</h3>
    <hr>
    <div class="menu_pesquisa">
        <form method="post">
            <input type="text" name="pesquisa_hosp" id="pesquisa_hosp" placeholder="Pesquisa por acomodacao">
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Buscar</button>
        </form>

        <?php
        $pesquisa_hosp = filter_input(INPUT_POST, "pesquisa_hosp");
        ?>
    </div>
    <?php
    if (!$pesquisa_hosp) {
        $sql = "SELECT ac.id_acomodacao, ac.valor_aco, ac.acomodacao_aco, ho.id_hospital, ho.nome_hosp
        FROM tb_acomodacao ac 
        iNNER JOIN tb_hospital as ho On  
        ac.fk_hospital = ho.id_hospital LIMIT " . $inicio . ", " . $limite;
    } else {
        $sql = "SELECT * FROM tb_hospital WHERE nome_hosp like '$pesquisa_hosp%'";
    }

    try {

        $query = $conn->prepare($sql);
        $query->execute();
    } catch (PDOexception $error_sql) {

        echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
    }
    ?>
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
            <?php
            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                <tbody>
                    <?php
                    foreach ($query  as $acomod) :
                        extract($acomod);
                    ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $acomod["id_acomodacao"] ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $acomod["acomodacao_aco"] ?></td>
                            <td scope="row" class="nome-coluna-table">R$ <?= number_format($acomod["valor_aco"], 2, ",", ".")  ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $acomod["nome_hosp"] ?></td>
                            <td class="action">
                                <a href="cad_acomodacao.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                                <a href="<?= $BASE_URL ?>show_acomodacao.php?id_acomodacao=<?= $acomod["id_acomodacao"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                                <a href="<?= $BASE_URL ?>edit_acomodacao.php?id_acomodacao=<?= $acomod["id_acomodacao"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                                <a href="<?= $BASE_URL ?>del_acomodacao.php?id_acomodacao=<?= $acomod["id_acomodacao"] ?>"><i style="color:red; margin-left:10px" name="type" value="delete" class="aparecer-acoes fas bi bi-x-square-fill  delete-icon"></i></a>

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
    <?php $id_acomodacao = filter_input(INPUT_GET, "id_acomodacao"); ?>

    <div class="btn_acoes oculto">
        <p>Deseja deletar este acomodacao: <?php $acomodacao['nome'] ?> ?</p>
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
            echo " <li class='page-item'><a class='page-link' href='list_acomodacao.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
            if ($qtdPag > 1 && $pg <= $qtdPag) {

                for ($i = 1; $i <= $qtdPag; $i++) {

                    if ($i == $pg) {

                        echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
                    } else {

                        echo "<li class='page-item '><a class='page-link' href='list_acomodacao.php?pg=$i'>" . $i . "</a></li>";
                    }
                }
            }
            echo "<li class='page-item'><a class='page-link' href='list_acomodacao.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
            echo " </ul>";
            echo "</nav>";
            echo "</div>";



?>