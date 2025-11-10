<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$sql = "SELECT id_empresa, razon_social, rfc, giro_empresa, direccion, dato_contacto, telefono_contacto, telefono_empresa, perfil_alumno FROM empresas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Empresas</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Solicitudes de Empresas</h2>
        <a href="dashboard.php">Volver al Dashboard</a>
        <br><br>
        <table>
            <tr>
                <th>ID Empresa</th>
                <th>Razón Social</th>
                <th>RFC</th>
                <th>Giro</th>
                <th>Dirección</th>
                <th>Contacto</th>
                <th>Tel. Contacto</th>
                <th>Tel. Empresa</th>
                <th>Perfil Alumno</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_empresa"] . "</td>";
                    echo "<td>" . $row["razon_social"] . "</td>";
                    echo "<td>" . $row["rfc"] . "</td>";
                    echo "<td>" . $row["giro_empresa"] . "</td>";
                    echo "<td>" . $row["direccion"] . "</td>";
                    echo "<td>" . $row["dato_contacto"] . "</td>";
                    echo "<td>" . $row["telefono_contacto"] . "</td>";
                    echo "<td>" . $row["telefono_empresa"] . "</td>";
                    echo "<td>" . $row["perfil_alumno"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay empresas registradas.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
