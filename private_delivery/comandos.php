<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Comandos
{
    private $conexao;
    private $cardapio;

    public function __construct(Conexao $conexao, $cardapio)
    {
        $this->conexao = $conexao->conectar();
        $this->cardapio = $cardapio;
    }


    public function inserir()  //PARA ADMINISTRADORES
    {
        $query = "insert into itens_cardapio(categoria, produto, descricao, valor) values (:categoria, :produto,:descricao, :valor)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt->bindValue(':descricao', $this->cardapio->__get('descricao'));
        $stmt->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt->execute();
    }


    public function inserirInfo() //PARA ADMINISTRADORES
    {
        $verificar = 'select * from info_estabelecimento';
        $stmt = $this->conexao->prepare($verificar);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            $query = "insert into info_estabelecimento(nome, telefone, rua, bairro, dia_inicial, dia_final, hor_funcionamento_ini, hor_funcionamento_fec, frete)
            values (:nome, :telefone,:rua, :bairro, :dia_inicial, :dia_final, :hor_funcionamento_ini, :hor_funcionamento_fec, :frete)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
            $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
            $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
            $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
            $stmt->bindValue(':dia_inicial', $this->cardapio->__get('dia_inicial'));
            $stmt->bindValue(':dia_final', $this->cardapio->__get('dia_final'));
            $stmt->bindValue(':hor_funcionamento_ini', $this->cardapio->__get('hor_funcionamento_ini'));
            $stmt->bindValue(':hor_funcionamento_fec', $this->cardapio->__get('hor_funcionamento_fec'));
            $stmt->bindValue(':frete', $this->cardapio->__get('frete'));
            $stmt->execute();
        } else {
            $query = "update info_estabelecimento set nome = :nome, telefone = :telefone, rua = :rua, bairro = :bairro, 
            dia_inicial = :dia_inicial, dia_final = :dia_final, hor_funcionamento_ini = :hor_funcionamento_ini, hor_funcionamento_fec = :hor_funcionamento_fec, frete = :frete";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
            $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
            $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
            $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
            $stmt->bindValue(':dia_inicial', $this->cardapio->__get('dia_inicial'));
            $stmt->bindValue(':dia_final', $this->cardapio->__get('dia_final'));
            $stmt->bindValue(':hor_funcionamento_ini', $this->cardapio->__get('hor_funcionamento_ini'));
            $stmt->bindValue(':hor_funcionamento_fec', $this->cardapio->__get('hor_funcionamento_fec'));
            $stmt->bindValue(':frete', $this->cardapio->__get('frete'));
            $stmt->execute();
        }

        return $resultado;
    }


    public function carregarInfo()
    {
        try {
            $verificar = 'SELECT * FROM info_estabelecimento';
            $stmt = $this->conexao->prepare($verificar);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro aqui, como registrar em um arquivo de log
            echo "Erro ao carregar informações: " . $e->getMessage();
            return false; // Ou outro valor indicando erro
        }
    }

    public function carregarInfoAdm()
    {
        try {
            $verificar = 'SELECT nomeProprietario FROM usuarios';
            $stmt = $this->conexao->prepare($verificar);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro aqui, como registrar em um arquivo de log
            echo "Erro ao carregar informações: " . $e->getMessage();
            return false; // Ou outro valor indicando errolocal
        }
    }


    public function buscar() // carrega o cardapio
    {
        $query = 'select id, img, produto, descricao, categoria, valor from itens_cardapio ORDER BY categoria';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //inativa no momento
    public function buscarPedidos() // carrega o carrinho, PODE SER UTIL PARA ADMs
    {
        $query = 'select id, produto, valor, numero_pedido from pedidos';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function editar() //PARA ADMINISTRADORES, edita os itens do cardapio
    {
        $query = 'update itens_cardapio set categoria = :categoria, descricao = :descricao, produto = :produto, valor = :valor where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt->bindValue(':descricao', $this->cardapio->__get('descricao'));
        $stmt->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt->bindValue(':id', $this->cardapio->__get('id'));
        return $stmt->execute();
    }


    public function remover() //PARA ADMINISTRADORES, remove itens do cardapio
    {
        $query = 'delete from itens_cardapio where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindvalue(':id', $this->cardapio->__get('id'));
        $stmt->execute();
    }

    
    public function limparCarrinho() // LIMPA, ZERA o Carrinho
    {
        $_SESSION['itens'] = [];
    }


    public function removerCarrinho() // Remove itens do Carrinho
    {
        $_SESSION['itens'][$this->cardapio->__get['id']] = [];
    }


    public function editarCarrinho() //Deleta um item por vez no carrinho
    {
        if ($_GET['qtd'] <= 1) {
            unset($_SESSION['itens'][$_GET['id']]);
        } else {
            $qtdProdutos = $_GET['qtd'] - 1;
            $_SESSION['itens'][$_GET['id']]['numero_pedido'] = $_SESSION['itens'][$_GET['id']]['numero_pedido'] - 1;
        }

    }

    public function pre_carrinho()
    {
        $query = 'SELECT * FROM itens_cardapio WHERE id = :id';
        $stmt2 = $this->conexao->prepare($query);
        $stmt2->bindValue(':id', $this->cardapio->__get('id'));
        $stmt2->execute();
        $resultado = $stmt2->fetch(PDO::FETCH_ASSOC);

        if (!isset($_SESSION['itens'])) {
            $_SESSION['itens'] = [];
        }

        if (array_key_exists($resultado['id'], $_SESSION['itens'])) {
            $count = $_SESSION['itens'][$resultado['id']]['numero_pedido'] + 1;
            $_SESSION['itens'][$resultado['id']]['numero_pedido'] = $count;
        } else {
            $_SESSION['itens'][$resultado['id']] = $resultado;
            $_SESSION['itens'][$resultado['id']]['numero_pedido'] = 1;
        }
        var_dump($_SESSION['itens']);
    }

    public function finalizarPedido()  //PARA ADMINISTRADORES
    {
        $query = "select * from itens_cardapio where id = :id AND produto = :produto";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->cardapio->__get('id'));
        $stmt->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt->execute();
        $pedido = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($pedido);
        var_dump($_SESSION['itens']);
            if (1 == 0) {
            
            var_dump($pedido[0]['id']);
            var_dump($pedido[0]['valor']);
            var_dump($pedido[0]['produto']);
            }
    }
    
    public function totalPedidos()
    {
        $verificar = 'select valor from pedidos';
        $stmt = $this->conexao->prepare($verificar);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function login()
    {
        $usuario = 'select loginNome, acesso, loginSenha from usuarios';
        $stmt = $this->conexao->prepare($usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastroUsuario()
    {
        $usuario = "insert into clientes(nome, telefone) values (:nome, :telefone)";
        $stmt = $this->conexao->prepare($usuario);
        $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
        $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

}
