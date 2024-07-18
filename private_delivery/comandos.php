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

        if ($verificar) {
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
            $query = "insert into info_estabelecimento(nome, telefone, rua, bairro, data_funcionamento, frete)
            values (:nome, :telefone,:rua, :bairro, data_funcionamento, :frete)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
            $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
            $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
            $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
            $stmt->bindValue(':data_funcionamento', $this->cardapio->__get('data_funcionamento'));
            $stmt->bindValue(':frete', $this->cardapio->__get('frete'));
            $stmt->execute();
        } else {
            $query = "update info_estabelecimento set nome = :nome, telefone = :telefone, rua = :rua, bairro = :bairro, 
            data_funcionamento = :data_funcionamento, frete = :frete";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
            $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
            $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
            $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
            $stmt->bindValue(':data_funcionamento', $this->cardapio->__get('data_funcionamento'));
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
        $query = 'SELECT * FROM itens_cardapio';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    

    //inativa no momento
    public function buscarPedidos($start,$end) // carrega o carrinho, PODE SER UTIL PARA ADMs
    {
        $query = 'SELECT clientes.nome AS id_cliente, clientes.telefone AS telefone, pedidos.numero_pedido AS nunPedido,
            CONCAT(clientes.rua, " ", clientes.numero," ", clientes.bairro) AS endereco, pedidos.paraEntregar AS paraEntregar, pedidos.observacao AS observacao,
            pedidos.data_insercao AS dataPedido, pedidos.status AS status
            from pedidos,clientes where pedidos.id_cliente = clientes.id ';
        if($start != 0) {
            $query .= 'AND DATE(pedidos.data_insercao) >= DATE("'.$start.'") AND DATE(pedidos.data_insercao) <= DATE("'.$end.'") ORDER BY data_insercao ASC';
        }else {
            $query .= 'AND DATE(pedidos.data_insercao) = CURDATE() ORDER BY data_insercao ASC';
        }

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function buscarNumPedido($numeroPedido) 
    {
        $query = "SELECT itens_cardapio.img AS img, itens_cardapio.produto AS produto, itens_cardapio.descricao AS descricao, itens_cardapio.categoria AS categoria, itens_cardapio.valor AS valor , pedidos_cardapio.quantidade AS quantidade
        FROM pedidos,pedidos_cardapio,itens_cardapio WHERE pedidos_cardapio.id_pedidos = pedidos.id AND pedidos_cardapio.id_itensCardapio = itens_cardapio.id AND pedidos.numero_pedido =". $numeroPedido;
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function listaClientes(){
        $query = 'SELECT CONCAT(clientes.rua, " ", clientes.numero," ", clientes.bairro) AS endereco, clientes.telefone AS telefone , clientes.nome AS nome,clientes.id AS id   
        FROM clientes ORDER BY id ASC';
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

    public function pre_carrinho() //pré porque nada vai apra o banco de dados ainda
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

        $query = 'INSERT INTO pedidos (img, produto, descricao, valor, categoria, numero_pedido, id_cliente)
        values (:img, :produto, :descricao, :valor, :categoria, :numero_pedido, :idCliente)';
        $stmt2 = $this->conexao->prepare($query);
        $stmt2->bindValue(':img', $this->cardapio->__get('img'));
        $stmt2->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt2->bindValue(':descricao', $this->cardapio->__get('descricao'));
        $stmt2->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt2->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt2->bindValue(':numero_pedido', $this->cardapio->__get('numero_pedido'));
        $stmt2->bindValue(':idCliente', $this->cardapio->__get('idCliente'));
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

    public function cadastroUsuario()
    {
                $verificar = 'select * from clientes where telefone = :telefoneCliente';
                $stmt = $this->conexao->prepare($verificar);
                $stmt->bindValue(':telefoneCliente', $this->cardapio->__get('telefone'));
                $stmt->execute();
                $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if  ($retorno) {
                        return $retorno;
                    } 
                else 
                    { //inserindo cliente em db
                    $usuario = "insert into clientes(nome, telefone) values (:nome, :telefone)";
                    $stmt = $this->conexao->prepare($usuario);
                    $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
                    $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
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
    


    public function financeiroPedidosxSemana(){
        // Cria a tabela temporária
        $sqlCreateTable = 'CREATE TEMPORARY TABLE dias_semana (dia_semana INT)';
        $stmt = $this->conexao->prepare($sqlCreateTable);
        $stmt->execute();
    
        // Insere os dias da semana na tabela temporária
        $sqlInsertDays = 'INSERT INTO dias_semana (dia_semana) VALUES (0), (1), (2), (3), (4), (5), (6)';
        $stmt = $this->conexao->prepare($sqlInsertDays);
        $stmt->execute();
    
        // Consulta principal
        $sqlSelect = 'SELECT ds.dia_semana, COALESCE(COUNT(p.id), 0) AS total_pedidos
                      FROM dias_semana ds
                      LEFT JOIN pedidos p ON ds.dia_semana = WEEKDAY(p.data_insercao)
                      GROUP BY ds.dia_semana
                      ORDER BY ds.dia_semana';
    
        $stmt = $this->conexao->prepare($sqlSelect);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Modificado para FETCH_ASSOC para retornar um array associativo
    }

    public function financeiroTopPedidos(){
        // Consulta principal
        $sqlSelect = 'SELECT itens_cardapio.produto AS nome, SUM(pedidos_cardapio.quantidade) AS total_pedidos 
        FROM pedidos_cardapio , itens_cardapio WHERE pedidos_cardapio.id_itensCardapio = itens_cardapio.id GROUP BY pedidos_cardapio.id_itensCardapio, itens_cardapio.produto ORDER BY total_pedidos DESC LIMIT 5;';
    
        $stmt = $this->conexao->prepare($sqlSelect);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Modificado para FETCH_ASSOC para retornar um array associativo
    }
    
}


