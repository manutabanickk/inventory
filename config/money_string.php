<?php
// Incluir logger.php para manejar los logs
require_once __DIR__ . '/../logger.php';
$logger = AppLogger::getLogger();

/**
 * Convierte un número a su representación en letras.
 *
 * @param float|string $num Número a convertir.
 * @param bool $fem Determina si es en género femenino.
 * @param bool $dec Determina si se incluyen decimales.
 * @return string Representación en letras del número.
 */
function num2letras($num, $fem = false, $dec = true) {
    global $logger;

    try {
        $logger->info("Inicio de la conversión de número a letras", [
            'numero' => $num,
            'femenino' => $fem,
            'decimales' => $dec
        ]);

        $matuni = [
            2 => "dos", 3 => "tres", 4 => "cuatro", 5 => "cinco",
            6 => "seis", 7 => "siete", 8 => "ocho", 9 => "nueve",
            10 => "diez", 11 => "once", 12 => "doce", 13 => "trece",
            14 => "catorce", 15 => "quince", 16 => "dieciséis",
            17 => "diecisiete", 18 => "dieciocho", 19 => "diecinueve",
            20 => "veinte"
        ];

        $matunisub = [
            2 => "dos", 3 => "tres", 4 => "cuatro", 5 => "quin",
            6 => "seis", 7 => "sete", 8 => "ocho", 9 => "nove"
        ];

        $matdec = [
            2 => "veint", 3 => "treinta", 4 => "cuarenta",
            5 => "cincuenta", 6 => "sesenta", 7 => "setenta",
            8 => "ochenta", 9 => "noventa"
        ];

        $matsub = [
            3 => "mill", 5 => "bill", 7 => "mill", 9 => "trill",
            11 => "mill", 13 => "bill", 15 => "mill"
        ];

        $matmil = [
            4 => "millones", 6 => "billones", 7 => "de billones",
            8 => "millones de billones", 10 => "trillones",
            11 => "de trillones", 12 => "millones de trillones",
            13 => "de trillones", 14 => "billones de trillones",
            15 => "de billones de trillones",
            16 => "millones de billones de trillones"
        ];

        // Separar parte entera y decimal
        $float = explode('.', $num);
        $num = $float[0];
        $decimalPart = isset($float[1]) ? $float[1] : '00';

        // Validar el formato del número
        if (!is_numeric($num)) {
            $logger->warning("Número no válido para conversión", ['numero' => $num]);
            return "Error: Número inválido";
        }

        $num = trim((string)@$num);

        if ($num[0] == '-') {
            $neg = 'menos ';
            $num = substr($num, 1);
        } else {
            $neg = '';
        }

        while ($num[0] == '0') {
            $num = substr($num, 1);
        }

        if ($num === '') {
            $logger->warning("Número vacío después de eliminar ceros iniciales", ['numero' => $num]);
            return "Cero";
        }

        $zeros = true;
        $punt = false;
        $ent = '';
        $fra = '';

        for ($c = 0; $c < strlen($num); $c++) {
            $n = $num[$c];
            if (strpos(".,'", $n) !== false) {
                if ($punt) break;
                $punt = true;
                continue;
            } elseif (!is_numeric($n)) {
                $logger->error("Carácter no numérico encontrado", ['caracter' => $n]);
                return "Error en número";
            }

            if ($punt) {
                if ($n != '0') $zeros = false;
                $fra .= $n;
            } else {
                $ent .= $n;
            }
        }

        $ent = '     ' . $ent;

        if ($dec && $fra && !$zeros) {
            $fin = ' coma';
            for ($n = 0; $n < strlen($fra); $n++) {
                $s = $fra[$n];
                if ($s == '0') $fin .= ' cero';
                elseif ($s == '1') $fin .= $fem ? ' una' : ' un';
                else $fin .= ' ' . $matuni[$s];
            }
        } else {
            $fin = '';
        }

        if ((int)$ent === 0) return 'Cero ' . $fin;

        $tex = '';
        $sub = 0;
        $mils = 0;
        $neutro = false;

        while (($num = substr($ent, -3)) != '   ') {
            $ent = substr($ent, 0, -3);
            $sub++;
            $matuni[1] = $sub < 3 && $fem ? 'una' : ($neutro ? 'un' : 'uno');
            $subcent = $sub < 3 && $fem ? 'as' : 'os';

            $t = '';
            $n2 = substr($num, 1);
            if ($n2 == '00') {
                $t = '';
            } elseif ($n2 < 21) {
                $t = ' ' . $matuni[(int)$n2];
            } elseif ($n2 < 30) {
                $n3 = $num[2];
                if ($n3 != 0) $t = 'i' . $matuni[$n3];
                $n2 = $num[1];
                $t = ' ' . $matdec[$n2] . $t;
            } else {
                $n3 = $num[2];
                if ($n3 != 0) $t = ' y ' . $matuni[$n3];
                $n2 = $num[1];
                $t = ' ' . $matdec[$n2] . $t;
            }

            $n = $num[0];
            if ($n == 1) {
                $t = ' ciento' . $t;
            } elseif ($n == 5) {
                $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
            } elseif ($n != 0) {
                $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
            }

            if ($sub == 1) {
                // Nada
            } elseif (!isset($matsub[$sub])) {
                if ($num == 1) {
                    $t = ' mil';
                } elseif ($num > 1) {
                    $t .= ' mil';
                }
            } elseif ($num == 1) {
                $t .= ' ' . $matsub[$sub] . '?n';
            } elseif ($num > 1) {
                $t .= ' ' . $matsub[$sub] . 'ones';
            }

            if ($num == '000') {
                $mils++;
            } elseif ($mils != 0) {
                if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
                $mils = 0;
            }

            $neutro = true;
            $tex = $t . $tex;
        }

        $tex = $neg . substr($tex, 1) . $fin;
        $end_num = ucfirst($tex) . ' ' . $decimalPart . '/100';
        $logger->info("Conversión completada exitosamente", ['resultado' => $end_num]);

        return $end_num;

    } catch (Exception $e) {
        $logger->error("Error durante la conversión", ['error' => $e->getMessage()]);
        return "Error";
    }
}
?>
