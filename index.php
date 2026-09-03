<?php

require_once __DIR__ . '/FuncionarioRepository.php';

$repositorio = new FuncionarioRepository();
$acao = $_GET['acao'] ?? 'listar';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $acao === 'cadastrar') {
    $nome = trim($_POST['nome'] ?? '');
    $cargo = trim($_POST['cargo'] ?? '');
    $salario = (float) ($_POST['salario'] ?? 0);

    $repositorio->cadastrar($nome, $cargo, $salario);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Funcionários</title>
</head>
<body>
    <h1>Sistema de Funcionários</h1>
    <nav>
        <a href="?acao=listar">Listar</a> |
        <a href="?acao=cadastrar">Cadastrar</a>
    </nav>
    <hr>

    <?php if ($acao === 'cadastrar'): ?>
        <form method="POST" action="?acao=cadastrar">
            <label>Nome: <input type="text" name="nome"></label><br>
            <label>Cargo: <input type="text" name="cargo"></label><br>
            <label>Salário: <input type="number" step="0.01" name="salario"></label><br>
            <button type="submit">Cadastrar</button>
        </form>
    <?php endif; ?>

</body>
</html>