<?php
require_once 'conexao.php';

$mensagem = "";
$cliente = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_cliente'] ?? 0;

    $nome = $_POST["nome"] ?? '';
    $data_nascimento = $_POST["data"] ?? '';
    $cpf = $_POST["cpf"] ?? '';
    $rg = $_POST["rg"] ?? '';
    $estado_civil = $_POST["estado_civil"] ?? '';
    $cep = $_POST["cep"] ?? '';
    $rua = $_POST["rua"] ?? '';
    $numero = $_POST["numero"] ?? '';
    $bairro = $_POST["bairro"] ?? '';
    $cidade = $_POST["cidade"] ?? '';
    $estado = $_POST["estado"] ?? '';
    $telefone = $_POST["telefone"] ?? '';
    $celular = $_POST["celular"] ?? '';
    $email = $_POST["email"] ?? '';
    $profissao = $_POST["profissao"] ?? '';

    $sql = "UPDATE cliente SET 
        nome=?, data_nascimento=?, cpf=?, rg=?, estado_civil=?, cep=?, rua=?, numero=?, 
        bairro=?, cidade=?, estado=?, telefone=?, celular=?, email=?, profissao=?
        WHERE id_cliente=?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $mensagem = "Erro na preparação SQL: " . $conn->error;
    } else {
        $bind_types = "sssssssssssssssi";

        $stmt->bind_param(
            $bind_types,
            $nome, $data_nascimento, $cpf, $rg, $estado_civil, $cep, $rua, $numero,
            $bairro, $cidade, $estado, $telefone, $celular, $email, $profissao, $id
        );

        if ($stmt->execute()) {
            $mensagem = "Cliente atualizado com sucesso!";
            header("Location: listar_clientes.php?status=atualizado");
            exit();
        } else {
            if ($conn->errno == 1062) {
                $mensagem = "Erro: Já existe outro cliente com este CPF ou E-mail.";
            } else {
                $mensagem = "Erro ao atualizar: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] != "POST" && isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $sql_select = "SELECT * FROM cliente WHERE id_cliente = ?";
    $stmt_select = $conn->prepare($sql_select);

    if ($stmt_select) {
        $stmt_select->bind_param("i", $id_cliente);
        $stmt_select->execute();
        $resultado = $stmt_select->get_result();

        if ($resultado->num_rows == 1) {
            $cliente = $resultado->fetch_assoc();
        } else {
            $mensagem = "Cliente não encontrado!";
        }
        $stmt_select->close();
    } else {
        $mensagem = "Erro ao preparar consulta de busca.";
    }
}

$conn->close();

if (!$cliente && empty($mensagem)) {
    $mensagem = "ID de cliente inválido.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
<h2>Editar Cliente: <?php echo htmlspecialchars($cliente['nome'] ?? 'Erro'); ?></h2>
<p><?php echo $mensagem; ?></p>
<p><a href="listar_clientes.php">Voltar para a lista</a></p>

<?php if ($cliente): ?>
    <form action="editar_cliente.php" method="post">
        <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">

        <label>Nome completo</label><br>
        <input type="text" name="nome" placeholder="Seu nome completo aqui" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required><br><br>

        <label>Data de nascimento</label><br>
        <input type="date" name="data" value="<?php echo htmlspecialchars($cliente['data_nascimento']); ?>" required><br><br>

        <label>CPF</label><br>
        <input type="text" name="cpf" placeholder="Ex: 000.000.000-00" value="<?php echo htmlspecialchars($cliente['cpf']); ?>" required><br><br>

        <label>RG</label><br>
        <input type="text" name="rg" placeholder="Ex: 00.000.000-0" value="<?php echo htmlspecialchars($cliente['rg']); ?>" required><br><br>

        <label>Estado Civil</label><br>
        <select name="estado_civil">
            <?php
            $estados = ['solteiro' => 'Solteiro(a)', 'casado' => 'Casado(a)', 'divorciado' => 'Divorciado(a)', 'viuvo' => 'Viúvo(a)', 'separado' => 'Separado(a)'];
            foreach ($estados as $val => $text):
                ?>
                <option value="<?php echo $val; ?>" <?php echo ($cliente['estado_civil'] == $val) ? 'selected' : ''; ?>>
                    <?php echo $text; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <div>
            <strong>Endereço completo</strong>
            <div>
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" placeholder="Ex: 00000-000" value="<?php echo htmlspecialchars($cliente['cep']); ?>">
            </div>
            <div>
                <label for="rua">Rua:</label>
                <input type="text" id="rua" name="rua" placeholder="Nome da rua" value="<?php echo htmlspecialchars($cliente['rua']); ?>" required>
            </div>
            <div>
                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero" placeholder="Número" value="<?php echo htmlspecialchars($cliente['numero']); ?>">
            </div>
            <div>
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo htmlspecialchars($cliente['bairro']); ?>" required>
            </div>
            <div>
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo htmlspecialchars($cliente['cidade']); ?>" required>
            </div>
            <div>
                <label for="estado">Estado (UF):</label>
                <input type="text" id="estado" name="estado" placeholder="Ex: SP" value="<?php echo htmlspecialchars($cliente['estado']); ?>" required>
            </div>
        </div><br>

        <label>Telefone Fixo (não obrigatório)</label><br>
        <input type="tel" name="telefone" placeholder="Ex: (XX) XXXX-XXXX" value="<?php echo htmlspecialchars($cliente['telefone']); ?>"><br><br>

        <label>Celular (não obrigatório)</label><br>
        <input type="text" name="celular" placeholder="Ex: (XX) 9XXXX-XXXX:" value="<?php echo htmlspecialchars($cliente['celular']); ?>"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" placeholder="seuemail@gmail.com" value="<?php echo htmlspecialchars($cliente['email']); ?>"><br><br>

        <label>Profissão</label><br>
        <input type="text" name="profissao" placeholder="Sua profissão" value="<?php echo htmlspecialchars($cliente['profissao']); ?>"><br><br>

        <input type="submit" name="submit" value="Salvar Alterações">
    </form>
<?php endif; ?>
</body>
</html>