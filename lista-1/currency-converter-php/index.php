<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Currency Convet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if (isset($_POST['dolar']) || isset($_POST['libra']) || isset($_POST['euro'])) {
    $real = $_POST["real"];

    echo "<div class='result-box'>";
    echo "<h4>Resultado da Conversão</h4>";

    if (isset($_POST["dolar"])) {
        $dolar = $real / 5.47;
        echo "<h3>US$ " . number_format($dolar, 2, '.', '') . "</h3>";
    } elseif (isset($_POST["euro"])) {
        $euro = $real / 6.37;
        echo "<h3>EUR$ " . number_format($euro, 2, '.', '') . "</h3>";
    } elseif (isset($_POST["libra"])) {
        $libra = $real / 7.33;
        echo "<h3>LIB$ " . number_format($libra, 2, '.', '') . "</h3>";
    }
    echo "</div>";
}
?>
<form action="index.php" method="post">
    <p>
        <label for="real_value">Value (R$):</label>
        <input type="number" name="real" id="real_value" min="0" step="0.01" required>
    </p>
    <p>
        <input type="submit" name="dolar" value="Dolar">
        <input type="submit" name="euro" value="Euro">
        <input type="submit" name="libra" value="Libra">
    </p>
</form>
</body>

</html>