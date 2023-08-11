<?php 
//if desnecessario, apenas require esta em uso
//Mas é uma segunda segurança para formularios em branco
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $categoria = $_POST['categoria'];
    $produto = $_POST['produto'];
    $valor = $_POST['valor'];

    if (empty($categoria) || empty($produto) || empty($valor)) {
        header('location: admControl.php?erro=1');
    } else {
        require_once "../private_delivery/dados.php";
    }

}







?>