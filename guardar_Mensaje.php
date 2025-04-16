<?php
session_start();
include 'db.php';

$emisor = $_SESSION['equipo'] ?? '';
$receptor = $_POST['receptor'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';

if (!$emisor || !$receptor || !$mensaje) {
    echo "Faltan datos.";
    exit;
}

try {
    // Verificar que ambos equipos hayan aceptado el match (estado 'aceptado' en la tabla 'partidos')
    $stmt = $conn->prepare("
        SELECT COUNT(*) FROM partidos
        WHERE (de_equipo = :e1 AND para_equipo = :e2 OR de_equipo = :e2 AND para_equipo = :e1) 
        AND estado = 'aceptado'
    ");
    $stmt->execute([':e1' => $emisor, ':e2' => $receptor]);

    if ($stmt->fetchColumn() == 0) {
        echo "No puedes chatear sin match aceptado.";
        exit;
    }

    // Guardar el mensaje en la base de datos
    $stmt = $conn->prepare("INSERT INTO mensajes (emisor, receptor, mensaje) VALUES (?, ?, ?)");
    $stmt->execute([$emisor, $receptor, $mensaje]);
    echo "Mensaje enviado.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
