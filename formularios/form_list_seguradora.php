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
    $pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
    $limite = filter_input(INPUT_GET, 'limite') ? filter_input(INPUT_GET, 'limite') : 10;
    $ordenar = filter_input(INPUT_GET, 'ordenar') ? filter_input(INPUT_GET, 'ordenar') : 1;
    // $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";

    $condicoes = [
        strlen($pesquisa_nome) ? 'seguradora_seg LIKE "%' . $pesquisa_nome . '%"' : null,
        // strlen($buscaAtivo) ? 'ativo_seg = "' . $buscaAtivo . '"' : null
    ];
    $condicoes = array_filter($condicoes);

    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE SEGURADORAS
    $order = $ordenar;

    $qtdSegItens1 = $QtdTotalSeg->QtdSeguradora($where);

    $qtdSegItens = ($qtdSegItens1['qtd']);
    $totalcasos = ceil($qtdSegItens / $limite);

    // PAGINACAO
    $obPagination = new pagination($qtdSegItens, $_GET['pag'] ?? 1, $limite ?? 10);
    $obLimite = $obPagination->getLimit();

    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $query = $seguradora->selectAllSeguradora($where, $order, $limite);

    ?>

    <!--tabela evento-->
    <div class="container py-2">
        <div class="row" style="background-color: #d3d3d3">
            <form class="formulario" id="form_pesquisa" method="GET">
                <div class="form-group row">
                    <h6 class="page-title" style="margin-top:10px">Selecione itens para efetuar Pesquisa</h6>
                    <div class="form-group col-sm-2 ">
                        <label>Pesquisa por nome</label>

                        <input type="text" name="pesquisa_nome" style="margin-top:10px; border:0rem" id="pesquisa_nome" value="<?= $busca ?>" placeholder="Pesquisa por seguradora">
                    </div>

                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Limite</label>
                        <select class="form-control mb-3" id="limite" name="limite">
                            <option value="">Reg por página</option>
                            <option value="5" <?= $limite == '5' ? 'selected' : null ?>>5</option>
                            <option value="10" <?= $limite == '10' ? 'selected' : null ?>>10</option>
                            <option value="20" <?= $limite == '20' ? 'selected' : null ?>>20</option>
                            <option value="50" <?= $limite == '50' ? 'selected' : null ?>>50</option>
                        </select>
                    </div>
                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Classificar</label>
                        <select class="form-control mb-3" id="ordenar" name="ordenar">
                            <option value="">Classificar por</option>
                            <option value="id_seguradora" <?= $ordenar == 'id_seguradora' ? 'selected' : null ?>>Id Seguradora</option>
                            <option value="seguradora_seg" <?= $ordenar == 'seguradora_seg' ? 'selected' : null ?>>Seguradora</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-1" style="margin:0px 0px 10px 5px">
                    <button type="submit" class="btn btn-primary mb-1">Buscar</button>
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
            $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
            $paginacao .= '<li class="page-item"><a href="?pag=' . $pagina['pg'] . '&' . $gets . '"> 
                <button type="button" class="btn ' . $class . '">' . $pagina['pg'] . '</button>
                <li class="page-item"></a>';
        };
        ?>
    </div>
    <div class="container">
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

        "<div style=margin-left:20px;>";
        echo "<div style='color:blue; margin-left:20px;'>";
        echo "</div>";
        echo "<nav aria-label='Page navigation example'>";
        echo " <ul class='pagination'>";
        echo " <li class='page-item'><a class='page-link' href='list_seguradora.php?pag=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>"; ?>
        <?= $paginacao ?>
        <?php echo "<li class='page-item'><a class='page-link' href='list_seguradora.php?pag=$totalcasos&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
        echo " </ul>";
        echo "</nav>";
        echo "</div>";
        ?>

        <div id="id-confirmacao" class="btn_acoes oculto">
            <p>Deseja deletar este hospital: <?= $hospital_ant ?>?</p>
            <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
        </div>
        <div>
            <hr>
            <a class="btn btn-success styled" style="margin-left:120px" href="cad_seguradora.php">Nova seguradora</a>
        </div>
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
        window.location = "<?= $BASE_URL ?>del_seguradora.php?id_seguradora=<?= $id_seguradora ?>";
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