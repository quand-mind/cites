<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand" href="/solicitante/permissions/">Trámites de Permisos y Autorizaciones</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                 {{ Auth::user()->username }}<span class="caret"></span> 
                 {{--Cliente<span class="caret"></span>--}}
                </a>

                <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('solicitante/editUser') }}">
                        <i class="fas fa-user-edit mr-2"></i>{{ __('Editar Usuario') }}
                    </a>
                    <a class="dropdown-item" href="{{ url('solicitante/logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ url('solicitante/logout') }}" method="GET" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
</header>
