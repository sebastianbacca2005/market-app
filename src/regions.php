<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Región</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
    h2 { color: #333; }
    form { background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); width: 300px; }
    input, button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; font-size: 14px; }
    button { background-color: #4CAF50; color: white; border: none; cursor: pointer; }
    button:hover { background-color: #45a049; }
  </style>
</head>
<body>
  <h2>Registrar Región</h2>
  <form action="regions_request.php" method="POST">
    <input type="text" name="region_name" placeholder="Nombre de la región" required>
    <input type="text" name="region_abbrev" placeholder="Abreviatura (opcional)">
    <input type="text" name="region_code" placeholder="Código (opcional)">
    <button type="submit">Guardar</button>
  </form>
</body>
</html>
