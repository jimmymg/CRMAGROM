<div class="modal fade" id="ModalContactosExtras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittle">Contactos Extras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
               
                    <button  id="CE_nuevo" type="button" class="waves-effect btn btn-warning " style="width: 100%;">Nuevo Contacto Extra</button>
              

                <div class="row"  style="margin-top: 15px;">
                    <div id="cargando-Contactos-Extras">
                        <div style="margin-left:45%" id="preloader_1">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" 
                                    id="dataTables-Contactos-Extras">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Correo 1:</th>
                                    <th>Correo 2:</th>
                                    <th>Telefono:</th>
                                    <th>Celular:</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            
            </div>
        </div>
    </div>
</div>

<style>
#preloader_1{
    position:relative;
}
#preloader_1 span{
    display:block;
    bottom:0px;
    width: 9px;
    height: 5px;
    background:#9b59b6;
    position:absolute;
    animation: preloader_1 1.5s  infinite ease-in-out;
}
 
#preloader_1 span:nth-child(2){
left:11px;
animation-delay: .2s;
 
}
#preloader_1 span:nth-child(3){
left:22px;
animation-delay: .4s;
}
#preloader_1 span:nth-child(4){
left:33px;
animation-delay: .6s;
}
#preloader_1 span:nth-child(5){
left:44px;
animation-delay: .8s;
}
@keyframes preloader_1 {
    0% {height:5px;transform:translateY(0px);background:#9b59b6;}
    25% {height:30px;transform:translateY(15px);background:#3498db;}
    50% {height:5px;transform:translateY(0px);background:#9b59b6;}
    100% {height:5px;transform:translateY(0px);background:#9b59b6;}
}

#dataTables-Contactos-Extras_wrapper {
    padding-left:  20px;
    padding-right: 20px;
}
</style>

<div class="modal fade" id="ModalCEClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittle">Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div id="cargando-CE-Clientes">
                        <div style="margin-left:45%" id="preloader_1">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" 
                                    id="dataTables-CE-Clientes">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Seleccionar</th>
                                    <th>Cliente</th>
                                    <th>Correo 1:</th>
                                    <th>Correo 2:</th>
                                    <th>Telefono:</th>
                                    <th>Celular:</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>