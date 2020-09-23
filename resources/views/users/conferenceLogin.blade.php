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
                                <h2>Ingresar a la sala</h2>
                                <form>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="password">Contraseña</label>
                                                <input type="password" class="form-control" id="password"  v-model="password">
                                                <small>La contraseña fue enviada a tu correo</small>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="buttom-content">
                                        <button type="button" @click="login()" class="btn btn-primary">Ingresar</button>
                                        
                                    </div>

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
                title:"Excelente",
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
                                    title: "Excelente!",
                                    text: res.data.msg,
                                    icon: "success"
                                }).then(() => {
                                    window.location.href="{{ url('/admin/dashboard') }}"
                                })
                                

                            }else if(res.data.role_id == 2 || res.data.role_id == 3){

                                swal({
                                    title: "Excelente!",
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

                }

            }

        })
    </script>

@endpush

