<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        
        <p class="text-center">
            <img src="{{ $user->image }}" alt="" style="width: 120px;">
        </p>


            <div class="col-12">
                <h2 class="text-center text-info" style="padding-top: 20px;">Antecedentes básicos</h2>
            </div>
            <div>
                <h5 for="name">Nombre Completo</h5>
                <h3>{{ $user->name }}</h3>
            </div>
            <div>
                <label for="rut">RUT</label>
                {{ $user->rut }}
            </div>
            <div>
                <label for="birthDate">Fecha de Nacimiento</label>
                {{ $profile->birth_date }}
            </div>
            <div>
                <label for="birthDate">Edad</label>
                <input type="text" class="form-control" value="{{ $age }}" disabled>
            </div>
            {{--<div class="col-md-8 offset-md-2 pb-20">
                <label for="gender">Sexo</label><br>
                <input type="text" class="form-control" v-model="gender" disabled>
            </div>
            <div class="col-md-8 offset-md-2 pb-20">
                <label for="civilState">Estado Civil</label>
                <input type="text" class="form-control" v-model="civilState" disabled>
            </div>
            <div class="col-md-8 offset-md-2 pb-20">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" id="address" v-model="address" disabled>
            </div>
            <div class="col-md-8 offset-md-2 pb-20" v-if="country == 4">
                <label for="region">Región</label>
                <select class="form-control" id="region" v-model="region" @change="fetchCommunes()" disabled>
                    <option :value="region" v-for="region in regions">@{{ region.name }}</option>
                </select>
            </div>
            <div class="col-md-8 offset-md-2 pb-20" v-if="country == 4">
                <label for="commune">Comuna</label>
                <select class="form-control" id="commune" v-model="commune" disabled>
                    <option :value="commune.id" v-for="commune in communes">@{{ region.name }} - @{{ commune.name }}</option>
                </select>
            </div>
            <div class="col-md-8 offset-md-2 pb-20">
                <label for="handicap">Posee Discapacidad</label>
                <input type="text" class="form-control" id="address" v-model="handicap" disabled>
            </div>--}}                                    
                                
                        
    </body>
</html>