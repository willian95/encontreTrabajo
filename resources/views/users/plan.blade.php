@extends("layouts.business")

@section("content")

    <div class="col-md-10 cont-ofertas-9">
        <div class="" id="dev-plan" style="margin-top: 100px;">
            <div class="loader-cover" v-if="loading == true">
                <div class="loader"></div>
            </div>
            <div style="position: fixed; top: 0; bottom: 0; left:0; right: 0; width: 100%; background: rgba(0, 0, 0, 0.6); z-index: 999999; display:none;" id="cover">
            </div>



            <!-- <div class="row d-flex justify-content-center content-planes-plataforma-et">
                <div class="col-md-4 mt-3 card-plan-col-4" v-for="plan in plans">
                        <div class="card-planes " >
                            <div class="card">
                                <div class="img-planes d-flex justify-content-center">
                                    <img src="{{ asset('user/assets/img/logop.png') }}" alt="logo encontre trabajo">
                                </div>
                                <h3 class="text-center text-uppercase">@{{ plan.title }}</h3>
                                <h4 class="text-center">$ @{{ parseInt(plan.price).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</h4>
                                <h6 class="text-center text-uppercase">iva incluido</h6>
                                <img class="wave_img" src="{{ asset('user/assets/img/wamarillo.svg') }}" alt="waves">
                                <div class="box-waves fondo-am">
                                    <div class="box-waves-text fondo-am">
                                        <ul class=" box-waves-text_ul ">
                                            <li><strong>Publicaciones: </strong>@{{ plan.post_amount }}</li>
                                            <li><strong>Conferencias: </strong>@{{ plan.conference_amount }}</li>
                                        </ul>
                                        <div class="d-flex justify-content-center mb-5">
                                            <button style=" background: #188a75;" class="btn btn-success" @click="cartStore(plan.id, plan.price)"><strong>Comprar</strong></button>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->






            <!-- {{--<div class="col-md-4 col-lg-4" v-for="plan in plans">

                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center title-plan">@{{ plan.title }}</h3>

                        <p><strong>Publicaciones: </strong>@{{ plan.post_amount }}</p>
                        <p><strong>Conferencias: </strong>@{{ plan.conference_amount }}</p>

                        <h4 class="text-center price-plan">$ @{{ parseInt(plan.price).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</h4>


                        <p class="text-center">
                            <button class="btn btn-success" @click="cartStore(plan.id, plan.price)">Comprar</button>
                        </p>
                    </div>
                </div>

            </div>--}} -->

            <div class="row d-flex justify-content-center">
                {{--@foreach(App\Plan::where("position", 1)->orderBy("price", "asc")->get() as $plan)--}}
                <div class="col-md-4" v-for="plan in plans" v-if="plan.position == 1">
                    <div class="content-plan">   
                        <div class=" card-planes mb-3 mt-3">
                            <div class="card">
                                <div class="img-planes d-flex justify-content-center">
                                    <img src="{{ asset('user/assets/img/logop.png') }}" alt="logo encontre trabajo">
                                </div>
                                <h2 class="text-center text-uppercase">@{{ plan.title }}</h2>
                                <h3 class="text-center"><small class="">$</small>@{{ parseInt(plan.price).toString() }}</h3>
                                <h6 class="text-center text-uppercase">iva incluido</h6>
                                <img class="wave_img" src="{{ asset('user/assets/img/wamarillo.svg') }}" alt="waves">

                                <div class="box-waves fondo-am">
                                    <div class="box-waves_img">
                                    </div>

                                    <div class="box-waves-text fondo-am">
                                        <ul class="text-center box-waves-text_ul ">
                                            
                                            <li v-if="plan.offer_posting == 1">Publicaciones de ofertas laborales en el portal.</li>
                                        

                                            
                                            <li v-if="plan.post_days > 0">Duración de @{{ plan.post_days }} días.</li>
                                          
                                           
                                            <li v-if="plan.simple_post_infinity == 1">
                                                <span>Publicaciones simples ilimitadas por </span><span v-if="plan.plan_time == 'semestrales'"> 6 meses </span><span v-if="plan.plan_time == 'anuales'">12 meses </span>
                                            </li>
                                          
                                            <li v-if="plan.simple_posts > 0">@{{ plan.simple_posts }} <span v-if="plan.simple_posts == 1">publicación simple. </span><span v-if="plan.simple_posts > 1"> publicaciones simples. </span</li>
                                            
                                            
                                            <li v-if="plan.hightlight_posts > 0">@{{ plan.hightlight_posts }} <span v-if="plan.hightlight_posts == 1"> publicación destacada. </span><span v-else> publicaciones destacadas. </span></li>
                                            
                                            <li v-if="plan.download_curriculum == 1">Descarga de Curriculum Vitae.</li>
                                            
                                            <li v-if="plan.show_video == 1">Video de Presentación del Candidato.</li>
                                            
                                            <li v-if="plan.download_profiles > 0">Podrás entrar al motor de búsqueda y descargar @{{ plan.download_profiles }} <span v-if="plan.download_profiles == 1"> perfil.</span> <span v-else>perfiles.</span></li>
                                            
                                            <li v-if="plan.conference_amount > 0">@{{ plan.conference_amount }} <span v-if="plan.conference_amount == 1">video conferencia.</span>  <span v-else> video conferencias.</span></li>
                                            
                                        </ul>

                                        <p class="text-center">
                                            <button class="btn btn-primary" @click="cartStore(plan.id, plan.price)">pagar</button>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--@endforeach--}}
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-4" v-for="plan in plans" v-if="plan.position == 2">
                    <div class="content-plan">   
                        <div class=" card-planes mb-3 mt-3">
                            <div class="card">
                                <div class="img-planes d-flex justify-content-center">
                                    <img src="{{ asset('user/assets/img/logop.png') }}" alt="logo encontre trabajo">
                                </div>
                                <h2 class="text-center text-uppercase">@{{ plan.title }}</h2>
                                <h3 class="text-center"><small class="">$</small>@{{ parseInt(plan.price).toString() }}</h3>
                                <h6 class="text-center text-uppercase">iva incluido</h6>
                                <img class="wave_img" src="{{ asset('user/assets/img/wazul.svg') }}" alt="waves">

                                <div class="box-waves fondo-az">
                                    <div class="box-waves_img">
                                    </div>

                                    <div class="box-waves-text fondo-az">
                                        <ul class="text-center box-waves-text_ul ">
                                            
                                            <li v-if="plan.offer_posting == 1">Publicaciones de ofertas laborales en el portal.</li>
                                        

                                            
                                            <li v-if="plan.post_days > 0">Duración de @{{ plan.post_days }} días.</li>
                                        
                                        
                                            <li v-if="plan.simple_post_infinity == 1">
                                                <span>Publicaciones simples ilimitadas por </span><span v-if="plan.plan_time == 'semestrales'"> 6 meses </span><span v-if="plan.plan_time == 'anuales'">12 meses </span>
                                            </li>
                                        
                                            <li v-if="plan.simple_posts > 0">@{{ plan.simple_posts }} <span v-if="plan.simple_posts == 1">publicación simple. </span><span v-if="plan.simple_posts > 1"> publicaciones simples. </span</li>
                                            
                                            
                                            <li v-if="plan.hightlight_posts > 0">@{{ plan.hightlight_posts }} <span v-if="plan.hightlight_posts == 1"> publicación destacada. </span><span v-else> publicaciones destacadas. </span></li>
                                            
                                            <li v-if="plan.download_curriculum == 1">Descarga de Curriculum Vitae.</li>
                                            
                                            <li v-if="plan.show_video == 1">Video de Presentación del Candidato.</li>
                                            
                                            <li v-if="plan.download_profiles > 0">Podrás entrar al motor de búsqueda y descargar @{{ plan.download_profiles }} <span v-if="plan.download_profiles == 1"> perfil.</span> <span v-else>perfiles.</span></li>
                                            
                                            <li v-if="plan.conference_amount > 0">@{{ plan.conference_amount }} <span v-if="plan.conference_amount == 1">video conferencia.</span>  <span v-else> video conferencias.</span></li>
                                            
                                        </ul>

                                        <p class="text-center">
                                            <button class="btn btn-primary" @click="cartStore(plan.id, plan.price)">pagar</button>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-4" v-for="plan in plans" v-if="plan.position == 3">
                    <div class="content-plan">   
                        <div class=" card-planes mb-3 mt-3">
                            <div class="card">
                                <div class="img-planes d-flex justify-content-center">
                                    <img src="{{ asset('user/assets/img/logop.png') }}" alt="logo encontre trabajo">
                                </div>
                                <h2 class="text-center text-uppercase">@{{ plan.title }}</h2>
                                <h3 class="text-center"><small class="">$</small>@{{ parseInt(plan.price).toString() }}</h3>
                                <h6 class="text-center text-uppercase">iva incluido</h6>
                                <img class="wave_img" src="{{ asset('user/assets/img/wverde.svg') }}" alt="waves">

                                <div class="box-waves fondo-ve">
                                    <div class="box-waves_img">
                                    </div>

                                    <div class="box-waves-text fondo-ve">
                                        <ul class="text-center box-waves-text_ul ">
                                            
                                            <li v-if="plan.offer_posting == 1">Publicaciones de ofertas laborales en el portal.</li>
                                        

                                            
                                            <li v-if="plan.post_days > 0">Duración de @{{ plan.post_days }} días.</li>
                                        
                                        
                                            <li v-if="plan.simple_post_infinity == 1">
                                                <span>Publicaciones simples ilimitadas por </span><span v-if="plan.plan_time == 'semestrales'"> 6 meses </span><span v-if="plan.plan_time == 'anuales'">12 meses </span>
                                            </li>
                                        
                                            <li v-if="plan.simple_posts > 0">@{{ plan.simple_posts }} <span v-if="plan.simple_posts == 1">publicación simple. </span><span v-if="plan.simple_posts > 1"> publicaciones simples. </span</li>
                                            
                                            
                                            <li v-if="plan.hightlight_posts > 0">@{{ plan.hightlight_posts }} <span v-if="plan.hightlight_posts == 1"> publicación destacada. </span><span v-else> publicaciones destacadas. </span></li>
                                            
                                            <li v-if="plan.download_curriculum == 1">Descarga de Curriculum Vitae.</li>
                                            
                                            <li v-if="plan.show_video == 1">Video de Presentación del Candidato.</li>
                                            
                                            <li v-if="plan.download_profiles > 0">Podrás entrar al motor de búsqueda y descargar @{{ plan.download_profiles }} <span v-if="plan.download_profiles == 1"> perfil.</span> <span v-else>perfiles.</span></li>
                                            
                                            <li v-if="plan.conference_amount > 0">@{{ plan.conference_amount }} <span v-if="plan.conference_amount == 1">video conferencia.</span>  <span v-else> video conferencias.</span></li>
                                            
                                        </ul>

                                        <p class="text-center">
                                            <button class="btn btn-primary" @click="cartStore(plan.id, plan.price)">pagar</button>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    {{--<div class="row d-flex justify-content-center">
                        @foreach(App\Plan::where("position", 3)->orderBy("price", "asc")->get() as $plan)
                        <div class="col-md-4">
                            <div class="content-plan">   
                                <div class=" card-planes mb-3 mt-3">
                                    <div class="card">
                                        <div class="img-planes d-flex justify-content-center">
                                            <img src="{{ asset('assets/img/logop.png') }}" alt="logo encontre trabajo">
                                        </div>
                                        <h2 class="text-center text-uppercase">{{ $plan->title }}</h2>
                                        <h3 class="text-center"><small class="">$</small>{{ number_format($plan->price, 0, ",", ".") }}</h3>
                                        <h6 class="text-center text-uppercase">iva incluido</h6>
                                        <img class="wave_img" src="{{ asset('assets/img/wverde.svg') }}" alt="waves">

                                        <div class="box-waves fondo-ve">
                                            <div class="box-waves_img">
                                            </div>

                                            <div class="box-waves-text fondo-ve">
                                                <ul class="text-center box-waves-text_ul ">
                                                    @if($plan->offer_posting == 1)
                                                    <li >Publicaciones de ofertas laborales en el portal.</li>
                                                    @endif
                                                    @if($plan->post_days > 0)
                                                    <li>Duración de {{ $plan->post_days }} días.</li>
                                                    @endif

                                                    @if($plan->simple_post_infinity == 1)
                                                        Publicaciones simples ilimitadas por @if($plan->plan_time == "semestrales") 6 meses @elseif($plan->plan_time == "anuales") 12 meses @endif
                                                    @elseif($plan->simple_posts > 0)
                                                    <li>{{ $plan->simple_posts }} @if($plan->simple_posts == 1)publicación simple. @else publicaciones simples. @endif</li>
                                                    @endif
                                                    @if($plan->hightlight_posts > 0)
                                                    <li>{{ $plan->hightlight_posts }} @if($plan->hightlight_posts == 1) publicación destacada. @else publicaciones destacadas. @endif</li>
                                                    @endif
                                                    @if($plan->download_curriculum == 1)
                                                    <li>Descarga de Curriculum Vitae.</li>
                                                    @endif
                                                    @if($plan->show_video == 1)
                                                    <li>Video de Presentación del Candidato.</li>
                                                    @endif
                                                    @if($plan->download_profiles > 0)
                                                    <li>Podrás entrar al motor de búsqueda y descargar {{ $plan->download_profiles }} @if($plan->download_profiles == 1) perfil. @else perfiles. @endif</li>
                                                    @endif
                                                    @if($plan->conference_amount > 0)
                                                    <li>{{ $plan->conference_amount }} @if($plan->conference_amount == 1)video conferencia. @else video conferencias. @endif</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>--}}


        </div>
    </div>
</div>

@endsection

@push("scripts")

    <script>

        const devArea = new Vue({
            el: '#dev-plan',
            data() {
                return {
                    loading:false,
                    plans:JSON.parse('{!! App\Plan::all() !!}'),
                childWin:null,
                intervalID:null
            }
        },
        methods: {
                cartStore(plan_id, price){

                    this.loading = true

                    axios.post("{{ url('/cart/store') }}", {
                        price: price, 
                        plan_id: plan_id
                    }).then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            this.openChildWindow(res.data.index)

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
                        
                    })

                },
                openChildWindow(index) {
                    this.childWin = window.open("{{ url('/checkout/') }}"+"/"+index, 'print_popup', 'width=600,height=600')
                    
                    $("#cover").css("display", "block")
                },
                checkWindow() {
                    if (this.childWin && this.childWin.closed) {
                        window.clearInterval(this.intervalID);
                        $("#cover").css("display", "none")
                        if (localStorage.getItem("paymentStatusTrabajo") == 'aprobado') {
                            wndow.location.reload()
                        } else if (localStorage.getItem("paymentStatusTrabajo") == 'rechazado') {
                            $("#cover").css("display", "none")
                        }
                    }
                }

            },
            mounted(){
                
                this.intervalID = window.setInterval(this.checkWindow, 500);
            }
        })

    </script>

@endpush