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
                <li><a id="open" class="btn btn-danger"> Pedidos Antigos </a></li> |
                <li><a href="verPedidos.php#financeiro" class="btn btn-danger"> Financeiro </a></li>
            </ul>
    </nav>
    
    <div class="container">
    <div role="button" id="tabelaPedidos" class="pointer p-3 mt-4 bg-dark text-light rounded shadow-lg shadow-right shadow-bottom mb-0 border border-dark" onclick="expandirTabelaPedidos()">
        <h2><b>Tabela de Pedidos</b></h2>
        <p><strong>Pedidos do dia <?php print date('d/m/Y');?></strong></p>
    </div>
    <div id="pedidosHoje" class="pedidosHoje d-none mb-4 bg-white rounded-bottom shadow-lg shadow-right shadow-bottom border border-dark p-4">
        <div class="rolagem row">
            <?php 
            //$clienteRepete = null;
            $horarioRepete = null;
            $horarioRepete2 = null;
            $clienteRepete = null;
            $countEntregas = 0;
            $countPedido = 0;
            $valorDia = 0;
            $dataAtual = date('Y-m-d');

            foreach ($listaPedidos as $key => $value) {
                $dataHora = $value['data_insercao'];
                $dataPedido = substr($dataHora, 0, 10);
              
                if ($dataAtual == $dataPedido) { //chama apenas os pedidos do dia e ignora os pedidos de outros dias

                    
                    $horaData = $value['data_insercao'];
                    $horaPedido = substr($horaData, 11, 8);

                    $pedidosDia = $countPedido++;
                    $valorDia += $value['valor'];
                    
                    $cliente = $value['id_cliente'];
                    $telefone = $_SESSION['endCliente'][$cliente]['telefone']; 
                    $rua = $_SESSION['endCliente'][$cliente]['rua']; 
                    $numero = $_SESSION['endCliente'][$cliente]['numero']; 
                    
                    if ($horaPedido !== $horarioRepete) {  // SE 2 CLIENTES FIZEREM O PEDIDO NO MESMO SEGUNDO, VAI DAR RUIM #####

                        if ($clienteRepete !== $cliente) {  // FAZ A VERIFICAÇÃO ENTRE PEDIDO E CLIENTE
                        
                            echo '<div class="limpar"></div>';
                            ?>
                            
                            <p class="pedidosClientesDestaque text-left p-3 mt-4 rounded col-md-4"><b>Nome : </b><?php print $value['nome_do_cliente']; ?> ID: <?php print $value['id_cliente']?> </p>

                            <div class="d-flex justify-content-center bg-dark text-light rounded shadow-lg shadow-right shadow-bottom col-md-12">
                                <p class="p-1"><b>Telefone: </b> <?php print $telefone; ?>  </p>
                                <p class="p-1"><b>Endereço:</b> <?php print $rua ?> Nº <?php print $numero; ?>  </p>
                                <p class="p-1"><b>DATA: </b> <?php print $dataPedido; ?></p> <!-- É necessario colocar a data aqui? !-->
                            </div>
                        <?php 
                            $clienteRepete = $cliente;
                            $horarioRepete = $horaPedido;
                        }    // fechamento 
                    }
                    

                    echo '<div class="containerPedidos col-md-4 d-flex justify-content-center">';
                    echo '<div class="bloco bg-light p-3 rounded shadow-lg shadow-right shadow-bottom">';
                    
                    ?>    <!-- AAAAAAAAAAAAAAA !-->
                        <p class="bg-primary d-flex justify-content-center"><b>Numero Pedido: </b><?php print $value['id'];?></p>
                        <p><b>Produto:</b> <?php print $value['produto']; ?></p>
                        <p><b>Observação:</b>                                                  </p>
                        <p><b>Para entrega ? </b> <?php if ($value['entrega'] > 0 && $horaPedido != $horarioRepete2) 
                                                        { 
                                                            print 'SIM'; 
                                                            $countEntregas++ ; 
                                                            $horarioRepete2 = $horaPedido; 
                                                        } else 
                                                        { print 'NAO'; }; ?>  
                        </p>
                        <p><b>Hora: </b> <?php print $horaPedido; ?></p>
                    
                    <?php
                        echo '</div>';
                        echo '</div>';
                       
                    }
                    ?>
            <?php } ?>
        </div>
    </div>
</div>
            <?php //var_dump($listaPedidos)  // CADE O CLIENTE 86 ?
            ?> 
            
            <!-- INICIO conteudo expansivel !-->
            <div class="container p-4 my-4 bg-white rounded shadow-lg shadow-right shadow-bottom rolagem">
                <div class="expansivel" data-inicial="fechado">
                    <div class="expansivel-header text-center" onclick="toggleExpansao(this)">
                        <h2><b>PEDIDOS ANTIGOS</b></h2>
                    </div>
                    <form method="post" class="p-2">
                        <label for="dataSelecionada">Selecione uma data:</label>
                        <input type="date" id="dataSelecionada" name="dataSelecionada">
                        <input type="submit" value="Filtrar">
                    </form>
                    <div class="d-flex block-inline">
                        <form id="FormOrderName" method="post" class="p-2">
                            <input type="submit" id="orderName" name="orderName" value='Filtrar por Nome'> 
                        </form>
                        <form id="FormOrderData" method="post" class="p-2">
                            <input type="submit" id="orderData" name="orderData" value='Filtrar por Data'> 
                        </form>
                    </div>

                    <?php
                    
                    if (isset($_POST['orderName'])) {
                        
                        $lista = $listaAntigos;    
                    } else {
                        unset($_POST['orderName']);
                        $lista = $listaPedidos;
                    }
                    $horarioRepeteAntigo = null;

                    foreach ($lista as $key => $value) {
                            $dataHora = $value['data_insercao'];
                            $dataPedido = substr($dataHora, 0, 10);
                            $horaData = $value['data_insercao'];
                            $horaPedido = substr($horaData, 11, 8);
                            $dataAtual = date('Y-m-d');
                         

                            if ($dataAtual > $dataPedido) 
                            {
                                $clienteAntigo = $value['id_cliente'];
                                $telefone = $_SESSION['endCliente'][$clienteAntigo]['telefone']; 
                                $rua = $_SESSION['endCliente'][$clienteAntigo]['rua']; 
                                $numero = $_SESSION['endCliente'][$clienteAntigo]['numero'];
                                ?>
                        
                    <div>

                        <?php 
                            if ($dataAtual > $dataPedido) { ?>
                                
                                <?php 
                                    if ($horaPedido !== $horarioRepeteAntigo) {  // SE 2 CLIENTES FIZEREM O PEDIDO NO MESMO SEGUNDO, VAI DAR RUIM
                                        echo '<div class="limpar"></div>';
                                ?>

                                <p class="pedidosClientesDestaque text-left p-3 mt-4 rounded col-md-4"><b>Nome : </b><?php print $value['nome_do_cliente']; ?> <b> ID: </b> <?php print $value['id_cliente']?>  </p>

                                    <div class="d-flex justify-content-center bg-dark text-light rounded shadow-lg shadow-right shadow-bottom">
                                        <p class="p-1"><b>Telefone: </b> <?php print $telefone; ?>  </p>
                                        <p class="p-1"><b>Endereço:</b> <?php print $rua ?> Nº <?php print $numero; ?>  </p>
                                        <p class="p-1"><b>DATA: </b> <?php print $dataPedido; ?></p> <!-- É necessario colocar a data aqui? !-->
                                    </div>

                                    <?php 
                                        $horarioRepeteAntigo = $horaPedido;
                                        } // fechamento horarioPedido ?>
                                
                                    <div class="bloco container containerPedidos col-md-4 d-flex justify-content-center">
                                        <div class="bloco bg-light p-3 rounded shadow-lg shadow-right shadow-bottom">
                            
                                        
                                            <p class="bg-primary text-center"><b>Numero Pedido: </b><?php print $value['id'];?></p>
                                            <p><b>Produto:</b> <?php print $value['produto']; ?></p>
                                            <p><b>Observação:</b>                                                  </p>
                                            <p><b>Para entrega ? </b> <?php if ($value['entrega'] > 0) { print 'SIM'; $countEntregas++;
                                                                            } else { print 'NAO'; }; ?>  </p>
                                            <p><b>Hora: </b> <?php print $horaPedido; ?></p>
                                
                            
                                        </div>
                                    </div>
                                <?php    
                               
                            }
                            ?>
                    </div>
                 <!-- fim conteudo expansivel !-->
                <?php } // fim IF data pedido antigo
            }?> <!-- fim foreach !-->
                        <div class="d-flex  justify-content-center">
                            <button id="fecharDialog" class="btn btn-danger">
                                Fechar
                            </button>
                        </div>   
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
    
    <?php 
        
        
    ?>
    
    <div class="bg-white shadow-lg shadow-right shadow-bottom">

                        <h1 class="text-center mb-4"><b>Financeiro</b></h1>
        <div class="d-md-flex justify-content-center">
            <div class="d-inline-block col-md-3 h-90">
                
                    <div class="p-4 mb-4 bg-white rounded shadow-lg shadow-right shadow-bottom">
                                        
                        <ul class="list-unstyled"><h2 id="motoBoy" class="text-center"><b>Motoboy</b></h2>
                            
                            <li><b><h3>Valor da viagem: R$ <?php print $_SESSION['freteMotoboy']; ?></h3></b></li>
                            <li><b><h3>Numero de entregas: <?php print $countEntregas ?></h3></b> </li>
                            <li><b><h3>Valor a pagar: R$ <?php print $_SESSION['freteMotoboy'] * $countEntregas ?> </h3></b> </li>
                            
                        </ul>
                        
                    </div>
                
            </div>

            <div id="financeiro" class="d-inline-block ps-5 col-md-3 h-100">
                <div class=" p-4 mb-4 bg-white rounded shadow-lg shadow-right shadow-bottom">
                            <ul class="text-center list-unstyled">
                                
                                    <li ><h4>Vendas do Dia:</h4> <?php print $countPedido; ?>  </li>
                                    <li ><h4>Receita Diaria:</h4> R$ <?php print $valorDia ?> </li>
                                    <li ><h3>Valor do Mes:</h3> R$ $valorMes</li>
                                
                            </ul>
                </div>
            </div>
            
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>