    <?php

    include_once("globals.php");
    require_once("templates/header.php");
    require_once("dao/internacaoDao.php");
    require_once("models/message.php");
    include_once("models/Internacao.php");
    include_once("dao/InternacaoDao.php");
    include_once("models/patologia.php");
    include_once("dao/patologiaDao.php");

    require_once("dao/pacienteDAO.php");
    include_once("models/pagination.php");

    require_once("dao/hospitalDAO.php");
    include_once("models/pagination.php");

    $Internacao_geral = new InternacaoDAO($conn, $BASE_URL);
    $Internacaos = $Internacao_geral->findGeral();

    $pacienteDao = new pacienteDAO($conn, $BASE_URL);
    $pacientes = $pacienteDao->findGeral($limite, $inicio);

    $hospital_geral = new hospitalDAO($conn, $BASE_URL);
    $hospitals = $hospital_geral->findGeral($limite, $inicio);
    // $patologiaDao = new patologiaDAO($conn, $BASE_URL);
    // $patologias = $patologiaDao->findGeral();

    // $internacao = new internacaoDAO($conn, $BASE_URL);

    ?>
    <!-- FORMULARIO DE PESQUISAS -->
    <div class="container">
        <div class="container py-2">
            <form class="formulario visible" action="" id="select-internacao-form" method="GET">
                <h6 style="margin-left: 30px; padding-top:10px" class="page-title">Pesquisa internações</h6>
                <?php $pesquisa_nome = filter_input(INPUT_GET, 'pesquisa_nome');
                $pesqInternado = filter_input(INPUT_GET, 'pesqInternado');
                $limite_pag = filter_input(INPUT_GET, 'limite_pag');
                $pesquisa_pac = filter_input(INPUT_GET, 'pesquisa_pac');
                $ordenar = filter_input(INPUT_GET, 'ordenar');
                ?>
                <div class="form-group row">
                    <div class="form-group col-sm-3">
                        <input style="margin-left: 30px;" class="form-control" type="text" name="pesquisa_nome" placeholder="Selecione o Hospital" value="<?= $pesquisa_nome ?>">
                    </div>

                    <div style="margin-left:20px" class="form-group col-sm-3">
                        <select class="form-control mb-3" id="pesqInternado" name="pesqInternado">
                            <option value="">Busca por Internados</option>
                            <option value="s" <?= $pesqInternado == 's' ? 'selected' : null ?>>Sim</option>
                            <option value="n" <?= $pesqInternado == 'n' ? 'selected' : null ?>>Não</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <button type="submit" class="btn btn-primary mb-1">Buscar</button>
                    </div>
                </div>

        </div>
        </form>
    </div>

    <!-- BASE DAS PESQUISAS -->
    <?php
    //Instanciando a classe
    $Internacao = new InternacaoDAO($conn, $BASE_URL);
    $QtdTotalInt = new InternacaoDAO($conn, $BASE_URL);

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
        strlen($pesqInternado) ? 'internado_int = "' . $pesqInternado . '"' : null
    ];
    $condicoes = array_filter($condicoes);

    // REMOVE POSICOES VAZIAS DO FILTRO
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE InternacaoS
    $qtdIntItens1 = $QtdTotalInt->QtdInternacao($where);

    $qtdIntItens = ($qtdIntItens1['0']);

    // PAGINACAO
    $obPagination = new pagination($qtdIntItens, $_GET['pag'] ?? 1, $limite_pag);
    $obLimite = $obPagination->getLimit();

    // PREENCHIMENTO DO FORMULARIO COM QUERY
    $order = $ordenar;
    $query = $Internacao->selectAllInternacao($where, $order, $obLimite);

    // GETS 
    unset($_GET['pag']);
    unset($_GET['pg']);
    $gets = http_build_query($_GET);

    // PAGINACAO
    $paginacao = '';
    $paginas = $obPagination->getPages();

    foreach ($paginas as $pagina) {
        $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
        $paginacao .= '<li class="page-item"><a href="?pag=' . $pagina['pag'] . '&' . $gets . '"> 
        <button type="button" class="btn ' . $class . '">' . $pagina['pag'] . '</button>
        <li class="page-item"></a>';
        // $paginacao2 .= "<div style='color:blue; margin-top:20px;'></div><nav aria-label='Page navigation example'><ul class='pagination'><li class='page-item'><a class='page-link' href='list_seguradora.php?pg=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li><li class='page-item'><a class='page-link' href='list_seguradora.php?pg=$qtdPag&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li></ul></nav></div>";
    }
    ?>
    <div class="container">
        <h6 class="page-title">Relatório de internações</h6>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Internado</th>
                    <th scope="col">Internacao</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Data internação</th>
                    <th scope="col">Acomodação</th>
                    <th scope="col">Data visita</th>
                    <th scope="col">Grupo Patologia</th>
                    <th scope="col">Modo Admissão</th>
                    <th scope="col">Tipo Alta</th>
                    <th scope="col">Médico</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Relatório</th>
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
                        <td scope="row" class="nome-coluna-table"><?= $intern["internado_int"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $intern["nome_hosp"] ?></td>
                        <td scope="row"><?= $intern["nome_pac"] ?></td>
                        <td scope="row"><?= $intern["data_intern_int"] ?></td>
                        <td scope="row"><?= $intern["acomodacao_int"] ?></td>
                        <td scope="row"><?= $intern["data_visita_int"] ?></td>
                        <td scope="row"><?= $intern["grupo_patologia_int"] ?></td>
                        <td scope="row"><?= $intern["tipo_admissao_int"] ?></td>
                        <td scope="row"><?= $intern["tipo_alta_int"] ?></td>
                        <td scope="row"><?= $intern["modo_internacao_int"] ?></td>
                        <td scope="row"><?= $intern["titular_int"] ?></td>
                        <td scope="row"><?= $intern["especialidade_int"] ?></td>
                        <td scope="row"><?= $intern["rel_int"] ?></td>

                        <td class="action">
                            <a href="<?= $BASE_URL ?>show_internacao.php?id_internacao=<?= $intern["id_internacao"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>cad_visita.php?id_internacao=<?= $intern["id_internacao"] ?>"><i style="color:black; font-weigth:bold; margin-left:5px;margin-right:5px" name="type" value="visita" class="aparecer-acoes bi bi-file-text"></i></a>

                            <form class="d-inline-block delete-form" action="edit_alta.php" method="get">
                                <input type="hidden" name="type" value="alta">
                                <!-- <input type="hidden" name="alta" value="alta"> -->
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
            <?php echo "<li class='page-item'><a class='page-link' href='list_internacao.php?pg=$qtdIntItens&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
            echo " </ul>";
            echo "</nav>";
            echo "</div>"; ?>
            <hr>
        </div>
        <!-- <?php

                //modo cadastro
                $formData = "0";
                $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                $total = $Internacao->findTotal();

                $totalcasos = $total['0'];
                // echo $totalcasos['0'];
                $reg = ($totalcasos['0']);
                // echo $reg;

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
                    $qtdIntItens = ceil($reg / $limite);
                } catch (PDOexception $error_Total) {

                    echo 'Erro ao retornar os Dados. ' . $error_Total->getMessage();
                }
                echo "<div style=margin-left:20px;>";
                echo "<div style='color:blue; margin-left:20px;'>";
                echo "</div>";
                echo "<nav aria-label='Page navigation example'>";
                echo " <ul class='pagination'>";
                echo " <li class='page-item'><a class='page-link' href='list_internacao.php?pg=1&" . $gets . "''><span aria-hidden='true'>&laquo;</span></a></li>";
                if ($qtdIntItens > 1 && $pg <= $qtdIntItens) {
                    for ($i = 1; $i <= $qtdIntItens; $i++) {
                        if ($i == $pg) {
                            echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
                        } else {
                            echo "<li class='page-item '><a class='page-link' href='list_internacao.php?pg=$i&" . $gets . "'>" . $i . "</a></li>";
                        }
                    }
                }
                echo "<li class='page-item'><a class='page-link' href='list_internacao.php?pg=$qtdIntItens&" . $gets . "''><span aria-hidden='true'>&raquo;</span></a></li>";
                echo " </ul>";
                echo "</nav>";
                echo "</div>"; ?> -->
        <div>

            <a class="btn btn-success styled" style="margin-left:120px" href="cad_internacao.php">Nova internação</a>
        </div>
    </div>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>