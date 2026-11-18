<?php
require_once __DIR__ . '/../model/usuario.php';
require_once __DIR__ . '/../model/tarefa.php';

class UsuarioController {
    private $usuarioModel;
    private $tarefaModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
        $this->tarefaModel = new Tarefa();
    }

    public function index() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=painel');
            exit;
        }

        include __DIR__ . '/../view/login.php';
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' ||
            !isset($_POST['email'], $_POST['senha'])) {
            header('Location: index.php');
            exit;
        }

        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        if ($email === '' || $senha === '') {
            $erro = 'Preencha o e-mail e a senha.';
            include __DIR__ . '/../view/login.php';
            return;
        }

        $usuario = $this->usuarioModel->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = (int) $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header('Location: index.php?action=painel');
            exit;
        }

        $erro = 'E-mail ou senha incorretos.';
        include __DIR__ . '/../view/login.php';
    }

    public function painel() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php');
            exit;
        }

        $tarefas = $this->tarefaModel->listar((int) $_SESSION['usuario_id']);
        include __DIR__ . '/../view/painel.php';
    }

    public function logout() {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        session_destroy();
        header('Location: index.php');
        exit;
    }
}
