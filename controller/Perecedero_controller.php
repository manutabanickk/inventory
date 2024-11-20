<?php

class Perecedero
{
    private $model;

    public function __construct()
    {
        // Crear una instancia de PerecederoModel
        $this->model = new PerecederoModel();
    }

    public function Listar_Perecederos($fecha1, $fecha2)
    {
        // Llamar al método a través de la instancia
        return $this->model->Listar_Perecederos($fecha1, $fecha2);
    }

    public function Listar_A_Vencer()
    {
        // Llamar al método a través de la instancia
        return $this->model->Listar_A_Vencer();
    }

    public function Listar_Productos()
    {
        // Llamar al método a través de la instancia
        return $this->model->Listar_Productos();
    }

    public function Listar_Stock($producto)
    {
        // Llamar al método a través de la instancia
        return $this->model->Listar_Stock($producto);
    }

    public function Insertar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto)
    {
        // Llamar al método a través de la instancia
        return $this->model->Insertar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto);
    }

    public function Editar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto)
    {
        // Llamar al método a través de la instancia
        return $this->model->Editar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto);
    }

    public function Borrar_Perecedero($fecha_vencimiento, $idproducto)
    {
        // Llamar al método a través de la instancia
        return $this->model->Borrar_Perecedero($fecha_vencimiento, $idproducto);
    }
}

?>
