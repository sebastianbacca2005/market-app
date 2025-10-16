<?php
require(__DIR__ . '/../database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $country_name   = trim($_POST['country_name']);
    $country_abbrev = trim($_POST['country_abbrev']);
    $country_code   = trim($_POST['country_code']);

    if (!empty($country_name) && !empty($country_abbrev) && !empty($country_code)) {

        // Inserta y evita duplicados por nombre
        $sql_insert = "
            INSERT INTO countries (country_name, country_abbrev, country_code)
            VALUES ($1, $2, $3)
            ON CONFLICT ON CONSTRAINT countries_country_name_key DO NOTHING
        ";
        // ↑ Usa directamente el nombre exacto de la restricción, no del campo.

        $params = array($country_name, $country_abbrev, $country_code);

        $ok_local = $ok_supa = false;
        $msg_local = $msg_supa = '';

        if ($conn_local) {
            $ok_local = pg_query_params($conn_local, $sql_insert, $params);
            $msg_local = $ok_local ? "✅ Local OK" : "⚠️ Local duplicado o error";
        }

        if ($conn_supa) {
            $ok_supa = pg_query_params($conn_supa, $sql_insert, $params);
            $msg_supa = $ok_supa ? "✅ Supabase OK" : "⚠️ Supabase duplicado o error";
        }

        echo "Resultado:<br>$msg_local<br>$msg_supa";
    } else {
        echo "❌ Todos los campos son obligatorios.";
    }
}

pg_close($conn_supa);
pg_close($conn_local);
?>

