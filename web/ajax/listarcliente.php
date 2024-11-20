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

	$objCliente =  new Cliente();
  $filas = $objCliente->Listar_Clientes();
  echo json_encode($filas);
 ?>
