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
                                        <th>Cantidad de posts</th>
                                        <th>Cantidad de video-conferencias</th>
                                        <th>Precio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(plan, index) in plans">
                                        <th>@{{ index + 1 }}</th>
                                        <td>@{{ plan.title }}</td>
                                        <td>@{{ plan.post_amount.toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</td>
                                        <td>@{{ plan.conference_amount.toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</td>
                                        <td>$ @{{ plan.price.toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</td>
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
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control" id="title" v-model="title">
                            </div>

                            <div class="form-group">
                                <label for="postAmount">Cantidad de publicaciones</label>
                                <input type="text" class="form-control" id="postAmount" v-model="postAmount" @keypress="isNumber()">
                            </div>

                            <div class="form-group">
                                <label for="conferenceAmount">Cantidad de video conferencias</label>
                                <input type="text" class="form-control" id="conferenceAmount" v-model="conferenceAmount" @keypress="isNumber()">
                            </div>

                            <div class="form-group">
                                <label for="price">Precio</label>
                                <input type="text" class="form-control" id="price" v-model="price" @keypress="isNumber()">
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
                    postAmount:0,
                    conferenceAmount:0,
                    price:0,
                    action:"create",
                    loading:false,
                    plans:[]
                }
            },
            methods:{

                create(){
                    this.action = "create"
                    this.modalTitle = "Crear plan"
                    this.postAmount = 0
                    this.title = ""
                    this.conferenceAmount = 0
                    this.price = 0
                    this.id = ""

                },
                edit(plan){
                    this.action = "edit"
                    this.id = plan.id
                    this.modalTitle = "Editar plan"
                    this.title = plan.title
                    this.postAmount = plan.post_amount
                    this.conferenceAmount = plan.conference_amount
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
                        postAmount:this.postAmount,
                        conferenceAmount:this.conferenceAmount,
                        price:this.price
                    }).then(res => {
                       
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.title = ""
                            this.postAmount = ""
                            this.conferenceAmount = ""
                            this.price = ""

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
                    axios.post("{{ url('/admin/plans/update') }}", {
                        id: this.id,
                        title: this.title, 
                        postAmount:this.postAmount,
                        conferenceAmount:this.conferenceAmount,
                        price:this.price
                    }).then(res => {
                       
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Genial",
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.title = ""
                            this.postAmount = ""
                            this.conferenceAmount = ""
                            this.price = ""

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