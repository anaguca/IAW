<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

require __DIR__ . "/../includes/helpers.php";

$errores = [];
$imc = null; $clasificacion = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peso = filtrar_numero($_POST['peso'] ?? null);
    $altura = filtrar_numero($_POST['altura'] ?? null); // en metros, ej. 1.70

    if ($peso === null || $peso <= 0)   $errores[] = "Introduce un peso válido en kg.";
    if ($altura === null || $altura <= 0) $errores[] = "Introduce una altura válida en metros (ej. 1.70).";

    if (!$errores) {
        $imc = $peso / ($altura ** 2);
        $clasificacion = clasificar_imc($imc);
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Calculadora IMC</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Calculadora IMC</h1>
  <form method="post" novalidate>
    <div>
      <label for="peso">Peso (kg)</label>
      <input type="number" step="0.01" id="peso" name="peso" value="<?= htmlspecialchars($_POST['peso'] ?? '') ?>" required>
    </div>
    <div>
      <label for="altura">Altura (m)</label>
      <input type="number" step="0.01" id="altura" name="altura" value="<?= htmlspecialchars($_POST['altura'] ?? '') ?>" required>
    </div>
    <button class="btn" type="submit">Calcular</button>
    <a class="btn" href="index.php">Volver</a>
  </form>

  <?php if ($errores): ?>
    <ul class="error">
      <?php foreach ($errores as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <?php if ($imc !== null): ?>
    <div class="result">
      <p><strong>IMC:</strong> <?= number_format($imc, 2, ',', '.') ?></p>
      <p><strong>Clasificación:</strong> <?= htmlspecialchars($clasificacion) ?></p>
      <p class="<?= $clasificacion === 'Normopeso' ? 'ok' : 'error' ?>">
        <?= $clasificacion === 'Normopeso' ? 'Dentro del rango recomendado.' : 'Fuera del rango recomendado.' ?>
      </p>
    </div>
  <?php endif; ?>
</body>
</html>
