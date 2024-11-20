<?php

class Compra {

    public function Ver_Moneda_Reporte() {
        $model = new CompraModel();
        $filas = $model->Ver_Moneda_Reporte();
        return $filas;
    }

    public function Listar_Compras($criterio, $date, $date2, $estado, $pago) {
        $model = new CompraModel();
        $filas = $model->Listar_Compras($criterio, $date, $date2, $estado, $pago);
        return $filas;
    }

    public function Listar_Compras_Detalle($criterio, $date, $date2, $estado, $pago) {
        $model = new CompraModel();
        $filas = $model->Listar_Compras_Detalle($criterio, $date, $date2, $estado, $pago);
        return $filas;
    }

    public function Listar_Compras_Totales($criterio, $date, $date2, $estado, $pago) {
        $model = new CompraModel();
        $filas = $model->Listar_Compras_Totales($criterio, $date, $date2, $estado, $pago);
        return $filas;
    }

    public function Listar_Detalle($idCompra) {
        $model = new CompraModel();
        $filas = $model->Listar_Detalle($idCompra);
        return $filas;
    }

    public function Listar_Info($idCompra) {
        $model = new CompraModel();
        $filas = $model->Listar_Info($idCompra);
        return $filas;
    }

    public function Listar_Historico($idproducto) {
        $model = new CompraModel();
        $filas = $model->Listar_Historico($idproducto);
        return $filas;
    }

    public function Reporte_Historico($idproducto) {
        $model = new CompraModel();
        $filas = $model->Reporte_Historico($idproducto);
        return $filas;
    }

    public function Reporte_Historico_Mas_Bajo($idproducto) {
        $model = new CompraModel();
        $filas = $model->Reporte_Historico_Mas_Bajo($idproducto);
        return $filas;
    }

    public function Count_Compras($criterio, $date, $date2) {
        $model = new CompraModel();
        $filas = $model->Count_Compras($criterio, $date, $date2);
        return $filas;
    }

    public function Insertar_Compra($fecha_compra, $idproveedor, $tipo_pago, $numero_comprobante, $tipo_comprobante, $fecha_comprobante, $sumas, $iva, $exento, $retenido, $total, $sonletras) {
        $model = new CompraModel();
        $cmd = $model->Insertar_Compra($fecha_compra, $idproveedor, $tipo_pago, $numero_comprobante, $tipo_comprobante, $fecha_comprobante, $sumas, $iva, $exento, $retenido, $total, $sonletras);
        return $cmd;
    }

    public function Insertar_DetalleCompra($idproducto, $cantidad, $precio_unitario, $exento, $fecha_vence, $importe) {
        $model = new CompraModel();
        $cmd = $model->Insertar_DetalleCompra($idproducto, $cantidad, $precio_unitario, $exento, $fecha_vence, $importe);
        return $cmd;
    }

    public function Anular_Compra($idcompra) {
        $model = new CompraModel();
        $cmd = $model->Anular_Compra($idcompra);
        return $cmd;
    }
}

?>
