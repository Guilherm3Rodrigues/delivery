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

<body class="body">

    <div class="row faixa-top margem-cabeçalho">

        <div class="col">
            <a href="index.php" class=" btn btn-info borda-index">Voltar ao Inicio</a>
        </div>

        <?php  // PHP =============================================
            if (isset($_GET['acao']) && $_GET['acao'] == 'Atualizar' || isset($_GET['acao']) && $_GET['acao'] == 'adminVisualizacao') 
        {?>
                <div class="col">
                    <a href="admControl.php" class=" btn btn-info borda-index">Voltar ao ADM</a>
                </div>
        <?php  // PHP ============================================= ;
        };   
        ?>

        <div class="container position-relative">

            <div>
                <img src="imagens/logo-index.png" id="position-logo" class=" col-sm-auto borda-img position-relative margem-img img-thumbnail" alt="Logo Loja">
            </div>
            
            <div class=" col-sm-auto margem-info" id="position-info">
                <h3 class="margin-h3 text-primary position-relative"><?php print $_SESSION['telefone']?></h3>
                <p class="margin-p text-danger position-relative"><?php print $_SESSION['rua']?></p>
                <p class="margin-p text-danger"><?php print $_SESSION['bairro']?></p>
            </div>
            
        </div>

    </div>

            <!-- INICIO PRODUTOS ================================================================ -->
        
            <?php $repete = 'categoria repete?';
                    foreach($listaCardapio as $indice => $produto)  // PHP =============================================
            { ?>
                <!-- <div>  layout dos produtos  !--> 
                        <?php  if(!isset($_GET['acao']) || (isset($_GET['acao'])) && $_GET['acao'] != 'Atualizar') // é necessario resolver a forma de lidar com as categorias na edição
                        { 
                        ?>
                            <?php $categoria = $produto->categoria;
                                   
                                if($categoria != $repete)   { 
                            ?>

                                    <div class="container position-relative borda-categoria">
                                        <h2><?php print $categoria?></h2>
                                    </div>

                                <?php $repete = $categoria; }?>
                        <?php 
                        }
                        ?>
                                    
                        <?php // PHP =============================================
                        
                        if (isset($_GET['acao']) && $_GET['acao'] == 'Atualizar')  
                        {?>

                            <div class="container position-relative margem-produtos mx-auto text-center">
                        
                            <form method="post">

                                <div class="container position-relative borda-categoria">
                                    <input type="text" id="categoria" name="categoria" 
                                    value="<?php print $produto->categoria?>">
                                </div>
                                
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
                                
                                <button class="btn btn-danger" 
                                    onclick="remover(<?php print $produto->id ?>)">DELETAR</button>
                            </form>
                            <hr>
                            </div>
                            
                                    
                        <?php  // PHP ============================================= ;
                        } 
                        else 
                        {?>
                        <div class="container row mx-auto">
                            <div class="col-md-auto justify-content-start d-flex align-items-center">
                                <img src="imagens/logo-index.png" class="img-produtos2 position-relative borda-img img-thumbnail" alt="Imagem Produto"></td>

                                <h3><?php print $produto->produto ?></h3>

                            </div>

                            <div class="col-sm text-end" id="produto_<?php print $produto->id?> ">

                                <p><?php print $produto->descricao ?> </p>
                                <p><?php print $produto->valor ?></p>

                            </div>

                            <div class="col-sm justify-content-end d-flex align-items-center">

                                <button class="btn btn-danger" onclick="add(<?php print $produto->id ?>)">COMPRAR</button>

                            </div>
                            <hr>
                        </div>    
                                    
                <!-- </div> !-->

            <?php               } // PHP =============================================
            };?>
            <!-- Fim do ciclo produto ======================================================================= !-->
        </div>
        <?php  if(!isset($_GET['acao']))  // PHP =============================================
        { 
        ?>
            <div class="container position-relative d-flex align-items-center borda-carrinho">
                <h2>Total: R$ </h2>
                <h3 class="margem-varTotal">
                    <?php  // PHP =============================================
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
                    
                    <a type="buttom" class="btn btn-dark" href="carrinho.php?acao=recuperarPedidos">Carrinho</a>

                </div>
        <?php  // PHP ============================================= ;
        };?>
            </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
<script src="script.js"></script>    
</body>

</html>