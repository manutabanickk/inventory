<?php

require_once "../../logger.php"; // Importa el logger
require_once "../../config/app.conf.php"; // Configuración global

// Logger global para todos los eventos
$logger = AppLogger::getLogger(); // Usar canal principal 'app'

// Registro automático de clases
spl_autoload_register(function ($className) use ($logger) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
        $logger->info("Modelo cargado: $className");
    }

    if (file_exists($controller)) {
        require_once($controller);
        $logger->info("Controlador cargado: $className");
    } else {
        $logger->warning("Archivo no encontrado para la clase: $className");
    }
});

// Instancia de la clase Producto
try {
    $funcion = new Producto();
    $logger->info("Instancia de Producto creada con éxito.");
} catch (Throwable $e) {
    $logger->error('Error al instanciar la clase Producto: ' . $e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);
    die(json_encode(["status" => "error", "message" => "Error interno al cargar la clase Producto"]));
}

// Lógica principal
if (isset($_POST['nombre_producto']) && isset($_POST['precio_compra']) && isset($_POST['precio_venta'])) {
    try {
        // Capturar datos del formulario
        $proceso = $_POST['proceso'];
        $id = $_POST['id'] ?? null;
        $codigo_barra = trim($_POST['codigo_barra']);
        $nombre_producto = trim($_POST['nombre_producto']);
        $precio_compra = trim($_POST['precio_compra']);
        $precio_venta = trim($_POST['precio_venta']);
        $precio_venta_mayoreo = trim($_POST['precio_venta_mayoreo']);
        $precio_venta_3 = trim($_POST['precio_venta_3']);
        $stock = trim($_POST['stock']);
        $stock_min = trim($_POST['stock_min']);
        $idcategoria = trim($_POST['idcategoria']);
        $idmarca = trim($_POST['idmarca']);
        $idpresentacion = trim($_POST['idpresentacion']);
        $estado = trim($_POST['estado']);
        $exento = trim($_POST['exento']);
        $inventariable = trim($_POST['inventariable']);
        $perecedero = trim($_POST['perecedero']);

        if ($idmarca == '') {
            $idmarca = null;
        }

        // Registrar datos del proceso en los logs
        $logger->info("Procesando solicitud", [
            'proceso' => $proceso,
            'nombre_producto' => $nombre_producto,
            'precio_compra' => $precio_compra,
            'precio_venta' => $precio_venta,
        ]);

        switch ($proceso) {
            case 'Registro':
                $funcion->Insertar_Producto(
                    $codigo_barra,
                    $nombre_producto,
                    $precio_compra,
                    $precio_venta,
                    $precio_venta_mayoreo,
                    $precio_venta_3,
                    $stock,
                    $stock_min,
                    $idcategoria,
                    $idmarca,
                    $idpresentacion,
                    $exento,
                    $inventariable,
                    $perecedero
                );
                $logger->info("Producto registrado exitosamente", [
                    'nombre_producto' => $nombre_producto,
                    'precio_compra' => $precio_compra,
                    'precio_venta' => $precio_venta,
                ]);
                break;

            case 'Edicion':
                $funcion->Editar_Producto(
                    $id,
                    $codigo_barra,
                    $nombre_producto,
                    $precio_compra,
                    $precio_venta,
                    $precio_venta_mayoreo,
                    $precio_venta_3,
                    $stock_min,
                    $idcategoria,
                    $idmarca,
                    $idpresentacion,
                    $estado,
                    $exento,
                    $inventariable,
                    $perecedero
                );
                $logger->info("Producto editado exitosamente", [
                    'nombre_producto' => $nombre_producto,
                    'id_producto' => $id,
                ]);
                break;

            default:
                $logger->warning("Proceso desconocido: $proceso");
                echo json_encode("Error");
                break;
        }
    } catch (Throwable $e) {
        $logger->error('Error en el proceso de producto: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
        echo json_encode("Error");
    }
} else {
    $logger->warning("Datos insuficientes en la solicitud POST.");
    echo json_encode(["status" => "error", "message" => "Datos insuficientes"]);
}
