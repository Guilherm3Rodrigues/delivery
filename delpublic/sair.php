<?php
    ob_start();
    session_start();
    $acao = 'recuperar';
    include('ponteInfo.php');


    session_destroy();
    
    header("Location: index.php");
?>