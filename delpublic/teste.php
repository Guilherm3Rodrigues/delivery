<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocos Dinâmicos com Bootstrap</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .block {
            width: 200px;
            height: 200px;
            background-color: lightblue;
        }

        .scroll-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .scroll-button-left {
            left: -25px;
        }

        .scroll-button-right {
            right: -25px;
        }
    </style>
</head>
<body>
    <div class="container position-relative">
        <div class="row flex-nowrap overflow-auto" id="productList"> <!-- Alterado o ID para "productList" -->
            <!-- Blocos serão adicionados aqui -->
        </div>
        <button class="btn btn-dark scroll-button scroll-button-left" id="scrollButtonLeft">&lt;</button>
        <button class="btn btn-dark scroll-button scroll-button-right" id="scrollButtonRight">&gt;</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productList = document.getElementById('productList'); // Alterado o nome da variável
            const array = Array.from({ length: 16 }, (_, i) => i);

            array.forEach(value => {
                const block = document.createElement('div');
                block.classList.add('col-3', 'block', 'my-3', 'mx-1'); // Adicionando classes de margem
                block.textContent = value;
                productList.appendChild(block); // Alterado para productList
            });

            document.getElementById('scrollButtonLeft').addEventListener('click', () => {
                productList.scrollLeft -= 4 * 220; // Alterado para productList
            });

            document.getElementById('scrollButtonRight').addEventListener('click', () => {
                productList.scrollLeft += 4 * 220; // Alterado para productList
            });

            productList.addEventListener('scroll', () => {
                const scrollLeft = productList.scrollLeft; // Alterado para productList
                document.getElementById('scrollButtonLeft').style.display = scrollLeft > 0 ? 'block' : 'none';
                document.getElementById('scrollButtonRight').style.display = scrollLeft < productList.scrollWidth - productList.clientWidth ? 'block' : 'none'; // Alterado para productList
            });
        });
    </script>
</body>
</html>
