<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
    include_once("globals.php");
    include_once("models/antecedente.php");
    include_once("dao/antecedenteDao.php");
    include_once("templates/header.php");

    //Instanciando a classe
    $antecedente = new antecedenteDAO($conn, $BASE_URL);
    $QtdTotalant = new antecedenteDAO($conn, $BASE_URL);

    // METODO DE BUSCA DE PAGINACAO
    $busca = filter_input(INPUT_GET, 'pesquisa_antec');
    $limite = filter_input(INPUT_GET, 'limite') ? filter_input(INPUT_GET, 'limite') : 10;
    $ordenar = filter_input(INPUT_GET, 'ordenar') ? filter_input(INPUT_GET, 'ordenar') : 1;
    // $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";

    $condicoes = [
        strlen($busca) ? 'antecedente_ant LIKE "%' . $busca . '%"' : null,
    ];
    $condicoes = array_filter($condicoes);

    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE antecedenteS
    $qtdantItens1 = $QtdTotalant->Qtdantecedente($where);

    $qtdantItens = ($qtdantItens1['qtd']);
    $totalcasos = ceil($qtdantItens / $limite);

    // PAGINACAO
    $obPagination = new pagination($qtdantItens, $_GET['pag'] ?? 1, $limite ?? 10);
    $obLimite = $obPagination->getLimit();
    $order = $ordenar;

    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $query = $antecedente->selectAllantecedente($where, $order, $obLimite);

    ?>

    <!--tabela antecedente-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="container py-2">
        <h4 class="page-title">Relação de antecedentes</h4>

        <div class="menu_pesquisa">
            <form class="formulario" id="form_pesquisa" method="GET">
                <div style="margin-left:20px" class="form-group row">
                    <div class="form-group col-sm-3">
                        <label style="margin-left: 5px;">Pesquisa por Antecedente</label>
                        <input type="text" value="<?= $busca ?>" class="form-control" name="pesquisa_antec" id="pesquisa_antec" autofocus placeholder="Digite o antecedente">
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
                            <option value="id_antecedente" <?= $ordenar == 'id_antecedente' ? 'selected' : null ?>>Id Antecedente</option>
                            <option value="antecedente_ant" <?= $ordenar == 'antecedente_ant' ? 'selected' : null ?>>Antecedente</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-1" style="margin:20px 0px 10px 60px">
                        <button type="submit" class="btn btn-primary mb-1"><span class="material-icons">
                                person_search
                            </span></button>
                    </div>
            </form>
        </div>

    </div>
    <?php
    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $query = $antecedente->selectAllAntecedente($where, $order, $obLimite);

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
                    <td scope="row" class="col-id"><?= $id_antecedente ?></td>
                    <td scope="row" class="nome-coluna-table"><?= $antecedente_ant ?></td>

                    <td class="action">
                        <a href="<?= $BASE_URL ?>show_antecedente.php?id_antecedente=<?= $id_antecedente ?>"><i style="color:green; margin-right:10px" class="fas fa-eye check-icon"></i></a>

                        <a href="<?= $BASE_URL ?>edit_antecedente.php?id_antecedente=<?= $id_antecedente ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                        <a href="<?= $BASE_URL ?>show_antecedente.php?id_antecedente=<?= $id_antecedente ?>"><i style="color:red; margin-left:10px" name="type" value="delete-ant" class="d-inline-block bi bi-x-square-fill delete-icon"></i></a>

                        <!-- <form class="d-inline-block delete-form" action="del_internacao.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_internacao" value="<?= $intern["id_internacao"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                            </form> -->
                        <div id="info"></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <?php

        "<div style=margin-left:20px;>";
        echo "<div style='color:blue; margin-left:20px;'>";
        echo "</div>";
        echo "<nav aria-label='Page navigation example'>";
        echo " <ul class='pagination'>";
        echo " <li class='page-item'><a class='page-link' href='list_antecedente.php?pag=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>"; ?>
        <?= $paginacao ?>
        <?php echo "<li class='page-item'><a class='page-link' href='list_antecedente.php?pag=$totalcasos&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
        echo " </ul>";
        echo "</nav>";
        echo "</div>"; ?>
        <hr>
    </div>

    <div id="id-confirmacao" class="btn_acoes oculto">
        <p>Deseja deletar este antecedente: <?= $antecedente_ant ?>?</p>
        <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
        <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
    </div>
    <div>
        <hr>
        <a class="btn btn-success styled" style="margin-left:120px" href="cad_antecedente.php">Novo Antecedente</a>
    </div>
    <?php

    ?>
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
        window.location = "<?= $BASE_URL ?>process_antecedente.php?id_antecedente=<?= $id_antecedente ?>";
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