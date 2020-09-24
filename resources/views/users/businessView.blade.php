@extends("layouts.business")

@section("content")

    <div class="col-md-8 w-100" id="user-offers-dev">
        <div class="row" style="margin-top: 170px;">
            <div class="col-6">
                <h3>Ofertas: {{ App\ServiceAmount::where("user_id", \Auth::user()->id)->first()->post_amount }}</h3>
            </div>
            <div class="col-6">
                <h3>Conferencias: {{ App\ServiceAmount::where("user_id", \Auth::user()->id)->first()->conference_amount }}</h3>
            </div>
        </div>
        <div class="opciones-inf-empresas">
            Mis avisos
            <h3>Gestión de avisos ({{ App\Offer::where("user_id", \Auth::user()->id)->count() }} avisos)</h3>
            <div class="opciones-inf-empresas-opciones-select">
                <div class="opciones-inf-empresas-opciones-select-1">

                </div>
                <div class="opciones-inf-empresas-opciones-select-2">
                    <p>Ordenar por</p>
                    <select name="" id="">
                        <option value="">Selecciona una opción</option>
                        <option value="">Nuevo - Antiguo</option>
                        <option value="">Antiguo - Nuevo</option>
                        <option value="">Abierto - Cerrado</option>
                        <option value="">Cerrado - Abierto</option>
                    </select>
                </div>
                
            </div>
            <!--<div class="opciones-inf-empresas-subt">
                <div class="sub-localidad">
                <p>Aviso / Localidad</p>
                </div>
                <div class="opciones-inf-empresas-subt-list">
                    <p>Caduca el </p>
                    <p>Inscritos </p>
                    <p >Acciones </p>
                </div>
            </div>-->
            <table class="table">
                <thead>
                    <tr>
                        <th>Aviso/Localidad</th>
                        <th>Puesto</th>
                        <th>Expira</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="offer in offers">
                        <td>@{{ offer.title }}/@{{ offer.user.region.name }}</td>
                        <td>@{{ offer.job_position }}</td>
                        <td>@{{ offer.expiration_date.substring(0, 10) }}</td>
                        <td>
                            <a :href="'{{ url('/offers/detail/') }}'+'/'+offer.slug" class="btn btn-primary">Ver más</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{--<div class="caja-mis-avisos">
                <div class="row">
                    <div class="col-md-2">
                        <div class="caja-mis-avisos-col-2">
                            <img class="caja-mis-avisos_img" src="{{ asset('user/assets/img/alert.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <h5>Mis avisos</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis ab modi sapiente, illum cupiditate error quam mollitia iste eligendi adipisci, ipsam facilis iure numquam magnam nulla corrupti sunt dignissimos maiores.</p>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
    <div class="col-md-2 w-100">
        <div class="contenido-publicitario-empresas">
        <div class="alert  alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <img class="contenido-publicitario-empresas_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="">
        </div>
        <div class="alert  alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <img class="contenido-publicitario-empresas_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="">
        </div>

        </div>
    </div>

@endsection

@push("scripts")

    <script>
        const devArea = new Vue({
            el: '#user-offers-dev',
            data() {
                return {
                    offers:[],
                    page:1,
                    pages:0
                }
            },
            methods: {

                fetch(page = 1){

                    this.page = page
                    axios.get("{{ url('/offers/business/fetch') }}"+"/"+this.page)
                    .then(res => {

                        if(res.data.success == true){

                            this.offers = res.data.offers
                            this.pages = Math.ceil(res.data.offersCount / res.data.dataAmount)
                            
                        }else{

                            swal({
                                title:"Lo sentimos",
                                text:res.data.msg,
                                icon:"error"
                            })

                        }

                    })


                }

            },
            mounted(){
                this.fetch()
            }
        })

    </script>

@endpush