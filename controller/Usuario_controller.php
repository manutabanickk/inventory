<?php 

class Usuario {

    private $model;

    public function __construct() {
        $this->model = new UsuarioModel(); // Crear una instancia del modelo
    }

    public function Listar_Usuarios() {
        $filas = $this->model->Listar_Usuarios();
        return $filas;
    }

    public function Listar_Empleados() {
        $filas = $this->model->Listar_Empleados();
        return $filas;
    }

    public function Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado) {
        $cmd = $this->model->Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado);
    }

    public function Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado) {
        $cmd = $this->model->Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado);
    }
}

?>
