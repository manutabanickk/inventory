<?php

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
	$objProveedor =  new Proveedor();
  $filas = $objProveedor->Listar_Proveedores();
  echo json_encode($filas);
 ?>