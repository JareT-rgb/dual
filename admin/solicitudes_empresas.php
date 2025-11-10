<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

// Handle status updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $update_sql = "UPDATE empresas SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT id, username, nombre_empresa, info_empresa, status FROM empresas";
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
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre Empresa</th>
                <th>Información</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["nombre_empresa"] . "</td>";
                    echo "<td>" . $row["info_empresa"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>
                            <form action='solicitudes_empresas.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <select name='status' onchange='this.form.submit()'>
                                    <option value='pendiente' " . ($row["status"] == 'pendiente' ? 'selected' : '') . ">Pendiente</option>
                                    <option value='aprobado' " . ($row["status"] == 'aprobado' ? 'selected' : '') . ">Aprobado</option>
                                    <option value='rechazado' " . ($row["status"] == 'rechazado' ? 'selected' : '') . ">Rechazado</option>
                                </select>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay solicitudes de empresas.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
