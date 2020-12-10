<!DOCTYPE html>
<html lang="en">
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

        <title>Encontré Trabajo</title>
    </head>
    <body>
        <section class="perfil">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-barra-menu-perfil">
                        <div class="content-barra-menu-perfil-logo">
                            <img class="img-menu-perfil" src="{{ asset('user/assets/img/Logo-blanco.png') }}" alt="">
                        </div>
                        <div class="content-barra-menu-perfil-menu">
                            <div class="content-barra-menu-perfil-menu-monitor">
                                <ul>
                                    <li><a href="{{ url('/home') }}">Inicio</a></li>

                                </ul>
                            </div>
                            <div class="dropdown d-none-c responsive">
                            <button type="button" class="btn btn-primary dropdown-toggle button-user user-b menu-user" data-toggle="dropdown" onclick="toggleUserDropdown()"> 
                            <img class="img-user-icon" src="{{ asset('user/assets/img/user-b.png') }}" alt="">
                        </button>
                        <div class="dropdown-menu user-dropdown">
                            <ul>    
                                    @if(\Auth::user()->role_id > 1)
                                    <li><a class="dropdown-item" href="{{ url('/home') }}">Inicio</a></li>
                                    @else
                                    <li><a class="dropdown-item" href="{{ url('/admin/dashboard') }}">Inicio</a></li>
                                    @endif
                            </ul>
                        </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @yield("content")
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
    <!-- <script src="{{ asset('user/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script> -->
    <script>
        $(document).ready(function(){
            alertify.set('notifier','position', 'top-right');
        })
        // Access instance of plugin
        //$('.date-picker').data('datepicker')
    </script>
    <script>

        function toggleUserDropdown(){
            
            if($(".user-dropdown").hasClass("show")){
                $(".user-dropdown").removeClass("show")
            }else{
                $(".user-dropdown").addClass("show")
            }
        }
    </script>

        @stack('scripts')

    </body>
</html>