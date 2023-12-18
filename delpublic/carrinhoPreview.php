<div class="icone-seguidor" id="iconeSeguidor">
    <button class="icone-seguidor circulo" id="open"><img src="imagens/carrinho-de-compras.png" alt="Ícone Carrinho"> <!-- imagem pertencente a Freepik (flaticon) !-->
        <strong class="text"><?php ($qtdTotal != 0) ? print $qtdTotal : ''; ?></strong>
    </button>
</div>

<dialog id="dialog" class="dialogStyle">
    <div class="container d-flex align-items-center justify-content-center">
        <ul>

            <?php
            foreach ($listaPedidos as $key => $carrinho) {
            ?>
                <li><?php print $carrinho->produto; ?> R$
                    <?php print $carrinho->valor; ?> x
                    <?php print $carrinho->numero_pedido; ?>
                </li>
            <?php
            }; ?>
        </ul>
        R$ Total: <?php print $valorSomado ?>
        
        
    </div>
    <div class="d-flex  justify-content-center">
            <a type="buttom" class="btn btn-dark" href="carrinho.php?acao=recuperarPedidos">Carrinho</a>
        
            <button id="fecharDialog" class="btn btn-danger">
                Fechar
            </button>
    </div>

</dialog>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>