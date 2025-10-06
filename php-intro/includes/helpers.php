<?php
declare(strict_types=1);
function filtrar_numero(?string $valor): ?float {
    if ($valor === null) return null;
    $v = str_replace(',', '.', trim($valor));
    return is_numeric($v) ? (float)$v : null;
}
function clasificar_imc(float $imc): string {
    return match (true) {
        $imc < 18.5 => "Bajo peso",
        $imc < 25   => "Normopeso",
        $imc < 30   => "Sobrepeso",
        default     => "Obesidad",
    };
}
