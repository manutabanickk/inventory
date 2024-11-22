<?php
session_start();
require_once("../../config/money_string.php");
require_once("../../logger.php"); // Importa el logger global

// Instancia del logger global
$logger = AppLogger::getLogger();

// Autoload para cargar modelos y controladores
spl_autoload_register(function ($className) use ($logger) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
        $logger->info("Modelo cargado: $className");
    } else {
        $logger->error("El archivo del modelo no existe.", ['file' => $model]);
        die(json_encode(["error" => "El archivo del modelo no existe."]));
    }

    if (file_exists($controller)) {
        require_once($controller);
        $logger->info("Controlador cargado: $className");
    } else {
        $logger->error("El archivo del controlador no existe.", ['file' => $controller]);
        die(json_encode(["error" => "El archivo del controlador no existe."]));
    }
});

try {
    $funcion = new Cotizacion();
    $logger->info("Instancia de la clase Cotizacion creada.");
} catch (Exception $e) {
    $logger->error("Error al instanciar la clase Cotizacion: " . $e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);
    die(json_encode(["error" => "Error interno al inicializar el sistema."]));
}

if (!empty($_POST)) {
    try {
        $proceso = $_POST['proceso'];
        $logger->info("Solicitud POST recibida.", ['proceso' => $proceso]);

        switch ($proceso) {
            case 'Generar':
                $cuantos = $_POST['cuantos'];
                $stringdatos = $_POST['stringdatos'];
                $listadatos = explode('#', $stringdatos);
                $a_nombre = trim($_POST['a_nombre']);
                $pagado = trim($_POST['pagado']);
                $tipo_entrega = trim($_POST['tipo_entrega']);
                $idcliente = trim($_POST['idcliente']);
                $sumas = trim($_POST['sumas']);
                $iva = trim($_POST['iva']);
                $exento = trim($_POST['exento']);
                $retenido = trim($_POST['retenido']);
                $descuento = trim($_POST['descuento']);
                $total = trim($_POST['total']);
                $sonletras = num2letras($total);

                $entrega = ($tipo_entrega == '1') ? 'INMEDIATA' : 'POR PEDIDO';
                $pago_tipo = ($pagado == '1') ? 'AL CONTADO' : 'AL CREDITO';

                $logger->info("Generando cotización.", [
                    'a_nombre' => $a_nombre,
                    'tipo_pago' => $pago_tipo,
                    'entrega' => $entrega,
                    'total' => $total
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
                    $_SESSION['user_id'],
                    $idcliente
                );

                foreach ($listadatos as $dato) {
                    list($idproducto, $cantidad, $precio_unitario, $exentos, $descuento, $disponible, $importe) = explode('|', $dato);
                    $disponible = (strtoupper($disponible) == 'SI') ? 1 : 0;

                    $logger->info("Agregando detalle a la cotización.", [
                        'idproducto' => $idproducto,
                        'cantidad' => $cantidad,
                        'importe' => $importe
                    ]);

                    $funcion->Insertar_DetalleCotizacion($idproducto, $cantidad, $disponible, $precio_unitario, $exentos, $descuento, $importe);
                }

                echo json_encode(["status" => "success", "message" => "Cotización generada exitosamente."]);
                break;

            case 'Borrar':
                $numero_transaccion = trim($_POST['numero_transaccion']);
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
        $logger->error("Error en la solicitud POST: " . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
        echo json_encode(["error" => "Error al procesar la solicitud."]);
    }
}
?>
