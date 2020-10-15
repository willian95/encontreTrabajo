@extends("layouts.admin")

@section("content")
    
    <div id="dev-news">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="container">
                
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Noticias
                            </div>

                            <div class="card-toolbar">

                                <!--begin::Button-->
                                <a class="btn btn-primary" href="{{ url('/admin/news/create') }}">
                                    Crear noticia
                                </a>
                                <!--end::Button-->
                            </div>
        
                        </div>

                        <div class="card-body">
                            <!--begin: Datatable-->

                            <table class="table table-bordered table-checkable" id="kt_datatable" style="margin-top: 15px;">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(notice, index) in news">
                                        
                                        <td>@{{ notice.title }}</td>
                                        <td>@{{ notice.created_at.substring(0, 10) }}</td>
                                        <td>
                                            <a class="btn btn-success" :href="'{{ url('/admin/news/edit/') }}'+'/'+notice.id">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-secondary" @click="erase(notice.id)">
                                                <i class="fas fa-times"></i>
                                            </button>
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
                                                <a href="#" aria-controls="kt_datatable" tabindex="0" class="page-link":key="index" @click="search(index)" >@{{ index }}</a>
                                            </li>
                                            
                                            <li class="paginate_button page-item next" id="kt_datatable_next" v-if="page < pages" href="#">
                                                <a href="#" aria-controls="kt_datatable" data-dt-idx="7" tabindex="0" class="page-link" @click="search(page + 6)">
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
            el: '#dev-news',
            data(){
                return{
                    news:[],
                    pages:0,
                    page:1,
                }
            },
            methods:{
            
                fetch(page = 1){

                    this.page = page
                    axios.get("{{ url('/admin/news/fetch') }}"+"/"+this.page)
                    .then(res => {

                        if(res.data.success == true){

                            this.news = res.data.notices
                            this.pages = Math.ceil(res.data.noticesCount / res.data.dataAmount)
                            
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })

                },
                erase(id){

                    swal({
                        title: "¿Estás seguro?",
                        text: "Eliminarás esta noticia",
                        icon: "warning",
                        dangerMode:true,
                        buttons: true,
                        buttons: ["No!", "Sí!"]
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            this.loading = true
                            axios.post("{{ url('/admin/news/delete') }}", {id: id}).then(res => {
                                this.loading = false
                                if(res.data.success == true){
                                    swal({
                                        text:res.data.msg,
                                        icon:"success"
                                    })

                                    this.fetch(this.page)

                                }else{
                                    swal({
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