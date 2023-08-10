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

        $query = "insert into itens_cardapio(categoria, produto, valor) values (:categoria, :produto, :valor)"; //descobrir como reduzir codigo para chamar todos os itens
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':categoria', $this->cardapio->__get('categoria'));
        $stmt->bindValue(':produto', $this->cardapio->__get('produto'));
        $stmt->bindValue(':valor', $this->cardapio->__get('valor'));
        $stmt->execute();


    }
    
    public function buscar() 
    {

    }

    public function atualizar() 
    {

    }

    public function remover() 
    {

    }



}
