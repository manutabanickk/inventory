<?php 

class Tiraje {

    private $model;

    public function __construct() {
        $this->model = new TirajeModel(); // Crear una instancia del modelo
    }

    public function Listar_Tirajes() {
        $filas = $this->model->Listar_Tirajes();
        return $filas;
    }

    public function Listar_Comprobantes() {
        $filas = $this->model->Listar_Comprobantes();
        return $filas;
    }

    public function Insertar_Tiraje($fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante) {
        $cmd = $this->model->Insertar_Tiraje($fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante);
    }

    public function Editar_Tiraje($idtiraje, $fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante) {
        $cmd = $this->model->Editar_Tiraje($idtiraje, $fecha_resolucion, $numero_resolucion, $serie, $desde, $hasta, $disponibles, $idcomprobante);
    }
}

?>
