<?php
session_start();
include 'db.php';

$errores = '';
$datos = [
    'nombre' => '',
    'distrito' => '',
    'edad_min' => '',
    'edad_max' => '',
    'jugadores' => '',
    'celular' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos['nombre'] = $_POST['nombre'] ?? '';
    $datos['distrito'] = $_POST['distrito'] ?? '';
    $datos['edad_min'] = $_POST['edad_min'] ?? '';
    $datos['edad_max'] = $_POST['edad_max'] ?? '';
    $datos['jugadores'] = $_POST['jugadores'] ?? '';
    $datos['celular'] = $_POST['celular'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Validaciones adicionales
    if ($datos['edad_min'] < 0 || $datos['edad_max'] < 0) {
        $errores = "Las edades no pueden ser negativas.";
    } elseif ($datos['edad_min'] > $datos['edad_max']) {
        $errores = "La edad mínima no puede ser mayor que la edad máxima.";
    } elseif ($datos['jugadores'] <= 0) {
        $errores = "El número de jugadores debe ser mayor que cero.";
    } else {
        try {
            $stmt = $conn->prepare("
                INSERT INTO equipos 
                (nombre, password, edad_min, edad_max, victorias, derrotas, distrito, rango, jugadores, celular)
                VALUES 
                (:nombre, :password, :edad_min, :edad_max, 0, 0, :distrito, '', :jugadores, :celular)
            ");

            $stmt->execute([
                ':nombre' => $datos['nombre'],
                ':password' => $password,
                ':edad_min' => intval($datos['edad_min']),
                ':edad_max' => intval($datos['edad_max']),
                ':distrito' => $datos['distrito'],
                ':jugadores' => $datos['jugadores'],
                ':celular' => $datos['celular']
            ]);

            header("Location: login.html");
            exit;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errores = "El nombre de equipo ya está registrado.";
            } else {
                $errores = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Equipo</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <div class="registro-container">
        <h2>Registra tu equipo</h2>

        <?php if ($errores): ?>
            <p style="color:red; text-align:center;"><?= htmlspecialchars($errores) ?></p>
        <?php endif; ?>

        <form method="post" action="registro.php">
            <label for="nombre">Nombre del Equipo</label>
            <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($datos['nombre']) ?>">

            <label for="distrito">Distrito</label>
            <select id="distrito" name="distrito" required>
                <option value="">-- Selecciona tu distrito --</option>
                <?php
                $distritos = [
                    "Ancón", "Ate", "Barranco", "Breña", "Carabayllo", "Chaclacayo", "Chorrillos", "Cieneguilla",
                    "Comas", "El Agustino", "Independencia", "Jesús María", "La Molina", "La Victoria", "Lince",
                    "Los Olivos", "Lurigancho", "Lurín", "Magdalena del Mar", "Miraflores", "Pachacámac", "Pucusana",
                    "Pueblo Libre", "Puente Piedra", "Punta Hermosa", "Punta Negra", "Rímac", "San Bartolo",
                    "San Borja", "San Isidro", "San Juan de Lurigancho", "San Juan de Miraflores", "San Luis",
                    "San Martín de Porres", "San Miguel", "Santa Anita", "Santa María del Mar", "Santa Rosa",
                    "Santiago de Surco", "Surquillo", "Villa El Salvador", "Villa María del Triunfo"
                ];

                foreach ($distritos as $d) {
                    $selected = ($datos['distrito'] === $d) ? 'selected' : '';
                    echo "<option value=\"$d\" $selected>$d</option>";
                }
                ?>
            </select>
            <br>

            <label for="edad_min">Ingresa la edad minima de tus jugadores</label>
            <input type="number" id="edad_min" name="edad_min" min="0" required value="<?= htmlspecialchars($datos['edad_min']) ?>">

            <label for="edad_max">Ingresa la edad maxima de tus jugadores</label>
            <input type="number" id="edad_max" name="edad_max" min="0" required value="<?= htmlspecialchars($datos['edad_max']) ?>">

            <label for="jugadores">Ingresa la cantidad de jugadores en tu equipo</label>
            <input type="number" id="jugadores" name="jugadores" min="1" required value="<?= htmlspecialchars($datos['jugadores']) ?>">

            <label for="celular">Celular</label>
            <input type="text" id="celular" name="celular" required value="<?= htmlspecialchars($datos['celular']) ?>">

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Registrarse</button>
        </form>

        <a href="login.html" class="link">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</body>
</html>
