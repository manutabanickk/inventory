<?php 

class Comprobante {

    public function Listar_Comprobantes() {
        // Crea una instancia de ComprobanteModel
        $model = new ComprobanteModel();
        $filas = $model->Listar_Comprobantes();
        return $filas;
    }

    public function Insertar_Comprobante($comprobante) {
        $model = new ComprobanteModel();
        $cmd = $model->Insertar_Comprobante($comprobante);
    }

    public function Editar_Comprobante($idcomprobante, $comprobante, $estado) {
        $model = new ComprobanteModel();
        $cmd = $model->Editar_Comprobante($idcomprobante, $comprobante, $estado);
    }
}

?>
