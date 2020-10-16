@extends("layouts.business")

@section("content")

    <div class="col-md-10 cont-ofertas-9">
        <div class="row" id="dev-plan" style="margin-top: 100px;">

            <div class="loader-cover" v-if="loading == true">
                <div class="loader"></div>
            </div>
            <div style="position: fixed; top: 0; bottom: 0; left:0; right: 0; width: 100%; background: rgba(0, 0, 0, 0.6); z-index: 999999; display:none;" id="cover">

            </div>

            <div class="col-md-4 col-lg-4" v-for="plan in plans">

                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center title-plan">@{{ plan.title }}</h3>

                        <p><strong>Publicaciones: </strong>@{{ plan.post_amount }}</p>
                        <p><strong>Conferencias: </strong>@{{ plan.conference_amount }}</p>

                        <h4 class="text-center price-plan">$ @{{ parseInt(plan.price).toString().replace(/\B(?=(\d{3})+\b)/g, ".") }}</h4>


                        <p class="text-center">
                            <button class="btn btn-success" @click="cartStore(plan.id, plan.price)">Comprar</button>
                        </p>
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