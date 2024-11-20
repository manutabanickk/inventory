<?php

require_once __DIR__ . '/../model/Venta_model.php'; // Asegúrate de que la ruta sea correcta

class Venta
{
    private $ventaModel;

    public function __construct()
    {
        $this->ventaModel = new VentaModel(); // Instancia del modelo para manejar los datos
    }

    // Métodos para gestionar ventas y reportes
    public function Ver_Moneda_Reporte()
    {
        return $this->ventaModel->Ver_Moneda_Reporte();
    }

    public function Listar_Ventas($criterio, $date, $date2, $estado)
    {
        return $this->ventaModel->Listar_Ventas($criterio, $date, $date2, $estado);
    }

    public function Listar_Ventas_Totales($criterio, $date, $date2, $estado)
    {
        return $this->ventaModel->Listar_Ventas_Totales($criterio, $date, $date2, $estado);
    }

    public function Listar_Ventas_Detalle($criterio, $date, $date2, $estado)
    {
        return $this->ventaModel->Listar_Ventas_Detalle($criterio, $date, $date2, $estado);
    }

    public function Imprimir_Ticket_Venta($idventa)
    {
        return $this->ventaModel->Imprimir_Ticket_Venta($idventa);
    }

    public function Imprimir_Factura_DetalleVenta($idventa)
    {
        return $this->ventaModel->Imprimir_Factura_DetalleVenta($idventa);
    }

    public function Imprimir_Ticket_DetalleVenta($idventa)
    {
        return $this->ventaModel->Imprimir_Ticket_DetalleVenta($idventa);
    }

    public function Imprimir_Corte_Z_Dia($date)
    {
        return $this->ventaModel->Imprimir_Corte_Z_Dia($date);
    }

    public function Imprimir_Corte_Z_Mes($date)
    {
        return $this->ventaModel->Imprimir_Corte_Z_Mes($date);
    }

    public function Listar_Detalle($idventa)
    {
        return $this->ventaModel->Listar_Detalle($idventa);
    }

    public function Listar_Info($idventa)
    {
        return $this->ventaModel->Listar_Info($idventa);
    }

    public function Count_Ventas($criterio, $date, $date2)
    {
        return $this->ventaModel->Count_Ventas($criterio, $date, $date2);
    }

    public function Listar_Clientes()
    {
        return $this->ventaModel->Listar_Clientes();
    }

    public function Listar_Comprobantes()
    {
        return $this->ventaModel->Listar_Comprobantes();
    }

    public function Listar_Empresas()
    {
        return $this->ventaModel->Listar_Empresas();
    }

    public function Autocomplete_Producto($search)
    {
        return $this->ventaModel->Autocomplete_Producto($search);
    }

    public function Insertar_Venta($tipo_pago, $tipo_comprobante, $sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $pago_efectivo, $pago_tarjeta, $numero_tarjeta, $tarjeta_habiente, $cambio, $estado, $idcliente, $idusuario)
    {
        return $this->ventaModel->Insertar_Venta($tipo_pago, $tipo_comprobante, $sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $pago_efectivo, $pago_tarjeta, $numero_tarjeta, $tarjeta_habiente, $cambio, $estado, $idcliente, $idusuario);
    }

    public function Insertar_DetalleVenta($idproducto, $cantidad, $precio_unitario, $exento, $descuento, $fecha_vence, $importe)
    {
        return $this->ventaModel->Insertar_DetalleVenta($idproducto, $cantidad, $precio_unitario, $exento, $descuento, $fecha_vence, $importe);
    }

    public function Anular_Venta($idventa)
    {
        return $this->ventaModel->Anular_Venta($idventa);
    }

    public function Finalizar_Venta($idventa)
    {
        return $this->ventaModel->Finalizar_Venta($idventa);
    }

    public function Fechas_Vencimiento($idproducto)
    {
        return $this->ventaModel->Fechas_Vencimiento($idproducto);
    }
}
