<?php
	session_start();
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

	$funcion = new CreditoProveedor();

	$credito = isset($_GET['credito']) ? $_GET['credito'] : '';
	if(!$credito==""){
		$funcion->Monto_Maximo_Proveedor($credito);
	}

	if (!empty($_POST))
	{
		try
		{

		$opcion = $_POST['opcion'];

		if($opcion == 'ABONO'){
			$proceso = $_POST['proceso'];
			if($proceso!='Eliminar'){
				$id = $_POST['id'];
				$fecha_abono = $_POST['fecha_abono'];
				$monto_abono = $_POST['monto_abono'];
				$idcreditoproveedor = $_POST['idcreditoproveedor'];
			} else {
				$id = $_POST['id'];
			}


			switch($proceso){

				case 'Registro':
					$funcion->Insertar_Abono_Proveedor($idcreditoproveedor,$monto_abono,$_SESSION['user_id']);
				break;

				case 'Edicion':
					$funcion->Editar_Abono_Proveedor($id,$fecha_abono,$monto_abono);
				break;

				case 'Eliminar':
					$funcion->Borrar_Abono_Proveedor($id);
				break;

				default:
					$data = "Error";
	 	   		 	echo json_encode($data);
				break;

			}

		} else if ($opcion == 'CREDITO'){

				$id = $_POST['id'];
				$nombre_credito = $_POST['nombre_credito'];
				$fecha_credito= $_POST['fecha_credito'];
				$monto_credito= $_POST['monto_credito'];
				$monto_abonado= $_POST['monto_abonado'];
				$monto_restante= $_POST['monto_restante'];
				$estado = $_POST['estado'];

				if($fecha_credito!='')
				{
					$fecha_credito = DateTime::createFromFormat('d/m/Y H:i:s', $fecha_credito)->format('Y-m-d H:i:s');
				}

				$funcion->Editar_Credito_Proveedor($id,$nombre_credito,$fecha_credito,$monto_credito,$monto_abonado,$monto_restante,$estado);

		}

		} catch (Exception $e) {
			$data = "Error";
 	   	echo json_encode($data);
		}
	}


?>
