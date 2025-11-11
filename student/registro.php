<?php
include '../includes/conexion.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['ap_paterno'];
    $ap_materno = $_POST['ap_materno'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $rfc = $_POST['rfc'];
    $direccion = $_POST['direccion'];
    $N_control = $_POST['N_control'];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];
    $turno = $_POST['turno'];
    $contrasena = $_POST['contrasena'];
    $confirm_contrasena = $_POST['confirm_contrasena'];

    if ($contrasena !== $confirm_contrasena) {
        $message = "Las contraseñas no coinciden.";
    } else {
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO alumnos (nombre, ap_paterno, ap_materno, correo, telefono, rfc, direccion, N_control, carrera, semestre, turno, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssiss", $nombre, $ap_paterno, $ap_materno, $correo, $telefono, $rfc, $direccion, $N_control, $carrera, $semestre, $turno, $hashed_password);
        
        if ($stmt->execute()) {
            $message = "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            $message = "Error en el registro: " . $stmt->error;
        }
        $stmt->close();
    }
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
                <label for="nombre">Nombre(s)</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="input-group">
                <label for="ap_paterno">Apellido Paterno</label>
                <input type="text" id="ap_paterno" name="ap_paterno" required>
            </div>
            <div class="input-group">
                <label for="ap_materno">Apellido Materno</label>
                <input type="text" id="ap_materno" name="ap_materno">
            </div>
            <div class="input-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="input-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono">
            </div>
            <div class="input-group">
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc">
            </div>
            <div class="input-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion">
            </div>
            <div class="input-group">
                <label for="N_control">Número de Control</label>
                <input type="text" id="N_control" name="N_control" required>
            </div>
            <div class="input-group">
                <label for="carrera">Carrera</label>
                <input type="text" id="carrera" name="carrera">
            </div>
            <div class="input-group">
                <label for="semestre">Semestre</label>
                <input type="number" id="semestre" name="semestre">
            </div>
            <div class="input-group">
                <label for="turno">Turno</label>
                <input type="text" id="turno" name="turno">
            </div>
            <div class="input-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="input-group">
                <label for="confirm_contrasena">Confirmar Contraseña</label>
                <input type="password" id="confirm_contrasena" name="confirm_contrasena" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <br>
        <a href="../index.php">Volver al Inicio de Sesión</a>
    </div>
</body>
</html>
