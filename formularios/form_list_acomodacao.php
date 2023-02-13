<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
    include_once("globals.php");
    include_once("models/acomodacao.php");
    include_once("models/message.php");
    include_once("dao/acomodacaoDao.php");
    include_once("templates/header.php");
    include_once("array_dados.php");

    //Instanciando a classe
    $acomodacao = new acomodacaoDAO($conn, $BASE_URL);
    $QtdTotalaco = new acomodacaoDAO($conn, $BASE_URL);

    // METODO DE BUSCA DE PAGINACAO
    $pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
    $limite = filter_input(INPUT_GET, 'limite') ? filter_input(INPUT_GET, 'limite') : 10;
    $ordenar = filter_input(INPUT_GET, 'ordenar') ? filter_input(INPUT_GET, 'ordenar') : 1;
    // $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";

    $condicoes = [
        strlen($pesquisa_nome) ? 'acomodacao_aco LIKE "%' . $pesquisa_nome . '%"' : null,
        // strlen($buscaAtivo) ? 'ativo_aco = "' . $buscaAtivo . '"' : null
    ];
    $condicoes = array_filter($condicoes);

    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE acomodacaoS
    $order = $ordenar;

    $qtdacoItens1 = $QtdTotalaco->Qtdacomodacao($where);

    $qtdacoItens = ($qtdacoItens1['qtd']);
    $totalcasos = ceil($qtdacoItens / $limite);

    // PAGINACAO
    $obPagination = new pagination($qtdacoItens, $_GET['pag'] ?? 1, $limite ?? 10);
    $obLimite = $obPagination->getLimit();

    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $query = $acomodacao->selectAllacomodacao($where, $order, $limite);

    ?>

    <!--tabela evento-->
    <div class="container py-2">

        <div class="row" style="background-color: #d3d3d3">
            <form class="formulario" id="form_pesquisa" method="GET">
                <div class="form-group row">
                    <h6 class="page-title" style="margin-top:10px">Selecione itens para efetuar Pesquisa</h6>
                    <div class="form-group col-sm-2 ">
                        <label>Pesquisa por nome</label>

                        <input type="text" name="pesquisa_nome" style="margin-top:10px; border:0rem" id="pesquisa_nome" value="<?= $busca ?>" placeholder="Pesquisa por acomodacao">
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
                            <option value="id_acomodacao" <?= $ordenar == 'id_acomodacao' ? 'selected' : null ?>>Id Acomodação</option>
                            <option value="acomodacao_aco" <?= $ordenar == 'acomodacao_aco' ? 'selected' : null ?>>Acomodação</option>
                            <option value="nome_hosp" <?= $ordenar == 'nome_hosp' ? 'selected' : null ?>>Hospital</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-1" style="margin:0px 0px 10px 30px">
                        <button type="submit" class="btn btn-primary mb-1">Buscar</button>
                    </div>
                </div>
            </form>

            <?php

            // PREENCHIMENTO DO FORMULARIO COM QUERY

            $query = $acomodacao->selectAllacomodacao($where, $order, $obLimite);

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
        <div>
            <h4 class="page-title">Relação de acomodacaos</h4>
        </div>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Acomodação</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //TABELA
                foreach ($query as $acomodacao) :
                    extract($acomodacao);
                ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $id_acomodacao ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $nome_hosp ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $acomodacao_aco ?></td>
                        <td scope="row" class="nome-coluna-table">R$ <?= number_format($valor_aco, 2, ",", ".") ?></td>

                        <td class="action">
                            <a href="<?= $BASE_URL ?>show_acomodacao.php?id_acomodacao=<?= $id_acomodacao ?>"><i style="color:green; margin-right:10px" class="fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>edit_acomodacao.php?id_acomodacao=<?= $id_acomodacao ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_acomodacao.php?id_acomodacao=<?= $id_acomodacao ?>"><i style="color:red; margin-left:10px" name="type" value="edite" class="d-inline-block bi bi-x-square-fill delete-icon"></i></a>
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
        echo " <li class='page-item'><a class='page-link' href='list_paciente.php?pag=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>"; ?>
        <?= $paginacao ?>
        <?php echo "<li class='page-item'><a class='page-link' href='list_paciente.php?pag=$totalcasos&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
        echo " </ul>";
        echo "</nav>";
        echo "</div>";
        ?>

        <div id="id-confirmacao" class="btn_acoes oculto">
            <p>Deseja deletar este hospital: <?= $acomodacao_aco ?>?</p>
            <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
        </div>
    </div>


    <div>
        <hr>
        <a class="btn btn-success styled" style="margin-left:120px" href="cad_acomodacao.php">Nova acomodacao</a>
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
        window.location = "<?= $BASE_URL ?>del_acomodacao.php?id_acomodacao=<?= $id_acomodacao ?>";
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