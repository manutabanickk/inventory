<?php 

class Inventario 
{
    public function Listar_Kardex($mes)
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $filas = $inventarioModel->Listar_Kardex($mes);
        return $filas;
    }

    public function Listar_Entradas($mes)
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $filas = $inventarioModel->Listar_Entradas($mes);
        return $filas;
    }

    public function Listar_Salidas($mes)
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $filas = $inventarioModel->Listar_Salidas($mes);
        return $filas;
    }

    public function Insertar_Entrada($descripcion, $cantidad, $producto)
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $cmd = $inventarioModel->Insertar_Entrada($descripcion, $cantidad, $producto);
        return $cmd; // Retornar el resultado por consistencia
    }

    public function Insertar_Salida($descripcion, $cantidad, $producto)
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $cmd = $inventarioModel->Insertar_Salida($descripcion, $cantidad, $producto);
        return $cmd; // Retornar el resultado por consistencia
    }

    public function Abrir_Inventario()
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $cmd = $inventarioModel->Abrir_Inventario();
        return $cmd; // Retornar el resultado por consistencia
    }

    public function Cerrar_Inventario()
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $cmd = $inventarioModel->Cerrar_Inventario();
        return $cmd; // Retornar el resultado por consistencia
    }

    public function Validar_Inventario()
    {
        // Crear una instancia de InventarioModel y llamar al método
        $inventarioModel = new InventarioModel();
        $cmd = $inventarioModel->Validar_Inventario();
        return $cmd; // Retornar el resultado por consistencia
    }
}

?>
