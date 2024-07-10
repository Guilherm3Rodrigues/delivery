<nav id="faixa-menu-adm" style="text-align:center;">
<?php
$nome = $_SESSION['nomeProprietario'];
echo "Olá <b> " . $nome . "</b>, seja novamente bem-vindo a sua área";
?>
    <ul>
        <li><a href="admControl.php">Início</a></li> 
        <li><a href="verPedidos.php">Pedidos</a></li>
        <li><a href="financeiro.php">Financeiro</a></li> 
        <li><a href="admControl.php#adicionar">Add Cardápio</a></li> 
        <li><a href="cardapio.php?acao=Atualizar">Editar Cardápio</a></li> 
        <li><a href="cardapio.php?acao=adminVisualizacao">Ver Cardápio</a></li> 
        <li><a href="sair.php">Sair</a></li>
    </ul>
</nav>