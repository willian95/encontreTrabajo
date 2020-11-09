@extends("layouts.secondaryViews")

@section("content")

    {{--<div class="col-md-8 resultados-busqueda" id="business-search-dev" style="margin-top: 100px;">
        <div class="row" v-cloak>   

            <div class="col-md-4" v-for="user in users">
                <div class="card">
                    <div class="card-body">
                        
                        <p class="text-center">
                            <img class="round-img" :src="user.users.user.image" alt="Card image">
                        </p>
                        <p class="text-center text-b">@{{ user.users.user.name }}</p>

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
                        <li v-for="index in pages" class="page-item" ><a class="page-link" href="#" @click="query(index)">@{{ index }}</a></li>
                        <!--<li class="page-item" v-if="page < pages">
                            <a class="page-link" href="#" aria-label="Next" @click="query(page + 3)">
                                <span aria-hidden="true">&raquo;</span>
                            </a>    
                        </li>-->
                    </ul>
                </nav>
            </div>
        </div>

    </div>--}}

    <div class="container" id="business-search-dev">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4>Búsqueda</h4>
                        <div class="form-group">
                            <label for="search">Edad mínima</label>  
                            <input type="text" class="form-control" id="minAge" v-model="minAge" @keypress="isNumber($event)">
                        </div>
                        <div class="form-group">
                            <label for="search">Edad máxima</label>  
                            <input type="text" class="form-control" id="maxAge" v-model="maxAge" @keypress="isNumber($event)">
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
                                        <h5 class="card-title">@{{ offer.job_position }}</h5>
                                        <small class="text-b">@{{ offer.user.region.name }}, @{{ offer.user.commune.name }}</small>
                                        <p class="price-op" v-if="offer.wage_type == 1">
                                            $ @{{ parseInt(offer.min_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}
                                        </p>
                                        <p class="price-op" v-else>
                                            A convenir
                                        </p>
                                        <p v-if="offer.is_highlighted == 1">
                                            <strong>Aviso destacado</strong>
                                        </p>
                                        {{--<p>
                                            @{{ offer.description.substring(0, 60) }}
                                            <span v-if="offer.description.length > 60">
                                                ...
                                            </span>
                                        </p>--}}
                                    </div>
                                    {{--<div class="col-12">
                                        <p class="text-right">
                                            <a :href="'{{ env('PLATFORM_URL') }}'+'/offers/detail/'+offer.slug" class="btn btn-primary">Ver más</a>
                                        </p>
                                    </div>--}}
                                
                                </div>

                            </div>
                        </div>
                    </div>

                    {{--<div class="col-md-12" v-for="offer in offers">
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
                    </div>--}}
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
                <img style="width: 100%;" class="publicidad" src="https://servertest.sytes.net/encontre-trabajo/public/assets/img/Banner-Epson-Movil.jpg" alt="publicidad">
                <img style="width: 100%;" class="publicidad" src="https://servertest.sytes.net/encontre-trabajo/public/assets/img/Banner-Epson-Movil.jpg" alt="publicidad">
            </div>
        </div>
    </div>


@endsection

@push("scripts")

    <script>

        const devArea = new Vue({
            el: '#business-search-dev',
            data() {
                return {
                    minAge:"",
                    maxAge:"",
                    regionSearch:"",
                    category:"",
                    users:[],
                    page:1,
                    pages:0
                }
            },
            methods: {
//
                async query(page = 1){

                    this.page = page

                    let userRes = await axios.post("{{ url('/business/search') }}", {minAge: this.minAge, maxAge: this.maxAge, regionSearch: this.regionSearch, category: this.category, page: this.page})
                    console.log(userRes)
                    

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
                
                this.search = window.localStorage.getItem("encontre_trabajo_categories_query")
                this.query()
            }
        })

    </script>

@endpush