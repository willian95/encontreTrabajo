<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- <link href="{{ asset('user/assets/css/bootstrap.min.css') }}" rel="stylesheet" /> -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/alertify/css/alertify.css') }}" >
    <link rel="stylesheet" href="{{ asset('/alertify/css/themes/bootstrap.css') }}" >
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.css') }}" >
    <link rel="icon" href="{{ asset('user/assets/img/Logo-azul.png') }}" type="image/x-icon">

    <style>
        .hamburger {
            position: fixed;
            background-color: transparent;
            right: 30px;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 90px;
            /* height: 30px;
            width: 30px; */
            padding: 20px 20px;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            -webkit-transition: -webkit-transform 0.25s
                cubic-bezier(0.05, 1.04, 0.72, 0.98);
            transition: transform 0.25s cubic-bezier(0.05, 1.04, 0.72, 0.98);
            z-index: 1002;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .hamburger.is-active {
            background-color: none;
        }
        ._layer {
            background: #fff;
            margin-bottom: 4px;
            border-radius: 2px;
            width: 28px;
            height: 4px;
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            -webkit-transition: all 0.25s cubic-bezier(0.05, 1.04, 0.72, 0.98);
            transition: all 0.25s cubic-bezier(0.05, 1.04, 0.72, 0.98);
        }
        .hamburger:hover .-top {
            -webkit-transform: translateY(-100%);
            -ms-transform: translateY(-100%);
            transform: translateY(-100%);
        }
        .hamburger:hover .-bottom {
            -webkit-transform: translateY(100%);
            -ms-transform: translateY(100%);
            transform: translateY(100%);
        }
        .hamburger.is-active .-top {
            -webkit-transform: translateY(200%) rotate(45deg) !important;
            -ms-transform: translateY(200%) rotate(45deg) !important;
            transform: translateY(200%) rotate(45deg) !important;
        }
        .hamburger.is-active .-mid {
            opacity: 0;
        }
        .hamburger.is-active .-bottom {
            -webkit-transform: translateY(-200%) rotate(135deg) !important;
            -ms-transform: translateY(-200%) rotate(135deg) !important;
            transform: translateY(-200%) rotate(135deg) !important;
        }

        .menuppal.is_active {
            transform: translate3d(0px, 0px, 0px);
        }
        .menuppal {
            background-color: #0075a9;
            bottom: 0;
            height: 100%;
            right: 0;
            overflow-y: scroll;
            position: fixed;
            top: 0;
            transform: translate3d(0px, -100%, 0px);
            transition: transform 0.35s cubic-bezier(0.05, 1.04, 0.72, 0.98) 0s;
            width: 65%;
            z-index: 1001;
        }
        .menuppal ul {
            margin: 0;
            padding: 0;
        }
        .menuppal ul li {
            list-style: none;
            text-align: center;
            font-family: Verdadna, Arial, Helvetica;
            color: $nav-color-text;
            font-size: 1.5rem;
            line-height: 3em;
            height: 3em;
            color: #369;
            text-transform: none;
            font-weight: bold;
        }
        .menuppal ul li a {
            text-decoration: none;
            color: #fff;
        }
        .menuppal ul li a:hover {
            text-decoration: none;
            color: #333;
        }
        @media (max-width: 320px) {
    .menuppal {
        width: 80%!important;
    }}
    </style>

    @stack("css")
    

    <title>Encontré Trabajo</title>

</head>

    <body>
    
    <section class="encontre-trabajo-usuario">
        <div class="row encontre-trabajo-usuario_row">
            <div class="col-md-12 encontre-trabajo-usuario_row-col-12">
                <div class="row">
                    <div class="col-md-4 col-logo-usuario">
                        <div class="encontre-trabajo-usuario_row-col-12-logo-col-4">
                            <img class="encontre-trabajo-usuario_row-col-12-logo-img" src="{{ asset('user/assets/img/Logo-blanco.png') }}" alt="logo">
                        </div>
                    </div> 
                    <div class="col-md-8 f-a-c">
                        <div class="encontre-trabajo-usuario_row-col-12-col-4">
                           {{--<div class="d-flex">
                                <select class="form-control" id="search_input">
                                    <option value="0">Seleccione</option>
                                    @foreach(App\JobCategory::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button class="caja-input-buscador-usuario_button" onclick="storeQuery()"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="buscar"></button>                        
                            </div>--}}
                            {{--<div class="caja-ico-mensaje">
                                <img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/chat.png') }}" alt="chat">
                                <span class="caja-ico-mensaje_span">1</span>
                            </div>--}}
                            <!-- <h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3> -->
                            <!-- <img class="encontre-trabajo-usuario_row-img-usuario_img" src="{{ Auth::user()->image }}" alt="foto de usuario"> -->
                            <div class="cont-menu-h-usuario">

                            <div class="hamburger">
                                <div class="_layer -top"></div>
                                <div class="_layer -mid"></div>
                                <div class="_layer -bottom"></div>
                            </div>
                            <nav class="menuppal">
                                <div class="menu-lateral-usuario-resp ">
                                <!-- <img class="encontre-trabajo-usuario_row-col-12-logo-img" src="{{ asset('user/assets/img/Logo-blanco.png') }}" alt="logo"> -->
                                    <!--<div class="caja-input-buscador-usuario ">
                                        <input class="caja-input-buscador-usuario_input" type="text" placeholder="Busca tu nuevo trabajo" id="search_input">
                                        <button class="caja-input-buscador-usuario_button" onclick="storeQuery()"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="buscar"></button>                        
                                    </div>-->
                                <!--porcentaje , nombre y correo-->
                                <div class="content-encontre-trabajo-caja-info">
                                <div class="content-encontre-trabajo-caja-info-img-porc mt-3">
                                @php
                                    $profile = App\Profile::where("user_id", Auth::user()->id)->first();
                                    $profile_percentage = 0;

                                    if(\Auth::user()->image != url('/')."/images/users/default.jpg"){
                                        $profile_percentage += 12.5;
                                    }
                                    if($profile->video != null){
                                        $profile_percentage += 12.5;
                                    }
                                    if($profile->curriculum != null){
                                        $profile_percentage += 12.5;
                                    }
                                    if($profile->address != null){
                                        $profile_percentage += 12.5;
                                    }
                                    if(App\AcademicBackground::where("user_id", \Auth::user()->id)->count() > 0){
                                        $profile_percentage += 12.5;
                                    }

                                    if($profile->phone != null){
                                        $profile_percentage += 12.5;
                                    }

                                    if($profile->knowledge_habilities != null){
                                        $profile_percentage += 12.5;
                                    }

                                    if($profile->job_description != null){
                                        $profile_percentage += 12.5;
                                    }

                                @endphp
                                
                                <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>{{ $profile_percentage }} %</p></span>
                                <img class="content-encontre-trabajo-caja-info_img" src="{{ Auth::user()->image }}" alt="foto usuario">
                            </div>
                                    
                                    <h3 class="content-encontre-trabajo-caja-info_h3">{{ \Auth::user()->name }}</h3>
                                    <h3 class="content-encontre-trabajo-caja-info_h3" style="margin-top: -24px;">{{ \Auth::user()->lastname }}</h3>
                                    {{--<h4 class="content-encontre-trabajo-caja-info_h4">{{ Auth::user()->email }}</h4>--}}
                                </div>
                                    

                                <!--opciones del menu responsive-->
                                    
                                    <ul class="menu-lateral-usuario_ul">
                                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('home') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Inicio</p></a></li>
                                        {{--<li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/user/offer') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Ofertas</p></a></li>--}}
                                        
                                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/profile/user') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Mi perfil</p></a></li>
                                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/my-references') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Referencias laborales</p></a></li>
                                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/profile/show/'.\Auth::user()->id) }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Mi Currículum</p></a></li>
                                        <li class="menu-lateral-usuario_ul_li" style="margin-top: -20px; margin-bottom: -30px;"><a href="{{ url('/search') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Buscar empleo</p></a></li>
                                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/my-applies') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/control.png') }}" alt=""><p>Mis postulaciones</p></a></li>
                                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/logout') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/logout.png') }}" alt=""><p>Cerrar sesión</p></a></li>
                                    </ul>
                                    
                                </div>
                            </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-encontre-trabajo-usuario">
            <div class="row">
                <div class="col-md-2 d-n-991">
                    <div class="menu-lateral-usuario">
                        <div class="content-encontre-trabajo-caja-info">
                            <div class="content-encontre-trabajo-caja-info-img-porc">
                                @php
                                    $profile = App\Profile::where("user_id", Auth::user()->id)->first();
                                    $profile_percentage = 0;

                                    if(\Auth::user()->image != url('/')."/images/users/default.jpg"){
                                        $profile_percentage += 20;
                                    }
                                    if($profile->video != null){
                                        $profile_percentage += 20;
                                    }
                                    if($profile->curriculum != null){
                                        $profile_percentage += 20;
                                    }
                                    if($profile->address != null){
                                        $profile_percentage += 20;
                                    }
                                    if(App\AcademicBackground::where("user_id", \Auth::user()->id)->count() > 0){
                                        $profile_percentage += 20;
                                    }

                                @endphp
                                
                                <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>{{ $profile_percentage }} %</p></span>
                                <img class="content-encontre-trabajo-caja-info_img" src="{{ Auth::user()->image }}" alt="foto usuario">
                            </div>
                                <h3 class="content-encontre-trabajo-caja-info_h3">{{ \Auth::user()->name }}</h3>
                                <h3 class="content-encontre-trabajo-caja-info_h3" style="margin-top: -24px;">{{ \Auth::user()->lastname }}</h3>
                            {{--<h4 class="content-encontre-trabajo-caja-info_h4">{{ Auth::user()->email }}</h4>--}}
                        </div>
                            <ul class="menu-lateral-usuario_ul">
                                <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('home') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Inicio</p></a></li>
                                {{--<li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/user/offer') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Ofertas</p></a></li>--}}
                                
                                <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/profile/user') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Mi perfil</p></a></li>
                                <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/my-references') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Referencias laborales</p></a></li>

                                

                                <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/profile/show/'.\Auth::user()->id) }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Mi Currículum</p></a></li>
                                <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/search') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Buscar empleo</p></a></li>
                                <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/my-applies') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/control.png') }}" alt=""><p>Mis postulaciones</p></a></li>
                                <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/logout') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/logout.png') }}" alt=""><p>Cerrar sesión</p></a></li>
                            </ul>
                    </div>
                <div class="caja-verde-usuario"></div>

                </div>
                @yield('content')
            </div>
        </div>
        
        {{--<div class="div_section-content-user row">
            <div class="col-md-2 content-inf-user f-b">
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
                                <li><a href="{{ url('/my-references') }}">Referencias laborales</a></li>
                                <li><a href="{{ url('/my-applies') }}">Mis aplicaciones</a></li>
                            @endif
                            
    
                        </ul>
                        <!-- <div class="dropdown d-none-c responsive">
                            <button type="button" class="btn btn-primary dropdown-toggle button-user" data-toggle="dropdown" onclick="toggleUserDropdown()">
                                    <img class="img-menu" src="{{ asset('user/assets/img/menu-icon.png') }}" alt="">
                                    Menú
                            </button>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item" href="{{ url('/logout') }}">Cerrar sesión</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-10 content-inf-work">
                <div class="content-barra-m">
                    @if(\Auth::user()->role_id == 2)
                    <div class="search-content">
                        <form class="form-inline form-search-content">
                            <input id="search_input" class="form-control form-control-sm " type="text" placeholder="Buscar"
                                aria-label="Search">
                            <button type="button" class="btn btn-success" onclick="storeQuery()">
                            <img class="img-barra-search" src="{{ asset('user/assets/img/search.png') }}" alt="">
                            </button>
                        </form>
                    </div>
                    @endif
                    <div class="dropdown p-rigth">
                        <button type="button" class="btn btn-primary dropdown-toggle button-user user-b" data-toggle="dropdown" onclick="toggleUserDropdown()"> 
                            <img class="img-user-icon" src="{{ asset('user/assets/img/user-b.png') }}" alt="">
                        </button>
                        <div class="dropdown-menu user-dropdown">
                            <ul>
                                <li><a class="dropdown-item" href="{{ url('/home') }}">Inicio</a></li>
                                @if(\Auth::user()->role_id == 2)
                                    <li><a class="dropdown-item" href="{{ url('/profile/user') }}">Mi perfil</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/my-applies') }}">Mis aplicaciones</a></li>
                                @elseif(\Auth::user()->role_id == 3)
                                    <li><a class="dropdown-item" href="{{ url('/profile/business') }}">Mi perfil</a></li>
                                @endif
                                

                                @if(\Auth::user()->role_id == 3)
                                    @if(\Auth::user()->is_profile_complete == 1)
                                        <li><a class="dropdown-item" href="{{ url('/offers/create') }}">Crear oferta</a></li>
                                    @endif
                                    <li><a  class="dropdown-item" href="{{ url('/plans/available') }}">Planes</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/my-proposals') }}">Ofertas Respondidas</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ url('/logout') }}">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-work-options">
                    <div class="content-content-work-options">
                    
                        @yield("content")
                    </div>
                </div>
            </div>
        </div>--}}
    </section>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- <script src="{{ asset('user/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script> -->
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

            function storeQuery(){
            
                let query = $("#search_input").val()
                if(query != null){
                    localStorage.setItem("encontre_trabajo_query", query)
                    window.location.href="{{ url('/search') }}"
                }
                
            }

        </script>
        <script>
        // selector
var menu = document.querySelector('.hamburger');

// method
function toggleMenu (event) {
  this.classList.toggle('is-active');
  document.querySelector( ".menuppal" ).classList.toggle("is_active");
  event.preventDefault();
}

// event
menu.addEventListener('click', toggleMenu, false);

//Solución con jQUery
/*$(document).ready(function(){
	$('.hamburger').click(function() {
		$('.hamburger').toggleClass('is-active');
		$('.menuresponsive').toggleClass('is-active');
		return false;
	});
});*/
        </script>

    </body>
</html>