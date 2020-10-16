
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('user/assets/css/bootstrap.min.css') }}"> -->

    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/alertify/css/alertify.css') }}" >
    <link rel="stylesheet" href="{{ asset('/alertify/css/themes/bootstrap.css') }}" >
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.css') }}" >
    <link rel="icon" href="{{ asset('user/assets/img/Logo-azul.png') }}" type="image/x-icon">
    @stack("css")

    <title>Encontré Trabajo</title>

</head>
<style>
.hamburger {
  position: fixed;
  background-color: transparent;
  right: 30px;
  top: 0;
  /* height: 30px;
  width: 30px; */
  height: 90px;
  display: flex;
  flex-direction: column;
  justify-content: center;
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
  background-color:#0075a9;
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
/* #188a75 */

</style>

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
                        {{--<div class="caja-ico-mensaje">
                            <img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/chat.png') }}" alt="chat">
                            <span class="caja-ico-mensaje_span">1</span>
                        </div>--}}
                        <div class="caja-input-buscador-usuario d-n-991">
                            <!--<input class="caja-input-buscador-usuario_input" type="text" placeholder="Busca tus ofertas de trabajo" id="search_input">
                            <button class="caja-input-buscador-usuario_button" onclick="storeQuery()"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="buscar"></button>-->
                            <select class="caja-input-buscador-usuario_input" id="job_category_id">
                                <option>Buscador a usuarios por sus categorías</option>
                                @foreach(App\JobCategory::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button class="caja-input-buscador-usuario_button" onclick="storeQuery()"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="buscar"></button>
                        </div>
                        
                        <div class="cont-menu-h-usuario">

                        <div class="hamburger">
                            <div class="_layer -top"></div>
                            <div class="_layer -mid"></div>
                            <div class="_layer -bottom"></div>
                        </div>
                        <nav class="menuppal">
                        <div class="menu-lateral-empresa-resp">
                        <div class="content-encontre-trabajo-caja-info">
                            <div class="caja-input-buscador-usuario mb-3">
                                <!--<input class="caja-input-buscador-usuario_input" type="text" placeholder="Busca tus ofertas de trabajo" id="search_input">
                                <button class="caja-input-buscador-usuario_button" onclick="storeQuery()"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="buscar"></button>-->
                                <select class="caja-input-buscador-usuario_input" id="job_category_id">
                                    <option>Buscador a usuarios por sus categorías</option>
                                    @foreach(App\JobCategory::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button class="caja-input-buscador-usuario_button" onclick="storeQuery()"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="buscar"></button>
                            </div> 

                            <div class="content-encontre-trabajo-caja-info-img-porc">
                                @php
                                    $profile = App\Profile::where("user_id", Auth::user()->id)->first();
                                    $profile_percentage = 0;

                                    if(\Auth::user()->image != url('/')."images/users/default.jpg"){
                                        $profile_percentage += 25;
                                    }
                                    if(\Auth::user()->commune_id != null){
                                        $profile_percentage += 25;
                                    }
                                    if(\Auth::user()->region_id != null){
                                        $profile_percentage += 25;
                                    }

                                    if($profile->address != null){
                                        $profile_percentage += 25;
                                    }

                                @endphp
                                <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>{{ $profile_percentage }}%</p></span>
                                <img class="content-encontre-trabajo-caja-info_img" src="{{ Auth::user()->image }}" alt="foto">
                            </div>
                            <h3 class="content-encontre-trabajo-caja-info_h3 empresa_h3">{{ Auth::user()->business_name }}</h3>
                            <h4 class="content-encontre-trabajo-caja-info_h4 empresa_h4">{{Auth::user()->email }}</h4>

                            <ul class="menu-lateral-usuario_ul">
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/home') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-usuario.png') }}" alt="">Inicio</a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/profile/business') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-usuario.png') }}" alt="">Mi perfil</a></li>
                                
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/plans/available') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/control.png') }}" alt="">Planes</a></li>
                                @if(\Auth::user()->is_profile_complete == 1)
                                    <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/offers/create') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/play.png') }}" alt="">Crear oferta</a></li>
                                @endif
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/my-offers') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt="">Mis ofertas</a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/my-proposals') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt="">Ofertas respondidas</a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/logout') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/logout.png') }}" alt="">Cerrar sesión</a></li>
                            </ul>
                    
                        </div>

                            <!-- <div class="opciones-menu-resp-empresas">
                                <div class="buscador-barra-lateral-empresa m-bottom caja-menu-resp-empresa">
                                    <div class="buscador-barra-lateral-empresa-head">
                                        <img class="buscador-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="">
                                        <p>Titulo del aviso</p>
                                    </div>
                                    <div class="buscador-barra-lateral-empresa-head-bucador">
                                            <input class="buscador-barra-lateral-empresa-head-bucador_input" type="text" placeholder="Titulo">
                                            <button class="buscador-barra-lateral-empresa-head-bucador_button"><img class="buscador-barra-lateral-empresa-head-bucador_button_img" src="{{ asset('user/assets/img/search-b.png') }}" alt=""></button>
                                    </div>
                                </div>
                                <div class="check-barra-lateral-empresa m-bottom caja-menu-resp-empresa">
                                    <div class="check-barra-lateral-empresa-head">
                                    <img class="check-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search.png') }}" alt="">
                                        <p>Estado del aviso</p>
                                    </div>
                                    <div class="informacion-empresa-encontre-trabajo">
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Activos</label>
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Vencidos</label>
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Archivados</label>
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Rechazados</label>
                                </div>
                                </div>
                                <div class="check-barra-lateral-empresa m-bottom caja-menu-resp-empresa">
                                    <div class="check-barra-lateral-empresa-head">
                                    <img class="check-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search.png') }}" alt="">
                                        <p>Profesionales</p>
                                    </div>
                                    <div class="informacion-empresa-encontre-trabajo">
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Administración</label>
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Atención al cliente</label>
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Calicenter</label>
                                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Compras</label>
                                </div>
                                </div>

                          </div>  -->
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
              <div class="menu-lateral-empresa">
                  <div class="content-encontre-trabajo-caja-info">
                     <div class="content-encontre-trabajo-caja-info-img-porc">
                        @php
                            $profile = App\Profile::where("user_id", Auth::user()->id)->first();
                            $profile_percentage = 0;

                            if(\Auth::user()->image != url('/')."images/users/default.jpg"){
                                $profile_percentage += 25;
                            }
                            if(\Auth::user()->commune_id != null){
                                $profile_percentage += 25;
                            }
                            if(\Auth::user()->region_id != null){
                                $profile_percentage += 25;
                            }

                            if($profile->address != null){
                                $profile_percentage += 25;
                            }

                        @endphp
                        <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>{{ $profile_percentage }}%</p></span>
                        <img class="content-encontre-trabajo-caja-info_img" src="{{ Auth::user()->image }}" alt="foto usuario">
                     </div>
                      <h3 class="content-encontre-trabajo-caja-info_h3 empresa_h3">{{ Auth::user()->business_name }}</h3>
                      <h4 class="content-encontre-trabajo-caja-info_h4 empresa_h4">{{Auth::user()->email }}</h4>
                  </div>
                    <ul class="menu-lateral-usuario_ul">
                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/home') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-usuario.png') }}" alt="">Inicio</a></li>
                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/profile/business') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-usuario.png') }}" alt="">Mi perfil</a></li>
                        
                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/plans/available') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/control.png') }}" alt="">Planes</a></li>
                        @if(\Auth::user()->is_profile_complete == 1)
                            <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/offers/create') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/play.png') }}" alt="">Crear oferta</a></li>
                        @endif
                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/my-offers') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt="">Mis ofertas</a></li>
                        <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="{{ url('/my-proposals') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt="">Ofertas respondidas</a></li>
                        <li class="menu-lateral-usuario_ul_li" ><a href="{{ url('/logout') }}"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/logout.png') }}" alt="">Cerrar sesión</a></li>
                    </ul>
                {{--<div class="buscador-barra-lateral-empresa m-bottom">
                      <div class="buscador-barra-lateral-empresa-head">
                        <img class="buscador-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="">
                        <p>Titulo del aviso</p>
                      </div>
                      <div class="buscador-barra-lateral-empresa-head-bucador">
                            <input class="buscador-barra-lateral-empresa-head-bucador_input" type="text" placeholder="Titulo">
                            <button class="buscador-barra-lateral-empresa-head-bucador_button"><img class="buscador-barra-lateral-empresa-head-bucador_button_img" src="{{ asset('user/assets/img/search-b.png') }}" alt=""></button>
                      </div>
                </div>
                <div class="check-barra-lateral-empresa m-bottom">
                    <div class="check-barra-lateral-empresa-head">
                    <img class="check-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search.png') }}" alt="">
                        <p>Estado del aviso</p>
                    </div>
                    <div class="informacion-empresa-encontre-trabajo">
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Activos</label>
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Vencidos</label>
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Archivados</label>
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Rechazados</label>
                 </div>
                </div>
                <div class="check-barra-lateral-empresa m-bottom">
                    <div class="check-barra-lateral-empresa-head">
                    <img class="check-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search.png') }}" alt="">
                        <p>Profesionales</p>
                    </div>
                    <div class="informacion-empresa-encontre-trabajo">
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Administración</label>
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Atención al cliente</label>
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Calicenter</label>
                    <label class="check-empresa-encontre-trabajo"><input class="check-empresa-encontre-trabajo_input" type="checkbox"  value="" >Compras</label>
                 </div>
                </div>--}}
                 
              </div>
              <div class="caja-verde-usuario"></div>

            </div>
            @yield("content")
          </div>
    </div>
  </section>

        <!-- <link rel="stylesheet" href="{{ asset('user/assets/js/bootstrap.min.js') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/js/jquery.min.js') }}"> -->


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

            function storeQuery(){
           
                let query = $("#job_category_id").val()
                if(query != null){
                    localStorage.setItem("encontre_trabajo_categories_query", query)
                    window.location.href="{{ url('/business/search') }}"
                }
                
            }

        </script>
        <script>
        // selector
            var menu = document.querySelector(".hamburger");

            // method
            function toggleMenu(event) {
            this.classList.toggle("is-active");
            document.querySelector(".menuppal").classList.toggle("is_active");
            event.preventDefault();
            }

            // event
            menu.addEventListener("click", toggleMenu, false);

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