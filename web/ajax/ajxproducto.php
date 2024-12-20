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

	$funcion = new Producto();

	if(isset($_POST['nombre_producto']) && isset($_POST['precio_compra']) && isset($_POST['precio_venta'])){

		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$codigo_barra = trim($_POST['codigo_barra']);
			$nombre_producto = trim($_POST['nombre_producto']);
			$precio_compra = trim($_POST['precio_compra']);
			$precio_venta = trim($_POST['precio_venta']);
			$precio_venta_mayoreo = trim($_POST['precio_venta_mayoreo']);
			$precio_venta_3 = trim($_POST['precio_venta_3']);
			$stock = trim($_POST['stock']);
			$stock_min = trim($_POST['stock_min']);
			$idcategoria = trim($_POST['idcategoria']);
			$idmarca = trim($_POST['idmarca']);
			$idpresentacion = trim($_POST['idpresentacion']);
			$estado = trim($_POST['estado']);
			$exento = trim($_POST['exento']);
			$inventariable = trim($_POST['inventariable']);
			$perecedero = trim($_POST['perecedero']);

			if($idmarca == '')
			{
				$idmarca = NULL;
			}


			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Producto($codigo_barra,$nombre_producto,$precio_compra,$precio_venta,
				$precio_venta_mayoreo,$precio_venta_3,$stock,$stock_min,
				$idcategoria,$idmarca,$idpresentacion,$exento,$inventariable,$perecedero);
			break;

			case 'Edicion':
				$funcion->Editar_Producto($id,$codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
				$precio_venta_3,$stock_min, $idcategoria, $idmarca, $idpresentacion, $estado, $exento, $inventariable, $perecedero);
			break;

			default:
				$data = "Error";
 	   		 	echo json_encode($data);
			break;
		}

		} catch (Exception $e) {
			$log = fopen("ajax_log.log",'w');
			fwrite($log, $e::getMessage());
			fclose($log);
			$data = "Error";
 	   		echo json_encode($data);
		}

	}





?>
