<?php
require(__DIR__ . '/../database.php');

$sql_create = "
CREATE TABLE IF NOT EXISTS countries (
    id SERIAL PRIMARY KEY,
    country_name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

if ($conn_supa) {
    $result_supa = pg_query($conn_supa, $sql_create);
    if ($result_supa) {
        echo "<p style='color:green;'>✅ Tabla 'countries' creada o verificada en Supabase correctamente.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error creando tabla en Supabase: " . pg_last_error($conn_supa) . "</p>";
    }
} else {
    echo "<p style='color:red;'>⚠️ No hay conexión con Supabase.</p>";
}

if ($conn_local) {
    $result_local = pg_query($conn_local, $sql_create);
    if ($result_local) {
        echo "<p style='color:blue;'>✅ Tabla 'countries' creada o verificada en la base local correctamente.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error creando tabla en la base local: " . pg_last_error($conn_local) . "</p>";
    }
} else {
    echo "<p style='color:red;'>⚠️ No hay conexión con la base local.</p>";
}

pg_close($conn_supa);
pg_close($conn_local);
?>
