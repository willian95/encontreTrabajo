@extends("layouts.user")

@section("content")

    
        <div class="col-md-9 postulaciones-col9 d-flex align-items-center flex-column" id="proposals-dev" style="margin-top: 100px;">

            <h3 class="text-center">Mis Postulaciones</h3>
            <div class="table-mis-app">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Empresa</th>
                            <th>Titulo</th>
                            <th>Puesto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(proposal, index) in proposals">
                            <td v-if="page == 1">@{{ index + 1 }}</td>
                            <td v-else>@{{ (index + 1) + (dataAmount * page) }}</td>
                            <td>@{{ proposal.offer.user.business_name }}</td>
                            <td>@{{ proposal.offer.title }}</td>
                            <td>@{{ proposal.offer.job_position }}</td>
                            <td>
                                <a :href="'{{ url('/profile/show/') }}'+'/'+proposal.offer.user.id" class="btn btn-info">Ver perfil</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    

@endsection

@push("scripts")

    <script>
        const devArea = new Vue({
            el: '#proposals-dev',
            data() {
                return {
                    loading:false,
                    proposals:[],
                    dataAmount:0,
                    page:1,
                    pages:0

                }
            },
            methods: {

                fetchProposals(page = 1){

                    this.page = page

                    axios.get("{{ url('/my-applies/fetch') }}"+"/"+this.page)
                    .then(res => {
                        console.log(res)
                        if(res.data.success == true){

                            this.proposals = res.data.applies
                            this.pages = Math.ceil(res.data.appliesCount / res.data.dataAmount)
                            this.dataAmount = res.data.dataAmount

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
                
              
                this.fetchProposals()
                

            }

        })
    </script>

@endpush