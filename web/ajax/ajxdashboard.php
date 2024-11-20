<?php 

function autoloadClasses($className){
    $model = "../model/". $className ."_model.php";
    $controller = "../controller/". $className ."_controller.php";

    require_once($model);
    require_once($controller);
}

spl_autoload_register('autoloadClasses');
	$funcion = new Dashboard();

	  $true = isset($_GET['true']) ? $_GET['true'] : '';
		if(!$true==""){
			$funcion->Compras_Anuales();
		}

?>