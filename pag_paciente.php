<?php

/* Constantes de configuração */
define('QTDE_REGISTROS', 5);
define('RANGE_PAGINAS', 1);
$range_paginas = 1;

/* Recebe o número da página via parâmetro na URL */
$pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

class PacPaginacao
{
    public function findPaginacao()
    {
        $pacientesPag = [];
        $qnt_result_pg = 5; // Quantidade de registro por pagina

        /* Instrução de consulta para paginação com SQL Server */

        $stmt = $this->conn->query("SELECT * FROM tb_paciente ORDER BY id_paciente LIMIT $qnt_result_pg asc");

        $stmt->execute();

        $pacientesPag = $stmt->fetchAll();

        return $pacientesPag;
    }


    public function Paginas()
    {/* Conta quantos registos existem na tabela */

        $sqlContador = $this->conn->query("SELECT count(id_paciente) FROM tb_paciente");
        $sqlContador->execute();


        return $sqlContador;
    }
}

$nova = new PacPaginacao();
$contador = $nova->Paginas();
var_dump($contador);


/* Idêntifica a primeira página */
$primeira_pagina = 1;

/* Cálcula qual será a última página */
$ultima_pagina = ceil($valor->total_registros / $qnt_result_pg);

/* Cálcula qual será a página anterior em relação a página atual em exibição */
$pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : 0;

/* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
$proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : 0;

/* Cálcula qual será a página inicial do nosso range */
$range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

/* Cálcula qual será a página final do nosso range */
$range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

/* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
$exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

/* Verifica se vai exibir o botão "Anterior" e "Último" */
$exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';
