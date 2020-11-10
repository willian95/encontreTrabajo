<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/alertify/css/alertify.css') }}" >
    <link rel="stylesheet" href="{{ asset('/alertify/css/themes/bootstrap.css') }}" >
    <link rel="icon" href="{{ asset('user/assets/img/Logo-azul.png') }}" type="image/x-icon">
    <!-- <link href="{{ asset('user/assets/css/bootstrap.min.css') }}" rel="stylesheet" /> -->

    <title>Encontré Trabajo</title>
</head>
    <body>
    
        @yield("content")

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
            alertify.set('notifier','position', 'top-right');
        </script>

        @stack('scripts')

    </body>
</html>