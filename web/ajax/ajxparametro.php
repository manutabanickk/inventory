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
    $funcion = new Parametro();
    $logger->info("Instancia de la clase Parametro creada.");
} catch (Exception $e) {
    $logger->error("Error al instanciar la clase Parametro: " . $e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);
    die(json_encode(["error" => "Error interno al inicializar el sistema."]));
}

// Manejo de solicitudes GET
if (!empty($_GET)) {
    $criterio = isset($_GET['criterio']) ? $_GET['criterio'] : '';
    $logger->info("Solicitud GET recibida.", ['criterio' => $criterio]);

    try {
        if ($criterio == "moneda") {
            $logger->info("Verificando moneda.");
            $funcion->Ver_Moneda();

        } else if ($criterio == "iva") {
            $logger->info("Verificando IVA.");
            $funcion->Ver_Impuesto();

        } else {
            $logger->warning("Criterio no reconocido.", ['criterio' => $criterio]);
            echo json_encode(["error" => "Criterio no reconocido."]);
        }
    } catch (Exception $e) {
        $logger->error("Error en la solicitud GET: " . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
        echo json_encode(["error" => "Error al procesar la solicitud GET."]);
    }
}

// Manejo de solicitudes POST
if (!empty($_POST)) {
    if (isset($_POST['nombre_empresa'])) {
        try {
            $logger->info("Solicitud POST recibida.", ['data' => $_POST]);

            $proceso = $_POST['proceso'];
            $id = $_POST['id'];
            $nombre_empresa = trim($_POST['nombre_empresa']);
            $propietario = trim($_POST['propietario']);
            $numero_nit = str_replace("-", "", trim($_POST['numero_nit']));
            $numero_nrc = trim($_POST['numero_nrc']);
            $porcentaje_iva = trim($_POST['porcentaje_iva']);
            $porcentaje_retencion = trim($_POST['porcentaje_retencion']);
            $monto_retencion = trim($_POST['monto_retencion']);
            $direccion_empresa = trim($_POST['direccion_empresa']);
            $idcurrency = trim($_POST['idcurrency']);

            switch ($proceso) {
                case 'Registro':
                    $logger->info("Iniciando registro de parámetro.", ['nombre_empresa' => $nombre_empresa]);
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
                    echo json_encode(["status" => "success", "message" => "Parámetro registrado correctamente."]);
                    break;

                case 'Edicion':
                    $logger->info("Iniciando edición de parámetro.", ['id' => $id]);
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
                    echo json_encode(["status" => "success", "message" => "Parámetro editado correctamente."]);
                    break;

                default:
                    $logger->warning("Proceso no reconocido.", ['proceso' => $proceso]);
                    echo json_encode(["error" => "Proceso no reconocido."]);
                    break;
            }
        } catch (Exception $e) {
            $logger->error("Error en la solicitud POST: " . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            echo json_encode(["error" => "Error al procesar la solicitud POST."]);
        }
    } else {
        $logger->warning("Solicitud POST no válida: Falta el parámetro 'nombre_empresa'.");
        echo json_encode(["error" => "Solicitud no válida."]);
    }
}

?>
