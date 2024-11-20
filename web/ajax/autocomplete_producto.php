<?php
// Registro de una función de autoload para cargar automáticamente clases requeridas
spl_autoload_register(function ($className) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
    } else {
        die("Error: El archivo del modelo $model no existe.");
    }

    if (file_exists($controller)) {
        require_once($controller);
    } else {
        die("Error: El archivo del controlador $controller no existe.");
    }
});

// Verificar que se haya recibido el término de búsqueda
if (isset($_REQUEST['term']) && !empty(trim($_REQUEST['term']))) {
    $keyword = trim($_REQUEST['term']); // Eliminar espacios en blanco adicionales

    try {
        // Crear una instancia de la clase Producto
        $funcion = new Producto();

        // Llamar al método Autocomplete_Producto y obtener los resultados
        $resultados = $funcion->Autocomplete_Producto($keyword);

        // Verificar si se obtuvieron resultados
        if (!empty($resultados)) {
            echo json_encode($resultados); // Devolver resultados en formato JSON
        } else {
            echo json_encode(["message" => "No se encontraron coincidencias."]);
        }
    } catch (Exception $e) {
        // Manejar cualquier error durante la ejecución
        echo json_encode(["error" => "Se produjo un error: " . $e->getMessage()]);
    }
} else {
    // Si no se recibió el término de búsqueda
    echo json_encode(["error" => "No se proporcionó un término de búsqueda válido."]);
}
?>
