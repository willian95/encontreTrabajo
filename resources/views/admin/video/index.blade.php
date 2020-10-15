@extends("layouts.admin")

@section("content")

    <div class="container" >
        <div id="dev-video">

            <div class="loader-cover-custom" v-if="loading == true">
                <div class="loader-custom"></div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3 mt-3">
                    <video style="width: 100%;" controls id="productVideo" v-if="videoPreview != null && videoPreview != ''">
                        <source :src="videoPreview" type="video/mp4">
                    </video>
                    <div class="form-group">
                        <label for="">Video</label>
                        <input type="file" class="form-control" @change="onVideoChange" accept="video/*">
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
                    video:"",
                    videoPreview:"{{ $image }}",
                    loading:false,
                 
                }
            },
            methods:{

                onVideoChange(e){
                    this.loading = true
                    this.video = e.target.files[0];

                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;

            
                    this.createVideo(files[0])
                    //this.createVideo(files[0]);
                },
                createVideo(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.video = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    this.loading = false
                },
                update(){
                    this.loading = true
                    
                    console.log(this.video)
                    var formData = new FormData()
                    formData.append("video", "hey") 

                    console.log(formData)

                    axios.post("{{ url('/admin/video-update') }}", formData).then(res => {
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