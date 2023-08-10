<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Adm Control</title>
</head>

<body>
    <div class="faixa-top">
        <h1 class="text-light d-flex justify-content-center"><strong>Administrativo</strong></h1>
    </div>
    <br>
    <div class="container">

        <form method="post" action="">
            <div class="form-group ">
                <h2>Informações do Estabelecimento</h2>
                <p><strong>Estas informações irão aparecer na pagina inicial e no começo do cardapio</strong></p>
                <input name="nome" type="text" class="form-control" placeholder="NOME, Exemplo: MC Donalds">
                <input name="telefone" type="text" class="form-control" placeholder="TELEFONE, Exemplo: (35) 98899-9749">
                <input name="rua" type="text" class="form-control" placeholder="RUA, Exemplo: Maria Lourdes de Andrade, 185">
                <input name="bairro-cidade" type="text" class="form-control" placeholder="BAIRRO - CIDADE, Exemplo: Sossego - Piranguinho">
                <input name="funcionamento" type="text" class="form-control" placeholder="Data Funcionamento, Exemplo: Terça a Sabado">
                <input name="horario" type="text" class="form-control" placeholder="HORARIO, Exemplo: 18:00 as 00:00">
            </div>
            <br>
            <button class="btn btn-success">Cadastrar</button>
        </form>
        <hr>
    </div>
    <div class="container">

        <form method="post" action="ponteInfo.php">
            <div class="form-group ">
                <h2>Adicionar itens no menu</h2>
                <input name="categoria" type="text" class="form-control" placeholder="CATEGORIA, Exemplo: Lanches, Pizzas, etc">
                <input name="produto" type="text" class="form-control" placeholder="Nome do produto, Exemplo: X-tudo, Hot-dog">
                <input name="descricao" type="text" class="form-control" placeholder="Descrição, Exemplo: hamburguer 180g, queijo prado">
                <input name="valor" type="text" class="form-control" placeholder="Valor, Exemplo: 15,00">
            </div>
            <br>
            <button class="btn btn-success">Cadastrar</button>
        </form>
        <hr>
    </div>
    <br>
    <div>
        <a class="borda-carrinho fs-3 fw-bolder btn btn-danger position-relative bottom-0 start-50 translate-middle btn btn-lg btn-primary rounded-pill" href="cardapio.php">
            Ver Cardapio</a>
    </div>

</body>

</html>