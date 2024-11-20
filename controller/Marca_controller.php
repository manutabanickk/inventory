<?php

class Marca
{
    public function Listar_Marcas()
    {
        // Crear una instancia de MarcaModel y llamar al método
        $marcaModel = new MarcaModel();
        $filas = $marcaModel->Listar_Marcas();
        return $filas;
    }

    public function Insertar_Marca($marca)
    {
        // Crear una instancia de MarcaModel y llamar al método
        $marcaModel = new MarcaModel();
        $cmd = $marcaModel->Insertar_Marca($marca);
        return $cmd; // Retornar el resultado por consistencia
    }

    public function Editar_Marca($idmarca, $marca, $estado)
    {
        // Crear una instancia de MarcaModel y llamar al método
        $marcaModel = new MarcaModel();
        $cmd = $marcaModel->Editar_Marca($idmarca, $marca, $estado);
        return $cmd; // Retornar el resultado por consistencia
    }
}

?>
