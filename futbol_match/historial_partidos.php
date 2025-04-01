
<?php
include 'db.php';
session_start();
$equipo_id = $_SESSION['equipo_id'];

$query = "SELECT p.id AS partido_id, p.fecha, p.hora, e1.nombre AS rival, 
          CASE 
              WHEN p.de_equipo = ? THEN 'Enviado'
              WHEN p.para_equipo = ? THEN 'Recibido'
          END AS tipo, p.estado
          FROM partidos p
          JOIN equipos e1 ON 
              (p.de_equipo = ? AND e1.id = p.para_equipo) OR 
              (p.para_equipo = ? AND e1.id = p.de_equipo)
          WHERE (p.de_equipo = ? OR p.para_equipo = ?) AND p.estado = 'aceptado'
          ORDER BY p.fecha DESC, p.hora DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiiiii", $equipo_id, $equipo_id, $equipo_id, $equipo_id, $equipo_id, $equipo_id);
$stmt->execute();
$result = $stmt->get_result();

$historial = [];
while ($row = $result->fetch_assoc()) {
    $historial[] = $row;
}
header('Content-Type: application/json');
echo json_encode($historial);
?>
