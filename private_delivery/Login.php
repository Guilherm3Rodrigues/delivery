<?php 

if ($acao == 'logar')  // sistema de LOGIN, NECESSARIO APRIMORAR
{
    if (isset($_POST['usuario']) && $_POST['usuario'] !== null) {
        if ($_POST['usuario'] == 'admin') {
            if (isset($_POST['senha']) && $_POST['senha'] == 'admin') {
                $retorno = $comandos->login();
                
                $_SESSION['ok'] = $retorno['0'];
                $_SESSION['verifique'] = $retorno['0'];

                if($_SESSION['verifique'] === 'qwert0');
                header('Location: admControl.php');
            } else {
                header('Location: index.php?erro=1');
            };
        } else {
            header('Location: index.php?erro=1');
        };
    }
}

?>