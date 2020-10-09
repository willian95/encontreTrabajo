<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        
        <p class="text-center">
            <img src="{{ $user->image }}" alt="" style="width: 120px;">
        </p>


            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px;">Antecedentes básicos</h2>
            </div>
            <div>
                <p for="name">Nombre Completo</p>
                <h5>{{ $user->name }}</h5>
            </div>
            <div>
                <p for="name">RUT</p>
                <h5>{{ $profile->rut }}</h5>
            </div>
            <div>
                <p for="name">Fecha de Nacimiento</p>
                <h5>{{ $profile->birth_date }}</h5>
            </div>
            <div>
                <p for="name">Edad</p>
                <h5>{{ $age }}</h5>
            </div>
            <div>
                <p for="name">Sexo</p>
                <h5>{{ $profile->gender }}</h5>
            </div>
            <div>
                <p for="name">Estado Civil</p>
                <h5>{{ $profile->civil_state }}</h5>
            </div>
            <div>
                <p for="name">Dirección</p>
                <h5>{{ $profile->address }}</h5>
            </div>

            @if($user->country_id == 4)
                <div>
                    <p for="name">Región</p>
                    <h5>{{ $user->region->name }}</h5>
                </div>
                
                <div>
                    <p for="name">Comuna</p>
                    <h5>{{ $user->commune->name }}</h5>
                </div>
            @endif

            <div>
                <p for="name">Posee Discapacidad</p>
                <h5>{{ $user->commune->name }}</h5>
            </div>
            
            <div class="col-md-8 offset-md-2 pb-20">
                <p for="name">Posee Discapacidad</p>
                <h5>{{ $profile->handicap }}</h5>
            </div>                             
                                
                        
    </body>
</html>