<?php 

if ($acao == 'logar')  // sistema de LOGIN, NECESSARIO APRIMORAR
{
    if (isset($_POST['usuario'])) {

        $retorno = $comandos->login();
        $n = count($retorno);
    
        for ($i = 0; $i < $n; $i++) {
            if ($_POST['usuario'] == $retorno[$i]['loginNome']) {
                
                if (isset($_POST['senha']) && $_POST['senha'] === $retorno[$i]['loginSenha']) {
                    $_SESSION['ok'] = $retorno[$i]['acesso'];
                    $_SESSION['verifique'] = $retorno[$i]['acesso'];
    
                    if ($_SESSION['verifique'] === 'Qw3Rt0') {
                        session_regenerate_id(true);
                        header('Location: admControl.php');
                        exit();
                    }
                }
            }
        }
        header('Location: index.php?erro=1');
    }
    
}

?>