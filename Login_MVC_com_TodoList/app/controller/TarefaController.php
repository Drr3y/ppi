<?php
require_once __DIR__ . '/../model/tarefa.php';

class TarefaController {
    private $tarefaModel;

    public function __construct() {
        $this->tarefaModel = new Tarefa();
    }

    private function verificarLogin() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php');
            exit;
        }
    }

    public function criar() {
        $this->verificarLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['descricao']) &&
            trim($_POST['descricao']) !== '') {
            $descricao = trim($_POST['descricao']);
            $this->tarefaModel->criar($descricao, (int) $_SESSION['usuario_id']);
        }

        header('Location: index.php?action=painel');
        exit;
    }

    public function excluir() {
        $this->verificarLogin();

        if (isset($_GET['id']) && ctype_digit((string) $_GET['id'])) {
            $this->tarefaModel->excluir(
                (int) $_GET['id'],
                (int) $_SESSION['usuario_id']
            );
        }

        header('Location: index.php?action=painel');
        exit;
    }

    public function editar() {
        $this->verificarLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['descricao'], $_POST['id']) &&
            trim($_POST['descricao']) !== '' &&
            ctype_digit((string) $_POST['id'])) {
            $this->tarefaModel->editar(
                trim($_POST['descricao']),
                (int) $_POST['id'],
                (int) $_SESSION['usuario_id']
            );
        }

        header('Location: index.php?action=painel');
        exit;
    }
}
