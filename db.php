<?php
$serverName = "localhost"; // Usualmente 'localhost' o la IP de tu servidor
$database = "futbol_match_db"; // El nombre de tu base de datos
$username = "root"; // El usuario de MariaDB
$password = ""; // La contraseña del usuario

try {
    // Conexión a MariaDB usando PDO
    $conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar el modo de excepciones para errores
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage()); // En caso de error, lo mostramos
}
?>
