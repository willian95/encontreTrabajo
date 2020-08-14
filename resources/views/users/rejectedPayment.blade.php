<html>

    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">

    </head>
    <body>
        
        <div class="container">

            <div class="row">

                <div class="col-12">
                    <h2 class="text-center">Pago rechazado</h2>

                    <p class="text-center">
                        <button class="btn btn-info" onclick="accept()">Aceptar</button>
                    </p>

                </div>

            </div>

        </div>

        <script>

            function accept(){
                localStorage.setItem("paymentStatusTrabajo", "rechazado")
                window.close()
            }

        </script>

    </body>
</html>