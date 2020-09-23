@extends('layouts.secondaryViews')

@section('content')

    <div class="col-md-12">

        @if(App\Appointment::where('room_name', $room_name)->count() > 0)


            @php
                $appointment = App\Appointment::where("room_name", $room_name)->first();
            @endphp

            @if(\Auth::user()->id == $appointment->user_id || \Auth::user()->id == $appointment->guest_id)

                @if(Carbon\Carbon::now()->gte($appointment->date_time) && $appointment->date_time->lt($appointment->date_time->addDay()))
                   
                    <div id="meet"></div>

                @else

                    @if($appointment->date_time->lt(Carbon\Carbon::now()))
                        <h3>La conferencia comienza el {{ $appointment->date_time }}</h3>
                    @elseif($appointment->date_time->addDay()->gt(Carbon\Carbon::now()))
                        <h3>La conferencia ha expirado</h3>
                    @endif

                @endif

            @else
                <h3 class="text-center">Usted no ha sido invitado a esta conferencia</h3>
            @endif

        @else

            <h3 class="text-center">Sala no encontrada</h3>

        @endif

    </div>

@endsection

@push('scripts')

    <script src='https://meet.jit.si/external_api.js'></script>

    <script>

        $(document).ready(function(){

            const domain = 'jitsivideo.sytes.net';
            const options = {
                roomName: '{{ $room_name }}',
                height: 700,
                parentNode: document.querySelector('#meet')
            };
            const api = new JitsiMeetExternalAPI(domain, options);

        })

    </script>

@endpush