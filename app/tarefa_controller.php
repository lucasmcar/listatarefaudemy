<?php

require 'Conexao.php';
require 'Tarefa.php';
require 'TarefaService.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

switch($acao)
{
    case 'inserir':
        $tar = filter_input(INPUT_POST, 'tarefa');

        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $tar);
    
    
        $con = new Conexao();
    
        $tarefaService = new TarefaService($con, $tarefa);
        $tarefaService->inserir();

        header('location: nova_tarefa.php?inclusao=1');
        break;
    case 'recuperar':

        $tarefa = new Tarefa();
        $con = new Conexao();
    
        $tarefaService = new TarefaService($con, $tarefa);
        $tarefas = $tarefaService->recuperar();
        return $tarefas;
        break;

    case 'atualizar':
        $id = filter_input(INPUT_POST, 'id');
        $tar = filter_input(INPUT_POST, 'tarefa');
        $tarefa = new Tarefa();

        $tarefa->__set('id', $id);
        $tarefa->__set('tarefa', $tar);
        $con = new Conexao();

        $tarefaService = new TarefaService($con, $tarefa);
        if($tarefaService->atualizar()){
            header('location: ../public/todas_tarefas.php');
        }
        break;
    case 'remover':
        $id = filter_input(INPUT_GET, 'id');
        $tarefa = new Tarefa();
    
        $tarefa->__set('id', $id);
        $con = new Conexao();
    
        $tarefaService = new TarefaService($con, $tarefa);
        $tarefaService->remover();
        
        header('location: ../public/todas_tarefas.php');
        break;
    case 'realizada':
        $id = filter_input(INPUT_GET, 'id');
        $tarefa = new Tarefa();
    
        $tarefa->__set('id', $id);
        $tarefa->__set('id_status', 2);
        $con = new Conexao();
    
        $tarefaService = new TarefaService($con, $tarefa);
        $tarefaService->realizada();
    
        header('location: ../public/todas_tarefas.php');
        break;
    case 'pendente':
        $tarefa = new Tarefa();
    
        $tarefa->__set('id_status', 1);
        $con = new Conexao();
    
        $tarefaService = new TarefaService($con, $tarefa);
        $tarefas = $tarefaService->pendente();
        break;
}
