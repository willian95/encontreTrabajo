@extends("layouts.user")

@push("css")

    <style>
        #description p{
            text-align: left !important;
        }

        #description ul{
            list-style: unset !important;
        }
    </style>

@endpush

@section("content")

    <div class="col-md-10 container mt-3 perfil-encontre-trabajo" id="offersDetails-dev">
		<br>
		<div class="loader-cover" v-if="loading == true">
			<div class="loader"></div>
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
                            <h4 class="text-center">@{{ title }}</h4>
                            
                            <p><strong>Nombre de la empresa: </strong> <a href="{{ url('/profile/show/'.$offer->user->email) }}">@{{ businessName }}</a></p>
                            <p><strong>Dirección: </strong><span v-if="region">@{{ region }}, </span> <span v-if="commune">@{{ commune }} , </span> @{{ address }}</p>
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

                            <div class="row" >
                                <div class="col-lg-12" id="description">
                                    {!! $offer->description !!}
                                </div>
                            </div>


                            
                        </div>

                    </div>
                    @if(\Auth::user()->role_id == 2)
                        <div class="row perfil-empresa-form">

                            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">

                                <p class="text-center">
                                    @if(\Auth::user()->is_profile_complete == 1)
                                        @if(App\Proposal::where("user_id", \Auth::user()->id)->where("offer_id", $offer->id)->count() == 0)
                                            <button class="btn btn-success" @click="sendProposal()">Postularme</button>
                                        @else
                                            Ya te has postulado a esta oferta
                                        @endif
                                    @else
                                        Debes completar tu perfil para postularte a esta oferta
                                    @endif
                                </p>

                            </div>

                        </div>
                    @endif

                    @if(\Auth::user()->role_id == 3)
                    
                        <div class="row perfil-empresa-form table-responsive-et ">

                            <div class="col-12">
                                <h4 class="text-center">Respuestas de usuarios</h4>
                            </div>

                            <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 table-respuestas" >
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Email</th>
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
                                                <a :href="'{{ url('/profile/show/') }}'+'/'+proposal.user.email" class="btn btn-info">Ver perfil</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @endif
				
                </div>
                <!-- <div class="img-mensaje-svg">
                   <img class="img-cperfil-alert" src="{{ asset('user/assets/img/mensaje.svg') }}" alt="">
                </div> -->
       		</div>

		</div>

    </div>

@endsection

@push("scripts")

    <script>
        const devPlace = new Vue({
            el: '#offersDetails-dev',
            data() {
                return {
                    loading:false,
                    offerId:"{{ $offer->id }}",
                    title:"{{ $offer->title }}",
                    description:"{{ $offer->description }}",
                    jobPosition:"{{ $offer->job_position ? $offer->job_position : '' }}",
                    minWage:"{{ $offer->min_wage }}",
                    address: "{{ $offer->user->address }}",
                    businessName:"{{ $offer->user->business_name }}",
                    businessImage:"{{ $offer->user->image }}",
                    region:"{{ $offer->user->region ? $offer->user->region->name : '' }}",
                    commune:"{{ $offer->user->commune ? $offer->user->commune->name : '' }}",
                    address:"{{ $offer->user->profile->address }}",
                    proposal:"",
                    role_id:"{{ \Auth::user()->role_id }}",
                    proposals:[],
                    page:1,
                    pages:0

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

                }

            },
            mounted(){
                
                if(this.role_id == 3){
                    this.fetchProposals()
                }

            }

        })
    </script>

@endpush