<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Formatter\LineFormatter;

class AppLogger {
    private static $logger;

    /**
     * Inicializa y obtiene el logger principal
     *
     * @param int $level Nivel mínimo de logging (default: Logger::DEBUG)
     * @return Logger
     */
    public static function getLogger($level = Logger::DEBUG) {
        if (!self::$logger) {
            $logger = new Logger('app');

            // Directorio de logs
            $logDir = __DIR__ . '/logs/';
            if (!is_dir($logDir)) {
                mkdir($logDir, 0777, true);
            }

            // Archivo único de log
            $logFile = $logDir . 'application.log';

            // Configurar el handler con formato personalizado
            $handler = new StreamHandler($logFile, $level);
            $dateFormat = "Y-m-d H:i:s"; // Formato de fecha y hora
            $output = "[%datetime%] %level_name%: %message% %context%\n";
            $formatter = new LineFormatter($output, $dateFormat, true, true);
            $handler->setFormatter($formatter);

            $logger->pushHandler($handler);

            // Agregar procesadores para más contexto
            if (PHP_SAPI !== 'cli') {
                $logger->pushProcessor(new WebProcessor()); // Información de la solicitud HTTP
            }
            $logger->pushProcessor(new IntrospectionProcessor($level)); // Información de trazas

            self::$logger = $logger;
        }

        return self::$logger;
    }

    /**
     * Configura los manejadores de errores y excepciones globales
     */
    public static function setupGlobalHandlers($silent = true) {
        $logger = self::getLogger();

        // Manejar excepciones no controladas
        set_exception_handler(function ($exception) use ($logger, $silent) {
            $logger->critical('Excepción no controlada: ' . $exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);

            if (!$silent) {
                echo "Ha ocurrido un error crítico. Por favor, contacta al soporte.";
            }
        });

        // Manejar errores de PHP
        set_error_handler(function ($severity, $message, $file, $line) use ($logger) {
            $logger->warning('Error de PHP: ' . $message, [
                'severity' => $severity,
                'file' => $file,
                'line' => $line,
            ]);
        });

        // Manejar errores fatales (shutdown)
        register_shutdown_function(function () use ($logger) {
            $error = error_get_last();
            if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) {
                $logger->critical('Error fatal: ' . $error['message'], [
                    'file' => $error['file'],
                    'line' => $error['line'],
                ]);
            }
        });
    }
}

// Configurar manejadores globales
AppLogger::setupGlobalHandlers();

// Ejemplo de uso
$logger = AppLogger::getLogger();

