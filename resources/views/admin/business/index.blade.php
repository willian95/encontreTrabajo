@extends("layouts.admin")

@section("content")
    
    <div id="dev-users">

        <div class="loader-cover-custom" v-if="loading == true">
            <div class="loader-custom"></div>
        </div>

        <div class="modal fade" id="sendEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enviar mensaje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" rows="5" v-model="text"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="sendEmail()">Enviar</button>
                </div>
                </div>
            </div>
        </div>

        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="container">
                
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Empresas
                            </div>
        
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Buscar</label>
                                        <input type="text" class="form-control" placeholder="Nombre o email" @keyup="search()" v-model="query"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ordenar por:</label>
                                        <select class="form-control" @change="fetch()" v-model="order">
                                            <option value="1">Nombre - ascendente</option>
                                            <option value="2">Nombre - descendente</option>
                                            <option value="3">Email - ascendente</option>
                                            <option value="4">Email - descendente</option>
                                            <option value="5">Creación - ascendente</option>
                                            <option value="6">Creación - descendente</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--begin: Datatable-->
                            <table class="table table-bordered table-checkable" id="kt_datatable">
                                <thead>
                                    <tr>
                                  
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Fecha de creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users">
                                        
                                        <td><a :href="'{{ url('/profile/show/') }}'+'/'+user.id">@{{ user.name }}</a></td>
                                        <td data-toggle="modal" data-target="#sendEmail" @click="setEmail(user.email)">@{{ user.email }}</td>
                                        <td>@{{ dateFormatter(user.created_at) }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="erase(user.id)">eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="kt_datatable_info" role="status" aria-live="polite">Mostrando página @{{ page }} de @{{ pages }}</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_full_numbers" id="kt_datatable_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="kt_datatable_previous" v-if="page > 1">
                                                <a href="#" aria-controls="kt_datatable" data-dt-idx="1" tabindex="0" class="page-link">
                                                    <i class="ki ki-arrow-back"></i>
                                                </a>
                                            </li>
                                            <li class="paginate_button page-item active" v-for="index in pages">
                                                <a href="#" aria-controls="kt_datatable" tabindex="0" class="page-link":key="index" @click="fetch(index)" >@{{ index }}</a>
                                            </li>
                                            
                                            <li class="paginate_button page-item next" id="kt_datatable_next" v-if="page < pages" href="#">
                                                <a href="#" aria-controls="kt_datatable" data-dt-idx="7" tabindex="0" class="page-link" @click="fetch(page + 6)">
                                                    <i class="ki ki-arrow-next"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end: Datatable-->
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
            el: '#dev-users',
            data(){
                return{
                    users:[],
                    pages:0,
                    page:1,
                    text:"",
                    email:"",
                    order:6,
                    query:"",
                    loading:false
                }
            },
            methods:{
            
                fetch(page = 1){

                    this.page = page

                    axios.get("{{ url('/admin/business/fetch/') }}"+"/"+page+"?order="+this.order)
                    .then(res => {

                        this.users = res.data.users
                        this.pages = Math.ceil(res.data.usersCount / 20)

                    })
                    .catch(err => {
                        $.each(err.response.data.errors, function(key, value){
                            alert(value)
                        });
                    })

                },
                erase(id){

                    if(confirm("¿Está seguro?")){
                        axios.post("{{ url('/admin/user/delete') }}", {id: id}).then(res => {

                            alert(res.data.msg)
                            this.fetch(this.page)

                        })
                    }

                },
                setEmail(email){
                    this.text = ""
                    this.email = email
                },
                dateFormatter(date){
                    
                    let year = date.substring(0, 4)
                    let month = date.substring(5, 7)
                    let day = date.substring(8, 10)
                    return day+"-"+month+"-"+year
                },
                sendEmail(){

                    this.loading = true
                    axios.post("{{ url('/admin/send/email') }}", {email: this.email, text: this.text}).then(res => {

                        this.loading= false
                        if(res.data.success == true){

                            this.text = ""

                            swal({
                                text:res.data.msg,
                                icon:"success"
                            })
                        }else{
                            swal({
                                text:res.data.msg,
                                icon:"error"
                            })
                        }

                    }).catch(err => {
                        this.loading = false
                        $.each(err.response.data.errors, function(key, value){
                            alertify.error(value[0])
                        });
                    })

                },
                search(){

                    if(this.query != ""){

                        axios.post("{{ url('/admin/user/searchBusiness') }}", {"search": this.query}).then(res => {

                            this.users = res.data.users
                            this.pages = 1

                        })

                    }else{
                        this.fetch()
                    }



                }


            },
            mounted(){
                
                this.fetch()

            }

        })
    
    </script>

@endpush