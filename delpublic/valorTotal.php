<?php // PHP =============================================
$valorSomado = 0;
$qtdTotal = 0;

foreach ($listaPedidos as $indice => $produto) {
    $valor = $produto->valor * $produto->numero_pedido;
    $valorSomado += $valor;

    $qtd = $produto->numero_pedido;
    $qtdTotal += $qtd;
}




?>