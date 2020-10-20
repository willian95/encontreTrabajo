@extends("layouts.business")

@section("content")

    <div class="col-md-10 cont-ofertas-9">
        <div class="" id="dev-plan" style="margin-top: 100px;">
            <div class="loader-cover" v-if="loading == true">
                <div class="loader"></div>
            </div>
            <div style="position: fixed; top: 0; bottom: 0; left:0; right: 0; width: 100%; background: rgba(0, 0, 0, 0.6); z-index: 999999; display:none;" id="cover">
            </div>

            <div class="row d-flex justify-content-center content-planes-plataforma-et">
                <div class="col-md-4 mt-3 card-plan-col-4" v-for="plan in plans">
                        <div class="card-planes " >
                            <div class="card">
                                <div class="img-planes d-flex justify-content-center">
                                    <img src="{{ asset('user/assets/img/Logo-fullcolor.png') }}" alt="logo encontre trabajo">
                                </div>
                                <h3 class="text-center text-uppercase">@{{ plan.title }}</h3>
                                <h4 class="text-center">$ @{{ parseInt(plan.price).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</h4>
                                <h6 class="text-center text-uppercase">iva incluido</h6>
                                <img class="wave_img" src="{{ asset('user/assets/img/wamarillo.svg') }}" alt="waves">
                                <div class="box-waves fondo-am">
                                    <div class="box-waves-text fondo-am">
                                        <ul class=" box-waves-text_ul ">
                                            <li><strong>Publicaciones: </strong>@{{ plan.post_amount }}</li>
                                            <li><strong>Conferencias: </strong>@{{ plan.conference_amount }}</li>
                                        </ul>
                                        <div class="d-flex justify-content-center mb-5">
                                            <button style=" background: #188a75;" class="btn btn-success" @click="cartStore(plan.id, plan.price)"><strong>Comprar</strong></button>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection

@push("scripts")

    <script>

        const devArea = new Vue({
            el: '#dev-plan',
            data() {
                return {
                    loading:false,
                    plans:JSON.parse('{!! App\Plan::all() !!}'),
                childWin:null,
                intervalID:null
            }
        },
        methods: {
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
                openChildWindow(index) {
                    this.childWin = window.open("{{ url('/checkout/') }}"+"/"+index, 'print_popup', 'width=600,height=600')
                    
                    $("#cover").css("display", "block")
                },
                checkWindow() {
                    if (this.childWin && this.childWin.closed) {
                        window.clearInterval(this.intervalID);
                        $("#cover").css("display", "none")
                        if (localStorage.getItem("paymentStatusTrabajo") == 'aprobado') {
                            wndow.location.reload()
                        } else if (localStorage.getItem("paymentStatusTrabajo") == 'rechazado') {
                            $("#cover").css("display", "none")
                        }
                    }
                }

            },
            mounted(){
                
                this.intervalID = window.setInterval(this.checkWindow, 500);
            }
        })

    </script>

@endpush