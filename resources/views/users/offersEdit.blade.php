@extends("layouts.business")

@section("content")

    <div class=" col-md-10 container mt-3 perfil-encontre-trabajo" >
        
		
      
        <!-- Tab panes -->
        <div class="tab-content">
           

          	<div id="iusuario" class="container tab-pane active ">
				<div class="content-perfil-empresa ">
                    <div class="row">
                        <div class="col-12">
                        <h2 class="text-center">Oferta</h2>
        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if(App\User::where("id", \Auth::user()->id)->first()->expire_free_trial->gt(Carbon\Carbon::now()))
                                <small>Tus publicaciones gratis terminan el {{ \Auth::user()->expire_free_trial->format('d/m/Y') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label for="text">Descripción</label>
                            <textarea class="form-control" name="editor1" id="editor1" rows="10" cols="80">{!! $offer->description !!}</textarea>
                        </div>
                    </div>
					<form action="/action_page.php" id="offersCreate-dev">

                        <div class="loader-cover" v-if="loading == true">
                            <div class="loader"></div>
                        </div>
                        <div style="position: fixed; top: 0; bottom: 0; left:0; right: 0; width: 100%; background: rgba(0, 0, 0, 0.6); z-index: 999999; display:none;" id="cover">

                        </div>

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

						<!--<div class="row media-perfil">
							<div class="col-md-4 media-perfil-c-4">
								<div class="a-basicos-postulante-img j-center"><img class="basicos-postulante-c-4" :src="imagePreview" alt="postulante"></div>
								<label for="image">Imagen</label>
								<input type="file" class="form-control" id="image" ref="file" @change="onImageChange" accept="image/*">
                                <small>(opcional)</small>

							</div>
						</div>-->
            
						<div class="row perfil-empresa-form">
                            
							<div class="col-md-4 ">
								<div class="form-group">
									<label for="title">Titulo</label>
									<input type="text" class="form-control" id="minWage" v-model="title">
								</div>
							</div>
							<div class="col-md-4 ">
								<div class="form-group">
									<label for="minWage">Renta ofrecida</label>
									<input type="text" class="form-control" id="minWage"  v-model="minWage" @keypress="isNumber($event)">
								</div>
							</div>

                            <div class="col-md-4 ">
								<div class="form-group">
									<label for="extraWage">Bonos</label>
									<input type="text" class="form-control" id="extraWage"  v-model="extraWage">
								</div>
							</div>

                            <div class="col-md-4 ">
								<div class="form-group">
									<label for="minWage">Tipo de renta</label>
									<select class="form-control" v-model="wageType">
                                        <option value="1">Renta ofrecida</option>
                                        <option value="2">Renta a convenir</option>
                                    </select>
								</div>
							</div>

                            <div class="col-md-4 ">
								<div class="form-group">
									<label for="jobPosition">Puesto de Trabajo</label>
									<input type="text" class="form-control" id="jobPosition" v-model="jobPosition">
								</div>
							</div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="text">Categoría</label>
                                    <select class="form-control" v-model="category">
                                        <option value="">Seleccione</option>
                                        <option :value="category.id" v-for="category in categories">@{{ category.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="text">Regiones</label>
                                    <select class="form-control" v-model="selectedRegion" @change="fetchCommunes()">
                                        <option value="">Seleccione</option>
                                        <option :value="region.id" v-for="region in regions">@{{ region.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="text">Comunas</label>
                                    <select class="form-control" v-model="selectedCommune">
                                        <option value="">Seleccione</option>
                                        <option :value="commune.id" v-for="commune in communes">@{{ commune.name }}</option>
                                    </select>
                                </div>
                            </div>

						</div>

                        <div class="row perfil-empresa-form">

                            
                                <div class="form-group form-check" v-if="highlightedPosts > 0 || isHighlighted == 1">
                                    <input type="checkbox" class="form-check-input" id="highlighted" v-model="isHighlighted">
                                    <label class="form-check-label" for="highlighted">Destacada</label>
                                </div>
                         
                               <div class="contenedor-aviso-comprar-plan" v-else>
                                    <p>
                                        No posees avisos destacados, puedes comprar uno haciendo click aquí
                                    </p>
                                    <p>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#planModal">Comprar plan</button>
                                    </p>
                               </div>
                    

                        </div>
						
                       
                            <div class="buttom-content-up">
                                <button type="button" class="btn btn-primary" @click="update()">Actualizar</button>
                            </div>
                    

                     
					</form>
				</div>
       		</div>

		</div>

    </div>

@endsection

@push("scripts")

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    function normalClick(){
        $("#click").click();
    }
</script>

<script>
        const devArea = new Vue({
            el: '#offersCreate-dev',
            data() {
                return {
                    postId:"{{ $offer->id }}",
                    title:"{{ $offer->title }}",
                    description:"",
                    minWage:"{{ $offer->min_wage }}",
                    maxWage:"",
                    category:"{{ $offer->category_id }}",
                    categories:[],
                    jobPosition:"{{ $offer->job_position }}",
                    extraWage:"{{ $offer->extra_wage }}",
                    childWin:null,
                    intervalID:null,
                    isHighlighted:JSON.parse('{!! $offer->is_highlighted !!}'),
                    loading:false,
                    simplePosts:0,
                    highlightedPosts:0,
                    dueDate:"",
                    wageType:"1",
                    regions:[],
                    communes:[],
                    selectedRegion:"{{ $offer->region_id }}",
                    selectedCommune:"{{ $offer->commune_id }}"
                }
            },
            methods: {

                update(){

                    this.loading = true

                    this.description = CKEDITOR.instances.editor1.getData()
                    axios.post("{{ url('/offers/update') }}", {
                        id: this.postId,
                        title: this.title, 
                        description: this.description, 
                        minWage: this.minWage, 
                        maxWage: this.maxWage,
                        category: this.category,
                        jobPosition: this.jobPosition,
                        highlightPost: this.isHighlighted,
                        extraWage: this.extraWage,
                        wageType: this.wageType,
                        region:this.selectedRegion,
                        commune:this.selectedCommune
                    }).then(res => {

                        this.loading = false

                        if(res.data.success == true){

                            swal({
                             
                                text:res.data.msg,
                                icon:"success"
                            }).then(res => {

                                window.location.href="{{ url('/home') }}"

                            })

                            this.title = "" 
                            this.description = "" 
                            this.minWage = "" 
                            this.maxWage = ""
                            this.category = ""
                            this.jobPosition = ""

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
                openChildWindow(index) {
                    window.localStorage.setItem("paymentStatusTrabajo", "rechazado")
                    this.childWin = window.open("{{ url('/checkout/') }}"+"/"+index, 'print_popup', 'width=600,height=600')
                    
                    $("#cover").css("display", "block")
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
                fetchCategories(){

                    axios.get("{{ url('/job-categories/fetch-all') }}")
                    .then(res => {

                        if(res.data.success == true){

                            this.categories = res.data.jobCategories
                            
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

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
                },
                fetchRegions(){

                    axios.get("{{ url('/regions/fetch-all') }}").then(res => {

                        if(res.data.success == true){
                            this.regions = res.data.regions
                            
                            this.fetchCommunes()

                        }

                    })

                },
                fetchCommunes(){
                    this.selectedCommune = ""
                    axios.get("{{ url('/communes/fetch/') }}"+"/"+this.selectedRegion).then(res => {

                        if(res.data.success == true){
                            this.communes = res.data.communes

                        }

                    })

                },
                checkWindow() {
                    if (this.childWin && this.childWin.closed) {
                        window.clearInterval(this.intervalID);
                        $("#cover").css("display", "none")
                        if (localStorage.getItem("paymentStatusTrabajo") == 'aprobado') {
                            //this.store()
                            this.getServicesAmount()
                            $("#closePlanModal").click()
                            $('body').removeClass('modal-open');
                            $('body').css('padding-right', '0px');
                            $('.modal-backdrop').remove();
                        } else if (localStorage.getItem("paymentStatusTrabajo") == 'rechazado') {
                            $("#cover").css("display", "none")
                        }
                    }
                },
                getServicesAmount(){
                    axios.get("{{ url('/user/service-amount') }}").then(res => {
                        console.log("services", res)
                        this.simplePosts = res.data[0].simple_post_amount
                        this.highlightedPosts = res.data[0].highlighted_post_amount
                        this.dueDate = new Date(res.data[0].due_date)
                    })
                }

            },
            mounted(){
                
                this.fetchCategories()
                this.getServicesAmount()
                this.fetchRegions()

                this.intervalID = window.setInterval(this.checkWindow, 500);
            }

        })
    </script>


@endpush