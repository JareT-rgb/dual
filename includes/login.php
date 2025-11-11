<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $login_error = '';

    // Check in administradores table
    $sql = "SELECT * FROM administradores WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($contrasena, $user['contrasena'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
            $_SESSION['role'] = 'admin';
            header("location: ../admin/dashboard.php");
            exit;
        } else {
            $login_error = "Contraseña incorrecta.";
        }
    } else {
        // Check in alumnos table
        $sql = "SELECT * FROM alumnos WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($contrasena, $user['contrasena'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id_alumno'] = $user['id_alumno'];
                $_SESSION['nombre_usuario'] = $user['nombre'];
                $_SESSION['role'] = 'student';
                header("location: ../student/dashboard.php");
                exit;
            } else {
                $login_error = "Contraseña incorrecta.";
            }
        } else {
            $login_error = "No se encontró el usuario.";
        }
    }
    $stmt->close();
    $conn->close();
    $_SESSION['login_error'] = $login_error;
    header("location: ../index.php");
}
?>
