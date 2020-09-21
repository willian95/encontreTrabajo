@extends("layouts.auth")

@section("content")

<section class="content-register" id="password-recovery-dev">
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
                                <h2>Reestablecer Contraseña</h2>
                        
                                <div class="row">
                                    <div class="col r-col-100">
                                        <div class="form-group">
                                            <!-- <label for="">Clave</label> -->
                                            <input placeholder="Contraseña" type="password" class="form-control" v-model="password">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label for="">Repetir clave</label> -->
                                            <input placeholder="Repetir clave" type="password" class="form-control" v-model="password_confirmation">
                                        </div>
                                    
                    
                                    </div>

                                </div>
                        
                                <div class="buttom-content">
                                    <button type="button" @click="update()" class="btn btn-primary">Reestablecer</button>
                                    
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

    <script>
        const devArea = new Vue({
            el: '#password-recovery-dev',
            data() {
                return {
                    password: "",
                    password_confirmation:"",
                    receovery_hash:"{{ $hash }}"
                    loading:false
                }
            },
            methods: {

                update(){
                    this.loading = true
                    axios.post("{{ url('/password/restore') }}", {password: this.password, password_confirmation: this.password_confirmation, recovery_hash: this.receovery_hash}).then(res => {
                        this.loading = false
                        if(res.data.success == true){

                            if(res.data.success == true){

                                swal({
                                    title: "Excelente!",
                                    text: res.data.msg,
                                    icon: "success"
                                }).then(() => {
                                    //console.log(res.data)
                                    window.location.href="{{ url('/') }}"
                                })

                            }

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

                }

            }

        })
    </script>

@endpush