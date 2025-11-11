<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'student') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

$id_alumno = $_SESSION['id_alumno'];
$sql = "SELECT * FROM alumnos WHERE id_alumno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_alumno);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Fetch companies
$sql_companies = "SELECT * FROM empresas";
$result_companies = $conn->query($sql_companies);
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="dashboard-container student-dashboard">
        <header>
            <h2>Bienvenido, <?php echo htmlspecialchars($student['nombre'] . " " . $student['ap_paterno']); ?>!</h2>
            <a href="../includes/logout.php" class="logout-btn">Cerrar Sesión</a>
        </header>
        <main class="main-content">
            <h3>Empresas Disponibles</h3>
            <div class="company-cards">
                <?php if ($result_companies->num_rows > 0): ?>
                    <?php while($company = $result_companies->fetch_assoc()): ?>
                        <div class="card">
                            <h3><?php echo htmlspecialchars($company['razon_social']); ?></h3>
                            <p><strong>Giro:</strong> <?php echo htmlspecialchars($company['giro']); ?></p>
                            <p><strong>Perfil Buscado:</strong> <?php echo htmlspecialchars($company['perfil_alumno']); ?></p>
                            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($company['direccion']); ?></p>
                            <a href="apply.php?id_empresa=<?php echo $company['id_empresa']; ?>" class="btn-apply">Solicitar Vinculación</a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hay empresas disponibles en este momento.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
