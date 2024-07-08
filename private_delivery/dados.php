<?php
$parametros = ['httponly' => true, 'lifetime' => 21600];
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

if ($acao == 'inserir') {
    
    $admCardapio->__set('categoria', $_POST['categoria']);
    $admCardapio->__set('produto', $_POST['produto']);
    $admCardapio->__set('descricao', $_POST['descricao']);
    $admCardapio->__set('valor', $_POST['valor']);
    $admCardapio->__set('ordem', $_POST['ordem']);

    $comandos->inserir();

    header('Location: admControl.php?inclusao=1#ordemEAdd');

} else if ($acao == 'inserirInfo') {
    $admInfo->__set('nome', $_POST['nome']);
    $admInfo->__set('telefone', $_POST['telefone']);
    $admInfo->__set('rua', $_POST['rua']);
    $admInfo->__set('bairro', $_POST['bairro']);
    var_dump($_POST);

    if($_POST["horaCustomSegunda"]){
        $arrayFuncionamento['Mon'] = [$_POST['horaInicioSegunda'], $_POST['horaFimSegunda']];
    }else{
        $arrayFuncionamento['Mon'] = [];
    }
    if($_POST["horaCustomTerca"]){
        $arrayFuncionamento['Tue'] = [$_POST['horaInicioTerca'], $_POST['horaFimTerca']];
    }else{
        $arrayFuncionamento['Tue'] = [];
    }
    if($_POST["horaCustomQuarta"]){
        $arrayFuncionamento['Wed'] = [$_POST['horaInicioQuarta'], $_POST['horaFimQuarta']];
    }else{
        $arrayFuncionamento['Wed'] = [];
    }
    if($_POST["horaCustomQuinta"]){
        $arrayFuncionamento['Thu'] = [$_POST['horaInicioQuinta'], $_POST['horaFimQuinta']];
    }else{
        $arrayFuncionamento['Thu'] = [];
    }
    if($_POST["horaCustomSexta"]){
        $arrayFuncionamento['Fri'] = [$_POST['horaInicioSexta'], $_POST['horaFimSexta']];
    }else{
        $arrayFuncionamento['Fri'] = [];
    }
    if($_POST["horaCustomSabado"]){
        $arrayFuncionamento['Sat'] = [$_POST['horaInicioSabado'], $_POST['horaFimSabado']];
    }else{
        $arrayFuncionamento['Sat'] = [];
    }
    if($_POST["horaCustomDomingo"]){
        $arrayFuncionamento['Sun'] = [$_POST['horaInicioDomingo'], $_POST['horaFimDomingo']];
    }else{
        $arrayFuncionamento['Sun'] = [];
    }

    var_dump($arrayFuncionamento);
    $admInfo->__set('data_funcionamento', json_encode($arrayFuncionamento));
    $admInfo->__set('frete', $_POST['frete']);

    $comandosInfo->inserirInfo();

    header('Location: admControl.php?inclusao=2');

} else  if (isset($_POST['id_remover']) && $_POST['id_remover'] != null && $_SERVER["REQUEST_METHOD"] == "POST") {
    $admCardapio->__set('id', $_POST['id_remover']);
    $comandos->remover();

    header('Location: cardapio.php?acao=Atualizar');

} else  if ($acao == 'recuperar'  || $acao == 'adminVisualizacao'  || $acao == 'Atualizar') {
    $listaCardapio = $comandos->buscar();
    //$listaPedidos = $comandos->buscarPedidos();

    if (isset($_GET['id'])) {
        $admCardapio->__set('id', $_GET['id']);
        $comandos->pre_carrinho();
        //$retornos = $comandos->add_carrinho();

        header('location: cardapio.php');
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

} else  if ($acao == 'limparCarrinho') {
    $comandos->limparCarrinho();

    //$comandos->buscarPedidos();

} else  if ($acao == 'atualizarOrdem') {
    
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
    } 
    else 
    {
        ?>
        <script>
            alert('NÃO REPITA OS NUMEROS, necessario numeros unicos para ordem do Cardapio');
            location.href = 'admControl.php';
        </script>
        <?php 
        
    }

} else  if ($acao == 'removerCarrinho') {
    $admCardapio->__set('id', $_GET['id']);
    $admCardapio->__set('numero_pedido', $_GET['qtd']);
 
    $comandos->editarCarrinho();

    header('location: carrinho.php?acao=recuperarPedidos');

} else  if ($acao == 'pedido_enviado' || $acao == 'recuperarPedidos') {

    $_POST['entrega'] = isset($_POST['entrega']) ? $_POST['entrega'] : 0;

    if ($acao == 'pedido_enviado' && isset($_POST['nomeCliente']) && isset($_POST['telefoneCliente'])) {

        $usuarios->__set('nome', $_POST['nomeCliente']);
        $usuarios->__set('telefone', $_POST['telefoneCliente']);
        
        $cliente = $comandosUsuarios->cadastroUsuario();
        
        foreach ($_SESSION['itens'] as $key => $value) {
            $admCardapio->__set('id',$value['id']);
            $admCardapio->__set('produto',$value['produto']);
            $admCardapio->__set('descricao',$value['descricao']);
            $admCardapio->__set('valor',$value['valor']);
            $admCardapio->__set('categoria',$value['categoria']);
            $admCardapio->__set('numero_pedido',$value['numero_pedido']);
            $admCardapio->__set('idCliente',$cliente[0]['id_cliente']);

            $comandos->finalizarPedido();
        }

        include('whats.php');
    } 
        //$listaPedidos = $comandos->buscarPedidos();
    

} elseif ($acao == "buscarNumPedido") {
    global $comandos;

    $pedido = $comandos->buscarNumPedido($_GET['id']);
    
    print_r(json_encode($pedido)); 
    
}
function listarPedidosBD($todasDatas) {
    
   global $comandos;
   if(!isset($todasDatas)){
        $todasDatas = 0;
   };
    $listaPedidos = $comandos->buscarPedidos($todasDatas);
    

    return $listaPedidos;
}
function listaClientesBD() {
    
    global $comandos;
    $listaPedidos = $comandos->listaClientes();
     
 
     return $listaPedidos;
 }
  
include('Login.php');

?>
