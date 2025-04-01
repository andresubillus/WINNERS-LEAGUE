<?php
session_start();
include 'db.php';

if (isset($_SESSION['equipo'])) {
    $equipo_actual = $_SESSION['equipo'];
    $stmt = $conn->prepare("SELECT equipo_envia FROM invitaciones WHERE equipo_recibe = ? AND estado = 'pendiente'");
    $stmt->bind_param("s", $equipo_actual);
    $stmt->execute();
    $result = $stmt->get_result();

    $invitaciones = [];
    while ($row = $result->fetch_assoc()) {
        $invitaciones[] = $row;
    }
    echo json_encode($invitaciones);
    $stmt->close();
} else {
    echo json_encode([]);
}
?>
