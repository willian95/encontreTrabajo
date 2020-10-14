@extends("layouts.admin")

@section("content")
    
    <div id="dev-plans">
        <div class="loader-cover-custom" v-if="loading == true">
			<div class="loader-custom"></div>
		</div>
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="container">
                
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Planes
                            </div>

                            <div class="card-toolbar">

                                <!--begin::Button-->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#planModal" @click="create()">
                                    Nuevo plan
                                </button>
                                <!--end::Button-->
                            </div>
        
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-checkable" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titulo</th>
                                        <th>Posición</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(plan, index) in plans">
                                        <th>@{{ index + 1 }}</th>
                                        <td>@{{ plan.title }}</td>
                                        <td>@{{ plan.position }}</td>
                                        <td>@{{ plan.price }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#planModal" @click="edit(plan)"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger" @click="erase(plan.id)"><i class="fas fa-trash"></i></button>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>

                </div>

            </div>
       

            <!-- Modal-->
            <div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@{{ modalTitle }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Titulo</label>
                                            <input type="text" class="form-control" id="title" v-model="title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postDays">Duración oferta (días)</label>
                                            <input type="text" class="form-control" id="postDays" v-model="postDays" @keypress="isNumber()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="planLength">Duración de plan</label>
                                            <select class="form-control" v-model="planLength" id="planLength">
                                                <option value="una vez">Una vez</option>
                                                <option value="semestrales">Semestrales</option>
                                                <option value="anuales">Anuales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="oferrPosting">Publicaciones de ofertas laborales</label>
                                            <select class="form-control" v-model="offerPosting" id="oferrPosting">
                                                <option value="1">Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="simplePostAmounts">Publicaciones simples</label>
                                            <div class="display:flex">
                                                <input type="text" class="form-control" id="simplePostAmounts" v-model="simplePostAmounts" @keypress="isNumber()" :readonly="simplePostInfinity">
                                                <button class="btn btn-secondary" @click="toggleSimplePostInfinity()">Infinitas</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="highlightPostAmount">Publicaciones destacadas</label>
                                            <input type="text" class="form-control" id="highlightPostAmount" v-model="highlightPostAmount" @keypress="isNumber()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="conferenceAmounts">Conferencias</label>
                                            <input type="text" class="form-control" id="conferenceAmounts" v-model="conferenceAmounts" @keypress="isNumber()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="downloadCurriculum">Descarga de curriculum</label>
                                            <select class="form-control" id="downloadCurriculum" v-model="downloadCurriculum">
                                                <option value="1">Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="show_video">Video de presentación del candidato</label>
                                            <select class="form-control" v-model="showVideo">
                                                <option value="1">Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="downloadProfilesAmounts">Perfiles a descargar</label>
                                            <input type="text" class="form-control" id="downloadProfilesAmounts" v-model="downloadProfilesAmounts" @keypress="isNumber()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">Posición</label>
                                            <select class="form-control" id="position" v-model="position">
                                                <option value="1">Fila 1</option>
                                                <option value="2">Fila 2</option>
                                                <option value="3">Fila 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Precio</label>
                                            <input type="text" class="form-control" id="price" v-model="price" @keypress="isNumber()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            
                        </div>
                        <div class="modal-footer">
                            <button id="modalClose" type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary font-weight-bold"  @click="store()" v-if="action == 'create'">Crear</button>
                            <button type="button" class="btn btn-primary font-weight-bold"  @click="update()" v-if="action == 'edit'">Actualizar</button>
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
            el: '#dev-plans',
            data(){
                return{
                    id:"",
                    modalTitle:"Crear plan",
                    title:"",
                    postDays:0,
                    planLength:0,
                    conferenceAmount:0,
                    offerPosting:1,
                    simplePostAmounts:"",
                    highlightPostAmount:"",
                    conferenceAmounts:"",
                    downloadCurriculum:1,
                    showVideo:1,
                    downloadProfilesAmounts:"",
                    position:1,
                    simplePostInfinity:false,
                    price:0,
                    action:"create",
                    loading:false,
                    plans:[]
                }
            },
            methods:{

                toggleSimplePostInfinity(){
             
                    if(this.simplePostInfinity == false){
                      
                        this.simplePostInfinity = true
                        this.simplePostAmounts = "infinitas";
                    }else{
                        this.simplePostInfinity = false
                        this.simplePostAmounts = "";
                    }

                },
                create(){
                    this.action = "create"
                    this.modalTitle = "Crear plan"
                    this.title = ""
                    this.postDays = 0
                    this.planLength = 0
                    this.conferenceAmount = 0
                    this.offerPosting = 1
                    this.simplePostAmounts = ""
                    this.highlightPostAmount = ""
                    this.conferenceAmounts = ""
                    this.downloadCurriculum= 1
                    this.showVideo = 1
                    this.downloadProfilesAmounts= ""
                    this.position = 1
                    this.simplePostInfinity= false
                    this.price = 0
                    this.id = ""

                },
                edit(plan){
                    this.action = "edit"
                    this.id = plan.id
                    this.modalTitle = "Editar plan"
                    this.title = plan.title
                    this.postDays = plan.post_days
                    this.planLength = plan.plan_time
                    this.offerPosting = plan.offer_posting
                    this.simplePostAmounts = plan.simple_posts
                    this.highlightPostAmount = plan.hightlight_posts
                    this.conferenceAmounts = plan.conference_amount
                    this.downloadCurriculum= plan.download_curriculum
                    this.showVideo = plan.show_video
                    this.downloadProfilesAmounts= plan.download_profiles
                    this.position = plan.position
                    this.simplePostInfinity= plan.simple_post_infinity

                    if(plan.simple_post_infinity == 1){
                        this.simplePostAmounts = "infinitas"
                    }

                    this.price = plan.price
                },
                fetch(page = 1){

                    axios.get("{{ url('/admin/plans/fetch') }}")
                    .then(res => {

                        this.plans = res.data.plans

                    })
                    

                },
                store(){
                    this.loading = true
                    axios.post("{{ url('/admin/plans/store') }}", {
                        title: this.title,
                        postDays: this.postDays,
                        planLength: this.planLength,
                        conferenceAmount: this.conferenceAmount,
                        offerPosting: this.offerPosting,
                        simplePostAmounts: this.simplePostAmounts,
                        hightlightPostAmount: this.highlightPostAmount,
                        conferenceAmounts: this.conferenceAmounts,
                        downloadCurriculum: this.downloadCurriculum,
                        showVideo: this.showVideo,
                        downloadProfile: this.downloadProfilesAmounts,
                        position: this.position,
                        simplePostInfinity: this.simplePostInfinity,
                        price: this.price
                    }).then(res => {
                       
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                           
                            this.create();


                            this.fetch()

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
                        $.each(err.response.data.errors, function(key, value){
                            alertify.error(value[0])
                        });
                    })

                },
                update(){
                    this.loading = true
                    axios.post("{{ url('/admin/plans/update') }}", {
                        id: this.id,
                        title: this.title,
                        postDays: this.postDays,
                        planLength: this.planLength,
                        conferenceAmount: this.conferenceAmount,
                        offerPosting: this.offerPosting,
                        simplePostAmounts: this.simplePostAmounts,
                        hightlightPostAmount: this.highlightPostAmount,
                        conferenceAmounts: this.conferenceAmounts,
                        downloadCurriculum: this.downloadCurriculum,
                        showVideo: this.showVideo,
                        downloadProfile: this.downloadProfilesAmounts,
                        position: this.position,
                        simplePostInfinity: this.simplePostInfinity,
                        price: this.price
                    }).then(res => {
                       
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.create();

                            this.fetch()

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
                        $.each(err.response.data.errors, function(key, value){
                            alertify.error(value[0])
                        });
                    })

                },
                erase(id){

                    swal({
                        title: "¿Estás seguro?",
                        text: "Eliminarás este plan",
                        icon: "warning",
                        dangerMode:true,
                        buttons: true,
                        buttons: ["No!", "Sí!"]
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post("{{ url('/admin/plans/delete') }}", {id: id}).then(res => {

                                swal({
                                    title: res.data.msg,
                                    icon: "success",

                                });

                                this.fetch()

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
                }


            },
            mounted(){
                
                this.fetch()

            }

        })
    
    </script>

@endpush