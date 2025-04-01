
<?php
include 'db.php';
session_start();
$equipo_id = $_SESSION['equipo_id'];
$data = json_decode(file_get_contents("php://input"), true);
$para_equipo = $data['para_equipo'];
$fecha = $data['fecha'];
$hora = $data['hora'];

$stmt = $conn->prepare("INSERT INTO partidos (de_equipo, para_equipo, fecha, hora) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $equipo_id, $para_equipo, $fecha, $hora);
$stmt->execute();

echo json_encode(["success" => true]);
?>
