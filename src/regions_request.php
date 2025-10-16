<?php
require(__DIR__ . '/../database.php'); // Tu archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $region_name   = trim($_POST['region_name'] ?? '');
    $region_abbrev = trim($_POST['region_abbrev'] ?? '');
    $region_code   = trim($_POST['region_code'] ?? '');

    if (!empty($region_name)) {
        $sql_insert = "INSERT INTO regions (region_name, region_abbrev, region_code) VALUES ($1, $2, $3)";
        $params = array($region_name, $region_abbrev, $region_code);

        $ok_local = $ok_supa = false;

        if ($conn_supa) $ok_supa = pg_query_params($conn_supa, $sql_insert, $params);
        if ($conn_local) $ok_local = pg_query_params($conn_local, $sql_insert, $params);

        if ($ok_local && $ok_supa) {
            $msg = "✅ Región registrada correctamente en ambas bases.";
        } elseif ($ok_local || $ok_supa) {
            $msg = "⚠️ Región registrada solo en una de las bases.";
        } else {
            $msg = "❌ Error registrando región: " . pg_last_error($conn_local ?: $conn_supa);
        }
    } else {
        $msg = "❌ El nombre de la región no puede estar vacío.";
    }
}

pg_close($conn_supa);
pg_close($conn_local);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado del registro</title>
</head>
<body>
  <h2>Resultado:</h2>
  <p><?php echo isset($msg) ? htmlspecialchars($msg) : 'Sin resultados'; ?></p>
  <a href="regions.php">⬅️ Volver al formulario</a>
</body>
</html>

