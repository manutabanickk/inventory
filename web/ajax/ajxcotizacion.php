<?php
session_start();
require_once("../../config/money_string.php");
require_once("../../logger.php"); // Importa el logger global

// Instancia del logger global
$logger = AppLogger::getLogger();

// Función para cargar archivos y registrar eventos relacionados
function cargarArchivo($ruta, $tipo, $logger) {
    if (file_exists($ruta)) {
        require_once($ruta);
        $logger->info("{$tipo} cargado.", ['ruta' => $ruta]);
    } else {
        $logger->error("El archivo del {$tipo} no existe.", ['ruta' => $ruta]);
        die(json_encode(["error" => "El archivo del {$tipo} no existe."]));
    }
}

// Autoload para cargar modelos y controladores
spl_autoload_register(function ($className) use ($logger) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    cargarArchivo($model, "modelo", $logger);
    cargarArchivo($controller, "controlador", $logger);
});

try {
    $funcion = new Cotizacion();
    $logger->info("Instancia de la clase Cotizacion creada correctamente.");
} catch (Exception $e) {
    $logger->error("Error al instanciar la clase Cotizacion.", [
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);
    die(json_encode(["error" => "Error interno al inicializar el sistema."]));
}

if (!empty($_POST)) {
    try {
        $proceso = $_POST['proceso'] ?? null;
        $logger->info("Solicitud POST recibida.", ['proceso' => $proceso]);

        switch ($proceso) {
            case 'Generar':
                $cuantos = $_POST['cuantos'] ?? null;
                $stringdatos = $_POST['stringdatos'] ?? '';
                $listadatos = explode('#', $stringdatos);
                $a_nombre = trim($_POST['a_nombre'] ?? '');
                $pagado = trim($_POST['pagado'] ?? '');
                $tipo_entrega = trim($_POST['tipo_entrega'] ?? '');
                $idcliente = trim($_POST['idcliente'] ?? '');
                $sumas = trim($_POST['sumas'] ?? '');
                $iva = trim($_POST['iva'] ?? '');
                $exento = trim($_POST['exento'] ?? '');
                $retenido = trim($_POST['retenido'] ?? '');
                $descuento = trim($_POST['descuento'] ?? '');
                $total = trim($_POST['total'] ?? 0);
                $sonletras = num2letras($total);

                $entrega = ($tipo_entrega == '1') ? 'INMEDIATA' : 'POR PEDIDO';
                $pago_tipo = ($pagado == '1') ? 'AL CONTADO' : 'AL CREDITO';

                $logger->info("Generando cotización.", [
                    'datos_generales' => [
                        'a_nombre' => $a_nombre,
                        'tipo_pago' => $pago_tipo,
                        'entrega' => $entrega,
                        'total' => $total,
                    ],
                    'usuario' => $_SESSION['user_id'] ?? 'desconocido',
                ]);

                $funcion->Insertar_Cotizacion(
                    $a_nombre,
                    $pago_tipo,
                    $entrega,
                    $sumas,
                    $iva,
                    $exento,
                    $retenido,
                    $descuento,
                    $total,
                    $sonletras,
                    $_SESSION['user_id'] ?? 0,
                    $idcliente
                );

                foreach ($listadatos as $dato) {
                    list($idproducto, $cantidad, $precio_unitario, $exentos, $descuento, $disponible, $importe) = explode('|', $dato);
                    $disponible = (strtoupper($disponible) == 'SI') ? 1 : 0;

                    $logger->info("Agregando detalle a la cotización.", [
                        'detalle' => [
                            'idproducto' => $idproducto,
                            'cantidad' => $cantidad,
                            'importe' => $importe,
                        ],
                    ]);

                    $funcion->Insertar_DetalleCotizacion($idproducto, $cantidad, $disponible, $precio_unitario, $exentos, $descuento, $importe);
                }

                echo json_encode(["status" => "success", "message" => "Cotización generada exitosamente."]);
                break;

            case 'Borrar':
                $numero_transaccion = trim($_POST['numero_transaccion'] ?? '');
                $logger->info("Borrando cotización.", ['numero_transaccion' => $numero_transaccion]);

                $funcion->Borrar_Cotizacion($numero_transaccion);

                echo json_encode(["status" => "success", "message" => "Cotización eliminada correctamente."]);
                break;

            default:
                $logger->warning("Proceso no reconocido.", ['proceso' => $proceso]);
                echo json_encode(["error" => "Proceso no reconocido."]);
                break;
        }
    } catch (Exception $e) {
        $logger->error("Error en la solicitud POST.", [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
        echo json_encode(["error" => "Error al procesar la solicitud."]);
    }
}
?>
