<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_clientes";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>