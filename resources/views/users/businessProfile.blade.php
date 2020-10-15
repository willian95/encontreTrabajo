@extends("layouts.secondaryViews")

@section("content")

    <div class="container mt-3 perfil-encontre-trabajo" id="userProfile-dev">
        <h2>Mi Perfil</h2>
		<br>
		<div class="loader-cover" v-if="loading == true">
			<div class="loader"></div>
		</div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs ">
          <li class="nav-item tabs-perfil">

            <a class="nav-link active tabs-perfil-a" data-toggle="tab" href="#iusuario">
                <div class="content-ico-tab">
                    <img class="ico-tab" src="assets/img/usuario.png" alt="">
                </div>
                <h3>Información del Usuario</h3>
            </a>
          </li>
          <li class="nav-item tabs-perfil">
            <a class="nav-link tabs-perfil-a" data-toggle="tab" href="#iempresa">
                <div class="content-ico-tab">
                    <img class="ico-tab" src="assets/img/empresa.png" alt="">
                </div>
                <h3>Información de la Empresa</h3>
            </a>
          </li>
        </ul>
      
        <!-- Tab panes -->
        <div class="tab-content">
          	<div id="iusuario" class="container tab-pane active "><br>
				<div class="content-perfil-empresa">
					<form action="/action_page.php">
						<div class="row media-perfil">
							<div class="col-md-4 media-perfil-c-4">
								<div class="a-basicos-postulante-img j-center"><img class="basicos-postulante-c-4" :src="imagePreview" alt="postulante"></div>
								<label for="image">Foto de Perfil</label>
								<input type="file" class="form-control" id="image" ref="file" @change="onImageChange" accept="image/*">

							</div>
						</div>
						<div class="row perfil-empresa-form">
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="text">Nombre</label>
									<input type="text" class="form-control" id="#" v-model="name">
								</div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="text">Apellido</label>
									<input type="text" class="form-control" id="#"  v-model="lastname">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="#"  v-model="email" readonly>
								</div>
							</div>
							<!--<div class="col-md-6 ">
								<div class="form-group">
									<label for="pwd">Contraseña</label>
									<input type="password" class="form-control" id="#"  name="#">
								</div>
							</div>-->
						</div>
						
						<div class="buttom-content-up">
							<button type="button" class="btn btn-primary" @click="updateUserProfile()">Actualizar</button>
						</div>
					
					</form>
				</div>
       		</div>

			<div id="iempresa" class="container tab-pane fade"><br>
				<div class="content-perfil-empresa">
					<form action="/action_page.php">
						<div class="row perfil-empresa-form">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label for="ivaCondition">Condición de IVA</label>
									<input type="text" class="form-control" id="ivaCondition" v-model="ivaCondition">
								</div>
							</div>
							<div class="col-md-4 col-sm-12 ">
								<div class="form-group">
									<label for="rut">RUT</label>
									<input type="text" class="form-control" id="rut"  v-model="businessRut">
								</div>
							</div>
							<div class="col-md-4 col-sm-12 ">
								<div class="form-group">
									<label for="businessName">Razón Social</label>
									<input type="text" class="form-control" id="businessName"   v-model="businessName">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="city">País</label>
								<select class="form-control" v-model="country">
									<option value="" default>Seleccione</option>
									<option :value="country.id" v-for="country in countries">@{{ country.name }}</option>
								</select>
							</div>

							<div class="col" v-if="country == 4">
								<label for="region">Región</label>
								<select class="form-control" id="region" v-model="region" @change="fetchCommunes()">
									<option :value="region" v-for="region in regions">@{{ region.name }}</option>
								</select>
							</div>

							<div class="col" v-if="country == 4">
								<label for="commune">Comuna</label>
								<select class="form-control" id="commune" v-model="commune">
									<option :value="commune.id" v-for="commune in communes">@{{ region.name }} - @{{ commune.name }}</option>
								</select>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label for="businessPhone">Teléfono</label>
									<input type="text" class="form-control" id="businessPhone"  v-model="businessPhone" @keypress="isNumber($event)">
								</div>
							</div>
							<div class="col-md-4 col-sm-12 ">
								<div class="form-group">
									<label for="industry">Industria</label>
									<input type="text" class="form-control" id="industry"  v-model="industry">
								</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label for="amountEmployees">Cantidad de Empleados</label>
										<input type="text" class="form-control" id="amountEmployees"  v-model="amountEmployees" @keypress="isNumber($event)">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<label for="address">Dirección</label>
										<textarea type="text" class="form-control" id="address"  v-model="address" ></textarea>
									</div>
								</div>
							</div>
						
							<div class="buttom-content-up">
								<button type="button" class="btn btn-primary" @click="updateBusinessProfile()">Actualizar</button>
							</div>
					
							</form>
						</div>

				
					</form>
				</div>


			</div>
		</div>
    </div>

@endsection

@push("scripts")

<script>
        const devArea = new Vue({
            el: '#userProfile-dev',
            data() {
                return {
					image:"",
					address:"{{ $user->profile->address }}",
					imagePreview:"{{ Auth::user()->image }}",
                    name:"{{ Auth::user()->name }}",
                    lastname: "{{ Auth::user()->lastname }}",
					email:"{{ Auth::user()->email }}",
					businessRut:"{{ Auth::user()->business_rut }}",
					businessName:"{{ Auth::user()->business_name }}",
					businessPhone:"{{ Auth::user()->business_phone }}",
					ivaCondition:"{{ $user->profile->iva_condition }}",
					industry:"{{ $user->profile->industry }}",
					amountEmployees:"{{ $user->profile->amount_employees }}",
                    loading:false,
					region:"{{ Auth::user()->region_id }}",
                    commune:"{{ Auth::user()->commune_id }}",
					country:"",
					regions:[],
                    communes:[],
					countries:[]
                }
            },
            methods: {

				fetchCountries(){

					axios.get("{{ url('/country/fetch') }}").then(res => {
						
						if(res.data.success == true){
							this.countries = res.data.countries
						}

					})

				},
				fetchRegions(){

					axios.get("{{ url('/regions/fetch-all') }}").then(res => {

						if(res.data.success == true){
							this.regions = res.data.regions

							this.regions.forEach((data) => {

								if("{{ Auth::user()->region_id }}" == data.id){
									this.region = data
								}

							})

							this.fetchCommunes()

						}

					})

				},
				fetchCommunes(){

					//this.region = this.regionName.id

					axios.get("{{ url('/communes/fetch/') }}"+"/"+this.region.id).then(res => {

						if(res.data.success == true){
							this.communes = res.data.communes

						}

					})

				},
				onImageChange(e){
                    this.image = e.target.files[0];

                    this.imagePreview = URL.createObjectURL(this.image);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    this.createImage(files[0]);
                },
                createImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.image = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                updateUserProfile(){
                    this.loading = true
                    axios.post("{{ url('/profile/business/update') }}", {name: this.name, lastname: this.lastname, image: this.image}).then(res => {
                        this.loading = false
                        if(res.data.success == true){


							swal({
							
								text: res.data.msg,
								icon: "success"
							})
                            

                        }else{
                            this.loading = false
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
				updateBusinessProfile(){
                    this.loading = true
                    axios.post("{{ url('/profile/business/business/update') }}", {
						businessRut:this.businessRut,
						businessName:this.businessName,
						businessPhone:this.businessPhone,
						ivaCondition:this.ivaCondition,
						industry:this.industry,
						amountEmployees:this.amountEmployees,	
						countryId:this.country,
						region:this.region.id,
						commune:this.commune,
						address: this.address
					}).then(res => {
                        this.loading = false
                        if(res.data.success == true){


							swal({
								
								text: res.data.msg,
								icon: "success"
							})
                            

                        }else{
                            this.loading = false
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
				isNumber(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                        evt.preventDefault();;
                    } else {
                        return true;
                    }
                }

            },
			mounted(){

				this.country = "{{ $user->profile->country_id }}"
                if(this.country == ""){
                    this.country = 4
                }
				
				this.fetchCountries()
				this.fetchRegions()
				window.setTimeout(() => {
					this.fetchCommunes()
				}, 1000);
			}

        })
    </script>


@endpush