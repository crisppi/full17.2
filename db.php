<?php

$host = "mdb-accert.mysql.uhserver.com";
$user = "diretoria2";
$pass = "Guga@0401";
$dbname = "mydb_accert";
$port = 3306;
try {
    $conn = new PDO("mysql:dbname=$dbname;host=$host", $user, $pass);

    // Habilitar erros PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (Exception $e) {

    echo "Falha na conecção";
}
