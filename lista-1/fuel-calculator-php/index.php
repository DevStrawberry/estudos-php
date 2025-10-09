<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fuel Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alcool = $_POST['alcool'];
    $gasoline = $_POST['gasoline'];

    if (is_numeric($alcool) && is_numeric($gasoline) && $gasoline > 0) {
        $resultado = $alcool / $gasoline;
        if ($resultado < 0.7) {
            echo "Abasteça com alcool. <br><br>";
        } else {
            echo "Abasteça com gasolina. <br><br>";
        }
    } else {
        echo "Erro: Por favor insira valores númericos válidos. <br><br>";
    }
}
?>
<script>
    function validarValor() {
        const inputAlcool = document.getElementById('alcool');
        const alcoolValue = parseFloat(inputAlcool.value);
        const inputGasoline = document.getElementById('gasoline');
        const gasolineValue = parseFloat(inputGasoline.value);

        if (isNaN(alcoolValue)  || isNaN(gasolineValue)) {
            alert("Erro: valores inseridos não são números;");
            return false;
        }
        return true;
    }
</script>
<form action="index.php" method="post" onsubmit="return validarValor()">
    <p>
        Alcool value: <input type="number" name="alcool" id="alcool" step="0.01" required>
    </p>
    <p>
        Gasoline value: <input type="number" name="gasoline" id="gasoline" step="0.01" required>
    </p>
    <p>
        <input type="submit" name="calcular" value="Calcular">
    </p>
</form>
</body>
</html>