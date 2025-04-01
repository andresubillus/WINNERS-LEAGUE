<?php
// ver_respuestas.php
include 'db.php';
session_start();
$equipo_actual = $_SESSION['equipo'];

$result = $conn->query("SELECT id, mensaje FROM notificaciones WHERE equipo_destino = '$equipo_actual' AND leido = 0");

$notificaciones = [];
while ($row = $result->fetch_assoc()) {
    $notificaciones[] = $row;
}

// Marca como leídas
$conn->query("UPDATE notificaciones SET leido = 1 WHERE equipo_destino = '$equipo_actual'");

echo json_encode($notificaciones);
?>
