<?php
include 'db.php';

$distrito = $_GET['distrito'] ?? '';
$rango = $_GET['rango'] ?? '';

$sql = "SELECT * FROM equipos WHERE 1=1";
$params = [];

if (!empty($distrito)) {
    $sql .= " AND distrito LIKE :distrito";
    $params[':distrito'] = "%$distrito%";
}

if (!empty($rango) && strpos($rango, '-') !== false) {
    list($min, $max) = explode('-', $rango);
    $sql .= " AND edad_min >= :min AND edad_max <= :max";
    $params[':min'] = (int)$min;
    $params[':max'] = (int)$max;
}

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
