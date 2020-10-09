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
                <h5 for="name">Nombre Completo</h5>
                <p>{{ $user->name }}</p>
            </div>
            <div>
                <h5 for="name">RUT</h5>
                <p>{{ $profile->rut }}</p>
            </div>
            <div>
                <h5 for="name">Fecha de Nacimiento</h5>
                <p>{{ $profile->birth_date }}</p>
            </div>
            <div>
                <h5 for="name">Edad</h5>
                <p>{{ $age }}</p>
            </div>
            <div>
                <h5 for="name">Sexo</h5>
                <p>{{ $profile->gender }}</p>
            </div>
            <div>
                <h5 for="name">Estado Civil</h5>
                <p>{{ $profile->civil_state }}</p>
            </div>
            <div>
                <h5 for="name">Dirección</h5>
                <p>{{ $profile->address }}</p>
            </div>

            @if($user->country_id == 4)
                <div>
                    <h5 for="name">Región</h5>
                    <p>{{ $user->region->name }}</p>
                </div>
                
                <div>
                    <h5 for="name">Comuna</h5>
                    <p>{{ $user->commune->name }}</p>
                </div>
            @endif

            <div>
                <h5 for="name">Posee Discapacidad</h5>
                <p>{{ $user->commune->name }}</p>
            </div>
            
            <div>
                <h5 for="name">Posee Discapacidad</h5>
                <p>{{ $profile->handicap }}</p>
            </div>  
            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px;">Información de Contacto</h2>
            </div>                           

            <div>
                <h5 for="name">Mail</h5>
                <p>{{ $user->email }}</p>
            </div> 

            <div>
                <h5 for="name">Teléfono Fijo</h5>
                <p>{{ $profile->home_phone }}</p>
            </div> 

            <div>
                <h5 for="name">Teléfono Móvil</h5>
                <p>{{ $profile->phone }}</p>
            </div> 

            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px;">Información Académica</h2>
            </div>   

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Institución</th>
                        <th>Nivel Educacional</th>
                        <th>Campo de Estudio</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha Termino</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($academicBackground as $academic)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $academic->college }}</td>
                            <td>{{ $academic->educational_level }}</td>
                            <td>{{ $academic->study_field }}</td>
                            <td>{{ Carbon\Carbon::parse($academic->start_date)->format("d-m-Y") }}</td>
                            <td>{{ Carbon\Carbon::parse($academic->end_date)->format("d-m-Y") }}</td>
                            <td>{{ $academic->state }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

                                
                        
    </body>
</html>