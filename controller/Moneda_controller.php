<?php 

class Moneda {

    private $model;

    public function __construct() {
        $this->model = new MonedaModel(); // Crear una instancia del modelo
    }

    public function Listar_Monedas() {
        $filas = $this->model->Listar_Monedas();
        return $filas;
    }

    public function Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol) {
        $cmd = $this->model->Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
    }

    public function Editar_Moneda($idcurrency, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol) {
        $cmd = $this->model->Editar_Moneda($idcurrency, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
    }
}

?>
