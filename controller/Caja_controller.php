<?php

class Caja {

    public function Validar_Caja() {
        $modelo = new CajaModel();
        $cmd = $modelo->Validar_Caja();
        return $cmd;
    }

    public function Listar_Datos() {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Datos();
        return $filas;
    }

    public function Listar_Datos_Fecha($fecha, $idcaja) {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Datos_Fecha($fecha, $idcaja);
        return $filas;
    }

    public function Listar_Historico($date, $date2) {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Historico($date, $date2);
        return $filas;
    }

    public function Cerrar_Caja_Manual($id) {
        $modelo = new CajaModel();
        $filas = $modelo->Cerrar_Caja_Manual($id);
        return $filas;
    }

    public function Listar_Movimientos() {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Movimientos();
        return $filas;
    }

    public function Listar_Movimientos_Fecha($fecha, $idcaja) {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Movimientos_Fecha($fecha, $idcaja);
        return $filas;
    }

    public function Listar_Movimientos_Detalle_Fecha($fecha, $idcaja) {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Movimientos_Detalle_Fecha($fecha, $idcaja);
        return $filas;
    }

    public function Get_Movimientos() {
        $modelo = new CajaModel();
        $filas = $modelo->Get_Movimientos();
        return $filas;
    }

    public function Listar_Ingresos() {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Ingresos();
        return $filas;
    }

    public function Listar_Devoluciones() {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Devoluciones();
        return $filas;
    }

    public function Listar_Prestamos() {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Prestamos();
        return $filas;
    }

    public function Listar_Gastos() {
        $modelo = new CajaModel();
        $filas = $modelo->Listar_Gastos();
        return $filas;
    }

    public function Insertar_Movimiento($tipo_movimiento, $monto, $descripcion) {
        $modelo = new CajaModel();
        $cmd = $modelo->Insertar_Movimiento($tipo_movimiento, $monto, $descripcion);
        return $cmd;
    }

    public function Abrir_Caja($monto) {
        $modelo = new CajaModel();
        $cmd = $modelo->Abrir_Caja($monto);
        return $cmd;
    }

    public function Update_Caja($monto) {
        $modelo = new CajaModel();
        $cmd = $modelo->Update_Caja($monto);
        return $cmd;
    }

    public function Cerrar_Caja($monto) {
        $modelo = new CajaModel();
        $cmd = $modelo->Cerrar_Caja($monto);
        return $cmd;
    }

    public function Insertar_Caja_Venta($monto) {
        $modelo = new CajaModel();
        $cmd = $modelo->Insertar_Caja_Venta($monto);
        return $cmd;
    }
}

?>
