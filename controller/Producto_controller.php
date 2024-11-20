<?php

class Producto
{
    public function Print_Barcode($idproducto)
    {
        // Crear una instancia de ProductoModel
        $productoModel = new ProductoModel();
        $filas = $productoModel->Print_Barcode($idproducto);
        return $filas;
    }

    public function Listar_Productos()
    {
        // Crear una instancia de ProductoModel
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Productos();
        return $filas;
    }

    public function Autocomplete_Producto($search)
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Autocomplete_Producto($search);
        return $filas;
    }

    public function Listar_Productos_Activos()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Productos_Activos();
        return $filas;
    }

    public function Listar_Productos_Inactivos()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Productos_Inactivos();
        return $filas;
    }

    public function Listar_Productos_Agotados()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Productos_Agotados();
        return $filas;
    }

    public function Listar_Productos_Vigentes()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Productos_Vigentes();
        return $filas;
    }

    public function Listar_Perecederos()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Perecederos();
        return $filas;
    }

    public function Listar_No_Perecederos()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_No_Perecederos();
        return $filas;
    }

    public function Listar_Categorias()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Categorias();
        return $filas;
    }

    public function Listar_Marcas()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Marcas();
        return $filas;
    }

    public function Listar_Presentaciones()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Presentaciones();
        return $filas;
    }

    public function Listar_Proveedores()
    {
        $productoModel = new ProductoModel();
        $filas = $productoModel->Listar_Proveedores();
        return $filas;
    }

    public function Insertar_Producto($codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
                                       $precio_venta_3, $stock, $stock_min, $idcategoria, $idmarca, $idpresentacion, $exento, $inventariable, $perecedero)
    {
        $productoModel = new ProductoModel();
        $cmd = $productoModel->Insertar_Producto($codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
                                                 $precio_venta_3, $stock, $stock_min, $idcategoria, $idmarca, $idpresentacion, $exento, $inventariable, $perecedero);
        return $cmd;
    }

    public function Editar_Producto($idproducto, $codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
                                    $precio_venta_3, $stock_min, $idcategoria, $idmarca, $idpresentacion, $estado, $exento, $inventariable, $perecedero)
    {
        $productoModel = new ProductoModel();
        $cmd = $productoModel->Editar_Producto($idproducto, $codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
                                               $precio_venta_3, $stock_min, $idcategoria, $idmarca, $idpresentacion, $estado, $exento, $inventariable, $perecedero);
        return $cmd;
    }
}

?>
