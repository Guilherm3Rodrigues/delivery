<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Exemplo de Blocos HTML/CSS</title>
<style>
    /* Estilo para o bloco */
    .bloco {
        width: 100px;
        height: 100px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        margin: 10px;
        display: inline-block;
        text-align: center;
        line-height: 100px;
    }

    /* Limpar flutuações a cada 4 blocos */
    .limpar {
        clear: both;
    }
</style>
</head>
<body>
    <div class="container">
        <?php
        // Array para teste
        $array = range(0, 9);

        // Iterar sobre o array
        foreach ($array as $valor) {
            // Abre um novo bloco
            echo '<div class="bloco">' . $valor . '</div>';
            
            // Verifica se é o quarto bloco
            if (($valor + 1) % 4 == 0) {
                // Adiciona um elemento de limpeza
                echo '<div class="limpar"></div>';
            }
        }
        ?>
    </div>
</body>
</html>
