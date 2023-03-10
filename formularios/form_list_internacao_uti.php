    <?php

    require_once("templates/header.php");

    // require_once("models/message.php");

    include_once("models/internacao.php");
    include_once("dao/internacaoDao.php");

    include_once("models/patologia.php");
    include_once("dao/patologiaDao.php");

    include_once("models/paciente.php");
    include_once("dao/pacienteDao.php");

    include_once("models/hospital.php");
    include_once("dao/hospitalDao.php");

    include_once("models/uti.php");
    include_once("dao/utiDao.php");

    include_once("models/pagination.php");

    $where = null;
    $internacao_geral = new internacaoDAO($conn, $BASE_URL);
    $internacaos = $internacao_geral->findGeral($where, $limite, $inicio);

    $pacienteDao = new pacienteDAO($conn, $BASE_URL);
    $pacientes = $pacienteDao->findGeral($limite, $inicio);

    $hospital_geral = new hospitalDAO($conn, $BASE_URL);
    $hospitals = $hospital_geral->findGeral($limite, $inicio);

    $patologiaDao = new patologiaDAO($conn, $BASE_URL);
    $patologias = $patologiaDao->findGeral();

    $internacao = new internacaoDAO($conn, $BASE_URL);

    $uti = new utiDAO($conn, $BASE_URL);

    ?>
    <!-- FORMULARIO DE PESQUISAS -->
    <div class="container">
        <h2 class="page-title">Internação UTI</h2>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <div>
            <form class="formulario visible" action="" id="select-internacao-form" method="GET">
                <h6 style="margin-left: 10px; padding-top:10px" class="page-title">Pesquisa internações</h6>
                <?php $pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
                $pesqInternado = filter_input(INPUT_GET, 'pesqInternado');
                $limite_pag = filter_input(INPUT_GET, 'limite_pag');
                $pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
                $ordenar = filter_input(INPUT_GET, 'ordenar');
                ?>
                <div class="form-group row">
                    <div class="form-group col-sm-2">
                        <label>Pesquisa por Hospital</label>
                        <input class="form-control" type="text" name="pesquisa_nome" placeholder="Selecione o Hospital" autofocus value="<?= $pesquisa_nome ?>">
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Pesquisa por Paciente</label>

                        <input class="form-control" type="text" name="pesquisa_pac" placeholder="Selecione o Paciente" value="<?= $pesquisa_pac ?>">
                    </div>

                    <div style="margin-left:20px" class="form-group col-sm-2">
                        <label>Internados</label>
                        <select class="form-control sm-3" id="pesqInternado" name="pesqInternado">
                            <option value="">Busca por Internados</option>
                            <option value="s" <?= $pesqInternado == 's' ? 'selected' : null ?>>Sim</option>
                            <option value="n" <?= $pesqInternado == 'n' ? 'selected' : null ?>>Não</option>
                        </select>
                    </div>
                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Limite</label>
                        <select class="form-control sm-3" id="limite_pag" name="limite_pag">
                            <option value="">Registros por página</option>
                            <option value="5" <?= $limite_pag == '5' ? 'selected' : null ?>>5</option>
                            <option value="10" <?= $limite_pag == '10' ? 'selected' : null ?>>10</option>
                            <option value="20" <?= $limite_pag == '20' ? 'selected' : null ?>>20</option>
                            <option value="50" <?= $limite_pag == '50' ? 'selected' : null ?>>50</option>
                        </select>
                    </div>
                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Classificar</label>
                        <select class="form-control sm-3" id="ordenar" name="ordenar">
                            <option value="">Classificar por</option>
                            <option value="nome_pac" <?= $ordenar == 'nome_pac' ? 'selected' : null ?>>Paciente</option>
                            <option value="nome_hosp" <?= $ordenar == 'nome_hosp' ? 'selected' : null ?>>Hospital</option>
                            <option value="id_internacao" <?= $ordenar == 'id_internacao' ? 'selected' : null ?>>Internação</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-1" style="margin:20px 0px 35px 30px">
                        <button type="submit" class="btn btn-primary mb-1"><span class="material-icons">
                                person_search
                            </span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- BASE DAS PESQUISAS -->
    <?php
    //Instanciando a classe
    $QtdTotalIntUTI = new utiDAO($conn, $BASE_URL);

    // METODO DE BUSCA DE PAGINACAO
    $pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
    $pesqInternado = filter_input(INPUT_GET, 'pesqInternado');
    $limite_pag = filter_input(INPUT_GET, 'limite_pag') ? filter_input(INPUT_GET, 'limite_pag') : 10;
    $pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
    $ordenar = filter_input(INPUT_GET, 'ordenar') ? filter_input(INPUT_GET, 'ordenar') : 1;
    $uti_internacao = 's';
    // $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";
    $condicoes = [
        strlen($pesquisa_nome) ? 'nome_hosp LIKE "%' . $pesquisa_nome . '%"' : null,
        strlen($pesquisa_pac) ? 'nome_pac LIKE "%' . $pesquisa_pac . '%"' : null,
        strlen($pesqInternado) ? 'internado_int = "' . $pesqInternado . '"' : NULL,
        strlen($uti_internacao) ? 'internacao_uti = "s"' : "s",

    ];
    $condicoes = array_filter($condicoes);
    // print_r($condicoes);
    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE InternacaoS
    $qtdIntItens1 = $QtdTotalIntUTI->QtdInternacaoUTI($where);
    // $qtdIntItens = $QtdTotalInt->findTotal();
    $qtdIntItens = ($qtdIntItens1['qtd']);
    // PAGINACAO
    $obPagination = new pagination($qtdIntItens, $_GET['pag'] ?? 1, $limite_pag);
    $obLimite = $obPagination->getLimit();

    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $order = $ordenar;
    $query = $uti->selectAllUTI($where, $order, $obLimite);

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
    }
    ?>
    <div class="container">
        <div class="row">

            <h6 class="page-title">Relatório de internações - UTI</h6>
            <table class="table table-sm table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Internado</th>
                        <th scope="col">Hospital</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Data internação</th>
                        <th scope="col">Internado UTI</th>
                        <th scope="col">Internação UTI</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query as $intern) :
                        extract($query);
                    ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $intern["id_internacao"] ?></td>
                            <td scope="row" class="nome-coluna-table"><?php if ($intern["internado_int"] == "s") {
                                                                            echo "Sim";
                                                                        } else {
                                                                            echo "Não";
                                                                        }; ?></td>
                            <td scope="row" class="nome-coluna-table"><?= $intern["nome_hosp"] ?></td>
                            <td scope="row"><?= $intern["nome_pac"] ?></td>
                            <td scope="row"><?php echo date('d/m/Y', strtotime($intern["data_intern_int"])) ?></td>
                            <td scope="row"><?= $intern["internado_uti"] ?></td>
                            <td scope="row"><?= $intern["internacao_uti"] ?></td>

                            <td class="action">
                                <a href="<?= $BASE_URL ?>show_internacao.php?id_internacao=<?= $intern["id_internacao"] ?>"><i style="color:green; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                                <form class="d-inline-block delete-form" action="edit_alta_uti.php" method="get">
                                    <input type="hidden" name="type" value="update">
                                    <!-- <input type="hidden" name="alta" value="alta"> -->
                                    <input type="hidden" name="id_internacao" value="<?= $intern["id_internacao"] ?>">
                                    <button type="hidden" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block bi bi-door-open"></i></button>
                                </form>

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
                echo " <li class='page-item'><a class='page-link' href='list_internacao_uti.php?pg=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>"; ?>
                <?= $paginacao ?>
                <?php echo "<li class='page-item'><a class='page-link' href='list_internacao_uti.php?pg=$qtdIntItens&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
                echo " </ul>";
                echo "</nav>";
                echo "</div>"; ?>
                <hr>
            </div>
            <div>
                <a class="btn btn-success styled" href="cad_internacao.php">Nova internação</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>