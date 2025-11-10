<?php
include '../includes/conexion.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nombre_empresa = $_POST['nombre_empresa'];
    $info_empresa = $_POST['info_empresa'];

    $sql = "INSERT INTO empresas (username, password, nombre_empresa, info_empresa) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $nombre_empresa, $info_empresa);
    
    if ($stmt->execute()) {
        $message = "Solicitud enviada exitosamente. Espere la aprobación del administrador.";
    } else {
        $message = "Error al enviar la solicitud: " . $conn->error;
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
    <title>Registro de Empresas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Enviar Solicitud de Empresa</h2>
        <?php if(!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="registro.php" method="POST">
            <div class="input-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="nombre_empresa">Nombre de la Empresa</label>
                <input type="text" id="nombre_empresa" name="nombre_empresa" required>
            </div>
            <div class="input-group">
                <label for="info_empresa">Información de la Empresa</label>
                <textarea id="info_empresa" name="info_empresa" rows="4" required></textarea>
            </div>
            <button type="submit">Enviar Solicitud</button>
        </form>
        <br>
        <a href="../index.php">Volver al Inicio de Sesión</a>
    </div>
</body>
</html>
