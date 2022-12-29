<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

</head>

<body>
    <?php
    include_once("globals.php");
    include_once("models/usuario.php");
    include_once("dao/usuarioDao.php");
    include_once("templates/header.php");
    ?>
    <?php
    //Instanciando a classe
    //Criado o objeto $listarpacientes
    $usuario_geral = new userDAO($conn, $BASE_URL);

    //Instanciar o metodo listar paciente
    $usuarios = $usuario_geral->findGeralUsuario();
    //var_dump($pacientes);
    ?>

    <!--tabela usuarios-->

    <div class="container-fluid py-5">
        <h2 class="page-title">Relação Usuário</h2>
        <table id="tabela_dados" class="table table-sm table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Número</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Telefone01</th>
                    <th scope="col">Telefone 02</th>
                    <th scope="col">Email01</th>
                    <th scope="col">Email02</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td scope="row" id="id-select" class="col-id id-select"><?= $usuario["id_usuario"] ?></td>
                        <td scope="row" class="nome-coluna-table"><?= $usuario["usuario_user"] ?></td>
                        <td scope="row"><?= $usuario["cargo_user"] ?></td>
                        <td scope="row"><?= $usuario["endereco_user"] ?></td>
                        <td scope="row"><?= $usuario["numero_user"] ?></td>
                        <td scope="row"><?= $usuario["bairro_user"] ?></td>
                        <td scope="row"><?= $usuario["cidade_user"] ?></td>
                        <td scope="row"><?= $usuario["telefone01_user"] ?></td>
                        <td scope="row"><?= $usuario["telefone02_user"] ?></td>
                        <td scope="row"><?= $usuario["email_user"] ?></td>
                        <td scope="row"><?= $usuario["email02_user"] ?></td>
                        <td scope="row"><?= $usuario["ativo_user"] ?></td>

                        <td class="action">
                            <a href="cad_usuario.php"><i style="color:green; margin-right:10px" class="aparecer-acoes bi bi-plus-square-fill edit-icon"></i></a>
                            <a href="<?= $BASE_URL ?>show_usuario.php?id_usuario=<?= $usuario["id_usuario"] ?>"><i style="color:orange; margin-right:10px" class="aparecer-acoes fas fa-eye check-icon"></i></a>

                            <a href="<?= $BASE_URL ?>edit_usuario.php?id_usuario=<?= $usuario["id_usuario"] ?>"><i style="color:blue" name="type" value="edite" class="aparecer-acoes far fa-edit edit-icon"></i></a>

                            <!-- <a href="#"><i style="color:red" id="id_delete" name="id_delete" value="<?= $usuario["id_usuario"] ?>" data-confirm=' Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>class="delete-btn fas fa-times delete-icon"></i></a> -->

                            <!-- navegacao correta para apagar, somente não ativa o modal -->
                            <a style="color:red;  text-decoration: none; margin-left: 5px" href="<?= $BASE_URL ?>del_usuario.php?id_usuario=<?= $usuario["id_usuario"] ?>" id="delete-btn-id" class="delete-btn bi bi-x-square-fill  delete-icon" data-confirm='Tem certeza de que deseja excluir o item selecionado?'></a>

                            <!-- <form id="form" class="d-inline-block" method="post">
                                <input type="hidden" name="type" value="delete">
                                <input type="text" id="entrada" name="id_usuario" class="aparecer-acoes" value="<?= $usuario["id_usuario"] ?>">
                                <input type="submit" id="send2" style="margin-left:3px; font-size: 16px; background:transparent; border-color:transparent; color:red" onclick="gerarhtml()" class="delete-btn"><i class="delete-btn d-inline-block fas fa-times delete-icon"></i>Del</input>
                            </form> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- <div class="btn_acoes oculto">
            <p>Deseja deletar este paciente: <?php $usuario['usuario_user'] ?> ?</p>
            <button class="cancelar btn btn-success styled" type="button" id="cancelar" name="cancelar">Cancelar</button>
            <button href="del_usuario.php" class="btn btn-danger styled" type="button" id="deletar" name="deletar">Deletar</button>
        </div> -->
    </div>
    <script>
        // $(document).ready(function() {
        //     $("input['entrada']").ready(function() {
        //         var $id_entrada = $("input['entrada']");
        //         $('.btn_acoes').removeClass('oculto');
        //         $('.btn_acoes').addClass('visible');
        //         console.log(id_entrada)

        //         $.getJSON('', {
        //             entrada: $(this).val()
        //         }, function(json) {
        //             $id_entrada.val(json.id_entrada);
        //             console.log(id_entrada)
        //         });
        //     });
        // });


        // pegar dados do form com query selector
        // const btn = document.querySelector("#send");
        // btn.addEventListener("click", function(e) {
        //     e.preventDefault();
        //     const name = document.querySelector("#entrada");
        //     console.log(name)
        //     const value = name.value;
        //     $('.btn_acoes').removeClass('oculto');
        //     $('.btn_acoes').addClass('visible');
        //     console.log(value);
        //     alert("var ID : " + value);


        // });
        // // 
        //         $(".delete-btn").click(function() {
        //             $('.btn_acoes').removeClass('oculto');
        //             $('.btn_acoes').addClass('visible');
        //             var id_usuario_js = $(this).attr('id-select');
        //             $("#id_select").val(id_usuario_js);
        //             var id_usuario_js = $id_usario
        //             var id_usuario_js = ((id_usuario_js) => this);
        //             console.log(id_usuario_js);

        //             alert("var ID : " + id_usuario_js);
        //         });
        // 
    </script>

    <script type="text/javascript">
        //     function gerarhtml() {

        //         $('.btn_acoes').removeClass('oculto');
        //         $('.btn_acoes').addClass('visible');
        //         var id_usuario_js = $(this).attr('entrada');
        //         var id_entrada = $(this).val('entrada');
        //         var novo_id = <?= $usuario["id_usuario"] ?>;
        //         //$("#entrada").val(id_entrada);

        //         const dados = {

        //             setEntrada: function(id_usuario_js) {
        //                 this.id_entrada = id_entrada
        //             },

        //             getEntrada: function() {
        //                 this.id_entradaHtml;
        //             },
        //         }
        //         alert("entrada: " + id_entrada + "usuario: " + id_usuario_js + "object: " + id_entradaHtml);
        //         // alert(console.log(Object.values('entrada')));

        //         window.location = 'del_usuario.php?id_usuario' + id_entrada;

        //     }
        // 
    </script>
    <?php

    //modo cadastro
    $formData = "0";
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($formData != "0") {
        $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
        //header("Location: index.php");
    } else {
        echo "<p style='color: #f00;'>Erro: Usuário não cadastrado!</p>";
    };
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="js/personalizado.js"></script>
    <?php
    include_once("templates/footer1.php");
    ?>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


</html>