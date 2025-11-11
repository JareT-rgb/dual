<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'student') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$message = '';
$id_alumno = $_SESSION['id_alumno'];
$id_empresa = isset($_GET['id_empresa']) ? $_GET['id_empresa'] : null;

if (!$id_empresa) {
    header("location: dashboard.php");
    exit;
}

// Check if student is already linked
$sql_check = "SELECT * FROM registro_alumnos WHERE id_alumno = ? AND status = 'activo'";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $id_alumno);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    $message = "Ya tienes una vinculación activa.";
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $puesto = $_POST['puesto'];
        $fecha_inicio = $_POST['fecha_inicio'];

        $sql_insert = "INSERT INTO registro_alumnos (id_alumno, id_empresa, puesto, fecha_inicio, status) VALUES (?, ?, ?, ?, 'pendiente')";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("iiss", $id_alumno, $id_empresa, $puesto, $fecha_inicio);

        if ($stmt_insert->execute()) {
            $message = "Solicitud enviada exitosamente.";
        } else {
            $message = "Error al enviar la solicitud: " . $stmt_insert->error;
        }
        $stmt_insert->close();
    }
}
$stmt_check->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Vinculación</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Solicitar Vinculación</h2>
        <?php if(!empty($message)): ?>
            <p><?php echo $message; ?></p>
            <a href="dashboard.php">Volver al Dashboard</a>
        <?php else: ?>
            <form action="apply.php?id_empresa=<?php echo htmlspecialchars($id_empresa); ?>" method="POST">
                <div class="input-group">
                    <label for="puesto">Puesto Deseado</label>
                    <input type="text" id="puesto" name="puesto" required>
                </div>
                <div class="input-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <button type="submit">Enviar Solicitud</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
