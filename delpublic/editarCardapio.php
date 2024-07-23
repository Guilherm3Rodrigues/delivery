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
        img {
            width: 100px;
            height: 100px;	
        }

    </style>
    <script>
        function editarCategoria() {
            let idCategoria = document.getElementById('categorias').value;
            const divProdutos = document.getElementById('listaProdutos');
            divProdutos.innerHTML = '';

            //criar uma requisição para mostrar os pedidos
            var request = new XMLHttpRequest();
            request.open('GET','ponteInfo.php?acao=listarCategorias&id='+ idCategoria,true);
            request.onreadystatechange = function() {
                if (request.readyState === 4 && request.status === 200) {
                    //console.log(request.responseText);
                    let listaProdutos = JSON.parse(request.responseText);
                    
                    listaProdutos.forEach((item) => {gerardados(item,divProdutos)});
                    
                } else if (request.readyState === 4) {
                    console.log('Erro ao obter a resposta do servidor');
                }
            }
            request.send();
        }


        function gerardados(dados,divProdutos){
            

            let linha = document.createElement('div');
            linha.setAttribute('class', 'container position-relative mx-auto');
            linha.id = dados.id;
            
            const divNome = document.createElement('div');// DIV encapsulando o nome
            divNome.innerHTML = '<label>Produto:</label>';
            divNome.setAttribute('class', 'container position-relative borda-categoria'); 

            const inputNome = document.createElement('input'); // INPUT do nome
            inputNome.id = 'nome'+dados.id;
            inputNome.setAttribute('type', 'text');
            inputNome.setAttribute('value', dados.produto);

            divNome.appendChild(inputNome); // colocando o INPUT dentro do DIV
            linha.appendChild(divNome);     // colocando o DIV dentro da linha
            

            const divImg = document.createElement('div'); // DIV encapsulando a imagem
            divImg.innerHTML = '<label>Imagem:</label>';
            divImg.setAttribute('class', 'container position-relative center');
            linha.appendChild(divImg);

            const img = document.createElement('img');  // visualizar imagem
            img.src = dados.img;
            img.id = 'img'+dados.id;
            img.setAttribute('class', 'img-produtos2 position-relative borda-img img-thumbnail ');
            linha.appendChild(img); // colocando o DIV dentro da linha

            const inputimg = document.createElement('input'); // INPUT da imagem
            inputimg.id = 'imgInput'+dados.id;
            inputimg.setAttribute('type', 'file');
            inputimg.setAttribute('value', dados.img);
            inputimg.setAttribute('onchange', 'trocarImagem('+dados.id+')');
            linha.appendChild(inputimg); // colocando o INPUT dentro do DIV

            const divPreco = document.createElement('div'); // DIV encapsulando o preco
            divPreco.innerHTML = '<label>Preço:</label>';
            divPreco.setAttribute('class', 'container position-relative center');

            const inputPreco = document.createElement('input'); // INPUT do preco
            inputPreco.id = 'preco'+dados.id;
            inputPreco.setAttribute('type', 'text');
            inputPreco.setAttribute('value', dados.valor);

            divPreco.appendChild(inputPreco); // colocando o INPUT dentro do DIV
            linha.appendChild(divPreco);     // colocando o DIV dentro da linha
                      
            const divDesc = document.createElement('div'); // DIV encapsulando a descrição
            divDesc.innerHTML = '<label>Descrição:</label>';
            divDesc.setAttribute('class', 'container position-relative right');
            const inputDesc = document.createElement('input'); // INPUT da descrição    
            inputDesc.id = 'desc'+dados.id;
            inputDesc.setAttribute('type', 'text');
            inputDesc.setAttribute('value', dados.descricao);

            divDesc.appendChild(inputDesc); // colocando o INPUT dentro do DIV
            linha.appendChild(divDesc);     // colocando o DIV dentro da linha

            const divBtn = document.createElement('div'); // DIV encapsulando o botão
            divBtn.innerHTML = '<button class="btn btn-success" onclick="atualizar('+dados.id+')">Atualizar</button>';
            divBtn.setAttribute('class', 'container position-relative right');
            linha.appendChild(divBtn);     // colocando o DIV dentro da linha

            const divBtn2 = document.createElement('div'); // DIV encapsulando o botão
            divBtn2.innerHTML = '<button class="btn btn-danger" onclick="remover('+dados.id+')">Remover</button>';
            divBtn2.setAttribute('class', 'container position-relative right');
            linha.appendChild(divBtn2);     // colocando o DIV dentro da linha


            divProdutos.appendChild(linha); // colocando a linha na page

        }

        function trocarImagem(id) {
            const img = document.getElementById('img'+id);
            const imgInput = document.getElementById('imgInput'+id);

            img.src = URL.createObjectURL(event.target.files[0]);

            imgInput.setAttribute('value', img.src);
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