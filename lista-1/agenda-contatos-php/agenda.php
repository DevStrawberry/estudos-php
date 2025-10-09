<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contatos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $novoContato = array(
        "nome" => $nome,
        "telefone" => $telefone,
        "email" => $email
    );

    if (!isset($_SESSION["contatos"])) {
        $_SESSION["contatos"] = array();
    }

    array_push($_SESSION["contatos"], $novoContato);
}

echo "<h2>Contatos Cadastrados</h2>";

if (isset($_SESSION["contatos"]) && count($_SESSION["contatos"]) > 0) {
    echo "<table border='1'>";
    echo "<thead><tr><th>Nome</th><th>Telefone</th><th>Email</th></tr></thead>";
    echo "<tbody>";

    foreach ($_SESSION["contatos"] as $contato) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($contato["nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($contato["telefone"]) . "</td>";
        echo "<td>" . htmlspecialchars($contato["email"]) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>Nenhum contato cadastrado.</p>";
}

echo "<br><a href='contato.html'>Adicionar Outro Contato</a>"
?>
</body>
</html>