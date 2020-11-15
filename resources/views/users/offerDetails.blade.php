@extends("layouts.business")

@push('css')
    <link rel="stylesheet" href="{{ asset('/pickr.js/pickr.css') }}">
    <style>
        #description > p{
            text-align: left !important;
        }

        #description ul{
            list-style: unset !important;
        }
    </style>
@endpush

@section("content")

    <div class="col-md-10 container mt-3 perfil-encontre-trabajo " id="offersDetails-dev">
		<br>
		<div class="loader-cover" v-if="loading == true">
			<div class="loader"></div>
		</div>

        <div style="position: fixed; top: 0; bottom: 0; left:0; right: 0; width: 100%; background: rgba(0, 0, 0, 0.6); z-index: 999999; display:none;" id="cover">

        </div>

        <!-- Tab panes -->
        <div class="tab-content" v-cloak>
          	<div id="iusuario" class="container tab-pane active "><br>
				<div class="content-perfil-empresa">
                        
                    <div class="row perfil-empresa-form">
                        
                        <div class="col-md-6 offset-md-3 col-lg-6offset-lg-3">
                             <!-- <p class="price-rango">
                               $ @{{ parseInt(minWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} <span v-if="maxWage != ''">- $ @{{ parseInt(maxWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span>
                            </p> -->
                            <p class="text-center">
                                <img class="round-img" :src="businessImage" alt="Card image">
                            </p>
                            @if(App\User::where('id', \Auth::user()->id)->first()->expire_free_trial->gt(Carbon\Carbon::now()))
                                <small>Tus entrevistas gratis terminan el {{ App\User::where('id', \Auth::user()->id)->first()->expire_free_trial->format('d/m/Y') }}</small>
                            @endif
                            <h4 class="text-center">@{{ title }}</h4>
                            
                            <p><strong>Nombre de la empresa: </strong> <a href="{{ url('/profile/show/'.$offer->user->email) }}">@{{ businessName }}</a></p>
                            <p><strong>Dirección: </strong><span v-if="region">@{{ region }}, </span> <span v-if="commune">@{{ commune }}
                            <p><strong>Puesto:</strong> @{{ jobPosition }}</p>
                            @if($offer->wage_type == 1)
                            <p>
                                <strong>Salario: </strong><span class="price-rango"> $ @{{ parseInt(minWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span>
                            </p>
                            @else
                                <p>
                                    <strong>Renta a convenir</strong>
                                </p>
                            @endif
                           

                            <div class="row">
                                <div class="col-lg-12" id="description">
                                    {!! $offer->description !!}
                                </div>
                            </div>

                            <p>
                                <strong>Visualizaciones: </strong>{{ App\OfferViewer::where("offer_id", $offer->id)->count() }}</span></span>
                            </p>
                            
                        </div>


                    </div>

                   

                    @if(\Auth::user()->role_id == 2)
                        <div class="row perfil-empresa-form">

                            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">

                                <p class="text-center">
                                    @if(App\Proposal::where("user_id", \Auth::user()->id)->where("offer_id", $offer->id)->count() == 0)
                                        <button class="btn btn-success" @click="sendProposal()">Postularme</button>
                                    @else
                                        Ya te has postulado a esta oferta
                                    @endif
                                </p>

                            </div>

                        </div>
                    @endif

                    @if(\Auth::user()->role_id == 3)
                    
                        <div class="row perfil-empresa-form table-responsive-et">

                            <div class="col-12">
                                <h4 class="text-center">Respuestas de usuarios</h4>
                            </div>

                            <div class="col-md-10 offset-md-1 col-lg-10 offset-lg-1 table-respuestas" >
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Email</th>
                                            <th>Entrevistas</th>
                                            <th>Ver Perfil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(proposal, index) in proposals">
                                            <td>@{{ (index + 1) * page }}</td>
                                            <td>@{{ proposal.user.name }}</td>
                                            <td>@{{ proposal.user.lastname }}</td>
                                            <td>@{{ proposal.user.email }}</td>
                                            <td>
                                                @if(App\User::where("id", \Auth::user()->id)->first()->expire_free_trial->gt(Carbon\Carbon::now()))
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#conferenceModal" @click="setGuest(proposal.user.id)">Solicitar</button>
                                                @else
                                                    {{-- App\ServiceAmount::where("user_id", \Auth::user()->id)->first()->conference_infinity_due_date->gt(Carbon\Carbon::now()) --}}
                                                    

                                                    @if(App\serviceAmount::where("user_id", \Auth::user()->id)->first()->conference_amount > 0 )
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#conferenceModal" @click="setGuest(proposal.user.id)">Solicitar</button>
                                                    @else

                                                        @if(App\serviceAmount::where("user_id", \Auth::user()->id)->first()->conference_infinity_due_date)
                                                            @if(App\serviceAmount::where("user_id", \Auth::user()->id)->first()->conference_infinity_due_date->gt(Carbon\Carbon::now()))
                                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#conferenceModal" @click="setGuest(proposal.user.id)">Solicitar</button>
                                                            @else
                                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#planModal">Comprar plan</button>
                                                            @endif
                                                            
                                                        @else

                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#planModal">Comprar plan</button>
                                                        @endif

                                                        
                                                    @endif

                                                @endif
                                            </td>
                                            <td>
                                                <a :href="'{{ url('/profile/show/') }}'+'/'+proposal.user.email" class="btn btn-info">Ver perfil</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal fade" id="conferenceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Video entrevista</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Fecha y hora</label>
                                            <input type="text" id="datetime" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" @click="scheduleDate()">Agendar Entrevista</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
				
                </div>
                <!-- <div class="img-mensaje-svg">
                   <img class="img-cperfil-alert" src="{{ asset('user/assets/img/mensaje.svg') }}" alt="">
                </div> -->

                <!-- Modal -->
                <div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLabel">Planes disponibles</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePlanModal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="container-fluid">

                                    <div class="row d-flex justify-content-center">
                                        
                                        @foreach(App\Plan::where("position", 1)->orderBy("price", "asc")->get() as $plan)

                                            <div class="col-md-4 col-lg-4 card-plan-col-4">
                                                <div class="card-planes">
                                                    <div class="card">
                                                        <div class="">

                                                            <div class="img-planes d-flex justify-content-center">
                                                                <img src="{{ asset('user/assets/img/logop.png') }}" alt="logo encontre trabajo">
                                                            </div>

                                                            <h3 class="text-center">{{ $plan->title }}</h3>
                                                            <h3 class="text-center"><small class="">$</small>{{ number_format($plan->price, 0, "", ".") }}</h3>
                                                            <h6 class="text-center text-uppercase">iva incluido</h6>

                                                            <img class="wave_img" src="{{ asset('user/assets/img/wamarillo.svg') }}" alt="waves">
                                                            <div class="box-waves-text fondo-am">
                                                                <ul class="text-center box-waves-text_ul ">
                                                                    @if($plan->offer_posting == 1)
                                                                    <li >Publicación en la plataforma laboral y en nuestras redes sociales.</li>
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
                                                                    @if($plan->conference_infinity == 1)
                                                                        <li>Video entrevistas Ilimitadas por @if($plan->plan_time == "semestrales") 6 meses @elseif($plan->plan_time == "anuales") 12 meses @endif</li>
                                                                    @elseif($plan->conference_amount > 0)
                                                                        <li>{{ $plan->conference_amount }} @if($plan->conference_amount == 1)video entrevista con postulantes. @else video entrevista con postulantes. @endif</li>
                                                                    @endif
                                                                </ul>

                                                                <p class="text-center">
                                                                    <button class="btn btn-primary" @click="cartStore({{ $plan->id }}, {{ $plan->price }})">Pagar</button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                            </div>

                                        @endforeach
                                    </div>

                                    <div class="row d-flex justify-content-center">
                                        
                                        @foreach(App\Plan::where("position", 2)->orderBy("price", "asc")->get() as $plan)

                                            <div class="col-md-4 col-lg-4 card-plan-col-4">
                                                <div class="card-planes">
                                                    <div class="card">
                                                        <div class="">

                                                            <div class="img-planes d-flex justify-content-center">
                                                                <img src="{{ asset('user/assets/img/logop.png') }}" alt="logo encontre trabajo">
                                                            </div>

                                                            <h3 class="text-center">{{ $plan->title }}</h3>
                                                            <h3 class="text-center"><small class="">$</small>{{ number_format($plan->price, 0, "", ".") }}</h3>
                                                            <h6 class="text-center text-uppercase">iva incluido</h6>

                                                            <img class="wave_img" src="{{ asset('user/assets/img/wazul.svg') }}" alt="waves">
                                                            <div class="box-waves-text fondo-az">
                                                                <ul class="text-center box-waves-text_ul ">
                                                                    @if($plan->offer_posting == 1)
                                                                    <li >Publicación en la plataforma laboral y en nuestras redes sociales.</li>
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
                                                                    @if($plan->conference_infinity == 1)
                                                                        <li>Video entrevistas Ilimitadas por @if($plan->plan_time == "semestrales") 6 meses @elseif($plan->plan_time == "anuales") 12 meses @endif</li>
                                                                    @elseif($plan->conference_amount > 0)
                                                                        <li>{{ $plan->conference_amount }} @if($plan->conference_amount == 1)video entrevista con postulantes. @else video entrevista con postulantes. @endif</li>
                                                                    @endif
                                                                </ul>
                                                                <p class="text-center">
                                                                    <button class="btn btn-primary" @click="cartStore({{ $plan->id }}, {{ $plan->price }})">pagar</button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                            </div>

                                        @endforeach
                                    </div>

                                    <div class="row d-flex justify-content-center">
                                        
                                        @foreach(App\Plan::where("position", 3)->orderBy("price", "asc")->get() as $plan)

                                            <div class="col-md-4 col-lg-4 card-plan-col-4">
                                                <div class="card-planes">
                                                    <div class="card">
                                                        <div class="">

                                                            <div class="img-planes d-flex justify-content-center">
                                                                <img src="{{ asset('user/assets/img/logop.png') }}" alt="logo encontre trabajo">
                                                            </div>

                                                            <h3 class="text-center">{{ $plan->title }}</h3>
                                                            <h3 class="text-center"><small class="">$</small>{{ number_format($plan->price, 0, "", ".") }}</h3>
                                                            <h6 class="text-center text-uppercase">iva incluido</h6>

                                                            <img class="wave_img" src="{{ asset('user/assets/img/wverde.svg') }}" alt="waves">
                                                            <div class="box-waves-text fondo-ve">
                                                                <ul class="text-center box-waves-text_ul ">
                                                                    @if($plan->offer_posting == 1)
                                                                    <li >Publicación en la plataforma laboral y en nuestras redes sociales.</li>
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
                                                                    @if($plan->conference_infinity == 1)
                                                                        <li>Video entrevistas Ilimitadas por @if($plan->plan_time == "semestrales") 6 meses @elseif($plan->plan_time == "anuales") 12 meses @endif</li>
                                                                    @elseif($plan->conference_amount > 0)
                                                                        <li>{{ $plan->conference_amount }} @if($plan->conference_amount == 1)video entrevista con postulantes. @else video entrevista con postulantes. @endif</li>
                                                                    @endif
                                                                </ul>
                                                                <p class="text-center">
                                                                    <button class="btn btn-primary" @click="cartStore({{ $plan->id }}, {{ $plan->price }})">pagar</button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                            </div>

                                        @endforeach
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

       		</div>

		</div>

    </div>

@endsection

@push("scripts")
    
    <script src="{{ asset('pickr.js/pickr.js') }}"></script>

    <script>

        $(document).ready(function(){
            var input = document.getElementById('datetime');
            var picker = new Picker(input, {
                headers:true,
                indicators:true,
                format: 'DD/MM/YYYY HH:mm',
                text:{
                    title: 'Selecciona Hora y Fecha',
                    cancel: 'Cancelar',
                    confirm: 'OK',
                    year: 'Año',
                    month: 'Mes',
                    day: 'Día',
                    hour: 'Hora',
                    minute: 'Minuto',
                    second: 'Sgundo',
                    millisecond: 'Millisecond',
                }
            });
        })

        const devPlace = new Vue({
            el: '#offersDetails-dev',
            data() {
                return {
                    loading:false,
                    offerId:"{{ $offer->id }}",
                    title:"{{ $offer->title }}",
                    jobPosition:"{{ $offer->job_position ? $offer->job_position : '' }}",
                    minWage:"{{ $offer->min_wage }}",
                    address: "{{ $offer->user->address }}",
                    businessName:"{{ $offer->user->business_name }}",
                    businessImage:"{{ $offer->user->image }}",
                    region:"{{ $offer->user->region ? $offer->user->region->name : '' }}",
                    commune:"{{ $offer->user->commune ? $offer->user->commune->name : '' }}",
                    address:"{{ $offer->user->profile->address }}",
                    proposal:"",
                    date:"",
                    time:"",
                    role_id:"{{ \Auth::user()->role_id }}",
                    proposals:[],
                    page:1,
                    pages:0,
                    guest_id:0,
                    childWin:null,
                    intervalID:null,
                }
            },
            methods: {
                sendProposal(){
                    this.loading = true
                    axios.post("{{ url('/proposal/store') }}", {offerId: this.offerId})
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                           
                                text:res.data.msg,
                                icon:"success"
                            }).then(res => {

                                window.location.href="{{ url('/home') }}"

                            })

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
                        $.each(err.response.data.errors, function(key, value) {
                            alertify.error(value[0])
            
                        });
                    })


                },
                setGuest(guest_id){
                    this.guest_id = guest_id
                },
                fetchProposals(page = 1){

                    this.page = page

                    axios.post("{{ url('/proposal/fetch') }}", {offerId: this.offerId, page: this.page})
                    .then(res => {

                        if(res.data.success == true){

                            this.proposals = res.data.proposals
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
                scheduleDate(){

                    this.dateTime = $("#datetime").val()

                    if(this.dateTime != null){
                        this.loading = true
                        axios.post("{{ url('conference/schedule')}}", {guest_id: this.guest_id, date_time: this.dateTime}).then(res =>{
                            this.loading = false
                            if(res.data.success == true){

                                swal({
                               
                                    text:res.data.msg,
                                    icon:"success"
                                }).then(res => {

                                    window.location.href="{{ url('/home') }}"

                                })

                            }else{

                                swal({
                                    title:"Lo sentimos",
                                    text:res.data.msg,
                                    icon:"danger"
                                })

                            }

                        })

                    }else{

                        swal({
                            text:"Necesitamos la fecha y hora de la reunión para continuar",
                            icon:"danger"
                        })

                    }

                },
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

                    $("#modalClose").click();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '0px');
                    $('.modal-backdrop').remove();
                   
                    $("#cover").css("display", "block")
                    window.localStorage.setItem("paymentStatusTrabajo", "rechazado")
                    this.childWin = window.open("{{ url('/checkout/') }}"+"/"+index, 'print_popup', 'width=600,height=600')
                    
                    
                },
                checkWindow() {
                    if (this.childWin && this.childWin.closed) {
                        window.clearInterval(this.intervalID);
                        $("#cover").css("display", "none")
                        window.location.reload()
                    
                    }
                }
                

            },
            mounted(){
                
                if(this.role_id == 3){
                    this.fetchProposals()
                }

                this.intervalID = window.setInterval(this.checkWindow, 500);

            }

        })
    </script>

@endpush