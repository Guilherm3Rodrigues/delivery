<?php
//puxando telefone da loja pra enviar msg
$infoLoja = $comandos->carregarInfo();  
$telefoneString = $infoLoja['telefone'];   
$telefoneStringNumeros = preg_replace("/[^0-9]/", "", $telefoneString);   

$admCardapio = new AdmCardapio();
$conexao = new Conexao();
$comandos = new Comandos($conexao, $admCardapio);

$arrayProdutos;
$valorTotal = 0;
$valorSomado=0;

foreach ($_SESSION['itens'] as $key => $itens) 
{
    $arrayProdutos[$key] = $itens['produto'] . ' x ' . $itens['numero_pedido'];
    $valor = $itens['valor'] * $itens['numero_pedido'];
    $valorSomado += $valor;
}


$valorTotal = $valorSomado + $_SESSION['freteFinal'];
$produtos = implode(PHP_EOL . '- ', $arrayProdutos);

$mensagem = 'Obrigado por comprar conosco!' . PHP_EOL . PHP_EOL;
$mensagem .= 'Você comprou:' . PHP_EOL;
$mensagem .= '- ' . $produtos . PHP_EOL . PHP_EOL;
$mensagem .= 'O valor total é de R$ ' . $valorTotal . '.' . PHP_EOL . PHP_EOL;
$mensagem .= 'Agradecemos a preferência ^_^';



print '<script>window.open("https://api.whatsapp.com/send?phone=55' . $telefoneStringNumeros .
  '&text='. urlencode($mensagem) .'", "_blank");</script>';


/*
  <div class="container">
  <div class="row d-flex justify-content-center">
      <div class="col-md-auto  borda d-flex justify-content-center">
              
              <h3 id="entregar">Entregar? </h3>
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
      
      <form id="myForm" method="POST" action="carrinho.php?acao=pedido_enviado" class="container">
          <div class="row d-flex justify-content-center">
              <div class="col-md-auto">
                  <ul>
                      <label class="row">Rua e Numero</label><input placeholder="Ex: Av. JK, 350"></input>
                      <label class="row">Bairro</label><input placeholder="Ex: Centro"></input>
                      <label class="row">Complemento</label><input placeholder="Ex: Proximo a Loterica"></input>
                  </ul>
              </div>

              <div class="col-md-auto">
                  <ul>
                      <label class="row" require>Nome</label>
                      <input id="nomeCliente" name="nomeCliente" class="form-control" placeholder="EX: Cayo Rodrigues" required></input>
                      
                      <label class="row" require>Telefone</label>
                      <input id="telefoneCliente" name="telefoneCliente" class="form-control" placeholder="EX: 35 9 8899-9749" required></input>
                  </ul>
              </div>
          </div>

          <button class="btn btn-dark d-flex justify-content-end"><strong>Finalizar</strong></button>
      </form>

      
      

  </div>
  </div>*/