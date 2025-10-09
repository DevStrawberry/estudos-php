<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["reset"])) {
        unset($_SESSION["votos"]);
    }

    if (isset($_POST["linguagem"])) {
        $escolha = $_POST["linguagem"];

        if (!isset($_SESSION["votos"])) {
            $_SESSION["votos"] = [];
        }

        if (!isset($_SESSION["votos"][$escolha])) {
            $_SESSION["votos"][$escolha] = 0;
        }

        $_SESSION["votos"][$escolha]++;
    }
}

$linguagens = ["php", "java", "python", "javascript", "csharp"];

foreach ($linguagens as $lang) {
    if (!isset($_SESSION["votos"][$lang])) {
        $_SESSION["votos"][$lang] = 0;
    }
}
?>
    <!DOCTYPE html>
    <html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Enquete</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="resultado">
    <h1>Resultado da Enquete</h1>

    <ul>
        <?php foreach ($_SESSION["votos"] as $linguagem => $votos): ?>
            <li>
                <strong><?= ucfirst($linguagem) ?>:</strong> <?= $votos ?> voto(s)
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="acoes">
        <a href="enquete.html">Votar novamente</a>
        <form method="post">
            <button type="submit" name="reset" value="1">Resetar votação</button>
        </form>
    </div>
</div>
</body>
    </html><?php
