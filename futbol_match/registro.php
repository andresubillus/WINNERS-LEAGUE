<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $password = hash('sha256', $_POST['password']); // Hash SHA-256
    $edad_min = intval($_POST['edad_min']);
    $edad_max = intval($_POST['edad_max']);
    $distrito = $_POST['distrito'];
    $rango = $_POST['rango'];
    $jugadores = $_POST['jugadores'];

    $stmt = $conn->prepare("INSERT INTO equipos (nombre, password, edad_min, edad_max, victorias, derrotas, distrito, rango, jugadores)
                            VALUES (?, ?, ?, ?, 0, 0, ?, ?, ?)");
    $stmt->bind_param("ssiisss", $nombre, $password, $edad_min, $edad_max, $distrito, $rango, $jugadores);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Registro exitoso. Puedes iniciar sesión ahora.</p>";
    } else {
        echo "<p style='color:red;'>Error al registrar equipo: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>