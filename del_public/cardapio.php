<?php 
    session_start();

    $acao = 'recuperar';
    require 'ponteinfo.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Cardapio</title>

    <script>
        function remover (id) 
        {
            location.href = 'cardapio.php?acao=remover&&id='+id;
        }
         function add (id)
        {
            location.href = 'cardapio.php?acao=recuperar&&id='+id;
        } 
    </script>

</head>

<body>

    <div class="row faixa-top margem-cabeçalho">

        <div class="col">
            <a href="index.php" class=" btn btn-info borda-index">Voltar ao Inicio</a>
        </div>

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
                    if (isset($_GET['acao']) && $_GET['acao'] == 'Atualizar') 
                    {
                        ?>
                            <button class="btn borda-comprar margem-varTotal">DEL</button>
                            <button class="btn borda-comprar" id="open">Edit</button>
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

            <hr> <!-- INICIO OUTRO PRODUTO ================================================================ -->
        
            <?php foreach($listaCardapio as $indice => $produto) 
            { ?>
                <div class="row container position-relative margem-produtos justify-content-center">
                                    <?php  if(!isset($_GET['acao']))  // é necessario resolver a forma de lidar com as categorias na edição
                                    { 
                                    ?>
                                    <div class="container position-relative borda-categoria">
                                        <h2><?php print $produto->categoria?></h2>
                                    </div>
                                    <?php 
                                    };?>
                                    
                    <div class="col-md-auto justify-content-start d-flex align-items-center">

                                <?php
                                if (isset($_GET['acao']) && $_GET['acao'] == 'Atualizar') 
                                {?>
                                    <button class="btn borda-comprar margem-varTotal" 
                                    onclick="remover(<?php print $produto->id ?>)">DEL</button>

                                            <form method="post">

                                                <img src="imagens/logo-index.png" 
                                                class="img-produtos2 position-relative borda-img img-thumbnail" 
                                                alt="Imagem Produto">

                                                <label for="produto">Produto:</label>

                                                <input type="text" id="produto" name="produto" 
                                                value="<?php print $produto->produto?>">
                    
                                                
                                                <label for="descricao">Descrição:</label>
                    
                                                <input type="text" id="descricao" name="descricao" 
                                                    value="<?php print $produto->descricao?>">
                                                    
                                                <label for="valor">Valor:</label>
                        
                                                <input type="text" id="valor" name="valor" 
                                                    value="<?php print $produto->valor?>">

                                                <input type="hidden" id="id" name="id" value="<?php print $produto->id ?>" >
                                                    <button class="btn btn-success">Atualizar</button>
                                            </form>
                                <?php  
                                } 
                                
                                else 
                                {?>

                                    <div class="col-md-auto justify-content-start d-flex align-items-center">
                                        <img src="imagens/logo-index.png" class="img-produtos2 position-relative borda-img img-thumbnail" alt="Imagem Produto"></td>

                                        <h3><?php print $produto->produto ?></h3>

                                    </div>

                                    <div class="col-sm-auto " id="produto_<?php print $produto->id?> ">

                                        <p><?php print $produto->descricao ?> </p>
                                        <p><?php print $produto->valor ?></p>

                                    </div>

                                    <div class="col-sm-auto justify-content-end d-flex align-items-center">

                                        <button class="btn btn-danger" onclick="add(<?php print $produto->id ?>)">COMPRAR</button>

                                    </div>
                    </div>
                                    <hr>
                </div>

            <?php               }
            };?>
            <!-- Fim do ciclo produto ======================================================================= !-->
        </div>
        <?php  if(!isset($_GET['acao'])) 
        { 
        ?>
            <div class="container position-relative d-flex align-items-center borda-carrinho">
                    <h2>Total: R$ </h2>
                    <h3 class="margem-varTotal">
                        <?php 
                            if (isset($_SESSION['valorTotal'])) 
                            {
                                print $valorTotal = $_SESSION['valorTotal'];
                            } 
                            else 
                            {
                                print $valorTotal = 0;
                            } 
                        ?>
                    </h3>
                    <div class="col justify-content-end d-flex align-items-center">
                        
                        <a type="buttom" class="borda-comprar" href="carrinho.php?acao=recuperarPedidos">Carrinho</a>

                    </div>
        <?php 
        };?>
            </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
<script src="script.js"></script>    
</body>

</html>