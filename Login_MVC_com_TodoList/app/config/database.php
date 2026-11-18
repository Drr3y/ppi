<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $senha = '';
    private $banco = 'banco_tarefas';

    public function conectar() {
        $conn = new mysqli(
            $this->host,
            $this->username,
            $this->senha,
            $this->banco
        );

        if ($conn->connect_error) {
            die('Erro na conexão com o banco de dados: ' . $conn->connect_error);
        }

        $conn->set_charset('utf8mb4');
        return $conn;
    }
}
