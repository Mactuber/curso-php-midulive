<?php

// URL de la API
const API_URL = "https://whenisthenextmcufilm.com/api";

// Inicializar una nueva sesión de cURL
$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la petición y obtener el resultado
$result = curl_exec($ch);

// Verificar si ocurrió algún error durante la ejecución
if(curl_errno($ch)) {
    $error_msg = curl_error($ch);
    curl_close($ch);
    die("Error en la solicitud API: " . $error_msg);
}

$data = json_decode($result, true);
curl_close($ch);

// Verificar si la API devuelve datos válidos
if ($data === null) {
    die("Error: No se pudo obtener datos de la API o el formato no es válido.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>La próxima película de Marvel</title>
    <meta name="description" content="La próxima película de Marvel, la cual se estrena pronto." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Vinculamos el CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    />
    
    <!-- Agregamos un favicon -->
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/a/a9/Marvel_Logo.svg" type="image/svg+xml">
</head>

<body>
  <main class="container">
    <header>
      <h1>La próxima película de Marvel</h1>
      <p>¡Entérate de los próximos estrenos del Universo Cinematográfico de Marvel!</p>
    </header>

    <section class="movie-details">
      <div class="movie-poster">
        <img src="<?= htmlspecialchars($data['poster_url']); ?>" width="300" alt="Poster de <?= htmlspecialchars($data['title']); ?>" style="border-radius:16px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      </div>

      <div class="movie-info">
        <h2><?= htmlspecialchars($data['title']); ?></h2>
        <p><strong>Fecha de estreno:</strong> <?= htmlspecialchars($data['release_date']); ?></p>
        <p><strong>Faltan:</strong> <?= htmlspecialchars($data['days_until']); ?> días</p>
        <p><strong>La siguiente película es:</strong> <?= htmlspecialchars($data['following_production']['title']); ?></p>
      </div>
    </section>
  </main>

  <style>
    :root {
      color-scheme: light dark;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 900px;
      width: 100%;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    header h1 {
      text-align: center;
      font-size: 2.5em;
      margin-bottom: 10px;
      color: #333;
    }

    header p {
      text-align: center;
      font-size: 1.2em;
      color: #777;
    }

    .movie-details {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      margin-top: 20px;
    }

    .movie-info {
      margin-top: 20px;
    }

    .movie-info p {
      font-size: 1.1em;
      line-height: 1.5;
      color: #555;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      font-size: 0.9em;
      color: #777;
    }

    .movie-poster img {
      border-radius: 16px;
      transition: transform 0.3s ease;
    }

    .movie-poster img:hover {
      transform: scale(1.05);
    }

  </style>
</body>
</html>
