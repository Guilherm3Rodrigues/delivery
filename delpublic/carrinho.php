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

        function confirmarLimparCarrinho () 
        {
            var confirmar = confirm("Você tem certeza que deseja limpar o carrinho?");
            if (confirmar) {
            location.href = 'carrinho.php?acao=limparCarrinho';
            }
        }
    
        function atribuirValor() 
        {
                if (nomeCliente.checkValidity() && telefoneCliente.checkValidity()) 
                {
                    // Se ambos os campos estiverem preenchidos corretamente, continuar com o processamento
                    <?php 
                
                        $_SESSION['freteFinal'] = $_POST['entrega'];
                    ?>

                    var nomeCliente = document.getElementById("nomeCliente");
                    var telefoneCliente = document.getElementById("telefoneCliente");
                    
                    document.getElementById("formularioEntrega").submit();
                } else 
                    {
                    // Se algum dos campos estiver vazio ou inválido, o comportamento padrão de validação será acionado
                    // Isso incluirá a exibição da mensagem de validação padrão para os campos com 'required'
                    // e a prevenção do envio do formulário
                    }
                
            }

</script>


</head>

<body class="body">
    
    <div class="faixa-top">

    
        <div class="container">
            <div class="row d-flex justify-content-center">
                <h1 class="text-light d-flex justify-content-center col-md-auto">Revisao Pedido</h1>
            </div>
        </div>
    </div>
            
    <!-- FAIXAS DE AVISO -->
    <?php if(isset($_GET['acao']) && $_GET['acao'] == 'pedido_enviado') 
    {?>
        <div class="bg-success pt-2 text-white d-flex justify-content-center">
            <h3>PEDIDO ENVIADO COM SUCESSO</h3>
        </div>
    <?php 
    }?>
    <?php if(isset($_GET['erro']) && $_GET['erro'] == 1) 
    {?>
        <div class="bg-warning pt-2 text-white d-flex justify-content-center">
            <h3>Para entrega, favor digitar a RUA , o NUMERO e BAIRRO</h3>
        </div>
    <?php 
    }?>
    <!-- FAIXAS DE AVISO -->
    
    <br>
    
        <div class="container">

            <div class="d-flex justify-content-center"> 
                
                <ul class="list-group mr-3">

                                    <!--  ============ TABELA DE PEDIDOS FEITOS ============================   -->
                    <?php // PHP =============================================
                    if(isset($_SESSION['itens'])) {
                        foreach ($_SESSION['itens'] as $itens) 
                    {?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <?php print '<strong>'. $itens['produto'] . '</strong>'?>  
                                 R$ <?php print $itens['valor'] ?>
                                    <?php print '<strong>'. $itens['numero_pedido'] . '</strong> - '; ?>
                                    
                                </div>
                                <div class="btn-group">
                                    
                                    <button class="btn btn-danger" 
                                    onclick="removerCarrinho(<?php print $itens['id'] ?>, 
                                                             <?php print $itens['numero_pedido'] ?>)">DELETAR</button>
                                                             
                                </div>
                            </div>
                            <hr>
                        </li> 
                    <?php  
                    }
                }
                        include('valorTotal.php');
                        $valorTotal = $valorSomado + $_SESSION['freteFinal'];    
                        
                        
                        
                    ?>
                
                </ul>

              <!--  <h3><li>Total: R$ <?php print $valorTotal?></li></h3>  VALOR TOTAL !-->
                
            </div>  
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <h3><li class="d-flex justify-content-center">Total: R$ <?php print $valorTotal?></li></h3> <!-- VALOR TOTAL -->
                            <button class="btn btn-danger col-md-4" onclick="return confirmarLimparCarrinho()">Limpar Carrinho</button>
                        </div>
                    </div>
                    
        </div>
        

    <div class="container">
        <hr>
    </div>


    <h2 class="d-flex justify-content-center"><strong>Informações do Cliente</strong></h2>
    <br>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="borda col-md-6"> <!-- vale a pena? !-->
                    
            <h2 id="entregar" class="d-flex justify-content-center">Entregar?</h2>
                    <br>
                    <form id="formularioEntrega" action="carrinho.php?acao=pedido_enviado" method="POST">
                <ul>    
                        <label class="btn btn-danger">
                            <input type="radio" name="entrega" value="<?php print $_SESSION['frete']?>" 
                            <?php print ($_SESSION['freteFinal'] != 0) ? 'checked' : ''; ?>> <b>SIM</b> (R$<?php print $_SESSION['frete']?>)
                            
                            
                        </label>
                        
                        <br>
                        <br>

                        <label class="btn btn-danger">
                            <input type="radio" name="entrega" value="0" 
                            <?php print ($_SESSION['freteFinal'] == 0) ? 'checked' : ''; ?>> <b>NÃO</b> (retirada)
                            
                        </label>
                            <br>
                            <br>
                            <h4 class="row">Endereço para entrega</h4>
                            
                            <label class="row">Rua</label>
                            <input class="row form-control" id="rua" name="rua" placeholder="Ex: Av. JK, 350"></input>
                            
                            <section class="row col-4">
                            <label class="row">Numero</label>
                            <input class="form-control" id="numero" name="numero" placeholder="Ex: 350"></input>
                            </section>
                            
                            <label class="row">Bairro</label>
                            <input class="row form-control" id="bairro" name="bairro" value="Centro" placeholder="Ex: Centro"></input>
                            
                            <label class="row">Complemento</label>
                            <input class="row form-control" id="complemento" name="complemento" value="Proximo a Loterica" placeholder="Ex: Proximo a Loterica"></input>
                        
                
                            <label class="row" require>Nome</label>
                            <input id="nomeCliente" name="nomeCliente" class="row form-control"  value="EX: Cayo Rodrigues" placeholder="EX: Cayo Rodrigues" required></input>
                            
                            <label for="telefone" class="row" require>Telefone</label>
                            <input type="tel" id="telefoneCliente" name="telefoneCliente" class="row form-control" value="9999-9999" placeholder="EX: 35 9 8899-9749" required></input>
                </ul>
                    <div class="container d-flex justify-content-center">
                        <button class="btn btn-primary" onclick="atribuirValor()"><strong>Finalizar</strong></button>
                    </div>
                </form>
            </div>
        </div>
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