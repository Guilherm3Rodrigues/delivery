<?php 
//Segurança 2º caso require fails


/*if ($_SERVER["REQUEST_METHOD"] == "POST") 

{

        $categoria = $_POST['categoria'];
        $produto = $_POST['produto'];
        $valor = $_POST['valor'];

        if (empty($categoria) || empty($produto) || empty($valor)) 
        {
            if (isset($_GET['acao']) && $_GET['acao'] == 'removerEdit') 
            {
                require_once "../private_delivery/dados.php";
            
            } 
            else
            {
                header('location: index.php?erro=1');
            } 
            
        } 
        else 
        {
            require_once "../private_delivery/dados.php";
        }
}  
    
else 
{
*/
    require_once "../private_delivery/dados.php";
//}







?>