<?php 

class AdmCardapio 
{
    private $id;
    private $img;
    private $produto;
    private $descricao;
    private $valor;
    private $categoria;
    
    public function __set($atributo, $valor) 
    {
        $this->$atributo = $valor;
    }

    
    public function __get($atributo) 
    {
        return $this->$atributo;
    }
}

class AdmInfo 
{
    private $id;
    private $nome;
    private $telefone;
    private $rua;
    private $bairro;
    private $data_funcionamento;
    
    public function __set($atributo, $valor) 
    {
        $this->$atributo = $valor;
    }

    
    public function __get($atributo) 
    {
        return $this->$atributo;
    }
}













?>