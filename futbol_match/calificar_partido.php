
<?php
include 'db.php';
session_start();
$equipo_id = $_SESSION['equipo_id'];
$partido_id = $_POST['partido_id'];
$comentario = $_POST['comentario'];
$calificacion = $_POST['calificacion'];

$query = "INSERT INTO calificaciones (partido_id, equipo_id, comentario, calificacion) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iisi", $partido_id, $equipo_id, $comentario, $calificacion);
$stmt->execute();

echo json_encode(["success" => true]);
?>
