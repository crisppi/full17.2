<?php

session_start(); //Iniciar a sessao

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD
include_once "conexao.php";

//Receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//var_dump($dados);

//Verificar se o usuario clicou no botao
if (!empty($dados['CadUsuario'])) {
    $query_usuario = "INSERT INTO usuarios 
                (nome, email) VALUES
                (:nome, :email)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $cad_usuario->execute();
    //var_dump($conn->lastInsertId());
    //Recuperar o ultimo id inserido
    $id_usuario = $conn->lastInsertId();

    $query_endereco = "INSERT INTO enderecos 
                (logradouro, numero, usuario_id) VALUES 
                (:logradouro, :numero, :usuario_id)";
    $cad_endereco = $conn->prepare($query_endereco);
    $cad_endereco->bindParam(':logradouro', $dados['logradouro'], PDO::PARAM_STR);
    $cad_endereco->bindParam(':numero', $dados['numero'], PDO::PARAM_STR);
    $cad_endereco->bindParam(':usuario_id', $id_usuario, PDO::PARAM_INT);
    $cad_endereco->execute();

    //Criar a variavel global para salvar a mensagem de sucesso
    $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";

    //Redirecionar o usuario
    header("Location: index.php");
} else {
    //Criar a variavel global para salvar a mensagem de erro
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";

    //Redirecionar o usuario
    header("Location: index.php");
}
