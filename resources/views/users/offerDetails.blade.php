@extends("layouts.business")

@push("css")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endpush

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
                             <!-- <p class="price-rango">
                               $ @{{ parseInt(minWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} <span v-if="maxWage != ''">- $ @{{ parseInt(maxWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span>
                            </p> -->
                            <p class="text-center">
                                <img class="round-img" :src="businessImage" alt="Card image">
                            </p>
                            <h4 class="text-center">@{{ title }}</h4>
                            <p>@{{ description }}</p>
                            <p><strong>Nombre de la empresa: </strong> <a href="{{ url('/profile/show/'.$offer->user->email) }}">@{{ businessName }}</a></p>
                            <p><strong>Dirección: </strong><span v-if="region">@{{ region }}, </span> <span v-if="commune">@{{ commune }} , </span> @{{ address }}</p>
                            <p><strong>Puesto:</strong> @{{ jobPosition }}</p>
                            <p>
                                <strong>Rango Salarial: </strong><span class="price-rango"> $ @{{ parseInt(minWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }} <span v-if="maxWage != ''">- $ @{{ parseInt(maxWage).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</span></span>
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
                    
                        <div class="row perfil-empresa-form">

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
                                            <th>Conferencia</th>
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
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#conferenceModal" @click="setGuest(proposal.user.id)">Solicitar</button>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Video conferencia</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Fecha y Hora</label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" style="font-size: 14px"/>
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" @click="scheduleDate()">Agendar Conferencia</button>
                                    </div>
                                </div>
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
        
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });

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
                    maxWage:"{{ $offer->max_wage }}",
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
                    pages:0,
                    guest_id:0
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

                    axios.post("conference/schedule", {guest_id: this.guest_id}).then(res =>{

                        

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