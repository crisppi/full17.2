<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
    include_once("globals.php");
    include_once("models/seguradora.php");
    include_once("models/message.php");
    include_once("dao/seguradoraDao.php");
    include_once("templates/header.php");
    include_once("array_dados.php");

    //Instanciando a classe
    $seguradora = new seguradoraDAO($conn, $BASE_URL);
    $QtdTotalSeg = new seguradoraDAO($conn, $BASE_URL);

    // METODO DE BUSCA DE PAGINACAO
    $busca = filter_input(INPUT_GET, 'pesquisa_nome');
    $buscaAtivo = filter_input(INPUT_GET, 'ativo_seg');
    // $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";

    $condicoes = [
        strlen($busca) ? 'seguradora_seg LIKE "%' . $busca . '%"' : null,
        strlen($buscaAtivo) ? 'ativo_seg = "' . $buscaAtivo . '"' : null
    ];
    $condicoes = array_filter($condicoes);

    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE SEGURADORAS
    $qtdSegItens1 = $QtdTotalSeg->QtdSeguradora($where);

    $qtdSegItens = ($qtdSegItens1['0']);
    // PAGINACAO
    $obPagination = new pagination($qtdSegItens, $_GET['pag'] ?? 1, 10);
    $obLimite = $obPagination->getLimit();

    ?>

    <!--tabela evento-->
    <div class="container py-2">

        <div class="row" style="background-color: #d3d3d3">
            <form class="formulario" id="form_pesquisa" method="GET">
                <div class="form-group row">
                    <h6 class="page-title" style="margin-top:10px">Selecione itens para efetuar Pesquisa</h6>
                    <div class="form-group col-sm-2 ">
                        <input type="text" name="pesquisa_nome" style="margin-top:10px; border:0rem" id="pesquisa_nome" value="<?= $busca ?>" placeholder="Pesquisa por seguradora">
                    </div>
                    <div class="form-group col-sm-3 d-flex align-itens-end">
                        <select class="form-control mb-3" id="ativo_seg" name="ativo_seg">
                            <option value="">Busca por Ativos</option>
                            <option value="s" <?= $ativo_seg == 's' ? 'selected' : null ?>>Sim</option>
                            <option value="n" <?= $ativo_seg == 'n' ? 'selected' : null ?>>Não</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-1 d-flex align-itens-end">
                        <button style="margin:10px; font-weight:600" type="submit" class="btn-sm btn-light">Pesquisar</button>
                    </div>
                </div>
            </form>

            <?php

            // PREENCHIMENTO DO FORMULARIO COM QUERY
            $query = $seguradora->selectAllSeguradora($where, $order, $obLimite);

            // GETS 
            unset($_GET['pag']);
            unset($_GET['pg']);
            $gets = http_build_query($_GET);

            // PAGINACAO
            $paginacao = '';
            $paginas = $obPagination->getPages();

            foreach ($paginas as $pagina) {
                // $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
                $paginacao .= '<a href="?pag=' . $pagina['pag'] . '&' . $gets . '"> 
                <button type="button" class="btn ' . $class . '">' . $pagina['pag'] . '</button>
                </a>';
            };
            ?>
        </div>
        <div>
            <h4 class="page-title">Relação de Seguradoras</h4>
        </div>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">seguradora</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //TABELA
                foreach ($query as $seguradora) :
                    extract($seguradora);
                ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $id_seguradora ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $seguradora_seg ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $endereco_seg ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $cidade_seg ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $ativo_seg ?></td>

                        <td class="action">
                            <!-- <a href="cad_seguradora.php"><i name="type" value="create" style="color:green; margin-right:10px" class="bi bi-plus-square-fill edit-icon"></i></a> -->
                            <a href="<?= $BASE_URL ?>show_seguradora.php?id_seguradora=<?= $id_seguradora ?>"><i style="color:green; margin-right:10px" class="fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>edit_seguradora.php?id_seguradora=<?= $id_seguradora ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_seguradora.php?id_seguradora=<?= $id_seguradora ?>"><i style="color:red; margin-left:10px" name="type" value="edite" class="d-inline-block bi bi-x-square-fill delete-icon"></i></a>
                            <div id="info"></div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php
        //modo cadastro
        $formData = "0";
        $formData = filter_input_array(INPUT_GET, FILTER_DEFAULT);

        // PAGINACAO MODELO ANTERIOR
        if ($formData !== "0") {
            $_SESSION['msg'] = "<p style='color: green;'>seguradora cadastrado com sucesso!</p>";
            //header("Location: index.php");
        } else {
            echo "<p style='color: #f00;'>Erro: seguradora não cadastrado!</p>";
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
        echo "<div style=margin-left:0px;>";
        echo "<div style='color:blue; margin-top:20px;'>";
        echo "</div>";
        echo "<nav aria-label='Page navigation example'>";
        echo " <ul class='pagination'>";
        echo " <li class='page-item'><a class='page-link' href='list_seguradora.php?pg=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>";
        if ($qtdPag > 1 && $pg <= $qtdPag) {
            for ($i = 1; $i <= $qtdPag; $i++) {
                if ($i == $pg) {
                    echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
                } else {
                    echo "<li class='page-item '><a class='page-link' href='list_seguradora.php?pg=$i&" . $gets . "'>" . $i . "</a></li>";
                }
            }
        }
        echo "<li class='page-item'><a class='page-link' href='list_seguradora.php?pg=$qtdPag&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
        echo " </ul>";
        echo "</nav>";
        echo "</div>"; ?>

        <div id="id-confirmacao" class="btn_acoes oculto">
            <p>Deseja deletar este hospital: <?= $hospital_ant ?>?</p>
            <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
        </div>
    </div>


    <div>
        <hr>
        <a class="btn btn-success styled" style="margin-left:120px" href="cad_seguradora.php">Nova seguradora</a>
    </div>
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
        window.location = "<?= $BASE_URL ?>del_antecedente.php?id_antecedente=<?= $id_antecedente ?>";
    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");

    };
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>