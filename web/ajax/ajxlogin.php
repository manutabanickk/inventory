<?php

require_once "../../logger.php"; // Importa el logger
require_once "../../config/app.conf.php"; // Configuración general

// Logger principal para registrar eventos
$authLogger = AppLogger::getLogger('auth');
$errorLogger = AppLogger::getLogger('errors');

// Configuración de errores
ini_set('display_errors', 0); // Ocultar errores en pantalla
ini_set('display_startup_errors', 0); // Ocultar errores de inicio
error_reporting(E_ALL); // Registrar todos los errores

// Registrar la carga de clases automáticamente
spl_autoload_register(function ($className) use ($authLogger, $errorLogger) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
        $authLogger->info("Modelo cargado: $className");
    }
    if (file_exists($controller)) {
        require_once($controller);
        $authLogger->info("Controlador cargado: $className");
    } else {
        $errorLogger->warning("Archivo no encontrado para la clase: $className");
    }
});

// Instancia de la clase Login
try {
    $funcion = new Login();
} catch (Throwable $e) {
    // Registrar errores al instanciar la clase
    $errorLogger->error('Error al instanciar la clase Login: ' . $e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ]);
    die(); // Detener ejecución si no se puede instanciar la clase
}

// Manejo de logout
if (isset($_GET['logout']) && $_GET['logout'] === "true") {
    try {
        // Destruir las sesiones
        unset($_SESSION['user_name'], $_SESSION['user_tipo'], $_SESSION['user_empleado']);

        if (session_destroy()) {
            $authLogger->info("Usuario deslogueado correctamente.");
            echo "<script>window.location.href = '../../?View=Login'</script>";
        }
    } catch (Throwable $e) {
        // Registrar errores durante el logout
        $errorLogger->error('Error durante el logout: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);
    }
}

// Manejo de login
if (isset($_POST['usuario'], $_POST['password'], $_POST['proceso'])) {
    try {
        $proceso = trim($_POST['proceso']);
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);

        switch ($proceso) {
            case 'login':
                // Registrar intento de login
                $authLogger->info("Intento de login", ['usuario' => $usuario]);

                // Llama al método de login
                $funcion->Login_Usuario($usuario, base64_decode($password));

                // Registrar login exitoso
                $authLogger->info("Usuario autenticado correctamente.", ['usuario' => $usuario]);
                break;

            default:
                $errorLogger->warning("Proceso desconocido: $proceso");
                break;
        }
    } catch (Exception $e) {
        // Registrar errores durante el login
        $errorLogger->error('Error durante el proceso de login: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);

        // Responder con un JSON genérico
        $data = ["status" => "error", "message" => "Error interno"];
        echo json_encode($data);
    }
}

