<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];

    if ($role == 'admin') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM administradores WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = 'admin';
                $_SESSION['username'] = $username;
                header("location: ../admin/dashboard.php");
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "No se encontró el usuario.";
        }
        $stmt->close();

    } elseif ($role == 'student') {
        $id_alumno = $_POST['id_alumno'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM alumnos WHERE id_alumno = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_alumno);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = 'student';
                $_SESSION['id_alumno'] = $id_alumno;
                header("location: ../student/dashboard.php");
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "No se encontró el alumno.";
        }
        $stmt->close();

    } elseif ($role == 'company') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM empresas WHERE username = ? AND status = 'aprobado'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = 'company';
                $_SESSION['username'] = $username;
                header("location: ../company/dashboard.php");
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "No se encontró la empresa o la solicitud no ha sido aprobada.";
        }
        $stmt->close();
    }
}

$conn->close();
?>
