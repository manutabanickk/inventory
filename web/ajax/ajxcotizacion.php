<?php
session_start();
require_once("../../config/money_string.php");

// Autoload para cargar clases dinámicamente
spl_autoload_register(function ($className) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
    }
    if (file_exists($controller)) {
        require_once($controller);
    }
});

// Instancia de la clase Cotización
$funcion = new Cotizacion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Verificar si el parámetro 'proceso' existe en la solicitud
        if (!isset($_POST['proceso'])) {
            throw new Exception("Parámetro 'proceso' no definido.");
        }

        $proceso = trim($_POST['proceso']);

        switch ($proceso) {
            case 'Generar':
                // Validar y obtener datos de la solicitud
                $cuantos = isset($_POST['cuantos']) ? (int)$_POST['cuantos'] : 0;
                $stringdatos = isset($_POST['stringdatos']) ? trim($_POST['stringdatos']) : '';
                $listadatos = explode('#', $stringdatos);
                $a_nombre = isset($_POST['a_nombre']) ? trim($_POST['a_nombre']) : '';
                $pagado = isset($_POST['pagado']) ? trim($_POST['pagado']) : '';
                $tipo_entrega = isset($_POST['tipo_entrega']) ? trim($_POST['tipo_entrega']) : '';
                $idcliente = isset($_POST['idcliente']) ? trim($_POST['idcliente']) : 0;
                $sumas = isset($_POST['sumas']) ? trim($_POST['sumas']) : 0;
                $iva = isset($_POST['iva']) ? trim($_POST['iva']) : 0;
                $exento = isset($_POST['exento']) ? trim($_POST['exento']) : 0;
                $retenido = isset($_POST['retenido']) ? trim($_POST['retenido']) : 0;
                $descuento = isset($_POST['descuento']) ? trim($_POST['descuento']) : 0;
                $total = isset($_POST['total']) ? trim($_POST['total']) : 0;
                $sonletras = num2letras($total);

                // Definir tipo de entrega
                $entrega = $tipo_entrega == '1' ? 'INMEDIATA' : 'POR PEDIDO';

                // Insertar la cotización principal
                $tipo_pago = $pagado == '1' ? 'AL CONTADO' : 'AL CREDITO';
                $funcion->Insertar_Cotizacion(
                    $a_nombre,
                    $tipo_pago,
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

                // Insertar los detalles de la cotización
                foreach ($listadatos as $dato) {
                    if (empty($dato)) continue;

                    list($idproducto, $cantidad, $precio_unitario, $exentos, $descuento, $disponible, $importe) = explode('|', $dato);

                    $disponible = strtolower($disponible) === 'si' ? 1 : 0;

                    $funcion->Insertar_DetalleCotizacion(
                        $idproducto,
                        $cantidad,
                        $disponible,
                        $precio_unitario,
                        $exentos,
                        $descuento,
                        $importe
                    );
                }
                echo json_encode(['status' => 'success', 'message' => 'Cotización generada exitosamente.']);
                break;

            case 'Borrar':
                // Validar y borrar cotización
                $numero_transaccion = isset($_POST['numero_transaccion']) ? trim($_POST['numero_transaccion']) : null;
                if (!$numero_transaccion) {
                    throw new Exception("Número de transacción no proporcionado.");
                }
                $funcion->Borrar_Cotizacion($numero_transaccion);
                echo json_encode(['status' => 'success', 'message' => 'Cotización eliminada correctamente.']);
                break;

            default:
                throw new Exception("Acción no reconocida: $proceso");
        }
    } catch (Exception $e) {
        // Manejo de errores
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>
