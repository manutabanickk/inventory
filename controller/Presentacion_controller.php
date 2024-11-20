<?php 

class Presentacion
{
    public function Listar_Presentaciones()
    {
        // Crear una instancia de PresentacionModel y llamar al método
        $presentacionModel = new PresentacionModel();
        $filas = $presentacionModel->Listar_Presentaciones();
        return $filas;
    }

    public function Insertar_Presentacion($presentacion, $siglas)
    {
        // Crear una instancia de PresentacionModel y llamar al método
        $presentacionModel = new PresentacionModel();
        $cmd = $presentacionModel->Insertar_Presentacion($presentacion, $siglas);
        return $cmd; // Retornar el resultado por consistencia
    }

    public function Editar_Presentacion($idpresentacion, $presentacion, $siglas, $estado)
    {
        // Crear una instancia de PresentacionModel y llamar al método
        $presentacionModel = new PresentacionModel();
        $cmd = $presentacionModel->Editar_Presentacion($idpresentacion, $presentacion, $siglas, $estado);
        return $cmd; // Retornar el resultado por consistencia
    }
}

?>
