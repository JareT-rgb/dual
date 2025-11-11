<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}
include '../includes/conexion.php';

// Fetch data for chart
$sql = "SELECT e.razon_social, COUNT(ra.id_alumno) as num_alumnos
        FROM empresas e
        LEFT JOIN registro_alumnos ra ON e.id_empresa = ra.id_empresa
        WHERE ra.status = 'activo'
        GROUP BY e.razon_social";
$result = $conn->query($sql);

$labels = [];
$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row['razon_social'];
        $data[] = $row['num_alumnos'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h2>Panel de Administración</h2>
            <div class="user-info">
                <div class="notification-icon">
                    <span id="notification-bell">&#128276;</span>
                    <span id="notification-count" class="badge" style="display: none;"></span>
                    <div id="notification-panel" class="notification-panel"></div>
                </div>
                <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>!</span>
                <a href="../includes/logout.php" class="logout-btn">Cerrar Sesión</a>
            </div>
        </header>
        <div class="dashboard-body">
            <nav class="sidebar">
                <ul>
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="manage_students.php">Gestionar Alumnos</a></li>
                    <li><a href="manage_companies.php">Gestionar Empresas</a></li>
                    <li><a href="registro_alumnos.php">Alumnos Vinculados</a></li>
                    <li><a href="solicitudes_empresas.php">Solicitudes</a></li>
                </ul>
            </nav>
            <main class="main-content">
                <h3>Alumnos Vinculados por Empresa</h3>
                <div style="width: 80%; margin: auto;">
                    <canvas id="studentsByCompanyChart"></canvas>
                </div>
            </main>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('studentsByCompanyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: '# de Alumnos',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(107, 30, 30, 0.5)',
                    borderColor: 'rgba(107, 30, 30, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const notificationBell = document.getElementById('notification-bell');
        const notificationCount = document.getElementById('notification-count');
        const notificationPanel = document.getElementById('notification-panel');

        function fetchNotifications() {
            fetch('fetch_notifications.php')
                .then(response => response.json())
                .then(data => {
                    if (data.count > 0) {
                        notificationCount.textContent = data.count;
                        notificationCount.style.display = 'block';
                    } else {
                        notificationCount.style.display = 'none';
                    }

                    notificationPanel.innerHTML = '';
                    if (data.notifications.length > 0) {
                        data.notifications.forEach(notification => {
                            const link = document.createElement('a');
                            link.href = `solicitudes_empresas.php?id=${notification.id_registro}`;
                            link.textContent = `Nueva solicitud de ${notification.nombre_alumno}`;
                            notificationPanel.appendChild(link);
                        });
                    } else {
                        notificationPanel.innerHTML = '<p style="padding: 10px; margin: 0;">No hay notificaciones nuevas.</p>';
                    }
                });
        }

        notificationBell.addEventListener('click', () => {
            notificationPanel.style.display = notificationPanel.style.display === 'block' ? 'none' : 'block';
        });

        // Fetch notifications every 30 seconds
        setInterval(fetchNotifications, 30000);
        // Initial fetch
        fetchNotifications();
    </script>
</body>
</html>
