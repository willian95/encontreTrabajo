@extends("layouts.business")

@section("content")

    <div class=" col-md-10 container mt-3 perfil-encontre-trabajo" id="offersCreate-dev">
        <h2 style="margin-top: 100px;">Oferta</h2>
		<br>
		<div class="loader-cover" v-if="loading == true">
			<div class="loader"></div>
		</div>
        <div style="position: fixed; top: 0; bottom: 0; left:0; right: 0; width: 100%; background: rgba(0, 0, 0, 0.6); z-index: 999999; display:none;" id="cover">

        </div>
      
        <!-- Tab panes -->
        <div class="tab-content">
          	<div id="iusuario" class="container tab-pane active "><br>
				<div class="content-perfil-empresa">
					<form action="/action_page.php">
						<!--<div class="row media-perfil">
							<div class="col-md-4 media-perfil-c-4">
								<div class="a-basicos-postulante-img j-center"><img class="basicos-postulante-c-4" :src="imagePreview" alt="postulante"></div>
								<label for="image">Imagen</label>
								<input type="file" class="form-control" id="image" ref="file" @change="onImageChange" accept="image/*">
                                <small>(opcional)</small>

							</div>
						</div>-->
                        <div class="row">
                            <div class="col-12">
                                @if(App\User::where("id", \Auth::user()->id)->first()->expire_free_trial->gt(Carbon\Carbon::now()))
                                    <small>Tus publicaciones gratis terminan el {{ \Auth::user()->expire_free_trial->format('d/m/Y') }}</small>
                                @endif
                            </div>
                        </div>
						<div class="row perfil-empresa-form">
                            
							<div class="col-md-4 ">
								<div class="form-group">
									<label for="title">Titulo</label>
									<input type="text" class="form-control" id="minWage" v-model="title">
								</div>
							</div>
							<div class="col-md-4 ">
								<div class="form-group">
									<label for="minWage">Sueldo mínimo</label>
									<input type="text" class="form-control" id="minWage"  v-model="minWage" @keypress="isNumber($event)">
								</div>
							</div>
                            <div class="col-md-4 ">
								<div class="form-group">
									<label for="maxWage">Sueldo máximo (opcional)</label>
									<input type="text" class="form-control" id="maxWage"  v-model="maxWage" @keypress="isNumber($event)">
								</div>
							</div>
						</div>

                        <div class="row perfil-empresa-form">

                            <div class="col-md-6 ">
								<div class="form-group">
									<label for="jobPosition">Puesto de Trabajo</label>
									<input type="text" class="form-control" id="jobPosition" v-model="jobPosition">
								</div>
							</div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">Categoría</label>
                                    <select class="form-control" v-model="category">
                                        <option value="">Seleccione</option>
                                        <option :value="category.id" v-for="category in categories">@{{ category.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label for="text">Descripción</label>
                                    <textarea class="form-control" rows="6" v-model="description"></textarea>
                                </div>
                            </div>

                            
                                <div class="form-group form-check" v-if="highlightedPosts > 0">
                                    <input type="checkbox" class="form-check-input" id="highlighted" v-model="isHighlighted">
                                    <label class="form-check-label" for="highlighted">Destacada</label>
                                </div>
                         
                               <div v-else>
                                <p>
                                        No posees avisos destacados, puedes comprar uno haciendo click aquí
                                </p>
                                    <p>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#planModal">Comprar plan</button>
                                    </p>
                               </div>
                    

                        </div>
						
                        @if(App\User::where("id", \Auth::user()->id)->first()->expire_free_trial->gt(Carbon\Carbon::now()))
                            <div class="buttom-content-up">
                                <button type="button" class="btn btn-primary" @click="store()">Publicar</button>
                            </div>
                        @else

                            <div class="buttom-content-up" v-if="simplePosts > 0 || dueDate > today">
                                <button type="button" class="btn btn-primary" @click="store()">Publicar</button>
                            </div>
                    

                            <div v-else>
                                <div class="buttom-content-up">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#planModal">Comprar plan</button>
                                </div>

                                <p v-if="title == '' || minWage == '' || jobPosition == '' || category == '' || description == ''" class="text-center">
                                   Debes completar los campos
                                </p>
                            </div>

                        @endif

                     
					</form>
				</div>
       		</div>

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

                            <div class="row">
                                @foreach(App\Plan::all() as $plan)

                                    <div class="col-md-4 col-lg-4">

                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="text-center">{{ $plan->title }}</h3>

                                                <p><strong>Publicaciones: </strong>{{ $plan->simple_post_amount }}</p>
                                                <p><strong>Conferencias: </strong>{{ $plan->conference_amount }}</p>

                                                <h4 class="text-center">$ {{ number_format($plan->price, 0, ",", ".") }}</h4>


                                                <p class="text-center">
                                                    <button class="btn btn-success" @click="cartStore('{{ $plan->id }}', '{{ $plan->price }}')">Comprar</button>
                                                </p>
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

@endsection

@push("scripts")

<script>
        const devArea = new Vue({
            el: '#offersCreate-dev',
            data() {
                return {
                    title:"",
                    description:"",
                    minWage:"",
                    maxWage:"",
                    today:new Date(),
                    category:"",
                    categories:[],
                    jobPosition:"",
                    childWin:null,
                    intervalID:null,
                    isHighlighted:false,
                    loading:false,
                    simplePosts:0,
                    highlightedPosts:0,
                    dueDate:""
                }
            },
            methods: {

                store(){

                    this.loading = true

                    axios.post("{{ url('/offers/store') }}", {
                        title: this.title, 
                        description: this.description, 
                        minWage: this.minWage, 
                        maxWage: this.maxWage,
                        category: this.category,
                        jobPosition: this.jobPosition,
                        highlightPost: this.isHighlighted
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
                this.intervalID = window.setInterval(this.checkWindow, 500);
            }

        })
    </script>


@endpush