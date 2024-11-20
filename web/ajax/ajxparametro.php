<?php
// Iniciar sesión
session_start();

// Usar spl_autoload_register en lugar de __autoload
spl_autoload_register(function ($className) {
    $modelPath = "../../model/" . $className . "_model.php";
    $controllerPath = "../../controller/" . $className . "_controller.php";

    if (file_exists($modelPath)) {
        require_once($modelPath);
    }
    if (file_exists($controllerPath)) {
        require_once($controllerPath);
    }
});

$funcion = new Parametro();

// Manejar las solicitudes GET
if (!empty($_GET)) {
    $criterio = isset($_GET['criterio']) ? trim($_GET['criterio']) : '';

    try {
        if ($criterio === "moneda") {
            $result = $funcion->Ver_Moneda();
            echo json_encode($result);
        } elseif ($criterio === "iva") {
            $result = $funcion->Ver_Impuesto();
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Criterio no válido.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
    }
}

// Manejar las solicitudes POST
if (!empty($_POST)) {
    if (isset($_POST['nombre_empresa'])) {
        try {
            $proceso = isset($_POST['proceso']) ? trim($_POST['proceso']) : '';
            $id = isset($_POST['id']) ? trim($_POST['id']) : null;
            $nombre_empresa = isset($_POST['nombre_empresa']) ? trim($_POST['nombre_empresa']) : '';
            $propietario = isset($_POST['propietario']) ? trim($_POST['propietario']) : '';
            $numero_nit = isset($_POST['numero_nit']) ? str_replace("-", "", trim($_POST['numero_nit'])) : '';
            $numero_nrc = isset($_POST['numero_nrc']) ? trim($_POST['numero_nrc']) : '';
            $porcentaje_iva = isset($_POST['porcentaje_iva']) ? trim($_POST['porcentaje_iva']) : '';
            $porcentaje_retencion = isset($_POST['porcentaje_retencion']) ? trim($_POST['porcentaje_retencion']) : '';
            $monto_retencion = isset($_POST['monto_retencion']) ? trim($_POST['monto_retencion']) : '';
            $direccion_empresa = isset($_POST['direccion_empresa']) ? trim($_POST['direccion_empresa']) : '';
            $idcurrency = isset($_POST['idcurrency']) ? trim($_POST['idcurrency']) : '';

            switch ($proceso) {
                case 'Registro':
                    $funcion->Insertar_Parametro(
                        $nombre_empresa,
                        $propietario,
                        $numero_nit,
                        $numero_nrc,
                        $porcentaje_iva,
                        $porcentaje_retencion,
                        $monto_retencion,
                        $direccion_empresa,
                        $idcurrency
                    );
                    echo json_encode(['success' => 'Registro realizado con éxito.']);
                    break;

                case 'Edicion':
                    $funcion->Editar_Parametro(
                        $id,
                        $nombre_empresa,
                        $propietario,
                        $numero_nit,
                        $numero_nrc,
                        $porcentaje_iva,
                        $porcentaje_retencion,
                        $monto_retencion,
                        $direccion_empresa,
                        $idcurrency
                    );
                    echo json_encode(['success' => 'Edición realizada con éxito.']);
                    break;

                default:
                    echo json_encode(['error' => 'Proceso no válido.']);
                    break;
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
?>
