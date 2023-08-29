<?php 
    $acao = 'recuperar';
    require 'ponteinfo.php';

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Cardapio</title>

    <script>
        function editar() 
        {
            alert('deu certo');

            let form = document.createElement('form')
            form.action = '#'
            form.method = 'post'

            let input = document.createElement('input')
            input.type = 'text'
            input.name = 'descricao'
            input.className = 'form-control'

            let button = document.createElement('button')
            button.type = 'submit'
            button.className = 'btn btn-info'
            button.innerHTML = 'Atualizar'

            form.appendChild(input)

            form.appendChild(button)

            console.log(form)
        }
    </script>


</head>

<body>

    <div class="row faixa-top margem-cabeçalho">
        <div class="container position-relative">
            <div>
                <img src="imagens/logo-index.png" id="position-logo" class=" col-sm-auto borda-img position-relative margem-img img-thumbnail" alt="Logo Loja">
            </div>

            <div class=" col-sm-auto margem-info" id="position-info">
                <h3 class="margin-h3 text-primary position-relative">(35) 98899-9749 </h3>
                <p class="margin-p text-danger position-relative"> Rua Maria Lourdes de Andrade, 185</p>
                <p class="margin-p text-danger"> Bairro Sossego - Piranguinho</p>
            </div>
        </div>

    </div>

    <div class="container position-relative borda-categoria">
        <h2>Lanches</h2>
    </div>

    <div class="row container position-relative margem-produtos justify-content-center">

        <div class="col-md-auto justify-content-start d-flex align-items-center">

            <?php
                if (isset($_GET['acao']) && $_GET['acao'] == 'removerEdit') 
                {
                    ?>
                        <button class="btn borda-comprar margem-varTotal">DEL</button>
                        <button class="btn borda-comprar" onclick="editar()">Edit</button>
                    <?php
                };
            ?>

            

            <img src="imagens/logo-index.png" class="img-produtos2 position-relative borda-img img-thumbnail" alt="Imagem Produto"></td>

            <h3>X-burguer</h3>

        </div>

        <div class="col-sm-auto ">

            <p>Descrição: Pão, Hamburguer 80g, Queijo Prado, Molho da Casa </p>
            <p>R$ 15,00</p>

        </div>

        <div class="col-sm-auto justify-content-end d-flex align-items-center">

            <div class=" margem-produtos">
                <button class="btn btn-danger">COMPRAR</button>


            </div>
           

        </div>

        <hr> <!-- fim de um produto, inicio de outro -->

        <?php foreach($listaCardapio as $indice => $produto) { ?>

            <div class="col-md-auto justify-content-start d-flex align-items-center">

                    <?php
                        if (isset($_GET['acao']) && $_GET['acao'] == 'removerEdit') 
                        {
                            ?>
                                <button class="btn borda-comprar margem-varTotal">DEL</button>
                                <button class="btn borda-comprar" onclick="editar()">Edit</button>
                            <?php
                        };
                    ?>

                    <img src="imagens/logo-index.png" class="img-produtos2 position-relative borda-img img-thumbnail" alt="Imagem Produto"></td>

                <h3><?php print $produto->produto?></h3>

            </div>

            <div class="col-sm-auto ">

                <p><?php print $produto->descricao?> </p>
                <p><?php print $produto->valor?></p>

            </div>

            <div class="col-sm-auto justify-content-end d-flex align-items-center">

                <div class="borda-comprar margem-produtos">COMPRAR</div>

            </div>

            <hr>

        <?php };?>

    </div>

    <?php

    ?>


    <div class="container position-relative d-flex align-items-center borda-carrinho">
        <h2> Carrinho </h2>

        <div class="col justify-content-end d-flex align-items-center">
            <h3 class="margem-varTotal">$varValorTotal</h3>
            <a type="buttom" class="borda-comprar" href="carrinho.php">Finalizar</a>
        </div>
    </div>


    <?php

    ?>

</body>

</html>