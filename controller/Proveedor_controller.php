<?php 

class Proveedor {

    public function Listar_Proveedores() {
        $model = new ProveedorModel(); // Instanciar la clase
        $filas = $model->Listar_Proveedores(); // Llamada al método de instancia
        return $filas;
    }

    public function Insertar_Proveedor($nombre_proveedor, $numero_telefono, $numero_nit, $numero_nrc, 
    $nombre_contacto, $telefono_contacto) {
        $model = new ProveedorModel(); // Instanciar la clase
        $cmd = $model->Insertar_Proveedor($nombre_proveedor, $numero_telefono, $numero_nit, $numero_nrc, 
        $nombre_contacto, $telefono_contacto);
    }

    public function Editar_Proveedor($idproveedor, $nombre_proveedor, $numero_telefono, $numero_nit, $numero_nrc, 
    $nombre_contacto, $telefono_contacto, $estado) {
        $model = new ProveedorModel(); // Instanciar la clase
        $cmd = $model->Editar_Proveedor($idproveedor, $nombre_proveedor, $numero_telefono, $numero_nit, $numero_nrc, 
        $nombre_contacto, $telefono_contacto, $estado);
    }
}

?>
