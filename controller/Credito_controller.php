<?php

class Credito {

    private $model;

    public function __construct() {
        $this->model = new CreditoModel(); // Crear instancia del modelo
    }

    public function Imprimir_Ticket_Abono($idabono) {
        $filas = $this->model->Imprimir_Ticket_Abono($idabono);
        return $filas;
    }

    public function Reporte_Abonos($fecha, $fecha2) {
        $filas = $this->model->Reporte_Abonos($fecha, $fecha2);
        return $filas;
    }

    public function Listar_Creditos($idcredito) {
        $filas = $this->model->Listar_Creditos($idcredito);
        return $filas;
    }

    public function Listar_Creditos_Espc($idcredito) {
        $filas = $this->model->Listar_Creditos_Espc($idcredito);
        return $filas;
    }

    public function Listar_Abonos_Credito($idcredito) {
        $filas = $this->model->Listar_Abonos_Credito($idcredito);
        return $filas;
    }

    public function Listar_Abonos_All() {
        $filas = $this->model->Listar_Abonos_All();
        return $filas;
    }

    public function Count_Creditos() {
        $filas = $this->model->Count_Creditos();
        return $filas;
    }

    public function Listar_Detalle($idVenta) {
        $filas = $this->model->Listar_Detalle($idVenta);
        return $filas;
    }

    public function Listar_Info($idVenta) {
        $filas = $this->model->Listar_Info($idVenta);
        return $filas;
    }

    public function Ver_Restante($idcredito) {
        $filas = $this->model->Ver_Restante($idcredito);
        return $filas;
    }

    public function Borrar_Abono($idabono) {
        $cmd = $this->model->Borrar_Abono($idabono);
    }

    public function Editar_Credito($id, $nombre, $fecha, $monto, $abonado, $restante, $estado) {
        $cmd = $this->model->Editar_Credito($id, $nombre, $fecha, $monto, $abonado, $restante, $estado);
    }

    public function Insertar_Abono($idcredito, $monto, $idusuario) {
        $cmd = $this->model->Insertar_Abono($idcredito, $monto, $idusuario);
    }

    public function Editar_Abono($idabono, $fecha_abono, $monto_abono) {
        $cmd = $this->model->Editar_Abono($idabono, $fecha_abono, $monto_abono);
    }

    public function Monto_Maximo($idcredito) {
        $filas = $this->model->Monto_Maximo($idcredito);
        return $filas;
    }
}

?>
