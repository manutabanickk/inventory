<?php

class Tecnico {

    private $model;

    public function __construct() {
        $this->model = new TecnicoModel(); // Crear una instancia del modelo
    }

    public function Listar_Tecnicos() {
        $filas = $this->model->Listar_Tecnicos();
        return $filas;
    }

    public function Insertar_Tecnico($Tecnico, $telefono) {
        $cmd = $this->model->Insertar_Tecnico($Tecnico, $telefono);
    }

    public function Editar_Tecnico($idTecnico, $Tecnico, $telefono, $estado) {
        $cmd = $this->model->Editar_Tecnico($idTecnico, $Tecnico, $telefono, $estado);
    }
}

?>
