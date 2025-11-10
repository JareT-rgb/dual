<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Proyecto Dual</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Proyecto Dual</h2>
        </div>

        <div class="login-panel active">
            <h3>Inicio de Sesión</h3>
            <form action="includes/login.php" method="POST">
                <div class="input-group">
                    <label for="nombre_usuario">Usuario</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" required>
                </div>
                <div class="input-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <button type="submit">Ingresar</button>
            </form>
            <div class="register-links">
                <p>¿Eres un alumno? <a href="student/registro.php">Regístrate aquí</a></p>
                <p>¿Eres una empresa? <a href="company/registro.php">Envía una solicitud</a></p>
            </div>
        </div>
    </div>
</body>
</html>
