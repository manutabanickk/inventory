<?php
// Instanciar objetos necesarios
$objProducto = new Producto();
$objVenta = new Venta();
?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <!-- Panel principal de cotización -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Generar Cotización de Productos</h4>
                <div class="heading-elements">
                    <form class="heading-form">
                        <div class="form-group">
                            <div class="checkbox checkbox-switchery switchery-sm">
                                <label>
                                    <input type="checkbox" id="chkBusqueda" name="chkBusqueda" class="switchery" checked="checked">
                                    <i class="icon-search4"></i> <span id="lblchk3">Producto por Código</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Encabezado con el total -->
            <div class="panel-heading" style="background-color:#2b2b2b;">
                <h1 id="big_total" class="panel-title text-center text-black text-green" style="font-size:42px;">0.00</h1>
            </div>

            <!-- Formulario de búsqueda -->
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-barcode2"></i></span>
                                <input type="text" id="buscar_producto" name="buscar_producto" placeholder="Busque un producto aquí..." 
                                    class="form-control" style="text-transform:uppercase;" 
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de detalles -->
                <div class="table-responsive">
                    <table id="tbldetalle" class="table table-xxs">
                        <thead>
                            <tr class="bg-teal">
                                <th></th>
                                <th class="text-center text-bold">Producto</th>
                                <th class="text-center text-bold">Disponible</th>
                                <th class="text-center text-bold">Cantidad</th>
                                <th class="text-center text-bold">Precio</th>
                                <th class="text-center text-bold">Exento</th>
                                <th class="text-center text-bold">Descuento</th>
                                <th class="text-center text-bold">Importe</th>
                                <th class="text-center text-bold">Quitar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot id="totales_foot">
                            <tr class="bg-info-800">
                                <td align="center">SUMAS</td>
                                <td align="center">IGV %</td>
                                <td align="center">SUBTOTAL</td>
                                <td align="center">RET. (-)</td>
                                <td align="center">TOT. SIN IGV</td>
                                <td align="center">DESCUENTO</td>
                                <td align="center">TOTAL</td>
                                <td align="center">
                                    <button type="button" id="btnguardar" data-toggle="modal" data-target="#modal_iconified_cash" 
                                        class="btn bg-blue-600 btn-sm">Guardar</button>
                                </td>
                                <td align="center">
                                    <button type="button" id="btncancelar" class="btn bg-danger-700 btn-sm">Cancelar</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Panel principal de cotización -->
    </div>
</div>

<!-- Modal de cotización -->
<div id="modal_iconified_cash" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-file-text2"></i> &nbsp; <span class="title-form">Datos de Cotización</span></h5>
            </div>

            <form role="form" autocomplete="off" class="form-validate-jquery" id="frmPago">
                <div class="modal-body">
                    <!-- Selección de cliente -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Seleccione el Cliente</label>
                                <div class="input-group">
                                    <select id="cbCliente" name="cbCliente" class="select-size-xs" style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        <option value="">Seleccione un cliente...</option>
                                        <?php
                                        $filas = $objVenta->Listar_Clientes();
                                        if (is_array($filas) || is_object($filas)) {
                                            foreach ($filas as $row => $column) {
                                                echo '<option value="' . $column["idcliente"] . '">' . $column["nombre_cliente"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="javascript:openPopUp()" class="btn btn-success">Registrar</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Condición de pago y entrega -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Condición de Pago</label>
                                <div class="checkbox checkbox-switchery switchery-sm">
                                    <label>
                                        <input type="checkbox" id="chkPagado" name="chkPagado" class="switchery" checked="checked">
                                        <span id="lblchk2">Al Contado</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Forma de Entrega</label>
                                <select id="cbEntrega" name="cbEntrega" class="select-icons">
                                    <option value="1" data-icon="store">Inmediata</option>
                                    <option value="2" data-icon="truck">Por Pedido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones del modal -->
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnRegistrar" class="btn bg-info btn-labeled">
                        <b><i class="icon-printer4"></i></b> Guardar e Imprimir
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal de cotización -->

<?php include('./includes/footer.inc.php'); ?>
</div>
<!-- /Content area -->
<script type="text/javascript" src="web/custom-js/cotizacion.js"></script>
