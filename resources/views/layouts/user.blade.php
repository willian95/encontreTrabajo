<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/alertify/css/alertify.css') }}" >
    <link rel="stylesheet" href="{{ asset('/alertify/css/themes/bootstrap.css') }}" >
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.css') }}" >
    <link rel="icon" href="{{ asset('user/assets/img/Logo-azul.png') }}" type="image/x-icon">

    <title>Encontré Trabajo</title>
</head>
    <body>
    
    <section class="section-content-user">
        <div class="div_section-content-user row">
            <div class="col-md-3 content-inf-user f-b">
                <div class="content div-content-inf-user">
                    <div class="div-content-inf-user-img"> 
                        <img class="img-user" src="{{ Auth::user()->image }}" alt="">
                    </div>
                    <div><h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3></div>
                    <div class="options-panel-user">
                        <ul>
                            <li><a href="{{ url('/home') }}">Inicio</a></li>
                            @if(\Auth::user()->role_id == 2)
                                <li><a href="{{ url('/profile/user') }}">Mi perfil</a></li>
                            @elseif(\Auth::user()->role_id == 3)
                                <li><a href="{{ url('/profile/business') }}">Mi perfil</a></li>
                            @endif

                            @if(\Auth::user()->role_id == 3)
                                <li><a href="{{ url('/offers/create') }}">Crear oferta</a></li>
                                <li><a href="{{ url('/plans/available') }}">Planes</a></li>
                            @endif
                            <li><a href="#">Opcion 2</a></li>
                            <li><a href="#">Opcion 3</a></li>
                            <li><a href="#">Opcion 4</a></li>
                        </ul>
                        <div class="dropdown d-none-c responsive">
                            <button type="button" class="btn btn-primary dropdown-toggle button-user" data-toggle="dropdown" onclick="toggleUserDropdown()">
                                    <img class="img-menu" src="{{ asset('user/assets/img/menu-icon.png') }}" alt="">
                                    Menú
                            </button>
                            <div class="dropdown-menu user-dropdown">
                                <a class="dropdown-item" href="{{ url('/logout') }}">Cerrar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 content-inf-work">
                <div class="content-barra-m">
                    <div class="search-content">
                        <form class="form-inline form-search-content">
                            <input class="form-control form-control-sm " type="text" placeholder="Buscar"
                                aria-label="Search">
                            <img class="img-barra-search" src="{{ asset('user/assets/img/search.png') }}" alt="">
                            </form>
                    </div>
                    <div class="dropdown p-rigth">
                        <button type="button" class="btn btn-primary dropdown-toggle button-user user-b" data-toggle="dropdown" onclick="toggleUserDropdown()"> 
                            <img class="img-user-icon" src="{{ asset('user/assets/img/user-b.png') }}" alt="">
                        </button>
                        <div class="dropdown-menu user-dropdown">
                            <a class="dropdown-item" href="{{ url('/logout') }}">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
                <div class="content-work-options">
                    <div class="content-content-work-options">
                        @yield("content")
                    </div>
                </div>
            </div>
        </div>
    </section>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <script src="{{ asset('/alertify/alertify.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script>
            alertify.set('notifier','position', 'top-right');
        </script>

        @stack('scripts')

        <script>

            function toggleUserDropdown(){
                
                if($(".user-dropdown").hasClass("show")){
                    $(".user-dropdown").removeClass("show")
                }else{
                    $(".user-dropdown").addClass("show")
                }
            }

        </script>

    </body>
</html>