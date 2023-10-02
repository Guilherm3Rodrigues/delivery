<?php 


class Comandos
{

    private $conexao;
    private $cardapio;
    

    public function __construct(Conexao $conexao, AdmCardapio $cardapio)
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
    
    
    public function buscar() 
    {
        $query = 'select id, img, produto, descricao, valor from itens_cardapio';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }


    public function editar() 
    {
        $query = 'update itens_cardapio set descricao = :descricao where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':descricao', $this->cardapio->__get('descricao'));
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
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->cardapio->__get('id'));
            
        }
        
        else 

        {
            // Se o ID já existe na tabela 'pedidos', incrementa o valor existente
            $cont = intval($resultado['numero_pedido']) + 1;
            $query = 'update pedidos set numero_pedido = :cont where id = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':cont', $cont);
            $stmt->bindValue(':id', $this->cardapio->__get('id'));
            
        }
        $stmt->execute();
        return $resultado;
    }


}
