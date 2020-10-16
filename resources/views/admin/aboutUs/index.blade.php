@extends("layouts.admin")

@section("content")

    <div class="container" >
        <div id="dev-about-us">

            <div class="loader-cover-custom" v-if="loading == true">
                <div class="loader-custom"></div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3 mt-3">
                    <img :src="imagePreview" alt="" style="width: 100%">
                    <div class="form-group">
                        <label for="">Imagen</label>
                        <input type="file" class="form-control" @change="onImageChange">
                    </div>
                </div>
            </div>
            <button style="display:none" @click="update()" id="click"></button>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <label for="">Texto 1</label>
                <textarea name="editor1" id="editor1" rows="10" cols="80">
                    {!! $text !!}
                </textarea>

                <label for="">Texto 2</label>
                <textarea name="editor2" id="editor1" rows="10" cols="80">
                    {!! $text !!}
                </textarea>
            </div>
            <div class="col-12">
                <p class="text-center">
                    <button class="btn btn-success" onclick="normalClick()">Actualizar</button>
                </p>
            </div>
        </div>
        
    </div>

@endsection

@push("scripts")

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
        function normalClick(){
            $("#click").click();
        }
    </script>

<script>
        
        const app = new Vue({
            el: '#dev-about-us',
            data(){
                return{
                    id:"",
                    image:"",
                    imagePreview:"{{ $image }}",
                    text:"",
                    text2:"",
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
                    this.text = CKEDITOR.instances.editor1.getData()
                    this.text2 = CKEDITOR.instances.editor2.getData()
                    axios.post("{{ url('/admin/about-us/update') }}", {text: this.text, text2: this.text2, image: this.image}).then(res => {
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