<?php

class Cotizacion
{
    private $model;

    public function __construct()
    {
        // Crear una instancia de CotizacionModel
        $this->model = new CotizacionModel();
    }

    /**
     * Autocompletar productos según búsqueda.
     * @param string $search
     * @return array
     */
    public function Autocomplete_Producto($search)
    {
        return $this->model->Autocomplete_Producto($search);
    }

    /**
     * Obtener información de la moneda para reporte.
     * @return array
     */
    public function Ver_Moneda_Reporte()
    {
        return $this->model->Ver_Moneda_Reporte();
    }

    /**
     * Listar cotizaciones entre dos fechas.
     * @param string $date
     * @param string $date2
     * @return array
     */
    public function Listar_Cotizaciones($date, $date2)
    {
        return $this->model->Listar_Cotizaciones($date, $date2);
    }

    /**
     * Obtener el detalle de una cotización.
     * @param int $idCotizacion
     * @return array
     */
    public function Listar_Detalle($idCotizacion)
    {
        return $this->model->Listar_Detalle($idCotizacion);
    }

    /**
     * Obtener información adicional de una cotización.
     * @param int $idCotizacion
     * @return array
     */
    public function Listar_Info($idCotizacion)
    {
        return $this->model->Listar_Info($idCotizacion);
    }

    /**
     * Contar cotizaciones entre dos fechas.
     * @param string $date
     * @param string $date2
     * @return int
     */
    public function Count_Cotizaciones($date, $date2)
    {
        return $this->model->Count_Cotizaciones($date, $date2);
    }

    /**
     * Insertar una nueva cotización.
     * @param string $a_nombre
     * @param string $tipo_pago
     * @param string $entrega
     * @param float $sumas
     * @param float $iva
     * @param float $exento
     * @param float $retenido
     * @param float $descuento
     * @param float $total
     * @param string $sonletras
     * @param int $idusuario
     * @param int $idcliente
     * @return bool
     */
    public function Insertar_Cotizacion($a_nombre, $tipo_pago, $entrega, $sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $idusuario, $idcliente)
    {
        return $this->model->Insertar_Cotizacion($a_nombre, $tipo_pago, $entrega, $sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $idusuario, $idcliente);
    }

    /**
     * Insertar detalles en una cotización.
     * @param int $idproducto
     * @param int $cantidad
     * @param int $disponible
     * @param float $precio_unitario
     * @param float $exento
     * @param float $descuento
     * @param float $importe
     * @return bool
     */
    public function Insertar_DetalleCotizacion($idproducto, $cantidad, $disponible, $precio_unitario, $exento, $descuento, $importe)
    {
        return $this->model->Insertar_DetalleCotizacion($idproducto, $cantidad, $disponible, $precio_unitario, $exento, $descuento, $importe);
    }

    /**
     * Borrar una cotización.
     * @param int $idCotizacion
     * @return bool
     */
    public function Borrar_Cotizacion($idCotizacion)
    {
        return $this->model->Borrar_Cotizacion($idCotizacion);
    }
}

?>
