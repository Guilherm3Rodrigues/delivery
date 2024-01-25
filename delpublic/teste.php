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

<div class="expansivel" onclick="toggleExpansao(this)">
    <div class="expansivel-header">
        <h2>Clique para Expandir/Retrair</h2>
    </div>
    <div class="expansivel-conteudo">
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>
        <p>Seu conteúdo aqui...</p>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Oculta o conteúdo por padrão
        const containerExpansivel = document.querySelector('.expansivel');
        containerExpansivel.style.height = `${containerExpansivel.querySelector('.expansivel-header').offsetHeight}px`;
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
