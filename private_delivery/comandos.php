<?php 


class Comandos
{

    private $conexao;
    private $cardapio;
    

    public function __construct(Conexao $conexao, $cardapio)
    {
        $this->conexao = $conexao->conectar();
        $this->cardapio = $cardapio;
    }
   
   
    public function inserir() 
    {

        $query = "insert into itens_cardapio(categoria, produto, descricao, valor) values (:categoria, :produto,:descricao, :valor)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt->bindValue(':descricao', $this->cardapio->__get('descricao'));
        $stmt->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt->execute();

    }


    public function inserirInfo() 
    {
        $verificar = 'select * from info_estabelecimento';
        $stmt = $this->conexao->prepare($verificar);
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$resultado)
        {
            $query = "insert into info_estabelecimento(nome, telefone, rua, bairro, data_funcionamento) values (:nome, :telefone,:rua, :bairro, :data_funcionamento)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
            $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
            $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
            $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
            $stmt->bindValue(':data_funcionamento', $this->cardapio->__get('data_funcionamento'));
            $stmt->execute();
        }
        else
        {
            $query = "update info_estabelecimento set nome = :nome, telefone = :telefone, rua = :rua, bairro = :bairro, data_funcionamento = :rua";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->cardapio->__get('nome'));
            $stmt->bindValue(':telefone', $this->cardapio->__get('telefone'));
            $stmt->bindValue(':rua', $this->cardapio->__get('rua'));
            $stmt->bindValue(':bairro', $this->cardapio->__get('bairro'));
            $stmt->bindValue(':data_funcionamento', $this->cardapio->__get('data_funcionamento'));
            $stmt->execute();
        }

        return $resultado;

    }


    public function carregarInfo() 
    {
        $verificar = 'select * from info_estabelecimento';
        $stmt = $this->conexao->prepare($verificar);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }  
    
    
    public function buscar() 
    {
        $query = 'select id, img, produto, descricao, categoria, valor from itens_cardapio';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function buscarPedidos() 
    {
        $query = 'select id, produto, valor, numero_pedido from pedidos';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }


    public function editar() 
    {
        $query = 'update itens_cardapio set descricao = :descricao, produto = :produto, valor = :valor where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':descricao', $this->cardapio->__get('descricao'));
        $stmt->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt->bindValue(':id', $this->cardapio->__get('id'));
        return $stmt->execute(); 
        
    }


    public function remover() 
    {
        $query = 'delete from itens_cardapio where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindvalue(':id', $this->cardapio->__get('id'));
        $stmt->execute();
              
    }


    public function add_carrinho()
    {
        $verificar = 'select * from pedidos where id = :id';
        $stmt = $this->conexao->prepare($verificar);
        $stmt->bindValue(':id', $this->cardapio->__get('id'));
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resultado['numero_pedido']) 
        {
            $query = 'insert into pedidos select * from itens_cardapio where id = :id';
            $stmt2 = $this->conexao->prepare($query);
            $stmt2->bindValue(':id', $this->cardapio->__get('id'));
            $stmt2->execute();
        }
        
        else 

        {
            $cont = intval($resultado['numero_pedido']) + 1;
            $query = 'update pedidos set numero_pedido = :cont where id = :id';
            $stmt2 = $this->conexao->prepare($query);
            $stmt2->bindValue(':cont', $cont);
            $stmt2->bindValue(':id', $this->cardapio->__get('id'));
            $stmt2->execute();    
        }
        
        return $resultado;
    }


}
