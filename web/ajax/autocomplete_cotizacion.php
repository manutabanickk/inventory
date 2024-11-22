<?php

require_once __DIR__ . '/../../logger.php'; // Logger global

// Instancia del logger global
$logger = AppLogger::getLogger();

// Autocarga de clases
spl_autoload_register(function ($className) use ($logger) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
        $logger->info("Modelo cargado: $className");
    } else {
        $logger->error("No se encontró el archivo del modelo para la clase $className en $model.");
        die(json_encode(["error" => "No se encontró el archivo del modelo para la clase $className."]));
    }

    if (file_exists($controller)) {
        require_once($controller);
        $logger->info("Controlador cargado: $className");
    } else {
        $logger->error("No se encontró el archivo del controlador para la clase $className en $controller.");
        die(json_encode(["error" => "No se encontró el archivo del controlador para la clase $className."]));
    }
});

try {
    // Instanciar la clase de cotización
    $funcion = new Cotizacion();
    $logger->info("Instancia de la clase Cotización creada.");

    // Obtener el término de búsqueda del cliente
    $keyword = isset($_REQUEST['term']) ? trim($_REQUEST['term']) : "";

    if (empty($keyword)) {
        $logger->warning("El término de búsqueda está vacío.");
        die(json_encode(["error" => "El término de búsqueda está vacío."]));
    }

    $logger->info("Iniciando búsqueda de productos.", ["term" => $keyword]);

    // Obtener productos que coincidan con el término
    $productos = $funcion->Autocomplete_Producto($keyword);

    if (is_array($productos) && !empty($productos)) {
        // Formatear resultados para jQuery UI Autocomplete
        $resultados = [];
        foreach ($productos as $producto) {
            $resultados[] = [
                "id" => $producto['idproducto'],
                "label" => $producto['nombre_producto'],
                "value" => $producto['idproducto'],
                "producto" => $producto['nombre_producto'],
                "precio" => $producto['precio'],
                "stock" => $producto['stock'],
                "descripcion" => $producto['descripcion'],
            ];
        }

        $logger->info("Productos encontrados.", ["count" => count($resultados), "term" => $keyword]);

        // Retornar resultados como JSON
        echo json_encode($resultados);
    } else {
        $logger->warning("No se encontraron productos que coincidan con el término.", ["term" => $keyword]);
        echo json_encode(["error" => "No se encontraron productos que coincidan con el término."]);
    }
} catch (Exception $e) {
    // Manejar errores de ejecución
    $logger->error("Ocurrió un error al procesar la solicitud: " . $e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);
    die(json_encode(["error" => "Ocurrió un error al procesar la solicitud: " . $e->getMessage()]));
}
