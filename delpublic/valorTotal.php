<?php // PHP =============================================
$valorSomado = 0;
$qtdTotal = 0;

/*if (isset($listaPedidos)) {
    foreach ($listaPedidos as $indice => $produto) {
        $valor = $produto->valor * $produto->numero_pedido;
        $valorSomado += $valor;

        $qtd = $produto->numero_pedido;
        $qtdTotal += $qtd;
    }
}*/

if (isset($_SESSION['itens'])) {
    foreach ($_SESSION['itens'] as $itens) {
        $valor = $itens['valor'] * $itens['numero_pedido'];
        $valorSomado += $valor;

        $qtd = $itens['numero_pedido'];
        $qtdTotal += $qtd;
    }
}