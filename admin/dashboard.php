<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenido, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Este es el panel de administración.</p>
        <nav>
            <ul>
                <li><a href="registro_alumnos.php">Ver Alumnos Registrados</a></li>
                <li><a href="solicitudes_empresas.php">Ver Solicitudes de Empresas</a></li>
                <li><a href="../includes/logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
