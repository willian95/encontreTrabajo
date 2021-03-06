@extends("layouts.secondaryViews")

@section("content")


    <div class="container container-perfil-usuario" id="profile-dev">
        <div class="loader-cover" v-if="loading == true">
            <div class="loader"></div>
        </div>
            <div class="row">
                @if($user->profile->is_curriculum_validated == 1 || $user->id == \Auth::user()->id )
                <div class="col-md-4 media-perfil-c-4">
                @else
                    <div class="col-md-4 media-perfil-c-4 offset-md-4">
                @endif
                        <div class="a-basicos-postulante-img j-center"><img class="basicos-postulante-c-4" :src="imagePreview" alt="postulante"></div>
                        <label class="text-center-input-curriculum" for="image">Foto de Perfil</label>
                    </div>

                    @if($user->profile->is_curriculum_validated == 1 || $user->id == \Auth::user()->id )
                    <div class="col-md-4 media-perfil-c-4">
                        <div class="a-basicos-postulante-video j-center">
                            <img class="basicos-postulante-c-4" src="{{ asset('user/assets/img/video.png') }}" alt="postulante" v-if="videoPreview == ''">
                            <video style="width: 100%;" controls id="productVideo" v-if="videoPreview != null && videoPreview != ''">
                                <source :src="videoPreview" type="video/mp4">
                            </video>
                        </div>
                            <label class="text-center-input-curriculum" for="video">Video de Presentación</label>
                    </div>
                    <div class="col-md-4 media-perfil-c-4">
                        <div class="a-basicos-postulante-curriculum j-center" v-if="curriculumPreview.substring(curriculumPreview.length - 3, curriculumPreview.length) == 'pdf' || curriculumPreview.substring(curriculumPreview.length - 3, curriculumPreview.length) == 'PDF'">
                                <img class="basicos-postulante-c-4" src="{{ asset('user/assets/img/icons8-contrato-de-trabajo-100.png') }}" alt="postulante" v-if="curriculumPreview == ''">
                            <iframe id="iframepdf" :src="curriculumPreview" v-if="curriculumPreview != ''"></iframe>                               
                        </div>
                        <label class="text-center-input-curriculum" for="curriculum">Currículum</label>
                        <p v-if="curriculumPreview" class="text-center">
                            <button class="btn btn-success" @click="download()">Descargar</button>
                        </p>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="content-abasico-basicos-curriculum">
                            <div class="row inf-media-perfil-basicos">
                                <div class="container antecedentes_container">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Antecedentes básicos</h2>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="name">Nombre Completo</label>
                                            <input type="text" class="form-control" id="name" v-model="name" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="rut">RUT</label>
                                            <input type="text" class="form-control" id="rut" v-model="rut" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="birthDate">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="birthDate" v-model="birthDate" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="birthDate">Edad</label>
                                            <input type="text" class="form-control" value="{{ $age }}" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="gender">Sexo</label><br>
                                            <input type="text" class="form-control" v-model="gender" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="civilState">Estado Civil</label>
                                            <input type="text" class="form-control" v-model="civilState" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="address">Dirección</label>
                                            <input type="text" class="form-control" id="address" v-model="address" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info" v-if="country == 4">
                                            <label for="region">Región</label>
                                            <select class="form-control" id="region" v-model="region" @change="fetchCommunes()" disabled>
                                                <option :value="region" v-for="region in regions">@{{ region.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info" v-if="country == 4">
                                            <label for="commune">Comuna</label>
                                            <select class="form-control" id="commune" v-model="commune" disabled>
                                                <option :value="commune.id" v-for="commune in communes">@{{ region.name }} - @{{ commune.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="handicap">Posee Discapacidad</label>
                                            <input type="text" class="form-control" id="address" v-model="handicap" disabled>
                                        </div>                                       
                                    </div>
                                </div>
                                <div class="container informacionc_container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Información de contacto</h2>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="mail">Mail</label>
                                            <input type="mail" class="form-control" id="mail" v-model="email" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for=homePhone>Teléfono Fijo</label>
                                            <input type="text" class="form-control" id="homePhone" v-model="homePhone" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="phone">Teléfono Celular</label>
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
                                                    <table class="table table-bordered table-hover table-striped offset-md-2 antecedentes_container-info" >
                                                        <thead>
                                                            <tr>
                                                            <th>#</th>
                                                            <th>Institución</th>
                                                            <th>Nivel Educacional</th>
                                                            <th>Campo de Estudio</th>
                                                            <th>Fecha de Inicio</th>
                                                            <th>Fecha Término</th>
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
                                            <div class="form-group offset-md-2 antecedentes_container-info">
                                                <label for="text">Resumen Laboral</label>
                                                <textarea v-model="jobDescription" id="jobdescription" class="form-control " rows="8" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="expyears">Años de Experiencia</label>
                                            <input type="text" class="form-control"  id="expyears"  v-model="expYears" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="salary">Pretenciones de renta</label>
                                            <input type="text" class="form-control"  id="salary"  v-model="salary" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="desiredJob">Puesto deseado</label>
                                            <input type="text" class="form-control"  id="desiredJob"  v-model="desiredJob" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pb-20 antecedentes_container-info">
                                            <label for="desiredArea">Área de Preferencia</label>
                                            <input type="text" class="form-control" v-model="desiredAreaString" disabled>
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="container ancedenteslaborales_container">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Antecedentes Laborales</h2>
                                        </div>
                                        <div class="col-12 container table-responsive-cv">
                                            <table class="table table-bordered table-hover table-striped offset-md-2 antecedentes_container-info">
                                                <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>Empresa</th>
                                                    <th>Puesto</th>
                                                    <th>Fecha de Inicio</th>
                                                    <th>Fecha Término</th>
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
                                            <div class="form-group offset-md-2 antecedentes_container-info">
                                                <label for="text">Conocimientos Informáticos </label>
                                                <textarea class="form-control" rows="8" id="conocimientos" v-model="informaticKnowledge" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 offset-lg-1">
                                            <div class="form-group offset-md-2 antecedentes_container-info">
                                                <label for="text">Conocimientos y Habilidades</label>
                                                <textarea type="text" rows="8" class="form-control" id="habilidades"  v-model="knowledgeHabilities" disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2 antecedentes_container-info">
                                            <div class="form-group">
                                                <label for="text">Licencia de Conducir</label>
                                                <input type="text" class="form-control" id="licencia"  v-model="driverLicenseString" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2 antecedentes_container-info">
                                            <label for="available">Disponibilidad de viaje</label>
                                            <input type="text" class="form-control" id="licencia" value="No" v-if="travelAvailable == 0" disabled>
                                            <input type="text" class="form-control" id="licencia" value="Sí" v-if="travelAvailable == 1" disabled>
                                        </div>
                                        <div class="col-md-8 offset-md-2 antecedentes_container-info">
                                            <div class="form-group">
                                                <label for="text">Tiene alguna discapacidad</label>
                                                <input type="text" class="form-control" id="discapacidad"  v-model="handicapDescription" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container ancedenteslaborales_container" v-if="references.length > 0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="text-center letra-azul" style="padding-top: 20px;">Referencias Laborales</h2>
                                        </div>
                                        <div class="col-12 container table-responsive-cv">
                                            <table class="table table-bordered table-hover table-striped offset-md-2 antecedentes_container-info">
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
                                                    <tr v-for="reference in references">
                                                        <td>Señor (a) @{{ reference.person_name }}</td>
                                                        <td>@{{ reference.business_name }}</td>
                                                        <td>@{{ reference.person_job_position }}</td>
                                                        <td>@{{ reference.person_telephone }}</td>
                                                        <td>@{{ reference.person_email }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-center">
                                                <a class="btn btn-info" href="{{ url('/profile/download/'.$user->id) }}" target="_blank">Imprimir/Descargar Curriculum</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="row media-perfil-basicos-publicidad d-flex" style="margin-top: 5rem;">
                            @if(App\Ad::where("id", 6)->first())
                                    <a href="{{ App\Ad::where('id', 6)->first()->link }}" target="_blank">
                                    
                                        @if(App\Ad::where('id', 6)->first()->type == 'video')
                                        <video style="height: 180px !important" controls>
                                            <source src="{{ App\Ad::where('id', 6)->first()->image }}" type="video/mp4">
                                        </video>
                                        @else
                                        <img style="height: 180px !important" src="{{ App\Ad::where('id', 6)->first()->image }}" alt="">
                                        @endif
                                        
                                    </a>
                                @endif
                                @if(App\Ad::where("id", 7)->first())
                                    <a href="{{ App\Ad::where('id', 7)->first()->link }}" target="_blank">
                                    
                                        @if(App\Ad::where('id', 7)->first()->type == 'video')
                                        <video style="height: 180px !important" controls>
                                            <source src="{{ App\Ad::where('id', 7)->first()->image }}" type="video/mp4">
                                        </video>
                                        @else
                                        <img style="height: 180px !important" src="{{ App\Ad::where('id', 7)->first()->image }}" alt="">
                                        @endif
                                        
                                    </a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>

       {{--<div class="row media-perfil-basicos-publicidad">
            <img class="publicidad" src="{{ asset('user/assets/img/login.jpg') }}" alt="publicidad">
            <img class="publicidad" src="{{ asset('user/assets/img/login.jpg') }}" alt="publicidad">
        </div>--}}


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
                    name:"{{ $user->name }} {{ $user->lastname }}",
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
                    travelAvailable:"{{ $user->profile->travel_available }}",
                    changeResidence:"{{ $user->profile->change_residence }}",
                    moveRegions:JSON.parse('{!! $moveRegions !!}'),
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
                    driverLicenseString:"",
                    handicapDescription:"{{ $profile->handicap_description }}",
                    necesaryCondition:"{{ $user->profile->necesary_condition }}",
                    handicapPercentage:"{{ $user->profile->handicap_percentage }}",
                    regions:[],
                    communes:[],
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
                    references:[],
                    choosenDesiredArea:[],
                    choosenDesiredAreaNames:[],
                    desiredAreaString:"{{ $profile->desired_areas }}"
                }
            },
            methods: {
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
                        console.log("academic", res)
                        if(res.data.success == true){

                            this.academicBgs = res.data.academicBgs
                            
                        }

                    })

                },
                fetchJobCategories(){

                    axios.get("{{ url('/job-categories/fetch-all') }}")
                    .then(res => {

                        if(res.data.success == true){

                            this.jobCategories = res.data.jobCategories

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
                            
                        }

                    })

                },
                fetchJobBackground(){

                    axios.post("{{ url('/profiles/show/job-background/fetch') }}", {user_id: "{{ $user->id }}"})
                    .then(res => {

                        if(res.data.success == true){
                            this.jobBackgrounds = res.data.jobBgs
                        }

                    })
                    

                },
                fetchJobReferences(){

                    axios.get("{{ url('/my-references/fetch-by-id') }}"+"/"+"{{ $user->id }}").then(res => {
                        this.references = res.data.references
                    })

                }
                    
            },
            mounted(){

                this.country = "{{ $profile->country_id }}"


                if(this.country == ""){
                    this.country = 4
                }
                
                if(this.driverLicense.length != ""){

                    var explode = this.driverLicense.split(",")
                    explode.forEach((data, index) =>{
                        
                        if(data != ""){
                            let result = data.split(":")
                            
                            if(result.length > 1){
                                if(result[1].trim() == "true"){
                                    let string = result[0].trim().substr(7, result[0].trim().length)
                                    this.driverLicenseString += string

                                    if(index + 2 < explode.length){
                                        this.driverLicenseString += ", "
                                    }
                                }
                            }
                        }
                        

                    })

                }else{

                    this.driverLicenseString = "No posee Licencia"

                }
                
                if(this.informaticKnowledge.length > 0){
                    let explodeInformatic = this.informaticKnowledge.split(",")
                    this.choosenInformaticKnowledge = explodeInformatic

                    this.informaticKnowledgeList.forEach((data) => {
                        
                        this.choosenInformaticKnowledge.forEach((data2) => {

                            if(data.id == data2){
                                this.choosenInformaticKnowledgeNames.push(data.name)
                            }

                        })
                        
                    })

                    this.informaticKnowledge = this.choosenInformaticKnowledgeNames.toString()
                }else{
                    this.informaticKnowledge = "No posee conocimientos informáticos"
                }

            
                this.fetchCountries()
                this.fetchRegions()
                this.fetchAcademicBg()
                this.fetchJobBackground()
                this.fetchJobCategories()
                this.fetchJobReferences()
                window.setTimeout(() => {
                    this.fetchCommunes()
                }, 1000);
            }

        })
    </script>

@endpush