<?php 
    $acao = 'recuperar';
    require 'ponteinfo.php';
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Carrinho</title>

    <script>

        function atualizarValor(valor) 
        {
            var valor = document.getElementById("valor");
        
            if (valor === "sim") 
                {
                    valor.innerHTML = "Você selecionou 'Sim'.";
                } 
            
            else if (valor === "nao") 
            
                {
                    valor.innerHTML = "Você selecionou 'Não'.";
                }
        }

    </script>


</head>

<body class="body">
    <div class="faixa-top">
        <h1 class="text-light d-flex justify-content-center">Revisao Pedido</h1>
    </div>
    
    <?php if(isset($_GET['acao']) && $_GET['acao'] == 'pedido_enviado') 
    {?>

        <div class="bg-success pt-2 text-white d-flex justify-content-center">

            <h3>Pedido Feito com sucesso</h3>

        </div>

    <?php 
    }?>
    
    <br>
    
        <div class="container">

            <div class="d-flex margem-endereco"> 
                
                <ul class="list-group mr-3">

                    <?php 
                    $valor = 0;
                    $qtd = 0;
                    foreach($listaPedidos as $indice => $produto) 
                    {?>
                        <li class="list-group-item"><?php print $produto->produto ?> / 
                            R$ <?php print $produto->valor ?> 
                            x <?php print $produto->numero_pedido; 
                            $valor = $produto->valor + $valor;
                            $qtd = $produto->numero_pedido + $qtd;
                            
                     ?>
                        </li>
                    <?php 
                    };?>
                        <strong><li>Total: R$ <?php print $valor?></li></strong> <!-- VALOR TOTAL ESTA ERRADO!-->
                </ul>
                        
            </div>

        </div>

    <div class="container">
        <hr>
    </div>


    <h2 class="d-flex justify-content-center"><strong>Informações do Cliente</strong></h2>
    <br>


    <div class="row container d-flex justify-content-center">
        
        <form action="" method="post" class="col-md-auto">
            <ul>
                <label class="row">$RuaENumero</label><input placeholder="Ex: Av. JK, 350"></input>
                <label class="row">$Bairro</label><input placeholder="Ex: Centro"></input>
                <label class="row">$Complemento</label><input placeholder="Ex: Proximo a Loterica"></input>
            </ul>
        </form>

        <div class="col-md-auto  borda " data-toggle="buttons">
            
            <h3>Entregar? ($3,00)</h3>

            <label class="btn btn-danger">
                
                Sim
                <input type="radio" name="entrega" value="sim" id="opcao1" autocomplete="off">

            </label>

            <br>
            <br>

            <label class="btn btn-danger">

                Retirar no local
                <input type="radio" name="entrega" value="nao" id="opcao2" autocomplete="off">

            </label>

        </div>

        <form id="myForm" action="" method="POST" class="col-md-auto">

            <ul>
                
                <label class="row">Nome</label><input placeholder="EX: Cayo Rodrigues"></input>
                
                <label class="row">Telefone</label><input placeholder="EX: 35 9 8899-9749"></input>
                
            </ul>
            <a type="buttom" class="btn btn-dark margem-endereco" href="carrinho.php?acao=pedido_enviado">Finalizar</a>

        </form>
        
        

    </div>

    <div class="container">
        <br>
        <hr>
        <br>
    </div>

    <div class="d-flex justify-content-center">
    <a class="mb-2 borda-carrinho fs-3 fw-bolder btn btn-danger btn btn-lg btn-primary rounded-pill" href="cardapio.php">
        Voltar ao Cardapio
    </a>
            
    
    <a class="mb-2 borda-carrinho fs-3 fw-bolder btn btn-danger btn btn-lg btn-primary rounded-pill" href="cardapio.php">
       Status Pedido? <? // acrescentar pagina para verificar status ou algo do tipo? ?>
    </a>
    </div>

    <div class="container position-relative d-flex align-items-center borda-carrinho">
     
        <h2> Carrinho </h2>

        <div class="col justify-content-end d-flex">

          ->>>>>>>>>  <h3 id="valor" class="margem-varTotal">$varValorTotal</h3>
            
        </div>
    </div>


</body>

</html>