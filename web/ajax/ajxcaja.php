<?php 

// Uso de spl_autoload_register en lugar de __autoload
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

$funcion = new Caja();

// Manejo de movimientos a través de GET
$iva = isset($_GET['movimientos']) ? $_GET['movimientos'] : '';
if (!empty($iva)) {
    $funcion->Get_Movimientos();
}

// Manejo de procesos a través de POST
if (isset($_POST['proceso'])) {
    try {
        $proceso = $_POST['proceso'];

        if ($proceso !== 'Validar' && $proceso !== 'Cerrar-M') {
            $monto = trim($_POST['monto'] ?? '');
            $cantidad = trim($_POST['cantidad'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
        } elseif ($proceso === 'Cerrar-M') {
            $id = trim($_POST['id'] ?? '');
        }

        switch ($proceso) {
            case 'Validar':
                $funcion->Validar_Caja();
                break;

            case 'Abrir':
                $funcion->Abrir_Caja($cantidad);
                break;

            case 'Update':
                $funcion->Update_Caja($cantidad);
                break;

            case 'Cerrar':
                $funcion->Cerrar_Caja($cantidad);
                break;

            case 'Cerrar-M':
                $funcion->Cerrar_Caja_Manual($id);
                break;

            case 'Devolucion':
                $funcion->Insertar_Movimiento(2, $monto, $descripcion);
                break;

            case 'Prestamo':
                $funcion->Insertar_Movimiento(3, $monto, $descripcion);
                break;

            case 'Gasto':
                $funcion->Insertar_Movimiento(4, $monto, $descripcion);
                break;

            default:
                $data = "Error";
                echo json_encode($data);
                break;
        }
    } catch (Exception $e) {
        $data = "Error";
        echo json_encode($data);
    }
}

?>
