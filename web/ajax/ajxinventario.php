<?php

// Usar spl_autoload_register en lugar de __autoload
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

// Crear una instancia de Inventario
$funcion = new Inventario();

if (isset($_POST['proceso'])) {
    try {
        $proceso = $_POST['proceso'];

        switch ($proceso) {
            case 'Validar':
                $funcion->Validar_Inventario();
                break;

            case 'Abrir':
                $funcion->Abrir_Inventario();
                break;

            case 'Cerrar':
                $funcion->Cerrar_Inventario();
                break;

            default:
                echo json_encode(["status" => "Error", "message" => "Proceso no válido"]);
                break;
        }
    } catch (Exception $e) {
        error_log("Error en ajxinventario.php: " . $e->getMessage());
        echo json_encode(["status" => "Error", "message" => "Ha ocurrido un error"]);
    }
} else {
    echo json_encode(["status" => "Error", "message" => "No se recibió el proceso"]);
}
?>
