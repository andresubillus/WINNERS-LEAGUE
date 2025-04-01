<?php
// responder_invitacion.php
include 'db.php'; // Conexión a tu base de datos

$equipo_envia = $_POST['equipo_envia'];
$accion = $_POST['accion']; // 'aceptar' o 'rechazar'

// Suponemos que tienes la sesión activa o sabes quién responde:
session_start();
$equipo_responde = $_SESSION['equipo']; // Ajusta según cómo manejas sesiones

// Actualiza la invitación (opcional, si tienes tabla de invitaciones)
$stmt = $conn->prepare("UPDATE invitaciones SET estado = ? WHERE equipo_envia = ? AND equipo_recibe = ?");
$stmt->bind_param("sss", $accion, $equipo_envia, $equipo_responde);
$stmt->execute();
$stmt->close();

// Insertar notificación para el equipo que envió la invitación
$mensaje = "El equipo '$equipo_responde' ha $accion tu invitación.";
$stmt2 = $conn->prepare("INSERT INTO notificaciones (equipo_destino, mensaje, leido) VALUES (?, ?, 0)");
$stmt2->bind_param("ss", $equipo_envia, $mensaje);
$stmt2->execute();
$stmt2->close();

echo "Has $accion la invitación.";
?>
