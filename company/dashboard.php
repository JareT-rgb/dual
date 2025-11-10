<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'company') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$username = $_SESSION['username'];
$sql = "SELECT * FROM empresas WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$company = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenido, <?php echo $company['nombre_empresa']; ?>!</h2>
        <p>Este es el panel de su empresa.</p>
        <div>
            <h3>Información de la Empresa</h3>
            <p><strong>Usuario:</strong> <?php echo $company['username']; ?></p>
            <p><strong>Información:</strong> <?php echo $company['info_empresa']; ?></p>
            <p><strong>Estado de la Solicitud:</strong> <?php echo $company['status']; ?></p>
        </div>
        <br>
        <a href="../includes/logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>
