@extends("layouts.user")

@section("content")

<div class="col-md-9 w-100">
    <div class="container">
        <div class="opciones-perfil-encontre-trabajo-usuario">
            <div class="row">
                <div class="col-md-12 opciones-perfil-encontre-trabajo-usuario-info">
                    <div class="porcentaje-perfil-encontre-trabajo-usuario">
                    @php
                        $profile = App\Profile::where("user_id", Auth::user()->id)->first();
                        $profile_percentage = 0;

                        if(\Auth::user()->image != url('/')."/images/users/default.jpg"){
                            $profile_percentage += 20;
                        }
                        if($profile->video != null){
                            $profile_percentage += 20;
                        }
                        if($profile->curriculum != null){
                            $profile_percentage += 20;
                        }
                        if($profile->address != null){
                            $profile_percentage += 20;
                        }
                        if(App\AcademicBackground::where("user_id", \Auth::user()->id)->count() > 0){
                            $profile_percentage += 20;
                        }

                    @endphp
                    {{ $profile_percentage }} %
                    </div> 
                    <div class="opciones-perfil-encontre-trabajo-usuario-ul">
                    <ul class="opciones-perfil-encontre-trabajo-usuario_ul">
                        <li class="opciones-perfil-encontre-trabajo-usuario_li">
                        @if($profile->curriculum != null)
                            <h6>✔</h6>
                        @else
                            <h6>X</h6>
                        @endif
                        <p class="opciones-perfil-encontre-trabajo-usuario_li_p">Adjuntaste  tu CV</p></li>
                        <li class="opciones-perfil-encontre-trabajo-usuario_li">
                        @if(\Auth::user()->image != url('/')."/images/users/default.jpg")
                            <h6>✔</h6>
                        @else
                            <h6>X</h6>
                        @endif
                        <p class="opciones-perfil-encontre-trabajo-usuario_li_p">Adjuntaste tu foto</p></li>
                        <li class="opciones-perfil-encontre-trabajo-usuario_li">
                        @if($profile->video != null)
                            <h6>✔</h6>
                        @else
                            <h6>X</h6>
                        @endif
                        <p class="opciones-perfil-encontre-trabajo-usuario_li_p">Adjuntaste tu video</p></li>

                        <li class="opciones-perfil-encontre-trabajo-usuario_li">
                        @if(App\AcademicBackground::where("user_id", \Auth::user()->id)->count() > 0)
                            <h6>✔</h6>
                        @else
                            <h6>X</h6>
                        @endif
                        
                        <p class="opciones-perfil-encontre-trabajo-usuario_li_p">Resumen Educacional</p></li>
                        <li class="opciones-perfil-encontre-trabajo-usuario_li bb-n">
                        @if($profile->address != null)
                            <h6>✔</h6>
                        @else
                            <h6>X</h6>
                        @endif
                        <p class="opciones-perfil-encontre-trabajo-usuario_li_p">Dirección</p></li>
                    </ul>
                    </div>                 
                </div>
                <div class="col-md-12 opciones-perfil-encontre-trabajo-usuario-cajapublicitaria">
                    <div class="opciones-perfil-encontre-trabajo-usuario-publicidad">
                        <div class="alert  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <img class="opciones-perfil-encontre-trabajo-usuario-publicidad_img" src="{{ asset('user/assets/img/login.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras">
            <div class="container">
            <div class="row">
                <div class="col-md-4">
                <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil">
                    <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-head">
                    <h4>Perfil</h4>
                        <img src="{{ asset('user/assets/img/ico-editar.png') }}" alt="">
                    </div>
                    <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil-inf">
                    <h5 class="cajas-contenedoras-perfil_h5">Nombre:</h5>
                    <p class="cajas-contenedoras-perfil_p">{{ \Auth::user()->name }}</p>
                    <h5 class="cajas-contenedoras-perfil_h5">Genero:</h5>
                    <p class="cajas-contenedoras-perfil_p">{{ App\User::where('id', \Auth::user()->id)->with('profile')->first()->profile->gender }}</p>
                    <h5 class="cajas-contenedoras-perfil_h5">Nacionalidad:</h5>
                    <p class="cajas-contenedoras-perfil_p">{{ App\Profile::where('user_id', \Auth::user()->id)->first()->nationality }}</p>
                    </div>
                    
                </div>
                </div>
                <div class="col-md-4">
                <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil">
                    <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-head">
                    <h4>Postulaciones</h4>
                        <img src="{{ asset('user/assets/img/control.png') }}" alt="">
                    </div>
                    <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil-inf">
                        
                        @if(App\Proposal::where("user_id", \Auth::user()->id)->with("offer")->count() == 0)
                            <h5 class="cajas-contenedoras-postulaciones_h5">Aún no te has postulado a alguna oferta</h5>
                        @endif

                        @foreach(App\Proposal::where("user_id", \Auth::user()->id)->with("offer")->take(3)->get() as $proposal)
                            @if($proposal->offer)
                                <h5 class="cajas-contenedoras-postulaciones_h5">{{ $proposal->offer->title }}</h5> 
                            @endif
                        @endforeach
                    </div>  
                    
                </div>
                </div>
                <div class="col-md-4">
                <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil">
                    <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-head">
                    <h4>Estadisticas</h4>
                        <img src="{{ asset('user/assets/img/control.png') }}" alt="">
                    </div>
                    <div class="opciones-perfil-encontre-trabajo-usuario-cajas-contenedoras-perfil-inf">
                    <h5 class="cajas-contenedoras-estadisticas_h5">Postulaciones de empresas que visitaron o vieron su curriculum.:</h5>
                    <p class="cajas-contenedoras-estadisticas_p">{{ App\Proposal::where("user_id", \Auth::user()->id)->with("offer")->count() }}</p>
                    <h5 class="cajas-contenedoras-estadisticas_h5">Empresas que han visto su perfil.:</h5>
                    <p class="cajas-contenedoras-estadisticas_p">{{ App\BusinessCurriculumView::where("user_curriculum_id", \Auth::user()->id)->count() }}</p>
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

    

@endpush