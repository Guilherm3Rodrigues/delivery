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
        $query = 'select img, produto, descricao, valor from itens_cardapio';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function atualizar() 
    {

    }

    public function remover() 
    {

    }



}
