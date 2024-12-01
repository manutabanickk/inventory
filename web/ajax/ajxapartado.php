<?php
session_start();
require_once("../../config/money_string.php");
require_once("../../logger.php"); // Importa el logger central

$logger = AppLogger::getLogger('ajxapartado');

spl_autoload_register(function ($className) {
    $model = __DIR__ . "/../../model/" . $className . "_model.php";
    $controller = __DIR__ . "/../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
    }

    if (file_exists($controller)) {
        require_once($controller);
    }
});

$funcion = new Apartado();
$caja_funcion = new Caja();

date_default_timezone_set("America/El_Salvador");

if (!empty($_POST)) {
    try {
        $logger->info("Inicio del procesamiento del apartado", ['POST' => $_POST]);

        // Extracción de datos del formulario
        $cuantos = $_POST['cuantos'] ?? 0;
        $stringdatos = $_POST['stringdatos'] ?? '';
        $listadatos = explode('#', $stringdatos);
        $fecha_retiro = trim($_POST['fecha_retiro'] ?? '');
        $idcliente = trim($_POST['idcliente'] ?? '');
        $sumas = floatval(trim($_POST['sumas'] ?? 0));
        $iva = floatval(trim($_POST['iva'] ?? 0));
        $exento = floatval(trim($_POST['exento'] ?? 0));
        $retenido = floatval(trim($_POST['retenido'] ?? 0));
        $descuento = floatval(trim($_POST['descuento'] ?? 0));
        $total = floatval(trim($_POST['total'] ?? 0));
        $abonado = floatval(trim($_POST['abonado'] ?? 0));
        $restante = floatval(trim($_POST['restante'] ?? 0));
        $son_letras = num2letras($total);

        $logger->info("Datos procesados desde POST", [
            'fecha_retiro' => $fecha_retiro,
            'idcliente' => $idcliente,
            'sumas' => $sumas,
            'total' => $total,
            'stringdatos' => $stringdatos
        ]);

        // Validación: Fecha de retiro
        if (!empty($fecha_retiro)) {
            $fecha_retiro_obj = DateTime::createFromFormat('d/m/Y H:i:s', $fecha_retiro);
            if (!$fecha_retiro_obj) {
                $logger->error("Formato de fecha no válido", ['fecha_retiro' => $fecha_retiro]);
                throw new Exception("La fecha de retiro no es válida. Use el formato 'DD/MM/YYYY HH:mm:ss'.");
            }
            $fecha_retiro = $fecha_retiro_obj->format('Y-m-d H:i:s');
        } else {
            $logger->error("Fecha de retiro vacía.");
            throw new Exception("La fecha de retiro no puede estar vacía.");
        }

        // Validación: Cliente
        if (empty($idcliente)) {
            $logger->error("Cliente no seleccionado.");
            throw new Exception("Debe seleccionar un cliente.");
        }

        // Validación: Total y restante
        if ($total <= 0) {
            $logger->error("El total debe ser mayor a 0.", ['total' => $total]);
            throw new Exception("El monto total debe ser mayor a 0.");
        }
        if ($abonado <= 0) {
            $logger->error("El monto abonado debe ser mayor a 0.", ['abonado' => $abonado]);
            throw new Exception("El monto abonado debe ser mayor a 0.");
        }
        
        // Permitir valores negativos para restante pero registrarlos en el logger
        $restante_calculado = $total - $abonado;
        
        if ($restante_calculado < 0) {
            $logger->warning("El monto restante es negativo. Ajustando automáticamente.", [
                'abonado' => $abonado,
                'total' => $total,
                'restante_calculado' => $restante_calculado
            ]);
            // Continuar con el restante negativo
        }
        
        $logger->info("Cálculo del restante exitoso.", ['restante' => $restante_calculado]);
        $restante = $restante_calculado; // Usar el restante calculado
        

        // Inserción del apartado
        $logger->info("Insertando apartado", [
            'fecha_retiro' => $fecha_retiro,
            'idcliente' => $idcliente,
            'total' => $total
        ]);

        $funcion->Insertar_Apartado(
            $fecha_retiro,
            $sumas,
            $iva,
            $exento,
            $retenido,
            $descuento,
            $total,
            $abonado,
            $restante,
            $son_letras,
            $idcliente,
            $_SESSION['user_id']
        );

        // Inserción de detalles del apartado
        foreach ($listadatos as $dato) {
            if (empty($dato)) {
                continue;
            }

            list($idproducto, $cantidad, $precio_unitario, $exentos, $descuento, $fecha_vence, $importe) = explode('|', $dato);

            // Validar valores vacíos y asignar predeterminados
            $idproducto = trim($idproducto);
            $cantidad = floatval($cantidad);
            $precio_unitario = floatval($precio_unitario);
            $exentos = floatval($exentos);
            $descuento = floatval($descuento);
            $importe = floatval($importe);

            if (empty($fecha_vence)) {
                $logger->warning("Campo fecha_vence vacío. Se asignará un valor predeterminado.", [
                    'idproducto' => $idproducto
                ]);
                $fecha_vence = '2000-01-01';
            } else {
                $fecha_vence_obj = DateTime::createFromFormat('d/m/Y', $fecha_vence);
                if (!$fecha_vence_obj) {
                    $logger->error("Formato de fecha de vencimiento no válido.", [
                        'fecha_vence' => $fecha_vence,
                        'idproducto' => $idproducto
                    ]);
                    throw new Exception("Formato de fecha de vencimiento no válido para el producto: $idproducto.");
                }
                $fecha_vence = $fecha_vence_obj->format('Y-m-d');
            }

            // Validación: Cantidad e importe
            if ($cantidad <= 0) {
                $logger->error("Cantidad no válida para producto.", [
                    'idproducto' => $idproducto,
                    'cantidad' => $cantidad
                ]);
                throw new Exception("La cantidad para el producto $idproducto debe ser mayor a 0.");
            }
            if ($importe <= 0) {
                $logger->error("Importe no válido para producto.", [
                    'idproducto' => $idproducto,
                    'importe' => $importe
                ]);
                throw new Exception("El importe para el producto $idproducto debe ser mayor a 0.");
            }

            // Registro en el logger antes de la inserción
            $logger->info("Insertando detalle del apartado", [
                'idproducto' => $idproducto,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario,
                'importe' => $importe
            ]);

            // Inserción del detalle
            $funcion->Insertar_DetalleApartado(
                $idproducto,
                $cantidad,
                $precio_unitario,
                $exentos,
                $descuento,
                $fecha_vence,
                $importe
            );
        }

        // Finalización exitosa
        $logger->info("Apartado registrado correctamente.");
        echo json_encode(["status" => "success", "message" => "Apartado registrado correctamente"]);
    } catch (Exception $e) {
        // Manejo de errores
        $logger->error("Error al procesar el apartado", [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
