<div>
     <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">            
            
            <li class="nav-item">
                <a class="btn btn-primary ml-3 w-75 rounded-0 d-flex justify-content-center align-items-center" href="{{ route('nuevaEncuesta')}}">
                    <i class="fa fa-plus h5 mr-1 mt-1"></i>Nueva <span class="d-lg-block ml-1 d-md-none  d-sm-none">encuesta</span>
                </a>
            </li>

            <h4 class="h3 sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-3 mb-1 text-muted">
                <span>Bienvenido: {{ Auth::user()->name }}</span><br>
            </h4>
            
            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('home')}}">
                    <i class="fa fa-list-alt mr-1 h5"></i>
                    <span data-feather="file"> Mis encuestas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('enviadas')}}">
                    <i class="fa fa-rocket mr-1 h5"></i>
                    <span data-feather="shopping-cart">Encuestas envidas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('recibidas')}}">
                    <i class="fa fa-file-download mr-2 h5"></i>
                    <span data-feather="users">Encuestas recibidas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('resultados')}}">
                    <i class="fa fa-chart-bar mr-1 h5"></i>
                    <span data-feather="bar-chart-2">Resultados</span>
                </a>
            </li>

        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Agenda</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>

        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('agenda')}}">
                    <i class="fa fa-address-card mr-1 h5"></i>
                    <span data-feather="layers">Contactos</span>  
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('gruposDeTrabajo')}}">
                    <i class="fa fa-users mr-1 h5"></i>
                    <span data-feather="layers"> Grupos de trabajo</span>
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>MAS OPCIONES</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>

        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{route('perfil')}}">
                    <i class="fa fa-user-circle mr-1 h5"></i>
                    <span data-feather="file-text">Perfil</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('ayuda')}}" target="_blank">
                    <i class="fa fa-question-circle mr-1 h5"></i>
                    <span data-feather="file-text">Ayuda</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-active" href="{{ route('info')}}">
                    <i class="fa fa-info-circle mr-1 h5"></i>
                    <span data-feather="file-text">Sobre nosotros</span>
                </a>
            </li>
        </ul>
                        
    </div>
</div>