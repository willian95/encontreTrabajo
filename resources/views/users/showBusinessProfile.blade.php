@extends("layouts.secondaryViews")

@section("content")

    <div class="container mt-3 perfil-encontre-trabajo" id="userProfile-dev">
        <h2 style="text-transform: uppercase">{{ $user->business_name }}</h2>
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

							</div>
						</div>
						<div class="row perfil-empresa-form">
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="text">Nombre</label>
									<input type="text" class="form-control" id="#" v-model="name" readonly>
								</div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="text">Apellido</label>
									<input type="text" class="form-control" id="#"  v-model="lastname" readonly>
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
									<input type="text" class="form-control" id="ivaCondition" v-model="ivaCondition" readonly>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 ">
								<div class="form-group">
									<label for="rut">RUT</label>
									<input type="text" class="form-control" id="rut"  v-model="businessRut" readonly>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 ">
								<div class="form-group">
									<label for="businessName">Razón Social</label>
									<input type="text" class="form-control" id="businessName"   v-model="businessName" readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="city">País</label>
								<select class="form-control" v-model="country" disabled>
									<option value="" default>Seleccione</option>
									<option :value="country.id" v-for="country in countries">@{{ country.name }}</option>
								</select>
							</div>

							<div class="col" v-if="country == 4">
								<label for="region">Región</label>
								<select class="form-control" id="region" v-model="region" @change="fetchCommunes()" disabled>
									<option :value="region" v-for="region in regions">@{{ region.name }}</option>
								</select>
							</div>

							<div class="col" v-if="country == 4">
								<label for="commune">Comuna</label>
								<select class="form-control" id="commune" v-model="commune" disabled>
									<option :value="commune.id" v-for="commune in communes">@{{ region.name }} - @{{ commune.name }}</option>
								</select>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label for="businessPhone">Teléfono</label>
									<input type="text" class="form-control" id="businessPhone"  v-model="businessPhone" readonly>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 ">
								<div class="form-group">
									<label for="industry">Industria</label>
									<input type="text" class="form-control" id="industry"  v-model="industry" readonly>
								</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label for="amountEmployees">Cantidad de Empleados</label>
										<input type="text" class="form-control" id="amountEmployees"  v-model="amountEmployees" readonly>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<label for="address">Dirección</label>
										<textarea type="text" class="form-control" id="address"  v-model="address" readonly></textarea>
									</div>
								</div>
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
					address:"{{ $profile->address }}",
					imagePreview:"{{ $user->image }}",
                    name:"{{ $user->name }}",
                    lastname: "{{ $user->lastname }}",
					email:"{{ $user->email }}",
					businessRut:"{{ $user->business_rut }}",
					businessName:"{{ $user->business_name }}",
					businessPhone:"{{ $user->business_phone }}",
					ivaCondition:"{{ $profile->iva_condition }}",
					industry:"{{ $profile->industry }}",
					amountEmployees:"{{ $profile->amount_employees }}",
                    loading:false,
					region:"{{ $user->region_id }}",
                    commune:"{{ $user->commune_id }}",
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

								if("{{ $user->region_id }}" == data.id){
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

				}

            },
			mounted(){

				this.country = "{{ $profile->country_id }}"
				
				this.fetchCountries()
				this.fetchRegions()
				window.setTimeout(() => {
					this.fetchCommunes()
				}, 1000);
			}

        })
    </script>


@endpush