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
        

    </style>
    <script>
        function editarCategoria() {
            let idCategoria = document.getElementById('categorias').value;

            //criar uma requisição para mostrar os pedidos
            var request = new XMLHttpRequest();
            request.open('GET','ponteInfo.php?acao=listarCategorias&id='+ idCategoria,true);
            request.onreadystatechange = function() {
                if (request.readyState === 4 && request.status === 200) {
                    //console.log(request.responseText);
                    let listaProdutos = JSON.parse(request.responseText);
                    
                    listaProdutos.forEach((item) => {gerardados(item)});
                    
                } else if (request.readyState === 4) {
                    console.log('Erro ao obter a resposta do servidor');
                }
            }
            request.send();
        }


        function gerardados(dados){
            const divProdutos = document.getElementById('listaProdutos');

            let linha = document.createElement('div');
            linha.setAttribute('class', 'dados');
            linha.id = 'dados'+dados.id;

            linha.innerHTML =  dados.produto + ' - ' + dados.descricao + ' - ' + dados.categoria + ' - ' + dados.estoque;

            divProdutos.appendChild(linha);

        }

        /// Renomear categoria
        function renomeaCategoria() {
            const idCategoria = document.getElementById('categorias');
            let opcaoSelecionada = idCategoria.options[idCategoria.selectedIndex];

            window.prompt("Digite o novo nome da Categoria:", opcaoSelecionada.text);
        }
    </script>
    
</head>
<body>
    <?php 
        include('menuadm.php');
    ?>

    <div id="selecionarCardapios">
        <select id="categorias">
            <?php 
                $listaCategorias = listarCategoriasBD();
                
                foreach ($listaCategorias as $pedido) {
                    echo '<option value="'.$pedido['id'].'">'.$pedido['nome'].'</option>';
                }
            ?>
        
        </select>
        <button id="editarCategoria" onclick="editarCategoria()">EDITAR</button>
        <button id="removerCategoria">CANCELAR</button>
        <button id="renomeaCategoria" onclick="renomeaCategoria()">RENOMEAR</button>
    </div>
    <div id="listaProdutos">

    </div>

</body>
</html>