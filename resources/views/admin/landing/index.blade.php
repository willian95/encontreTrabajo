@extends("layouts.admin")

@section("content")
    
    <div id="dev-business">
        <div class="loader-cover-custom" v-if="loading == true">
			<div class="loader-custom"></div>
		</div>
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="container">
                
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Empresas
                            </div>

                            <div class="card-toolbar">

                                <!--begin::Button-->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carouselModal" @click="create()">
                                    Nueva empresa
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
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(business, index) in businesses">
                                        <th>@{{ index + 1 }}</th>
                                        <td><img :src="business.image" alt="" style="width: 40%;"></td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#carouselModal" @click="edit(business)"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger" @click="erase(business.id)"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>

                </div>

            </div>
       

            <!-- Modal-->
            <div class="modal fade" id="carouselModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@{{ modalTitle }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="image">Imagen</label>
                                <input type="file" class="form-control" id="image" @change="onImageChange">
                                <img :src="imagePreview" alt="" style="width: 40%;">
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
            el: '#dev-business',
            data(){
                return{
                    id:"",
                    modalTitle:"Crear Empresa",
                    image:"",
                    imagePreview:"",
                    action:"create",
                    loading:false,
                    businesses:[]
                }
            },
            methods:{

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

                create(){
                    this.action = "create"
                    this.modalTitle = "Crear empresa"
                    this.image = ""
                    this.previewImage = ""
                    this.id = ""
                    $("#image").val(null)

                },
                edit(business){
                    this.action = "edit"
                    this.modalTitle = "Editar empresa"
                    this.image = ""
                    this.imagePreview =  business.image
                    this.id =  business.id
                },
                fetch(page = 1){

                    axios.get("{{ url('/admin/landing-business/fetch') }}")
                    .then(res => {

                        this.businesses = res.data.businesses

                    })

                },
                store(){
                    this.loading = true
                    axios.post("{{ url('/admin/landing-business/store') }}", {
                        image: this.image
                    }).then(res => {
                       
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.create()

                            $("#modalClose").click();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '0px');
                            $('.modal-backdrop').remove();

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
                    axios.post("{{ url('/admin/landing-business/update') }}", {
                        id: this.id,
                        image: this.image
                    }).then(res => {
                       
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                           this.create()

                            $("#modalClose").click();
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '0px');
                            $('.modal-backdrop').remove();

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
                        text: "Eliminarás esta empresa",
                        icon: "warning",
                        dangerMode:true,
                        buttons: true,
                        buttons: ["No!", "Sí!"]
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post("{{ url('/admin/landing-business/delete') }}", {id: id}).then(res => {

                                swal({
                                    title: res.data.msg,
                                    icon: "success",

                                });

                                this.fetch()

                            })
                        }
                    });

                }


            },
            mounted(){
                
                this.fetch()

            }

        })
    
    </script>

@endpush