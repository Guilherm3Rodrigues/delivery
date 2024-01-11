<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$acao = 'verPedidos';
include('ponteInfo.php');
date_default_timezone_set('America/Sao_Paulo');
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
    <nav id="faixa-menu-adm" style="text-align:center;">
            <ul>
                <li><a href="verPedidos.php#listaClientes">Clientes</a></li> | 
                <li><a href="verPedidos.php#motoBoy">Entregas Moto</a></li> | 
            </ul>
    </nav>
    fora container
    <div class="container row">
        <div class="col-md-6">
        <div class="container testeBorda">
            <tr class="testeBorda"><h2 id="tabelaPedidos">Tabela de Pedidos</h2>
            <p><strong>Pedidos do dia</strong></p>
            <!-- foreach para chamar pedidos !-->
            <?php 
            foreach ($listaPedidos as $key => $value) {
                $dataHora = $value['data_insercao'];
                $dataPedido = substr($dataHora, 0, 10);
                $horaData = $value['data_insercao'];
                $horaPedido = substr($horaData, 11, 8);
                $dataAtual = date('Y-m-d');

            ?> 
                <div>
                <?php 
                    if ($dataAtual == $dataPedido) {
                        print 'feito hoje esse pedido' ;?>
                    <hr>
                    <p><b>Numero Pedido: </b><?php print $value['id'];?>//</p>
                    <p><b>Nome: </b><?php print $value['id_cliente'];?>//</p>
                    <p><b>Telefone: </b>  </p>
                    <p><b>Produto:</b> <?php print $value['produto']; ?></p>
                    <p><b>Observação:</b>                                                  </p>
                    <p><b>Para entrega ? </b>  </p>
                    <p><b>Endereço: </b>  </p>
                    <p><b>DATA: </b> <?php print $dataPedido; ?></p>
                    <p><b>Hora: </b> <?php print $horaPedido; ?></p>
                    <?php 
                    } 
                    else
                    {
                        print '<button class="btn btn-danger"> Pedidos Antigos </button>';
                        //colocar um dialog aqui com os pedidos de outros dias
                    }
                    ?>
                    
                </div>
                <?php }?> 
                
            </tr>
        </div>
        </div>
        <div class="col-md-4">
        <div class="container testeBorda">
            <table>
                <tr class="testeBorda"><h2 id="listaClientes">Lista de Clientes</h2>
                <!-- foreach para chamar todos os clientes que ja fizeram pedido !-->
                    <p>Nome  //</p>
                    <p>Telefone  //</p>
                    <p>numero de pedidos  //</p>
                    <p>Observação:</p>
                </tr>
            </table>
        </div>
        </div>
    </div>
    <div class="container testeBorda">
        <div class="row">
            <div class="col-md-6">
                <table>
                <tr class="testeBorda"><h2 id="motoBoy">Motoboy</h2>
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