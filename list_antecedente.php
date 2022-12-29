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
    include_once("models/antecedente.php");
    include_once("dao/antecedenteDao.php");
    include_once("templates/header.php");
    ?>
    <?php
    //Instanciando a classe
    //Criado o objeto $listarantecedentes
    $antecedente_geral = new antecedenteDAO($conn, $BASE_URL);

    //Instanciar o metodo listar antecedente
    $antecedentes = $antecedente_geral->findGeral();
    //var_dump($antecedentes);
    ?>

    <!--tabela antecedente-->

    <div class="container-fluid py-5">
        <h2 class="page-title">Relação antecedente</h2>
        <div class="menu_pesquisa">
            <form method="post">
                <input type="text" name="pesquisa_antec" id="pesquisa_antec" placeholder="Pesquisa por antecedente">
                <button style="margin:10px" type="submit" class="btn-sm btn-info">Buscar</button>
            </form>

            <?php
            $pesquisa_antec = filter_input(INPUT_POST, "pesquisa_antec");
            ?>
        </div>
        <?php
        if (!$pesquisa_antec) {
            $sql = "SELECT * FROM tb_antecedente ORDER BY id_antecedente ASC LIMIT " . $inicio . ", " . $limite;
        } else {
            $sql = "SELECT * FROM tb_antecedente WHERE antecedente_ant like '$pesquisa_antec%' ORDER BY antecedente_ant desc";
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
                        <th scope="col">antecedente</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($query  as $antecedente) :
                        extract($antecedente);
                    ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $antecedente["id_antecedente"] ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $antecedente["antecedente_ant"] ?></td>

                            <td class="action">
                                <a href="cad_antecedente.php"><i name="type" value="create" style="color:green; margin-right:10px" class="bi bi-plus-square-fill edit-icon"></i></a>
                                <a href="<?= $BASE_URL ?>show_antecedente.php?id_antecedente=<?= $antecedente["id_antecedente"] ?>"><i style="color:orange; margin-right:10px" class="fas fa-eye check-icon"></i></a>

                                <a href="<?= $BASE_URL ?>edit_antecedente.php?id_antecedente=<?= $antecedente["id_antecedente"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                                <a name="type" id="delete-btn" value="delete" href="" . data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>

                                <form class=" d-inline-block delete-form" onclick=mudar() action="#" method="POST">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id_antecedente" value="<?= $antecedente["id_antecedente"] ?>">
                                    <button type="button" id="data-confirm" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class="d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="id-confirmacao" class="btn_acoes oculto">
                <p>Deseja deletar este antecedente: <?= $antecedente["antecedente_ant"] ?>?</p>
                <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
                <button class="btn btn-danger styled" href="" onclick=deletar() value="<?= $antecedente["id_antecedente"] ?>" type="button" id="deletar-btn" name="deletar  ">Deletar</button>
                <a name="type" onclick=deletar() id="deletar" value="delete" href="">Apagar</a>

            </div>
    </div>

<?php }

        //modo cadastro
        $formData = "0";
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($formData != "0") {
            $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
            //header("Location: index.php");
        } else {
            echo "<p style='color: #f00;'>Erro: Usuário não cadastrado!</p>";
        };


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
        echo " <li class='page-item'><a class='page-link' href='list_antecedente.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
        if ($qtdPag > 1 && $pg <= $qtdPag) {
            for ($i = 1; $i <= $qtdPag; $i++) {
                if ($i == $pg) {
                    echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
                } else {
                    echo "<li class='page-item '><a class='page-link' href='list_antecedente.php?pg=$i'>" . $i . "</a></li>";
                }
            }
        }
        echo "<li class='page-item'><a class='page-link' href='list_antecedente.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
        echo " </ul>";
        echo "</nav>";
        echo "</div>"; ?>

</body>
<?php
include_once("templates/footer1.php");
?>
<script>
    function mudar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'block';
        console.log("chegou");
    }

    function deletar() {
        console.log("chegou no delete");
        // $('#deletar-btn').attr('href', '<?= $BASE_URL ?>del_antecedente.php?id_antecedente=<?= $antecedente["id_antecedente"] ?>');
        console.log($('#deletar-btn').attr('href'));
        console.log($('#deletar-btn').attr('href'))
        let varIdAntec = console.log($('#deletar-btn').attr("value"));
        console.log(varIdAntec)
    };

    $(document).ready(function() {
        $("#deletar").click(function(event) {
            event.preventDefault();
            $('#delete-btn').attr('href', 'google.com')

        });
    });

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");

    };
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

</html>