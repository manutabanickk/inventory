<?php
require_once(__DIR__ . '/../model/Apartado_model.php'); 

class Apartado {

    private $model;

    public function __construct() {
        $this->model = new ApartadoModel(); // Crear instancia del modelo
    }

    public function Ver_Moneda_Reporte() {
        $filas = $this->model->Ver_Moneda_Reporte();
        return $filas;
    }

    public function Listar_Apartados($criterio, $date, $date2, $estado) {
        $filas = $this->model->Listar_Apartados($criterio, $date, $date2, $estado);
        return $filas;
    }

    public function Listar_Apartados_Totales($criterio, $date, $date2, $estado) {
        $filas = $this->model->Listar_Apartados_Totales($criterio, $date, $date2, $estado);
        return $filas;
    }

    public function Listar_Apartados_Detalle($criterio, $date, $date2, $estado) {
        $filas = $this->model->Listar_Apartados_Detalle($criterio, $date, $date2, $estado);
        return $filas;
    }

    public function Imprimir_Ticket_DetalleApartado($idApartado) {
        $filas = $this->model->Imprimir_Ticket_DetalleApartado($idApartado);
        return $filas;
    }

    public function Imprimir_Ticket_Apartado($idApartado) {
        $filas = $this->model->Imprimir_Ticket_Apartado($idApartado);
        return $filas;
    }

    public function Listar_Detalle($idApartado) {
        $filas = $this->model->Listar_Detalle($idApartado);
        return $filas;
    }

    public function Listar_Info($idApartado) {
        $filas = $this->model->Listar_Info($idApartado);
        return $filas;
    }

    public function Count_Apartados($criterio, $date, $date2) {
        $filas = $this->model->Count_Apartados($criterio, $date, $date2);
        return $filas;
    }

    public function Listar_Clientes() {
        $filas = $this->model->Listar_Clientes();
        return $filas;
    }

    public function Listar_Comprobantes() {
        $filas = $this->model->Listar_Comprobantes();
        return $filas;
    }

    public function Autocomplete_Producto($search) {
        $filas = $this->model->Autocomplete_Producto($search);
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
        $cmd = $this->model->Insertar_Apartado(
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
        $cmd = $this->model->Insertar_Venta(
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
        $cmd = $this->model->Insertar_DetalleApartado(
            $idproducto,
            $cantidad,
            $precio_unitario,
            $exento,
            $descuento,
            $fecha_vence,
            $importe
        );
    }

    public function Anular_Apartado($idApartado) {
        $cmd = $this->model->Anular_Apartado($idApartado);
    }
}

?>
