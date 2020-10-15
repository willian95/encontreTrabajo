@extends("layouts.secondaryViews")

@section("content")

    <div class="container mt-3 perfil-encontre-trabajo" id="dev-job-reference">
        <div class="loader-cover" v-if="loading == true">
            <div class="loader"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Referencias laborales</h3>
            </div>
            <div class="col-12">
                <div class="row a-academicos-form">
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="personName">Nombre de la persona quien dará la referencia</label>
                            <input type="text" class="form-control" id="personName" v-model="personName">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="personJobPosition">Cargo de la persona quien dará la referencia laboral</label>
                            <input type="text" class="form-control" id="personJobPosition" v-model="personJobPosition">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="businessName">Nombre de la empresa </label>
                            <input type="text" class="form-control" id="businessName" v-model="businessName">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="personTelephone">Teléfono de referencia</label>
                            <input type="text" class="form-control" id="personTelephone" v-model="personTelephone">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="personMail">Correo Electrónico</label>
                            <input type="text" class="form-control" id="personMail" v-model="personMail">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="buttom-content-add text-center" v-if="references.length < 3">
                            <button type="button" class="btn btn-primary" @click="store()">Agregar</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Nombre</th>
                                    <th>Cargo</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(reference, index) in references">

                                    <td>@{{ reference.business_name }}</td>
                                    <td>@{{ reference.person_name }}</td>
                                    <td>@{{ reference.person_job_position }}</td>
                                    <td>@{{ reference.person_telephone }}</td>
                                    <td>@{{ reference.person_email }}</td>
                                    <td>
                                        <button class="btn btn-info" @click="editReference(reference)" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" @click="eraseReference(reference.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar referencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="businessName">Nombre de la empresa </label>
                                <input type="text" class="form-control" id="businessName" v-model="editBusinessName">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="personName">Nombre de la persona quien dará la referencia</label>
                                <input type="text" class="form-control" id="personName" v-model="editPersonName">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="personJobPosition">Cargo de la persona quien dará la referencia laboral</label>
                                <input type="text" class="form-control" id="personJobPosition" v-model="editPersonJobPosition">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="personTelephone">Teléfono de referencia</label>
                                <input type="text" class="form-control" id="personTelephone" v-model="editPersonTelephone">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="personMail">Correo Electrónico</label>
                                <input type="text" class="form-control" id="personMail" v-model="editPersonMail">
                            </div>
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="update()">Actualizar</button>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

@endsection

@push("scripts")

<script>
        const devArea = new Vue({
            el: '#dev-job-reference',
            data() {
                return {
                    loading:false,
                    id:"",
                    references:[],
                    businessName:"",
                    personName:"",
                    personJobPosition:"",
                    personTelephone:"",
                    personMail:"",
                    editBusinessName:"",
                    editPersonName:"",
                    editPersonJobPosition:"",
                    editPersonTelephone:"",
                    editPersonMail:"",
                    errors:[],
                    page:1,
                    pages:0

                }
            },
            methods: {

                store(){
                    this.loading= true
                    axios.post("{{ url('/my-references/store') }}", {"business_name": this.businessName, "person_name": this.personName, "person_job_position": this.personJobPosition, "person_telephone": this.personTelephone, "person_mail": this.personMail}).then(res => {
                        this.loading= false
                        if(res.data.success == true){
                            
                            swal({
                              
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.businessName = ""
                            this.personName = ""
                            this.personJobPosition = ""
                            this.personTelephone = ""
                            this.personMail = ""

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
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
            
                        });
                    })

                },
                update(){
                    this.loading= true
                    axios.post("{{ url('/my-references/update') }}", {"business_name": this.editBusinessName, "person_name": this.editPersonName, "person_job_position": this.editPersonJobPosition, "person_telephone": this.editPersonTelephone, "person_mail": this.editPersonMail, id: this.id}).then(res => {
                        this.loading= false
                        if(res.data.success == true){
                            
                            swal({
                             
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.editBusinessName = ""
                            this.editPersonName = ""
                            this.editPersonJobPosition = ""
                            this.editPersonTelephone = ""
                            this.editPersonMail = ""

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
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
            
                        });
                    })

                },
                fetch(){

                    this.loading= true
                    axios.get("{{ url('/my-references/fetch') }}").then(res => {
                        this.loading = false
                        this.references = res.data.references
                    })  

                },
                editReference(reference){
                    this.id = reference.id
                    this.editBusinessName = reference.business_name
                    this.editPersonName = reference.person_name
                    this.editPersonJobPosition  = reference.person_job_position
                    this.editPersonTelephone = reference.person_telephone
                    this.editPersonMail = reference.person_email

                },
                eraseReference(id){

                    swal({
                        title: "¿Estás seguro?",
                        text: "Eliminarás ésta referencia!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            this.loading = true
                            axios.post("{{ url('/my-references/delete') }}", {id: id}).then(res => {
                                this.loading= false
                                if(res.data.success == true){
                                    
                                    swal({
                                     
                                        text:res.data.msg,
                                        icon:"success"
                                    })

                                    this.fetch()

                                }else{

                                    swal({
                                        title:"Lo sentimos",
                                        text:res.data.msg,
                                        icon:"error"
                                    })

                                }
                            })
                    
                        }
                    })
                }

            },
            mounted(){
                
              this.fetch()
                

            }

        })
    </script>

@endpush