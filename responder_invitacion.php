<?php
session_start();
include 'db.php';

$equipo_envia = $_POST['equipo_envia'] ?? '';
$accion = $_POST['accion'] ?? '';
$equipo_responde = $_SESSION['equipo'] ?? '';

if (!$equipo_envia || !$accion || !$equipo_responde) {
    echo "Faltan datos.";
    exit;
}

try {
    if ($accion == 'aceptar') {
        // 1. Insertar partido como aceptado
        $stmt = $conn->prepare("INSERT INTO partidos (de_equipo, para_equipo, estado) VALUES (:de_equipo, :para_equipo, 'aceptado')");
        $stmt->execute([
            ':de_equipo' => $equipo_envia,
            ':para_equipo' => $equipo_responde
        ]);

        // 2. Actualizar estado de invitación
        $stmt = $conn->prepare("UPDATE invitaciones SET estado = 'aceptado' WHERE equipo_envia = :envia AND equipo_recibe = :recibe");
        $stmt->execute([
            ':envia' => $equipo_envia,
            ':recibe' => $equipo_responde
        ]);

        // 3. Redirigir al usuario a buscar.html con JavaScript
        echo "GENIAL HICISTE MATCH, VE Y INCIA CHAT CON RETADOR";
    } elseif ($accion == 'rechazar') {
        $stmt = $conn->prepare("UPDATE invitaciones SET estado = 'rechazado' WHERE equipo_envia = :envia AND equipo_recibe = :recibe");
        $stmt->execute([
            ':envia' => $equipo_envia,
            ':recibe' => $equipo_responde
        ]);

        // Redirigir al usuario de nuevo a buscar.html
        echo "RECHAZASTE AL EQUIPO";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
