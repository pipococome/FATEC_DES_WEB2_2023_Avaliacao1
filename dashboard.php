<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'portaria') {
    header('Location: index.php');
    exit;
}
function lerRegistros() {
    $registros = [];
    $arquivo = fopen('alunos.txt', 'r');
    
    if ($arquivo) {
        while (($linha = fgets($arquivo)) !== false) {
            $registro = explode('/', $linha);
            if (count($registro) === 3) {
                $registros[] = ['NOME' => trim($registro[0]), 'RA' => trim($registro[1]), 'PLACA' => trim($registro[2])];
            }
        }
        fclose($arquivo);
    }
    
    return $registros;
}

$registros = lerRegistros();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tela de login</title>
</head>
<body>
    <h1>Controle</h1>
    <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
    
    <h2>Registro dos estudantes</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>R.A.</th>
            <th>Placa</th>
        </tr>
        <?php foreach ($registros as $registro): ?>
            <tr>
                <td><?php echo $registro['NOME']; ?></td>
                <td><?php echo $registro['RA']; ?></td>
                <td><?php echo $registro['PLACA']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <br>
    <a href="logout.php">Sair do resgistro</a>
    <br><br>
    <a href="cadastro.php">Cadastrar estudantes</a>
</body>
</html>