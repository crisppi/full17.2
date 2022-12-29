<?php

# inclui o arquivo config(arquivo de conexão com o banco de dados)
require("..//db.php");
require_once("hospitalDao.php");
require_once("./models/hospital.php");

# Limita o número de registros a serem mostrados por página
$limite = 5;

# Se pg não existe atribui 1 a variável pg
$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

# Atribui a variável inicio o inicio de onde os registros vão ser
# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
$inicio = ($pg * $limite) - $limite;

# seleciona os registros do banco de dados pelo inicio e limitando pelo limite da variável limite
$sql = "SELECT * FROM tb_hospital ORDER BY id_hospital DESC LIMIT " . $inicio . ", " . $limite;

try {

    $query = $conn->prepare($sql);
    $query->execute();
} catch (PDOexception $error_sql) {

    echo 'Erro ao retornar os Dados.' . $error_sql->getMessage();
}

while ($linha = $query->fetch(PDO::FETCH_ASSOC)) { ?>

    <table class="table" id="hospitals-table">
        <thead>
            <tr>
                <th scope="col">Reg</th>
                <th scope="col">Hospital</th>
                <th scope="col">Endereço</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hospitals as $hospital) : ?>
                <tr>
                    <td scope="row" class="col-id"><?= $hospital["id_hospital"] ?></td>
                    <td scope="row"><?= $hospital["nome_hosp"] ?></td>
                    <td scope="row"><?= $hospital["endereco_hosp"] ?></td>
                    <td class="actions">
                        <a href="<?= $BASE_URL ?>show.php?id_hospital=<?= $hospital["id_hospital"] ?>"><i class="fas fa-eye check-icon" style="color:green"></i></a> <a href="<?= $BASE_URL ?>editar_hospital.php?id_hospital=<?= $hospital["id_hospital"] ?>"><i class="far fa-edit edit-icon"></i></a>
                        <form class="delete-form" action="<?= $BASE_URL ?>config/process_hosp.php" method="POST">
                            <input type="hidden" name="type" value="delete_hosp"> <input type="hidden" name="id_hospital" value="<?= $hospital["id_hospital"] ?>"> <button type="submit" class="delete-btn" style="color:red; border-width:1px"><i class="fas fa-times delete-icon"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php }

# seleciona o total de registros  
$sql_Total = 'SELECT id_hospital FROM tb_hospital';

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