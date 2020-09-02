@extends("layouts.user")

@section("content")

    <div class="container-fluid" id="user-offers-dev">

        <div class="row">
            <div class="col-12 recor-a-cp">
                @if(\Auth::user()->is_profile_complete == 0)
                    <li>Debes completar tu perfil para crear ofertas</li>
                    <img class="img-cperfil-alert" src="{{ asset('user/assets/img/alert.png') }}" alt="Alerta completa tu perfil">
                @endif
                <h3 class="text-center">Mis ofertas</h3>
            </div>
        </div>

        <div class="row" v-cloak>
            <div class="col-md-4" v-for="offer in offers">
                <div class="card">
                    <div class="card-body">
                    <p class="text-center price-ofertas">
                            $ @{{ parseInt(offer.min_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} <span v-if="offer.max_wage != null">- $ @{{ parseInt(offer.max_wage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span>
                        </p>
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

    @if(\Auth::user()->is_profile_complete == 0)
        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <!--<h5 class="modal-title" id="exampleModalLabel"></h5>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body body-cperfil-modal">
                        <h5 class="text-center">Para crear ofertas, completa tu perfil.</h5>
                        <div class="content-img-cperfil">
                            <img class="img-cperfil" src="{{ asset('user/assets/img/cperfil.svg') }}" alt="completa tu perfil">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Omitir</button>
                    <a class="btn btn-primary" href="{{ url('/profile/business') }}">Ir a mi perfil</a>
                </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push("scripts")

    @if(\Auth::user()->is_profile_complete == 0)
        <script>
            $('#profileModal').modal({show: true})
        </script>
    @endif

    <script>

        const devArea = new Vue({
            el: '#user-offers-dev',
            data() {
                return {
                    offers:[],
                    page:1,
                    pages:0
                }
            },
            methods: {

                fetch(page = 1){

                    this.page = page
                    axios.get("{{ url('/offers/business/fetch') }}"+"/"+this.page)
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


                }

            },
            mounted(){
                this.fetch()
            }
        })

    </script>

@endpush