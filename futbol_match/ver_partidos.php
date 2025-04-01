
<?php
include 'db.php';
session_start();
$equipo_id = $_SESSION['equipo_id'];

$query = "SELECT p.id, e1.nombre AS de_nombre, e2.nombre AS para_nombre, p.fecha, p.hora, p.estado, p.de_equipo, p.para_equipo
          FROM partidos p
          JOIN equipos e1 ON p.de_equipo = e1.id
          JOIN equipos e2 ON p.para_equipo = e2.id
          WHERE p.de_equipo = ? OR p.para_equipo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $equipo_id, $equipo_id);
$stmt->execute();
$result = $stmt->get_result();

$partidos = [];
while ($row = $result->fetch_assoc()) {
    $partidos[] = $row;
}
header('Content-Type: application/json');
echo json_encode($partidos);
?>
