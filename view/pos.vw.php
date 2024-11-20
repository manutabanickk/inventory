<?php

$objProducto = new Producto();
$objVenta = new Venta();

?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <!-- Detalle de Compra -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Registrar Venta</h4>
                <div class="heading-elements">
                    <form class="heading-form" action="#">
                        <div class="form-group">
                            <div class="checkbox checkbox-switchery switchery-sm">
                                <label>
                                    <input type="checkbox" id="chkBusqueda" name="chkBusqueda"
                                           class="switchery" checked="checked">
                                    <i class="icon-search4"></i> <span id="lblchk3">PRODUCTO POR CÓDIGO</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel-heading" style="background-color:#2b2b2b;">
                <h4 class="panel-title">
                    <h1 id="big_total" class="panel-title text-center text-black text-green"
                        style="font-size:42px;">0.00</h1>
                </h4>
            </div>

            <div class="panel-body">
                <!-- Campo de búsqueda -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-barcode2"></i></span>
                                <input type="text" id="buscar_producto" name="buscar_producto"
                                       placeholder="Busque un producto aquí..."
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
                            <th class="text-center text-bold">Cantidad</th>
                            <th class="text-center text-bold">Precio
                                <input type="checkbox" id="chkEditable" name="chkEditable" style="margin-left:10px;">
                            </th>
                            <th class="text-center text-bold">Exento</th>
                            <th class="text-center text-bold">Descuento</th>
                            <th class="text-center text-bold">Importe</th>
                            <th class="text-center text-bold">Vence</th>
                            <th class="text-center text-bold">Quitar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Se llenará dinámicamente -->
                        </tbody>
                        <tfoot id="totales_foot">
                        <tr class="bg-info-800">
                            <td align="center" width="10%">SUMAS</td>
                            <td align="center" width="26%">IGV %</td>
                            <td align="center" width="10%">SUBTOTAL</td>
                            <td align="center" width="10%">RET. (-)</td>
                            <td align="center" width="10%">TOT. SIN IGV</td>
                            <td align="center" width="10%">DESCUENTO</td>
                            <td align="center" width="10%">TOTAL</td>
                            <td align="center" width="30%"><b><i class="icon-cash"></i></b></td>
                            <td align="center" width="30%"><b><i class="icon-cancel-circle2"></i></b></td>
                        </tr>
                        <tr>
                            <td align="center" id="sumas"></td>
                            <td align="center" id="iva"></td>
                            <td align="center" id="subtotal"></td>
                            <td align="center" id="ivaretenido"></td>
                            <td align="center" id="exentas"></td>
                            <td align="center" id="descuentos"></td>
                            <td align="center" id="total"></td>
                            <td align="center">
                                <button type="button" id="btnguardar" data-toggle="modal"
                                        data-target="#modal_iconified_cash"
                                        class="btn bg-success-700 btn-sm">Cobrar
                                </button>
                            </td>
                            <td align="center">
                                <button type="button" id="btncancelar" class="btn bg-danger-700 btn-sm">
                                    Cancelar
                                </button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Detalle de Compra -->
    </div>
</div>

<!-- Modal de cobro -->
<div id="modal_iconified_cash" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-cash"></i> Registrar Venta</h5>
            </div>
            <form role="form" autocomplete="off" class="form-validate-jquery" id="frmPago">
                <div class="modal-body" id="modal-container">
                    <!-- Cliente -->
                    <div class="form-group">
                        <label>Seleccione el Cliente</label>
                        <select id="cbCliente" name="cbCliente" class="form-control">
                            <option value="">Seleccione</option>
                            <?php
                            $clientes = $objVenta->Listar_Clientes();
                            if ($clientes) {
                                foreach ($clientes as $cliente) {
                                    echo "<option value='{$cliente['idcliente']}'>{$cliente['numero_nit']} - {$cliente['nombre_cliente']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Detalles de Pago -->
                    <div class="form-group">
                        <label>Condición de Pago</label>
                        <select id="cbMPago" name="cbMPago" class="form-control">
                            <option value="1">EFECTIVO</option>
                            <option value="2">TARJETA</option>
                            <option value="3">MIXTO</option>
                        </select>
                    </div>

                    <!-- Montos -->
                    <div class="form-group">
                        <label>Monto Total</label>
                        <input type="text" id="txtTotal" name="txtTotal" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Efectivo Recibido</label>
                        <input type="text" id="txtEfectivo" name="txtEfectivo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Cambio</label>
                        <input type="text" id="txtCambio" name="txtCambio" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-success-800">Procesar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Modal de cobro -->

<script type="text/javascript" src="web/custom-js/nueva-venta.js"></script>
