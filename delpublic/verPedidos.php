<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$acao = 'recuperar';
include('ponteInfo.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php 
    include('menuadm.php');
    ?>
    fora container
    <div class="container testeBorda">
        <table>
        <tr class="testeBorda"><h2>Tabela de Pedidos</h2>
        <p><strong>Pedidos do dia?</strong></p>
        <!-- foreach para chamar pedidos !-->
            <td>Nome  //</td>
            <td>Telefone  //</td>
            <td>Pedido                                                       //</td>
            <td>Observação:                                                  //</td><!-- ainda não existe area de observação sobre o pedido para o cliente !-->
            <td>Para entrega ?  //</td>
            <td>Endereço:  //</td>
        </tr>
        <tr>
            <td>
            <button class="btn btn-danger">Pedidos Anteriores</button> <!-- Criar dialog com filtro de data? ou criar um filtro de data com todos juntos na pag principal !-->
            </td>
            <td>1º pedidos //</td>
            <td>2º pedidos  //</td>
            <td>3º pedidos   </td>
        </tr>
        </table>
    </div>
    <div class="container testeBorda">
        <table>
            <tr class="testeBorda"><h2>Lista de Clientes</h2>
            <!-- foreach para chamar todos os clientes que ja fizeram pedido !-->
                <td>Nome  //</td>
                <td>Telefone  //</td>
                <td>numero de pedidos  //</td>
                <td>Observação:</td>
            </tr>
        </table>
    </div>
    <div class="container testeBorda">
        <div class="row">
            <div class="col-md-6">
                <table>
                <tr class="testeBorda"><h2>Motoboy</h2>
                    <td>
                        <td>Numero de entregas: $numeroEntregas  //</td>
                        <td>Valor a pagar: R$ $valorMotoboy  //</td>
                    </td>
                </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table>
                <tr class="testeBorda"><h2>Financeiro</h2>
                    <td>
                        <td>Numero de vendas: $numeroVendas  //</td>
                        <td>Valor do Dia: R$ $valorDia  //</td>
                        <td>Valor do Mes: R$ $valorMes</td>
                    </td>
                </tr>
                </table>
            </div>
        </div>
        
    </div>
</body>
</html>