<?php 

    require_once "comandos.php";
    require_once "../private_delivery/conexao.php";
    require_once "../private_delivery/admCardapio.php";

    

    $admCardapio = new AdmCardapio();

    $admCardapio->__set('categoria', $_POST['categoria']);
    $admCardapio->__set('produto', $_POST['produto']);
    $admCardapio->__set('descricao', $_POST['descricao']);
    $admCardapio->__set('valor', $_POST['valor']);
    
    $conexao = new Conexao();

    $comandos = new Comandos($conexao, $admCardapio);

    print "<pre>";
    print_r($comandos);
    print "</pre>";
    
    $comandos->inserir();
   


    

?>