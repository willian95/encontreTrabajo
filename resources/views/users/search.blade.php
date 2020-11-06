@extends("layouts.secondaryViews")

@section("content")

    <div class="container" id="user-search-dev">
        
        <div class="col-12 recor-a-cp">
            @if(\Auth::user()->is_profile_complete == 0)
                <p class="rec-cperfil">Debes completar tu perfil para postular ofertas</p>
                <img class="img-cperfil-alert" src="{{ asset('user/assets/img/alert.png') }}" alt="Alerta completa tu perfil">
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4>Búsqueda</h4>
                        <div class="form-group">
                            <label for="search">Búsqueda</label>  
                            <input type="text" class="form-control" id="search" v-model="jobSearch">
                        </div>
                        <div class="form-group">
                            <label for="region">Región</label>  
                            <select class="form-control" id="region" v-model="regionSearch">
                                <option value="">Seleccione</option>
                                <option :value="region.id" v-for="region in regions">@{{ region.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Categoría</label>  
                            <select class="form-control" id="category">
                                <option value="">Seleccione</option>
                                <option :value="jobCategory.id" v-for="jobCategory in categories">@{{ jobCategory.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="business">Empresa</label>  
                            <input type="text" class="form-control" id="business">
                        </div>

                        <p class="text-center">
                            <button class="btn btn-success" @click="query()">buscar</button>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-7 resultados-busqueda" id="user-search-dev">
                <div class="row" v-cloak>   

                    <div class="col-md-12" v-if="loading == true">
                        <p class="text-center">
                            Buscando resultados
                        </p>
                    </div>

                    <div class="col-md-12" v-if="loading == false && offers.length == 0">
                        <p class="text-center">
                            No se encontraron resultados
                        </p>
                    </div>

                    <div class="col-md-12" v-for="offer in offers">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center price-op" v-if="offer.wage_type == 1">
                                    $ @{{ parseInt(offer.min_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}
                                </p>
                                <p v-else>
                                    Sueldo a convenir
                                </p>
                                <p class="text-center">
                                    <img class="round-img" :src="offer.user.image" alt="Card image">
                                </p>

                                <h4 class="text-center" v-if="offer.is_highlighted == 1">Aviso Destacado</h4>

                                <p class="text-center text-b">@{{ offer.user.business_name }}</p>
                                <small class="text-b">@{{ offer.user.region.name }}, @{{ offer.user.commune.name }}</small>
                                <h5 class="card-title text-center">@{{ offer.job_position }}</h5>
                                <p class="card-text text-center">@{{ offer.title }}</p>
                                

                            
                                    <p class="text-center">
                                        <a :href="'{{ url('/offers/detail/') }}'+'/'+offer.slug" class="btn btn-primary">Ver más</a>
                                    </p>
                        

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" v-cloak>
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" v-if="page > 1">
                                    <a class="page-link" href="#" aria-label="Previous" @click="query(page -1)">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li v-for="index in pages" class="page-item" v-if="page == index && index >= page - 3 &&  index < page + 3"><a class="page-link" href="#" @click="query(index)">@{{ index }}</a></li>
                                <li class="page-item" v-if="page < pages">
                                    <a class="page-link" href="#" aria-label="Next" @click="query(page + 3)">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>    
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@push("scripts")

    <script>

        const devArea = new Vue({
            el: '#user-search-dev',
            data() {
                return {
                    jobSearch:"",
                    regionSearch:"",
                    offers:"",
                    category:"",
                    business:"",
                    categories:"",
                    regions:"",
                    loading:false,
                    page:1,
                    pages:0
                }
            },
            methods: {
//
                async query(page = 1){
                    this.page = page
                    this.loading = true
                    let offersRes = await axios.post("{{ url('/search') }}", {search: this.jobSearch, region: this.regionSeach, category: this.category, business: this.business, page: this.page})
                    this.loading = false
                    if(offersRes.data.success == true){
                        
                        this.offers = offersRes.data.offers
                        this.pages = Math.ceil(offersRes.data.offersCount / offersRes.data.dataAmount)
                        
                    }

                },
                fetchRegions(){

                    axios.get("{{ url('/regions/fetch-all') }}").then(res => {

                        this.regions = res.data.regions

                    })

                },
                fetchCategories(){

                    axios.get("{{ url('/job-categories/fetch-all') }}").then(res => {

                        this.categories = res.data.categories

                    })

                }

            },
            created(){

                this.query()
                this.fetchCategories()
                this.fetchRegions()
            }
        })

    </script>

@endpush