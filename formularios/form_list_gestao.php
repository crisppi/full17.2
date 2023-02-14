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

    include_once("models/gestao.php");
    include_once("dao/gestaoDao.php");

    include_once("models/pagination.php");

    $Internacao_geral = new internacaoDAO($conn, $BASE_URL);
    $Internacaos = $Internacao_geral->findGeral();

    $pacienteDao = new pacienteDAO($conn, $BASE_URL);
    $pacientes = $pacienteDao->findGeral($limite, $inicio);

    $gestaoDao = new gestaoDAO($conn, $BASE_URL);
    $QtdTotalGes = new gestaoDAO($conn, $BASE_URL);
    $gestaos = $gestaoDao->findGeral($limite, $inicio);
    // $QtdTotalGes = $gestaoDao->QtdGestao($where);

    $hospital_geral = new HospitalDAO($conn, $BASE_URL);
    $hospitals = $hospital_geral->findGeral($limite, $inicio);

    $patologiaDao = new patologiaDAO($conn, $BASE_URL);
    $patologias = $patologiaDao->findGeral();

    $internacao = new internacaoDAO($conn, $BASE_URL);

    ?>
    <!-- FORMULARIO DE PESQUISAS -->
    <div class="container">
        <div class="container py-2">
            <form class="formulario visible" action="" id="select-internacao-form" method="GET">
                <h6 style="margin-left: 30px; padding-top:10px" class="page-title">Pesquisa gestão</h6>
                <?php $pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
                $pesqGestao = filter_input(INPUT_GET, 'pesqGestao');
                $limite_pag = filter_input(INPUT_GET, 'limite_pag');
                $pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
                $ordenar = filter_input(INPUT_GET, 'ordenar');
                ?>

                <div class="form-group row">
                    <div style="margin-left:20px" class="form-group col-sm-2">
                        <label>Tipo Gestão</label>
                        <select class="form-control mb-2" id="pesqGestao" name="pesqGestao">
                            <option value="">Selecione a gestão</option>
                            <option value="home_care" <?= $pesqGestao == 'home_care' ? 'selected' : null ?>>Home care</option>
                            <option value="desospitalizacao" <?= $pesqGestao == 'n' ? 'selected' : null ?>>desospitalizacao</option>
                            <option value="opme" <?= $pesqGestao == 'opme' ? 'selected' : null ?>>opme</option>
                            <option value="alto" <?= $pesqGestao == 'alto' ? 'selected' : null ?>>alto</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label style="margin-left: 20px;">Pesquisa por Hospital</label>
                        <input style="margin-left: 20px;" class="form-control" type="text" name="pesquisa_nome" placeholder="Selecione o Hospital" value="<?= $pesquisa_nome ?>">
                    </div>
                    <div class="form-group col-sm-3">
                        <label style="margin-left: 30px;">Pesquisa por Paciente</label>

                        <input style="margin-left: 30px;" class="form-control" type="text" name="pesquisa_pac" placeholder="Selecione o Paciente" value="<?= $pesquisa_pac ?>">
                    </div>

                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Limite</label>
                        <select class="form-control mb-3" id="limite_pag" name="limite_pag">
                            <option value="">Reg por página</option>
                            <option value="5" <?= $limite_pag == '5' ? 'selected' : null ?>>5</option>
                            <option value="10" <?= $limite_pag == '10' ? 'selected' : null ?>>10</option>
                            <option value="20" <?= $limite_pag == '20' ? 'selected' : null ?>>20</option>
                            <option value="50" <?= $limite_pag == '50' ? 'selected' : null ?>>50</option>
                        </select>
                    </div>
                    <div style="margin-left:20px" class="form-group col-sm-1">
                        <label>Classificar</label>
                        <select class="form-control mb-3" id="ordenar" name="ordenar">
                            <option value="">Classificar por</option>
                            <option value="id_internacao" <?= $ordenar == 'id_internacao' ? 'selected' : null ?>>Internação</option>
                            <option value="nome_pac" <?= $ordenar == 'nome_pac' ? 'selected' : null ?>>Paciente</option>
                            <option value="nome_hosp" <?= $ordenar == 'nome_hosp' ? 'selected' : null ?>>Hospital</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-sm-1" style="margin:0px 0px 10px 30px">
                        <button type="submit" class="btn btn-primary mb-1">Buscar</button>
                    </div>
                </div>
        </div>
        </form>
    </div>

    <!-- BASE DAS PESQUISAS -->

    <?php

    // SELECAO DA ENTRADA DO INPUT DE PESQUISA GESTAO
    $pesqGestao = filter_input(INPUT_GET, 'pesqGestao');

    if (isset(($_GET))); {
        if ($pesqGestao == 'home_care') {
            $gestaoHome = "s";
        } else {
            $gestaoHome = null;
        }
    };
    if (isset(($_GET))); {
        if ($pesqGestao == 'desospitalizacao') {
            $gestaoDesop = "s";
        } else {
            $gestaoDesop = null;
        }
    };
    if (isset(($_GET))); {
        if ($pesqGestao == 'opme') {
            $gestaoOPME = "s";
        } else {
            $gestaoOPME = null;
        }
    };
    if (isset(($_GET))); {
        if ($pesqGestao == 'alto') {
            $gestaoAlto = "s";
        } else {
            $gestaoAlto = null;
        }
    };


    //Instanciando a classe

    $QtdTotalInt = new internacaoDAO($conn, $BASE_URL);

    // METODO DE BUSCA DE PAGINACAO
    $pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
    $pesqInternado = filter_input(INPUT_GET, 'pesqInternado');
    $limite_pag = filter_input(INPUT_GET, 'limite_pag') ? filter_input(INPUT_GET, 'limite_pag') : 10;
    $pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
    $ordenar = filter_input(INPUT_GET, 'ordenar') ? filter_input(INPUT_GET, 'ordenar') : 1;
    // $buscaAtivo = in_array($buscaAtivo, ['s', 'n']) ?: "";
    $condicoes = [
        strlen($pesquisa_nome) ? 'ho.nome_hosp LIKE "%' . $pesquisa_nome . '%"' : null,
        strlen($pesquisa_pac) ? 'pa.nome_pac LIKE "%' . $pesquisa_pac . '%"' : null,
        strlen($pesqInternado) ? 'internado_int = "' . $pesqInternado . '"' : NULL,
        strlen($gestaoAlto) ? 'alto_custo_ges = "' . $gestaoAlto . '"' : NULL,
        strlen($gestaoOPME) ? 'opme_ges = "' . $gestaoOPME . '"' : NULL,
        strlen($gestaoDesop) ? 'desospitalizacao_ges = "' . $gestaoDesop . '"' : NULL,
        strlen($gestaoHome) ? 'home_care_ges = "' . $gestaoHome . '"' : NULL

    ];

    $condicoes = array_filter($condicoes);
    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE Internacao
    $order = $ordenar;

    $qtdGesItens1 = $QtdTotalGes->QtdGestao($where);

    $qtdGesItens = ($qtdGesItens1['qtd']);
    $totalcasos = ceil($qtdGesItens / $limite);

    // PAGINACAO
    $obPagination = new pagination($qtdGesItens, $_GET['pag'] ?? 1, $limite_pag);
    $obLimite = $obPagination->getLimit();

    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $query = $gestaoDao->selectAllGestao($where, $order, $obLimite);

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
    <div class="container">
        <h6 class="page-title">Relatório Gestão</h6>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Internado</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Data internação</th>
                    <th scope="col">Home care</th>
                    <th scope="col">Desospitalização</th>
                    <th scope="col">OPME</th>
                    <th scope="col">Alto Custo</th>
                    <th scope="col">Evento Adverso</th>
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
                        <td scope="row"><?= $intern["data_intern_int"] ?></td>
                        <td scope="row"><?php if ($intern["home_care_ges"] == "s") {
                                            echo "Sim";
                                        } else {
                                            echo "Não";
                                        }; ?></td>
                        <td scope="row"><?php if ($intern["desospitalizacao_ges"] == "s") {
                                            echo "Sim";
                                        } else {
                                            echo "Não";
                                        }; ?>
                        </td>
                        <td scope="row"><?php if ($intern["opme_ges"] == "s") {
                                            echo "Sim";
                                        } else {
                                            echo "Não";
                                        }; ?></td>
                        <td scope="row"><?php if ($intern["alto_custo_ges"] == "s") {
                                            echo "Sim";
                                        } else {
                                            echo "Não";
                                        }; ?></td>
                        <td scope="row"><?php if ($intern["evento_adverso_ges"] == "s") {
                                            echo "Sim";
                                        } else {
                                            echo "Não";
                                        }; ?></td>

                        <td class="action">
                            <a href="<?= $BASE_URL ?>show_internacao.php?id_internacao=<?= $intern["id_internacao"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>cad_visita.php?id_internacao=<?= $intern["id_internacao"] ?>"><i style="color:black; font-weigth:bold; margin-left:5px;margin-right:5px" name="type" value="visita" class="aparecer-acoes bi bi-file-text"></i></a>

                            <form class="d-inline-block delete-form" action="edit_alta.php" method="get">
                                <input type="hidden" name="type" value="alta">
                                <input type="hidden" name="id_internacao" value="<?= $intern["id_internacao"] ?>">
                                <button type="hidden" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block bi bi-door-open"></i></button>
                            </form>
                            <form class="d-inline-block delete-form" action="del_internacao.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_internacao" value="<?= $intern["id_internacao"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
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
            echo " <li class='page-item'><a class='page-link' href='list_internacao.php?pg=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>"; ?>
            <?= $paginacao ?>
            <?php echo "<li class='page-item'><a class='page-link' href='list_internacao.php?pg=$totalcasos&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
            echo " </ul>";
            echo "</nav>";
            echo "</div>"; ?>
            <hr>
        </div>

        <div>

            <a class="btn btn-success styled" style="margin-left:120px" href="cad_internacao.php">Nova internação</a>
        </div>
    </div>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>