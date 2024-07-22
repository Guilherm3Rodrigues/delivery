<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$acao = 'recuperar';
include('ponteInfo.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        

    </style>
    
</head>
<body>
    <?php 
        include('menuadm.php');
    ?>

    <div id="selecionarCardapios">
        <select id="categorias">
            <?php 
                $listaCategorias = listarCategoriasBD();
                
                foreach ($listaCategorias as $pedido) {
                    echo '<option value="'.$pedido['id'].'">'.$pedido['nome'].'</option>';
                }
            ?>
        
        </select>
        <button id="editarCategoria">EDITAR</button>
        <button id="removerCategoria">CANCELAR</button>
        <button id="renomeaCategoria">RENOMEAR</button>
    </div>

</body>
</html>