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
                            <select class="form-control" id="category" v-model="category">
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

                    <div class="col-12" v-for="offer in offers" style="margin-bottom: 1rem; padding-right: 2rem; padding-left: 2rem;">
                        <div class="card" @click="goToOffer('{{ url('/offers/detail/') }}'+'/'+offer.slug)" style="cursor:pointer;">
                            <div class="card-body" style="padding: 0.6rem !important">
                                <div class="row">
                                    <div class="col-3">
                                        <p class="text-center">
                                            <img class="round-img" :src="offer.user.image" alt="Card image" style="width: 75px;">
                                        </p>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="card-title" style="text-transform: capitalize;">@{{ offer.title.toLowerCase() }}</h5>
                                        <small class="text-b" style="text-transform: capitalize;">@{{ offer.job_position.toLowerCase() }}</small><br>
                                        <small class="text-b">@{{ offer.region.name }}, @{{ offer.commune.name }}</small>
                                    
                                        <p class="price-op" v-if="offer.wage_type == 1">
                                            $ @{{ parseInt(offer.min_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} @{{ offer.extra_wage }}
                                        </p>
                                        <p class="price-op" v-else>
                                            A convenir
                                        </p>
                                        <p v-if="offer.is_highlighted == 1">
                                            <strong>Aviso destacado</strong>
                                        </p>

                                        <small style="float:right">@{{ dateFormatter(offer.created_at) }}</small>
                                       
                                    </div>
                                    
                                
                                </div>

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

            <div class="col-md-2">
                @if(App\Ad::where("id", 8)->first())
                    <a href="{{ App\Ad::where('id', 8)->first()->link }}" target="_blank">
                    
                        @if(App\Ad::where('id', 8)->first()->type == 'video')
                        <video style="height: 180px !important" controls>
                            <source src="{{ App\Ad::where('id', 8)->first()->image }}" type="video/mp4">
                        </video>
                        @else
                        <img style="height: 180px !important" src="{{ App\Ad::where('id', 8)->first()->image }}" alt="">
                        @endif
                        
                    </a>
                @endif
                @if(App\Ad::where("id", 9)->first())
                    <a href="{{ App\Ad::where('id', 9)->first()->link }}" target="_blank">
                    
                        @if(App\Ad::where('id', 9)->first()->type == 'video')
                        <video style="height: 180px !important" controls>
                            <source src="{{ App\Ad::where('id', 9)->first()->image }}" type="video/mp4">
                        </video>
                        @else
                        <img style="height: 180px !important" src="{{ App\Ad::where('id', 9)->first()->image }}" alt="">
                        @endif
                        
                    </a>
                @endif
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

                        this.categories = res.data.jobCategories

                    })

                },
                dateFormatter(date){
                    
                    let year = date.substring(0, 4)
                    let month = date.substring(5, 7)
                    let day = date.substring(8, 10)

                    let hour = date.substring(11, 13)
                    let minute = date.substring(14, 16)

                    return day+"-"+month+"-"+year+" "+hour+":"+minute
                },
                goToOffer(link){
                    window.location.href=link
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