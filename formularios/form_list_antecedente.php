<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
    include_once("globals.php");
    include_once("models/antecedente.php");
    include_once("dao/antecedenteDao.php");
    include_once("templates/header.php");

    //Instanciando a classe
    //Criado o objeto $listarantecedentes
    $antecedente_geral = new antecedenteDAO($conn, $BASE_URL);

    //Instanciar o metodo listar antecedente
    $antecedentes = $antecedente_geral->findGeral();
    ?>

    <!--tabela antecedente-->
    <div class="container-fluid py-2">
        <h2 class="page-title">Relação antecedente</h2>
        <div class="menu_pesquisa">
            <form id="form_pesquisa" method="POST">
                <input type="text" name="pesquisa_antec" id="pesquisa_antec" placeholder="Pesquisa por antecedente">
                <input type="hidden" name="pesquisa" id="pesquisa" value="sim">
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

                                <!-- <a name="type" id="delete-btn" value="delete" href="" . data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> -->

                                <form class=" d-inline-block delete-form" action="tratar.php" id="minhaForm">
                                    <input type="text" name="type" id="type" value="delete">
                                    <input type="text" name="confirmado" id="confirmado" value="nao">
                                    <input type="text" name="id_antecedente" id="id_antecedente" value="<?= $id_antecedente ?>">
                                    <div><button type="submit" id="data-confirm" href="tratar.php" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class="d-inline-block bi bi-x-square-fill delete-icon"></i></button></div>
                                </form>

                                <div id="info"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="id-confirmacao" class="btn_acoes oculto">
                <p>Deseja deletar este antecedente: <?= $antecedente["antecedente_ant"] ?>?</p>
                <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
                <button class="btn btn-danger styled" href="<?= $BASE_URL ?>del_antecedente.php?id_antecedente=<?= $formId_capt ?>" onclick=deletar() value="<?= $antecedente["id_antecedente"] ?>" type="button" id="deletar-btn" name="deletar  ">Deletar</button>

            </div>
            <div>

                <script>
                    $formId_capt = "";
                    console.log(echo(" voce pegou este ID".$formId_capt))
                </script>

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

<script>
    function apareceOpcoes() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'block';
    }

    function deletar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        window.location.href = "process_antecedente.php?id_antecedente="
            .<?= $formId_capt ?>;
    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");

    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
    src = "js/script.js"
</script>