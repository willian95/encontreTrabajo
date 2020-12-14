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
                                    <video v-if="businessHomeType1 == 'video'" style="width: 100%;" controls>
                                        <source :src="businessHomeImagePreview1" type="video/mp4">
                                    </video>
                                    <img :src="businessHomeImagePreview1" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageBusinessHomeImage1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="businessHomeLink1">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(1)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(1)">Eliminar</button>
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <video v-if="businessHomeType2 == 'video'" style="width: 100%;" controls>
                                        <source :src="businessHomeImagePreview2" type="video/mp4">
                                    </video>
                                    <img :src="businessHomeImagePreview2" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageBusinessHomeImage2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="businessHomeLink2">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(2)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(2)">Eliminar</button>
                                    </p>
                                </div>
                            </div>

                            <h3 class="text-center">Home Usuario</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <video v-if="userHomeType1 == 'video'" style="width: 100%;" controls>
                                        <source :src="userHomeImagePreview1" type="video/mp4">
                                    </video>
                                    <img :src="userHomeImagePreview1" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageUserHomeImage" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="userHomeLink1">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(3)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(3)">Eliminar</button>
                                    </p>

                                </div>
                                
                            </div>

                            <h3 class="text-center">Perfil usuario</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <video v-if="userProfileType1 == 'video'" style="width: 100%;" controls>
                                        <source :src="userProfileImagePreview1" type="video/mp4">
                                    </video>
                                    <img :src="userProfileImagePreview1" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageUserProfileImage1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="userProfileLink1">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(4)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(4)">Eliminar</button>
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <img :src="userProfileImagePreview2" alt="" style="width:100%;">
                                    <div class="form-group">
                                        <input type="file" @change="onImageUserProfileImage2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="userProfileLink2">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(5)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(5)">Eliminar</button>
                                    </p>
                                </div>
                            </div>

                            <h3 class="text-center">Mostrar perfil usuario</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <video v-if="showUserProfileType1 == 'video'" style="width: 100%;" controls>
                                        <source :src="showUserProfileImagePreview1" type="video/mp4">
                                    </video>
                                    <img :src="showUserProfileImagePreview1" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageShowUserProfileImage1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="showUserProfileLink1">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(6)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(6)">Eliminar</button>
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <video v-if="showUserProfileImagePreview2 == 'video'" style="width: 100%;" controls>
                                        <source :src="showUserProfileImagePreview2" type="video/mp4">
                                    </video>
                                    <img :src="showUserProfileImagePreview2" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageShowUserProfileImage2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="showUserProfileLink2">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(7)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(7)">Eliminar</button>
                                    </p>
                                </div>
                            </div>

                            <h3 class="text-center">Buscar empleo</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <video v-if="searchJobType1 == 'video'" style="width: 100%;" controls>
                                        <source :src="searchJobPreview1" type="video/mp4">
                                    </video>
                                    <img :src="searchJobImagePreview1" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageSearchJobImage1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="searchJobLink1">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(8)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(8)">Eliminar</button>
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <video v-if="searchJobImagePreview2 == 'video'" style="width: 100%;" controls>
                                        <source :src="searchJobImagePreview2" type="video/mp4">
                                    </video>
                                    <img :src="searchJobImagePreview2" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageSearchJobImage2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="searchJobLink2">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(9)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(9)">Eliminar</button>
                                    </p>
                                </div>
                            </div>

                            <h3 class="text-center">Empleos landing</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <video v-if="landingJobType1 == 'video'" style="width: 100%;" controls>
                                        <source :src="landingJobPreview1" type="video/mp4">
                                    </video>
                                    <img :src="landingJobImagePreview1" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageLandingJobImage1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="landingJobLink1">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(10)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(10)">Eliminar</button>
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <video v-if="landingJobImagePreview2 == 'video'" style="width: 100%;" controls>
                                        <source :src="landingJobImagePreview2" type="video/mp4">
                                    </video>
                                    <img :src="landingJobImagePreview2" alt="" style="width:100%;" v-else>
                                    <div class="form-group">
                                        <input type="file" @change="onImageLandingJobImage2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" class="form-control" v-model="landingJobLink2">
                                    </div>

                                    <p class="text-center">
                                        <button class="btn btn-success" @click="update(11)">Actualizar</button>
                                        <button class="btn btn-danger" @click="erase(11)">Eliminar</button>
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
                    businessHomeImage1:"",
                    businessHomeImagePreview1:"{{ App\Ad::where('id', 1)->first()->image }}",
                    businessHomeLink1:"{{ App\Ad::where('id', 1)->first()->link }}",
                    businessHomeType1:"{{ App\Ad::where('id', 1)->first()->type }}",
                    businessHomeImage2:"",
                    businessHomeImagePreview2:"{{ App\Ad::where('id', 2)->first()->image }}",
                    businessHomeLink2:"{{ App\Ad::where('id', 2)->first()->link }}",
                    businessHomeType2:"{{ App\Ad::where('id', 2)->first()->type }}",
                    userHomeImage1:"",
                    userHomeImagePreview1:"{{ App\Ad::where('id', 3)->first()->image }}",
                    userHomeLink1:"{{ App\Ad::where('id', 3)->first()->link }}",
                    userHomeType1:"{{ App\Ad::where('id', 3)->first()->type }}",
                    userProfileImage1:"",
                    userProfileImagePreview1:"{{ App\Ad::where('id', 4)->first()->image }}",
                    userProfileLink1:"{{ App\Ad::where('id', 4)->first()->link }}",
                    userProfileType1:"{{ App\Ad::where('id', 4)->first()->type }}",
                    userProfileImage2:"",
                    userProfileImagePreview2:"{{ App\Ad::where('id', 5)->first()->image }}",
                    userProfileLink2:"{{ App\Ad::where('id', 5)->first()->link }}",
                    userProfileType2:"{{ App\Ad::where('id', 5)->first()->type }}",
                    showUserProfileImage1:"",
                    showUserProfileImagePreview1:"{{ App\Ad::where('id', 6)->first()->image }}",
                    showUserProfileLink1:"{{ App\Ad::where('id', 6)->first()->link }}",
                    showUserProfileType1:"{{ App\Ad::where('id', 6)->first()->type }}",
                    showUserProfileImage2:"",
                    showUserProfileImagePreview2:"{{ App\Ad::where('id', 7)->first()->image }}",
                    showUserProfileLink2:"{{ App\Ad::where('id', 7)->first()->link }}",
                    showUserProfileType2:"{{ App\Ad::where('id', 7)->first()->type }}",
                    searchJobImage1:"",
                    searchJobImagePreview1:"{{ App\Ad::where('id', 8)->first()->image }}",
                    searchJobLink1:"{{ App\Ad::where('id', 8)->first()->link }}",
                    searchJobType1:"{{ App\Ad::where('id', 8)->first()->type }}",
                    searchJobImage2:"",
                    searchJobImagePreview2:"{{ App\Ad::where('id', 9)->first()->image }}",
                    searchJobLink2:"{{ App\Ad::where('id', 9)->first()->link }}",
                    searchJobType2:"{{ App\Ad::where('id', 9)->first()->type }}",
                    landingJobImage1:"",
                    landingJobImagePreview1:"{{ App\Ad::where('id', 10)->first()->image }}",
                    landingJobLink1:"{{ App\Ad::where('id', 10)->first()->link }}",
                    landingJobType1:"{{ App\Ad::where('id', 10)->first()->type }}",
                    landingJobImage2:"",
                    landingJobImagePreview2:"{{ App\Ad::where('id', 11)->first()->image }}",
                    landingJobLink2:"{{ App\Ad::where('id', 11)->first()->link }}",
                    landingJobType2:"{{ App\Ad::where('id', 11)->first()->type }}",
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
                onImageUserHomeImage(e){
                    this.userHomeImage1 = e.target.files[0];

                    this.userHomeImagePreview1 = URL.createObjectURL(this.userHomeImage1);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.userHomeImage1 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageUserProfileImage1(e){
                    this.userProfileImage1 = e.target.files[0];

                    this.userProfileImagePreview1 = URL.createObjectURL(this.userProfileImage1);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.userProfileImage1 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageUserProfileImage2(e){
                    this.userProfileImage2 = e.target.files[0];

                    this.userProfileImagePreview2 = URL.createObjectURL(this.userProfileImage2);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.userProfileImage2 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageShowUserProfileImage1(e){
                    this.showUserProfileImage1 = e.target.files[0];

                    this.showUserProfileImagePreview1 = URL.createObjectURL(this.showUserProfileImage1);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.showUserProfileImage1 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageShowUserProfileImage2(e){
                    this.showUserProfileImage2 = e.target.files[0];

                    this.showUserProfileImagePreview2 = URL.createObjectURL(this.showUserProfileImage2);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.showUserProfileImage2 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageSearchJobImage1(e){
                    this.searchJobImage1 = e.target.files[0];

                    this.searchJobImagePreview1 = URL.createObjectURL(this.searchJobImage1);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.searchJobImage1 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageSearchJobImage2(e){
                    this.searchJobImage2 = e.target.files[0];

                    this.searchJobImagePreview2 = URL.createObjectURL(this.searchJobImage2);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.searchJobImage2 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageLandingJobImage1(e){
                    this.landingJobImage1 = e.target.files[0];

                    this.landingJobImagePreview1 = URL.createObjectURL(this.landingJobImage1);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.landingJobImage1 = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                onImageLandingJobImage2(e){
                    this.landingJobImage2 = e.target.files[0];

                    this.landingJobImagePreview2 = URL.createObjectURL(this.landingJobImage2);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.landingJobImage2 = e.target.result;
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
                    else if(id == 3){
                        image = this.userHomeImage1
                        link = this.userHomeLink1
                    }
                    else if(id == 4){
                        image = this.userProfileImage1
                        link = this.userProfileLink1
                    }
                    else if(id == 5){
                        image = this.userProfileImage2
                        link = this.userProfileLink2
                    }
                    else if(id == 6){
                        image = this.showUserProfileImage1
                        link = this.showUserProfileLink1
                    }
                    else if(id == 7){
                        image = this.showUserProfileImage2
                        link = this.showUserProfileLink2
                    }
                    else if(id == 8){
                        image = this.searchJobImage1
                        link = this.searchJobLink1
                    }
                    else if(id == 9){
                        image = this.searchJobImage2
                        link = this.searchJobLink2
                    }
                    else if(id == 10){
                        image = this.landingJobImage1
                        link = this.landingJobLink1
                    }
                    else if(id == 11){
                        image = this.landingJobImage2
                        link = this.landingJobLink2
                    }
                    this.loading = true
                    axios.post("{{ url('/admin/ads/update') }}", {"image": image, "id": id, "link": link}).then(res => {
                        this.loading = false
                        if(res.data.success == true){
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

                },
                erase(id){

                    axios.post("{{ url('/admin/ads/delete') }}", {"id": id}).then(res => {
                        this.loading = false
                        if(res.data.success == true){
                            swal({
                                text: res.data.msg,
                                icon: "success"
                            }).then(res => {
                                window.location.reload()
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