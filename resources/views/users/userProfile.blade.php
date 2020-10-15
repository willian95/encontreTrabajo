@extends("layouts.secondaryViews")

@section("content")


    <div class="container mt-3 perfil-encontre-trabajo" id="profile-dev">
        <div class="loader-cover" v-if="loading == true">
            <div class="loader"></div>
        </div>
            <h2>Mi Perfil</h2>
            <!--<button class="btn btn-info" @click="validate()">Validar mi perfil</button>-->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs ">
              <li class="nav-item tabs-perfil">

                <a class="nav-link active tabs-perfil-a" data-toggle="tab" href="#basico" @click="toggleTabs('basico')">
                    <div class="content-ico-tab">
                        <img class="ico-tab" src="{{ asset('user/assets/img/basico.png') }}" alt="">
                    </div>
                    <h3>Antecedentes Básicos</h3>
                </a>
              </li>
              <li class="nav-item tabs-perfil">
                <a class="nav-link tabs-perfil-a" data-toggle="tab" href="#academico" @click="toggleTabs('academico')">
                    <div class="content-ico-tab">
                        <img class="ico-tab" src="{{ asset('user/assets/img/academico.png') }}" alt="">
                    </div>
                    <h3>Antecedentes Académicos</h3>
                </a>
              </li>
              <li class="nav-item tabs-perfil">
                    <a class="nav-link tabs-perfil-a" data-toggle="tab" href="#labora"  @click="toggleTabs('labora')">
                        <div class="content-ico-tab">
                            <img class="ico-tab" src="{{ asset('user/assets/img/alaboral.png') }}" alt="">
                        </div>
                        <h3>Antecedentes Laboral</h3>
                    </a>
              </li>
              <li class="nav-item tabs-perfil">
                <a class="nav-link tabs-perfil-a" data-toggle="tab" href="#rlabora" @click="toggleTabs('rlabora')">
                    <div class="content-ico-tab">
                        <img class="ico-tab" src="{{ asset('user/assets/img/laboral.png') }}" alt="">
                    </div>
                    <h3>Resumen Laboral</h3>
                </a>
              </li>
              <li class="nav-item tabs-perfil">
                    <a class="nav-link tabs-perfil-a" data-toggle="tab" href="#otro"  @click="toggleTabs('otro')">
                    <div class="content-ico-tab">
                        <img class="ico-tab" src="{{ asset('user/assets/img/otros.png') }}" alt="">
                    </div>
                    <h3>Otros Antecedentes</h3> 
                    </a>
              </li>
            </ul>
          
            <!-- Tab panes -->
            <div class="tab-content">
              <div id="basico" class="container tab-pane active a-basicos"><br>
                
                <div class="content a-basicos">
                    <div class="row media-perfil">
                        <div class="col-md-4 media-perfil-c-4">
                            <div class="a-basicos-postulante-img j-center">
                            <img class="basicos-postulante-c-4" :src="imagePreview" alt="postulante"></div>
                            <label for="image">Foto de Perfil</label>
                            <input type="file" class="form-control" id="image" ref="file" @change="onImageChange" accept="image/*">

                        </div>
                        <div class="col-md-4 media-perfil-c-4">
                            <div class="a-basicos-postulante-video j-center">
                                <img class="basicos-postulante-c-4" src="{{ asset('user/assets/img/video.png') }}" alt="postulante" v-if="videoPreview == ''">
                                <video style="width: 100%;" controls id="productVideo" v-if="videoPreview != null && videoPreview != ''">
                                    <source :src="videoPreview" type="video/mp4">
                                </video>
                            </div>
                                <label for="video">Video de Presentación</label>
                                <input type="file" class="form-control" id="video" @change="onVideoChange" accept="video/*">

                            </div>
                            <div class="col-md-4 media-perfil-c-4">
                                <div class="a-basicos-postulante-curriculum j-center" v-if="curriculumPreview.substring(curriculumPreview.length - 3, curriculumPreview.length) == 'pdf' || curriculumPreview.substring(curriculumPreview.length - 3, curriculumPreview.length) == 'PDF'">
                                    <img class="basicos-postulante-c-4" src="{{ asset('user/assets/img/icons8-contrato-de-trabajo-100.png') }}" alt="postulante" v-if="curriculumPreview == ''">

                                    <iframe id="iframepdf" :src="curriculumPreview" v-if="curriculumPreview != ''"></iframe>
                                                               
                                </div>
                                <label for="curriculum">Curriculum</label>
                                <input type="file" class="form-control" id="curriculum" @change="onCurriculumChange" accpet="file/pdf">
                                <small>Solo está permitido el formato Word o PDF</small>
                                <p v-if="curriculumPreview">
                                    <button class="btn btn-success" @click="download()">Descargar</button>
                                </p>

                            </div>
                        </div>
                        <div class="content-abasico-basicos">
                            <div class="row inf-media-perfil-basicos">
                                <form action="/action_page.php">
                                    <div class="row inf-perfil">

                                        <div class="col">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" id="name" v-model="name">
                                        </div>

                                        <div class="col">
                                            <label for="lastname">Apellido</label>
                                            <input type="text" class="form-control" id="#" v-model="lastname">
                                        </div>
                            
                                        <div class="col ">
                                            <label for="rut">RUT</label>
                                            <input type="text" class="form-control" id="rut" v-model="rut">
                                        </div>
                                        
                                    </div>
                                    <div class="row inf-perfil">
                                        
                                        <div class="col">
                                            <label for="birthDate">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="birthDate" v-model="birthDate">
                                        </div>

                                        <div class="col">
                                            <label for="gender">Sexo</label><br>
                                        <!-- <input type="text" class="form-control" id="email"  name="email"> -->
                                            <select v-model="gender" id="gender" class="form-control">
                                                <option value="" default>Seleccione</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="civilState">Estado Civil</label>
                                            <select class="form-control"  id="civilState" v-model="civilState">
                                                <option value="" default>Seleccione</option>
                                                <option value="casado">Casado</option>
                                                <option value="soltero">Soltero</option>
                                                <option value="viudo">Viudo</option>
                                                <option value="divorciado">Divorciado</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="row inf-perfil">
                                        <div class="col">
                                            <label for="address">Dirección</label>
                                            <input type="text" class="form-control" id="address" v-model="address">
                                        </div>
                                        <div class="col">
                                            <label for="city">País</label>
                                            <select class="form-control" v-model="country">
                                                <option value="" default>Seleccione</option>
                                                <option :value="country.id" v-for="country in countries">@{{ country.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="city">Nacionalidad</label>
                                            <input type="text" class="form-control" v-model="nationality">
                                        </div>
                                    </div>
                                    <div class="row inf-perfil">

                                        <div class="col" v-if="country == 4">
                                            <label for="region">Región</label>
                                            <select class="form-control" id="region" v-model="region" @change="fetchCommunes()">
                                                <option :value="region" v-for="region in regions">@{{ region.name }}</option>
                                            </select>
                                        </div>

                                        <div class="col" v-if="country == 4">
                                            <label for="commune">Comuna</label>
                                            <select class="form-control" id="commune" v-model="commune">
                                                <option :value="commune.id" v-for="commune in communes">@{{ region.name }} - @{{ commune.name }}</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="handicap">Posee Discapacidad</label>
                                            <select class="form-control"  id="handicap" v-model="handicap">
                                                <option value="no">No</option>
                                                <option value="si">Sí</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row inf-perfil">

                                        <div class="col">
                                            <label for="mail">Email</label>
                                            <input type="mail" class="form-control" id="mail" v-model="email" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="phone">Telefono Movil</label>
                                            <input type="text" class="form-control" id="phone"  v-model="phone">
                                        </div>
                                        <div class="col">
                                            <label for=homePhone>Telefono Fijo</label>
                                            <input type="text" class="form-control" id="homePhone" v-model="homePhone">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row media-perfil-basicos-publicidad">
                                <img class="publicidad" src="{{ asset('user/assets/img/login.jpg') }}" alt="publicidad">
                                <img class="publicidad" src="{{ asset('user/assets/img/login.jpg') }}" alt="publicidad">
                            </div>
                        </div>
                        <div class="button-perfil-basico">
                            <div class="buttom-content">
                                <button type="submit" class="btn btn-primary" @click="update()">Actualizar</button>
                            </div>
                        </div>

                    </div>
                </div>
              </div>
              <div id="academico" class="container tab-pane fade a-academicos"><br>
                <div class="content a-academicos">
                        <!--<form action="/action_page.php">-->
                            <div class="row a-academicos-form">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="college">Institución </label>
                                        <input type="text" class="form-control" id="college" v-model="college">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="educationalLevel">Nivel Educacional</label>
                                        <select class="form-control" id="educationalLevel" v-model="educationalLevel">
                                            <option value="Básico">Básico</option>
                                            <option value="Medio">Medio</option>
                                            <option value="Técnico Profesional">Técnico Profesional</option>
                                            <option value="Universitario">Universitario</option>
                                            <option value="Magister">Magister</option>
                                            <option value="Doctorado">Doctorado</option>
                                            <option value="otros">Otros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="startDate">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="startDate" v-model="startDate">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="endDate">Fecha de Término</label>
                                        <input type="date" class="form-control" id="endDate" v-model="endDate">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="state">Estado</label>
                                        <select class="form-control" id="state" v-model="state">
                                            <option value="">Seleccione</option>
                                            <option value="en curso">En curso</option>
                                            <option value="finalizado">Finalizado</option>
                                            <option value="abandonado">Abandonado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="studyField">Campo de estudio</label>
                                        <input type="text" class="form-control" id="studyField" v-model="studyField">
                                    </div>
                                </div>

                                
                                <div class="col-12">
                                    <div class="buttom-content-add text-center">
                                        <button type="button" class="btn btn-primary" @click="storeAcademicBg()">Agregar</button>
                                    </div>
                                </div>
                            </div>
                          
                        <!--</form>-->
                        <div>
                                <div class="container content-table-a-academico">
              
                                  <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Institución</th>
                                        <th>Nivel Educacional</th>
                                        <th>Campo de Estudio</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr v-for="(academicBg, index) in academicBgs">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ academicBg.college }}</td>
                                        <td>@{{ academicBg.educational_level }}</td>
                                        <td>@{{ academicBg.study_field }}</td>
                                        <td>@{{ dateFormatter(academicBg.start_date) }}</td>
                                        <td>@{{ dateFormatter(academicBg.end_date) }}</td>
                                        <td>@{{ academicBg.state }}</td>
                                        <td>
                                            <button class="btn btn-info" @click="editAcademic(academicBg)" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger" @click="eraseAcademicBg(academicBg.id)"><i class="fas fa-trash"></i></button>
                                        </td>
                                      </tr>
                                  
                                    </tbody>
                                  </table>
                                </div>
                        </div>
                </div>

                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            
                            <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editCollege">Institución </label>
                                                <input type="text" class="form-control" id="editCollege" v-model="editCollege">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editEducationalLevel">Nivel Educacional</label>
                                                <select class="form-control" id="editEducationalLevel" v-model="editEducationalLevel">
                                                    <option value="Básico">Básico</option>
                                                    <option value="Medio">Medio</option>
                                                    <option value="Técnico Profesional">Técnico Profesional</option>
                                                    <option value="Magister">Magister</option>
                                                    <option value="Doctorado">Doctorado</option>
                                                    <option value="otros">Otros</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editStartDate">Fecha de Inicio</label>
                                                <input type="date" class="form-control" id="editStartDate" v-model="editStartDate">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editEndDate">Fecha de Término</label>
                                                <input type="date" class="form-control" id="editEndDate" v-model="editEndDate">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="state">Estado</label>
                                                <select class="form-control" id="state" v-model="editState">
                                                    <option value="">Seleccione</option>
                                                    <option value="en curso">En curso</option>
                                                    <option value="finalizado">Finalizado</option>
                                                    <option value="abandonado">Abandonado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editStudyField">Campo de estudio</label>
                                                <input type="text" class="form-control" id="editStudyField" v-model="editStudyField">
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="updateAcademicBg()">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>

              </div>
        


              <div id="labora" class="container tab-pane fade"><br>
          
                    <div class="row a-laboral-form">
                    <div class="col ">
                    <div class="form-group">
                        <label for="jobBg">Puesto</label>
                        <input type="text" class="form-control" id="puesto" v-model="jobBg">
                    </div>
                    </div>
                    <div class="col ">
                    <div class="form-group">
                        <label for="company">Empresa</label>
                        <input type="text" class="form-control" id="company"  v-model="company">
                    </div>
                    </div>
                    <div class="col ">
                      <div class="form-group">
                          <label for="startDateBg">Fecha de Inicio</label>
                          <input type="date" class="form-control" id="startDateBg"  v-model="startDateBg">
                      </div>
                      </div>
                      <div class="col ">
                      <div class="form-group">
                          <label for="endDateBg">Fecha de Término</label>
                          <input type="date" class="form-control" id="endDateBg"  v-model="endDateBg">
                      </div>
                      </div>
                    
                    </div>
                    <div class="buttom-content-add">
                        <button type="button" class="btn btn-primary" @click="storeJobBackground()">Agregar</button>
                    </div>
                  
     
                <div>
                  
                <div class="container table-responsive-et">
                        
                        <table class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>Puesto</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha Término</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(jobBackground, index) in jobBackgrounds">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ jobBackground.company }}</td>
                                <td>@{{ jobBackground.job }}</td>
                                <td>@{{ dateFormatter(jobBackground.start_date) }}</td>
                                <td>@{{ dateFormatter(jobBackground.end_date) }}</td>
                                <td>
                                    <button class="btn btn-info" @click="editJB(jobBackground)" data-toggle="modal" data-target="#editJobModal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" @click="eraseJobBg(jobBackground.id)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        
                        </tbody>
                        </table>
                  </div>
                </div>

                <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                <button id="modalBgClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editStudyField">Puesto</label>
                                                <input type="text" class="form-control" id="editStudyField" v-model="editJobBg">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editCollege">Empresa </label>
                                                <input type="text" class="form-control" id="editCollege" v-model="editCompany">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editStartDate">Fecha de Inicio</label>
                                                <input type="date" class="form-control" id="editStartDate" v-model="editStartDateBg">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="editEndDate">Fecha de Término</label>
                                                <input type="date" class="form-control" id="editEndDate" v-model="editEndDateBg">
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="updateJobBg()">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>

              </div>

              <div id="rlabora" class="container tab-pane fade"><br>
    
                    <div class="row r-laboral-form">
                        <div class="col-lg-4">
                            <label for="jobdescription">Resumen Laboral</label><br>
                            <textarea v-model="jobDescription" id="jobdescription" class="form-control" rows="6"></textarea>
                            <!-- <input type="text" class="form-control" i id="#"  name="#"> -->
                        </div>
                        <div class="col-lg-4">
                            <label for="functions">Descripción de funciones</label><br>
                            <textarea v-model="functions" id="functions" class="form-control" rows="6"></textarea>
                            <!-- <input type="text" class="form-control" i id="#"  name="#"> -->
                        </div>
                        <div class="col-lg-4">
                            <label for="awards">Logros</label><br>
                            <textarea v-model="awards" id="awards" class="form-control" rows="6"></textarea>
                            <!-- <input type="text" class="form-control" i id="#"  name="#"> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="expyears">Años de Experiencia</label>
                            <input type="text" class="form-control"  id="expyears"  v-model="expYears" @keypress="isNumber($event)">
                        </div>
                        <div class="col-md-4">
                            <label for="available">Disponibilidad</label>
                            <select class="form-control" id="available" v-model="availability">
                                <option value="">Seleccione</option>
                                <option value="inmediata">Inmediata</option>
                                <option value="en unos dias">En unos días</option>
                                <option value="proxima semana">Próxima semana</option>
                                <option value="en 2 semanas">En 2 semanas</option>
                                <option value="en 1 mes">En 1 mes</option>
                                <option value="sin disponibilidad">Sin disponibilidad</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="salary">Pretenciones de renta</label>
                            <input type="text" class="form-control"  id="salary"  v-model="salary">
                        </div>
                        <div class="col-md-4">
                            <label for="desiredJob">Puesto deseado</label>
                            <input type="text" class="form-control"  id="desiredJob"  v-model="desiredJob">
                        </div>
                        <div class="col-md-8">
                            <label for="desiredArea">Area de Preferencia</label>
                            <input type="text" class="form-control" v-model="desiredAreaString" @click="showDesiredAreaModal()">
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="available">Disponibilidad de viaje</label>
                            <select class="form-control" id="available" v-model="travelAvailable">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                                
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label for="available">Disponibilidad de cambiar residencia</label>
                            <select class="form-control" id="available" v-model="changeResidence">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                                
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label for="region">Seleccione regiones a las cuales pueda trabajar</label>
                            <input type="text" class="form-control" @click="showRegionsModal()" v-model="moveRegions">
                            {{--<select class="form-control" id="region" @change="selectMoveRegion()" v-model="moveRegion">
                                <option :value="region" v-for="region in regions">@{{ region.name }}</option>
                            </select>
                            <small>(max. 3 regiones)</small>
                            
                            <div class="card" v-for="moveRegion in moveRegions">
                                <div class="card-body">
                                    @{{ moveRegion.name }}

                                    <button type="button" class="btn" @click="removeMoveRegion(moveRegion.id)">
                                        X
                                    </button>

                                </div>
                            </div>--}}

                        </div>
                    </div>
                
                    <div class="buttom-content-rlaboral">
                        <button type="submit" class="btn btn-primary" @click="storeJobResume()">Actualizar</button>
                    </div>

              </div>


            <div id="otro" class="container tab-pane fade"><br>
                <div class="content-otros">

                    <div class="row a-academicos-form">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="text">Conocimientos Informáticos </label>
                                <input class="form-control" id="conocimientos" v-model="informaticKnowledge" @click="showInformaticKnowledgeModal()">
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="text">Conocimientos y Habilidades</label>
                                <textarea type="text" rows="8" class="form-control" id="habilidades"  v-model="knowledgeHabilities"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                    <label for="licencia">Licencia de Conducir</label>
                                
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="licenseA1" v-model="licenseA1">
                                                <label class="form-check-label" for="licenseA1">
                                                    A1
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseA2" v-model="licenseA2">
                                                <label class="form-check-label" for="licenseA2">
                                                    A2
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseA3" v-model="licenseA3">
                                                <label class="form-check-label" for="licenseA3">
                                                    A3
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseA4" v-model="licenseA4">
                                                <label class="form-check-label" for="licenseA4">
                                                    A4
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseA5" v-model="licenseA5">
                                                <label class="form-check-label" for="licenseA5">
                                                    A5
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseB" v-model="licenseB">
                                                <label class="form-check-label" for="licenseB">
                                                    B
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseC" v-model="licenseC">
                                                <label class="form-check-label" for="licenseC">
                                                    C
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseD" v-model="licenseD">
                                                <label class="form-check-label" for="licenseD">
                                                    D
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseE" v-model="licenseE">
                                                <label class="form-check-label" for="licenseE">
                                                    E
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="licenseF" v-model="licenseF">
                                                <label class="form-check-label" for="licenseF">
                                                    F
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="text">Porcentaje de discapacidad</label>
                                <select class="form-control" class="form-control" v-model="handicapPercentage">
                                    <option value="0">0 %</option>
                                    <option value="10">10 %</option>
                                    <option value="20">20 %</option>
                                    <option value="30">30 %</option>
                                    <option value="40">40 %</option>
                                    <option value="50">50 %</option>
                                    <option value="60">60 %</option>
                                    <option value="70">70 %</option>
                                    <option value="80">80 %</option>
                                    <option value="90">90 %</option>
                                    <option value="100">100 %</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="text">Describa que tipo de discapacidad usted posee</label>
                                <textarea class="form-control" id="discapacidad"  v-model="handicapDescription"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="text">¿Cuáles son las condiciones necesarias para poder desarrollar su trabajo de forma óptima? Ejem.: Rampla para silla de ruedas, teclado especial braille, etc</label>
                                <textarea class="form-control" id="necesaryCondition"  v-model="necesaryCondition"></textarea>
                            </div>
                        </div>

                        
                    </div>
                    <div class="buttom-content-up">
                        <button type="button" class="btn btn-primary" @click="storeOthers()">Actualizar</button>
                    </div>
                </div>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="informaticKnowledgeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Conocimientos informáticos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card" v-for="know in informaticKnowledgeList" v-bind:class="checkCard(know.id)" @click="chooseInformaticKnowledge(know.id, know.name)">
                            <div class="card-body">
                                @{{ know.name }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeInformaticKnowledge()">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="acceptInformaticKnowledge()">Aceptar</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="moveRegionsModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Regiones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card" v-for="region in regions" v-bind:class="checkMoveRegionCard(region.id)" @click="chooseMoveRegion(region.id, region.name)">
                            <div class="card-body">
                                @{{ region.name }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeMoveRegion()">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="acceptMoveRegion()">Aceptar</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="desiredAreaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Areas de preferencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="card" v-for="jobCategory in jobCategories" v-bind:class="checkDesiredAreaCard(jobCategory.id)" @click="chooseDesiredArea(jobCategory.id, jobCategory.name)">
                                <div class="card-body">
                                    @{{ jobCategory.name }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeDesiredArea()">Cerrar</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="acceptDesiredArea()">Aceptar</button>
                        </div>
                    </div>
                </div>
                
            </div>

            
            </div>
          </div>
        </div>
    


@endsection

@push("scripts")
<script>
        const devArea = new Vue({
            el: '#profile-dev',
            data() {
                return {
                    isCurriculumValidated:"{{ $user->profile->is_curriculum_validated }}",
                    image:"",
                    imagePreview:"{{ Auth::user()->image }}",
                    video:"",
                    videoPreview:"{{ $user->profile->video }}",
                    curriculum:"",
                    countries:[],
                    country:"",
                    curriculumPreview:"{{ $user->profile->curriculum }}",
                    nationality:"{{ $user->profile->nationality }}",
                    name:"{{ Auth::user()->name }}",
                    lastname:"{{ Auth::user()->lastname }}",
                    rut:"{{ $user->profile->rut }}",
                    birthDate:"{{ $user->profile->birth_date }}",
                    gender:"{{ $user->profile->gender }}",
                    civilState:"{{ $user->profile->civil_state }}",
                    address:"{{ $user->profile->address }}",
                    country:"{{ $user->profile->country_id ? $user->profile->country_id : 4 }}",
                    region:"{{ Auth::user()->region_id }}",
                    commune:"{{ Auth::user()->commune_id }}",
                    handicap:"{{ $user->profile->handicap ? $user->profile->handicap : 'no' }}",
                    email:"{{ Auth::user()->email }}",
                    phone:"{{ $user->profile->phone }}",
                    homePhone:"{{ $user->profile->home_phone }}",
                    loading:false,
                    academicBgs:[],
                    studyField:"",
                    college:"",
                    educationalLevel:"",
                    startDate:"",
                    endDate:"",
                    state:"",
                    academicId:"",
                    editCollege:"",
                    editEducationalLevel:"",
                    editStartDate:"",
                    editEndDate:"",
                    editState:"",
                    editStudyField:"",
                    jobCategories:[],
                    jobDescription:"{{ $user->profile->job_description }}",
                    functions:"{{ $user->profile->functions }}",
                    awards:"{{ $user->profile->awards }}",
                    expYears:"{{ $user->profile->experience_year }}",
                    availability:"{{ $user->profile->availability }}",
                    salary:"{{ $user->profile->salary }}",
                    desiredJob:"{{ \Auth::user()->desired_job }}",
                    desiredArea:"{{ $user->profile->desired_area }}",
                    travelAvailable:"{{ $user->profile->travel_available }}",
                    changeResidence:"{{ $user->profile->change_residence }}",
                    moveRegion:"",
                    moveRegions:"{{ $user->profile->move_regions }}",
                    choosenMoveRegion:[],
                    choosenMoveRegionNames:[],
                    jobBackgrounds:[],
                    company:"",
                    jobBg:"",
                    startDateBg:"",
                    endDateBg:"",
                    jbId:"",
                    editCompany:"",
                    editJobBg:"",
                    editStartDateBg:"",
                    editEndDateBg:"",
                    informaticKnowledge:"{{ $user->profile->informatic_knowledge }}",
                    knowledgeHabilities:"{{ $user->profile->knowledge_habilities }}",
                    driverLicense:"{{ $user->profile->driver_license }}",
                    licenseA1:false,
                    licenseA2:false,
                    licenseA3:false,
                    licenseA4:false,
                    licenseA5:false,
                    licenseB:false,
                    licenseC:false,
                    licenseD:false,
                    licenseE:false,
                    licenseF:false,
                    handicapDescription:"{{ $user->profile->handicap_description }}",
                    necesaryCondition:"{{ $user->profile->necesary_condition }}",
                    handicapPercentage:"{{ $user->profile->handicap_percentage }}",
                    regions:[],
                    communes:[],
                    //desiredAreas:JSON.parse('{!! $desiredAreas !!}'),
                    informaticKnowledgeList:[
                        {id: 1, name: "Hojas de cálculo"},
                        {id: 2, name: "Intranet"},
                        {id: 3, name: "Gmail"},
                        {id: 4, name: "Procesadores de texto"},
                        {id: 5, name: "Bases de datos Oracle"},
                        {id: 6, name: "MySQL"},
                        {id: 7, name: "PostgreSQL"},
                        {id: 8, name: "Internet"},
                        {id: 9, name: "Redes Internas"},
                        {id: 10, name: "TCP/IP"},
                        {id: 11, name: "Routers"},
                        {id: 12, name: "WAP"},
                        {id: 13, name: "Wireless"},
                        {id: 14, name: "Google Analytics"},
                        {id: 15, name: "Google Adwords"},
                        {id: 16, name: "SEO"},
                        {id: 17, name: "SEM"},
                        {id: 18, name: "Wordpress"},
                        {id: 19, name: "Blogger"},
                        {id: 20, name: "Redes Sociales"},
                        {id: 21, name: "Adobe Dreamweaver"},
                        {id: 22, name: "Adobe Flash"},
                        {id: 23, name: "Photoshop"},
                        {id: 24, name: "Adobe InDesign"},
                        {id: 25, name: "Adobe Illustrator"},
                        {id: 26, name: "Premiere Pro"},
                        {id: 27, name: "Microsoft Office"},
                        {id: 28, name: "Mac"},
                        {id: 29, name: "Windows"},
                        {id: 30, name: "Linux"},
                        {id: 31, name: "CRM"},
                        {id: 32, name: "SAP"},
                        {id: 33, name: "Peoplesoft"},
                        {id: 34, name: "Jira"},
                        {id: 35, name: "Trello"},
                        {id: 36, name: "Java"},
                        {id: 37, name: "Javascript"},
                        {id: 38, name: "XML"},
                        {id: 39, name: "ASP/.NET"},
                        {id: 40, name: "PHP"},
                        {id: 41, name: "HTML"}
                    ],
                    selectInformaticLnowledge:"",
                    choosenInformaticKnowledge:[],
                    choosenInformaticKnowledgeNames:[],
                    choosenDesiredArea:[],
                    choosenDesiredAreaNames:[],
                    desiredAreaString:"{{ $user->profile->desired_areas }}"

                }
            },
            methods: {

                toggleTabs(tab){
                    $(".tab-pane").removeClass("active")
                    $(".tab-pane").css("display", "none")
                    $("#"+tab).css("display", "block")
                    $("#"+tab).addClass("active")
                },
                chooseMoveRegion(id, name){


                    var exist = false
                    var index = 0
                    this.choosenMoveRegion.forEach((data, i) => {

                        if(data == id){
                            exist = true
                            index = i
                        }

                    })

                    if(!exist){
                        if(this.choosenMoveRegion.length < 3){
                            this.choosenMoveRegion.push(id+"")
                            this.choosenMoveRegionNames.push(name)
                        }
                    }else{
                        this.choosenMoveRegion.splice(index, 1)
                        this.choosenMoveRegionNames.splice(index, 1)
                    }

                },
                chooseInformaticKnowledge(id, name){

                    var exist = false
                    var index = 0
                    this.choosenInformaticKnowledge.forEach((data, i) => {

                        if(data == id){
                            exist = true
                            index = i
                        }

                    })

                    if(!exist){
                        this.choosenInformaticKnowledge.push(id+"")
                        this.choosenInformaticKnowledgeNames.push(name)
                    }else{
                        this.choosenInformaticKnowledge.splice(index, 1)
                        this.choosenInformaticKnowledgeNames.splice(index, 1)
                    }

                },
                chooseDesiredArea(id, name){
                    var exist = false
                    var index = 0
                    this.choosenDesiredArea.forEach((data, i) => {

                        if(data == id){
                            exist = true
                            index = i
                        }

                    })

                    if(!exist){
                        this.choosenDesiredArea.push(id+"")
                        this.choosenDesiredAreaNames.push(name)
                    }else{
                        this.choosenDesiredArea.splice(index, 1)
                        this.choosenDesiredAreaNames.splice(index, 1)
                    }
                },
                acceptInformaticKnowledge(){
                    this.informaticKnowledge = this.choosenInformaticKnowledgeNames.toString()
                },
                closeInformaticKnowledge(){
                    if(this.informaticKnowledge == ""){
                        this.informaticKnowledge = ""
                    }
                    
                },
                acceptDesiredArea(){
                    this.desiredAreaString = this.choosenDesiredAreaNames.toString()
                },
                closeDesiredArea(){
                    if(this.desiredAreaString == ""){
                        this.desiredAreaString = ""
                    }
                    
                },
                acceptMoveRegion(){
                    this.moveRegions = this.choosenMoveRegionNames.toString()
                },
                closeMoveRegion(){
                    if(this.moveRegions == ""){
                        this.moveRegions = ""
                    }
                    
                },
                fetchRegions(){

                    axios.get("{{ url('/regions/fetch-all') }}").then(res => {

                        if(res.data.success == true){
                            this.regions = res.data.regions

                            this.regions.forEach((data) => {

                                if("{{ Auth::user()->region_id }}" == data.id){
                                    this.region = data
                                }

                            })

                            this.fetchCommunes()
                            if(this.moveRegions.length > 0){
                    
                                let explodeRegions = this.moveRegions.split(",")
                                this.choosenMoveRegion = explodeRegions

                                this.regions.forEach((data) => {
                                    
                                    this.choosenMoveRegion.forEach((data2) => {

                                        if(data.id == data2){
                                            this.choosenMoveRegionNames.push(data.name)
                                        }

                                    })
                                    
                                })

                                this.moveRegions = this.choosenMoveRegionNames.toString()
                            }
                            

                        }

                    })

                },
                fetchCountries(){

                    axios.get("{{ url('/country/fetch') }}").then(res => {
                        
                        if(res.data.success == true){
                            this.countries = res.data.countries
                        }

                    })

                },
                fetchCommunes(){

                    //this.region = this.regionName.id
                
                    axios.get("{{ url('/communes/fetch/') }}"+"/"+this.region.id).then(res => {

                        if(res.data.success == true){
                            this.communes = res.data.communes

                        }

                    })

                },
                checkCard(id){

                    let name = ""
                    //console.log("checkcard", id, this.choosenInformaticKnowledge)
                    if(this.choosenInformaticKnowledge.includes(id+"")){
                        
                        name = "custom-card-active"
                    }
                        
                    return name

                }, 
                checkDesiredAreaCard(id){

                    let name = ""
                    //console.log("checkcard", id, this.choosenInformaticKnowledge)
                    if(this.choosenDesiredArea.includes(id+"")){
                        
                        name = "custom-card-active"
                    }
                        
                    return name

                }, 
                checkMoveRegionCard(id){
                    let name = ""
                    //console.log("checkcard", id, this.choosenInformaticKnowledge)
                    if(this.choosenMoveRegion.includes(id+"")){
                        
                        name = "custom-card-active"
                    }
                        
                    return name
                },
                onImageChange(e){
                    this.image = e.target.files[0];

                    this.imagePreview = URL.createObjectURL(this.image);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    this.createImage(files[0]);
                },
                createImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.image = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                onVideoChange(e){
                    this.video = e.target.files[0];

                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;

                    this.validateFile(this.video, files[0])
          
                    //this.createVideo(files[0]);
                },
                validateFile(file, files) {

                    var video = document.createElement('video');
                    video.preload = 'metadata';

                    var vm = this
                    video.onloadedmetadata = function() {
                        
                        window.URL.revokeObjectURL(video.src);

                        if (video.duration < 1) {

                            swal({
                                title:"Lo sentimos",
                                text:"El video dura menos de un segundo",
                                icon:"error"
                            })
                            $("#video").val("")
                            return;

                        }else if(video.duration > 60){

                            swal({
                                title:"Lo sentimos",
                                text:"El video dura más de un minuto",
                                icon:"error"
                            })

                            $("#video").val("")
                            return
                        }else{

                            vm.createVideo(files)
                            

                        }

                        
                    }

                    video.src = URL.createObjectURL(file);
                },
                createVideo(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.video = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                onCurriculumChange(e){
                    this.curriculum = e.target.files[0];

                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
          
                    this.createCurriculum(files[0]);
                },
                createCurriculum(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.curriculum = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                showInformaticKnowledgeModal(){
                    $("#informaticKnowledgeModal").modal('show');
                },
                showDesiredAreaModal(){
                    $("#desiredAreaModal").modal('show');
                },
                showRegionsModal(){
                    $("#moveRegionsModal").modal('show');
                },
                update(){

                    
                    this.loading = true
                    axios.post("{{ url('/profile/update') }}",{
                        image:this.image,
                        video:this.video,
                        curriculum:this.curriculum,
                        name:this.name,
                        lastname:this.lastname,
                        rut:this.rut,
                        birthDate:this.birthDate,
                        gender:this.gender,
                        civilState:this.civilState,
                        address:this.address,
                        country:this.country,
                        region:this.region.id,
                        commune:this.commune,
                        handicap:this.handicap,
                        phone:this.phone,
                        homePhone:this.homePhone,
                        nationality:this.nationality
                    })
                    .then(res => {

                        this.loading = false
                        if(res.data.success == true){
                            
                            swal({
                                title:"Tus datos se actualizaron de forma correcta.",
                                text:res.data.msg,
                                icon:"success"
                            })
                            .then(() => {
                                window.location.reload()
                            })

                            

                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })
                    .catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
            
                        });
                    })

                },
                download(){
                    window.open(this.curriculumPreview, '_blank')
                },
                fetchAcademicBg(){

                    axios.get("{{ url('/profiles/academic/fetch') }}")
                    .then(res => {

                        if(res.data.success == true){

                            this.academicBgs = res.data.academicBgs
                            
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })

                },
                fetchJobCategories(){

                    axios.get("{{ url('/job-categories/fetch-all') }}")
                    .then(res => {

                        if(res.data.success == true){

                            this.jobCategories = res.data.jobCategories

                            //this.desiredAreaString = this.choosenDesiredAreaNames.toString()

                            let explodeDesiredArea = this.desiredAreaString.split(",")
                            this.choosenDesiredArea = explodeDesiredArea

                            this.jobCategories.forEach((data) => {
                                
                                this.choosenDesiredArea.forEach((data2) => {

                                    if(data.id == data2){
                                        this.choosenDesiredAreaNames.push(data.name)
                                    }

                                })
                                
                            })

                            this.desiredAreaString = this.choosenDesiredAreaNames.toString()
                            
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })

                },
                storeAcademicBg(){
                    this.loading = true

                    if(this.state != 'en curso' && this.endDate == ""){
                        this.loading = false
                        alertify.error("Fecha de término es requerida")

                    }else{

                        axios.post("{{ url('/profile/academic/store') }}", {
                            college:this.college,
                            educationalLevel:this.educationalLevel,
                            startDate:this.startDate,
                            endDate:this.endDate,
                            studyField:this.studyField,
                            state:this.state,
                        })
                        .then(res => {

                            this.loading = false

                            if(res.data.success == true){

                                swal({
                               
                                    text:res.data.msg,
                                    icon:"success"
                                })

                                this.college= ""
                                this.educationalLevel = ""
                                this.startDate = ""
                                this.endDate = ""
                                this.state  = ""

                                this.fetchAcademicBg()

                            }else{

                                swal({
                                    title:"Lo sentimos",
                                    text:res.data.msg,
                                    icon:"error"
                                })

                            }

                        })
                        .catch(err => {
                            this.loading = false
                            $.each(err.response.data.errors, function(key, value) {
                                alertify.error(value[0])
                
                            });
                        })

                    }

                },
                editAcademic(academic){
                    this.academicId = academic.id
                    this.editCollege = academic.college
                    this.editEducationalLevel = academic.educational_level
                    this.editStartDate = academic.start_date
                    this.editEndDate = academic.end_date
                    this.editState = academic.state
                    this.editStudyField = academic.study_field
                },
                updateAcademicBg(){
                    

                    if(this.editState != 'en curso' && this.editEndDate == ""){
                        this.loading = false
                        alertify.error("Fecha de término es requerida")

                    }else{

                       
                        this.loading = true
                        axios.post("{{ url('/profile/academic/update') }}", {
                            id:this.academicId,
                            college:this.editCollege,
                            educationalLevel:this.editEducationalLevel,
                            startDate:this.editStartDate,
                            endDate:this.editEndDate,
                            state:this.editState,
                            studyField: this.editStudyField
                        })
                        .then(res => {

                            this.loading = false

                            if(res.data.success == true){

                                swal({
                              
                                    text:res.data.msg,
                                    icon:"success"
                                })

                                this.editCollege= ""
                                this.editEducationalLevel = ""
                                this.editStartDate = ""
                                this.editEndDate = ""
                                this.editState  = ""
                                this.academicId = ""
                                this.editStudyField = ""

                                $("#modalClose").click();
                                $('body').removeClass('modal-open');
                                $('body').css('padding-right', '0px');
                                $('.modal-backdrop').remove();

                                this.fetchAcademicBg()

                            }else{

                                swal({
                                    title:"Lo sentimos",
                                    text:res.data.msg,
                                    icon:"error"
                                })

                            }

                        })
                        .catch(err => {
                            this.loading = false
                            $.each(err.response.data.errors, function(key, value) {
                                alertify.error(value[0])
                
                            });
                        })
                        

                    }

                },
                eraseAcademicBg(id){

                    swal({
                        title: "¿Estás seguro?",
                        text: "Eliminarás este antecedente académico!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            
                            axios.post("{{ url('/profile/academic/delete') }}", {id: id})
                            .then(res => {

                                if(res.data.success == true){

                                    swal({
                                    
                                        text:res.data.msg,
                                        icon:"success"
                                    })

                                    this.fetchAcademicBg()

                                }else{

                                    swal({
                                        title:"Lo sentimos",
                                        text:res.data.msg,
                                        icon:"error"
                                    })

                                }

                            })


                        }
                    });

                },
                editJB(job){
                    this.jbId = job.id
                    this.editCompany = job.company
                    this.editJobBg = job.job
                    this.editStartDateBg = job.start_date
                    this.editEndDateBg = job.end_date
                },
                updateJobBg(){

                    this.loading = true

                    axios.post("{{ url('/profile/job-background/update') }}", {
                        id:this.jbId,
                        company:this.editCompany,
                        jobBg:this.editJobBg,
                        startDateBg:this.editStartDateBg,
                        endDateBg:this.editEndDateBg
                    })
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                           
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.jbId = ""
                            this.editCompany = ""
                            this.editJobBg = ""
                            this.editStartDateBg = ""
                            this.editEndDateBg = ""

                            $("#modalBgClose").click();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '0px');
                            $('.modal-backdrop').remove();

                            this.fetchJobBackground()

                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })
                    .catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
            
                        });
                    })


                },
                eraseJobBg(id){

                    swal({
                        title: "¿Estás seguro?",
                        text: "Eliminarás este antecedente académico!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            
                            axios.post("{{ url('/profile/academic/delete') }}", {id: id})
                            .then(res => {

                                if(res.data.success == true){

                                    swal({
                                     
                                        text:res.data.msg,
                                        icon:"success"
                                    })

                                    this.fetchAcademicBg()

                                }else{

                                    swal({
                                        title:"Lo sentimos",
                                        text:res.data.msg,
                                        icon:"error"
                                    })

                                }

                            })


                        }
                    });

                },
                isNumber(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                        evt.preventDefault();;
                    } else {
                        return true;
                    }
                },
                storeJobResume(){

                    
                    this.loading = true
                    axios.post("{{ url('/profiles/job-resume/store') }}", {
                        jobDescription:this.jobDescription,
                        expYears:this.expYears,
                        availability:this.availability,
                        salary:this.salary,
                        desiredJob:this.desiredJob,
                        desiredArea:this.choosenDesiredArea.toString(),
                        functions:this.functions,
                        awards:this.awards,
                        moveRegions:this.choosenMoveRegion.toString()
                    })
                    .then(res => {
                        this.loading = false
                        if(res.data.success == true){
                            
                            swal({
                         
                                text:res.data.msg,
                                icon:"success"
                            })

                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })
                    .catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
                        });
                    })

                    

                },
                fetchJobBackground(){

                    axios.get("{{ url('/profiles/job-background/fetch') }}")
                    .then(res => {

                        if(res.data.success == true){
                            this.jobBackgrounds = res.data.jobBgs
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })
                    

                },
                dateFormatter(date){
                    
                    let year = date.substring(0, 4)
                    let month = date.substring(5, 7)
                    let day = date.substring(8, 10)
                    return day+"-"+month+"-"+year
                },
                storeJobBackground(){
                    
                
                
                    this.loading = true
                    axios.post("{{ url('/profiles/job-background/store') }}", {
                        company:this.company,
                        jobBg:this.jobBg,
                        startDateBg:this.startDateBg,
                        endDateBg:this.endDateBg
                    })
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                       
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.company= ""
                            this.jobBg = ""
                            this.startDateBg = ""
                            this.endDateBg = ""

                            this.fetchJobBackground()

                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })
                    .catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
            
                        });
                    })
                    

                },
                storeOthers(){
                    
                    
                    this.loading = true
                    axios.post("{{ url('/profiles/others/store') }}", {
                        informaticKnowledge:this.choosenInformaticKnowledge.toString(),
                        knowledgeHabilities:this.knowledgeHabilities,
                        licenseA1: this.licenseA1,
                        licenseA2: this.licenseA2,
                        licenseA3: this.licenseA3,
                        licenseA4: this.licenseA4,
                        licenseA5: this.licenseA5,
                        licenseB: this.licenseB,
                        licenseC: this.licenseC,
                        licenseD: this.licenseD,
                        licenseE: this.licenseE,
                        licenseF: this.licenseF,
                        handicapDescription:this.handicapDescription,
                        necesaryCondition:this.necesaryCondition,
                        handicapPercentage: this.handicapPercentage
                    })
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                       
                                text:res.data.msg,
                                icon:"success"
                            })

                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })
                    .catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
            
                        });
                    })
                        
                    

                },
                selectMoveRegion(){

                    if(this.moveRegions.length < 3){
                        var exists = false
                        this.moveRegions.forEach((data) =>{

                            if(data.id == this.moveRegion.id){
                                exists = true
                            }

                        })

                        if(!exists)
                            this.moveRegions.push(this.moveRegion)
                    }

                    this.moveRegion = ""
                    

                },
                setDesiredArea(){


                    var exists = false
                    this.desiredAreas.forEach((data) =>{

                        if(data.id == this.desiredArea.id){
                            exists = true
                        }

                    })

                    if(!exists)
                        this.desiredAreas.push(this.desiredArea)
                 

                    this.desiredArea = ""

                },
                removeDesiredArea(desiredArea){

                    var i = ""
                    
                    this.desiredAreas.forEach((data, index) => {

                        if(data.id == desiredArea){
                            i = index
                        }

                    })

                    this.desiredAreas.splice(i, 1)

                },
                removeMoveRegion(region){
                    
                    var i = ""
                    this.moveRegions.forEach((data, index) => {

                        if(data.id = region){
                            i = index
                        }

                    })

                    this.moveRegions.splice(i, 1)

                },
                validate(){

                    this.loading = true

                    axios.post("{{ url('/profiles/validate-user') }}").then(res => {
                        this.loading = false
                        
                        if(res.data.success == true){
                            
                            swal({
                        
                                text:res.data.msg,
                                icon:"success"
                            })

                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })


                }
                    
            },
            mounted(){

                this.country = "{{ $user->profile->country_id }}"
                if(this.country == ""){
                    this.country = 4
                }

                let explode = this.driverLicense.split(",")
                explode.forEach((data) =>{
                    
                    if(data != ""){
                        let result = data.split(":")
                        if(result[0].trim() == "licenseA1"){
                            this.licenseA1 = result[1]
                        }
                        else if(result[0].trim() == "licenseA2"){
                            this.licenseA2 = result[1]
                        }
                        else if(result[0].trim() == "licenseA3"){
                            this.licenseA3 = result[1]
                        }
                        else if(result[0].trim() == "licenseA4"){
                            this.licenseA4 = result[1]
                        }
                        else if(result[0].trim() == "licenseA5"){
                            this.licenseA5 = result[1]
                        }
                        else if(result[0].trim() == "licenseB"){
                            this.licenseB = result[1]
                        }
                        else if(result[0].trim() == "licenseC"){
                            this.licenseC = result[1]
                        }
                        else if(result[0].trim() == "licenseD"){
                            this.licenseD = result[1]
                        }
                        else if(result[0].trim() == "licenseE"){
                            this.licenseE = result[1]
                        }
                        else if(result[0].trim() == "licenseF"){
                            this.licenseF = result[1]
                        }
                    }
                    

                })

                let explodeInformatic = this.informaticKnowledge.split(",")
                this.choosenInformaticKnowledge = explodeInformatic

                this.informaticKnowledgeList.forEach((data) => {
                    
                    this.choosenInformaticKnowledge.forEach((data2) => {

                        if(data.id == data2){
                            this.choosenInformaticKnowledgeNames.push(data.name)
                        }

                    })
                    
                })

                this.toggleTabs("basico")
                this.fetchCountries()
                this.fetchRegions()
                this.fetchAcademicBg()
                this.fetchJobBackground()
                this.fetchJobCategories()
                window.setTimeout(() => {
                    this.fetchCommunes()
                }, 1000);
            }

        })
    </script>

@endpush