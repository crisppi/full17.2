<?php
echo ('chegou no aquivo Tratar.PHP: ');
//var_dump($_POST);
echo ('<br>');

var_dump($_POST['confirmado']);
echo ('<br>');

echo ($_POST['id_antecedente']);
echo ('<br>');
echo ($_POST['type']);
echo ('<br>');

if ($_POST['confirmado'] == "nao") {
    echo ('nao confirmados');
}
echo ('<br>');


if ($_POST['confirmado'] == "sim") {
    print_r("chegou nesse ponto do sim");
}

$formId_capt = $_POST['id_antecedente'];
echo (" voce pegou este ID :" . $formId_capt);
