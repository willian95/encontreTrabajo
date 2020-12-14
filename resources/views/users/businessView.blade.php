@extends("layouts.business")

@section("content")

    <div class="col-md-8 w-100" id="user-offers-dev">
        <div class="row" style="margin-top: 170px;">
            <div class="col-6">
                <h3 class="ml-3">Ofertas: {{ App\serviceAmount::where("user_id", \Auth::user()->id)->first()->simple_post_amount }}</h3>
            </div>
            <div class="col-6">
                <h3>Entrevistas: {{ App\serviceAmount::where("user_id", \Auth::user()->id)->first()->conference_amount }}</h3>
            </div>
            <div class="col-6">
                <h3>Avisos destacados: {{ App\serviceAmount::where("user_id", \Auth::user()->id)->first()->highlighted_post_amount }}</h3>
            </div>
        </div>
        <div class="opciones-inf-empresas">
            Mis avisos
            <h3>Gestión de avisos ({{ App\Offer::where("user_id", \Auth::user()->id)->count() }} avisos)</h3>
            <div class="opciones-inf-empresas-opciones-select">
                <div class="opciones-inf-empresas-opciones-select-1">

                </div>
                <div class="opciones-inf-empresas-opciones-select-2">
                    <p>Ordenar por</p>
                    <select name="" id="" v-model="orderBy" @change="fetch()">
                        <option value="">Selecciona una opción</option>
                        <option value="1">Nuevo - Antiguo</option>
                        <option value="2">Antiguo - Nuevo</option>
                    </select>
                </div>
                
            </div>
            <!--<div class="opciones-inf-empresas-subt">
                <div class="sub-localidad">
                <p>Aviso / Localidad</p>
                </div>
                <div class="opciones-inf-empresas-subt-list">
                    <p>Caduca el </p>
                    <p>Inscritos </p>
                    <p >Acciones </p>
                </div>
            </div>-->
            <table class="table">
                <thead>
                    <tr>
                        <th>Aviso/Localidad</th>
                        <th>Puesto</th>
                        <th>Expira</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="offer in offers">
                        <td>@{{ offer.title }}/@{{ offer.user.region.name }}</td>
                        <td>@{{ offer.job_position }}</td>
                        <td>@{{ offer.expiration_date.substring(0, 10) }}</td>
                        <td>
                            <a :href="'{{ url('/offers/detail/') }}'+'/'+offer.slug" class="btn btn-primary">Ver más</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{--<div class="caja-mis-avisos">
                <div class="row">
                    <div class="col-md-2">
                        <div class="caja-mis-avisos-col-2">
                            <img class="caja-mis-avisos_img" src="{{ asset('user/assets/img/alert.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <h5>Mis avisos</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis ab modi sapiente, illum cupiditate error quam mollitia iste eligendi adipisci, ipsam facilis iure numquam magnam nulla corrupti sunt dignissimos maiores.</p>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
    <div class="col-md-2 w-100">
        <div class="contenido-publicitario-empresas">
        @if(App\Ad::where("id", 1)->first())
            <a href="{{ App\Ad::where('id', 1)->first()->link }}" target="_blank">
            
                @if(App\Ad::where('id', 1)->first()->type == 'video')
                <video style="width: 100%;" controls>
                    <source src="{{ App\Ad::where('id', 1)->first()->image }}" type="video/mp4">
                </video>
                @else
                <img style="width: 100% !important" src="{{ App\Ad::where('id', 1)->first()->image }}" alt="">
                @endif
                
            </a>
        @endif
        @if(App\Ad::where("id", 2)->first())
            <a href="{{ App\Ad::where('id', 2)->first()->link }}" target="_blank">
                
                @if(App\Ad::where('id', 2)->first()->type == 'video')
                <video style="width: 100%;" controls>
                    <source src="{{ App\Ad::where('id', 2)->first()->image }}" type="video/mp4">
                </video>
                @else
                <img style="width: 100% !important" src="{{ App\Ad::where('id', 2)->first()->image }}" alt="">
                @endif
                
            </a>
        @endif

        </div>
    </div>

@endsection

@push("scripts")

    <script>
        const devArea = new Vue({
            el: '#user-offers-dev',
            data() {
                return {
                    offers:[],
                    page:1,
                    orderBy:"",
                    pages:0
                }
            },
            methods: {

                fetch(page = 1){

                    this.page = page
                    axios.get("{{ url('/offers/business/fetch') }}"+"/"+this.page+"?order="+this.orderBy)
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

                let selectedPlan = document.cookie.substring(0, document.cookie.indexOf(";"))
                selectedPlanId = document.cookie.substring(selectedPlan.indexOf("="), selectedPlan.length)
                //console.log("selectePlan", selectedPlanId)
                if(selectedPlanId){
                    //console.log("entre Plan")
                    window.location.href="{{ url('/plans/available') }}"

                }

            }
        })

    </script>

@endpush