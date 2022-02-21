function editar(id, taref){
    
    let form = createForm();
    let inputTarefa = createInput(taref);
    let hidden = createHidden(id);
    let button = createButton();
    
    form.appendChild(inputTarefa);

    form.appendChild(hidden);
    form.appendChild(button);

    let tarefa = document.getElementById('tarefa_'+id);

    tarefa.innerHTML = '';
    tarefa.insertBefore(form, tarefa[0]);
}

/**
 * Função que cria o form

 * @returns form
 */
const createForm = function()
{
    let form = document.createElement('form');
    form.action = '../public/tarefa_controller.php?acao=atualizar';
    form.method = 'post';
    form.className ='row';
    return form;
}

const createInput = function(taref)
{
    let inputTarefa = document.createElement('input');
    inputTarefa.type = 'text';
    inputTarefa.name = 'tarefa';
    inputTarefa.className = 'col-9 form-control';
    inputTarefa.value = taref;
    return inputTarefa;
}

const createHidden = function(id){
    let hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'id';
    hidden.value = id;
    return hidden;

}

const createButton = function()
{
    let button = document.createElement('button');
    button.type = 'submit';
    button.className = 'col-3 btn btn-info';
    button.innerHTML = 'Atualizar';
    return button;
}

function remover(id)
{
    location.href = '../public/todas_tarefas.php?acao=remover&id='+id;
}

function realizado(id)
{
    location.href = '../public/todas_tarefas.php?acao=realizada&id='+id;
}