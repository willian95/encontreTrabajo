@extends("layouts.auth")

@section("content")

    <section class="content-register" id="register-dev">

        <div class="loader-cover" v-if="loading == true">
            <div class="loader"></div>
        </div>

        <div class=" content-register">
            <div class="row">
                <div class="col-md-6 content-logo">
                    <div class="section-logo">
                        <img class="content-logo-fondo" src="{{ url('user/assets/img/register.jpg') }}" alt="">
                        <div class="mask">

                        </div>
                    </div>
                    <div class="content-logo-img">
                            <img class="content-logo-img-img" src="{{ url('user/assets/img/Logo-blanco.png') }}" alt="logo Encontré trabajo">
                    </div>
                </div>


        <div class="col-md-6 content-tabs-inf">
        <div class="content-tab-tabs">
                    <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item a">
                <a class="nav-link active" data-toggle="tab" href="#usuario" @click="changeUserType(2)">Usuario</a>
                </li>
                <li class="nav-item b">
                <a class="nav-link" data-toggle="tab" href="#empresa" @click="changeUserType(3)">Empresas</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="usuario" class="container tab-pane active"><br>
                    <div class="container">
                            <h2>Registro</h2>
                            <form action="/action_page.php">
                                <div class="row">
                                <div class="col r-col-100">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="name" class="form-control" id="name" v-model="name">
                                </div>
                                </div>
                                <div class="col r-col-100">
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input type="text" class="form-control" id="apellido"  v-model="lastname">
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col r-col-100">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email"  v-model="email">
                                </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="puesto">Puesto Deseado</label>
                                        <input type="text" class="form-control" id="puesto"  v-model="desiredJob">
                                    </div>
                                </div>
                                </div>
                                
                                <div class="row">
                                <div class="col r-col-100">
                                <div class="form-group">
                                    <label for="pwd">Contraseña</label>
                                    <input type="password" class="form-control" id="pwd"  v-model="password" @keyup="checkPass()">
                                    <small>@{{ passStrength }}</small>
                                    
                                </div>
                                </div>
                                <div class="col r-col-100">
                                <div class="form-group">
                                    <label for="pwd-repeat">Repetir Contraseña</label>
                                    <input type="password" class="form-control" id="pwd-repeat"  v-model="repeatPassword">
                                </div>
                                </div>
                                </div>
                        
                                <div class="buttom-content">
                                    <button type="button" class="btn btn-primary" @click="register()">Registro</button>
                                </div>
                                <div class="content-tabs-tabs">
                                        <p>Al registrase acepta nuestros <a href="#">Términos y condiciones</a></p>
                                        <p>¿Ya tienes una cuenta? <a href="{{ url('/') }}">Iniciar Sesión</a></p>
                                </div>
                        </form>
                    </div>
                </div>
                <div id="empresa" class="container tab-pane fade"><br>
                    <div class="container">
                        <h2>Registro</h2>
                        <form action="/action_page.php">
                            <div class="row">
                            <div class="col r-col-100">
                            <div class="form-group">
                                <label for="businessName">Empresa </label>
                                <input type="text" class="form-control" id="businessName" v-model="businessName">
                            </div>
                            </div>
                            <div class="col r-col-100">
                            <div class="form-group">
                                <label for="businessRut">RUT</label>
                                <input type="text" class="form-control" id="businessRut"  v-model="businessRut">
                            </div>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col r-col-100">
                            <div class="form-group">
                                <label for="name2">Nombre</label>
                                <input type="text" class="form-control" id="name2" v-model="name">
                            </div>
                            </div>
                            <div class="col r-col-100">
                            <div class="form-group">
                                <label for="lastname2">Apellido</label>
                                <input type="text" class="form-control" id="lastname2"  v-model="lastname">
                            </div>
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col r-col-100">
                            <div class="form-group">
                                <label for="email2">Email</label>
                                <input type="email" class="form-control" id="email2"  v-model="email">
                            </div>
                            </div>
                            <div class="col r-col-100">
                            <div class="form-group">
                                <label for="businessPhone">Teléfono</label>
                                <input type="text" class="form-control" id="businessPhone"  v-model="businessPhone">
                            </div>
                            </div>
                            </div>
                            
                            <div class="row">
                                <div class="col r-col-100">
                                    <div class="form-group">
                                        <label for="pwd2">Contraseña</label>
                                        <input type="password" class="form-control" id="pwd2"  v-model="password" @keyup="checkPass()">
                                        <small>@{{ passStrength }}</small>
                                    </div>
                                </div>
                                <div class="col r-col-100">
                                    <div class="form-group">
                                        <label for="pwd-repeat2">Repetir Contraseña</label>
                                        <input type="password" class="form-control" id="pwd-repeat2"  v-model="repeatPassword">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="buttom-content">
                                <button type="button" class="btn btn-primary" @click="register()">Registro</button>
                            </div>
                            <div class="content-tabs-tabs">
                                <p>Al registrase acepta nuestros <a href="#">Términos y condiciones</a></p>
                                <p>¿Ya tienes una cuenta? <a href="{{ url('/') }}">Iniciar Sesión</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
        </div>
        
    </div>

    </div>

    </section>

@endsection

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <script>
        const devArea = new Vue({
            el: '#register-dev',
            data() {
                return {
                    roleId:2,
                    name:"",
                    lastname:"",
                    email: "",
                    desiredJob:"",
                    regions:[],
                    region:"",
                    communes:[],
                    commune:"",
                    password:"",
                    repeatPassword:"",
                    businessName:"",
                    businessRut:"",
                    businessPhone:"",
                    passStrength:"Mínimo 6 caracteres",
                    loading:false
                }
            },
            methods: {

                changeUserType(type){

                    this.roleId = type
                    this.clear()
                   
                },
                checkPass(){

                    let score = zxcvbn(this.password).score

                    if(score == 0 && this.password.length >= 6){
                        this.passStrength = "Mala seguridad"
                    }

                    else if(score == 1 && this.password.length >= 6){
                        this.passStrength = "Baja seguridad"
                    }

                    else if(score == 2 && this.password.length >= 6){
                        this.passStrength = "Debil seguridad"
                    }

                    else if(score == 3 && this.password.length >= 6){
                        this.passStrength = "Buena seguridad"
                    }

                    else if(score == 4 && this.password.length >= 6){
                        this.passStrength = "Excelente seguridad"
                    }

                },
                register(){
                    this.loading = true
                    axios.post("{{ url('/register') }}", {
                        name:this.name,
                        lastname:this.lastname,
                        email:this.email,
                        desiredJob:this.desiredJob,
                        password:this.password,
                        role_id: this.roleId,
                        password_confirmation: this.repeatPassword,
                        region:this.region,
                        commune:this.commune,
                        businessName:this.businessName,
                        businessRut:this.businessRut,
                        businessPhone:this.businessPhone
                    })
                    .then(res => {  
                        this.loading = false
                        if(res.data.success == true){

                            swal({
                                title:"Excelente!",
                                text:res.data.msg,
                                icon:"success"
                            })

                            this.clear()

                        }else{
                            swal({
                                title:"Lo sentimos!",
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
                clear(){

                    this.name = ""
                    this.lastname = ""
                    this.email = ""
                    this.desiredJob = ""
                    this.password = ""
                    this.region = ""
                    this.commune = ""
                    this.password = ""
                    this.repeatPassword = ""
                    this.businessPhone = ""
                    this.businessName = ""
                    this.businessRut = ""
                    this.passStrength = "Mínimo 6 caracteres"

                }

                    
            }

        })
    </script>

@endpush