<?php 

if ($acao == 'logar')  // sistema de LOGIN, NECESSARIO APRIMORAR
{
    if (isset($_POST['usuario']) && $_POST['usuario'] !== null) {
        if ($_POST['usuario'] == 'admin') {
            if (isset($_POST['senha']) && $_POST['senha'] == 'admin') {
                $ok = '1';
                $_SESSION['ok'] = $ok;
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