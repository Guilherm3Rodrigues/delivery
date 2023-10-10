<?php 
    session_start();

    $acao = 'recuperar';
    require 'ponteinfo.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php $nomeRestaurante = "McDonalds" ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print $nomeRestaurante ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>

<body class="margin body">

    <?php if(isset($_GET['erro']) && $_GET['erro'] == 1) {?>
        
        <div class="bg-danger pt-2 text-white d-flex justify-content-center">
            <h3>Usuario ou Senha Invalidos</h3>
        </div>

    <?php                                                }?>



    <div class="container">
        <div class="col d-flex justify-content-center">
            
            <img src="imagens/fachada-index.jpg" class="img-fluid rounded borda-img img" alt="Imagem Background">
            
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-4 col-lg-2">
                <img src="imagens/logo-index.png" class="position-relative img-thumbnail borda-img" alt="Logo Loja">
            </div>

            <div class="col-md-8 col-lg-4">
                <h1 class="text-primary position-relative"><?php print $_SESSION['nome']?></h1>
                <h3 class="text-primary position-relative"><?php print $_SESSION['telefone']?></h3>
                <p class="text-danger position-relative"> <?php print $_SESSION['rua']?></p>
                <p class="text-danger"> <?php print $_SESSION['bairro']?></p>
            </div>

        </div>

    </div>

    <div class="sticky-md-bottom position-relative bottom-0 start-50 translate-middle-x">

        <div class="text-center" style="height:140px">

            <p class="text-primary"> <?php print $_SESSION['data_funcionamento']?></p>
            <h2 class="text-success" > ABERTO </h2>

        </div>

        <div>

            <a class="borda-carrinho fs-3 fw-bolder btn btn-danger position-relative bottom-0 start-50 translate-middle btn btn-lg btn-primary rounded-pill"
                href="cardapio.php" >Cardapio
            </a>
            <br>
            <br>
            <button id="open" class="borda-carrinho fs-3 fw-bolder btn btn-danger position-relative bottom-0 start-50 translate-middle btn btn-lg btn-primary rounded-pill">
                Administrador
            </button>

            <dialog id="dialog" class="dialogStyle">
                <div class="container d-flex align-items-center justify-content-center">
                
                    <form method="post" action="ponteInfo.php?acao=logar">

                        <label for="usuario">Usuário:
                        </label>

                        <input type="text" id="usuario" name="usuario" required>

                            <br>

                        <label for="senha">Senha:
                        </label>

                        <input type="password" id="senha" name="senha" required>

                            <br>

                        <button type="submit">Login
                        </button>

                    </form>

                    <button id="fecharDialog">
                        Fechar
                    </button>

                </div>

            </dialog>

      </div>

    </div>

    <script src="script.js"></script>

</body>

</html>