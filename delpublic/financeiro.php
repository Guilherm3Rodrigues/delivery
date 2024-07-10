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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <?php 
        include('menuadm.php');
    ?>
        
    <script>
        window.addEventListener("load", function() {

            //Pedidos por semana
            criarGraficoPxS();

            //Top 5 mais pedidos
            criarGraficoTopPedidos();

            //Top 5 menos pedidos

            //Frequência de pedidos de um cliente/mes x gasto em media/mês x faixa media de gasto dos clientes
        
            //Bedidas mais pedidas x dia de semana

            //categorias mais pedidas x dia de semana

            //Top 5 clientes que mais gastam x frequência de pedidos

            //Top 5 clientes que menos gastam x frequência de pedidos

            //Satifacao do cliente ?? 


        });
        
        function criarGraficoPxS() {
            let ctx = document.getElementById('pedidosxSemana');
            
            var request = new XMLHttpRequest();
            request.open('GET','ponteInfo.php?acao=financeiroPedidosxSemana',true);
            request.onreadystatechange = function() {
                if (request.readyState === 4 && request.status === 200) {
                     /// OBTENDO DADOS 
                    const dados = JSON.parse(request.responseText);
                    console.log(dados);
                    // GRAFICO
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'],
                            datasets: [{
                                label: 'numero de pedidos',
                                data: dados.map(item => item.total_pedidos),
                                borderWidth: 1,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                            }]
                        },
                        options: {
                            maintainAspectRatio: true, 
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Numero de Pedidos por semana',
                                },
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                    
                } else if (request.readyState === 4) {
                    console.log('Erro ao obter a resposta do servidor');
                }
            }
            request.send();
            
            
        }

        function criarGraficoTopPedidos() {
            let ctx = document.getElementById('topPedidos');
            
            var request = new XMLHttpRequest();
            request.open('GET','ponteInfo.php?acao=financeiroTopPedidos',true);
            request.onreadystatechange = function() {
                if (request.readyState === 4 && request.status === 200) {
                     /// OBTENDO DADOS 
                    let pedidosdias = [];
                    const dados = JSON.parse(request.responseText); 
                    
                    console.log(dados);
                    // GRAFICO
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: dados.map(item => item.nome),
                            datasets: [{
                                label: 'numero de pedidos',
                                data: dados.map(item => item.total_pedidos),
                                borderWidth: 1,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                            }]
                        },
                        options: {
                            maintainAspectRatio: true, 
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Top 5 Mais Pedidos',
                                },
                                legend: {
                                    display: true
                                }
                            }
                        }
                    });
                    
                } else if (request.readyState === 4) {
                    console.log('Erro ao obter a resposta do servidor');
                }
            }
            request.send();
            
            
        }
    </script>
   
    <div class="container testeBorda" >
        <canvas id="pedidosxSemana"></canvas>
        <canvas id="topPedidos"></canvas>
    </div>


</body>
</html>