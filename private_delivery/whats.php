<?php

$admCardapio = new AdmCardapio();
$conexao = new Conexao();
$comandos = new Comandos($conexao, $admCardapio);

$arrayProdutos;
$valorTotal = 0;

foreach ($listaPedidos as $key => $produto) 
{
    $arrayProdutos[$key] = $produto->produto;
}

include('../delPublic/valorTotal.php');
$valorTotal = $valorSomado + $_POST['entrega'];
$produtos = implode(', ', $arrayProdutos);


print '<script>window.open("https://api.whatsapp.com/send?phone=55' . $telefoneStringNumeros .
    '&text=Lista de produtos comprados ' . $produtos . 
    ' Valor total de ' . $valorTotal . 
    ' Agradecemos a preferencia ^_^", "_blank");</script>';
