<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<div class="row">
    <h2 id="titulo" class="page-title titulo"> Capeante - Lançamento</h2>
    <p class="page-description">Adicione informações do Capeante</p>

    <form class="formulario visible" action="<?= $BASE_URL ?>process_capeante.php" id="add-internacao-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="create">
        <br>
        <?php if ($_SESSION['cargo'] === "Enf_auditor") {
            echo "<div class='logado'>";
            echo "Olá !!! ";
            echo  $_SESSION['login_user'];
            echo "<br>";
            echo "Você está logado como Enfermeiro(a)";
            echo "</div>";
        };
        if ($_SESSION['cargo'] === "Med_auditor") {
            echo "<div class='logado'>";
            echo "Olá !!! ";
            echo  $_SESSION['login_user'];
            echo "Você está logado como Médico(a)";
            echo "</div>";
        };
        if ($_SESSION['cargo'] === "Adm") {
            echo "<div class='logado'>";
            echo "Olá !!! ";
            echo  $_SESSION['login_user'];
            echo "Você está logado como Administrativo(a)";
            echo "</div>";
        };
        ?>
        <hr>
        <!-- profissionais  -->
        <div class="form-group row">
            <?php if ($_SESSION['cargo'] === "Adm") { ?>
                <div class="form-group col-sm-2">
                    <label for="adm_capeante">Adm Capeante</label>
                    <input type="text" class="form-control" id="adm_capeante" name="adm_capeante" value="<?php if ($_SESSION['cargo'] === "Adm") echo $_SESSION['login_user'] ?>">
                </div>
            <?php } ?>

            <?php if ($_SESSION['cargo'] === "Enf_auditor") { ?>
                <div class="form-group col-sm-2">
                    <label for="aud_enf_capeante">Enf Auditor</label>
                    <input type="text" class="form-control" id="aud_enf_capeante" name="aud_enf_capeante" value="<?php if ($_SESSION['cargo'] === "Enf_auditor") echo $_SESSION['login_user'] ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Med_auditor") { ?>
                <div class="form-group col-sm-2">
                    <label for="aud_med_capeante"> Médico Auditor</label>
                    <input type="text" class="form-control" id="aud_med_capeante" name="aud_med_capeante" value="<?php if ($_SESSION['cargo'] === "Med_auditor") echo $_SESSION['login_user'] ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Adm") { ?>

                <div class="form-group col-sm-2">
                    <label for="adm_check">Check adm</label>
                    <input type="text" class="form-control" id="adm_check" name="adm_check" value="<?php if ($_SESSION['cargo'] === "adm") {
                                                                                                        echo "s";
                                                                                                    } else {
                                                                                                        echo 'n';
                                                                                                    } ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Med_auditor") { ?>

                <div class="form-group col-sm-2">
                    <label for="med_check">Check Médico</label>
                    <input type="text" class="form-control" id="med_check" name="med_check" value="<?php if ($_SESSION['cargo'] === "Med_auditor") {
                                                                                                        echo "s";
                                                                                                    } else {
                                                                                                        echo 'n';
                                                                                                    } ?>">
                </div>
            <?php } ?>
            <?php if ($_SESSION['cargo'] === "Enf_auditor") { ?>

                <div class="form-group col-sm-2">
                    <label for="enfer_check">Check Enf</label>
                    <input type="text" class="form-control" id="enfer_check" name="enfer_check" value="<?php if ($_SESSION['cargo'] === "Enf_auditor") {
                                                                                                            echo "s";
                                                                                                        } else {
                                                                                                            echo 'n';
                                                                                                        } ?>">
                </div>
            <?php } ?>

        </div>
        <!-- dados de abertura -->
        <hr>
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="valor_apresentado_capeante">Valor Apresentado</label>
                <input type="text" class="form-control dinheiro" id="valor_apresentado_capeante" name="valor_apresentado_capeante" placeholder="Valor apresentado">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_final_capeante">Valor Final</label>
                <input type="text" class="form-control dinheiro" id="valor_final_capeante" name="valor_final_capeante" placeholder="Valor final">
            </div>
        </div>
        <br>
        <!-- campos de dados gerais  -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="data_inicial_capeante">Data Inicial</label>
                <input type="date" class="form-control" id="data_inicial_capeante" name="data_inicial_capeante">
            </div>
            <div class="form-group col-sm-2">
                <label for="data_final_conta">Data Final</label>
                <input type="date" class="form-control" id="data_final_conta" name="data_final_conta">
            </div>
            <div class="form-group col-sm-2">
                <label for="diarias_capeante">Diárias</label>
                <input type="text" class="form-control" id="diarias_capeante" name="diarias_capeante">
            </div>
            <div class="form-group col-sm-2">
                <label for="data_fech_capeante">Data Fechamento</label>
                <input type="date" class="form-control" id="data_fech_capeante" name="data_fech_capeante">
            </div>
        </div>
        <hr>
        <!-- campo de valores por grupo -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="valor_diarias">Valor Diárias</label>
                <input type="text" class="form-control dinheiro" id="valor_diarias" name="valor_diarias" placeholder="Valor diárias">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_matmed">Valor MatMed</label>
                <input type="text" class="form-control dinheiro" id="valor_matmed" name="valor_matmed" placeholder="Valor MatMed">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_oxig">Valor Oxigenioterapia</label>
                <input type="text" class="form-control dinheiro" id="valor_oxig" name="valor_oxig" placeholder="Valor Oxigenioterapia">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_sadt">Valor SADT</label>
                <input type="text" class="form-control dinheiro" id="valor_sadt" name="valor_sadt" placeholder="Valor SADT">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_taxa">Valor Taxas</label>
                <input type="text" class="form-control dinheiro" id="valor_taxa" name="valor_taxa" placeholder="Valor Taxa">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_honorarios">Valor Honorários</label>
                <input type="text" class="form-control dinheiro" id="valor_honorarios" name="valor_honorarios" placeholder="Valor Honorários">
            </div>
        </div>
        <br>

        <!-- campos de glosas -->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="glosa_diarias">Glosa Diárias</label>
                <input type="text" class="form-control dinheiro" id="glosa_diarias" name="glosa_diarias" placeholder="Glosa diárias">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_matmed">Glosa MatMed</label>
                <input type="text" class="form-control dinheiro" id="glosa_matmed" name="glosa_matmed" placeholder="Glosa MatMed">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_oxig">Glosa Oxigenioterapia</label>
                <input type="text" class="form-control dinheiro" id="glosa_oxig" name="glosa_oxig" placeholder="Glosa Oxigenioterapia">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_sadt">Glosa SADT</label>
                <input type="text" class="form-control dinheiro" id="glosa_sadt" name="glosa_sadt" placeholder="Glosa SADT">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_taxa">Glosa Taxas</label>
                <input type="text" class="form-control dinheiro" id="glosa_taxa" name="glosa_taxa" placeholder="Glosa Taxas">
            </div>
            <div class="form-group col-sm-2">
                <label for="glosa_honorarios">Glosa Honorários</label>
                <input type="text" class="form-control dinheiro" id="glosa_honorarios" name="glosa_honorarios" placeholder="Glosa honorários">
            </div>
        </div>
        <br>

        <!-- campos de glosas por profissional-->
        <div class="form-group row">
            <div class="form-group col-sm-2">
                <label for="valor_glosa_enf">Glosa Enfermagem</label>
                <input type="text" class="dinheiro form-control" id="valor_glosa_enf" name="valor_glosa_enf" placeholder="Glosa Enfermagem">
                <p class="oculto mensagem_error" id="err_valor_glosa_enf">Digite um número!</p>
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_glosa_med">Glosa Médica</label>
                <input type="text" class="form-control dinheiro" id="valor_glosa_med" name="valor_glosa_med" placeholder="Glosa Médica">
            </div>
            <div class="form-group col-sm-2">
                <label for="valor_glosa_total">Glosa Total</label>
                <input type="text" class="money2 form-control" id="valor_glosa_total" name="valor_glosa_total" placeholder="Glosa Total">
            </div>

        </div>
        <div> <button style="margin:10px" type="submit" class="btn-sm btn-success">Cadastrar</button>
        </div>
    </form>
    <hr>
    <div>
        <a class="btn btn-success styled" style="margin-left:10px" href="cad_capeante.php">Novo Capeante</a>
    </div>
</div>
<script>
    // PEGAR DADOS DOS INPUTS //
    let inputEnf = document.getElementById("valor_glosa_enf");
    let inputMed = document.getElementById("valor_glosa_med");
    let inputApresent = document.getElementById("valor_apresentado_capeante");
    let data_inicial_capeante = document.getElementById("data_inicial_capeante");
    let data_final_conta = document.getElementById("data_final_conta");

    inputMed.addEventListener("blur", function() {

        // PEGAR VALOR DO INPUT

        // LIMPAR DADOS DO INPUT - valor_glosa_enf
        finalEnf = inputEnf.value;
        var finalEnf2 = finalEnf;
        finalEnf2 = finalEnf.replace(".", "");
        finalEnf2 = finalEnf.replace(",", ".");
        finalEnf2 = parseFloat(finalEnf2);

        // LIMPAR DADOS DO INPUT - valor_glosa_med
        finalMed = inputMed.value;
        var finalMed2 = finalMed;
        finalMed2 = finalMed.replace(".", "");
        finalMed2 = finalMed.replace(",", ".");
        finalMed2 = parseFloat(finalMed2);

        // let p = document.querySelector("#valor_glosa_enf").value;
        // let p_med = document.querySelector("#valor_glosa_med").value;

        // let p_erro = document.querySelector("#err_valor_glosa_enf");
        // // let mensagem = document.createElement("p");
        // let textMsg = document.createTextNode("Digite um número!");

        // CRIAR MENSAGEM DE ERRO
        // if (isNaN(final)) {

        //     $("#err_valor_glosa_enf").removeClass("oculto");
        //     $("#err_valor_glosa_enf").addClass("visible");

        //     inputEnf.addEventListener("click", function() {
        //         $("#err_valor_glosa_enf").addClass("oculto");

        //     })
        // }

        // INSERIR VALOR NO INPUT DE DADOS
        finalGlosa = finalEnf2 + finalMed2;
        let inputGlosa = document.getElementById("valor_glosa_total");
        inputGlosa.value = finalGlosa;

        finalGlosa = inputGlosa.value;
        var finalGlosa2 = finalGlosa;

        // PREENCHIMENTO DE CAMPO GLOSA TOTAL
        finalGlosa2 = finalGlosa.replace(".", "");
        finalGlosa2 = finalGlosa.replace(",", ".");
        finalGlosa2 = parseFloat(finalGlosa2);

        var valorFormatGlosa = finalGlosa2.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
        inputGlosa.value = valorFormatGlosa;

        // LIMPAR DADOS DO INPUT - valor_apresentado_capeante
        apresCapeante = inputApresent.value;
        var apresCapeante2 = apresCapeante;
        apresCapeante2 = apresCapeante2.replace(".", "");
        apresCapeante2 = apresCapeante2.replace(",", ".");
        apresCapeante2 = parseFloat(apresCapeante2);

        // PREENCHIMENTO DO CAMPO FINAL CAPEANTE
        finalCapeante = apresCapeante2 - (finalEnf2 + finalMed2);
        // console.log(finalCapeante)

        valorFinal.value = finalCapeante;
        finalCapeante = valorFinal.value;
        var finalCapeante2 = finalCapeante;

        var valorFormatFinal = finalCapeante.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
        valorFinal.value = valorFormatFinal;
    });

    $(document).ready(function() {
        $("input.dinheiro").maskMoney({
            showSymbol: true,
            symbol: "R$",
            decimal: ",",
            thousands: "."
        });
    });

    data_final_conta.addEventListener("blur", function() {

        // PEGAR DIA DA DATA FINAL DO CAPEANTE
        let dataInicConta = document.getElementById("data_inicial_capeante");
        dataInicContaVal = dataInicConta.value;
        var dtI = new Date(dataInicContaVal);
        var diaInicial = dtI.getDate();
        console.log(diaInicial + 1);

        // pegar titulo h2
        let textoNovo = document.querySelector(".titulo");
        console.log(textoNovo);
        textoNovo.innerHTML = "<em>   Mudou data  </em>"


        // PEGAR DIA DA DATA FINAL DO CAPEANTE
        let dataFinalConta = document.getElementById("data_final_conta");
        dataFinalContaVal = dataFinalConta.value;
        var dtf = new Date(dataFinalContaVal);
        var diaFinal = dtf.getDate();
        console.log(diaFinal + 1);

        let diarias = document.getElementById("diarias_capeante");
        let totalDiarias = diaFinal - diaInicial;
        if (totalDiarias < 0) {
            dataFinalConta.style.borderColor = "red";
            dataFinalConta.value = "";
            dataFinalConta.focus();
        } else {
            diarias.value = totalDiarias;
            dataFinalConta.style.borderColor = "gray";

        }

    })

    function cancelar() {
        let idAcoes = (document.getElementById('id-confirmacao'));
        idAcoes.style.display = 'none';
        console.log("chegou no cancelar");

    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>