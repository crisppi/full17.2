<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <?php
    include_once("globals.php");

    include_once("models/hospitalUser.php");
    include_once("dao/hospitalUserDao.php");

    include_once("models/message.php");

    include_once("templates/header.php");

    include_once("array_dados.php");

    include_once("models/pagination.php");

    //Instanciando a classe 
    $hospitalUser = new hospitalUserDAO($conn, $BASE_URL);
    // $QtdTotalHosp = new hospitalUserDAO($conn, $BASE_URL);

    // // METODO DE BUSCA DE PAGINACAO
    $busca = filter_input(INPUT_GET, 'pesquisa_nome');
    $buscaAtivo = filter_input(INPUT_GET, 'ativo_pac');
    $limite = filter_input(INPUT_GET, 'limite') ? filter_input(INPUT_GET, 'limite') : 10;
    $ordenar = filter_input(INPUT_GET, 'ordenar') ? filter_input(INPUT_GET, 'ordenar') : 1;
    $QtdTotalhosp = new hospitalUserDAO($conn, $BASE_URL);
    // $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";

    $condicoes = [
        strlen($busca) ? 'nome_pac LIKE "%' . $busca . '%"' : null,
        strlen($buscaAtivo) ? 'ativo_pac = "' . $buscaAtivo . '"' : null
    ];
    $condicoes = array_filter($condicoes);
    $order = $ordenar;
    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // // QUANTIDADE hospitalUserS
    $qtdHospItens1 = $QtdTotalhosp->QtdhospitalUser($where);
    $qtdHospItens = ($qtdHospItens1['qtd']);
    $totalcasos = ceil($qtdHospItens / $limite);

    // PAGINACAO
    $obPagination = new pagination($qtdHospItens, $_GET['pag'] ?? 1,  $limite ?? 10);
    $obLimite = $obPagination->getLimit();

    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $id_usuario = 5;
    $query = $hospitalUser->selectAllhospitalUser($where, $order, $limite);

    ?>
    <div class="container py-2">
        <div class="row" style="background-color: #d3d3d3">
            <form class="formulario" id="form_pesquisa" method="GET">
                <div class="form-group row">
                    <h6 class="page-title" style="margin-top:10px border:0em;">Selecione itens para efetuar Pesquisa</h6>
                    <div class="form-group col-sm-3">
                        <label style="margin-left: 30px;">Pesquisa por Hospital</label>
                        <input style="margin-left: 30px;" class="form-control" type="text" name="pesquisa_nome" placeholder="Selecione o Hospital" value="">
                    </div>
                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Limite</label>
                        <select class="form-control mb-3" style="font-size:0.6em" id="limite" name="limite">
                            <option value="">Reg por página</option>
                            <option value="5" <?= $limite == '5' ? 'selected' : null ?>>5</option>
                            <option value="10" <?= $limite == '10' ? 'selected' : null ?>>10</option>
                            <option value="20" <?= $limite == '20' ? 'selected' : null ?>>20</option>
                            <option value="50" <?= $limite == '50' ? 'selected' : null ?>>50</option>
                        </select>
                    </div>
                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Classificar</label>
                        <select class="form-control mb-3" style="font-size:0.6em" id="ordenar" name="ordenar">
                            <option value="">Classificar por</option>
                            <option value="id_hospitalUser" <?= $ordenar == 'id_hospitalUser' ? 'selected' : null ?>>Id Internação</option>
                            <option value="nome_hosp" <?= $ordenar == 'nome_hosp' ? 'selected' : null ?>>hospitalUser</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-1" style="padding:0px 50px 30px 50px">
                        <button style="margin:10px; font-weight:400" type="submit" class="btn-sm btn-primary">Pesquisar</button>
                    </div>
                </div>
            </form>

            <?php
            // PREENCHIMENTO DO FORMULARIO COM QUERY
            // $query = $hospitalUser->joinHospitalUser($id_usuario);

            // GETS 
            unset($_GET['pag']);
            unset($_GET['pg']);
            $gets = http_build_query($_GET);

            // // PAGINACAO
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
            <h4 class="page-title">Relação de hospitalUsers</h4>
        </div>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($query as $hospitalUserSel) :
                    extract($hospitalUserSel);
                ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $id_hospitalUser ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $nome_hosp ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $usuario_user ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $cargo_user ?></td>

                        <td class="action">
                            <!-- <a href="cad_hospitalUser.php"><i name="type" value="create" style="color:green; margin-right:10px" class="bi bi-plus-square-fill edit-icon"></i></a> -->
                            <a href="<?= $BASE_URL ?>show_hospitalUser.php?id_hospitalUser=<?= $id_hospitalUser ?>"><i style="color:green; margin-right:10px" class="fas fa-eye check-icon"></i></a>

                            <a href="<?= $BASE_URL ?>edit_hospitalUser.php?id_hospitalUser=<?= $id_hospitalUser ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                            <a href="<?= $BASE_URL ?>show_hospitalUser.php?id_hospitalUser=<?= $id_hospitalUser ?>"><i style="color:red; margin-left:10px" name="type" value="edite" class="d-inline-block bi bi-x-square-fill delete-icon"></i></a>

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
        echo " <li class='page-item'><a class='page-link' href='list_hospitalUser.php?pag=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>"; ?>
        <?= $paginacao ?>
        <?php echo "<li class='page-item'><a class='page-link' href='list_hospitalUser.php?pag=$totalcasos&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
        echo " </ul>";
        echo "</nav>";
        echo "</div>"; ?>
        <hr>
    </div>
    <div id="id-confirmacao" class="btn_acoes oculto">
        <p>Deseja deletar este hospitalUser: ?</p>
        <button class="btn btn-success styled" onclick=cancelar() type="button" id="cancelar" name="cancelar">Cancelar</button>
        <button class="btn btn-danger styled" onclick=deletar() value="default" type="button" id="deletar-btn" name="deletar">Deletar</button>
    </div>
    <div>
    </div>
    </div>


    <div>
        <hr>
        <a class="btn btn-success styled" style="margin-left:120px" href="cad_hospitalUser.php">Novo hospitalUser</a>
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
        window.location = "<?= $BASE_URL ?>del_evento.php?id_evento=<?= $id_evento ?>";
    };

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        console.log("chegou no cancelar");
        idAcoes.style.display = 'none';

    };
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js";
</script>