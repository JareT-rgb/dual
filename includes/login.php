<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM administradores WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Note: For a real application, you should use password_verify().
        // For this example, we are comparing plain text.
        // if (password_verify($contrasena, $user['contrasena'])) {
        if ($contrasena == $user['contrasena']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];

            if (!empty($user['id_alumno'])) {
                $_SESSION['role'] = 'student';
                $_SESSION['id_alumno'] = $user['id_alumno'];
                header("location: ../student/dashboard.php");
            } elseif (!empty($user['id_empresa'])) {
                $_SESSION['role'] = 'company';
                $_SESSION['id_empresa'] = $user['id_empresa'];
                header("location: ../company/dashboard.php");
            } else {
                $_SESSION['role'] = 'admin';
                header("location: ../admin/dashboard.php");
            }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró el usuario.";
    }
    $stmt->close();
}
$conn->close();
?>
