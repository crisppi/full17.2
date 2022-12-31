<?php
echo ('dados cadastrados');
var_dump($_POST);
echo ('<br>');

echo ($_POST['confirmado']);
echo ('<br>');

echo ($_POST['id_antecedente']);
echo ('<br>');
echo ($_POST['type']);
echo ('<br>');

if ($_POST['confirmado'] == "nao") {
}
echo ('<br>');


if ($_POST['confirmado'] == "sim") {
    print_r("chegou nesse ponto do sim");
}
