<?php
session_start();
include('db.php'); // Asegúrate que este archivo existe y se llama así

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $equipo_envia = $_SESSION['equipo']; // Debes tener la sesión iniciada correctamente
    $equipo_recibe = $_POST['equipo_destino'];

    if ($equipo_envia && $equipo_recibe) {
        $stmt = $conn->prepare("INSERT INTO invitaciones (equipo_envia, equipo_recibe) VALUES (?, ?)");
        $stmt->bind_param("ss", $equipo_envia, $equipo_recibe);
        if ($stmt->execute()) {
            echo "Invitación enviada a $equipo_recibe.";
        } else {
            echo "Error al enviar la invitación.";
        }
        $stmt->close();
    } else {
        echo "Datos incompletos.";
    }
}
?>
