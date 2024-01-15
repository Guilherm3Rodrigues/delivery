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
                <li><a class="btn btn-danger" href="verPedidos.php#listaClientes">Clientes</a></li> | 
                <li><a class="btn btn-danger" href="verPedidos.php#motoBoy">Entregas Moto</a></li> |
                <li><a id="open" class="btn btn-danger"> Pedidos Antigos </a></li>
            </ul>
    </nav>
    fora container
    <div class="container row">
        <div class="col-md-6">
        <div class="container testeBorda rolagem">
            <h2 id="tabelaPedidos"><b>Tabela de Pedidos</b></h2>
            <p><strong>Pedidos do dia</strong></p>
            <hr>
            <!-- foreach para chamar pedidos !-->
            <?php 
            $clienteRepete = 'cliente repete?';

            foreach ($listaPedidos as $key => $value) {
                $dataHora = $value['data_insercao'];
                $dataPedido = substr($dataHora, 0, 10);
                $horaData = $value['data_insercao'];
                $horaPedido = substr($horaData, 11, 8);
                $dataAtual = date('Y-m-d');
            ?> 
                <div>
                <?php 
                    if ($dataAtual == $dataPedido) { ?>
                        <?php $cliente = $value['id_cliente'];

                            if ($clienteRepete != $cliente) { ?>
                               <p class="bg-warning d-flex justify-content-center"><b>Nome : </b><?php print $value['nome_do_cliente']; ?> ID: <?php print $value['id_cliente']?> </p>
                               <p><b>Telefone: </b>  </p>
                               <p><b>Endereço: </b>  </p>
                               <p><b>DATA: </b> <?php print $dataPedido; ?></p> <!-- É necessario colocar a data aqui? !-->
                            <?php 
                                $clienteRepete = $cliente;                                
                            }
                            ?>        
                            <p class="bg-primary d-flex justify-content-center"><b>Numero Pedido: </b><?php print $value['id'];?></p>
                            <p><b>Produto:</b> <?php print $value['produto']; ?></p>
                            <p><b>Observação:</b>                                                  </p>
                            <p><b>Para entrega ? </b>  </p>
                            <p><b>Hora: </b> <?php print $horaPedido; ?></p>
                            <hr>
                            <?php
                            } 
                            ?>
                </div>
                            <dialog id="dialog" class="dialogStyle">
                                        <form>
                                            <label for="dataSelecionada">Selecione uma data:</label>
                                            <input type="date" id="dataSelecionada" name="dataSelecionada">
                                            <input type="submit" value="Filtrar">
                                        </form>
                                    <?php 
                                        if ($dataAtual > $dataPedido) { ?>
                                            <p class="container d-flex align-items-center justify-content-center"><b>DATA: </b> <?php print $dataPedido; ?></p>
                                                <p class="bg-warning d-flex justify-content-center"><b>Nome : </b><?php print $value['nome_do_cliente']; ?> ID: <?php print $value['id_cliente']?></p>
                                                <p><b>Telefone: </b>  </p>
                                                <p><b>Endereço: </b>  </p>
                                                <p><b>DATA: </b> <?php print $dataPedido; ?></p>
                                            
                                                <p class="bg-primary d-flex justify-content-center"><b>Numero Pedido: </b><?php print $value['id'];?></p>
                                                <p><b>Produto:</b> <?php print $value['produto']; ?></p>
                                                <p><b>Observação:</b>                                                  </p>
                                                <p><b>Para entrega ? </b>  </p>
                                                <p><b>Hora: </b> <?php print $horaPedido; ?></p>
                                                <hr>
                                                <?php
                                                } 
                                                ?>

                                <div class="d-flex  justify-content-center">
                                        <button id="fecharDialog" class="btn btn-danger">
                                            Fechar
                                        </button>
                                </div>
                            </dialog>
                <?php }                         //colocar um dialog aqui com os pedidos de outros dias ?> 
                
            
        </div>
        </div>
        <div class="col-md-4">
        <div class="container testeBorda rolagem">
            <table>
                <b><tr class="testeBorda"><h2 id="listaClientes">Lista de Clientes</h2></b>
                <!-- foreach para chamar todos os clientes que ja fizeram pedido !-->
                <?php 
                    foreach ($listaClientes as $key => $valor) { ?>
                        <p class="bg-success d-flex justify-content-center text-white"><b><?php print $valor['nome']; ?> ID: <?php print $valor['id_cliente'] ?></b></p>
                        <p><b> Telefone: <?php print $valor['telefone']; ?> </b></p>
                        <p><b>Observação sobre cliente: </b></p>
                        <hr>
                    <?php }
                ?>
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

        <!-- DIALOG PEDIDOS ANTIGOS!-->

                    
        
    </div>
    <script src="script.js"></script>
</body>
</html>