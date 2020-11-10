@extends("layouts.auth")

@section("content")

    <section class="content-register" id="register-dev">

        <!-- Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Términos y condiciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non mollis dolor. Mauris nec nunc lacus. Suspendisse ultricies sollicitudin dui, nec ultrices tellus laoreet sed. Donec convallis vulputate odio, vel suscipit lorem molestie eleifend. Fusce eget quam ut nulla auctor sagittis. Proin purus tortor, ultrices vitae suscipit nec, viverra non est. Maecenas rhoncus magna tortor, non gravida mauris mollis sed. Quisque justo metus, aliquet eget nisi in, ornare euismod est. Maecenas ultricies elit nec tristique viverra.

                        Aliquam ultrices velit vitae magna finibus congue quis ac tortor. Aliquam eget metus iaculis, ullamcorper urna vitae, convallis mi. Quisque porta, leo et feugiat eleifend, ante lectus fermentum erat, semper pulvinar sem ex a ipsum. Sed vitae metus ac arcu sodales tincidunt sed id lectus. Nam vitae hendrerit massa. Aenean mi ipsum, faucibus quis rutrum et, blandit et eros. Curabitur sem nulla, rhoncus ac ipsum varius, efficitur ultrices dolor.

                        In quis nulla lorem. Cras pulvinar mattis sapien, sit amet scelerisque nunc hendrerit sed. Nunc malesuada ante tincidunt nulla tincidunt, ut ultrices orci euismod. Phasellus rhoncus quam ullamcorper magna varius, eget euismod nisl blandit. Nullam a accumsan ante. Nam vel fermentum ligula, quis rhoncus nibh. Sed et malesuada turpis. Ut nec arcu sit amet diam elementum feugiat.

                        Aenean vitae tellus a orci aliquam luctus id sed diam. Suspendisse eu felis sodales, egestas leo et, iaculis mauris. Aenean venenatis scelerisque nibh. Phasellus rhoncus suscipit quam, nec viverra justo eleifend in. Ut quis diam libero. Morbi vel vulputate magna. Integer et est mi. Mauris venenatis accumsan blandit. Nunc a mollis nulla. Vivamus sit amet vulputate metus.

                        Proin finibus lectus eget congue porttitor. Nullam viverra tincidunt arcu, et lacinia lacus sollicitudin vel. Etiam nec lacinia tellus. Vestibulum malesuada elementum varius. Cras mollis vehicula erat, a tristique leo pretium et. Ut id lobortis libero. Maecenas commodo hendrerit neque, at scelerisque purus vestibulum ac. Nunc sit amet commodo dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean nisl tortor, vehicula nec risus sed, convallis iaculis leo. Etiam semper, erat non cursus vestibulum, urna ex dignissim tortor, sit amet luctus leo ipsum at metus. Sed porttitor ultrices sodales. Pellentesque lectus est, lobortis nec condimentum id, venenatis ac nunc.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


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
                            <h2>Registro Usuario</h2>
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
                                        <p>Al registrase acepta nuestros <a href="#" data-toggle="modal" data-target="#termsModal">Términos y condiciones</a></p>
                                        <p>¿Ya tienes una cuenta? <a href="{{ url('/') }}">Iniciar Sesión</a></p>
                                </div>
                        </form>
                    </div>
                </div>
                <div id="empresa" class="container tab-pane fade"><br>
                    <div class="container">
                        <h2>Registro Empresa</h2>
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
                                <input type="text" class="form-control" id="businessRut"  v-model="businessRut" @keyup="formatMoney()">
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
                                <p>Al registrase acepta nuestros <a href="#" data-toggle="modal" data-target="#termsModal">Términos y condiciones</a></p>
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

                    else{
                        this.passStrength = "Mínimo 6 caracteres"
                    }

                },
                formatMoney() {
                    let oldRut = this.businessRut.replaceAll(".", "")
                    let newRut = oldRut.toString().replace(/\B(?=(\d{3})+\b)/g, ".")


                    if(this.businessRut.replace(".", "").length < 12){
                        
                        this.businessRut = newRut
                    }else{

                        this.businessRut = newRut.substring(0, 12)

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