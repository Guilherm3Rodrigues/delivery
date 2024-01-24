function abrirDialog() {
    const dialog = document.getElementById('dialog');
    dialog.showModal();
}

function abrirDialogEditar() {
    const dialog = document.getElementById('dialog');
    dialog.showModal();
}

function fecharDialog() {
    const dialog = document.getElementById('dialog');
    dialog.close();
}

//BOTAO ADMIN, FUNCAO DIALOG
const botaoAdministrador = document.getElementById('open');
botaoAdministrador.addEventListener('click', abrirDialog);

const botaoFechar = document.getElementById('fecharDialog');
botaoFechar.addEventListener('click', fecharDialog);

const botaoEditar = document.getElementById('editar');
botaoAdministrador.addEventListener('click', abrirDialog);


//DIALOG DE CLIENTES INICIO
function abrirDialogCliente() {
    const dialogListaCliente = document.getElementById('dialogListaCliente');
    //dialogContainer.style.display = 'block';
    dialogListaCliente.showModal();
}

const botaoListaCliente = document.getElementById('abrirListaC');
botaoListaCliente.addEventListener('click', abrirDialogCliente);

function fecharDialogCliente() {
    const dialogContainer = document.getElementById('dialogListaCliente');
    //dialogContainer.style.display = 'none';
    dialogContainer.close();
}

const botaoFecharListaCliente = document.getElementById('fecharListaCliente');
botaoFecharListaCliente.addEventListener('click', fecharDialogCliente);

                // FILTRO DE CLIENTES (Chat GPT)
function filtrarClientes() {
    // Obtém o valor do campo de pesquisa
    const termoPesquisa = document.getElementById('campoPesquisa').value.toLowerCase();

    // Obtém todas as linhas da tabela
    const linhas = document.querySelectorAll('.clienteRow');

    // Itera sobre as linhas da tabela e exibe ou oculta com base no termo de pesquisa
    linhas.forEach((linha) => {
        const tdNome = linha.querySelector('td'); // Assume que o nome do cliente está na primeira célula
        if (tdNome) {
            const textoNome = tdNome.textContent || tdNome.innerText;
            if (textoNome.toLowerCase().indexOf(termoPesquisa) > -1) {
                linha.style.display = '';
            } else {
                linha.style.display = 'none';
            }
        }
    });
}
//DIALOG DE CLIENTES INICIO FIM


 /*// Verifica se há um fragmento na URL, ou seja, se houve um redirecionamento
 if(window.location.hash) {
    var hash = window.location.hash.substring(1); // Remove o #
    var element = document.getElementById(hash);
    
    if (element) {
        // Scroll para o elemento se encontrado
        element.scrollIntoView({ behavior: 'smooth' });
    }
}*/


//ICONE FLUTUANTE CARRINHO
document.addEventListener("DOMContentLoaded", function () {
    var iconeSeguidor = document.getElementById("iconeSeguidor");

    // Exibe o ícone assim que o conteúdo for carregado
    iconeSeguidor.style.display = "block";

    // Adiciona um efeito de hover quando o mouse estiver sobre o ícone
    iconeSeguidor.addEventListener("mouseover", function () {
        iconeSeguidor.style.opacity = 0.7;
    });

    iconeSeguidor.addEventListener("mouseout", function () {
        iconeSeguidor.style.opacity = 1;
    });
});

// Verifica se há uma posição de rolagem armazenada
const scrollPosition = localStorage.getItem('scrollPosition');

if (scrollPosition) {
    // Restaura a posição de rolagem ao recarregar a página
    window.scrollTo(0, scrollPosition);
}

// Armazena a posição de rolagem quando a página é fechada ou atualizada
window.addEventListener('beforeunload', () => {
    localStorage.setItem('scrollPosition', window.scrollY);
});


