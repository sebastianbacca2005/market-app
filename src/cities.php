<?php
$expected_path = __DIR__ . '/../database.php';
if (!file_exists($expected_path)) {
    exit("ERROR: database.php no encontrado en: " . $expected_path);
}
require_once $expected_path;

$sql_create = "
CREATE TABLE IF NOT EXISTS cities (
    id SERIAL PRIMARY KEY,
    city_name VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    population INTEGER,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

function safe_run_query($conn, $sql, $label) {
    if (!isset($conn) || !$conn) {
        echo "<p style='color:red;'>$label: conexión no definida o false.</p>";
        return;
    }
    if (!function_exists('pg_query')) {
        echo "<p style='color:red;'>$label: extensión pg de PHP no está disponible.</p>";
        return;
    }
    $res = @pg_query($conn, $sql);
    if ($res === false) {
        $err = pg_last_error($conn);
        echo "<p style='color:red;'>$label: error en pg_query -> " . htmlspecialchars($err) . "</p>";
        return;
    }
    echo "<p style='color:green;'>$label: OK.</p>";
}

safe_run_query($conn_supa ?? null, $sql_create, "Supabase (conn_supa)");
safe_run_query($conn_local ?? null, $sql_create, "Local DB (conn_local)");

if (isset($conn_supa) && $conn_supa) pg_close($conn_supa);
if (isset($conn_local) && $conn_local) pg_close($conn_local);
?>