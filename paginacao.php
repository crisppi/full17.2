<?php

# inclui o arquivo config(arquivo de conexão com o banco de dados)
require("configs/conexao.php");

# Limita o número de registros a serem mostrados por página
$limite = 75;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;

# seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
$sql = "SELECT * FROM imovel ORDER BY IMO_CODIGO DESC LIMIT " . $inicio . ", " . $limite;

try {

    $query = $pdo->prepare($sql);
    $query->execute();
} catch (PDOexception $error_sql) {

    echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
}

while ($linha = $query->fetch(PDO::FETCH_ASSOC)) { ?>

    <li>
        <h3><?= $linha['BAIRRO'] ?></h3>
        <a href="<?php bloginfo("url"); ?>/imovel?cod_consulta=<?= $linha['IMO_CODIGO'] ?>">
            <?php if ($semfoto == 'null') { ?>
                <img src="<?php bloginfo('url'); ?>/wp-content/uploads/2014/09/logo.jpg" />
            <?php } else { ?>
                <img src="<?= $linha['FOTO_PRINCIPAL'] ?>" />
            <?php } ?>
        </a>
        <div class="area"><?= round($linha['AREA_TOTAL']) ?>m²</div>
        <div class="vaga">2</div>
        <div class="dorm"><?= $linha['DORMITORIO'] ?></div>
        <?php if ($linha['CATEGORIA'] == 'CASA EM CONDOMINIO') {
            $emcondominio = explode(" ", $linha['CATEGORIA']);
            $nomemodificado = $emcondominio[1] . " " . $emcondominio[2];
            echo "<span class='categoria'>$nomemodificado</span>";
        } else { ?>
            <span class="categoria"><?= $linha['CATEGORIA'] ?></span>
        <?php } ?>
        <span class="valor"><?= money_format('%n', $linha['VLR_VENDA']) ?></span>
    </li>

<?php }

# seleciona o total de registros  
$sql_Total = 'SELECT IMO_CODIGO FROM imovel';

try {

    $query_Total = $pdo->prepare($sql_Total);
    $query_Total->execute();

    $query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);

    # conta quantos registros tem no banco de dados
    $query_count =  $query_Total->rowCount(PDO::FETCH_ASSOC);

    # calcula o total de paginas a serem exibidas
    $qtdPag = ceil($query_count / $limite);
} catch (PDOexception $error_Total) {

    echo 'Erro ao retornar os Dados. ' . $error_Total->getMessage();
}

# Cria os links para navegação das paginas
echo "<div class='relax h30'></div>";
# echo '<a href="busca?pg=1">PRIMEIRA PÁGINA</a>&nbsp;';
echo '<ul id="paginacao">';
echo '<li><a class="anterior" href="busca?pg=1">Anterior</a></li>';

if ($qtdPag > 1 && $pg <= $qtdPag) {

    for ($i = 1; $i <= $qtdPag; $i++) {

        if ($i == $pg) {

            echo "<li><a class='ativo'>" . $i . "</a></li>";
        } else {

            echo "<li><a href='busca?pg=$i'>" . $i . "</a></li>";
        }
    }
}

echo "<li><a class='proxima' href='busca?pg=$qtdPag'>Próxima</a></li>";

?>