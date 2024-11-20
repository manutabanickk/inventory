<?php

// Autocarga de clases
spl_autoload_register(function ($className) {
    // Rutas relativas a los archivos de modelo y controlador
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    // Validar y cargar el archivo del modelo
    if (file_exists($model)) {
        require_once($model);
    } else {
        die("Error: No se encontró el archivo del modelo para la clase $className en $model.");
    }

    // Validar y cargar el archivo del controlador
    if (file_exists($controller)) {
        require_once($controller);
    } else {
        die("Error: No se encontró el archivo del controlador para la clase $className en $controller.");
    }
});

// Instanciar la clase Venta
$funcion = new Venta();

// Obtener término de búsqueda desde la solicitud
$keyword = isset($_REQUEST['term']) ? trim($_REQUEST['term']) : '';

// Verificar si se proporcionó un término de búsqueda
if (!empty($keyword)) {
    // Llamar al método Autocomplete_Producto para obtener los resultados
    $funcion->Autocomplete_Producto($keyword);
} else {
    // Retornar un error si no se proporciona un término
    echo json_encode(["error" => "No se proporcionó un término de búsqueda."]);
}

?>
