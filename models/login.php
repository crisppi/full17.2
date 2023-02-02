<?php

class login
{
    public function logaFuncionario($dados)
    {
        $this->email = $dados['email'];
        $this->senha = sha1($dados['senha']);
        try {
            $cst = $this->con->conectar()->prepare("SELECT `idFuncionario`, `email`, `senha` FROM `funcionario` WHERE `email` = :email AND `senha` = :senha;");
            $cst->bindParam(':email', $this->email, PDO::PARAM_STR);
            $cst->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $cst->execute();
            if ($cst->rowCount() == 0) {
                header('location: login/?login=error');
            } else {
                session_start();
                $rst = $cst->fetch();
                $_SESSION['logado'] = "sim";
                $_SESSION['func'] = $rst['idFuncionario'];
                header("location: login/admin");
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function funcionarioLogado($dado)
    {
        $cst = $this->con->conectar()->prepare("SELECT `idFuncionario`, `nome`, `email` FROM `funcionario` WHERE `idFuncionario` = :idFunc;");
        $cst->bindParam(':idFunc', $dado, PDO::PARAM_INT);
        $cst->execute();
        $rst = $cst->fetch();
        $_SESSION['nome'] = $rst['nome'];
    }

    public function sairFuncionario()
    {
        session_destroy();
        header('location: http://localhost/login');
    }
}
