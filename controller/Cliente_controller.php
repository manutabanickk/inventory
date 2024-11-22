<?php

require_once __DIR__ . '/../model/Cliente_model.php'; // Asegúrate de que la ruta sea correcta

class Cliente
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel(); // Instancia del modelo para manejar los datos
    }

    public function Listar_Clientes()
    {
        return $this->clienteModel->Listar_Clientes(); // Llama al método a través de la instancia
    }

    public function Ver_Limite_Credito($idcliente)
    {
        return $this->clienteModel->Ver_Limite_Credito($idcliente);
    }

    public function Listar_Clientes_Activos()
    {
        return $this->clienteModel->Listar_Clientes_Activos();
    }

    public function Listar_Clientes_Inactivos()
    {
        return $this->clienteModel->Listar_Clientes_Inactivos();
    }

    public function Insertar_Cliente(
        $nombre_cliente,
        $numero_nit,
        $numero_nrc,
        $direccion,
        $numero_telefono,
        $email,
        $giro,
        $limite_credito
    ) {
        return $this->clienteModel->Insertar_Cliente(
            $nombre_cliente,
            $numero_nit,
            $numero_nrc,
            $direccion,
            $numero_telefono,
            $email,
            $giro,
            $limite_credito
        );
    }

    public function Editar_Cliente(
        $idcliente,
        $nombre_cliente,
        $numero_nit,
        $numero_nrc,
        $direccion,
        $numero_telefono,
        $email,
        $giro,
        $limite_credito,
        $estado
    ) {
        return $this->clienteModel->Editar_Cliente(
            $idcliente,
            $nombre_cliente,
            $numero_nit,
            $numero_nrc,
            $direccion,
            $numero_telefono,
            $email,
            $giro,
            $limite_credito,
            $estado
        );
    }
}

?>
