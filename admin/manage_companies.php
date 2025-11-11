<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$sql = "SELECT id_empresa, razon_social, rfc, giro_empresa, direccion, dato_contacto, telefono_contacto FROM empresas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Empresas</title>
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
            <h3>Gestionar Empresas</h3>
            <a href="add_company.php" class="add-btn">Agregar Empresa</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Razón Social</th>
                        <th>RFC</th>
                        <th>Giro</th>
                        <th>Dirección</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id_empresa']; ?></td>
                                <td><?php echo htmlspecialchars($row['razon_social']); ?></td>
                                <td><?php echo htmlspecialchars($row['rfc']); ?></td>
                                <td><?php echo htmlspecialchars($row['giro_empresa']); ?></td>
                                <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                                <td><?php echo htmlspecialchars($row['dato_contacto']); ?></td>
                                <td><?php echo htmlspecialchars($row['telefono_contacto']); ?></td>
                                <td>
                                    <a href="edit_company.php?id=<?php echo $row['id_empresa']; ?>">Editar</a>
                                    <a href="delete_company.php?id=<?php echo $row['id_empresa']; ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No hay empresas registradas.</td>
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
