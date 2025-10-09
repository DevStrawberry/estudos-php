<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMC Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $hight = $_POST["hight"];
    $weight = $_POST["weight"];
    $imc = $weight/($hight*$hight);

    switch(true){
        case ($imc < 18.5):
            echo "<h2>Abaixo do peso.</h2>";
            break;
        case ($imc >= 18.5 && $imc <= 24.9):
            echo "<h2>Peso ideal (parabéns).</h2>";
            break;
        case ($imc >= 24.9 && $imc <= 29.9):
            echo "<h2>Levemente acima do peso.</h2>";
            break;
        case ($imc >= 30 && $imc <= 34.9):
            echo "<h2>Obesidade grau I.</h2>";
            break;
        case ($imc >= 35 && $imc <= 39.9):
            echo "<h2>Obesidade grau II (severa).</h2>";
            break;
        default:
            echo "<h2>Obesidade grau III (mórbida).</h2>";
            break;
    }
}
?>
<form action="index.php" method="post" >
    <p>
        Hight (m): <input type="number" name="hight" min="0" step="0.01">
    </p>
    <p>
        Weight (kg): <input type="number" name="weight" min="0" step="0.01">
    </p>
    <p>
        <input type="submit" name="calcular" value="calcular">
    </p>
</form>
</body>
</html>