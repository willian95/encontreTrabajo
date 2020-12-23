@extends("layouts.secondaryViews")

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
									<label for="title">Puesto de trabajo</label>
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
									<label for="jobPosition">Cargo</label>
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

                            <div class="col-md-4 ">
								<div class="form-group">
									<label for="address">Dirección</label>
									<input type="text" class="form-control" id="address" v-model="address">
								</div>
							</div>

                            <div class="col-md-4 ">
								<div class="form-group">
									<label for="inclusividad">Publico objetivo</label>
									<select class="form-control" v-model="inclusive" id="inclusividad">
                                        <option value="todos">Todos</option>
                                        <option value="personas con discapacidad">Personas con discapacidad</option>
                                    </select>
								</div>
							</div>

                            <div class="col-md-4 ">
								<div class="form-group">
									<label for="job_numbers">Cantidad de puestos de trabajo</label>
									<input type="text" class="form-control" id="job_numbers" v-model="jobNumbers" @keypress="isNumber($event)">
								</div>
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
                    loading:false,
                    simplePosts:0,
                    highlightedPosts:0,
                    dueDate:"",
                    wageType:"1",
                    regions:[],
                    communes:[],
                    address:"{{ $offer->address }}",
                    selectedRegion:"{{ $offer->region_id }}",
                    selectedCommune:"{{ $offer->commune_id }}",
                    inclusive:"{{ $offer->inclusive }}",
                    jobNumbers:"{{ $offer->job_number }}"
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
                        commune:this.selectedCommune,
                        address:this.address,
                        inclusive: this.inclusive,
                        jobNumbers: this.jobNumbers
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
                            
                            this.firstFetchCommunes()

                        }

                    })

                },
                firstFetchCommunes(){
                    
                    axios.get("{{ url('/communes/fetch/') }}"+"/"+this.selectedRegion).then(res => {

                        if(res.data.success == true){
                            this.communes = res.data.communes

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