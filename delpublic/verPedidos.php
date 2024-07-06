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
    <style>
        .testeBorda{
            border: 2px solid black;
            self-align: center;
            margin: auto;
        }
        .testeborda tr:first-child{
            font-weight: bold;
            font-size: 20px;
            border: 2px solid #cc7f0f;
            background-color: #ff7c0c;
        }
        .testeborda tr{
            border: 1px solid #ccc;

        }

        .testeBorda td{
            border-right: 1px solid #ccc;
            text-align: center;
        }
        .testeBorda td input{
            border: 0px;
            text-align: center;
        }
        .showpedido{
            border: 2px solid black;
            self-align: center;
            margin: auto;
            padding: 10px;
            background-color: orange;
            width: 90vw;
            height: 70vh;
            overflow-y: scroll;
            position: fixed;
            top: 10vh;
            left: 5vw;
        }
        .tabelaDetalhes{
            border: 2px solid black;
            self-align: center;
            margin: auto;
            padding: 10px;
            width: 90%;
        }
        .tabelaDetalhes tr:first-child{
            font-weight: bold;
            font-size: 25px;
            color: white;
            background-color: #505ab5;
            border: 1px solid black;
            text-align: center;
        }
        .tabelaDetalhes td{
            font-weight: bold;
            font-size: 20px;
            border: 1px solid black;
            text-align: center;
        }

    </style>
    <script>
        function showpedido(id) {
            console.log(id);
            let div = document.createElement('div');
            div.setAttribute('class', 'showPedido');
            
            let closebtn = document.createElement('button');
            closebtn.setAttribute('class', 'closebtn');
            closebtn.innerHTML = 'X';
            closebtn.addEventListener('click', () => {
                div.remove();
            });
            div.appendChild(closebtn);

            document.body.appendChild(div);
            
            //ajax para mostrar os pedidos
            var request = new XMLHttpRequest();
            request.open('GET','ponteInfo.php?acao=buscarNumPedido&id='+ id,true);
            request.onreadystatechange = function() {
                if (request.readyState === 4 && request.status === 200) {
                    //callback(null, request.responseText);
                    let tabela = document.createElement('table'); 
                    tabela.setAttribute('class', 'tabelaDetalhes');
                    let pedidos = JSON.parse(request.responseText);
                    let tr = document.createElement('tr');
                    let td = document.createElement('td');
                    td.innerHTML = 'PRODUTO';
                    tr.appendChild(td);

                    td = document.createElement('td'); 
                    td.innerHTML = 'VALOR';
                    tr.appendChild(td);

                    td = document.createElement('td'); 
                    td.innerHTML = 'DESCRIÇÃO';
                    tr.appendChild(td);

                    td = document.createElement('td'); 
                    td.innerHTML = 'QUANT.';
                    tr.appendChild(td);

                    tabela.appendChild(tr);

                    pedidos.forEach(pedido => {
                        let tr = document.createElement('tr');
                        let td = document.createElement('td');
                        td.innerHTML = pedido['produto'];
                        tr.appendChild(td);

                        td = document.createElement('td'); 
                        td.innerHTML = "R$" + pedido['valor'];
                        tr.appendChild(td);

                        td = document.createElement('td'); 
                        td.innerHTML = pedido['descricao'];
                        tr.appendChild(td);

                        td = document.createElement('td'); 
                        td.innerHTML = pedido['quantidade'];
                        tr.appendChild(td);

                        tabela.appendChild(tr);
                    });

                    div.appendChild(tabela);
                } else if (request.readyState === 4) {
                    console.log('Erro ao obter a resposta do servidor');
                }
            }
            request.send();

        }
    </script>
</head>
<body>
    <?php 
    include('menuadm.php');
    ?>
    fora container
    <div class="container testeBorda">
        <table class="testeBorda">
        <tr><h2>Tabela de Pedidos</h2>
        <p><strong>Pedidos do dia?</strong></p>
        <!-- foreach para chamar pedidos !-->
            <td style="width: 20vw">Nome  </td>
            <td>Telefone </td> 
            <td>Pedido</td> <!-- transfomar em uma acao que abre um janela com os pedidos e junta observação, assim da ate pra cria um resumo do pedido !-->
            <td style="max-width: 25vw,width: 10vw">Observação:</td><!-- ainda não existe area de observação sobre o pedido para o cliente !-->
            <td style="max-width: 30vw,width: 20vw">Endereço: </td><!-- eu juntaria entrega e endereço no mesmo campo porque se nao for entregar para que um campo de endereco  !-->
        </tr>
            <?php 

                $arrayPedidos = listarPedidosBD();
                print_r($arrayPedidos[0]->id_cliente);
                foreach ($arrayPedidos as &$pedido) {

                    print("<tr>");
                        print("<td>".$pedido->id_cliente." </td>");
                        print("<td><input type='text' value='$pedido->telefone' disabled></td> ");
                        print("<td><a onclick='showpedido($pedido->nunPedido)'>$pedido->nunPedido</td>");
                        print("<td>$pedido->observacao</td> ");
                        if($pedido->paraEntregar)print("<td>$pedido->endereco </td>");
                        else print("<td>Retirar no local</td>");
                    print("</tr>");
                }
                
            ?>
        </tr>
        <tr>
            <td>
                <button class="btn btn-danger">Pedidos Anteriores</button> <!-- Criar dialog com filtro de data? ou criar um filtro de data com todos juntos na pag principal !-->
            </td>
        </tr>
        </table>
    </div>
    <div class="container testeBorda">
        <table>
            <tr class="testeBorda"><h2>Lista de Clientes</h2>
            <!-- foreach para chamar todos os clientes que ja fizeram pedido !-->
                <td>NOME</td>
                <td>TELEFONE</td>
                <td>ENDEREÇO</td>
            </tr>
            <?php 
                $arrayClientes = listaClientesBD();
                foreach ($arrayClientes as &$cliente) {
                    print("<tr>");
                        print("<td>$cliente->nome</td>");
                        print("<td>$cliente->telefone</td>");
                        print("<td>$cliente->endereco</td>");
                    print("</tr>");
                }
            ?>
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
                    41085200+
                
                </td>
                </tr>
                </table>
            </div>
        </div>
        
    </div>


</body>
</html>