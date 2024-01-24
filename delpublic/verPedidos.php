<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$acao = 'verPedidos';
include('ponteInfo.php');
date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['ok']) || $_SESSION['ok'] !== $_SESSION['verifique']) {
    header('Location: index.php?erro=2');
}

    foreach ($listaClientes as $key => $value) {
        $_SESSION['endCliente'][$value['id_cliente']] = $value;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Pedidos</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-xUz1tb1sfQz0Uq3bKEBxvN1c8NxiLE0sRiE3q6cVM3JxrMlVx5+qERtQ9bsvV75y" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="body">
    <?php 
    include('menuadm.php');
    
    ?>
    <nav id="faixa-menu-adm" class="text-center">
            <ul>
                <li><a id="abrirListaC" class="btn btn-danger">Clientes</a></li> | 
                <li><a class="btn btn-danger" href="verPedidos.php#motoBoy">Entregas Moto</a></li> |
                <li><a id="open" class="btn btn-danger"> Pedidos Antigos </a></li>
            </ul>
    </nav>
    fora container
    <div class="container">
        <div class="container col-md-6">
            <div class="container rolagem p-4 mb-4 bg-white rounded shadow-lg shadow-right shadow-bottom">
            <h2 id="tabelaPedidos"><b>Tabela de Pedidos</b></h2>
            <p><strong>Pedidos do dia</strong></p>
            <hr>
            <!-- foreach para chamar pedidos !-->
            <?php 
            $clienteRepete = 'cliente repete?';
            $horarioRepete = 'horario repete?';
            $count = 0;
            $countPedido = 0;
            $valorDia = 0;

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
                              $pedidosDia = $countPedido++;
                              $valorDia += $value['valor'];
                        
                              $cliente = $value['id_cliente'];
                              $telefone = $_SESSION['endCliente'][$cliente]['telefone']; 
                              $rua = $_SESSION['endCliente'][$cliente]['rua']; 
                              $numero = $_SESSION['endCliente'][$cliente]['numero']; 
                            
                              if ($horarioRepete != $horaPedido) {
                                 if ($clienteRepete != $cliente) {   ?>

                               <p class="bg-warning d-flex justify-content-center"><b>Nome : </b><?php print $value['nome_do_cliente']; ?> ID: <?php print $value['id_cliente']?> </p>
                               <p><b>Telefone:</b> <?php print $telefone ?>  </p>
                               <p><b>Endereço:</b> <?php print $rua ?> Nº <?php print $numero ?>  </p>
                               <p><b>DATA: </b> <?php print $dataPedido; ?></p> <!-- É necessario colocar a data aqui? !-->
                               
                            <?php 
                                $clienteRepete = $cliente;
                                $horarioRepete = $horaPedido;
                                }                                
                            }
                            ?>        
                            <p class="bg-primary d-flex justify-content-center"><b>Numero Pedido: </b><?php print $value['id'];?></p>
                            <p><b>Produto:</b> <?php print $value['produto']; ?></p>
                            <p><b>Observação:</b>                                                  </p>
                            <p><b>Para entrega ? </b> <?php if ($value['entrega'] > 0) { print 'SIM'; $count++;
                                                            } else { print 'NAO'; }; ?>  </p>
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
                                <div class="rolagem">
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
                                </div>
                            </dialog>
                <?php     }                     //colocar um dialog aqui com os pedidos de outros dias ?> 
                
            
        </div>
        </div>
            <dialog id="dialogListaCliente">
                <div class="container row">
                    <div class="col-md-6">
                        <b><h2 id="listaClientes">Lista de Clientes</h2></b>
                        <!-- Adição do campo de pesquisa -->
                        <input type="text" id="campoPesquisa" placeholder="Pesquisar Cliente" oninput="filtrarClientes()">
                    </div>
                </div>
                <div class="container rolagem">
                    <table id="tabelaClientes" class="table table-bordered">
                        <!-- Iteração sobre os clientes -->
                        <?php foreach ($listaClientes as $key => $valor) { ?>
                            <tr class="clienteRow">
                                <td>
                                    <p class="bg-success d-flex justify-content-center text-white"><b>
                                        <?php echo $valor['nome']; ?> ID: <?php echo $valor['id_cliente']; ?></b></p>
                                    <p><b>Telefone: <?php echo $valor['telefone']; ?></b></p>
                                    <p><b>Observação sobre cliente:</b></p>
                                    <hr>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-danger" id="fecharListaCliente">Fechar</button>
                </div>
            </dialog>
    </div>
                
    <div class="container testeBorda">
        <div class="row">
            <div class="col-md-6">
                <table>
                <tr class="testeBorda"><h2 id="motoBoy">Motoboy</h2>
                
                    <td>
                        <td>Numero de entregas: <?php print $count++ ?>  //</td>
                        <td>Valor a pagar: R$ $valorMotoboy  //</td>
                    </td>
                </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table>
                <tr class="testeBorda container text-center"><h1>Financeiro</h1>
                    <td>
                        <td><b class="text-xl"><h3>Vendas do Dia:</b></h3> <?php print $countPedido; ?>  </td>
                        <td><b class="text-sm"><h3>Receita Diaria:</b></h3> R$ <?php print $valorDia ?> </td>
                        <td><b class="text-lg"><h3>Valor do Mes:</b></h3> R$ $valorMes</td>
                    </td>
                </tr>
                </table>
            </div>
        </div>
        <?php // var_dump($listaPedidos); ?>

        <!-- DIALOG PEDIDOS ANTIGOS!-->

                    
        
    </div>
    <script src="script.js"></script>
</body>
</html>