<?php



class Apartado
{
    public function Ver_Moneda_Reporte()
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Ver_Moneda_Reporte();
        return $filas;
    }

    public function Listar_Apartados($criterio, $date, $date2, $estado)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Listar_Apartados($criterio, $date, $date2, $estado);
        return $filas;
    }

    public function Listar_Apartados_Totales($criterio, $date, $date2, $estado)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Listar_Apartados_Totales($criterio, $date, $date2, $estado);
        return $filas;
    }

    public function Listar_Apartados_Detalle($criterio, $date, $date2, $estado)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Listar_Apartados_Detalle($criterio, $date, $date2, $estado);
        return $filas;
    }

    public function Imprimir_Ticket_Apartado($idApartado)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Imprimir_Ticket_Apartado($idApartado);
        return $filas;
    }

    public function Imprimir_Ticket_DetalleApartado($idApartado)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Imprimir_Ticket_DetalleApartado($idApartado);
        return $filas;
    }

    public function Listar_Detalle($idApartado)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Listar_Detalle($idApartado);
        return $filas;
    }

    public function Listar_Info($idApartado)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Listar_Info($idApartado);
        return $filas;
    }

    public function Count_Apartados($criterio, $date, $date2)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Count_Apartados($criterio, $date, $date2);
        return $filas;
    }

    public function Listar_Clientes()
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Listar_Clientes();
        return $filas;
    }

    public function Autocomplete_Producto($search)
    {
        $modelo = new ApartadoModel();
        $filas = $modelo->Autocomplete_Producto($search);
        return $filas;
    }

    public function Insertar_Apartado(
        $fecha_limite_retiro,
        $sumas,
        $iva,
        $exento,
        $retenido,
        $descuento,
        $total,
        $abonado_apartado,
        $restante_pagar,
        $sonletras,
        $idcliente,
        $idusuario
    ) {
        $modelo = new ApartadoModel();
        $cmd = $modelo->Insertar_Apartado(
            $fecha_limite_retiro,
            $sumas,
            $iva,
            $exento,
            $retenido,
            $descuento,
            $total,
            $abonado_apartado,
            $restante_pagar,
            $sonletras,
            $idcliente,
            $idusuario
        );
        return $cmd;
    }

    public function Insertar_DetalleApartado(
        $idproducto,
        $cantidad,
        $precio_unitario,
        $exento,
        $descuento,
        $fecha_vence,
        $importe
    ) {
        $modelo = new ApartadoModel();
        $cmd = $modelo->Insertar_DetalleApartado(
            $idproducto,
            $cantidad,
            $precio_unitario,
            $exento,
            $descuento,
            $fecha_vence,
            $importe
        );
        return $cmd;
    }

    public function Insertar_Venta(
        $idapartado,
        $tipo_pago,
        $tipo_comprobante,
        $pago_efectivo,
        $pago_tarjeta,
        $numero_tarjeta,
        $tarjeta_habiente,
        $cambio,
        $idcliente,
        $idusuario
    ) {
        $modelo = new ApartadoModel();
        $cmd = $modelo->Insertar_Venta(
            $idapartado,
            $tipo_pago,
            $tipo_comprobante,
            $pago_efectivo,
            $pago_tarjeta,
            $numero_tarjeta,
            $tarjeta_habiente,
            $cambio,
            $idcliente,
            $idusuario
        );
        return $cmd;
    }

    public function Anular_Apartado($idApartado)
    {
        $modelo = new ApartadoModel();
        $cmd = $modelo->Anular_Apartado($idApartado);
        return $cmd;
    }
}
?>
