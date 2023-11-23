<?php 
    

    require_once "comandos.php";
    require_once "../private_delivery/conexao.php";
    require_once "../private_delivery/admCardapio.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
    
    $index = $_SERVER['PHP_SELF'];

    if (strpos($index, 'index.php') !== false || strpos($index, 'cardapio.php') !== false ) 

    {
        $admInfo = new AdmInfo();
        $conexao = new Conexao();

        $comandos = new Comandos($conexao, $admInfo);

        $info = $comandos->carregarInfo();
        $_SESSION = $info;
    }

    if ($acao == 'inserir') 
    {

        $admCardapio = new AdmCardapio();

        $admCardapio->__set('categoria', $_POST['categoria']);
        $admCardapio->__set('produto', $_POST['produto']);
        $admCardapio->__set('descricao', $_POST['descricao']);
        $admCardapio->__set('valor', $_POST['valor']);

        $conexao = new Conexao();

        $comandos = new Comandos($conexao, $admCardapio);

        $comandos->inserir();

        header('Location: admControl.php?inclusao=1');
    
    }
        else if ($acao == 'inserirInfo') 

        {
            $admInfo = new AdmInfo();

            $admInfo->__set('nome', $_POST['nome']);
            $admInfo->__set('telefone', $_POST['telefone']);
            $admInfo->__set('rua', $_POST['rua']);
            $admInfo->__set('bairro', $_POST['bairro']);
            $admInfo->__set('data_funcionamento', $_POST['data_funcionamento']);

            $conexao = new Conexao();

            $comandos = new Comandos($conexao, $admInfo);

            $comandos->inserirInfo();

            header('Location: admControl.php?inclusao=2');
        } 
    
    else  if ($acao == 'recuperar'  || $acao == 'adminVisualizacao') 
    
        {

            $admCardapio = new AdmCardapio();
            $conexao = new Conexao();

            $comandos = new Comandos($conexao, $admCardapio);
            $listaCardapio = $comandos->buscar();

            if (isset($_GET['id'])) 
            {
                $admCardapio->__set('id', $_GET['id']);
                $objetoProduto = $comandos->add_carrinho();
                
                $valorTotal = $objetoProduto['valor'];
                $_SESSION['valorTotal'] = $valorTotal;


               header('location: cardapio.php?recuperar');
            }
            
        }

    else if ($acao == 'Atualizar') 
    
        {            
            $admCardapio = new AdmCardapio();

            $conexao = new Conexao();

            $comandos = new Comandos($conexao, $admCardapio);

            $listaCardapio = $comandos->buscar();

            
            if(isset($_POST['id']))
            {
                $admCardapio->__set('id', $_POST['id']);

                if (isset($_POST['descricao']))
                {
                    $admCardapio->__set('descricao', $_POST['descricao']);
                }
                if (isset($_POST['valor']))
                {
                    $admCardapio->__set('valor', $_POST['valor']);
                }
                if (isset($_POST['produto']))
                {
                    $admCardapio->__set('produto', $_POST['produto']);
                }
                if (isset($_POST['categoria']))
                {
                    $admCardapio->__set('categoria', $_POST['categoria']);
                }
                
                $comandos->editar();
                
                header('location: cardapio.php?acao=Atualizar');
            }
            
                
        }

        else  if ($acao == 'remover') 
    
        {
            
            $admCardapio = new AdmCardapio();
            $conexao = new Conexao();

            $admCardapio->__set('id', $_GET['id']);

            $comandos = new Comandos($conexao, $admCardapio);
            
            $comandos->remover();

            header('location: cardapio.php?acao=Atualizar');


        }

        else  if ($acao == 'removerCarrinho') 
    
        {
            
            $admCardapio = new AdmCardapio();
            $conexao = new Conexao();

            $admCardapio->__set('id', $_GET['id']);
            $comandos = new Comandos($conexao, $admCardapio);

            $qtd = 0;
            $qtd = $_GET['qtd'] - 1;
            

                if($qtd == 0)
                {
                    $comandos->removerCarrinho();
                    header('location: carrinho.php?acao=recuperarPedidos');
                }
                else
                {
                    $admCardapio->__set('numero_pedido', $qtd);
                    $comandos->editarCarrinho();
                    header('location: carrinho.php?acao=recuperarPedidos');
                }
            
        }

        else if ($acao == 'logar')

        {
            if(isset($_POST['usuario']) && $_POST['usuario'] !== null )
                {

                    if($_POST['usuario'] == 'admin') 
                    {
                        if(isset($_POST['senha']) && $_POST['senha'] == 'admin') 
                        {
                            header('Location: admControl.php');
                        }
                        
                    } 
                    else 
                    { 
                        header('Location: index.php?erro=1');
                    };
                    
                } 

        }

        else  if ($acao == 'recuperarPedidos' || $acao == 'pedido_enviado') 
    
        {
            
            $admCardapio = new AdmCardapio();
            $conexao = new Conexao();

            $comandos = new Comandos($conexao, $admCardapio);
            
            if(!isset($_POST) || !isset($_POST['entrega'])) 
            {
            $_POST['entrega'] = 0;
            }

            if($acao == 'pedido_enviado') 
            
            {
                $comandos->pedidoEnviado();
                $listaPedidos = $comandos->buscarPedidos();
            }

            else

            {
                $listaPedidos = $comandos->buscarPedidos();
            }
            
            
        }

        
    

?>