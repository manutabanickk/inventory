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

	$funcion = new Marca();

	if(isset($_POST['marca'])){
		
		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$marca = trim($_POST['marca']);
			$estado = trim($_POST['estado']);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Marca($marca);
			break;

			case 'Edicion':
				$funcion->Editar_Marca($id,$marca,$estado);
			break;

			default:
				$data = "Error";
 	   		 	echo json_encode($data);
			break;
		}
			
		} catch (Exception $e) {
			
			$data = "Error";
 	   		echo json_encode($data);
		}

	}
	
	

  	

?>
