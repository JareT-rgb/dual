<?php
include '../includes/conexion.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $razon_social = $_POST['razon_social'];
    $rfc = $_POST['rfc'];
    $giro_empresa = $_POST['giro_empresa'];
    $direccion = $_POST['direccion'];
    $dato_contacto = $_POST['dato_contacto'];
    $telefono_contacto = $_POST['telefono_contacto'];
    $telefono_empresa = $_POST['telefono_empresa'];
    $perfil_alumno = $_POST['perfil_alumno'];

    $sql = "INSERT INTO empresas (razon_social, rfc, giro_empresa, direccion, dato_contacto, telefono_contacto, telefono_empresa, perfil_alumno) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $razon_social, $rfc, $giro_empresa, $direccion, $dato_contacto, $telefono_contacto, $telefono_empresa, $perfil_alumno);
    
    if ($stmt->execute()) {
        $message = "Solicitud enviada exitosamente. Espere la aprobación del administrador.";
    } else {
        $message = "Error al enviar la solicitud: " . $stmt->error;
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
                <label for="razon_social">Razón Social</label>
                <input type="text" id="razon_social" name="razon_social" required>
            </div>
            <div class="input-group">
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc" required>
            </div>
            <div class="input-group">
                <label for="giro_empresa">Giro de la Empresa</label>
                <input type="text" id="giro_empresa" name="giro_empresa">
            </div>
            <div class="input-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion">
            </div>
            <div class="input-group">
                <label for="dato_contacto">Dato de Contacto</label>
                <input type="text" id="dato_contacto" name="dato_contacto">
            </div>
            <div class="input-group">
                <label for="telefono_contacto">Teléfono de Contacto</label>
                <input type="text" id="telefono_contacto" name="telefono_contacto">
            </div>
            <div class="input-group">
                <label for="telefono_empresa">Teléfono de la Empresa</label>
                <input type="text" id="telefono_empresa" name="telefono_empresa">
            </div>
            <div class="input-group">
                <label for="perfil_alumno">Perfil del Alumno Buscado</label>
                <textarea id="perfil_alumno" name="perfil_alumno" rows="4"></textarea>
            </div>
            <button type="submit">Enviar Solicitud</button>
        </form>
        <br>
        <a href="../index.php">Volver al Inicio de Sesión</a>
    </div>
</body>
</html>
