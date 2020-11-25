@extends("layouts.admin")

@section("content")
    
    <div id="dev-users">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="container">
                
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Ofertas
                            </div>
        
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" v-model="query" placeholder="Titulos, empresas o cargos">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" @click="search()">Buscar!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered table-checkable" id="kt_datatable" style="margin-top: 15px;">
                                <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Titulo</th>
                                        <th>Rango salarial</th>
                                        <th>Puesto</th>
                                        <th>Categoría</th>
                                        <th>Status</th>
                                        <th>Estadísticas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(offer, index) in offers">
                                        <td>@{{ offer.user.business_name }}</td>
                                        <td>@{{ offer.title }}</td>
                                        <td v-if="offer.wage_type == 1">$ @{{ parseInt(offer.min_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} @{{ offer.extra_wage }}</td>
                                        <td v-else>A convenir</td>
                                        <td>@{{ offer.job_position }}</td>
                                        <td>@{{ offer.category.name }}</td>
                                        <td>@{{ offer.status }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#stadisticModal" @click="showStatiscitcs(offer.id)"><i class="fas fa-chart-area"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row" v-if="searching == false">
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
                            <div class="row" v-else>
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

            <!-- Modal-->
            <div class="modal fade" id="stadisticModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Estadística</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Visualizaciones</label>
                                        <p>@{{ viewers }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Propuestas</label>
                                        <p>@{{ proposals }}</p>
                                    </div>
                                </div>
                            </div>
                    
                            
                        </div>
                        <div class="modal-footer">
                            <button id="modalClose" type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
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
                    offers:[],
                    searching:false,
                    query:"",
                    proposals:0,
                    viewers:0,
                    pages:0,
                    page:1,
                }
            },
            methods:{
            
                fetch(page = 1){

                    this.page = page
                    axios.get("{{ url('/admin/offers/fetch') }}"+"/"+this.page)
                    .then(res => {

                        if(res.data.success == true){

                            this.offers = res.data.offers
                            this.pages = Math.ceil(res.data.offersCount / res.data.dataAmount)
                            
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })

                },
                search(page = 1){

                    if(this.query.length > 0){
                        this.page = page
                        this.searching = true
                        axios.post("{{ url('/admin/offers/search') }}", {search: this.query, page: this.page})
                        .then(res => {

                            if(res.data.success == true){

                                this.offers = res.data.offers
                                this.pages = Math.ceil(res.data.offersCount / res.data.dataAmount)
                                
                            }else{

                                swal({
                                    title:"Lo sentimos",
                                    text:res.data.msg,
                                    icon:"error"
                                })

                            }

                        })

                    }else{
                        this.searching = false
                        this.fetch()
                    }
                    
                },
                erase(id){

                    if(confirm("¿Está seguro?")){
                        axios.post("{{ url('/admin/user/delete') }}", {id: id}).then(res => {

                            this.fetch(this.page)

                        })
                    }

                },
                showStatiscitcs(id){
                    axios.post("{{ url('/admin/offers/statistics') }}", {"offer_id": id}).then(res => {

                        this.proposals = res.data.proposals
                        this.viewers = res.data.viewers

                    })
                }


            },
            mounted(){
                
                this.fetch()

            }

        })
    
    </script>

@endpush