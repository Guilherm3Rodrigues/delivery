<?php // PHP =============================================
$valorSomado = 0;
foreach ($listaPedidos as $indice => $produto) {
    $valor = $produto->valor * $produto->numero_pedido;
    $valorSomado += $valor;
}
?>