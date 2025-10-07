# Actividad: Encuesta rápida de clase (PHP + POST)

**Objetivo:** Practicar formularios HTML, manejo de `$_POST`, validación básica y representación visual de resultados en PHP.

## Requisitos
- Crear un formulario con los campos:
  - **Nombre** (texto, obligatorio)
  - **Grupo** (select: A, B, C — obligatorio)
  - **Lenguajes favoritos** (checkboxes: PHP, JavaScript, Python — opcional, se pueden marcar varios)
  - **Comentario** (textarea — opcional, máx. 280 chars)
- Método de envío: **POST** (misma página).
- Validar: nombre y grupo (mostrar mensajes de error si faltan).
- Al enviar correctamente: mostrar un **resumen visual** con los datos.
- Extra (recomendado): contar cuántos lenguajes se han seleccionado y pintar un mini **resumen de conteo**.

## Entrega
- Archivo: `encuesta.php` funcional con HTML + PHP.
- Debe incluir:
  1. **Validación** y mensajes de error.
  2. **Escape de salida** con `htmlspecialchars(...)`.
  3. **Resumen** de la información enviada y conteo de lenguajes.

## Rúbrica (5 puntos)
- (2 pt) Validación correcta de nombre y grupo, con mensajes.
- (1 pt) Uso de `htmlspecialchars` en la salida.
- (1 pt) Conteo de lenguajes y representación clara.
- (1 pt) Presentación visual limpia (usa `styles.css`).

## Pistas
- Comprueba el método: `$_SERVER['REQUEST_METHOD'] === 'POST'`
- Accede a los campos: `$_POST['nombre']`, `$_POST['grupo']`, `$_POST['lenguajes']` (array), `$_POST['comentario']`
- `isset($_POST['lenguajes']) ? $_POST['lenguajes'] : []` para recoger checkboxes.
- Escapa SIEMPRE lo que imprimas: `htmlspecialchars($valor, ENT_QUOTES, 'UTF-8')`
- `count($array)` te da el número de elementos.
