<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        
        <p class="text-center">
            <img src="{{ $user->image }}" alt="" style="width: 120px;">
        </p>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="content-abasico-basicos-curriculum">
                        <div class="row inf-media-perfil-basicos">
                            <div class="container antecedentes_container">
                                <div class="row">
                                        <div class="col-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Antecedentes básicos</h2>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="name">Nombre Completo</label>
                                            {{ $user->name }}
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="rut">RUT</label>
                                            {{ $user->rut }}
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="birthDate">Fecha de Nacimiento</label>
                                            {{ $profile->birth_date }}
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="birthDate">Edad</label>
                                            <input type="text" class="form-control" value="{{ $age }}" disabled>
                                        </div>
                                        {{--<div class="col-md-8 offset-md-2 pb-20">
                                            <label for="gender">Sexo</label><br>
                                            <input type="text" class="form-control" v-model="gender" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="civilState">Estado Civil</label>
                                            <input type="text" class="form-control" v-model="civilState" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="address">Dirección</label>
                                            <input type="text" class="form-control" id="address" v-model="address" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20" v-if="country == 4">
                                            <label for="region">Región</label>
                                            <select class="form-control" id="region" v-model="region" @change="fetchCommunes()" disabled>
                                                <option :value="region" v-for="region in regions">@{{ region.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20" v-if="country == 4">
                                            <label for="commune">Comuna</label>
                                            <select class="form-control" id="commune" v-model="commune" disabled>
                                                <option :value="commune.id" v-for="commune in communes">@{{ region.name }} - @{{ commune.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="handicap">Posee Discapacidad</label>
                                            <input type="text" class="form-control" id="address" v-model="handicap" disabled>
                                        </div>--}}                                    
                                </div>
                            </div>
                            {{--<div class="container informacionc_container">
                                <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Información de contacto</h2>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="mail">Mail</label>
                                            <input type="mail" class="form-control" id="mail" v-model="email" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for=homePhone>Telefono Fijo</label>
                                            <input type="text" class="form-control" id="homePhone" v-model="homePhone" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="phone">Telefono Movil</label>
                                            <input type="text" class="form-control" id="phone"  v-model="phone" disabled>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class="container informacionacademica_container">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="text-center letra-azul" style="padding-top: 20px;">Información Académica</h2>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="container">
                                            <div class=" table-responsive-cv">
                                                <table class="table table-bordered table-hover table-striped offset-md-2" >
                                                    <thead>
                                                        <tr>
                                                        <th>#</th>
                                                        <th>Institución</th>
                                                        <th>Nivel Educacional</th>
                                                        <th>Campo de Estudio</th>
                                                        <th>Fecha de Inicio</th>
                                                        <th>Fecha Fin</th>
                                                        <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(academicBg, index) in academicBgs">
                                                            <td>@{{ index + 1 }}</td>
                                                            <td>@{{ academicBg.college }}</td>
                                                            <td>@{{ academicBg.educational_level }}</td>
                                                            <td>@{{ academicBg.study_field }}</td>
                                                            <td>@{{ academicBg.start_date }}</td>
                                                            <td>@{{ academicBg.end_date }}</td>
                                                            <td>@{{ academicBg.state }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container resumenl_container">
                                <div class="row">
                                        <div class="col-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Resumen Laboral</h2>
                                        </div>
                                        <div class="col-md-12 offset-lg-1">
                                            <div class="form-group offset-md-2">
                                                <label for="text">Resumen Laboral</label>
                                                <textarea v-model="jobDescription" id="jobdescription" class="form-control " rows="8" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="expyears">Años de Experiencia</label>
                                            <input type="text" class="form-control"  id="expyears"  v-model="expYears" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="salary">Pretenciones de renta</label>
                                            <input type="text" class="form-control"  id="salary"  v-model="salary" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="desiredJob">Puesto deseado</label>
                                            <input type="text" class="form-control"  id="desiredJob"  v-model="desiredJob" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20">
                                            <label for="desiredArea">Area de Preferencia</label>
                                        </div>                                    
                                </div>
                            </div>
                            <div class="container ancedenteslaborales_container">
                                <div class="row">
                                     <div class="col-12">
                                         <h2 class="text-center letra-azul" style="padding-top: 20px;">Antecedentes Laborales</h2>
                                     </div>
                                     <div class="col-12 container table-responsive-cv">
                                         <table class="table table-bordered table-hover table-striped offset-md-2">
                                             <thead>
                                                 <tr>
                                                 <th>#</th>
                                                 <th>Empresa</th>
                                                 <th>Puesto</th>
                                                 <th>Fecha de Inicio</th>
                                                 <th>Fecha Fin</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <tr v-for="(jobBackground, index) in jobBackgrounds">
                                                     <td>@{{ index + 1 }}</td>
                                                     <td>@{{ jobBackground.company }}</td>
                                                     <td>@{{ jobBackground.job }}</td>
                                                     <td>@{{ jobBackground.start_date }}</td>
                                                     <td>@{{ jobBackground.end_date }}</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                </div>
                            </div>
                            <div class="container antecedentes_container">
                                <div class="row">
                                    <div class="col-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Otros Antecedentes</h2>
                                        </div>
                                        <div class="col-md-12 offset-lg-1">
                                            <div class="form-group offset-md-2">
                                                <label for="text">Conocimientos Informáticos </label>
                                                <textarea class="form-control" rows="8" id="conocimientos" v-model="informaticKnowledge" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 offset-lg-1">
                                            <div class="form-group offset-md-2">
                                                <label for="text">Conocimientos y Habilidades</label>
                                                <textarea type="text" rows="8" class="form-control" id="habilidades"  v-model="knowledgeHabilities" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="text">Licencia de Conducir</label>
                                                <input type="text" class="form-control" id="licencia"  v-model="driverLicenseString" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <label for="available">Disponibilidad de viaje</label>
                                            <input type="text" class="form-control" id="licencia"  v-model="travelAvailable" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="text">Tiene alguna discapacidad</label>
                                                <input type="text" class="form-control" id="discapacidad"  v-model="handicapDescription" disabled>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4" v-for="reference in references">
                                        <p>Señor (a) @{{ reference.person_name }}</p>
                                        <p>@{{ reference.business_name }}</p>
                                        <p>@{{ reference.person_job_position }}</p>
                                        <p>Fono: @{{ reference.person_telephone }}</p>
                                        <p>@{{ reference.person_email }}</p>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>