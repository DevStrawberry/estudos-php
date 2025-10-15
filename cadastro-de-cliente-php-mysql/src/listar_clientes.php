<?php
require_once 'conexao.php';

$sql = "SELECT id_cliente, nome, cpf, email, celular, cidade, estado FROM cliente ORDER BY nome ASC";
$resultado = $conn->query($sql);
$clientes = [];

if ($resultado && $resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $clientes[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .acoes a { margin-right: 10px; text-decoration: none; }
    </style>
</head>
<body>

    <h2>Clientes Cadastrados</h2>
    <p><a href="index.html">Novo Cadastro</a></p>

    <?php if (count($clientes) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Localidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['celular']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['cidade'] . '/' . $cliente['estado']); ?></td>
                    <td class="acoes">
                        <a href="editar_cliente.php?id=<?php echo $cliente['id_cliente']; ?>">Editar</a>
                        <a href="excluir_cliente.php?id=<?php echo $cliente['id_cliente']; ?>" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum cliente cadastrado ainda.</p>
    <?php endif; ?>

</body>
</html>