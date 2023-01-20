<body>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <?php
    include_once("globals.php");

    require_once("templates/header.php");
    require_once("dao/internacaoDao.php");
    require_once("models/message.php");
    include_once("models/hospital.php");
    include_once("dao/hospitalDao.php");
    include_once("models/patologia.php");
    include_once("dao/patologiaDao.php");
    require_once("dao/pacienteDAO.php");

    $internacaoDao = new internacaoDAO($conn, $BASE_URL);
    $hospital_geral = new hospitalDAO($conn, $BASE_URL);
    $hospitals = $hospital_geral->findGeral();
    $pacienteDao = new pacienteDAO($conn, $BASE_URL);
    $pacientes = $pacienteDao->findGeral();
    $patologiaDao = new patologiaDAO($conn, $BASE_URL);
    $patologias = $patologiaDao->findGeral();
    ?>
    <?php
    //Instanciando a classe
    //Criado o objeto $listarinternacaos
    $internacao_geral = new internacaoDAO($conn, $BASE_URL);
    $internacao = new internacaoDAO($conn, $BASE_URL);

    //Instanciar o metodo listar internacao
    // $internacaos = $internacao_geral->joininternacaoHospital();

    //Instanciar o metodo listar internacao
    $internacaos = $internacao_geral->findInternAll($limite, $inicio);

    ?>

    <!--tabela evento-->
    <div class="container">
        <h6 class="page-title">Relatório de internações</h6>
        <table class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Internado</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Data internação</th>
                    <th scope="col">Acomodação</th>
                    <th scope="col">Data visita</th>
                    <th scope="col">Grupo Patologia</th>
                    <th scope="col">Modo Admissão</th>
                    <th scope="col">Tipo internação</th>
                    <th scope="col">Médico</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Relatório</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($internacaos as $internacao) : ?>
                    <tr>
                        <td scope="row" class="col-id"><?= $internacao["id_internacao"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $internacao["internado_int"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $internacao["nome_hosp"] ?></td>
                        <td scope="row"><?= $internacao["nome_pac"] ?></td>
                        <td scope="row"><?= $internacao["data_intern_int"] ?></td>
                        <td scope="row"><?= $internacao["acomodacao_int"] ?></td>
                        <td scope="row"><?= $internacao["data_visita_int"] ?></td>
                        <td scope="row"><?= $internacao["grupo_patologia_int"] ?></td>
                        <td scope="row"><?= $internacao["tipo_admissao_int"] ?></td>
                        <td scope="row"><?= $internacao["modo_internacao_int"] ?></td>
                        <td scope="row"><?= $internacao["titular_int"] ?></td>
                        <td scope="row"><?= $internacao["especialidade_int"] ?></td>
                        <td scope="row"><?= $internacao["rel_int"] ?></td>

                        <td class="action">
                            <a href="<?= $BASE_URL ?>show_internacao.php?id_internacao=<?= $internacao["id_internacao"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>cad_visita.php?id_internacao=<?= $internacao["id_internacao"] ?>"><i style="color:black; font-weigth:bold; margin-left:5px;margin-right:5px" name="type" value="visita" class="aparecer-acoes bi bi-file-text"></i></a>

                            <form class="d-inline-block delete-form" action="process_alta.php" method="POST">
                                <input type="hidden" name="type" value="alta">
                                <input type="hidden" name="alta" value="Não">
                                <input type="hidden" name="id_internacao" value="<?= $internacao["id_internacao"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block bi bi-door-open"></i></button>
                            </form>
                            <form class="d-inline-block delete-form" action="del_internacao.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id_internacao" value="<?= $internacao["id_internacao"] ?>">
                                <button type="submit" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" class="delete-btn"><i class=" d-inline-block aparecer-acoes bi bi-x-square-fill delete-icon"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php $id_internacao = filter_input(INPUT_GET, "id_internacao"); ?>

        <div class="btn_acoes oculto">
            <p>Deseja deletar este internacao: <?php $internacao['nome'] ?> ?</p>
            <button class="cancelar btn btn-success styled" type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button class="btn btn-danger styled" type="button" id="deletar" name="deletar">Deletar</button>
        </div>
    </div>
    <?php

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
    echo " <li class='page-item'><a class='page-link' href='list_internacao.php?pg=1'><span aria-hidden='true'>&laquo;</span></a></li>";
    if ($qtdPag > 1 && $pg <= $qtdPag) {
        for ($i = 1; $i <= $qtdPag; $i++) {
            if ($i == $pg) {
                echo "<li class='page-item active'><a class='page-link' class='ativo'>" . $i . "</a></li>";
            } else {
                echo "<li class='page-item '><a class='page-link' href='list_internacao.php?pg=$i'>" . $i . "</a></li>";
            }
        }
    }
    echo "<li class='page-item'><a class='page-link' href='list_internacao.php?pg=$qtdPag'><span aria-hidden='true'>&raquo;</span></a></li>";
    echo " </ul>";
    echo "</nav>";
    echo "</div>"; ?>
    <div>
        <hr>
        <a class="btn btn-success styled" style="margin-left:120px" href="cad_internacao.php">Nova internação</a>
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
        window.location = "<?= $BASE_URL ?>del_paciente.php?id_paciente=<?= $id_paciente ?>";
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