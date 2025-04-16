<?php
session_start();
header('Content-Type: application/json');

include 'db.php';

$equipo_id = $_SESSION['equipo_id'] ?? null;

if (!$equipo_id) {
    echo json_encode(["nuevos" => false]);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT COUNT(*) AS cantidad FROM mensajes WHERE receptor_id = :id AND leido = 0");
    $stmt->bindParam(':id', $equipo_id, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "nuevos" => $resultado && $resultado['cantidad'] > 0
    ]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error en la base de datos", "detalles" => $e->getMessage()]);
}
