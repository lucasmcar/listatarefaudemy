<?php

class TarefaService
{

    private $con;

    private $tarefa;

    public function __construct(Conexao $con, Tarefa $tarefa)
    {
        $this->con = $con->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir()
    {
        $sql = "INSERT INTO TB_TAREFAS (tarefa) VALUES (:tarefa);";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }
    public function recuperar()
    {
        $sql = "SELECT t.id, s.status, t.tarefa FROM tb_tarefas as t LEFT JOIN tb_status as s";
        $sql .= " on t.id_status = s.id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function atualizar()
    {
        $sql = "UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }
    public function remover()
    {
        $sql = "DELETE FROM tb_tarefas WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }


    public function realizada()
    {
        $sql = "UPDATE tb_tarefas SET id_status = :id_status WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }

    public function pendente()
    {
        $sql = "SELECT t.id, s.status, t.tarefa FROM tb_tarefas as t LEFT JOIN tb_status as s";
        $sql .= " on t.id_status = s.id WHERE t.id_status = :id_status";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}