<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$sql = "SELECT id_registro, id_alumno, nombre, ap_paterno, ap_materno, carrera, semestre, empresa_seleccionada, puesto, fecha_inicio, fecha_salida FROM registro_alumnos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos Registrados</title>
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
        <h2>Alumnos Registrados</h2>
        <a href="dashboard.php">Volver al Dashboard</a>
        <br><br>
        <table>
            <tr>
                <th>ID Registro</th>
                <th>ID Alumno</th>
                <th>Nombre</th>
                <th>Ap. Paterno</th>
                <th>Ap. Materno</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Empresa</th>
                <th>Puesto</th>
                <th>Fecha Inicio</th>
                <th>Fecha Salida</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_registro"] . "</td>";
                    echo "<td>" . $row["id_alumno"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["ap_paterno"] . "</td>";
                    echo "<td>" . $row["ap_materno"] . "</td>";
                    echo "<td>" . $row["carrera"] . "</td>";
                    echo "<td>" . $row["semestre"] . "</td>";
                    echo "<td>" . $row["empresa_seleccionada"] . "</td>";
                    echo "<td>" . $row["puesto"] . "</td>";
                    echo "<td>" . $row["fecha_inicio"] . "</td>";
                    echo "<td>" . $row["fecha_salida"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No hay alumnos registrados.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
