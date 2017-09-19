<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="{{url('/inicio')}}" class="waves-effect"><i  class="glyphicon glyphicon-home"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-list"></span> Fases <span style="float:right" class="glyphicon glyphicon-menu-down"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{url('/Fase1')}}" class="waves-effect">Oportunidades</a>
                            </li>
                            @if( Auth::user()->id_area == 1 || Auth::user()->id_area == 3 || Auth::user()->id_area == 4 )
                            <li>
                                <a href="{{url('/Fase2')}}" class="waves-effect">Anticipos y AdminPaq</a>
                            </li>
                            @endif

                            @if( Auth::user()->id_area == 1  || Auth::user()->id_area == 5 || Auth::user()->id_area == 6 )
                            <li>
                                <a href="{{url('/Fase3')}}" class="waves-effect">Facturacion</a>
                            </li>
                            @endif

                            @if( Auth::user()->id_area == 1 || Auth::user()->id_area == 8 )
                            <li>
                                <a href="{{url('/Fase4')}}" class="waves-effect">Logistica</a>
                            </li>
                            @endif

                            @if( Auth::user()->id_area == 1 || Auth::user()->id_area == 3 || Auth::user()->id_area == 4 || Auth::user()->id_area == 5 || Auth::user()->id_area == 6 )
                            <li>
                                <a href="{{url('/Fase5')}}" class="waves-effect">Pendientes Administrativos</a>
                            </li>
                            @endif

                            @if( Auth::user()->id_area == 1  || Auth::user()->id_area == 4 || Auth::user()->id_area == 7 )
                            <li>
                                <a href="{{url('/Fase6')}}" class="waves-effect">Instalacion y Arranque</a>
                            </li>
                            @endif

                            @if( Auth::user()->id_area == 1  )
                            <li>
                                <a href="{{url('/Fase7')}}" class="waves-effect">Post Venta</a>
                            </li>
                            @endif
                        </ul>
                    </li> 
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->nombre}} <span style="float:right" class="glyphicon glyphicon-menu-down"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="" class="waves-effect">Cambiar Contraseña</a>
                            </li>
                            <li>
                                <a href="{{url('/logout')}}" class="waves-effect">Salir</a>
                            </li>
                        </ul>
                    </li> 
                    <li>
                        <a href='{{url("/GoogleCalendar")}}' class="waves-effect"><i  class="glyphicon glyphicon-calendar"></i>Google Calendar Recordatorio</a>
                    </li>  
                    <li>
                        <a href='{{url("/MisRecordatorios")}}' class="waves-effect"><i  class="glyphicon glyphicon-time"></i>Mis Recordatorios CRM</a>
                    </li> 
                    <li>
                        <a href="http://172.16.200.249/crm.agro/Local/Facturas" target="_blank" class="waves-effect">Facturas de los Clientes Admipaq</a>
                    </li>      
                </ul>

            </div>

        </nav>
