
<?php
include 'db.php';
session_start();
$equipo_id = $_SESSION['equipo_id'];

$query = "SELECT invitaciones.id, equipos.nombre FROM invitaciones
JOIN equipos ON invitaciones.de_equipo = equipos.id
WHERE invitaciones.para_equipo = ? AND invitaciones.estado = 'pendiente'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $equipo_id);
$stmt->execute();
$result = $stmt->get_result();

$invitaciones = [];
while ($row = $result->fetch_assoc()) {
    $invitaciones[] = ['id' => $row['id'], 'nombre' => $row['nombre']];
}
header('Content-Type: application/json');
echo json_encode($invitaciones);
?>
