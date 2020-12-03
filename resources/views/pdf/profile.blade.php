<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        
        <p>
            <img src="{{ $user->image }}" alt="" style="width: 120px;">
        </p>


            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px; margin-bottom: 15px;">Antecedentes básicos</h2>
            </div>

            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td>
                            <h5 for="name">Nombre Completo</h5>
                            <p>{{ $user->name }} {{ $user->lastname }}</p>
                        </td>
                        <td>
                            <h5 for="name">RUT</h5>
                            <p>{{ $profile->rut ? $profile->rut : "No posee" }}</p>
                        </td>
                        <td>
                            <h5 for="name">Fecha de Nacimiento</h5>
                            <p>{{ Carbon\Carbon::parse($profile->birth_date)->format("d-m-Y") }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 for="name">Edad</h5>
                            <p>{{ $age }}</p>
                        </td>
                        <td>
                            <h5 for="name">Sexo</h5>
                            <p>{{ $profile->gender ? $profile->gender : "N/A" }}</p>
                        </td>
                        <td>
                            <h5 for="name">Estado Civil</h5>
                            <p>{{ $profile->civil_state ? $profile->civil_state : "N/A" }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5 for="name">Dirección</h5>
                            <p>{{ $profile->address ? "":"N/A" }}</p>
                        </td>
                        
                        @if($profile->country_id == 4)
                            <td>
                                <h5 for="name">Región</h5>
                                <p>{{ $user->region->name }}</p>
                            </td>
                            
                            <td>
                                <h5 for="name">Comuna</h5>
                                <p>{{ $user->commune->name }}</p>
                            </td>
                        
                        @endif
                        
                    </tr>
                </tbody>
            </table>

            
            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px; margin-bottom: 15px;">Información de Contacto</h2>
            </div>                           

            <div>
                <h5 for="name">Mail</h5>
                <p>{{ $user->email }}</p>
            </div> 

            @if(strlen($profile->home_phone) > 0)
            <div>
                <h5 for="name">Teléfono Fijo</h5>
                <p>{{ $profile->home_phone }}</p>
            </div> 
            @endif

            @if(strlen($profile->phone) > 0)
            <div>
                <h5 for="name">Teléfono Móvil</h5>
                <p>{{ $profile->phone }}</p>
            </div> 
            @endif

            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px; margin-bottom: 15px;">Información Académica</h2>
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

            <div style="page-break-after: avoid;">
            </div>

            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px; margin-top: 15px;">Resumen Laboral</h2>
            </div>   

            <h5 for="name">Resumen laboral</h5>
                            <p>{{ $profile->job_description ? $profile->job_description : "N/A" }}</p>

           <table style="width:100%;">
                <tbody>
                    <tr>
                       
                        <td>
                            <h5 for="name">Año de experiencia</h5>
                            <p>{{ $profile->experience_year ? $profile->experience_year : "N/A" }}</p>
                        </td>

                        <td>
                            <h5 for="name">Pretenciones de renta</h5>
                            <p>{{ $profile->salary ? $profile->salary : "N/A" }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 for="name">Puesto deseado</h5>
                            <p>{{ $user->desired_job ? $user->desired_job : "N/A" }}</p>
                        </td>
                        <td>
                            <h5 for="name">Areas de preferencia</h5>
                            <p>{{ $desiredAreaString ? $desiredAreaString : "N/A" }}</p>
                        </td>
                        

                    </tr>
                </tbody>
           </table>

           <div style="page-break-after: avoid;">
            </div>


            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px; margin-top: 15px;">Antecedentes Laborales</h2>
            </div>   

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha Término</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobBackground as $job)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $job->company }}</td>
                            <td>{{ $job->job }}</td>
                            <td>{{ Carbon\Carbon::parse($job->start_date)->format("d-m-Y") }}</td>
                            <td>{{ Carbon\Carbon::parse($job->end_date)->format("d-m-Y") }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 

            <div style="page-break-after: avoid;">
            </div>

            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px; margin-top: 15px;">Otros Antecedentes</h2>
            </div>         

            <div>
                <h5 for="name">Conocimientos Informáticos</h5>
                <p>{{ $informaticKnowledgeString ? $informaticKnowledgeString : 'N/A' }}</p>
            </div>

            <div>
                <h5 for="name">Conocimientos y Habilidades</h5>
                <p>{{ $profile->knowledge_habilities ? $profile->knowledge_habilities : 'N/A' }}</p>
            </div>

            <table style="width: 100%">
                <tr>
                    <td>

                        <h5 for="name">Licencias de Conducir</h5>
                        <p>{{ $licenseString ? $licenseString : 'N/A' }}</p>
 
                    </td>
                    <td>
                        <h5 for="name">Disponibilidad de viaje</h5>
                        @if($profile->change_residence == 0)
                            <p>No</p>
                        @else
                            <p>Sí</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 for="name">¿Posee discapacidad?</h5>
                        <p>{{ $profile->handicap ? $profile->handicap : 'N/A'  }}</p>
                    </td>
                </tr>
            </table>  
            
            @if($profile->handicap == "si")
                <div>
                    <h5 for="name">¿Porcentaje de discapacidad?</h5>
                    <p>{{ $profile->handicap_percentage }}</p>
                </div>
                
                <div>
                    <h5 for="name">¿Describa que tipo de discapacidad usted posee?</h5>
                    <p>{{ $profile->handicap_description }}</p>
                </div>
                
                <div>
                    <h5 for="name">¿Cuáles son las condiciones necesarias para poder desarrollar su trabajo de forma óptima?</h5>
                    <p>{{ $profile->necesary_condition }}</p>
                </div>
            @endif

            <div style="page-break-after: avoid;">
            </div>

            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px; margin-top: 15px;">Referencias Laborales</h2>
            </div> 

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobReferences as $reference)
                        <tr>
                            <th>Señor (a) {{ $reference->person_name }}</th>
                            <td>{{ $reference->business_name }}</td>
                            <td>{{ $reference->person_job_position }}</td>
                            <td>{{ $reference->person_telephone }}</td>
                            <td>{{ $reference->person_email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
           
                        
    </body></html>
