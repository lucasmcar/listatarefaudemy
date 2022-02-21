<?php

class Conexao
{

    private $host = 'localhost';
    private $dbname = 'lista_tarefas';
    private $user = 'root';
    private $pass = 'Lucas1990';

    public function conectar()
    {
        try{
            $con = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            return $con;
        } catch(PDOException $e){
            $e->getMessage();
        }
    }
}