
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
    

    <title>Encontré Trabajo</title>

</head>
<style>
.hamburger {
  position: fixed;
  background-color: transparent;
  right: 30px;
  /* top: 0; */
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
  left: 0;
  overflow-y: scroll;
  position: fixed;
  top: 0;
  transform: translate3d(0px, -100%, 0px);
  transition: transform 0.35s cubic-bezier(0.05, 1.04, 0.72, 0.98) 0s;
  width: 100%;
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
                        <div class="caja-input-buscador-usuario">
                            <input class="caja-input-buscador-usuario_input" type="text" placeholder="Busca tu nuevo trabajo | Ubicacion">
                            <button class="caja-input-buscador-usuario_button"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search.png') }}" alt="buscar"></button>                        
                        </div>
                        <div class="caja-ico-mensaje">
                            <img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search.png') }}" alt="buscar">
                            <span class="caja-ico-mensaje_span">1</span>
                        </div>
                        <h3>Maria</h3>
                        <img class="encontre-trabajo-usuario_row-img-usuario_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="foto de usuario">
                        <div class="cont-menu-h-usuario">

                        <div class="hamburger">
                            <div class="_layer -top"></div>
                            <div class="_layer -mid"></div>
                            <div class="_layer -bottom"></div>
                        </div>
                        <nav class="menuppal">
                        <div class="menu-lateral-empresa-resp">
                            <div class="content-encontre-trabajo-caja-info">
                                <div class="content-encontre-trabajo-caja-info-img-porc">
                                    <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>100%</p></span>
                                    <img class="content-encontre-trabajo-caja-info_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="foto usuario">
                                </div>
                                <h3 class="content-encontre-trabajo-caja-info_h3 empresa_h3">Empresa 1</h3>
                                <h4 class="content-encontre-trabajo-caja-info_h4 empresa_h4">@Nombre</h4>
                            </div>

                            <div class="opciones-menu-resp-empresas">
                                <div class="buscador-barra-lateral-empresa m-bottom">
                                    <div class="buscador-barra-lateral-empresa-head">
                                        <img class="buscador-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search.png') }}" alt="">
                                        <p>Titulo del aviso</p>
                                    </div>
                                    <div class="buscador-barra-lateral-empresa-head-bucador">
                                            <input class="buscador-barra-lateral-empresa-head-bucador_input" type="text" placeholder="Titulo">
                                            <button class="buscador-barra-lateral-empresa-head-bucador_button"><img class="buscador-barra-lateral-empresa-head-bucador_button_img" src="{{ asset('user/assets/img/search.png') }}" alt=""></button>
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
                                </div>

                          </div> 
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
            <div class="col-md-2 d-n-768">
              <div class="menu-lateral-empresa">
                  <div class="content-encontre-trabajo-caja-info">
                     <div class="content-encontre-trabajo-caja-info-img-porc">
                        <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>100%</p></span>
                        <img class="content-encontre-trabajo-caja-info_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="foto usuario">
                     </div>
                      <h3 class="content-encontre-trabajo-caja-info_h3 empresa_h3">Empresa 1</h3>
                      <h4 class="content-encontre-trabajo-caja-info_h4 empresa_h4">@Nombre</h4>
                  </div>
                <div class="buscador-barra-lateral-empresa m-bottom">
                      <div class="buscador-barra-lateral-empresa-head">
                        <img class="buscador-barra-lateral-empresa-head_img" src="{{ asset('user/assets/img/search.png') }}" alt="">
                        <p>Titulo del aviso</p>
                      </div>
                      <div class="buscador-barra-lateral-empresa-head-bucador">
                            <input class="buscador-barra-lateral-empresa-head-bucador_input" type="text" placeholder="Titulo">
                            <button class="buscador-barra-lateral-empresa-head-bucador_button"><img class="buscador-barra-lateral-empresa-head-bucador_button_img" src="{{ asset('user/assets/img/search.png') }}" alt=""></button>
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
                </div>
                 
              </div>
              <div class="caja-verde-usuario"></div>

            </div>
            <div class="col-md-8 w-100">
                <div class="opciones-inf-empresas">
                    <p><a href="#">Inicio</a><span>></span>Mis avisos</p>
                    <h3>Gestión de avisos (0 avisos)</h3>
                    <div class="opciones-inf-empresas-opciones-select">
                       <div class="opciones-inf-empresas-opciones-select-1">
                            <select name="" id="">
                                <option value="">Selecciona una opción</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                            </select>
                       </div>
                       <div class="opciones-inf-empresas-opciones-select-2">
                           <p>Ordenar por</p>
                            <select name="" id="">
                                <option value="">Selecciona una opción</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                            </select>
                       </div>
                       <div class="opciones-inf-empresas-opciones-select-2">
                           <p>Mostrar</p>
                            <select name="" id="">
                                <option value="">Cant.</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                            </select>
                       </div>
                    </div>
                    <div class="opciones-inf-empresas-subt">
                        <div class="sub-localidad">
                        <p>Aviso / Localidad</p>
                        </div>
                        <div class="opciones-inf-empresas-subt-list">
                            <p>Caduca el </p>
                            <p>Inscritos </p>
                            <p >Acciones </p>
                        </div>
                    </div>
                    <div class="caja-mis-avisos">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="caja-mis-avisos-col-2">
                                    <img class="caja-mis-avisos_img" src="{{ asset('user/assets/img/search.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h5>Mis avisos</h5>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis ab modi sapiente, illum cupiditate error quam mollitia iste eligendi adipisci, ipsam facilis iure numquam magnam nulla corrupti sunt dignissimos maiores.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 w-100">
                <div class="contenido-publicitario-empresas">
                <div class="alert  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <img class="contenido-publicitario-empresas_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="">
                </div>
                <div class="alert  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <img class="contenido-publicitario-empresas_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="">
                </div>

                </div>
            </div>
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
                alert("ehy")
                let query = $("#search_input").val()
                if(query != null){
                    localStorage.setItem("encontre_trabajo_query", query)
                    window.location.href="{{ url('/search') }}"
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