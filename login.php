<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'];
    $password = $_POST['password'];

    try {
        // Obtener el equipo de la base de datos
        $stmt = $conn->prepare("SELECT * FROM equipos WHERE nombre = :nombre LIMIT 1");
        $stmt->execute([':nombre' => $nombre]);
        $equipo = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si la contraseña coincide con el hash almacenado en la base de datos
        if ($equipo && password_verify($password, $equipo['password'])) {
            $_SESSION['equipo'] = $equipo['nombre'];
            $_SESSION['equipo_id'] = $equipo['id'];
            // Redirigir al usuario a la página de búsqueda después de iniciar sesión
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='login.html';</script>";
        }
    } catch (PDOException $e) {
        echo "Error de base de datos: " . $e->getMessage();
    }
}
?>
