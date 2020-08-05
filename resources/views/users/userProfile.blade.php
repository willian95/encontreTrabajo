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
                                <input type="file" class="form-control" id="video" @change="onVideoChange" accpet="video/*">

                            </div>
                            <div class="col-md-4 media-perfil-c-4">
                                <div class="a-basicos-postulante-curriculum j-center">
                                    <img class="basicos-postulante-c-4" src="{{ asset('user/assets/img/icons8-contrato-de-trabajo-100.png') }}" alt="postulante" v-if="curriculumPreview == ''">

                                    <img class="basicos-postulante-c-4" style="width: 100%; cursor: pointer;" src="{{ asset('user/assets/img/document-download-outline.png') }}" alt="postulante" v-if="curriculumPreview != ''" @click="download()">                               
                                </div>
                                <label for="curriculum">Curriculum</label>
                                <input type="file" class="form-control" id="curriculum" @change="onCurriculumChange" accpet="file/pdf">
                                <small>Solo está permitido el formato PDF</small>

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
                                            <label for="city">Ciudad</label>
                                            <input type="text" class="form-control" id="city" v-model="city">
                                        </div>
                                    </div>
                                    <div class="row inf-perfil">

                                        <div class="col">
                                            <label for="region">Región</label>
                                            <select class="form-control" id="region" v-model="region" @change="fetchCommunes()">
                                                <option :value="region.id" v-for="region in regions">@{{ region.name }}</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="commune">Comuna</label>
                                            <select class="form-control" id="commune" v-model="commune">
                                                <option :value="commune.id" v-for="commune in communes">@{{ commune.name }}</option>
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
                        <form action="/action_page.php">
                            <div class="row a-academicos-form">
                            <div class="col ">
                            <div class="form-group">
                                <label for="college">Institución </label>
                                <input type="text" class="form-control" id="college" v-model="college">
                            </div>
                            </div>
                            <div class="col ">
                            <div class="form-group">
                                <label for="educationalLevel">Nivel Educacional</label>
                                <input type="text" class="form-control" id="educationalLevel" v-model="educationalLevel">
                            </div>
                            </div>
                            <div class="col ">
                              <div class="form-group">
                                  <label for="startDate">Fecha de Inicio</label>
                                  <input type="date" class="form-control" id="startDate" v-model="startDate">
                              </div>
                              </div>
                              <div class="col ">
                              <div class="form-group">
                                  <label for="endDate">Fecha de Culminación</label>
                                  <input type="date" class="form-control" id="endDate" v-model="endDate">
                              </div>
                              </div>
                              <div class="col ">
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
                            </div>
                            <div class="buttom-content-add">
                                <button type="button" class="btn btn-primary" @click="storeAcademicBg()">Agregar</button>
                            </div>
                          
                        </form>
                        <div>
                                <div class="container content-table-a-academico">
              
                                  <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Institución</th>
                                        <th>Nivel Educacional</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Estado</th>
                                        <th>Eliminar</th>
                                    
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr v-for="(academicBg, index) in academicBgs">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ academicBg.college }}</td>
                                        <td>@{{ academicBg.educational_level }}</td>
                                        <td>@{{ academicBg.start_date }}</td>
                                        <td>@{{ academicBg.end_date }}</td>
                                        <td>@{{ academicBg.state }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="eraseAcademicBg(academicBg.id)"><i class="fas fa-trash"></i></button>
                                        </td>
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
                    <div class="col ">
                        <label for="jobdescription">Resumen Laboral</label><br>
                        <textarea v-model="jobDescription" id="jobdescription" class="form-control"></textarea>
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
                <div class="buttom-content-rlaboral">
                        <button type="submit" class="btn btn-primary" @click="storeJobResume()">Actualizar</button>
                    </div>


              </div>


              <div id="labora" class="container tab-pane fade"><br>
                <form action="/action_page.php">
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
                          <label for="endDateBg">Fecha de Culminación</label>
                          <input type="date" class="form-control" id="endDateBg"  v-model="endDateBg">
                      </div>
                      </div>
                    
                    </div>
                    <div class="buttom-content-add">
                        <button type="button" class="btn btn-primary" @click="storeJobBackground()">Agregar</button>
                    </div>
                  
                </form>
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
                    <div class="buttom-content-up">
                        <button type="button" class="btn btn-primary" @click="storeOthers()">Actualizar</button>
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
                    imagePreview:"{{ Auth::user()->image }}",
                    video:"",
                    videoPreview:"{{ $user->profile->video }}",
                    curriculum:"",
                    curriculumPreview:"{{ $user->profile->curriculum }}",
                    name:"{{ Auth::user()->name }}",
                    lastname:"{{ Auth::user()->lastname }}",
                    rut:"{{ $user->profile->rut }}",
                    birthDate:"{{ $user->profile->birth_date }}",
                    gender:"{{ $user->profile->gender }}",
                    civilState:"{{ $user->profile->civil_state }}",
                    address:"{{ $user->profile->address }}",
                    city:"{{ $user->profile->city }}",
                    region:"{{ Auth::user()->region_id }}",
                    commune:"{{ Auth::user()->commune_id }}",
                    handicap:"{{ $user->profile->handicap ? $user->profile->handicap : 'no' }}",
                    email:"{{ Auth::user()->email }}",
                    phone:"{{ $user->profile->phone }}",
                    homePhone:"{{ $user->profile->home_phone }}",
                    loading:false,
                    academicBgs:[],
                    college:"",
                    educationalLevel:"",
                    startDate:"",
                    endDate:"",
                    state:"",
                    jobCategories:[],
                    jobDescription:"{{ $user->profile->job_description }}",
                    expYears:"{{ $user->profile->experience_year }}",
                    availability:"{{ $user->profile->availability }}",
                    salary:"{{ $user->profile->salary }}",
                    desiredJob:"{{ \Auth::user()->desired_job }}",
                    desiredArea:"{{ $user->profile->desired_area }}",
                    jobBackgrounds:[],
                    company:"",
                    jobBg:"",
                    startDateBg:"",
                    endDateBg:"",
                    informaticKnowledge:"{{ $user->profile->informatic_knowledge }}",
                    knowledgeHabilities:"{{ $user->profile->knowledge_habilities }}",
                    driverLicense:"{{ $user->profile->driver_license }}",
                    handicapDescription:"{{ $user->profile->handicap_description }}",
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
                        }

                    })

                },
                fetchCommunes(){

                    axios.get("{{ url('/communes/fetch/') }}"+"/"+this.region).then(res => {

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
                        city:this.city,
                        region:this.region,
                        commune:this.commune,
                        handicap:this.handicap,
                        phone:this.phone,
                        homePhone:this.homePhone,
                    })
                    .then(res => {

                        this.loading = false
                        if(res.data.success == true){
                            
                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                        }else{

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
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
                        alertify.error("Fecha de culminación es requerida")

                    }else{

                        axios.post("{{ url('/profile/academic/store') }}", {
                            college:this.college,
                            educationalLevel:this.educationalLevel,
                            startDate:this.startDate,
                            endDate:this.endDate,
                            state:this.state,
                        })
                        .then(res => {

                            this.loading = false

                            if(res.data.success == true){

                                swal({
                                    title:"Genial",
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
                                        title:"Excelente",
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
                        desiredArea:this.desiredArea,
                    })
                    .then(res => {
                        this.loading = false
                        if(res.data.success == true){
                            
                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                        }else{

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
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
                storeJobBackground(){
                    
                    this.loading = true
                    axios.post("{{ url('/profiles/job-background/store') }}", {
                        company:this.company,
                        jobBg:this.jobBg,
                        startDateBg:this.startDateBg,
                        endDateBg:this.endtDateBg
                    })
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                                title:"Genial",
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
                        informaticKnowledge:this.informaticKnowledge,
                        knowledgeHabilities:this.knowledgeHabilities,
                        driverLicense:this.driverLicense,
                        handicapDescription:this.handicapDescription
                    })
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                                title:"Genial",
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

                }
                    
            },
            mounted(){
                this.toggleTabs("basico")
                this.fetchRegions()
                this.fetchAcademicBg()
                this.fetchJobBackground()
                this.fetchJobCategories()
                window.setTimeout(() => {
                    this.fetchCommunes()
                }, 200);
            }

        })
    </script>

@endpush