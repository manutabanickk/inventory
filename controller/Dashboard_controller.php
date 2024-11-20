<?php

class Dashboard
{
    // Método para obtener la moneda del reporte
    public function Ver_Moneda_Reporte()
    {
        // Crear una instancia de DashboardModel
        $dashboardModel = new DashboardModel();
        $filas = $dashboardModel->Ver_Moneda_Reporte();
        return $filas;
    }

    // Método para obtener los datos de los paneles
    public function Datos_Paneles()
    {
        // Crear una instancia de DashboardModel
        $dashboardModel = new DashboardModel();
        $filas = $dashboardModel->Datos_Paneles();
        return $filas;
    }

    // Método para obtener las compras anuales
    public function Compras_Anuales()
    {
        // Crear una instancia de DashboardModel
        $dashboardModel = new DashboardModel();
        $filas = $dashboardModel->Compras_Anuales();
        return $filas;
    }

    // Método para obtener las ventas anuales
    public function Ventas_Anuales()
    {
        // Crear una instancia de DashboardModel
        $dashboardModel = new DashboardModel();
        $filas = $dashboardModel->Ventas_Anuales();
        return $filas;
    }
}

?>
