<div class="modal fade " id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Informacion del Proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="col-sm-12">
                    <div  class="col-sm-12">
                        <button id="see_1" type="button" class="btn btn-primary col-sm-12 waves-effect">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                            Fase 1
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </button>

                        <div style="margin-top: 10px; margin-bottom: 10px;" class="col-sm-12 place"  id="place_1">

                            <div class="col-sm-6">
                                <h3>Nombre del Proyecto: <strong id="i_proyecto"></strong></h3>
                                <h4>Descripcion del Proyecto: <strong id="i_descripcion"></strong></h4>
                                <h4>Tipo: <strong id="i_tipo"></strong></h4>
                                <h4>Area: <strong id="i_area"></strong></h4>
                                <h4>Fuente: <strong id="i_fuente"></strong></h4>
                            </div>
                            <div id="i_marcas" style="border-radius: 25px; border: 2px solid #73AD21; padding: 20px;" class="col-sm-6">
                                <h2 style="text-align: center;">Marcas</h2>
                            </div>

                            <div id="i_administradores" style="border-radius: 25px; border: 2px solid red; padding: 20px;" class="col-sm-6">
                                <h2 style="text-align: center;">Admins</h2>
                               
                            </div>
                            
                        </div>

                    </div>  

                    <div class="col-sm-12">
                        <button id="see_2" type="button" class="btn btn-primary col-sm-12 waves-effect">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                            Fase 2
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </button>

                        <div style="margin-top: 10px; margin-bottom: 10px;" class="col-sm-12 place"  id="place_2">
                            <div class="col-sm-6">
                                <h2><strong>Anticipo Cliente</strong></h2>
                                <h4>Monto Total: <strong id="i_total_cliente"></strong></h4>
                                <h4>Abono: <strong id="i_abono_cliente"></strong></h4>
                                <h4>Pendiente por Pagar: <strong id="i_pendiente_cliente"></strong></h4>
                                <h3>Fecha de Siguiente Pago: <strong id="i_fecha_cliente"></strong></h3>
                            </div>
                            <div class="col-sm-6">
                                <h2><strong>Anticipo Proveedor</strong></h2>
                                <h4>Monto Total: <strong id="i_total_proveedor"></strong></h4>
                                <h4>Abono: <strong id="i_abono_proveedor"></strong></h4>
                                <h4>Pendiente por Pagar: <strong id="i_pendiente_proveedor"></strong></h4>
                                <h3>Fecha de Siguiente Pago: <strong id="i_fecha_proveedor"></strong></h3>
                            </div>
                            <div class="col-sm-12">
                            <h1 style="text-align: center;">Numero Adminpac: <strong id="i_adminpac"></strong></h1>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <button id="see_3" type="button" class="btn btn-primary col-sm-12 waves-effect">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                            Fase 3
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </button>

                        <div style="margin-top: 10px; margin-bottom: 10px;" class="col-sm-12 place"  id="place_3">
                            Ninguna Informacion es Capturada es esta Fase, si desea ver los archivos dar click en el boton de Archivos en los proyectos.
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <button id="see_4" type="button" class="btn btn-primary col-sm-12 waves-effect">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                            Fase 4
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </button>

                        <div style="margin-top: 10px; margin-bottom: 10px;" class="col-sm-12 place"  id="place_4">
                            <h3>Gastos de Importacion Real: <strong id="importacion"></strong></h3>
                            <h3>Gastos de Transporte Real: <strong id="transporte"></strong></h3>
                            <h3>Numero de Compra del Producto en Sistema: <strong id="numero_compra_producto"></strong></h3>
                            <h3>Fecha de Ingreso del Producto: <strong id="fecha_ingreso"></strong></h3>
                            <h3>Fecha de Entrega del Producto: <strong id="fecha_entrega"></strong></h3>
                            <h3>Numero de Guia: <strong id="numero_guia"></strong></h3>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <button id="see_5" type="button" class="btn btn-primary col-sm-12 waves-effect">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                            Fase 5
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </button>

                        <div style="margin-top: 10px; margin-bottom: 10px;" class="col-sm-12 place"  id="place_5">
                            Ninguna Informacion es Capturada en esta Fase, si desea ver los archivos dar click en el boton de Archivos en los proyectos y dirigirse a Fase 5.
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <button id="see_6" type="button" class="btn btn-primary col-sm-12 waves-effect">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                            Fase 6
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </button>

                        <div style="margin-top: 10px; margin-bottom: 10px;" class="col-sm-12 place"  id="place_6">
                            <h2>Visita</h2>

                            <h3 id="visita"></h3>

                            <h4 ><strong>Si desea ver el reporte de instalacion porfavor entre a la seccion de archivos del proyecto y dirigase a Fase 6</strong></h4>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <button id="see_7" type="button" class="btn btn-primary col-sm-12 waves-effect">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                            Fase 7
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </button>

                        <div style="margin-top: 10px; margin-bottom: 10px;" class="col-sm-12 place"  id="place_7">
                            <h3>Respuestas</h3>
                            <h4>¿Esta satisfecho con el producto y servicio? <strong id="pregunta_1"></strong></h4>
                            <h4>¿Como fue la actitud del personal? <strong id="pregunta_2"></strong></h4>
                            <h4>¿Que podriamos hacer para mejorar? <strong id="pregunta_3"></strong></h4>
                        </div>

                    </div>

               </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>