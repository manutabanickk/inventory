<?php

// Asegúrate de que la ruta al modelo es correcta
require_once __DIR__ . '/../model/Cotizacion_model.php'; 

class Cotizacion
{
    private $cotizacionModel;

    // Constructor para inicializar el modelo
    public function __construct()
    {
        // Verifica que la clase CotizacionModel esté correctamente definida
        if (!class_exists('CotizacionModel')) {
            throw new Exception("La clase 'CotizacionModel' no está definida o no fue incluida correctamente.");
        }

        $this->cotizacionModel = new CotizacionModel(); // Instancia del modelo para manejar los datos
    }

    // Métodos del controlador
    public function Autocomplete_Producto($search)
    {
        return $this->cotizacionModel->Autocomplete_Producto($search);
    }

    public function Ver_Moneda_Reporte()
    {
        return $this->cotizacionModel->Ver_Moneda_Reporte();
    }

    public function Listar_Cotizaciones($date, $date2)
    {
        return $this->cotizacionModel->Listar_Cotizaciones($date, $date2);
    }

    public function Listar_Detalle($idCotizacion)
    {
        return $this->cotizacionModel->Listar_Detalle($idCotizacion);
    }

    public function Listar_Info($idCotizacion)
    {
        return $this->cotizacionModel->Listar_Info($idCotizacion);
    }

    public function Count_Cotizaciones($date, $date2)
    {
        return $this->cotizacionModel->Count_Cotizaciones($date, $date2);
    }

    public function Insertar_Cotizacion(
        $a_nombre,
        $tipo_pago,
        $entrega,
        $sumas,
        $iva,
        $exento,
        $retenido,
        $descuento,
        $total,
        $sonletras,
        $idusuario,
        $idcliente
    ) {
        return $this->cotizacionModel->Insertar_Cotizacion(
            $a_nombre,
            $tipo_pago,
            $entrega,
            $sumas,
            $iva,
            $exento,
            $retenido,
            $descuento,
            $total,
            $sonletras,
            $idusuario,
            $idcliente
        );
    }

    public function Insertar_DetalleCotizacion(
        $idproducto,
        $cantidad,
        $disponible,
        $precio_unitario,
        $exento,
        $descuento,
        $importe
    ) {
        return $this->cotizacionModel->Insertar_DetalleCotizacion(
            $idproducto,
            $cantidad,
            $disponible,
            $precio_unitario,
            $exento,
            $descuento,
            $importe
        );
    }

    public function Borrar_Cotizacion($idCotizacion)
    {
        return $this->cotizacionModel->Borrar_Cotizacion($idCotizacion);
    }
}

?>
