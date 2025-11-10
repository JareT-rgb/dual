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
            <div class="role-selector">
                <button class="role-btn active" onclick="showPanel('admin')">Administrador</button>
                <button class="role-btn" onclick="showPanel('student')">Alumno</button>
                <button class="role-btn" onclick="showPanel('company')">Empresa</button>
            </div>
        </div>

        <!-- Panel de Administrador -->
        <div id="admin-panel" class="login-panel active">
            <h3>Inicio de Sesión - Administrador</h3>
            <form action="includes/login.php" method="POST">
                <input type="hidden" name="role" value="admin">
                <div class="input-group">
                    <label for="admin-user">Usuario</label>
                    <input type="text" id="admin-user" name="username" required>
                </div>
                <div class="input-group">
                    <label for="admin-pass">Contraseña</label>
                    <input type="password" id="admin-pass" name="password" required>
                </div>
                <button type="submit">Ingresar</button>
            </form>
        </div>

        <!-- Panel de Alumno -->
        <div id="student-panel" class="login-panel">
            <h3>Inicio de Sesión - Alumno</h3>
            <form action="includes/login.php" method="POST">
                <input type="hidden" name="role" value="student">
                <div class="input-group">
                    <label for="student-id">ID Alumno</label>
                    <input type="text" id="student-id" name="id_alumno" required>
                </div>
                <div class="input-group">
                    <label for="student-pass">Contraseña</label>
                    <input type="password" id="student-pass" name="password" required>
                </div>
                <button type="submit">Ingresar</button>
            </form>
            <div class="student-register">
                <p>¿No tienes una cuenta? <a href="student/registro.php">Regístrate aquí</a></p>
            </div>
        </div>

        <!-- Panel de Empresa -->
        <div id="company-panel" class="login-panel">
            <h3>Inicio de Sesión - Empresa</h3>
            <form action="includes/login.php" method="POST">
                <input type="hidden" name="role" value="company">
                <div class="input-group">
                    <label for="company-user">Usuario Empresa</label>
                    <input type="text" id="company-user" name="username" required>
                </div>
                <div class="input-group">
                    <label for="company-pass">Contraseña</label>
                    <input type="password" id="company-pass" name="password" required>
                </div>
                <button type="submit">Ingresar</button>
            </form>
            <div class="company-register">
                <p>¿No tienes una cuenta? <a href="company/registro.php">Envía una solicitud</a></p>
            </div>
        </div>
    </div>

    <script>
        function showPanel(panelName) {
            const panels = document.querySelectorAll('.login-panel');
            panels.forEach(panel => {
                panel.classList.remove('active');
            });
            document.getElementById(panelName + '-panel').classList.add('active');

            const buttons = document.querySelectorAll('.role-btn');
            buttons.forEach(button => {
                button.classList.remove('active');
            });
            document.querySelector(`.role-btn[onclick="showPanel('${panelName}')"]`).classList.add('active');
        }
    </script>
</body>
</html>
