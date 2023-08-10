<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Carrinho</title>
</head>

<body>
    <div class="faixa-top">
        <h1 class="text-light d-flex justify-content-center">Revisao Pedido</h1>
    </div>
    <br>
    <div class="container">

        <div class="d-flex">
            <ul class="list-group mr-3">
                <li class="list-group-item">$item12 x2</li>
                <li class="list-group-item">$item07</li>
                <li class="list-group-item">$item08</li>
                <li class="list-group-item">$item07</li>
            </ul>

            <ul class="list-group">
                <li class="list-group-item">$item12 x2</li>
                <li class="list-group-item">$item077</li>
                <li class="list-group-item">$item077</li>
            </ul>
        </div>
    </div>

    <div class="container">
        <hr>
    </div>


    <h2 class="d-flex justify-content-center"><strong>Endereço</strong></h2>
    <br>


    <div class="row container test">
        <form action="" method="post" class="col-md-auto ">
            <ul>
                <label class="row">$RuaENumero</label><input placeholder="Ex: Av. JK, 350"></input>
                <label class="row">$Bairro</label><input placeholder="Ex: Centro"></input>
                <label class="row">$Complemento</label><input placeholder="Ex: Proximo a Loterica"></input>
            </ul>
        </form>
        <div class="col-md-auto  margem-varTotal borda">
            <h3>Retirar no local?</h3><br>
            <p>SIM</p>
            <p>NÃO</p>
        </div>
        <div class="col-md-auto  borda">
            <h3>Entregar? ($3,00)</h3>
            <p>SIM</p>
            <p>NÃO</p>
        </div>
    </div>


    <div class="container">
        <br>
        <hr>
        <br>
    </div>


    <div class="container position-relative d-flex align-items-center borda-carrinho">
     
        <h2> Carrinho </h2>

        <div class="col justify-content-end d-flex">
            <h3 class="margem-varTotal">$varValorTotal</h3>
            <a type="buttom" class="borda-comprar" href="admControl.php">Finalizar</a>
        </div>
    </div>


</body>

</html>