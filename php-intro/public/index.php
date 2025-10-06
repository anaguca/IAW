<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

// 1) Tipos y variables
$nombre = "Ana";
$edad = 20;
$precio = 19.95;
$activo = true;

// 2) Arrays y bucles
$lenguajes = ["PHP", "JavaScript", "Python"];

// 3) Condicional
$mensaje = ($edad >= 18) ? "Mayor de edad" : "Menor de edad";

// 4) Función simple
function saludar(string $nombre): string {
    return "Hola, $nombre 👋";
}

// 5) Superglobales
$metodo = $_SERVER['REQUEST_METHOD'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Demo PHP</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1><?= saludar($nombre) ?></h1>
  <p><strong>Edad:</strong> <?= $edad ?> (<?= $mensaje ?>)</p>
  <p><strong>Precio:</strong> <?= number_format($precio, 2, ',', '.') ?> €</p>
  <p><strong>Lenguajes:</strong></p>
  <ul>
    <?php foreach ($lenguajes as $lang): ?>
      <li><?= htmlspecialchars($lang) ?></li>
    <?php endforeach; ?>
  </ul>
  <p><em>Método de la petición:</em> <?= htmlspecialchars($metodo) ?></p>

  <hr>
  <p><a class="btn" href="imc.php">➡️ Ir a Calculadora IMC (POST)</a></p>
</body>
</html>
