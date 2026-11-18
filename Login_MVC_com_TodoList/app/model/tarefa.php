<?php
require_once __DIR__ . '/../config/database.php';

class Tarefa {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar(int $usuario_id): array {
        $sql = 'SELECT id, descricao, data_criacao
                FROM tarefas
                WHERE usuario_id = ?
                ORDER BY data_criacao DESC';

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $usuario_id);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $tarefas = $resultado->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $tarefas;
    }

    public function criar(string $descricao, int $usuario_id): bool {
        $sql = 'INSERT INTO tarefas (descricao, usuario_id) VALUES (?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $descricao, $usuario_id);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function excluir(int $tarefa_id, int $usuario_id): bool {
        $sql = 'DELETE FROM tarefas WHERE id = ? AND usuario_id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $tarefa_id, $usuario_id);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function editar(string $descricao, int $tarefa_id, int $usuario_id): bool {
        $sql = 'UPDATE tarefas
                SET descricao = ?
                WHERE id = ? AND usuario_id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $descricao, $tarefa_id, $usuario_id);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }
}
