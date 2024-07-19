<?php
$parametros = ['httponly' => true, 'lifetime' => 86400];
session_set_cookie_params($parametros);
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("comandos.php");
include("../private_delivery/conexao.php");
include("../private_delivery/admCardapio.php");

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

$index = $_SERVER['PHP_SELF'];

$admInfo = new AdmInfo();
$admCardapio = new AdmCardapio();
$usuarios = new Usuarios();
$conexao = new Conexao();
$comandos = new Comandos($conexao, $admCardapio);
$comandosInfo = new Comandos($conexao, $admInfo);
$comandosUsuarios = new Comandos($conexao, $usuarios);


if (strpos($index, 'index.php') !== false || strpos($index, 'cardapio.php') !== false || strpos($index, 'admControl.php')) {
    $info = $comandosInfo->carregarInfo();
    $_SESSION = array_merge($_SESSION, $info);
}

switch ($acao) {

    case 'inserir':
        $admCardapio->__set('categoria', $_POST['categoria']);
        $admCardapio->__set('produto', $_POST['produto']);
        $admCardapio->__set('descricao', $_POST['descricao']);
        $admCardapio->__set('valor', $_POST['valor']);
        $admCardapio->__set('ordem', $_POST['ordem']);
        $comandos->inserir();
        header('Location: admControl.php?inclusao=1#ordemEAdd');
        break;

    case 'inserirInfo':
        $admInfo->__set('nome', $_POST['nome']);
        $admInfo->__set('telefone', $_POST['telefone']);
        $admInfo->__set('rua', $_POST['rua']);
        $admInfo->__set('bairro', $_POST['bairro']);
        $admInfo->__set('dia_inicial', $_POST['dia_inicial']);
        $admInfo->__set('dia_final', $_POST['dia_final']);
        $admInfo->__set('hor_funcionamento_ini', $_POST['hor_funcionamento_ini']);
        $admInfo->__set('hor_funcionamento_fec', $_POST['hor_funcionamento_fec']);
        $admInfo->__set('frete', $_POST['frete']);
        $admInfo->__set('freteMotoboy', $_POST['freteMotoboy']);
        $comandosInfo->inserirInfo();
        header('Location: admControl.php?inclusao=2');
        break;

    case 'recuperar':
    case 'adminVisualizacao':
    case 'Atualizar':

        $listaCardapio = $comandos->buscar();

        if (isset($_GET['id'])) {
            $admCardapio->__set('id', $_GET['id']);
            $id = $_GET['id'];
            $comandos->pre_carrinho();
            header('location: cardapio.php#scroll_' . $id);
        }

        if (isset($_POST['id'])) {
            $admCardapio->__set('id', $_POST['id']);

            if (isset($_POST['descricao'])) {
                $admCardapio->__set('descricao', $_POST['descricao']);
            }
            if (isset($_POST['valor'])) {
                $admCardapio->__set('valor', $_POST['valor']);
            }
            if (isset($_POST['produto'])) {
                $admCardapio->__set('produto', $_POST['produto']);
            }
            if (isset($_POST['categoria'])) {
                $admCardapio->__set('categoria', $_POST['categoria']);
            }
            $comandos->editar();
            header('location: cardapio.php?acao=Atualizar');
        }
        break;

    case 'limparCarrinho':
        $comandos->limparCarrinho();
        break;

    case 'atualizarOrdem':
        $ordem = $_POST['ordem'];
        $countTotal = count($ordem);
        $verificacaoRepetir = array_count_values($ordem);
        $countVerificacao = count($verificacaoRepetir);

        if ($countTotal == $countVerificacao) {
            foreach ($ordem as $key => $valor) {
                $admCardapio->__set('categoria', $key);
                $admCardapio->__set('ordem', $valor);
                $comandos->editarOrdem();
            }
            header('Location: admControl.php#ordemEAdd');
        } else {
            ?>
            <script>
                alert('NÃO REPITA OS NÚMEROS, necessário números únicos para ordem do Cardápio');
                location.href = 'admControl.php#ordemEAdd';
            </script>
            <?php
        }
        break;

    case 'removerCarrinho':
        $admCardapio->__set('id', $_GET['id']);
        $admCardapio->__set('numero_pedido', $_GET['qtd']);
        $comandos->editarCarrinho();
        header('location: carrinho.php?acao=recuperarPedidos');
        break;

    case 'pedido_enviado':
    case 'recuperarPedidos':
        $_POST['entrega'] = isset($_POST['entrega']) ? $_POST['entrega'] : 0;

        if ($acao == 'pedido_enviado' && isset($_POST['nomeCliente']) && isset($_POST['telefoneCliente'])) {

            if (!$_SESSION['itens']) {
                header('location: carrinho.php?acao=recuperarPedidos&&erro=0');
            }

            $frete = $_POST['entrega'];
            $end = strlen($_POST['rua']);
            $num = strlen($_POST['numero']);
            $bairro = strlen($_POST['bairro']);
            

            if (!$_POST['entrega'] == 0) {
                if ($end < 2 || $bairro < 2 || $num == 0) 
                {
                    header('location: carrinho.php?acao=recuperarPedidos&&erro=1');
                } 
                else 
                {
                $usuarios->__set('rua', $_POST['rua']);
                $usuarios->__set('numero', $_POST['numero']);
                $usuarios->__set('bairro', $_POST['bairro']);
                $usuarios->__set('complemento', $_POST['complemento']);
                $usuarios->__set('nome', $_POST['nomeCliente']);
                $usuarios->__set('telefone', $_POST['telefoneCliente']);
                
                

                $cliente = $comandosUsuarios->cadastroUsuario();

                foreach ($_SESSION['itens'] as $key => $value) {
                    $admCardapio->__set('id', $value['id']);
                    $admCardapio->__set('produto', $value['produto']);
                    $admCardapio->__set('descricao', $value['descricao']);
                    $admCardapio->__set('valor', $value['valor']);
                    $admCardapio->__set('categoria', $value['categoria']);
                    $admCardapio->__set('numero_pedido', $value['numero_pedido']);
                    $admCardapio->__set('idCliente', $cliente[0]['id']);
                    $admCardapio->__set('frete', $frete);
                    $comandos->finalizarPedido();
                }
                }
            } 
            else
            {
                //var_dump($_SESSION['itens']);
                //var_dump($_POST);
                $usuarios->__set('rua', $_POST['rua']);
                $usuarios->__set('numero', $_POST['numero']);
                $usuarios->__set('bairro', $_POST['bairro']);
                $usuarios->__set('complemento', $_POST['complemento']);
                $usuarios->__set('nome', $_POST['nomeCliente']);
                $usuarios->__set('telefone', $_POST['telefoneCliente']);

                $cliente = $comandosUsuarios->cadastroUsuario();
                var_dump($cliente);
                foreach ($_SESSION['itens'] as $key => $value) {
                    $admCardapio->__set('id', $value['id']);
                    $admCardapio->__set('produto', $value['produto']);
                    $admCardapio->__set('descricao', $value['descricao']);
                    $admCardapio->__set('valor', $value['valor']);
                    $admCardapio->__set('categoria', $value['categoria']);
                    $admCardapio->__set('numero_pedido', $value['numero_pedido']);
                    $admCardapio->__set('idCliente', $cliente[0]['id']);
                    $admCardapio->__set('frete', $frete);
                    $admCardapio->__set('status', 'Pedido Recebido');
                    
                    $comandos->finalizarPedido();
                }
            }

            include('whats.php');
        }
        break;

    case 'verPedidos':
        $listaPedidos = $comandos->buscarPedidos();
        if ($antigo = 'sim') {
            $listaAntigos = $comandos->buscarAntigos();    
        }
        $listaClientes = $comandos->listaUsuarios();
        
        break;

    default:
        // Tratamento para outros casos, se necessário
}

include('Login.php');



function listarPedidosBD() {
    
   global $comandos;
   $listaPedidos = $comandos->buscarPedidos();
    

    return $listaPedidos;
}
  
include('Login.php');

?>
<script src="scriptPrivate.js"></script>