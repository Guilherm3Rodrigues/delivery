<?php 




class Conexao 
{

    private $host = 'roundhouse.proxy.rlwy.net';
    private $dbname = 'db_delivery';
    private $user = 'root';
    private $pass = 'bEagBdfG6gHHEg43bgghdAF2ah3c5eBA';

    

    public function conectar() 
    {

        try 
        {
            $conexao = new PDO (
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"
            );

            return $conexao;

        } catch(PDOException $e) 
        
        {
            print "<p> {$e->getMessage()} </p>";
        }
    }



}





?>