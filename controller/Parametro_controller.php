<?php

class Parametro {

    // Método para listar todos los parámetros
    public function Listar_Parametros() {
        $model = new ParametroModel();
        $filas = $model->Listar_Parametros();
        return $filas;
    }

    // Método para listar todas las monedas
    public function Listar_Monedas() {
        $model = new ParametroModel();
        $filas = $model->Listar_Monedas();
        return $filas;
    }

    // Método para obtener el porcentaje de impuesto
    public function Ver_Impuesto() {
        $model = new ParametroModel();
        $filas = $model->Ver_Impuesto();
        return $filas;
    }

    // Método para obtener la moneda activa
    public function Ver_Moneda() {
        $model = new ParametroModel();
        $filas = $model->Ver_Moneda();
        return $filas;
    }

    // Método para obtener el símbolo de la moneda
    public function Ver_Moneda_Simbolo() {
        $model = new ParametroModel();
        $filas = $model->Ver_Moneda_Simbolo();
        return $filas;
    }

    // Método para insertar un nuevo parámetro
    public function Insertar_Parametro($nombre_empresa, $propietario, $numero_nit, $numero_nrc, $porcentaje_iva, $porcentaje_retencion, $monto_retencion, $direccion, $idcurrency) {
        $model = new ParametroModel();
        $model->Insertar_Parametro($nombre_empresa, $propietario, $numero_nit, $numero_nrc, $porcentaje_iva, $porcentaje_retencion, $monto_retencion, $direccion, $idcurrency);
    }

    // Método para editar un parámetro existente
    public function Editar_Parametro($idparametro, $nombre_empresa, $propietario, $numero_nit, $numero_nrc, $porcentaje_iva, $porcentaje_retencion, $monto_retencion, $direccion, $idcurrency) {
        $model = new ParametroModel();
        $model->Editar_Parametro($idparametro, $nombre_empresa, $propietario, $numero_nit, $numero_nrc, $porcentaje_iva, $porcentaje_retencion, $monto_retencion, $direccion, $idcurrency);
    }
}

?>
