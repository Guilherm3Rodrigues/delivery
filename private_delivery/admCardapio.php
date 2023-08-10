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













?>