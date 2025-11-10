<?php
include '../includes/conexion.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_alumno = $_POST['id_alumno'];
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO alumnos (id_alumno, nombre, ap_paterno, ap_materno, carrera, semestre, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $id_alumno, $nombre, $ap_paterno, $ap_materno, $carrera, $semestre, $password);
    
    if ($stmt->execute()) {
        $message = "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        $message = "Error en el registro: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Registro de Alumno</h2>
        <?php if(!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="registro.php" method="POST">
            <div class="input-group">
                <label for="id_alumno">ID Alumno</label>
                <input type="text" id="id_alumno" name="id_alumno" required>
            </div>
            <div class="input-group">
                <label for="nombre">Nombre(s)</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="input-group">
                <label for="ap_paterno">Apellido Paterno</label>
                <input type="text" id="ap_paterno" name="ap_paterno" required>
            </div>
            <div class="input-group">
                <label for="ap_materno">Apellido Materno</label>
                <input type="text" id="ap_materno" name="ap_materno" required>
            </div>
            <div class="input-group">
                <label for="carrera">Carrera</label>
                <input type="text" id="carrera" name="carrera" required>
            </div>
            <div class="input-group">
                <label for="semestre">Semestre</label>
                <input type="text" id="semestre" name="semestre" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <br>
        <a href="../index.php">Volver al Inicio de Sesión</a>
    </div>
</body>
</html>
