<?php

$mensagem = "";

$nome = $data_nascimento = $cpf = $rg = $estado_civil = $cep = $rua = $numero = "";
$bairro = $cidade = $estado = $telefone = $celular = $email = $profissao = "";
$rua_completa = $cidade_estado = $contato_completo = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cadastro_clientes";

    $conn = new mysqli($hostname, $username, $password, $dbname);

    if ($conn->connect_error) {
        $mensagem = "Falha na conexão: " . $conn->connect_error;
    } else {
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

        $sql = "INSERT INTO cliente (
                nome, data_nascimento, cpf, rg, estado_civil, cep, rua, numero, 
                bairro, cidade, estado, telefone, celular, email, profissao
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $mensagem = "Erro na preparação SQL: " . $conn->error;
        } else {
            $bind_types = "sssssssssssssss";

            $stmt->bind_param(
                $bind_types,
                $nome, $data_nascimento, $cpf, $rg, $estado_civil, $cep, $rua, $numero,
                $bairro, $cidade, $estado, $telefone, $celular, $email, $profissao
            );

            if ($stmt->execute()) {
                $mensagem = "Cadastro realizado com sucesso!";
            } else {
                $mensagem = "Erro ao cadastrar: " . $stmt->error;
            }

            $stmt->close();
        }

        $conn->close();

        $rua_completa = $rua . ", " . $numero . " - " . $bairro;
        $cidade_estado = $cidade . "/" . $estado;
        $contato_completo = "";

        if ($celular) {
            $contato_completo .= "Celular: $celular";
        }
        if ($telefone) {
            if ($contato_completo) {
                $contato_completo .= " | ";
            }
            $contato_completo .= "Fixo: $telefone";
        }

    }
}

?>
<html>
<head>
    <title>Resultado do Cadastro</title>
</head>
<body>

<p><font face="Arial, Helvetica, sans-serif" size="4">
        <strong>Status: <?php echo $mensagem; ?></strong>
    </font></p>

<h2>Dados Submetidos</h2>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>

    <table width='600' border='1' cellspacing='0' cellpadding='5'>
        <tr><td width='200'><strong>Nome Completo:</strong></td><td width='400'><?php echo htmlspecialchars($nome); ?></td></tr>
        <tr><td><strong>Nascimento:</strong></td><td><?php echo htmlspecialchars($data_nascimento); ?></td></tr>
        <tr><td><strong>CPF:</strong></td><td><?php echo htmlspecialchars($cpf); ?></td></tr>
        <tr><td><strong>RG:</strong></td><td><?php echo htmlspecialchars($rg); ?></td></tr>
        <tr><td><strong>Estado Civil:</strong></td><td><?php echo htmlspecialchars($estado_civil); ?></td></tr>
        <tr><td><strong>Profissão:</strong></td><td><?php echo htmlspecialchars($profissao); ?></td></tr>
        <tr><td><strong>CEP:</strong></td><td><?php echo htmlspecialchars($cep); ?></td></tr>
        <tr><td><strong>Endereço:</strong></td><td><?php echo htmlspecialchars($rua_completa); ?></td></tr>
        <tr><td><strong>Cidade/UF:</strong></td><td><?php echo htmlspecialchars($cidade_estado); ?></td></tr>
        <tr><td><strong>Contato:</strong></td><td><?php echo htmlspecialchars($contato_completo); ?></td></tr>
        <tr><td><strong>Email:</strong></td><td><?php echo htmlspecialchars($email); ?></td></tr>
    </table>
<?php else: ?>
    <p>Nenhum dado submetido.</p>
<?php endif; ?>


<p><font face="Arial, Helvetica, sans-serif" size="4">
        <a href="index.html">Clique aqui para voltar ao formulário.</a>
    </font>
</body>
</html>