
<?php
include 'db.php';
session_start();
$equipo_id = $_SESSION['equipo_id'];

$query = "SELECT e.nombre AS nombre_equipo, e.distrito, e.rango, e.celular
          FROM invitaciones i
          JOIN equipos e ON (i.de_equipo = e.id OR i.para_equipo = e.id)
          WHERE (i.de_equipo = ? OR i.para_equipo = ?)
          AND i.estado = 'aceptado' AND e.id != ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $equipo_id, $equipo_id, $equipo_id);
$stmt->execute();
$result = $stmt->get_result();

$matches = [];
while ($row = $result->fetch_assoc()) {
    $matches[] = $row;
}
header('Content-Type: application/json');
echo json_encode($matches);
?>
