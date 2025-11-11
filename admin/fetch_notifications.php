<?php
session_start();
include '../includes/conexion.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header('HTTP/1.1 403 Forbidden');
    exit;
}

header('Content-Type: application/json');

$sql = "SELECT ra.id_registro, a.nombre as nombre_alumno
        FROM registro_alumnos ra
        JOIN alumnos a ON ra.id_alumno = a.id_alumno
        WHERE ra.status = 'pendiente'";
$result = $conn->query($sql);

$notifications = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

$response = [
    'count' => count($notifications),
    'notifications' => $notifications
];

echo json_encode($response);

$conn->close();
?>
