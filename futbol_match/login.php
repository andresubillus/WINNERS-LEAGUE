<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $password = hash('sha256', $_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM equipos WHERE nombre = ? AND password = ?");
    $stmt->bind_param("ss", $nombre, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['equipo'] = $row['nombre'];    // Guarda el nombre
        $_SESSION['equipo_id'] = $row['id'];     // Guarda el ID (importante para invitaciones)
        header("Location: buscar.html");
        exit();
    } else {
        echo "<p style='color:red;'>Nombre o contraseña incorrectos.</p>";
    }
    $stmt->close();
}
?>
