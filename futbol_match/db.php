<?php
$serverName = "1496018.database.windows.net";
$database = "1496018";
$username = "andresubillus";
$password = "123456@a"; // Recuerda no compartir contraseñas en código real

try {
    // Conexión usando PDO
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a SQL Server";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
