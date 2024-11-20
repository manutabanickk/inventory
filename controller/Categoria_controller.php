<?php 

class Categoria 
{
    public function Listar_Categorias()
    {
        // Crear una instancia de CategoriaModel y llamar al método
        $categoriaModel = new CategoriaModel();
        $filas = $categoriaModel->Listar_Categorias();
        return $filas;
    }

    public function Insertar_Categoria($categoria)
    {
        // Crear una instancia de CategoriaModel y llamar al método
        $categoriaModel = new CategoriaModel();
        $cmd = $categoriaModel->Insertar_Categoria($categoria);
        return $cmd; // Devuelve el resultado por consistencia
    }

    public function Editar_Categoria($idcategoria, $categoria, $estado)
    {
        // Crear una instancia de CategoriaModel y llamar al método
        $categoriaModel = new CategoriaModel();
        $cmd = $categoriaModel->Editar_Categoria($idcategoria, $categoria, $estado);
        return $cmd; // Devuelve el resultado por consistencia
    }
}
?>
