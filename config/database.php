<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mascotas_db";
$port = 3307; // este es el puerto que tengo en XAMPP

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Falló la conexión al servidor: " . $conn->connect_error);
}
?>
