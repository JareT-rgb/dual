<?php
$servername = "sql300.infinityfree.com";
$username = "if0_40386948";
$password = "jaretjaja777";
$dbname = "if0_40386948_dualdb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>
