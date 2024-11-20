<?php 

class Empleado {

    private $model;

    public function __construct() {
        $this->model = new EmpleadoModel(); // Crear una instancia del modelo
    }

    public function Listar_Empleados() {
        $filas = $this->model->Listar_Empleados();
        return $filas;
    }

    public function Insertar_Empleado($nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado) {
        $cmd = $this->model->Insertar_Empleado($nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado);
    }

    public function Editar_Empleado($idempleado, $nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado, $estado) {
        $cmd = $this->model->Editar_Empleado($idempleado, $nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado, $estado);
    }
}

?>
