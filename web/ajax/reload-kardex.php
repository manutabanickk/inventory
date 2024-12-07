<?php  
spl_autoload_register(function ($className) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    if (file_exists($model)) {
        require_once($model);
    }

    if (file_exists($controller)) {
        require_once($controller);
    }
});

$objInventario = new Inventario();

$mes = isset($_GET['mes']) ? $_GET['mes'] : '';

if ($mes != 'reload') {
    $mes = DateTime::createFromFormat('m/Y', $mes)->format('Y-m');
} else {
    $mes = '';
}
?>

<div class="panel panel-body">
    <table class="table datatable-basic table-borderless table-hover table-xs">
        <thead>
            <tr>
                <th>Fecha Ingreso</th>
                <th>Descripción</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Costo total</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $filas = $objInventario->Listar_Entradas($mes); 
            if (is_array($filas) || is_object($filas)) {
                foreach ($filas as $column) { 
                    // Manejo seguro de variables para evitar errores
                    $tipo_comprobante = isset($column['tipo_comprobante']) && !empty($column['tipo_comprobante']) 
                        ? $column['tipo_comprobante'] 
                        : 'Sin Comprobante';
                    $idVenta = isset($column['idventa']) ? htmlspecialchars($column['idventa']) : 'N/A';
                    $fechaEntrada = isset($column['fecha_entrada']) ? htmlspecialchars($column['fecha_entrada']) : 'N/A';
                    $descripcionEntrada = isset($column['descripcion_entrada']) ? htmlspecialchars($column['descripcion_entrada']) : 'N/A';
                    $codigoBarra = isset($column['codigo_barra']) ? htmlspecialchars($column['codigo_barra']) : 'N/A';
                    $nombreProducto = isset($column['nombre_producto']) ? htmlspecialchars($column['nombre_producto']) : 'N/A';
                    $cantidadEntrada = isset($column['cantidad_entrada']) ? htmlspecialchars($column['cantidad_entrada']) : '0';
                    $costoTotalEntrada = isset($column['costo_total_entrada']) ? htmlspecialchars($column['costo_total_entrada']) : '0.00';
            ?>
                <tr>
                    <td><?php echo $fechaEntrada; ?></td>
                    <td><?php echo $descripcionEntrada; ?></td>
                    <td><?php echo $codigoBarra; ?></td>
                    <td><?php echo $nombreProducto; ?></td>
                    <td><?php echo $cantidadEntrada; ?></td>
                    <td><?php echo $costoTotalEntrada; ?></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!-- Opción: Anular -->
                                    <li>
                                        <a id="delete_product" 
                                           data-id="<?php echo $idVenta; ?>" 
                                           href="javascript:void(0)">
                                            <i class="icon-cancel-circle2"></i> Anular
                                        </a>
                                    </li>

                                    <!-- Opción: Ver Detalle -->
                                    <li>
                                        <a id="detail_pay" 
                                           data-id="<?php echo $idVenta; ?>" 
                                           data-toggle="modal" 
                                           data-target="#modal_detalle" 
                                           href="javascript:void(0)">
                                            <i class="icon-file-spreadsheet"></i> Ver Detalle
                                        </a>
                                    </li>

                                    <!-- Opción: Comprobante -->
                                    <li>
                                        <a id="print_entradas" 
                                           data-id="<?php echo $idVenta; ?>" 
                                           data-tipo="<?php echo $tipo_comprobante; ?>" 
                                           href="javascript:void(0)">
                                            <i class="icon-typewriter"></i> Comprobante
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            <?php  
                }
            } else {
                echo '<tr><td colspan="7" class="text-center">No hay registros disponibles</td></tr>';
            }   
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" src="web/custom-js/kardex.js"></script>
