<div class="modal fade " id="modalNuevo" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                            <div class="col-sm-12">
                                <span><strong>Nombre del Proyecto</strong></span>
                                <input id="proyecto" type="text" class="form-control">
                            </div>

                            <div class="col-sm-12">
                                <span><strong>Descripcion del Proyecto</strong></span>
                                <textarea id="descripcion" class="form-control"></textarea>
                            </div>

                            <div class="col-sm-12">
                                <h4 id="money_display"></h4>
                                <span><strong>Valor</strong></span>
                                <input  id="money" class="form-control" >
                            </div>

                            <div class="col-sm-4">
                                <span><strong>Tipo de Proyecto</strong></span>
                                <select class="form-control" id="cmb_Tipo">
                                </select>
                            </div>

                            <div class="col-sm-4">
                                
                                <span><strong>Valor de la Oportunidad</strong></span>
                                <select class="form-control" id="cmb_Valor">
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <span><strong>Area</strong></span>
                                <select class="form-control" id="cmb_Area">
                                </select>
                            </div>

                            <div class="col-sm-12">
                                <span><strong>Marcas</strong></span>
                                <button type="button" class="btn btn-primary waves-effect" data-target="#modalMarcas" data-toggle="modal">
                                    <i class="material-icons">grade</i> 
                                </button>
                            </div>

                            <div class="col-sm-12" id="lugar_marcas">
                            
                            </div>

                            <div class="col-sm-12">
                            <span><strong>Cliente</strong></span>
                                <button type="button" class="btn btn-primary waves-effect" data-target="#modalClientes" data-toggle="modal">
                                    <span class="glyphicon glyphicon-user"></span> 
                                </button>
                            </div>

                            <div class="col-sm-12" >
                               
                                <div class="col-sm-5" id="cliente_seleccionado">
                                    <h4>Cliente: </h4>
                                    <span>Correo 1: </span>
                                    <span>Correo 2: </span>
                                    <span>Telefono: </span>
                                    <span>Celular: </span>
                                </div>

                                <div class="col-sm-5" id="empresa_seleccionada">
                                    <h4>Empresa: </h4>
                                    <span>Giro: </span>
                                    <span>Direccion: </span>
                                    <span>Ciudad: </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <span><strong>Estatus del Proyecto</strong></span>
                                <select class="form-control" id="cmb_Estatus">
                                    
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <span><strong>Fuentes</strong></span>
                                <select class="form-control" id="cmb_Fuentes">
                                    
                                </select>
                            </div>

                            <div class="col-sm-12" style="margin-top: 10px;">
                                <button data-toggle="modal" data-target="#modalAdministradores" type="button" class="btn btn-primary col-sm-12 waves-effect">Administradores</button>
                            </div>

                            <div class="col-sm-12" id="lugar_administradores">
                                
                            </div>
                       
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <div style="margin-left:45%" class="cargando2">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <button id="guardar_Nuevo_Proyecto" type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>