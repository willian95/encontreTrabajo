@extends("layouts.secondaryViews")

@section("content")


    <div class="container mt-3 perfil-encontre-trabajo" id="profile-dev">
        <div class="loader-cover" v-if="loading == true">
            <div class="loader"></div>
            </div>
            <h2>Mi Perfil</h2>
            <br>
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
                <a class="nav-link tabs-perfil-a" data-toggle="tab" href="#rlabora" @click="toggleTabs('rlabora')">
                    <div class="content-ico-tab">
                        <img class="ico-tab" src="{{ asset('user/assets/img/laboral.png') }}" alt="">
                    </div>
                    <h3>Resumen Laboral</h3>
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
                            <div class="a-basicos-postulante-img j-center"><img class="basicos-postulante-c-4" :src="imagePreview" alt="postulante"></div>
                            <label for="image">Foto de Perfil</label>

                        </div>
                        <div class="col-md-4 media-perfil-c-4">
                            <div class="a-basicos-postulante-video j-center">
                                <img class="basicos-postulante-c-4" src="{{ asset('user/assets/img/video.png') }}" alt="postulante" v-if="videoPreview == ''">
                                <video style="width: 100%;" controls id="productVideo" v-if="videoPreview != null && videoPreview != ''">
                                    <source :src="videoPreview" type="video/mp4">
                                </video>
                            </div>
                                <label for="video">Video de Presentación</label>


                            </div>
                            <div class="col-md-4 media-perfil-c-4">
                                <div class="a-basicos-postulante-curriculum j-center">
                                    <img class="basicos-postulante-c-4" src="{{ asset('user/assets/img/icons8-contrato-de-trabajo-100.png') }}" alt="postulante" v-if="curriculumPreview == ''">

                                    <img class="basicos-postulante-c-4" style="width: 100%; cursor: pointer;" src="{{ asset('user/assets/img/document-download-outline.png') }}" alt="postulante" v-if="curriculumPreview != ''" @click="download()">                               
                                </div>
                                <label for="curriculum">Curriculum</label>


                            </div>
                        </div>
                        <div class="content-abasico-basicos">
                            <div class="row inf-media-perfil-basicos">
                                <form action="/action_page.php">
                                    <div class="row inf-perfil">

                                        <div class="col">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" id="name" v-model="name" disabled>
                                        </div>

                                        <div class="col">
                                            <label for="lastname">Apellido</label>
                                            <input type="text" class="form-control" id="#" v-model="lastname" disabled>
                                        </div>
                            
                                        <div class="col ">
                                            <label for="rut">RUT</label>
                                            <input type="text" class="form-control" id="rut" v-model="rut" disabled>
                                        </div>
                                        
                                    </div>
                                    <div class="row inf-perfil">
                                        
                                        <div class="col">
                                            <label for="birthDate">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="birthDate" v-model="birthDate" disabled>
                                        </div>

                                        <div class="col">
                                            <label for="birthDate">Edad</label>
                                            <input type="date" class="form-control" value="{{ $age }}" disabled>
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

                    </div>
                </div>
              </div>
              <div id="academico" class="container tab-pane fade a-academicos"><br>
                <div class="content a-academicos">
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
           
              <div id="rlabora" class="container tab-pane fade"><br>
                <form action="/action_page.php">
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
                        <div class="col ">
                                <label for="expyears">Años de Experiencia</label>
                                <input type="text" class="form-control"  id="expyears"  v-model="expYears" @keypress="isNumber($event)">
                            </div>
                            <div class="col ">
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
                            <div class="col ">
                                  <label for="salary">Pretenciones de renta</label>
                                  <input type="text" class="form-control"  id="salary"  v-model="salary">
                              </div>
                              <div class="col ">
                                  <label for="desiredJob">Puesto deseado</label>
                                  <input type="text" class="form-control"  id="desiredJob"  v-model="desiredJob">
                              </div>
                              <div class="col ">
                                  <label for="desiredArea">Area de Preferencia</label>
                                  <select class="form-control" id="desiredArea" v-model="desiredArea">
                                    <option value="">Seleccione</option>
                                    <option :value="jobCategory.id" v-for="jobCategory in jobCategories">@{{ jobCategory.name }}</option>
                                  </select>
                              </div>
                  </div>
                    
                  
                </form>


              </div>


              <div id="labora" class="container tab-pane fade"><br>
                
                <div>
                  
                <div class="container">
                        
                        <table class="table table-bordered table-hover table-striped ">
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


              <div id="otro" class="container tab-pane fade"><br>
                <div class="content-otros">
                <form action="/action_page.php">
                    <div class="row a-academicos-form">
                    <div class="col ">
                    <div class="form-group">
                        <label for="text">Conocimientos Informáticos </label>
                        <textarea class="form-control" rows="8" id="conocimientos" v-model="informaticKnowledge"></textarea>
                    </div>
                    </div>
                    <div class="col ">
                    <div class="form-group">
                        <label for="text">Conocimientos y Habilidades</label>
                        <textarea type="text" rows="8" class="form-control" id="habilidades"  v-model="knowledgeHabilities"></textarea>
                    </div>
                    </div>
                    <div class="col ">
                      <div class="form-group">
                          <label for="text">Licencia de Conducir</label>
                          <input type="text" class="form-control" id="licencia"  v-model="driverLicense">
                      </div>
                      </div>
                      <div class="col ">
                      <div class="form-group">
                          <label for="text">Posee Discapacidad</label>
                          <input type="text" class="form-control" id="discapacidad"  v-model="handicapDescription">
                      </div>
                      </div>
                    
                    </div>
                  
                </form>
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
                    image:"",
                    imagePreview:"{{ $user->image }}",
                    video:"",
                    videoPreview:"{{ $profile->video }}",
                    curriculum:"",
                    countries:[],
                    country:"",
                    curriculumPreview:"{{ $profile->curriculum }}",
                    nationality:"{{ $profile->nationality }}",
                    name:"{{ $user->name }}",
                    lastname:"{{ $user->lastname }}",
                    rut:"{{ $profile->rut }}",
                    birthDate:"{{ $profile->birth_date }}",
                    gender:"{{ $profile->gender }}",
                    civilState:"{{ $profile->civil_state }}",
                    address:"{{ $profile->address }}",
                    country:"{{ $profile->country_id ? $profile->country_id : 4 }}",
                    region:"{{ $user->region_id }}",
                    commune:"{{ $user->commune_id }}",
                    handicap:"{{ $profile->handicap ? $profile->handicap : 'no' }}",
                    email:"{{ $user->email }}",
                    phone:"{{ $profile->phone }}",
                    homePhone:"{{ $profile->home_phone }}",
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
                    jobDescription:"{{ $profile->job_description }}",
                    functions:"{{ $profile->functions }}",
                    awards:"{{ $profile->awards }}",
                    expYears:"{{ $profile->experience_year }}",
                    availability:"{{ $profile->availability }}",
                    salary:"{{ $profile->salary }}",
                    desiredJob:"{{ $user->desired_job }}",
                    desiredArea:"{{ $profile->desired_area }}",
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
                    informaticKnowledge:"{{ $profile->informatic_knowledge }}",
                    knowledgeHabilities:"{{ $profile->knowledge_habilities }}",
                    driverLicense:"{{ $profile->driver_license }}",
                    handicapDescription:"{{ $profile->handicap_description }}",
                    regions:[],
                    communes:[]


                }
            },
            methods: {

                toggleTabs(tab){
                    $(".tab-pane").removeClass("active")
                    $(".tab-pane").css("display", "none")
                    $("#"+tab).css("display", "block")
                    $("#"+tab).addClass("active")
                },
                fetchRegions(){

                    axios.get("{{ url('/regions/fetch-all') }}").then(res => {

                        if(res.data.success == true){
                            this.regions = res.data.regions

                            this.regions.forEach((data) => {

                                if("{{ $user->region_id }}" == data.id){
                                    this.region = data
                                }

                            })

                            this.fetchCommunes()

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

                download(){
                    window.open(this.curriculumPreview, '_blank')
                },
                fetchAcademicBg(){

                    axios.post("{{ url('/profiles/show/academic/fetch') }}", {user_id: "{{ $user->id }}"})
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
                            
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })

                },
                fetchJobBackground(){

                    axios.post("{{ url('/profiles/show/job-background/fetch') }}", {user_id: "{{ $user->id }}"})
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
                    

                }
                    
            },
            mounted(){

                this.country = "{{ $profile->country_id }}"


                if(this.country == ""){
                    this.country = 4
                }

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