<?php 

    // Reemplaza __autoload con spl_autoload_register
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

    // Instancia de la clase Login
    $funcion = new Login();

    // Con este código hago logout
    if (isset($_GET['logout']) && $_GET['logout'] == "true") {
        // Destruyo las sesiones
        unset($_SESSION['user_name']);
        unset($_SESSION['user_tipo']);
        unset($_SESSION['user_empleado']);

        if (session_destroy()) {
            echo "<script>window.location.href = '../../?View=Login'</script>";
        }
    }

    // Con este código hago login
    if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['proceso'])) {
        try {
            $proceso = trim($_POST['proceso']);
            $usuario = trim($_POST['usuario']);
            $password = trim($_POST['password']);

            switch ($proceso) {
                case 'login':
                    // Llama al método de instancia
                    $funcion->Login_Usuario($usuario, base64_decode($password));
                    break;
            }
        } catch (Exception $e) {
            $data = "Fake";
            echo json_encode($data);
        }
    }

?>
