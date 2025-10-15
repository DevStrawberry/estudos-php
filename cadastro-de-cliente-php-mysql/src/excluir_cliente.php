<?php
require_once 'conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $mensagem = "Erro na preparação SQL: " . $conn->error;
    } else {
        $stmt->bind_param("i", $id_cliente);

        if ($stmt->execute()) {
            $mensagem = "Cliente excluído com sucesso!";
        } else {
            $mensagem = "Erro ao excluir o cliente: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    $mensagem = "ID de cliente inválido para exclusão.";
}

$conn->close();

header("Location: listar_clientes.php?mensagem=" . urlencode($mensagem));
exit();
?>