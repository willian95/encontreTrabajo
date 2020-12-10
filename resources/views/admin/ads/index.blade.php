@extends("layouts.admin")

@section("content")
    
    <div id="dev-ads">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" v-cloak>
            <div class="d-flex flex-column-fluid">

                <div class="loader-cover-custom" v-if="loading == true">
                    <div class="loader-custom"></div>
                </div>

                <div class="container">
                
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Publicidades
                            </div>
        
                        </div>
                        <div class="card-body">
                            
                            <h3 class="text-center">Home empresa</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <img :src="businessHomeImagePreview1" alt="" style="width:100%;">
                                    <div class="form-group">
                                        <input type="file" @change="onImageBusinessHomeImage1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(1)">Actualizar</button>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <img :src="businessHomeImagePreview2" alt="" style="width:100%;">
                                    <div class="form-group">
                                        <input type="file" @change="onImageBusinessHomeImage2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success">Actualizar</button>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </p>
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
        
        const app = new Vue({
            el: '#dev-ads',
            data(){
                return{
                    loading:false,
                    businessHomeImagePreview1:"{{ App\Ad::where('id', 1)->first()->image }}",
                    businessHomeLink1:"",
                    businessHomeImage2:"",
                    businessHomeImagePreview2:"{{ App\Ad::where('id', 2)->first()->image }}",
                    businessHomeLink2:""
                }
            },
            methods:{
            
                onImageBusinessHomeImage1(e){
                    this.businessHomeImage1 = e.target.files[0];

                    this.businessHomeImagePreview1 = URL.createObjectURL(this.businessHomeImage1);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.businessHomeImage1 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageBusinessHomeImage2(e){
                    this.businessHomeImage2 = e.target.files[0];

                    this.businessHomeImagePreview2 = URL.createObjectURL(this.businessHomeImage2);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.businessHomeImage2 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                update(id){

                    let image = ""
                    let link = ""
                    if(id == 1){
                        image = this.businessHomeImage1
                        link = this.businessHomeLink1
                    }else if(id == 2){
                        image = this.businessHomeImage2
                        link = this.businessHomeLink2
                    }
                    this.loading = true
                    axios.post("{{ url('/admin/ads/update') }}", {"image": image, "id": id, "link": link}).then(res => {
                        this.loading = false
                        if(res.success == true){
                            swal({
                                text: res.data.msg,
                                icon: "success"
                            })
                        }else{
                            swal({
                                text: res.data.msg,
                                icon: "error"
                            })
                        }

                    })

                }
                


            },
            mounted(){
                

            }

        })
    
    </script>

@endpush