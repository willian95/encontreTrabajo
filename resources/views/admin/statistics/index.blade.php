@extends("layouts.admin")

@section("content")
    
    <div id="dev-statistics">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="loader-cover-custom" v-if="loading == true">
                    <div class="loader-custom"></div>
                </div>

                <div class="container">
                
                    <div class="card card-custom gutter-b" style="margin-top: 2rem;">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <div class="d-flex">
                                    <h3 class="card-label">Estadisticas - Usuarios</h3>
                                    <p style="margin-top: -2px;"><strong>Usuario: </strong>{{ App\User::where("role_id", 2)->count() }}</p>
                                    <p style="margin-top: -2px; margin-left: 40px;"><strong>Empresas: </strong>{{ App\User::where("role_id", 3)->count() }}</p>
                                </div>
                            </div>
        
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    
                                    <h4 class="text-center">Usuarios por fecha</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Fecha inicio</label>
                                                <input type="date" class="form-control" v-model="startDate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Fecha fin</label>
                                                <input type="date" class="form-control" v-model="endDate">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <p class="text-center">
                                                <button class="btn btn-success" @click="queryUsersDate()">Buscar</button>
                                            </p>
                                        </div>

                                        <div class="col-md-12">
                                            <p><strong>Total usuarios: </strong>@{{ usersByDate }}</p>
                                            <p><strong>Total empresas: </strong>@{{ businessByDate }}</p>
                                        </div>

                                    </div>
                                    
                                       
                                </div>

                                <div class="col-md-6">
                                    
                                    <h4 class="text-center">Usuarios por regiones</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="region">Region</label>
                                                <select class="form-control" v-model="selectedRegion" id="region" @change="fetchCommunes()">
                                                    <option value="0">Seleccione</option>
                                                    <option :value="region.id" v-for="region in regions">@{{ region.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="commune">Comuna</label>
                                                <select class="form-control" v-model="selectedCommune" id="commune">
                                                    <option value="0">Seleccione</option>
                                                    <option :value="commune.id" v-for="commune in communes">@{{ commune.name }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <p class="text-center">
                                                <button class="btn btn-success" @click="queryUsersLocation()">Buscar</button>
                                            </p>
                                        </div>

                                        <div class="col-md-12">
                                            <p><strong>Total usuarios: </strong>@{{ usersByLocation }}</p>
                                            <p><strong>Total empresas: </strong>@{{ businessByLocation }}</p>
                                        </div>

                                    </div>
                                    
                                       
                                </div>

                                <div class="col-md-6">
                                    
                                    <h4 class="text-center">Usuarios por edad</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ageStart">Edad inicio</label>
                                                <select class="form-control" v-model="ageStart" id="ageStart">
                                                    <option :value="i" v-for="i in 70" v-if="i >15">@{{ i }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ageEnd">Edad fin</label>
                                                <select class="form-control" v-model="ageEnd" id="ageEnd">
                                                    <option :value="i" v-for="i in 70" v-if="i >15">@{{ i }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <p class="text-center">
                                                <button class="btn btn-success" @click="queryUsersAge()">Buscar</button>
                                            </p>
                                        </div>

                                        <div class="col-md-12">
                                            <p><strong>Total usuarios: </strong>@{{ usersByAge }}</p>
                                        </div>

                                    </div>
                                    
                                       
                                </div>

                                <div class="col-md-6">
                                    
                                    <h4 class="text-center">Usuarios por Género</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ageStart">Hombres</label>
                                                <p>{{ App\Profile::with("user")->whereHas("user", function($q){ 
                                                    $q->where("role_id", 2);
                                                })->where("gender", "masculino")->count() }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="ageStart">Mujeres</label>
                                                    <p>{{ App\Profile::with("user")->whereHas("user", function($q){ $q->where("role_id", 2); })->where("gender", "femenino")->count() }}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                       
                                </div>

                                <div class="col-md-6">
                                    <h4 class="text-center">Usuarios por estado civil</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            
                                                <p><strong>Soltero: </strong>{{ App\Profile::with("user")->whereHas("user", function($q){ 
                                                    $q->where("role_id", 2);
                                                })->where("civil_state", "soltero")->count() }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <p><strong>Casado: </strong>{{ App\Profile::with("user")->whereHas("user", function($q){ $q->where("role_id", 2); })->where("gender", "casado")->count() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p><strong>Viudo: </strong>{{ App\Profile::with("user")->whereHas("user", function($q){ 
                                                    $q->where("role_id", 2);
                                                })->where("civil_state", "viudo")->count() }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <p><strong>Divorciado: </strong>{{ App\Profile::with("user")->whereHas("user", function($q){ $q->where("role_id", 2); })->where("civil_state", "divorciado")->count() }}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>  

                                <div class="col-md-6">
                                    <h4 class="text-center">Usuarios con discapacidad</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p><strong>Total: </strong>{{ App\Profile::with("user")->whereHas("user", function($q){ 
                                                    $q->where("role_id", 2);
                                                })->where("handicap", "si")->count() }}</p>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <h4 class="text-center">Niveles de estudio de usuarios</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p><strong>Básico: </strong> @if(isset($academicCount["Básico"])) {{ $academicCount["Básico"] }} @else 0 @endif</p>
                                                <p><strong>Medio: </strong> @if(isset($academicCount["Medio"])) {{ $academicCount["Medio"] }} @else 0 @endif</p>
                                                <p><strong>Técnico: </strong> @if(isset($academicCount["Técnico Profesional"])) {{ $academicCount["Técnico Profesional"] }} @else 0 @endif</p>
                                                <p><strong>Universitario: </strong>@if(isset($academicCount["Universitario"])) {{ $academicCount["Universitario"] }} @else 0 @endif</p>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>  

                                <div class="col-md-6">
                                    <h4 class="text-center">Puestos deseados </h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectedJob">Puesto</label>
                                                <select class="form-control" v-model="selectedJob" id="selectedJob">
                                                    <option :value="category.id" v-for="category in jobCategories">@{{ category.name }}</option>
                                                </select>
                          
                                                    <p class="text-center">
                                                        <button class="btn btn-success" @click="queryUsersJobCategory()">Buscar</button>
                                                    </p>
                                               
                                                <p><strong>Total: </strong>@{{ usersByCategory }}</p>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>  
                                
                                <div class="col-md-6">
                                    <h4 class="text-center">Búsqueda de usuarios </h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectedArea">Categoría</label>
                                                <select class="form-control" v-model="selectedArea" id="selectedArea">
                                                    <option :value="category.id" v-for="category in jobCategories">@{{ category.name }}</option>
                                                </select>
                          
                                                    <p class="text-center">
                                                        <button class="btn btn-success" @click="searchedCategory()">Buscar</button>
                                                    </p>
                                               
                                                <p><strong>Total: </strong>@{{ amountSearchedCategory }}</p>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>  
                                

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
        
        const app = new Vue({
            el: '#dev-statistics',
            data(){
                return{
                    usersByDate:0,
                    businessByDate:0,
                    usersByLocation:0,
                    businessByLocation:0,
                    usersByAge:0,
                    regions:[],
                    communes:[],
                    jobCategories:[],
                    usersByCategory:0,
                    selectedRegion:0,
                    selectedCommune:0,
                    selectedJob:"",
                    selectedArea:"",
                    amountSearchedCategory:0,
                    startDate:"",
                    endDate:"",
                    ageStart:16,
                    ageEnd:0,
                    pages:0,
                    page:1,
                    loading:false
                }
            },
            methods:{
            
                queryUsersDate(){
                    
                    this.loading = true
                    axios.post("{{ url('/admin/statistics/users/count') }}", {"startDate": this.startDate, "endDate": this.endDate}).then(res => {

                        this.loading=false
                        if(res.data.success == true){
                            this.usersByDate = res.data.users
                            this.businessByDate = res.data.business
                        }else{
                            swal({
                                icon:"error",
                                text:res.data.msg
                            })
                        }

                    })

                },
                queryUsersLocation(){
                    
                    this.loading = true
                    axios.post("{{ url('/admin/statistics/users/location/count') }}", {"region": this.selectedRegion, "commune": this.selectedCommune}).then(res => {

                        this.loading=false
                        if(res.data.success == true){
                            this.usersByLocation = res.data.users
                            this.businessByLocation = res.data.business
                        }else{
                            swal({
                                icon:"error",
                                text:res.data.msg
                            })
                        }

                    })

                },
                queryUsersAge(){
                    
                    this.loading = true
                    axios.post("{{ url('/admin/statistics/users/age/count') }}", {"ageStart": this.ageStart, "ageEnd": this.ageEnd}).then(res => {

                        this.loading=false
                        if(res.data.success == true){
                            this.usersByAge = res.data.users
                        }else{
                            swal({
                                icon:"error",
                                text:res.data.msg
                            })
                        }

                    })

                },
                fetchRegions(){
                    
                    axios.get("{{ url('/regions/fetch-all') }}").then(res => {
                        this.regions = res.data.regions
                    })

                },
                fetchCommunes(){
                    
                    axios.get("{{ url('//communes/fetch/') }}"+"/"+this.selectRegion).then(res => {
                        this.communes = res.data.communes
                    })

                },
                fetchJobCategories(){

                    axios.get("{{ url('/job-categories/fetch-all') }}")
                    .then(res => {

                        this.jobCategories = res.data.jobCategories

                    })

                },
                queryUsersJobCategory(){
                    this.loading = true
                    axios.post("{{ url('/admin/statistics/users/desired-area/count') }}", {area: this.selectedJob})
                    .then(res => {
                        this.loading = false
                        this.usersByCategory = res.data.areas

                    })
                },
                searchedCategory(){
                    this.loading = true
                    axios.post("{{ url('/admin/statistics/categories/count') }}", {job_category_id: this.selectedArea})
                    .then(res => {
                        this.loading = false
                        this.amountSearchedCategory = res.data.amount

                    })
                }


            },
            mounted(){
                
                this.fetchRegions()
                this.fetchJobCategories()

            }

        })
    
    </script>

@endpush