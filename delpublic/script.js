function abrirDialog() 
{
    const dialog = document.getElementById('dialog');
    dialog.showModal();
}

function abrirDialogEditar() 
{
    const dialog = document.getElementById('dialog');
    dialog.showModal();
}

function fecharDialog() 
{
    const dialog = document.getElementById('dialog');
    dialog.close();
}


const botaoAdministrador = document.getElementById('open');
botaoAdministrador.addEventListener('click', abrirDialog);

const botaoFechar = document.getElementById('fecharDialog');
botaoFechar.addEventListener('click', fecharDialog);

const botãoEditar = document.getElementById('editar');
botaoAdministrador.addEventListener('click', abrirDialog);

<<<<<<< HEAD



    function scrollToElement(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }



=======
>>>>>>> 47fc9dfe2044db29de18431abcfd7302a30e1794
  