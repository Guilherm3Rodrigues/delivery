<?php 

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .expansivel {
            overflow: hidden;
            transition: height 0.3s ease-in-out;
            border: 1px solid #ccc;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .expansivel-header {
            padding: 10px;
            background-color: #f0f0f0;
        }

        .expansivel-conteudo {
            padding: 20px;
        }
    </style>
    <title>Container Expansível</title>
</head>
<body>

<div class="expansivel" data-inicial="fechado" onclick="toggleExpansao(this)">
    <div class="expansivel-header">
        <h2>Testes</h2>
    </div>
    <div class="expansivel-conteudo">
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <?php 
       

       $array = in_array('Bobs', $_SESSION);
        $array2 = array_search('JKa', $_SESSION['endCliente'][43]);
       var_dump($array);
        print '<br>';
       var_dump($array2);

       var_dump($_SESSION);
        ?>
        
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Oculta o conteúdo por padrão
        const containersExpansiveis = document.querySelectorAll('.expansivel');

        containersExpansiveis.forEach(container => {
            if (container.dataset.inicial === 'fechado') {
                container.style.height = `${container.querySelector('.expansivel-header').offsetHeight}px`;
            } else {
                container.style.height = `${container.scrollHeight}px`;
                container.classList.add('expandido');
            }
        });
    });

    function toggleExpansao(elemento) {
        // Verifica se o container está expandido
        const estaExpandido = elemento.classList.contains('expandido');

        // Se estiver expandido, retrai, se não, expande
        if (estaExpandido) {
            elemento.style.height = `${elemento.querySelector('.expansivel-header').offsetHeight}px`;
            elemento.classList.remove('expandido');
        } else {
            elemento.style.height = `${elemento.scrollHeight}px`;
            elemento.classList.add('expandido');
        }
    }
</script>

</body>
</html>
