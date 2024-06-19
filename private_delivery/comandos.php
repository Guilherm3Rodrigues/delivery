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
        $verificar = 'select * from itens_cardapio where categoria = :categoria';
        $stmt2 = $this->conexao->prepare($verificar);
        $stmt2->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt2->execute();
        $verificar = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        if ($verificar) 
        {
            $ordem = $verificar[0]['ordem'];
        } else
        {
            $ordem = $this->cardapio->__get('ordem');
        }

        $query = "insert into itens_cardapio(categoria, produto, descricao, valor, ordem) values (:categoria, :produto,:descricao, :valor, :ordem)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt->bindValue(':descricao', $this->cardapio->__get('descricao'));
        $stmt->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt->bindValue(':ordem', $ordem);
        $stmt->execute(); 
    }


    public function inserirInfo() //PARA ADMINISTRADORES
    {
        $verificar = 'select * from info_estabelecimento';
        $stmt = $this->conexao->prepare($verificar);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            $query = "insert into info_estabelecimento(nome, telefone, rua, bairro, dia_inicial, dia_final, hor_funcionamento_ini, hor_funcionamento_fec, frete, freteMotoboy)
            values (:nome, :telefone,:rua, :bairro, :dia_inicial, :dia_final, :hor_funcionamento_ini, :hor_funcionamento_fec, :frete, :freteMotoboy)";

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
            $stmt->bindValue(':freteMotoboy', $this->cardapio->__get('freteMotoboy'));
            $stmt->execute();
        } else {
            $query = "update info_estabelecimento set nome = :nome, telefone = :telefone, rua = :rua, bairro = :bairro, 
            dia_inicial = :dia_inicial, dia_final = :dia_final, hor_funcionamento_ini = :hor_funcionamento_ini, 
            hor_funcionamento_fec = :hor_funcionamento_fec, frete = :frete, freteMotoboy = :freteMotoboy";

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
            $stmt->bindValue(':freteMotoboy', $this->cardapio->__get('freteMotoboy'));
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
            $verificar = 'SELECT nomeProprietario FROM usuarios where loginNome = :loginNome';
            $stmt = $this->conexao->prepare($verificar);
            $stmt->bindValue(':loginNome', $this->cardapio->__get('loginNome'));
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
        $query = 'select id, img, produto, descricao, categoria, valor, ordem from itens_cardapio ORDER BY ordem';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function buscarPedidos() // carrega o carrinho, PODE SER UTIL PARA ADMs
    {
        $query = 'SELECT pedidos.*, clientes.nome AS nome_do_cliente
        FROM pedidos
        JOIN clientes ON pedidos.id_cliente = clientes.id_cliente order by data_insercao desc';
        //$query = 'select * from pedidos order by data_insercao desc';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarAntigos()
    {
        $query = 'SELECT pedidos.*, clientes.nome AS nome_do_cliente
        FROM pedidos
        JOIN clientes ON pedidos.id_cliente = clientes.id_cliente order by nome desc';
        //$query = 'select * from pedidos order by data_insercao desc';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function editarOrdem() //PARA ADMINISTRADORES, edita os itens do cardapio
    {
        $query = 'update itens_cardapio set ordem = :ordem where categoria = :categoria';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt->bindValue(':ordem', $this->cardapio->__get('ordem'));
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
        
    }

    public function finalizarPedido()  
    {
        $query = "select * from itens_cardapio where id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->cardapio->__get('id'));
        $stmt->execute();
        $id = $this->cardapio->__get('id');
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pedido = [];
        foreach ($resultados as $resultado) {
            $pedido[$id] = $resultado;
        }

        $query = 'INSERT INTO pedidos (img, produto, descricao, valor, categoria, numero_pedido, id_cliente, entrega)
        values (:img, :produto, :descricao, :valor, :categoria, :numero_pedido, :idCliente, :entrega)';
        $stmt2 = $this->conexao->prepare($query);
        $stmt2->bindValue(':img', $this->cardapio->__get('img'));
        $stmt2->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt2->bindValue(':descricao', $this->cardapio->__get('descricao'));
        $stmt2->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt2->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt2->bindValue(':numero_pedido', $this->cardapio->__get('numero_pedido'));
        $stmt2->bindValue(':idCliente', $this->cardapio->__get('idCliente'));
        $stmt2->bindValue(':entrega', $this->cardapio->__get('frete'));
        $stmt2->execute();
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

    public function listaUsuarios()
    {
                $verificar = 'select * from clientes';
                $stmt = $this->conexao->prepare($verificar);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function cadastroUsuario()
    {
                $verificar = 'select * from clientes where telefone = :telefoneCliente';
                $stmt = $this->conexao->prepare($verificar);
                $stmt->bindValue(':telefoneCliente', $this->cardapio->__get('telefone'));
                $stmt->execute();
                $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if  ($retorno) {
                    
                    $usuario = "UPDATE clientes 
                                SET nome = :nome, 
                                    rua = :rua, 
                                    numero = :numero, 
                                    bairro = :bairro, 
                                    complemento = :complemento 
                                WHERE telefone = :telefoneCliente";
                    $stmt = $this->conexao->prepare($usuario);
                    $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
                    $stmt->bindValue(':telefoneCliente', $this->cardapio->__get('telefone'));
                    $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
                    $stmt->bindValue(':numero', $this->cardapio->__get('numero'));
                    $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
                    $stmt->bindValue(':complemento', $this->cardapio->__get('complemento'));
                    $stmt->execute();
                    
                    //puxando dados após atualizados
                    $verificar = 'select * from clientes where telefone = :telefoneCliente';
                    $stmt = $this->conexao->prepare($verificar);
                    $stmt->bindValue(':telefoneCliente', $this->cardapio->__get('telefone'));
                    $stmt->execute();
                    $update = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        return $update;
                    
                    } 
                else 
                    { //inserindo cliente em db
                    $usuario = "insert into clientes(nome, telefone, rua, numero, bairro, complemento) values (:nome, :telefone, :rua, :numero, :bairro, :complemento)";
                    $stmt = $this->conexao->prepare($usuario);
                    $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
                    $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
                    $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
                    $stmt->bindValue(':numero', $this->cardapio->__get('numero'));
                    $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
                    $stmt->bindValue(':complemento', $this->cardapio->__get('complemento'));
                    $stmt->execute();
                    
                    //puxando dados após inseridos
                    $verificar = 'select * from clientes where telefone = :telefoneCliente';
                    $stmt = $this->conexao->prepare($verificar);
                    $stmt->bindValue(':telefoneCliente', $this->cardapio->__get('telefone'));
                    $stmt->execute();
                    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    return $retorno;
                    }
    }

}
