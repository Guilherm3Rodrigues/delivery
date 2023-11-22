<?php 
    $acao = 'recuperar';
    require 'ponteinfo.php';

    print_r($_POST);

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
        function removerCarrinho (id) 
        {
            location.href = 'carrinho.php?acao=removerCarrinho&&id='+id;
            
        }

        function atribuirValor(nome) 
        {
            document.getElementById("botaoNome").value = nome;
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

                                    <!--  ============ TABELA DE PEDIDOS FEITOS ============================   -->
                    <?php // PHP =============================================
                    $valor = 0;
                    $qtd = 0;
                    foreach($listaPedidos as $indice => $produto) 
                    {?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <?php print $produto->produto ?> / R$ <?php print $produto->valor ?> x <?php print $produto->numero_pedido; ?>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-danger" onclick="removerCarrinho(<?php print $produto->id ?>)">DELETAR</button>
                                </div>
                            </div>
                    <?php 
                    };?>
                
                </ul>
                
                <h3><li>Total: R$ <?php $valorTotal = $valor + $_POST['entrega']; print $valorTotal?></li></h3> <!-- VALOR TOTAL ESTA ERRADO!-->        
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

        <div class="col-md-auto  borda ">
            
            <h3>Entregar? </h3>
                <form action="carrinho.php?acao=recuperarPedidos" method="POST">
                    <label class="btn btn-danger">
                        
                        SIM, R$
                        <button type="radio" name="entrega" value="3"  
                        onclick="atribuirValor(this.name)"> 3 </button>
                        <input type="hidden" id="botaoNome" name="botaoNome" value=""> ,00

                    </label>
                             
            <br>
            <br>

                    <label class="btn btn-danger">

                        NÃO, Retirar no local
                        <button  type="radio" name="entrega" value="0" autocomplete="off"
                        onclick="atribuirValor(this.name)"> 0 </button>
                        <input type="hidden" id="botaoNome" name="botaoNome" value="">

                    </label>
                </form>       

        </div>

        <form id="myForm" action="" method="POST" class="col-md-auto">

            <ul>
                
                <label class="row">Nome</label><input placeholder="EX: Cayo Rodrigues"></input>
                
                <label class="row">Telefone</label><input placeholder="EX: 35 9 8899-9749"></input>
                
            </ul>
            <a type="buttom" class="btn btn-dark margem-endereco" href="carrinho.php?acao=pedido_enviado"><strong>Finalizar</strong></a>

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

          <h3 id="valor" class="margem-varTotal">R$<?php $valorTotal = $valor + $_POST['entrega']; print $valorTotal?></h3>
            
        </div>
        
    </div>


</body>

</html>