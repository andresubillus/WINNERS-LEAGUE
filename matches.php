<?php
session_start();
include 'db.php';

$equipo = $_SESSION['equipo'] ?? '';

if (!$equipo) {
    echo json_encode([]);
    exit;
}

try {
    // Recuperar los equipos con los que se tiene un match aceptado
    $stmt = $conn->prepare("
        SELECT 
            CASE 
                WHEN equipo_envia = :equipo THEN equipo_recibe
                ELSE equipo_envia
            END AS nombre_equipo
        FROM invitaciones
        WHERE (equipo_envia = :equipo OR equipo_recibe = :equipo) AND estado = 'aceptado'
    ");
    $stmt->execute([':equipo' => $equipo]);

    // Devolver los equipos con los que hay match aceptado
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
