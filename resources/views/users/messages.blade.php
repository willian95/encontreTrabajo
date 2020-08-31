@extends("layouts.user")

@section("content")

    <div class="container mt-3 perfil-encontre-trabajo" id="offersDetails-dev">
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
                            <p class="text-center">
                                <img class="round-img" :src="businessImage" alt="Card image">
                            </p>
                            <h4 class="text-center">@{{ title }}</h4>
                            <p>@{{ description }}</p>
                            <p><strong>Nombre de la empresa: </strong> <a href="{{ url('/profile/show/'.$offer->user->email) }}">@{{ businessName }}</a></p>
                            <p><strong>Dirección: </strong><span v-if="region">@{{ region }}, </span> <span v-if="commune">@{{ commune }} , </span> @{{ address }}</p>
                            <p><strong>Puesto:</strong> @{{ jobPosition }}</p>
                            <p>
                                <strong>Rango Salarial: </strong>$ @{{ parseInt(minWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} <span v-if="maxWage != ''">- $ @{{ parseInt(maxWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span>
                            </p>
                            
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8 offset-md-2 col-12">
                            @if(\Auth::user()->role_id == 2)
                                <h4 class="text-center">@{{ businessName }}</h4>
                            @elseif(\Auth::user()->role_id == 3)
                                <h4 class="text-center">@{{ userName }}</h4>
                                @if($offer->status == 'abierto')
                                <p class="text-center">
                                    <button class="btn btn-success" @click="contract(user)">Contratar</button>
                                </p>
                                @else
                                <p class="text-center">Ya ha realizado una contratación para esta oferta</p>
                                @endif
                            @endif
                            <div style="overflow-y: auto; width: 100%; height: 40vh; overflow-x: hidden;">
                                <div class="row perfil-empresa-form" v-for="proposal in proposals">

                                    <div class="col-8" v-if="proposal.is_answer == 0">
                                        <div class="card">
                                            <div class="card-body">
                                                @{{ proposal.proposal }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 offset-4 text-right" v-else>
                                        <div class="card">
                                            <div class="card-body">
                                                @{{ proposal.proposal }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    
                    </div>
                    

                    @if($offer->status == "abierto")
                        @if(\Auth::user()->role_id == 2)
                        
                                <div class="row perfil-empresa-form">

                                    <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">

                                        <textarea class="form-control" rows="4" v-model="proposal"></textarea>

                                        <p class="text-center">
                                            <button class="btn btn-success" @click="sendProposal()">enviar propuesta</button>
                                        </p>

                                    </div>

                                </div>

                        @elseif(\Auth::user()->role_id == 3)

                            <div class="row perfil-empresa-form">

                                <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">

                                    <textarea class="form-control" rows="4" v-model="proposal"></textarea>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="answerProposal()">enviar respuesta</button>
                                    </p>

                                </div>

                            </div>

                        @endif
                    @endif
				
				</div>
       		</div>

		</div>

    </div>

@endsection

@push("scripts")

<script>
        const devArea = new Vue({
            el: '#offersDetails-dev',
            data() {
                return {
                    loading:false,
                    offerId:"{{ $offer->id }}",
                    title:"{{ $offer->title }}",
                    description:"{{ $offer->description }}",
                    jobPosition:"{{ $offer->job_position ? $offer->job_position : '' }}",
                    minWage:"{{ $offer->min_wage }}",
                    maxWage:"{{ $offer->max_wage }}",
                    address: "{{ $offer->user->address }}",
                    businessName:"{{ $offer->user->business_name }}",
                    businessImage:"{{ $offer->user->image }}",
                    region:"{{ $offer->user->region ? $offer->user->region->name : '' }}",
                    commune:"{{ $offer->user->commune ? $offer->user->commune->name : '' }}",
                    address:"{{ $offer->user->profile->address }}",
                    proposal:"",
                    user:"{{ $user->id }}",
                    userName:"{{ $user->name.' '.$user->lastname }}",
                    role_id:"{{ \Auth::user()->role_id }}",
                    proposals:[],
                    page:1,
                    pages:0

                }
            },
            methods: {

                sendProposal(){
                    this.loading = true
                    axios.post("{{ url('/proposal/store') }}", {offerId: this.offerId, proposal: this.proposal})
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                                title:"Excelente",
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
                answerProposal(){

                    this.loading = true
                    axios.post("{{ url('/proposal/answer') }}", {offerId: this.offerId, proposal: this.proposal, user_id: this.user})
                    .then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                                title:"Excelente",
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

                    axios.post("{{ url('/proposal/messages/fetch') }}", {offerId: this.offerId, user: this.user})
                    .then(res => {

                        this.proposals = res.data.proposals
                        

                    })

                },
                contract(id){

                    swal({
                        title: "¿Estás seguro?",
                        text: "Una vez contratado tu publicación desaparecerá",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post("{{ url('/contract') }}", {offer_id: this.offerId, user_id: this.user}).then(res => {

                                if(res.data.success == true){

                                    swal({
                                        title:"Excelente",
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
                        }
                    });

                }

            },
            mounted(){
            
                this.fetchProposals()

            }

        })
    </script>


@endpush