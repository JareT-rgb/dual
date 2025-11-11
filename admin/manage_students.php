<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$sql = "SELECT id_alumno, nombre, ap_paterno, ap_materno, correo, N_control, carrera, semestre, turno FROM alumnos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Alumnos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h2>Panel de Administración</h2>
            <div class="user-info">
                <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>!</span>
                <a href="../includes/logout.php" class="logout-btn">Cerrar Sesión</a>
            </div>
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_students.php">Gestionar Alumnos</a></li>
                <li><a href="manage_companies.php">Gestionar Empresas</a></li>
                <li><a href="registro_alumnos.php">Alumnos Vinculados</a></li>
                <li><a href="solicitudes_empresas.php">Solicitudes</a></li>
            </ul>
        </nav>
        <main class="main-content">
            <h3>Gestionar Alumnos</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>N° Control</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Turno</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id_alumno']; ?></td>
                                <td><?php echo htmlspecialchars($row['nombre'] . ' ' . $row['ap_paterno'] . ' ' . $row['ap_materno']); ?></td>
                                <td><?php echo htmlspecialchars($row['correo']); ?></td>
                                <td><?php echo htmlspecialchars($row['N_control']); ?></td>
                                <td><?php echo htmlspecialchars($row['carrera']); ?></td>
                                <td><?php echo htmlspecialchars($row['semestre']); ?></td>
                                <td><?php echo htmlspecialchars($row['turno']); ?></td>
                                <td>
                                    <a href="edit_student.php?id=<?php echo $row['id_alumno']; ?>">Editar</a>
                                    <a href="delete_student.php?id=<?php echo $row['id_alumno']; ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No hay alumnos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
<?php
$conn->close();
?>
