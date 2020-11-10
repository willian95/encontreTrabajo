@extends("layouts.auth")

@section("content")

    <section class="content-register" id="login-dev">
        <div class="loader-cover" v-if="loading == true">
            <div class="loader"></div>
        </div>
        <div class=" content-register">
            <div class="row">
                <div class="col-md-6 content-logo">
                    <div class="section-logo">
                        <img class="content-logo-fondo" src="{{ asset('user/assets/img/login2.jpg') }}" alt="">
                        <div class="mask">

                        </div>
                    </div>
                    <div class="content-logo-img">
                        <img class="content-logo-img-img" src="{{ asset('user/assets/img/Logo-blanco.png') }}" alt="logo Encontré trabajo">
                    </div>
                </div>


                <div class="col-md-6 ">
                    <div class="content-tab-tabs">
                    
                        <div class="container tab-pane active"><br>
                            <div class="container">
                                <h2>Iniciar sesión</h2>
                                <form>
                                    <div class="row">
                                        <div class="col r-col-100">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" v-model="email" v-on:keyup.enter="login()">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="password">Contraseña</label>
                                                <input type="password" class="form-control" id="password"  v-model="password" v-on:keyup.enter="login()">
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="buttom-content">
                                        <button type="button" @click="login()" class="btn btn-primary">Iniciar sesión</button>
                                        
                                    </div>

                                    <p style="margin-top:1rem;">
                                        <a href="{{ url('/forgot-password') }}">¿Olvidaste tu contraseña?</a>
                                    </p>

                                    <p class="text-center" style="margin-top:3rem;">
                                        <small>¿Aún no tienes una cuenta?</small>
                                    </p>
                                    <p class="text-center mb-5">
                                        <a href="{{ url('/register') }}" class="btn btn-primary">Registrate</a>
                                    </p>

                                    
                                    <p class="text-center mt-5">
                                        <a href="{{ env('LANDING_URL') }}" class="btn btn-outline-primary">Volver al inicio</a>
                                    </p>
                                

                                    
                                    
                                </form>
                            </div>
                        </div>
                    
                    </div>
                </div>
            
            </div>

        </div>

    </section>

@endsection

@push("scripts")

    @if(session('alert'))
        <script>
            swal({
             
                text:"{{ session('alert') }}",
                icon:"success"
            })
        </script>
    @endif

    <script>
        const devArea = new Vue({
            el: '#login-dev',
            data() {
                return {
                    email: "",
                    password: "",
                    loading:false
                }
            },
            methods: {

                login(){
                    this.loading = true
                    axios.post("{{ url('/login') }}", {email: this.email, password: this.password}).then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            if(res.data.role_id == 1){
                                swal({
                            
                                    text: res.data.msg,
                                    icon: "success"
                                }).then(() => {
                                    window.location.href="{{ url('/admin/dashboard') }}"
                                })
                                

                            }else if(res.data.role_id == 2 || res.data.role_id == 3){

                                swal({
                                  
                                    text: res.data.msg,
                                    icon: "success"
                                }).then(() => {
                                    //console.log(res.data)
                                    window.location.href=res.data.url
                               })
                            }

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

                }

            }

        })
    </script>

@endpush

