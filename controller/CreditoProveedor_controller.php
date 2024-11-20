<?php

class CreditoProveedor {

    public function Imprimir_Ticket_Abono_Proveedor($idabono) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Imprimir_Ticket_Abono_Proveedor($idabono);
        return $filas;
    }

    public function Reporte_Abonos_Proveedor($fecha, $fecha2) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Reporte_Abonos_Proveedor($fecha, $fecha2);
        return $filas;
    }

    public function Listar_Creditos_Proveedor($idcredito) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Listar_Creditos_Proveedor($idcredito);
        return $filas;
    }

    public function Listar_Creditos_Espc_Proveedor($idcredito) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Listar_Creditos_Espc_Proveedor($idcredito);
        return $filas;
    }

    public function Listar_Abonos_Credito_Proveedor($idcredito) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Listar_Abonos_Credito_Proveedor($idcredito);
        return $filas;
    }

    public function Listar_Abonos_Proveedor_All() {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Listar_Abonos_Proveedor_All();
        return $filas;
    }

    public function Count_Creditos_Proveedor() {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Count_Creditos_Proveedor();
        return $filas;
    }

    public function Listar_Detalle($idcompra) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Listar_Detalle($idcompra);
        return $filas;
    }

    public function Listar_Info($idcompra) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Listar_Info($idcompra);
        return $filas;
    }

    public function Ver_Restante_Proveedor($idcredito) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Ver_Restante_Proveedor($idcredito);
        return $filas;
    }

    public function Borrar_Abono_Proveedor($idabono) {
        $modelo = new CreditoProveedorModel();
        $cmd = $modelo->Borrar_Abono_Proveedor($idabono);
        return $cmd;
    }

    public function Editar_Credito_Proveedor($id, $nombre, $fecha, $monto, $abonado, $restante, $estado) {
        $modelo = new CreditoProveedorModel();
        $cmd = $modelo->Editar_Credito_Proveedor($id, $nombre, $fecha, $monto, $abonado, $restante, $estado);
        return $cmd;
    }

    public function Insertar_Abono_Proveedor($idcredito, $monto, $idusuario) {
        $modelo = new CreditoProveedorModel();
        $cmd = $modelo->Insertar_Abono_Proveedor($idcredito, $monto, $idusuario);
        return $cmd;
    }

    public function Editar_Abono_Proveedor($idabono, $fecha_abono, $monto_abono) {
        $modelo = new CreditoProveedorModel();
        $cmd = $modelo->Editar_Abono_Proveedor($idabono, $fecha_abono, $monto_abono);
        return $cmd;
    }

    public function Monto_Maximo_Proveedor($idcredito) {
        $modelo = new CreditoProveedorModel();
        $filas = $modelo->Monto_Maximo_Proveedor($idcredito);
        return $filas;
    }
}
?>
