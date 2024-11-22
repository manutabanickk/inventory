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

 $funcion = new Cotizacion();

 $keyword = trim($_REQUEST['term']);


 $funcion->Autocomplete_Producto($keyword);


?>
