<?php

require_once('Conexion.php');

class DashboardModel extends Conexion
{
    // Método para obtener la moneda del reporte
    public function Ver_Moneda_Reporte()
    {
        $dbconec = Conexion::Conectar();

        try {
            $query = "CALL sp_view_money()";
            $stmt = $dbconec->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devolver los datos en formato asociativo
            } else {
                return []; // Retornar un arreglo vacío si no hay resultados
            }
        } catch (Exception $e) {
            error_log("Error en Ver_Moneda_Reporte: " . $e->getMessage());
            throw new Exception("Error al cargar el listado de monedas.");
        } finally {
            $dbconec = null; // Cerrar conexión
        }
    }

    // Método para obtener datos de los paneles
    public function Datos_Paneles()
    {
        $dbconec = Conexion::Conectar();

        try {
            $query = "CALL sp_panel_dashboard();";
            $stmt = $dbconec->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devolver los datos en formato asociativo
            } else {
                return []; // Retornar un arreglo vacío si no hay resultados
            }
        } catch (Exception $e) {
            error_log("Error en Datos_Paneles: " . $e->getMessage());
            throw new Exception("Error al cargar los datos del panel.");
        } finally {
            $dbconec = null; // Cerrar conexión
        }
    }

    // Método para obtener las compras anuales
    public function Compras_Anuales()
    {
        $dbconec = Conexion::Conectar();

        try {
            $query = "CALL sp_compras_anual();";
            $stmt = $dbconec->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devolver los datos en formato asociativo
            } else {
                return []; // Retornar un arreglo vacío si no hay resultados
            }
        } catch (Exception $e) {
            error_log("Error en Compras_Anuales: " . $e->getMessage());
            throw new Exception("Error al cargar las compras anuales.");
        } finally {
            $dbconec = null; // Cerrar conexión
        }
    }

    // Método para obtener las ventas anuales
    public function Ventas_Anuales()
    {
        $dbconec = Conexion::Conectar();

        try {
            $query = "CALL sp_ventas_anual();";
            $stmt = $dbconec->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devolver los datos en formato asociativo
            } else {
                return []; // Retornar un arreglo vacío si no hay resultados
            }
        } catch (Exception $e) {
            error_log("Error en Ventas_Anuales: " . $e->getMessage());
            throw new Exception("Error al cargar las ventas anuales.");
        } finally {
            $dbconec = null; // Cerrar conexión
        }
    }
}
?>
