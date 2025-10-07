<?php
declare(strict_types=1);
// TODO: Esta es la PLANTILLA para el alumnado.
// Objetivo: implementar un formulario POST con validación básica y resumen.
// PISTAS dentro del código. ¡Completa los TODO!

// (1) Inicializa variables útiles
$errores = [];
$nombre = $_POST['nombre'] ?? '';
$grupo = $_POST['grupo'] ?? '';
// Checkboxes vienen como array: lenguajes[]
$lenguajes = $_POST['lenguajes'] ?? []; // puede ser array o no existir
$comentario = $_POST['comentario'] ?? '';

// (2) Si el método es POST, valida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: Validar $nombre (no vacío, por ejemplo min 2 caracteres)
    // TODO: Validar $grupo (debe ser 'A', 'B' o 'C')

    // Sugerencia:
    // if (trim($nombre) === '' || mb_strlen(trim($nombre)) < 2) { $errores[] = "El nombre es obligatorio (mín. 2 caracteres)."; }
    // $gruposValidos = ['A','B','C'];
    // if (!in_array($grupo, $gruposValidos, true)) { $errores[] = "Selecciona un grupo válido."; }

    // TODO: (Opcional) Limitar comentario a 280 chars
    // if (mb_strlen($comentario) > 280) { $errores[] = "El comentario no puede superar 280 caracteres."; }
}

// (3) Función de escape segura
function e(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Encuesta de clase</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Estilos específicos de esta vista */
    .card { padding:1rem; border:1px solid #ddd; border-radius:12px; margin-top:1rem; }
    .chips { display:flex; gap:.5rem; flex-wrap:wrap; }
    .chip { border:1px solid #bbb; padding:.25rem .5rem; border-radius:999px; }
    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
    .muted { color:#666; }
  </style>
</head>
<body>
  <h1>Encuesta de clase</h1>

  <?php if ($errores): ?>
    <ul class="error">
      <?php foreach ($errores as $e): ?>
        <li><?= e($e) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form method="post" class="card" novalidate>
    <div class="grid-2">
      <div>
        <label for="nombre">Nombre <span class="muted">(obligatorio)</span></label>
        <input type="text" id="nombre" name="nombre" value="<?= e($nombre) ?>" required>
      </div>
      <div>
        <label for="grupo">Grupo <span class="muted">(A/B/C)</span></label>
        <select id="grupo" name="grupo" required>
          <option value="">-- Selecciona --</option>
          <option value="A" <?= $grupo==='A'?'selected':'' ?>>A</option>
          <option value="B" <?= $grupo==='B'?'selected':'' ?>>B</option>
          <option value="C" <?= $grupo==='C'?'selected':'' ?>>C</option>
        </select>
      </div>
    </div>

    <div>
      <label>Lenguajes favoritos <span class="muted">(marca los que quieras)</span></label>
      <?php
      $opts = ['PHP','JavaScript','Python'];
      foreach ($opts as $opt):
        $checked = in_array($opt, (array)$lenguajes, true) ? 'checked' : '';
      ?>
        <label class="chip">
          <input type="checkbox" name="lenguajes[]" value="<?= e($opt) ?>" <?= $checked ?>> <?= e($opt) ?>
        </label>
      <?php endforeach; ?>
    </div>

    <div>
      <label for="comentario">Comentario <span class="muted">(opcional)</span></label>
      <textarea id="comentario" name="comentario" rows="4" maxlength="280"><?= e($comentario) ?></textarea>
      <div class="muted">Máximo 280 caracteres</div>
    </div>

    <button class="btn" type="submit">Enviar</button>
    <a class="btn" href="index.php">Volver</a>
  </form>

  <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$errores): ?>
    <!-- (4) Resumen visual -->
    <div class="card">
      <h2>Resumen</h2>
      <p><strong>Nombre:</strong> <?= e($nombre) ?></p>
      <p><strong>Grupo:</strong> <?= e($grupo) ?></p>
      <p><strong>Lenguajes seleccionados:</strong>
        <?php if (!empty($lenguajes)): ?>
          <span class="chips">
            <?php foreach ((array)$lenguajes as $l): ?>
              <span class="chip"><?= e($l) ?></span>
            <?php endforeach; ?>
          </span>
        <?php else: ?>
          Ninguno
        <?php endif; ?>
      </p>
      <?php
      // (5) Conteo simple de lenguajes seleccionados (en esta respuesta)
      $conteo = [
        'PHP' => in_array('PHP', (array)$lenguajes, true) ? 1 : 0,
        'JavaScript' => in_array('JavaScript', (array)$lenguajes, true) ? 1 : 0,
        'Python' => in_array('Python', (array)$lenguajes, true) ? 1 : 0,
      ];
      ?>
      <h3>Conteo</h3>
      <ul>
        <li>PHP: <?= $conteo['PHP'] ?></li>
        <li>JavaScript: <?= $conteo['JavaScript'] ?></li>
        <li>Python: <?= $conteo['Python'] ?></li>
      </ul>

      <?php if (trim($comentario) !== ''): ?>
        <p><strong>Comentario:</strong> <?= e($comentario) ?></p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</body>
</html>
