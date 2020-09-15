
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
                            <button class="caja-input-buscador-usuario_button"><img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/search-b.png') }}" alt="buscar"></button>                        
                        </div>
                        <div class="caja-ico-mensaje">
                            <img class="caja-input-buscador-usuario-lupa_img" src="{{ asset('user/assets/img/chat.png') }}" alt="chat">
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
                          <div class="menu-lateral-usuario-resp">
                            <div class="content-encontre-trabajo-caja-info">
                              <div class="content-encontre-trabajo-caja-info-img-porc">
                                  <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>100%</p></span>
                                  <img class="content-encontre-trabajo-caja-info_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="foto usuario">
                              </div>
                                <h3 class="content-encontre-trabajo-caja-info_h3">Nombre</h3>
                                <h4 class="content-encontre-trabajo-caja-info_h4">@Nombre</h4>
                            </div>
                              <ul class="menu-lateral-usuario_ul">
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Curriculum vitae</p></a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-usuario.png') }}" alt=""><p>Mi cuenta</p></a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/control.png') }}" alt=""><p>Mis postulaciones</p></a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/play.png') }}" alt=""><p>Subir video presentación</p></a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt=""><p>Notificaciones</p></a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt=""><p>Cambiar contraseña</p></a></li>
                                <li class="menu-lateral-usuario_ul_li menu-resp-li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/logout.png') }}" alt=""><p>Cerrar sesión</p></a></li>
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
            <div class="col-md-2 d-n-768">
              <div class="menu-lateral-usuario">
                  <div class="content-encontre-trabajo-caja-info">
                     <div class="content-encontre-trabajo-caja-info-img-porc">
                        <span class="content-encontre-trabajo-caja-info-img-porc_span"><p>100%</p></span>
                        <img class="content-encontre-trabajo-caja-info_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="foto usuario">
                     </div>
                      <h3 class="content-encontre-trabajo-caja-info_h3">Nombre</h3>
                      <h4 class="content-encontre-trabajo-caja-info_h4">@Nombre</h4>
                  </div>
                  <ul class="menu-lateral-usuario_ul">
                    <li class="menu-lateral-usuario_ul_li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-editar.png') }}" alt=""><p>Curriculum vitae</p></a></li>
                    <li class="menu-lateral-usuario_ul_li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/ico-usuario.png') }}" alt=""><p>Mi cuenta</p></a></li>
                    <li class="menu-lateral-usuario_ul_li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/control.png') }}" alt=""><p>Mis postulaciones</p></a></li>
                    <li class="menu-lateral-usuario_ul_li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/play.png') }}" alt=""><p>Subir video presentación</p></a></li>
                    <li class="menu-lateral-usuario_ul_li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt=""><p>Notificaciones</p></a></li>
                    <li class="menu-lateral-usuario_ul_li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/alarm.png') }}" alt=""><p>Cambiar contraseña</p></a></li>
                    <li class="menu-lateral-usuario_ul_li" ><a href="#"> <img class="menu-lateral-usuario_ul_li_img" src="{{ asset('user/assets/img/logout.png') }}" alt=""><p>Cerrar sesión</p></a></li>
                  </ul>
              </div>
              <div class="caja-verde-usuario"></div>

            </div>
            <div class="col-md-10 w-100">
              <div class="container">
                <div class="opciones-perfil-encontre-trabajo-usuario">
                  <div class="row">
                    <div class="col-md-12 opciones-perfil-encontre-trabajo-usuario-info">
                      <div class="porcentaje-perfil-encontre-trabajo-usuario">
                        100%
                      </div> 
                      <div class="opciones-perfil-encontre-trabajo-usuario-ul">
                        <ul class="opciones-perfil-encontre-trabajo-usuario_ul">
                          <li class="opciones-perfil-encontre-trabajo-usuario_li"><h6>✔</h6><p class="opciones-perfil-encontre-trabajo-usuario_li_p">Adjuntaste  tu CV</p></li>
                          <li class="opciones-perfil-encontre-trabajo-usuario_li"><h6>✔</h6><p class="opciones-perfil-encontre-trabajo-usuario_li_p">Adjuntaste tu foto</p></li>
                          <li class="opciones-perfil-encontre-trabajo-usuario_li"><h6>✔</h6><p class="opciones-perfil-encontre-trabajo-usuario_li_p">RUT</p></li>
                          <li class="opciones-perfil-encontre-trabajo-usuario_li"><h6>✔</h6><p class="opciones-perfil-encontre-trabajo-usuario_li_p">Celular</p></li>
                          <li class="opciones-perfil-encontre-trabajo-usuario_li"><h6>✔</h6><p class="opciones-perfil-encontre-trabajo-usuario_li_p">Referencias Laborales</p></li>
                          <li class="opciones-perfil-encontre-trabajo-usuario_li"><h6>✔</h6><p class="opciones-perfil-encontre-trabajo-usuario_li_p">Resumen Educacional</p></li>
                          <li class="opciones-perfil-encontre-trabajo-usuario_li bb-n"><h6>✔</h6><p class="opciones-perfil-encontre-trabajo-usuario_li_p">Dirección</p></li>
                        </ul>
                      </div>                 
                    </div>
                    <div class="col-md-12 opciones-perfil-encontre-trabajo-usuario-cajapublicitaria">
                      <div class="opciones-perfil-encontre-trabajo-usuario-publicidad">
                      <div class="alert  alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <img class="opciones-perfil-encontre-trabajo-usuario-publicidad_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="">
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil">
                          <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-head">
                            <h4>Perfil</h4>
                             <img src="{{ asset('user/assets/img/ico-editar.png') }}" alt="">
                          </div>
                          <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil-inf">
                            <h5 class="cajas-contenedoras-perfil_h5">Nombre:</h5>
                            <p class="cajas-contenedoras-perfil_p">Ana Smith</p>
                            <h5 class="cajas-contenedoras-perfil_h5">Genero:</h5>
                            <p class="cajas-contenedoras-perfil_p">Femenino</p>
                            <h5 class="cajas-contenedoras-perfil_h5">Nacionalidad:</h5>
                            <p class="cajas-contenedoras-perfil_p">Chilena</p>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil">
                          <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-head">
                            <h4>Postulaciones</h4>
                             <img src="{{ asset('user/assets/img/control.png') }}" alt="">
                          </div>
                          <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil-inf">
                            <h5 class="cajas-contenedoras-postulaciones_h5">Analista Senior de RRHH</h5>
                            <h5 class="cajas-contenedoras-postulaciones_h5">Analista de Recursos Humanos</h5>
                            <h5 class="cajas-contenedoras-postulaciones_h5">Jefe de RRHH</h5>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil">
                          <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-head">
                            <h4>Estadisticas</h4>
                             <img src="{{ asset('user/assets/img/control.png') }}" alt="">
                          </div>
                          <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil-inf">
                            <h5 class="cajas-contenedoras-estadisticas_h5">Postulaciones:</h5>
                            <p class="cajas-contenedoras-estadisticas_p">5</p>
                            <h5 class="cajas-contenedoras-estadisticas_h5">Empresas distintas:</h5>
                            <p class="cajas-contenedoras-estadisticas_p">2</p>
                            <h5 class="cajas-contenedoras-estadisticas_h5">Ofertas guardadas:</h5>
                            <p class="cajas-contenedoras-estadisticas_p">42</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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