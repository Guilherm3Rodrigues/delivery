<?php 

class AdmCardapio 
{
    private $id;
    private $img;
    private $produto;
    private $descricao;
    private $valor;
    private $categoria;
    private $numero_pedido;
    private $cliente;
    
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
    private $dia_inicial;
    private $dia_final;
    private $hor_funcionamento_ini;
    private $hor_funcionamento_fec;
    private $frete;
    
    public function __set($atributo, $valor) 
    {
        $this->$atributo = $valor;
    }

    
    public function __get($atributo) 
    {
        return $this->$atributo;
    }
}

class Usuarios
{
    private $nome;
    private $telefone;
    private $loginNome;
    private $acesso;
    private $usuario;
    private $senha;
    private $sessao;
    
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