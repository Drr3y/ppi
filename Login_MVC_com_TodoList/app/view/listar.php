<h2>TO-DO List</h2>

<form action="index.php?action=criar" method="POST">
    <input type="text" name="descricao" placeholder="Descrição da tarefa" required>
    <button type="submit">Adicionar</button>
</form>

<h3>Suas tarefas</h3>

<?php if (!empty($tarefas)): ?>
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <li>
                <?= htmlspecialchars($tarefa['descricao'], ENT_QUOTES, 'UTF-8') ?>

                <a href="index.php?action=excluir&amp;id=<?= (int) $tarefa['id'] ?>"
                   onclick="return confirm('Deseja realmente excluir esta tarefa?')">
                    Excluir
                </a>

                <button
                    type="button"
                    onclick="abrirModal(
                        <?= (int) $tarefa['id'] ?>,
                        <?= htmlspecialchars(json_encode($tarefa['descricao']), ENT_QUOTES, 'UTF-8') ?>
                    )">
                    Editar
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Não há tarefas ainda!</p>
<?php endif; ?>

<?php include __DIR__ . '/modalEditar.php'; ?>

<script>
    function abrirModal(id, descricao) {
        document.getElementById('modalEditar').style.display = 'block';
        document.getElementById('valorId').value = id;
        document.getElementById('editarDescricao').value = descricao;
    }

    function fecharModal() {
        document.getElementById('modalEditar').style.display = 'none';
    }
</script>
