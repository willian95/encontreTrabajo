@extends('layouts.secondaryViews')

@section('content')

    <div class="col-md-12">

        <div id="meet"></div>

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