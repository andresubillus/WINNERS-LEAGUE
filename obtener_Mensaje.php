<?php
session_start();
include 'db.php';

$equipoActual = $_SESSION['equipo'] ?? '';
$receptor = $_GET['receptor'] ?? '';

if (!$equipoActual || !$receptor) {
    echo json_encode(["error" => "Faltan datos."]);
    exit;
}

try {
    // Verificar si los equipos han hecho match
    $stmt = $conn->prepare("
        SELECT COUNT(*) FROM partidos 
        WHERE (de_equipo = :e1 AND para_equipo = :e2 OR de_equipo = :e2 AND para_equipo = :e1) 
        AND estado = 'aceptado'
    ");
    $stmt->execute([':e1' => $equipoActual, ':e2' => $receptor]);

    // Si no está aceptado, no se debe permitir ver los mensajes
    if ($stmt->fetchColumn() == 0) {
        echo json_encode(["error" => "No autorizado."]);
        exit;
    }

    // Obtener los mensajes entre los dos equipos
    $stmt = $conn->prepare("
        SELECT emisor, mensaje, fecha_envio 
        FROM mensajes 
        WHERE (emisor = :e1 AND receptor = :e2) OR (emisor = :e2 AND receptor = :e1)
        ORDER BY fecha_envio ASC
    ");
    $stmt->execute([':e1' => $equipoActual, ':e2' => $receptor]);

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
