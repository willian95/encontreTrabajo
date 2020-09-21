@extends("layouts.user")

@section("content")

    <div class="col-10" id="proposals-dev" style="margin-top: 100px;">
      

            <h3 class="text-center">Ofertas respondidas</h3>
            <div class="ofertas-respond">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Titulo</th>
                            <th>Puesto</th>
                            <th>Perfil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(proposal, index) in proposals">
                            <td v-if="page == 1">@{{ index + 1 }}</td>
                            <td v-else>@{{ (index + 1) + (dataAmount * page) }}</td>
                            <td>@{{ proposal.user.name }}</td>
                            <td>@{{ proposal.user.lastname }}</td>
                            <td>@{{ proposal.user.email }}</td>
                            <td>@{{ proposal.offer.title }}</td>
                            <td>@{{ proposal.offer.job_position }}</td>
                            <td>
                                <a :href="'{{ url('/profile/show/') }}'+'/'+proposal.user.email" class="btn btn-info">Ver perfil</a>
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

                    axios.get("{{ url('/my-proposals/fetch') }}"+"/"+this.page)
                    .then(res => {

                        if(res.data.success == true){

                            this.proposals = res.data.proposals
                            this.pages = Math.ceil(res.data.offersCount / res.data.dataAmount)
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