<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
    include_once("globals.php");
    include_once("models/hospital.php");
    include_once("dao/hospitalDao.php");
    include_once("templates/header.php");

    //Instanciando a classe
    //Criado o objeto $listarhospitals
    $hospital_geral = new hospitalDAO($conn, $BASE_URL);

    //Instanciar o metodo listar hospital
    $hospitals = $hospital_geral->findGeral();
    ?>

    <!--tabela hospital-->
    <div class="container-fluid py-2">
        <h4 class="page-title">Relação de hospitals</h4>


        <div class="menu_pesquisa">
            <form id="form_pesquisa" method="POST">
                <input type="text" name="pesquisa_hosp" id="pesquisa_hosp" placeholder="Pesquisa por hospital">
                <input type="hidden" name="pesquisa" id="pesquisa" value="sim">
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
            $sql = "SELECT * FROM tb_hospital WHERE nome_hosp like '$pesquisa_hosp%' ORDER BY nome_hosp desc";
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
                        <th scope="col">hospital</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($query  as $hospital) :
                        extract($hospital);
                    ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $id_hospital ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $nome_hosp ?></td>

                            <td class="action">
                                <a href="cad_hospital.php"><i name="type" value="create" style="color:green; margin-right:10px" class="bi bi-plus-square-fill edit-icon"></i></a>
                                <a href="<?= $BASE_URL ?>show_hospital.php?id_hospital=<?= $id_hospital ?>"><i style="color:orange; margin-right:10px" class="fas fa-eye check-icon"></i></a>

                                <a href="<?= $BASE_URL ?>edit_hospital.php?id_hospital=<?= $id_hospital ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                                <a href="<?= $BASE_URL ?>show_hospital.php?id_hospital=<?= $id_hospital ?>"><i style="color:red; margin-left:10px" name="type" value="edite" class="d-inline-block bi bi-x-square-fill delete-icon"></i></a>

                                <div id="info"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="id-confirmacao" class="btn_acoes oculto">
                <p>Deseja deletar este hospital: <?= $hospital_ant ?>?</p>
                <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
                <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
            </div>
    </div>

<?php }

        //modo cadastro
        $formData = "0";
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($formData !== "0") {
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
        echo "</div>"; ?>
</body>

<script>
    function apareceOpcoes() {
        $('#deletar-btn').val('nao');
        let mudancaStatus = ($('#deletar-btn').val())
        console.log(mudancaStatus);
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'block';
    }

    function deletar() {
        $('#deletar-btn').val('ok');
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        let mudancaStatus = ($('#deletar-btn').val())
        console.log(mudancaStatus);
        window.location = "<?= $BASE_URL ?>del_hospital.php?id_hospital=<?= $id_hospital ?>";
    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");

    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>