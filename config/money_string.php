<?php
/**
 * Convierte un número en su representación textual en español.
 *
 * @param float|string $num Número a convertir.
 * @param bool $fem Indica si se usa género femenino.
 * @param bool $dec Incluye los decimales en la salida.
 * @return string Representación en letras del número.
 */
function num2letras($num, $fem = false, $dec = true)
{
    // Matrices para convertir números
    $matuni = [
        "", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve", 
        "diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", 
        "dieciocho", "diecinueve", "veinte"
    ];
    $matdec = [
        "", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", 
        "setenta", "ochenta", "noventa"
    ];
    $matsub = [
        1 => "", 2 => "mil", 3 => "millón", 4 => "mil", 5 => "billón"
    ];

    // Separar la parte entera y decimal
    $num = (string) $num;
    if (!is_numeric($num)) {
        return "Número inválido";
    }

    $negativo = strpos($num, '-') === 0 ? "menos " : "";
    $num = ltrim($num, '-');

    $partes = explode('.', $num);
    $entero = (int) $partes[0];
    $decimal = isset($partes[1]) ? str_pad(substr($partes[1], 0, 2), 2, '0') : "00";

    // Manejar la parte entera
    if ($entero === 0) {
        $texto = "cero";
    } else {
        $texto = "";
        $grupos = str_split(strrev((string)$entero), 3); // Dividir en bloques de 3 cifras
        foreach ($grupos as $i => $grupo) {
            $grupo = strrev($grupo); // Revertir para procesar
            $tres = (int) $grupo;

            if ($tres === 0) {
                continue;
            }

            $cientos = (int) ($tres / 100);
            $diezYUnidad = $tres % 100;
            $unidad = $tres % 10;

            // Procesar centenas
            if ($cientos > 0) {
                if ($cientos === 1 && $diezYUnidad === 0) {
                    $texto = "cien " . $texto;
                } else {
                    $texto = ($cientos === 1 ? "ciento" : $matuni[$cientos] . "cientos") . " " . $texto;
                }
            }

            // Procesar decenas y unidades
            if ($diezYUnidad > 0) {
                if ($diezYUnidad <= 20) {
                    $texto = $matuni[$diezYUnidad] . " " . $texto;
                } else {
                    $texto = $matdec[(int)($diezYUnidad / 10)] . 
                        ($unidad > 0 ? " y " . $matuni[$unidad] : "") . " " . $texto;
                }
            }

            // Procesar miles, millones, etc.
            if ($i > 0) {
                $texto = $texto . " " . ($tres > 1 ? $matsub[$i + 1] . "es" : $matsub[$i + 1]) . " ";
            }
        }
    }

    // Procesar decimales
    if ($dec && $decimal !== "00") {
        $texto .= "con $decimal/100";
    }

    // Retornar el texto final
    return ucfirst(trim($negativo . $texto));
}
?>
