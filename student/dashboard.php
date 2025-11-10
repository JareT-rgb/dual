<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'student') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$id_alumno = $_SESSION['id_alumno'];
$sql = "SELECT * FROM alumnos WHERE id_alumno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_alumno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenido, <?php echo $student['nombre'] . " " . $student['ap_paterno']; ?>!</h2>
        <p>Este es tu panel de alumno.</p>
        <div>
            <h3>Tu Información</h3>
            <p><strong>ID Alumno:</strong> <?php echo $student['id_alumno']; ?></p>
            <p><strong>Carrera:</strong> <?php echo $student['carrera']; ?></p>
            <p><strong>Semestre:</strong> <?php echo $student['semestre']; ?></p>
            <p><strong>Empresa Seleccionada:</strong> <?php echo $student['empresa_seleccionada'] ? $student['empresa_seleccionada'] : 'No asignada'; ?></p>
            <p><strong>Puesto:</strong> <?php echo $student['puesto'] ? $student['puesto'] : 'No asignado'; ?></p>
            <p><strong>Fecha de Inicio:</strong> <?php echo $student['fecha_inicio'] ? $student['fecha_inicio'] : 'No asignada'; ?></p>
            <p><strong>Fecha de Salida:</strong> <?php echo $student['fecha_salida'] ? $student['fecha_salida'] : 'No asignada'; ?></p>
        </div>
        <br>
        <a href="../includes/logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>
