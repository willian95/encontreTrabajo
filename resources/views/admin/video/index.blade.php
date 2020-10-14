@extends("layouts.admin")

@section("content")

    <div class="container" >
        <div id="dev-video">

            <div class="loader-cover-custom" v-if="loading == true">
                <div class="loader-custom"></div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3 mt-3">
                    <video style="width: 100%;" controls id="productVideo" v-if="imagePreview != null && imagePreview != ''">
                        <source :src="imagePreview" type="video/mp4">
                    </video>
                    <div class="form-group">
                        <label for="">Video</label>
                        <input type="file" class="form-control" @change="onImageChange">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p class="text-center">
                    <button class="btn btn-success" @click="update()">Actualizar</button>
                </p>
            </div>
        </div>

    </div>

@endsection

@push("scripts")

<script>
        
        const app = new Vue({
            el: '#dev-video',
            data(){
                return{
                    image:"",
                    imagePreview:"{{ $image }}",
                    loading:false,
                 
                }
            },
            methods:{

                onImageChange(e){
                    this.image = e.target.files[0];

                    this.imagePreview = URL.createObjectURL(this.image);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                
                    this.createImage(files[0]);
                },
                createImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.image = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                update(){
                    this.loading = true
                    
                    axios.post("{{ url('/admin/video/update') }}", {video: this.image}).then(res => {
                        this.loading = false
                        if(res.data.success == true){
                            swal({
                                text:res.data.msg,
                                icon:"success"
                            })
                        }else{

                            swal({
                                text:res.data.msg,
                                icon:"error"
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