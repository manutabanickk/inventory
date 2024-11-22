<?php

require_once __DIR__ . '/../../logger.php'; // Importa el logger global

// Instancia del logger global
$logger = AppLogger::getLogger();

class Cotizacion
{
    /**
     * Autocompletar producto basado en un término de búsqueda.
     * 
     * @param string $search Término de búsqueda.
     * @return array Resultados del autocompletado.
     */
    public function Autocomplete_Producto($search)
    {
        try {
            $logger->info("Ejecutando Autocomplete_Producto.", ['search' => $search]);
            $filas = CotizacionModel::Autocomplete_Producto($search);
            $logger->info("Resultados obtenidos de Autocomplete_Producto.", ['count' => count($filas)]);
            return $filas;
        } catch (Exception $e) {
            $this->logError("Autocomplete_Producto", $e);
            throw $e;
        }
    }

    /**
     * Obtener reporte de monedas.
     * 
     * @return array Datos de las monedas.
     */
    public function Ver_Moneda_Reporte()
    {
        try {
            $logger->info("Obteniendo reporte de moneda.");
            $filas = CotizacionModel::Ver_Moneda_Reporte();
            $logger->info("Reporte de moneda obtenido.", ['count' => count($filas)]);
            return $filas;
        } catch (Exception $e) {
            $this->logError("Ver_Moneda_Reporte", $e);
            throw $e;
        }
    }

    /**
     * Listar cotizaciones entre fechas.
     * 
     * @param string $date Fecha inicial.
     * @param string $date2 Fecha final.
     * @return array Lista de cotizaciones.
     */
    public function Listar_Cotizaciones($date, $date2)
    {
        try {
            $logger->info("Listando cotizaciones entre fechas.", ['start_date' => $date, 'end_date' => $date2]);
            $filas = CotizacionModel::Listar_Cotizaciones($date, $date2);
            $logger->info("Cotizaciones listadas.", ['count' => count($filas)]);
            return $filas;
        } catch (Exception $e) {
            $this->logError("Listar_Cotizaciones", $e);
            throw $e;
        }
    }

    /**
     * Listar detalles de una cotización específica.
     * 
     * @param int $idCotizacion ID de la cotización.
     * @return array Detalles de la cotización.
     */
    public function Listar_Detalle($idCotizacion)
    {
        try {
            $logger->info("Listando detalle de cotización.", ['idCotizacion' => $idCotizacion]);
            $filas = CotizacionModel::Listar_Detalle($idCotizacion);
            $logger->info("Detalle de cotización listado.", ['count' => count($filas)]);
            return $filas;
        } catch (Exception $e) {
            $this->logError("Listar_Detalle", $e);
            throw $e;
        }
    }

    /**
     * Obtener información básica de una cotización.
     * 
     * @param int $idCotizacion ID de la cotización.
     * @return array Información básica.
     */
    public function Listar_Info($idCotizacion)
    {
        try {
            $logger->info("Obteniendo información de cotización.", ['idCotizacion' => $idCotizacion]);
            $filas = CotizacionModel::Listar_Info($idCotizacion);
            $logger->info("Información de cotización obtenida.", ['count' => count($filas)]);
            return $filas;
        } catch (Exception $e) {
            $this->logError("Listar_Info", $e);
            throw $e;
        }
    }

    /**
     * Contar cotizaciones en un rango de fechas.
     * 
     * @param string $date Fecha inicial.
     * @param string $date2 Fecha final.
     * @return int Cantidad de cotizaciones.
     */
    public function Count_Cotizaciones($date, $date2)
    {
        try {
            $logger->info("Contando cotizaciones entre fechas.", ['start_date' => $date, 'end_date' => $date2]);
            $filas = CotizacionModel::Count_Cotizaciones($date, $date2);
            $logger->info("Conteo de cotizaciones realizado.", ['count' => count($filas)]);
            return $filas;
        } catch (Exception $e) {
            $this->logError("Count_Cotizaciones", $e);
            throw $e;
        }
    }

    /**
     * Insertar una nueva cotización.
     * 
     * @param string $a_nombre Nombre del cliente.
     * @param string $tipo_pago Tipo de pago.
     * @param string $entrega Forma de entrega.
     * @param float $sumas Sumas totales.
     * @param float $iva IVA total.
     * @param float $exento Exento total.
     * @param float $retenido Monto retenido.
     * @param float $descuento Monto de descuento.
     * @param float $total Total de la cotización.
     * @param string $sonletras Monto en letras.
     * @param int $idusuario ID del usuario.
     * @param int $idcliente ID del cliente.
     */
    public function Insertar_Cotizacion($a_nombre, $tipo_pago, $entrega, $sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $idusuario, $idcliente)
    {
        try {
            $logger->info("Insertando nueva cotización.", [
                'a_nombre' => $a_nombre,
                'tipo_pago' => $tipo_pago,
                'entrega' => $entrega,
                'total' => $total,
            ]);

            CotizacionModel::Insertar_Cotizacion($a_nombre, $tipo_pago, $entrega, $sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $idusuario, $idcliente);

            $logger->info("Cotización insertada exitosamente.");
        } catch (Exception $e) {
            $this->logError("Insertar_Cotizacion", $e);
            throw $e;
        }
    }

    /**
     * Insertar un detalle en la cotización.
     * 
     * @param int $idproducto ID del producto.
     * @param int $cantidad Cantidad del producto.
     * @param int $disponible Disponibilidad (1 o 0).
     * @param float $precio_unitario Precio por unidad.
     * @param float $exento Monto exento.
     * @param float $descuento Monto de descuento.
     * @param float $importe Importe total.
     */
    public function Insertar_DetalleCotizacion($idproducto, $cantidad, $disponible, $precio_unitario, $exento, $descuento, $importe)
    {
        try {
            $logger->info("Insertando detalle de cotización.", [
                'idproducto' => $idproducto,
                'cantidad' => $cantidad,
                'importe' => $importe,
            ]);

            CotizacionModel::Insertar_DetalleCotizacion($idproducto, $cantidad, $disponible, $precio_unitario, $exento, $descuento, $importe);

            $logger->info("Detalle de cotización insertado exitosamente.");
        } catch (Exception $e) {
            $this->logError("Insertar_DetalleCotizacion", $e);
            throw $e;
        }
    }

    /**
     * Borrar una cotización específica.
     * 
     * @param int $idCotizacion ID de la cotización.
     */
    public function Borrar_Cotizacion($idCotizacion)
    {
        try {
            $logger->info("Borrando cotización.", ['idCotizacion' => $idCotizacion]);
            CotizacionModel::Borrar_Cotizacion($idCotizacion);
            $logger->info("Cotización borrada exitosamente.");
        } catch (Exception $e) {
            $this->logError("Borrar_Cotizacion", $e);
            throw $e;
        }
    }

    /**
     * Registrar error en los logs.
     * 
     * @param string $method Nombre del método.
     * @param Exception $e Excepción capturada.
     */
    private function logError($method, $e)
    {
        global $logger;
        $logger->error("Error en $method: " . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
}

?>
