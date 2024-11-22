<?php 

require_once __DIR__ . '/../../logger.php'; // Importa el logger global

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
    // Instanciar la clase Producto
    $funcion = new Producto();
    $logger->info("Instancia de la clase Producto creada.");

    // Obtener el término de búsqueda
    $keyword = isset($_REQUEST['term']) ? trim($_REQUEST['term']) : '';

    if (empty($keyword)) {
        $logger->warning("El término de búsqueda está vacío.");
        die(json_encode(["error" => "El término de búsqueda no puede estar vacío."]));
    }

    $logger->info("Término de búsqueda recibido.", ['term' => $keyword]);

    // Llamar al método de autocompletado
    $funcion->Autocomplete_Producto($keyword);

} catch (Exception $e) {
    $logger->error("Error en autocomplete_producto.php: " . $e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);
    die(json_encode(["error" => "Error interno al procesar la solicitud."]));
}

?>
