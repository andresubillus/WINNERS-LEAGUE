<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];

    // Preparar la consulta con PDO
    $stmt = $conn->prepare("SELECT * FROM equipos WHERE nombre = ?");
    $stmt->execute([$nombre]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['equipo'] = $row['nombre'];
        $_SESSION['equipo_id'] = $row['id'];
        header("Location: buscar.html");
        exit();
    } else {
        echo "<p style='color:red;'>Nombre o contraseña incorrectos.</p>";
    }
}
?>
