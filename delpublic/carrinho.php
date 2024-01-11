<?php 
    ob_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $acao = 'recuperar';
    include('ponteInfo.php');
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

        function removerCarrinho (id, qtd) 
        {
            location.href = 'carrinho.php?acao=removerCarrinho&&id='+id + '&&qtd='+qtd;
        }

        function limparCarrinho () 
        {
            location.href = 'carrinho.php?acao=limparCarrinho';
        }
    
        function atribuirValor() 
        {
            <?php 
                $_SESSION['freteFinal'] = $_POST['entrega'];
            ?>
            document.getElementById("formularioEntrega").submit();
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

            <h3>PEDIDO ENVIADO COM SUCESSO</h3>

        </div>

    <?php 
    }?>
    
    <br>
    
        <div class="container">

            <div class="d-flex"> 
                
                <ul class="list-group mr-3">

                                    <!--  ============ TABELA DE PEDIDOS FEITOS ============================   -->
                    <?php // PHP =============================================
                    if(isset($_SESSION['itens'])) {
                        foreach ($_SESSION['itens'] as $itens) 
                    {?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <?php print '<strong>'. $itens['produto'] . '</strong>'?> - 
                                 R$ <?php print $itens['valor'] ?> x 
                                    <?php print '<strong>'. $itens['numero_pedido'] . '</strong>'; ?>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-danger" 
                                    onclick="removerCarrinho(<?php print $itens['id'] ?>, 
                                                             <?php print $itens['numero_pedido'] ?>)">DELETAR</button>
                                </div>
                            </div>
                        </li> 
                    <?php  
                    }}
                        include('valorTotal.php');
                        $valorTotal = $valorSomado + $_SESSION['freteFinal'];
                        
                    ?>
                
                </ul>
                
                <h3><li>Total: R$ <?php print $valorTotal?></li></h3> <!-- VALOR TOTAL -->
            </div>
                    <button class="btn btn-danger" onclick="limparCarrinho()">Limpar Carrinho</button>
        </div>
        </div>
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
                <label class="row">Rua e Numero</label><input placeholder="Ex: Av. JK, 350"></input>
                <label class="row">Bairro</label><input placeholder="Ex: Centro"></input>
                <label class="row">Complemento</label><input placeholder="Ex: Proximo a Loterica"></input>
            </ul>
        </form>

        <div class="col-md-auto  borda ">
            
            <h3>Entregar? </h3>
            <form id="formularioEntrega" action="carrinho.php?acao=recuperarPedidos" method="POST">
                <label class="btn btn-danger">
                    
                    <input type="radio" name="entrega" value="<?php print $_SESSION['frete']?>" onclick="atribuirValor()" 
                    <?php print ($_SESSION['freteFinal'] != 0) ? 'checked' : ''; ?>> SIM - R$<?php print $_SESSION['frete']?>
                    <input type="hidden" id="botaoNomeSim" name="botaoNomeSim" value=""> 
                </label>

                <br>
                <br>

                <label class="btn btn-danger">
                    
                    <input type="radio" name="entrega" value="0" onclick="atribuirValor()" 
                    <?php print ($_SESSION['freteFinal'] == 0) ? 'checked' : ''; ?>> NÃO, Retirar no local - R$0
                    <input type="hidden" id="botaoNomeNao" name="botaoNomeNao" value="">
                </label>
                <input type="submit" style="display:none;">

            </form>
       

        </div>

        <form id="myForm" method="POST" action="carrinho.php?acao=pedido_enviado" class="col-md-auto">

            <ul>
                <label class="row" require>Nome</label>
                <input id="nomeCliente" name="nomeCliente" class="form-control" placeholder="EX: Cayo Rodrigues" required></input>
                
                <label class="row" require>Telefone</label>
                <input id="telefoneCliente" name="telefoneCliente" class="form-control" placeholder="EX: 35 9 8899-9749" required></input>
                
            </ul>

            <button class="btn btn-dark margem-endereco"><strong>Finalizar</strong></button>

        </form>
        
        

    </div>

    <div class="container">
        <br>
        <hr>
        <br>
    </div>

    <div class="d-flex justify-content-center"> 
        <a class="mb-2 fs-4 fw-bolder btn btn-danger btn-primary me-2" href="cardapio.php">
            Voltar ao Cardapio
        </a>

    </div>

    <div class="position-relative d-flex align-items-center borda-carrinho">
     
        <div class="col justify-content-center d-flex">

          <h3 id="valor" class="mx-5">TOTAL: R$<?php print $valorTotal?></h3>
            
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</body>

</html>