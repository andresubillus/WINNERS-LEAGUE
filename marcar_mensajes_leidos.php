<?php
session_start();
include 'db.php';

$equipoLogeado = $_SESSION['equipo'] ?? null;
$receptor = $_POST['receptor'] ?? '';

if ($equipoLogeado && $receptor) {
    $stmt = $pdo->prepare("UPDATE mensajes SET leido = 1 
        WHERE emisor = :receptor AND receptor = :equipo AND leido = 0");
    $stmt->execute([
        ':receptor' => $receptor,
        ':equipo' => $equipoLogeado
    ]);
}
?>
