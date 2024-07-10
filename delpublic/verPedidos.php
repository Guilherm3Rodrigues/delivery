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
        button{
            margin: 1px;
        }
        .testeBorda{
            border: 2px solid black;
            self-align: center;
            margin: auto;
            width: 95%;
            margin: 2%;
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
            border: 1px solid black;
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
            
            //criar uma requisição para mostrar os pedidos
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

        function showHidePedAnteriores() {
            let url = window.location.href.split('?')[1];
            let periodoInicial = document.getElementById('periodoInicial').value;
            let periodoFinal = document.getElementById('periodoFinal').value;
            
            if (url) {
                window.location.href = window.location.href.split('?')[0];
            } else {
                window.location.href = window.location.href + '?start=' + periodoInicial + '&end=' + periodoFinal;
            }
        }



    </script>
</head>
<body>
    <?php 
        include('menuadm.php');
    ?>

    <div class="container testeBorda">
        <table class="testeBorda">
        <tr><h2>Tabela de Pedidos</h2>
        <p><strong>Pedidos do dia?</strong></p>
            <td style="width: 20vw">Nome  </td>
            <td>Telefone </td> 
            <td>Pedido</td> <!-- transfomar em uma acao que abre um janela com os pedidos e junta observação, assim da ate pra cria um resumo do pedido !-->
            <td style="max-width: 25vw,width: 10vw">Observação:</td><!-- ainda não existe area de observação sobre o pedido para o cliente !-->
            <td style="max-width: 30vw,width: 20vw">Endereço: </td><!-- eu juntaria entrega e endereço no mesmo campo porque se nao for entregar para que um campo de endereco  !-->
            <td>Status</td>
        </tr>
            <?php
                $todasDatas = isset($_GET['todasDatas']) ? true : false;
                $arrayPedidos = listarPedidosBD($todasDatas);
        
                foreach ($arrayPedidos as &$pedido) {
                    print("<tr>");
                        print("<td>".$pedido->id_cliente." </td>");
                        print("<td><input type='text' value='$pedido->telefone' disabled></td> ");
                        print("<td><a onclick='showpedido($pedido->nunPedido)'>$pedido->nunPedido</td>");
                        print("<td>$pedido->observacao</td> ");
                        if($pedido->paraEntregar)print("<td>$pedido->endereco </td>");
                        else print("<td>Retirar no local</td>");
                        print("<td>$pedido->status</td>");
                    print("</tr>");
                }

                if (count($arrayPedidos) == 0) {
                    print("<tr><td colspan='5'>Nenhum pedido encontrado</td></tr>");
                }
            ?>
        </tr>
        <tr>
            <td colspan="5">
                <input name="periodoInicial" id="periodoInicial" type="date">
                <input name="periodoFinal" id="periodoFinal" type="date">
                <button class="btn btn-danger" onclick="showHidePedAnteriores()" ><?php
                
                if (isset($_GET['todasDatas'])) {
                    print("Pedidos do dia");
                } else {
                    print("Todos os pedidos");
                }
                
                ?></button> <!-- Criar dialog com filtro de data? ou criar um filtro de data com todos juntos na pag principal !-->
            </td>
        </tr>
        </table>
        
    </div>
    <div class="container testeBorda">
        <script>
            function editarCliente(id) {
                console.log(id);

                let nome = document.getElementById('nome' + id);
                let tel = document.getElementById('tel' + id);
                let end = document.getElementById('end' + id);
                let btn = document.getElementById('btn' + id);

                let nomebkp = nome.innerHTML;
                let telbkp = tel.innerHTML;
                let endbkp = end.innerHTML;

                nome.setAttribute('contenteditable', 'true');
                tel.setAttribute('contenteditable', 'true');
                end.setAttribute('contenteditable', 'true');

                btn.innerHTML = '<button class="btn btn-success" onclick="salvarCliente('+id+')">Salvar</button>';
                btn.innerHTML += '<button class="btn btn-danger" onclick="cancelarCliente('+id+','+nomebkp+','+telbkp+','+endbkp+')">Cancelar</button>';

            }

            function salvarCliente(id) {
                let nome = document.getElementById('nome' + id);
                let tel = document.getElementById('tel' + id);
                let end = document.getElementById('end' + id);
                let btn = document.getElementById('btn' + id);

                nome.setAttribute('contenteditable', 'false');
                tel.setAttribute('contenteditable', 'false');
                end.setAttribute('contenteditable', 'false');

                btn.innerHTML = '<button class="btn btn-info" onclick="editarCliente('+id+')">Editar</button>';
                btn.innerHTML += '<button class="btn btn-danger" onclick="removerCliente('+id+')">Remover</button>';

                /// Lancar no Banco de dados !
            }

            function removerCliente(id) {
                let btn = document.getElementById('btn' + id);

                let nomebkp = document.getElementById('nome' + id).innerHTML;
                let telbkp = document.getElementById('tel' + id).innerHTML;
                let endbkp = document.getElementById('end' + id).innerHTML;

                btn.innerHTML = `remover cliente?<br>`;	
                btn.innerHTML += `<button class="btn btn-" onclick="confirmarExclusao('${id}')">Sim</button>`;	
                btn.innerHTML += `<button class="btn btn-content" onclick="cancelarRemocaoCliente('${id}')">Não</button>`;

            }

            function confirmarExclusao(id) {
                let tr = document.getElementById('cliente' + id);

                tr.remove();

            }

            function cancelarRemocaoCliente(id) {
                let btn = document.getElementById('btn' + id);
                btn.innerHTML = `<button class="btn btn-info" onclick="editarCliente('${id}')">Editar</button>`;
                btn.innerHTML += `<button class="btn btn-danger" onclick="removerCliente('${id}')">Remover</button>`;
            }
            function cancelarCliente(id,nomebkp,telbkp,endbkp) {
                
                let nome = document.getElementById('nome' + id);
                let tel = document.getElementById('tel' + id);
                let end = document.getElementById('end' + id);
                let btn = document.getElementById('btn' + id);

                nome.innerHTML = nomebkp;
                tel.innerHTML = telbkp;
                end.innerHTML = endbkp;

                nome.setAttribute('contenteditable', 'false');
                tel.setAttribute('contenteditable', 'false');
                end.setAttribute('contenteditable', 'false');

                btn.innerHTML ='<button class="btn btn-info" onclick="editarCliente('+id+')">Editar</button>';
                btn.innerHTML +='<button class="btn btn-danger" onclick="removerCliente('+id+')">Remover</button>';
            }
            
        </script>
        <table>
            <tr class="testeBorda"><h2>Lista de Clientes</h2>
            <!-- foreach para chamar todos os clientes que ja fizeram pedido !-->
                <td>NOME</td>
                <td>TELEFONE</td>
                <td style="max-width: 25vw,width: 15vw">ENDEREÇO</td>
                <td>#</td>
            </tr>
            <?php 
                $arrayClientes = listaClientesBD();
                foreach ($arrayClientes as &$cliente) {
                    print("<tr id='cliente$cliente->id'>");
                        print("<td id='nome$cliente->id'>$cliente->nome</td>");
                        print("<td id='tel$cliente->id'>$cliente->telefone</td>");
                        print("<td id='end$cliente->id'>$cliente->endereco</td>");
                        print("<td id='btn$cliente->id'>
                            <button class='btn btn-info' onclick='editarCliente($cliente->id) '>Editar</button>
                            <button class='btn btn-danger' onclick='removerCliente($cliente->id) '>Remover</button></td>");
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
                
                </td>
                </tr>
                </table>
            </div>
        </div>
        
    </div>


</body>
</html>