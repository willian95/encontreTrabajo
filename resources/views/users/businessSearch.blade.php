@extends("layouts.business")

@section("content")

    <div class="col-md-8 resultados-busqueda" id="business-search-dev" style="margin-top: 100px;">
        <div class="row" v-cloak>   

            <div class="col-md-4" v-for="user in users">
                <div class="card">
                    <div class="card-body">
                        
                        <p class="text-center">
                            <img class="round-img" :src="user.users.user.image" alt="Card image">
                        </p>
                        <p class="text-center text-b">@{{ user.users.user.name }}</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-cloak>
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item" v-if="page > 1">
                            <a class="page-link" href="#" aria-label="Previous" @click="query(page -1)">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li v-for="index in pages" class="page-item" ><a class="page-link" href="#" @click="query(index)">@{{ index }}</a></li>
                        <!--<li class="page-item" v-if="page < pages">
                            <a class="page-link" href="#" aria-label="Next" @click="query(page + 3)">
                                <span aria-hidden="true">&raquo;</span>
                            </a>    
                        </li>-->
                    </ul>
                </nav>
            </div>
        </div>

    </div>


@endsection

@push("scripts")

    <script>

        const devArea = new Vue({
            el: '#business-search-dev',
            data() {
                return {
                    search:"",
                    users:[],
                    page:1,
                    pages:0
                }
            },
            methods: {
//
                async query(page = 1){

                    this.page = page

                    let userRes = await axios.post("{{ url('/business/search') }}", {search: this.search, page: this.page})
                   
                    if(userRes.data.success == true){
                        console.log(userRes.data)
                        this.users = userRes.data.users
                        this.pages = Math.ceil(userRes.data.usersCount / userRes.data.dataAmount)
                        
                    }

                },


            },
            mounted(){
                
                this.search = window.localStorage.getItem("encontre_trabajo_categories_query")
                this.query()
            }
        })

    </script>

@endpush