<?php
session_start();
include 'db.php';

if (!isset($_SESSION['equipo'])) {
    header("Location: login.html");
    exit;
}

$equipo = $_SESSION['equipo'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_celular = $_POST['celular'] ?? '';
    $nuevos_jugadores = $_POST['jugadores'] ?? '';

    $stmt = $conn->prepare("UPDATE equipos SET celular = :celular, jugadores = :jugadores WHERE nombre = :nombre");
    $stmt->bindParam(':celular', $nuevo_celular);
    $stmt->bindParam(':jugadores', $nuevos_jugadores);
    $stmt->bindParam(':nombre', $equipo);
    $stmt->execute();
}

$stmt = $conn->prepare("SELECT * FROM equipos WHERE nombre = :nombre");
$stmt->bindParam(':nombre', $equipo);
$stmt->execute();
$datos = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Futbol Match</title>
    <link rel="stylesheet" href="perfil.css">
</head>
<body>
<div class="container">
        <h2>Perfil del Equipo</h2>
        <form method="POST">
            <label>Nombre del equipo:</label>
            <input type="text" value="<?= htmlspecialchars($datos['nombre']) ?>" disabled>

            <label>Distrito:</label>
            <input type="text" value="<?= htmlspecialchars($datos['distrito']) ?>" disabled>

            <label>Rango de Edad:</label>
            <input type="text" value="<?= htmlspecialchars($datos['rango']) ?>" disabled>

            <label>Edad Mínima:</label>
            <input type="text" value="<?= $datos['edad_min'] ?>" disabled>

            <label>Edad Máxima:</label>
            <input type="text" value="<?= $datos['edad_max'] ?>" disabled>

            <label>Victorias:</label>
            <input type="text" value="<?= $datos['victorias'] ?>" disabled>

            <label>Derrotas:</label>
            <input type="text" value="<?= $datos['derrotas'] ?>" disabled>

            <label>Jugadores:</label>
            <input type="text" name="jugadores" value="<?= htmlspecialchars($datos['jugadores']) ?>">

            <label>Celular:</label>
            <input type="text" name="celular" value="<?= htmlspecialchars($datos['celular']) ?>">

            <button type="submit">Actualizar</button>
            <a href="index.php" class="volver">Volver</a>
        </form>
    </div>
</body>
</html>