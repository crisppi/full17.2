<?php
class pagination
{

    // NUMERO DE RESGISTROS POR PAGINA

    private $limite;

    //QUANTIDADE DE RESULTADOS 
    private $results;

    //QUANTIDADE DE PAGINAS 
    private $pages;


    //PAGINA ATUAL 
    private $currentPage;

    public function __construct($results, $currentPage = 1, $limite = 10)
    {
        //CONSTRUTOR DA CLASSE
        $this->results = $results;
        $this->limite = $limite;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }

    private function calculate()
    { // calcula o total de paginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limite) : 1;

        //verifica se a pagina atual nao excede o numero de paginas
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    public function getLimit()
    {
        // retorna a clausula limite 
        $offSet = ($this->limite *  ($this->currentPage - 1));
        return $offSet . ',' . $this->limite;
    }

    // retorna a opcoes de paginas disponiveis
    public function getPages()
    {
        if ($this->pages == 1) return [];
        $paginas = [];

        for ($i = 1; $i <= $this->pages; $i++) {
            $paginas[] = [
                'pag' => $i,
                'atual' => $i == $this->currentPage

            ];
        };


        return $paginas;
    }
}
