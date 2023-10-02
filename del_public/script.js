function abrirDialog() 
{
    const dialog = document.getElementById('dialog');
    dialog.showModal();
}

function fecharDialog() 
{
    const dialog = document.getElementById('dialog');
    dialog.close();
}


const botaoAdministrador = document.getElementById('adm');
botaoAdministrador.addEventListener('click', abrirDialog);

const botaoFechar = document.getElementById('fecharDialog');
botaoFechar.addEventListener('click', fecharDialog);

  