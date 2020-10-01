@extends("layouts.user")

@section("content")

    <div class="col-md-8 resultados-busqueda" id="user-search-dev">
        <div class="row" v-cloak>   
            <h3><strong>Resultados de: </strong>@{{ search }}</h3>
            <div class="col-12 recor-a-cp">
                @if(\Auth::user()->is_profile_complete == 0)
                    <p class="rec-cperfil">Debes completar tu perfil para visualizar ofertas</p>
                    <img class="img-cperfil-alert" src="{{ asset('user/assets/img/alert.png') }}" alt="Alerta completa tu perfil">
                @endif
            </div>

            <div class="col-md-4" v-for="offer in offers">
                <div class="card">
                    <div class="card-body">
                        <p class="text-center price-op">
                            $ @{{ parseInt(offer.min_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} <span v-if="offer.max_wage != null">- $ @{{ parseInt(offer.max_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span>
                        </p>
                        <p class="text-center">
                            <img class="round-img" :src="offer.user.image" alt="Card image">
                        </p>
                        <p class="text-center text-b">@{{ offer.user.business_name }}</p>
                        <h5 class="card-title text-center">@{{ offer.job_position }}</h5>
                        <p class="card-text text-center">@{{ offer.title }}</p>
                        

                        @if(\Auth::user()->is_profile_complete == 1)
                            <p class="text-center">
                                <a :href="'{{ url('/offers/detail/') }}'+'/'+offer.slug" class="btn btn-primary">Ver más</a>
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-cloak>
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item" v-if="page > 1">
                            <a class="page-link" href="#" aria-label="Previous" @click="fetch(page -1)">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li v-for="index in pages" class="page-item" v-if="page == index && index >= page - 3 &&  index < page + 3"><a class="page-link" href="#" @click="fetch(index)">@{{ index }}</a></li>
                        <li class="page-item" v-if="page < pages">
                            <a class="page-link" href="#" aria-label="Next" @click="fetch(page + 3)">
                                <span aria-hidden="true">&raquo;</span>
                            </a>    
                        </li>
                    </ul>
                </nav>
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
                    search:"",
                    offers:"",
                    page:1,
                    pages:0
                }
            },
            methods: {
//
                async query(){

                    let offersRes = await axios.post("{{ url('/search') }}", {search: this.search, page: this.page})
                    if(offersRes.data.success == true){

                        this.offers = offersRes.data.offers
                        this.pages = Math.ceil(offersRes.data.offersCount / offersRes.data.dataAmount)
                        
                    }

                },


            },
            mounted(){
                
                this.search = window.localStorage.getItem("encontre_trabajo_query")
                this.query()
            }
        })

    </script>

@endpush