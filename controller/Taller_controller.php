<?php

class Taller {

    private $model;

    public function __construct() {
        $this->model = new TallerModel(); // Crear instancia del modelo
    }

    public function Ver_Moneda_Reporte() {
        $filas = $this->model->Ver_Moneda_Reporte();
        return $filas;
    }

    public function Ver_Max_Orden() {
        $filas = $this->model->Ver_Max_Orden();
        return $filas;
    }

    public function Listar_Ordenes($date, $date2) {
        $filas = $this->model->Listar_Ordenes($date, $date2);
        return $filas;
    }

    public function Reporte_Taller($id) {
        $filas = $this->model->Reporte_Taller($id);
        return $filas;
    }

    public function Listar_Tecnicos() {
        $filas = $this->model->Listar_Tecnicos();
        return $filas;
    }

    public function Count_Ordenes($date, $date2) {
        $filas = $this->model->Count_Ordenes($date, $date2);
        return $filas;
    }

    public function Insertar_Orden($idcliente, $aparato, $modelo, $idmarca, $serie, $idtecnico, $averia, $observaciones, $deposito_revision, $deposito_reparacion, $parcial_pagar) {
        $cmd = $this->model->Insertar_Orden($idcliente, $aparato, $modelo, $idmarca, $serie, $idtecnico, $averia, $observaciones, $deposito_revision, $deposito_reparacion, $parcial_pagar);
    }

    public function Insertar_Diagnostico($idorden, $diagnostico, $estado_aparato, $repuestos, $mano_obra, $fecha_alta, $fecha_retiro, $ubicacion, $parcial_pagar) {
        $cmd = $this->model->Insertar_Diagnostico($idorden, $diagnostico, $estado_aparato, $repuestos, $mano_obra, $fecha_alta, $fecha_retiro, $ubicacion, $parcial_pagar);
    }

    public function Editar_Orden($idorden, $numero_orden, $fecha_ingreso, $idcliente, $aparato, $modelo, $idmarca, $serie, $idtecnico, $averia, $observaciones, $deposito_revision, $deposito_reparacion) {
        $cmd = $this->model->Editar_Orden($idorden, $numero_orden, $fecha_ingreso, $idcliente, $aparato, $modelo, $idmarca, $serie, $idtecnico, $averia, $observaciones, $deposito_revision, $deposito_reparacion);
    }

    public function Borrar_Orden($idtaller) {
        $cmd = $this->model->Borrar_Orden($idtaller);
    }
}

?>
