<?php 

// Autoload function to dynamically include model and controller
function __autoload($className) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    // Log inclusion attempt
    error_log("[INFO] Attempting to load: $model and $controller", 3, "../../logs/application.log");

    require_once($model);
    require_once($controller);
}

// Log script initialization
error_log("[INFO] Script initialized for moneda operations", 3, "../../logs/application.log");

$funcion = new Moneda();

if (isset($_POST['CurrencyISO']) && isset($_POST['CurrencyName']) && isset($_POST['Symbol'])) {
    try {
        // Retrieve form data
        $proceso = $_POST['proceso'];
        $id = $_POST['id'];

        $CurrencyISO = trim($_POST['CurrencyISO']);
        $Language = trim($_POST['Language']);
        $CurrencyName = trim($_POST['CurrencyName']);
        $Money = trim($_POST['Money']);
        $Symbol = trim($_POST['Symbol']);

        // Log received data
        error_log("[INFO] Data received - Proceso: $proceso, ID: $id, CurrencyISO: $CurrencyISO, Language: $Language, CurrencyName: $CurrencyName, Money: $Money, Symbol: $Symbol", 3, "../../logs/application.log");

        // Switch case to determine process type
        switch ($proceso) {
            case 'Registro':
                $funcion->Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
                error_log("[SUCCESS] Registro realizado con éxito: $CurrencyISO", 3, "../../logs/application.log");
                break;

            case 'Edicion':
                $funcion->Editar_Moneda($id, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
                error_log("[SUCCESS] Edición realizada con éxito - ID: $id, CurrencyISO: $CurrencyISO", 3, "../../logs/application.log");
                break;

            default:
                $data = "Error";
                error_log("[ERROR] Proceso no reconocido: $proceso", 3, "../../logs/application.log");
                echo json_encode($data);
                break;
        }
    } catch (Exception $e) {
        // Log exception details
        error_log("[ERROR] Exception occurred: " . $e->getMessage(), 3, "../../logs/application.log");

        $data = "Error";
        echo json_encode($data);
    }
} else {
    // Log missing parameters
    error_log("[ERROR] Missing required POST parameters", 3, "../../logs/application.log");
}

?>
