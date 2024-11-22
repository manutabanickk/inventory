<?php 

require_once __DIR__ . '/../model/Login_model.php'; // Asegúrate de incluir el modelo necesario
require_once __DIR__ . '/../logger.php'; // Importa el logger central

class Login {

    private $logger;

    public function __construct() {
        // Inicializa el logger para la clase Login
        $this->logger = AppLogger::getLogger('auth');
    }

    /**
     * Restaura la contraseña de un usuario.
     *
     * @param string $usuario Nombre de usuario.
     * @param string $contrasena Nueva contraseña.
     * @return bool Indica si la operación fue exitosa.
     */
    public function Restaurar_Password($usuario, $contrasena) {
        try {
            $loginModel = new LoginModel();
            $resultado = $loginModel->Restaurar_Password($usuario, $contrasena);

            $this->logger->info("Contraseña restaurada para el usuario: $usuario");

            return $resultado;
        } catch (Throwable $e) {
            // Registrar cualquier error en el log
            $this->logger->error('Error al restaurar la contraseña: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false; // Retorna false en caso de error
        }
    }

    /**
     * Inicia sesión para un usuario.
     *
     * @param string $usuario Nombre de usuario.
     * @param string $contrasena Contraseña del usuario.
     * @return bool Indica si el inicio de sesión fue exitoso.
     */
    public function Login_Usuario($usuario, $contrasena) {
        try {
            $loginModel = new LoginModel();
            $resultado = $loginModel->Login_Usuario($usuario, $contrasena);

            if ($resultado) {
                // Registrar el éxito del login
                $this->logger->info("Usuario autenticado correctamente: $usuario");
            } else {
                // Registrar el fallo del login
                $this->logger->warning("Fallo de autenticación para el usuario: $usuario");
            }

            return $resultado;
        } catch (Throwable $e) {
            // Registrar cualquier error en el log
            $this->logger->error('Error durante el inicio de sesión: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false; // Retorna false en caso de error
        }
    }
}
?>
