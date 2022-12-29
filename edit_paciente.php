<?php
require_once("models/usuario.php");
require_once("models/paciente.php");
require_once("dao/usuarioDao.php");
require_once("dao/pacienteDao.php");
require_once("templates/header.php");

$user = new Paciente();
$userDao = new UserDAO($conn, $BASE_URL);
$pacienteDao = new pacienteDAO($conn, $BASE_URL);

// Receber id do usuário
$id_paciente = filter_input(INPUT_GET, "id_paciente");

$paciente = $pacienteDao->findById($id_paciente);

?>

<!-- formulario update -->
<div id="main-container" class="container-fluid">
    <div class="row">
        <h1 class="page-title">Atualizar Paciente</h1>
        <p class="page-description">Adicione informações sobre o paciente</p>
        <form class="formulario" action="<?= $BASE_URL ?>process_paciente.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="form-group row">

                <input type="hidden" class="form-control" id="id_paciente" name="id_paciente" value="<?= $paciente->id_paciente ?>" placeholder="ID">

                <div class="form-group col-sm-4">
                    <label for="nome_pac">Nome</label>
                    <input type="text" class="form-control" id="nome_pac" value="<?= $paciente->nome_pac ?>" name="nome_pac" placeholder="Digite o nome" required>
                </div>
                <div class="form-group col-sm-1">
                    <label for="idade_pac">Idade</label>
                    <input type="text" class="form-control" id="idade_pac" value="<?= $paciente->idade_pac ?>" name="idade_pac" placeholder="Digite a idade">
                </div>
                <div class="form-group col-sm-1 ">
                    <label class="control-label" for="sexo_pac">Sexo</label>
                    <select class="form-control" id="sexo_pac" name="sexo_pac">
                        <option value="">Selecione</option>
                        <option <?= $paciente->sexo_pac === "Feminino" ? "selected" : "" ?>>Feminino</option>
                        <option <?= $paciente->sexo_pac === "Masculino" ? "selected" : "" ?>>Masculino</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="mae_pac">Mãe</label>
                    <input type="text" class="form-control" id="mae_pac" name="mae_pac" value="<?= $paciente->mae_pac ?>" placeholder=" Digite  nome da mãe">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-3">
                    <label for="endereco_pac">Endereço</label>
                    <input type="text" class="form-control" id="endereco_pac" value="<?= $paciente->endereco_pac ?>" name="endereco_pac" placeholder="Digite a endereco">
                </div>
                <div class="form-group col-sm-3">
                    <label for="numero_pac">Número</label>
                    <input type="text" class="form-control" id="numero_pac" value="<?= $paciente->numero_pac ?>" name="numero_pac" placeholder="Digite o numero">
                </div>
                <div class="form-group col-sm-3">
                    <label for="bairro_pac">Bairro</label>
                    <input type="text" class="form-control" id="bairro_pac" name="bairro_pac" value="<?= $paciente->bairro_pac ?>" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-sm-3">
                    <label for="cidade_pac">Cidade</label>
                    <input type="text" class="form-control" id="cidade_pac" value="<?= $paciente->cidade_pac ?>" name="cidade_pac" placeholder="Digite a cidade">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-1">
                    <label for="cpf_pac">CPF</label>
                    <input type="text" oninput="mascara(this, 'cpf')" value="<?= $paciente->cpf_pac ?>" class="form-control" id="cpf_pac" name="cpf_pac" placeholder="Digite o cpf">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email01_pac">email01</label>
                    <input type="email" class="form-control" id="email01_pac" value="<?= $paciente->email01_pac ?>" name="email01_pac" placeholder="Digite o email01">
                </div>
                <div class="form-group col-sm-2">
                    <label for="email02_pac">email02</label>
                    <input type="email" class="form-control" id="email02_pac" value="<?= $paciente->email02_pac ?>" name="email02_pac" placeholder="Digite outro email">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone01_pac">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $paciente->telefone01_pac ?>" class="form-control" id="telefone01_pac" name="telefone01_pac" placeholder="Digite o telefone">
                </div>
                <div class="form-group col-sm-2">
                    <label for="telefone02_pac">Telefone</label>
                    <input type="text" onkeydown="return mascaraTelefone(event)" value="<?= $paciente->telefone02_pac ?>" class="form-control" id="telefone02_pac" name="telefone02_pac" placeholder="Digite outro telefone">
                </div>
                <div class="form-group col-sm-1">
                    <label class="control-label" for="ativo_pac">Ativo</label>
                    <select class="form-control" id="ativo_pac" name="ativo_pac">
                        <option value="">Selecione</option>
                        <option <?= $paciente->ativo_pac === "Sim" ? "selected" : "" ?> value="Sim">Sim</option>
                        <option <?= $paciente->ativo_pac === "Não" ? "selected" : "" ?> value="Não">Não</option>
                    </select>

                </div>

                <div class="form-group col-sm-2">
                    <label class="control-label" for="data_create_pac">Data</label>
                    <input type="date" class="form-control" value='<?php echo date("d/m/Y"); ?>' id="data_create_pac" name="data_create_pac" placeholder="">
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label" for="usuario_create_pac">Usuário</label>
                    <input type="text" class="form-control" id="usuario_create_pac" name="usuario_create_pac" placeholder="Digite o usuário">
                </div>
            </div>
            <br>
            <button style="margin:10px" type="submit" class="btn-sm btn-info">Atualizar</button>
            <br>
    </div>
    </form>
</div>
</div>
<script>
    function mascara(i) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length - 1);
            return;
        }

        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";

    }
</script>
<script>
    function mascara(i, t) {

        var v = i.value;

        if (isNaN(v[v.length - 1])) {
            i.value = v.substring(0, v.length - 1);
            return;
        }

        if (t == "data") {
            i.setAttribute("maxlength", "10");
            if (v.length == 2 || v.length == 5) i.value += "/";
        }

        if (t == "cpf") {
            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";
        }

        if (t == "cnpj") {
            i.setAttribute("maxlength", "18");
            if (v.length == 2 || v.length == 6) i.value += ".";
            if (v.length == 10) i.value += "/";
            if (v.length == 15) i.value += "-";
        }

        if (t == "cep") {
            i.setAttribute("maxlength", "9");
            if (v.length == 5) i.value += "-";
        }

        if (t == "tel") {
            if (v[0] == 12) {

                i.setAttribute("maxlength", "10");
                if (v.length == 5) i.value += "-";
                if (v.length == 0) i.value += "(";

            } else {
                i.setAttribute("maxlength", "9");
                if (v.length == 4) i.value += "-";
            }
        }
    }

    function mascaraTelefone(event) {
        let tecla = event.key;
        let telefone = event.target.value.replace(/\D+/g, "");

        if (/^[0-9]$/i.test(tecla)) {
            telefone = telefone + tecla;
            let tamanho = telefone.length;

            if (tamanho >= 12) {
                return false;
            }

            if (tamanho > 10) {
                telefone = telefone.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (tamanho > 5) {
                telefone = telefone.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (tamanho > 2) {
                telefone = telefone.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else {
                telefone = telefone.replace(/^(\d*)/, "($1");
            }

            event.target.value = telefone;
        }

        if (!["Backspace", "Delete"].includes(tecla)) {
            return false;
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<?php include_once("diversos/backbtn_pacientes.php"); ?>

<?php
require_once("templates/footer1.php");
