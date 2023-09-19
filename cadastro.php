<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'portaria') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['NOME'];
    $ra = $_POST['RA'];
    $placa = $_POST['PLACA'];

    if (!empty($nome) && !empty($ra) && !empty($placa)) {
        $registro = $nome . '/' . $ra . '/' . $placa . "\n";
        file_put_contents('alunos.txt', $registro, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dados para o cadastro</title>
</head>
<body>
    <h1>Cadastro</h1>
    <form method="post" action="cadastro.php">
        <label for="NOME">Nome Completo do aluno:</label>
        <input type="text" id="NOME" name="NOME" required><br><br>
        <label for="RA">Registro Acadêmico (R.A.):</label>
        <input type="text" id="RA" name="RA" required><br><br>
        <label for="PLACA">Placa do Veículo:</label>
        <input type="text" id="PLACA" name="PLACA" required><br><br>
        <input type="submit" value="CADASTRAR">
    </form>
    <br>
    <a href="dashboard.php">Retornar para tela de login</a>
</body>
</html>