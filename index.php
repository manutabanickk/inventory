<?php
// session_start();
require_once("config/app.conf.php");
date_default_timezone_set('America/Lima');

// Usar spl_autoload_register en lugar de __autoload
spl_autoload_register(function ($className) {
    $model = "model/" . $className . "_model.php";
    $controller = "controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
    }

    if (file_exists($controller)) {
        require_once($controller);
    }
});

$Login = new Login();

// Si NO EXISTE SESIÓN LO MANDO A LOGIN
if (!isset($_SESSION['user_id'])) {
    $view = DEFAULT_VIEW;
} elseif (!empty($_GET["View"]) && isset($_SESSION['user_id'])) {
    // Si existe vista, pone la que viene en GET - ?view=Algo
    $view = $_GET["View"];
    $usuario = $_SESSION['user_name'];
    $tipo_usuario = $_SESSION['user_tipo'];
    $nombre_empleado = $_SESSION['user_empleado'];
} else if (empty($_GET["View"]) && isset($_SESSION['user_id'])) {
    // Poner por defecto Home
    $view = "Inicio";
    $usuario = $_SESSION['user_name'];
    $tipo_usuario = $_SESSION['user_tipo'];
    $nombre_empleado = $_SESSION['user_empleado'];
}

if (empty($conf[$view])) {
    // Si es vacía, poner error no existe (configurar en el app.conf.php como error_404)
    $view = "error_404";
}

if (empty($conf[$view]["layout"])) {
    // Si no tiene layout, agregar el por defecto
    $conf[$view]["layout"] = DEFAULT_LAYOUT;
}

$pathLayout = PATH_LAYOUT . "/" . $conf[$view]["layout"]; // Cargar el layout
$pathView = PATH_VIEW . "/" . $conf[$view]["file"]; // Buscar la vista almacenada en conf

require_once($pathLayout); // Agregar el layout encontrado
