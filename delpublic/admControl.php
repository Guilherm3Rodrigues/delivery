<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$acao = 'recuperar';
include('ponteInfo.php');

if (!isset($_SESSION['ok']) || $_SESSION['ok'] !== $_SESSION['verifique'])
{
    header('Location: index.php?erro=2');
}
?>

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

    <?php
    include("menuadm.php");
    ?>

    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1) { ?>

        <div class="bg-success pt-2 text-white d-flex justify-content-center">
            <h3>Incluido no Cardapio com Sucesso</h3>
        </div>

    <?php } ?>

    <?php if (isset($_GET['erro']) && $_GET['erro'] == 1) { ?>

        <div class="bg-danger pt-2 text-white d-flex justify-content-center">
            <h3>Erro, preencher todos os dados obrigatorios (com *)</h3>
        </div>

    <?php } ?>

    <?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 2) { ?>

        <div class="bg-success pt-2 text-white d-flex justify-content-center">
            <h3>Informações do Estabelecimento Atualizadas</h3>
        </div>

    <?php } ?>

    <br>

    <div class="container">

        <form method="post" action="ponteInfo.php?acao=inserirInfo">
            <div class="form-group ">
                <h2>Informações do Estabelecimento</h2>
                <p><strong>Estas informações irão aparecer na pagina inicial e no começo do cardapio</strong></p>
                <input required name="nome" type="text" class="form-control" value="<?php print $_SESSION['nome'] ?>" placeholder="NOME, Exemplo: MC Donalds">
                <input required name="telefone" type="text" class="form-control" value="<?php print $_SESSION['telefone'] ?>" placeholder="TELEFONE, Exemplo: (35) 98899-9749">
                <input name="rua" type="text" class="form-control" value="<?php print $_SESSION['rua'] ?>" placeholder="RUA, Exemplo: Maria Lourdes de Andrade, 185">
                <input name="bairro" type="text" class="form-control" value="<?php print $_SESSION['bairro'] ?>" placeholder="BAIRRO - CIDADE, Exemplo: Sossego - Piranguinho">

                <p style="margin:10px 0 0 !important;"><b>Dias de Funcionamento</b></p>
                <select style="width:200px; display:inline-block;" class="form-select" name="dia_inicial" id="dia-inicial">
                    <option value="segunda">Segunda</option>
                    <option value="terça">Terça</option>
                    <option value="quarta">Quarta</option>
                    <option value="quinta">Quinta</option>
                    <option value="sexta">Sexta</option>
                    <option value="sabado">Sábado</option>
                    <option value="domingo">Domingo</option>
                </select>
                à
                <select style="width:200px; display:inline-block;" class="form-select" name="dia_final" id="dia-final">
                    <option value="domingo">Domingo</option>
                    <option value="segunda">Segunda</option>
                    <option value="terça">Terça</option>
                    <option value="quarta">Quarta</option>
                    <option value="quinta">Quinta</option>
                    <option value="sexta">Sexta</option>
                    <option value="sabado">Sábado</option>
                </select>

                <p style="margin:10px 0 0 !important;"><b>Hórario de Funcionamento</b></p>
                <i>Abertura e Fechamento</i><br />
                <select style="width:200px; display:inline-block;" class="form-select" name="hor_funcionamento_ini" id="hor_funcionamento_ini">
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                </select>
                à
                <select style="width:200px; display:inline-block;" class="form-select" name="hor_funcionamento_fec" id="hor_funcionamento_fec">
                    <option value="00:00">00:00</option>
                    <option value="23:00">23:00</option>
                    <option value="22:00">22:00</option>
                    <option value="21:00">21:00</option>
                    <option value="20:00">20:00</option>
                    <option value="19:00">19:00</option>
                    <option value="18:00">18:00</option>
                </select>
                <p style="margin:10px 0 0 !important;"><b>VALOR DO FRETE (use PONTO para os centavos)</b></p>
                <input style="width:200px;" name="frete" type="number" step="0.01" value="<?php print $_SESSION['frete'] ?>" class="form-control" placeholder="EX: 2.50 (2 PONTO 50)">

            </div>
            <br>
            <button class="btn btn-success">Atualizar Info</button>
        </form>
        <hr>
    </div>
    <div class="container" id="adicionar">

        <form method="post" action="ponteInfo.php?acao=inserir">
            <div class="form-group ">
                <h2>Adicionar itens no menu</h2>
                <input name="categoria" type="text" required class="form-control" placeholder="CATEGORIA*, Exemplo: Lanches, Pizzas, etc">
                <input name="produto" type="text" required class="form-control" placeholder="NOME DO PRODUTO*, Exemplo: X-tudo, Hot-dog">
                <input name="descricao" type="text" class="form-control" placeholder="Descrição, Exemplo: hamburguer 180g, queijo prado">
                <input name="valor" required type="text" class="form-control" placeholder="VALOR*, Exemplo: 15,00">
                <input name="ordem" type="hidden" value="<?php print_r($_SESSION['ultOrdem']); ?>" class="form-control">
                
                
                
            </div>
            <br>
            <button class="btn btn-success">Cadastrar Itens</button>
        </form>
        <form method="POST" action="ponteInfo.php?acao=atualizarOrdem">
        <h2>Ordem no Cardapio</h2>
                <?php 
                        $repete = "categoria repete?";
                        $ultOrdem = 0;
                        foreach($listaCardapio as $key => $valor)
                        {$categoria = $valor->categoria;
                            if ($categoria != $repete) {
                            ?>
                            <br>
                            <?php print $categoria;?>
                            <input style="width:80px; display:inline-block;" name="ordem[<?php print$categoria?>]"value="<?php print $valor->ordem ?>" required type="text" class="form-control" >
                            <br>
                <?php       $repete = $categoria;
                        $ordem = $valor->ordem; //apesar de $ordem sempre terminar sendo o ultimo valor, apenas para segurança faço a logica.
                        if ($ultOrdem <= $ordem) {
                            $ultOrdem = $ordem;
                            $intOrdem = intval($ultOrdem);
                            $_SESSION['ultOrdem'] = $intOrdem + 1;
                        }
                        
                        }
                    } 
                ?>
                <br><br>
            <button class="btn btn-success">Atualizar Ordem</button>
        </form>
        <hr>
        <form method="post" action="ponteInfo.php?acao=Atualizar">
            <div class="form-group ">
                <h2>Remover itens no menu</h2>
                <input name="categoria" type="text" required class="form-control" placeholder="CATEGORIA*, Exemplo: Lanches, Pizzas, etc">

            </div>
            <br>
            <button class="btn btn-warning">REMOVER CATEGORIA TODA</button>
            <a class="btn btn-primary" href="cardapio.php?acao=Atualizar">Editar Cardapio</a>
        </form>
    </div>
    <br>


</body>

</html>
